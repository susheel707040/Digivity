<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\FeeEntry;

use App\Helper\FormNoGenerate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MasterAdmin\Finance\Helper\CustomFeeStore;
use App\Http\Requests\MasterAdmin\Finance\StudentFeeCollectionRequest;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeHead;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeStructure;
use App\Models\MasterAdmin\Finance\StudentFeeCollection;
use App\Models\MasterAdmin\Finance\StudentFeeCollectionFeeHeadRecord;
use App\Models\MasterAdmin\Finance\StudentFeeCollectionInstalmentRecord;
use App\Models\MasterAdmin\Finance\StudentFeeHeadInstalmentConcession;
use App\Repositories\MasterAdmin\Finance\FinanceFeeCollectionRepository;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helper\DBGetLastId;

class FeeCollectionController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Finance.FeeEntry.fee-collection');
    }

    public function indexsearch($studentid, $feeuptodate, $feepayid)
    {
        $studentidarr=array($studentid);
        $student=StudentRecord::query()->where('student_id',$studentid)->record()->first();
        if($student->ac_ledger_no){
            $student=StudentRecord::query()->select(array('student_id'))->where('ac_ledger_no',$student->ac_ledger_no)->whereNotIn('student_id',[$studentid])->record()->get();
            $studentidarr=array_merge($studentidarr,array_column($student->toArray(),'student_id'));
        }
        return view('app.erpmodule.MasterAdmin.Finance.FeeEntry.fee-collection', compact(['studentid', 'studentidarr', 'feeuptodate', 'feepayid']));
    }


    public function feecollect(StudentFeeCollectionRequest $request)
    {
        $error=0;
        $request->validated();
        $receipt_group_token_id=0;
        if(count($request['studentid'])) {
            //fee group token Existing check
            $feecollectionexist = StudentFeeCollection::query()->where('receipt_group_token_id', $request->receiptgroupid)->count();
            if ($feecollectionexist == 0) {
                $receipt_group_token_id=$request->receiptgroupid;
                //multiple student fee collection
                $studentamount = array();
                foreach ($request['studentid'] as $studentid) {
                    /**
                     * generate fee receipt number
                     */
                    $fee_receipt_id = DBGetLastId::getlastid('finance_fee_collection_record') + 1;
                    if (FormNoGenerate::generate('fee_receipt_no')) {
                        $getreceiptno = FormNoGenerate::generate('fee_receipt_no');
                        if ($getreceiptno->GetNo()) {
                            $fee_receipt_id = $getreceiptno->GetNo();
                        }
                    }

                    //student wise paid amount update in receipt
                    $studentamount['student_' . $studentid . '_amount'] = 0;
                    if (isset($request["student_" . $studentid . "_fee_structure_id"])) {
                        //student fee collection total receipt student wise
                        $receiptamount = collect(['subtotal' => 0, 'concessiontotal' => 0, 'finetotal' => 0, 'feepayable' => 0, 'paidamount' => 0, 'balance' => 0]);
                        //instrument date empty date check
                        if ($request->instrument_date) {
                            $instrument_date = date('Y-m-d', strtotime($request->instrument_date));
                        } else {
                            $instrument_date = null;
                        }
                        //fee collection model -> first
                        $data1 = [
                            'receipt_group_token_id' => $request->receiptgroupid,
                            'receipt_id' => $fee_receipt_id,
                            'receipt_date' => date('Y-m-d', strtotime($request->receipt_date)),
                            'student_id' => $studentid,
                            'course_id' => $request["student_" . $studentid . "_course_id"],
                            'section_id' => $request["student_" . $studentid . "_section_id"],
                            'entry_mode' => $request->entry_mode,
                            'paymode_id' => $request->paymode_id,
                            'instrument_no' => $request->instrument_no,
                            'instrument_date' => $instrument_date,
                            'bank' => $request->bank_id,
                            'concession_remark' => $request->concession_remark,
                            'special_concession_remark' => $request->special_concession_remark,
                            'fine_remark' => $request->fine_remark,
                            'fee_remark' => $request->fee_remark
                        ];
                        //fee collection model data create student wise
                        $feecollection = StudentFeeCollection::create($data1);
                        if ($feecollection) {

                            $feecollectionid = $feecollection->id;
                            $data3 = array();
                            $exceedamt = 0;

                            if (isset($request["student_" . $studentid . "_fee_structure_id"]) && count($request["student_" . $studentid . "_fee_structure_id"]) > 0) {
                                foreach ($request["student_" . $studentid . "_fee_structure_id"] as $feestructureid) {

                                    //find student wise pay fee head id
                                    $feeheadid = $request["student_" . $studentid . "_fee_head_" . $feestructureid . "_id"];
                                    $feeheadpriority = $request["student_" . $studentid . "_fee_head_" . $feestructureid . "_priority"];
                                    $customfeeid = $request["student_" . $studentid . "_custom_fee_" . $feestructureid . "_id"];
                                    //fee collection fee head data create this model
                                    $feecollectionfeehead = StudentFeeCollectionFeeHeadRecord::create(['fee_collection_id' => $feecollectionid, 'fee_structure_id' => $feestructureid, 'fee_head_id' => $feeheadid, 'custom_fee_id' => $customfeeid, 'priority' => $feeheadpriority]);
                                    if ($feecollectionfeehead) {

                                        //define fee head instalment sum amounts
                                        $feeheadarr = collect(["subtotal" => 0, 'concessiontotal' => 0, 'finetotal' => 0, 'totalpay' => 0]);

                                        if (isset($request["stud_" . $studentid . "_stru_" . $feestructureid . "_fee_" . $feeheadid . "_instalment_id"]) && (count($request["stud_" . $studentid . "_stru_" . $feestructureid . "_fee_" . $feeheadid . "_instalment_id"]) > 0)) {
                                            foreach ($request["stud_" . $studentid . "_stru_" . $feestructureid . "_fee_" . $feeheadid . "_instalment_id"] as $instalmentid) {

                                                //instalment amounts data
                                                $instalment_amount = $request["i_f_i_a_" . $studentid . "_" . $feeheadid . "_" . $feestructureid . "_" . $instalmentid . ""];
                                                $instalment_concession = $request["i_f_i_c_" . $studentid . "_" . $feeheadid . "_" . $feestructureid . "_" . $instalmentid . ""];
                                                $instalment_fine = $request["i_f_i_f_" . $studentid . "_" . $feeheadid . "_" . $feestructureid . "_" . $instalmentid . ""];
                                                $instalment_total = (($instalment_amount - $instalment_concession) + $instalment_fine);

                                                //instalment unique id
                                                $instalment_unique_id = explode("_", $instalmentid);
                                                $instalment_unique_id[0] ? $instalment_unique_id = $instalment_unique_id[0] : $instalment_unique_id = null;

                                                //load data for fee head instalment model array data
                                                $data3[] = [
                                                    'id' => null,
                                                    'fee_collection_id' => $feecollectionid,
                                                    'receipt_group_token_id' => $request->receiptgroupid,
                                                    'student_id' => $studentid,
                                                    'fee_collection_fee_head_id' => $feecollectionfeehead->id,
                                                    'fee_structure_id' => $feestructureid,
                                                    'fee_head_id' => $feeheadid,
                                                    'custom_fee_id' => $customfeeid,
                                                    'fee_head_priority' => $feeheadpriority,
                                                    'instalment_id' => $instalmentid,
                                                    'instalment_unique_id' => $instalment_unique_id,
                                                    'instalment_priority' => $request["i_f_i_s_" . $studentid . "_" . $feeheadid . "_" . $feestructureid . "_" . $instalmentid . ""],
                                                    'instalment_print_name' => $request["i_f_i_p_" . $studentid . "_" . $feeheadid . "_" . $feestructureid . "_" . $instalmentid . ""],
                                                    'instalment_amount' => $instalment_amount,
                                                    'instalment_concession' => $instalment_concession,
                                                    'instalment_fine' => $instalment_fine,
                                                    'instalment_total_amount' => $instalment_total,
                                                    'instalment_bal' => $instalment_total
                                                ];
                                                $feeheadarr['subtotal'] += $instalment_amount;
                                                $feeheadarr['concessiontotal'] += $instalment_concession;
                                                $feeheadarr['finetotal'] += $instalment_fine;
                                                $feeheadarr['totalpay'] += $instalment_total;
                                                if ($instalment_total < 0) {
                                                    $exceedamt += $instalment_total;
                                                }
                                            }
                                            //student fee collection fee head record update data
                                            $feecollectionfeehead->update(['sub_total' => $feeheadarr['subtotal'], 'concession_total' => $feeheadarr['concessiontotal'], 'fine_total' => $feeheadarr['finetotal'], 'total' => $feeheadarr['totalpay']]);

                                            //fee receipt collection sum
                                            $receiptamount['subtotal'] += $feeheadarr['subtotal'];
                                            $receiptamount['concessiontotal'] += $feeheadarr['concessiontotal'];
                                            $receiptamount['finetotal'] += $feeheadarr['finetotal'];
                                            $receiptamount['feepayable'] += $feeheadarr['totalpay'];
                                        }
                                    } else {$error += 1;}
                                }

                                //fee collection bulk fee head instalment create data in model
                                $feecollection->feeheadinstalmentrecord()->attach($data3);

                                //receipt final update
                                $feecollection->update(['sub_total' => $receiptamount['subtotal'], 'concession_total' => $receiptamount['concessiontotal'], 'fine_total' => $receiptamount['finetotal'], 'fee_payable' => $receiptamount['feepayable']]);

                                //payment update instalment and fee receipt
                                $customfeepayid = array();
                                $paidamt = ($request["student_" . $studentid . "_paid_amt"] + abs($exceedamt));

                                $instalmentpaymentupdate = StudentFeeCollectionInstalmentRecord::query()->where('fee_collection_id', $feecollectionid)->orderBy('instalment_priority')->orderBy('fee_head_priority')->get();
                                if(isset($instalmentpaymentupdate)&&($instalmentpaymentupdate)){

                                    foreach ($instalmentpaymentupdate as $instalmentdata) {
                                        //Fee Head Instalment Concession Record Update
                                        if (isset($instalmentdata->instalment_concession) && ($instalmentdata->instalment_concession > 0)) {
                                            $instalmentconcessiondata = StudentFeeHeadInstalmentConcession::query()->where(['student_id' => $instalmentdata->student_id, 'foreign_fee_head_id' => $instalmentdata->fee_head_id, 'instalment_id' => $instalmentdata->instalment_id, 'adjust_status' => '0'])->record()->first();
                                            if (isset($instalmentconcessiondata) && ($instalmentconcessiondata)) {
                                                $updateadjust = $instalmentconcessiondata->update(['fee_collection_id' => $instalmentdata->fee_collection_id, 'adjust_date' => nowdate('', 'Y-m-d'), 'adjust_status' => '1']);
                                                if (!$updateadjust) {
                                                    $error += 1;
                                                }
                                            }
                                        }
                                        //if validate not false then pass this condition
                                        if($error==0){

                                        if (!empty($paidamt) || ($instalmentdata->instalment_total_amount < 0)) {

                                            if ($instalmentdata->instalment_total_amount <= $paidamt) {
                                                $dataupdate = ['instalment_paid' => $instalmentdata->instalment_total_amount, 'instalment_bal' => 0, 'paid_status' => 'paid'];
                                                $studentamount["student_" . $instalmentdata->student_id . "_amount"] += $instalmentdata->instalment_total_amount;
                                                if ($instalmentdata->instalment_total_amount > 0) {
                                                    $paidamt -= $instalmentdata->instalment_total_amount;
                                                }
                                                if ($instalmentdata->custom_fee_id) {
                                                    $customfeepayid[] = $instalmentdata->custom_fee_id;
                                                }
                                            } else {
                                                if ($instalmentdata->instalment_total_amount < 0) {
                                                    $dataupdate = ['instalment_paid' => $instalmentdata->instalment_total_amount, 'instalment_bal' => 0, 'paid_status' => 'paid'];
                                                    if ($instalmentdata->custom_fee_id) {
                                                        $customfeepayid[] = $instalmentdata->custom_fee_id;
                                                    }
                                                } else {
                                                    $dataupdate = ['instalment_paid' => $paidamt, 'instalment_bal' => ($instalmentdata->instalment_total_amount - $paidamt), 'paid_status' => 'unpaid'];
                                                }
                                                $studentamount["student_" . $instalmentdata->student_id . "_amount"] += $paidamt;
                                                $paidamt = 0;
                                            }
                                            $updateinstalment = StudentFeeCollectionInstalmentRecord::find($instalmentdata->id)->update($dataupdate);
                                            //if failed update instalment
                                            if (!$updateinstalment) {
                                                $error += 1;
                                            }
                                        }
                                    }
                                }
                                if($error==0){
                                $newcustomfeeid = null;
                                if ($paidamt > 0) {
                                    $feeheadcustom = FeeHead::query()->where(['type' => 'excess-fee'])->record()->first();
                                    //custom fee add
                                    $data4 = [
                                        'student_' . $studentid . '_fee_head_id' => $feeheadcustom->id,
                                        'student_' . $studentid . '_fee_head_amount' => "-$paidamt",
                                        'student_' . $studentid . '_instalment_id' => strtolower(Carbon::createFromDate()->format('M')),
                                        'student_' . $studentid . '_instalment_print' => "Receipt::$feecollectionid-" . date('d-m-Y', strtotime($request->receipt_date)) . "",
                                        'student_' . $studentid . '_start_date' => Carbon::now()->toDateString(),
                                        'student_' . $studentid . '_concession_type' => "f",
                                        'student_' . $studentid . '_concession' => "0",
                                        'student_' . $studentid . '_priority_id' => "1",
                                    ];
                                    $newcustomfeeid = CustomFeeStore::storefee($studentid, $feecollectionid, $data4);
                                    if (!$newcustomfeeid){$error+=1;}
                                }

                                //update custom fee clear
                                if ((isset($customfeepayid)) && is_array($customfeepayid)&&(count($customfeepayid)>0)) {
                                    $customfeeupdate=FeeStructure::whereIn('custom_fee_id', $customfeepayid)->update(['custom_fee_pay_status' => 1]);
                                    if(!$customfeeupdate){$error+=1;}
                                }

                                if($error==0) {
                                    //student fee payment update
                                    $customfeeids = implode(",", $customfeepayid);
                                    $studentbalance = $receiptamount['feepayable'] - $studentamount["student_" . $studentid . "_amount"];
                                    $feecollection->update(['paid_amount' => $request["student_" . $studentid . "_paid_amt"], 'balance' => $studentbalance, 'receipt_status' => 'paid', 'custom_fee_id' => $customfeeids, 'new_custom_fee_id' => $newcustomfeeid]);
                                    /*
                                     * Fee Receipt auto update
                                     */
                                    if (isset($getreceiptno)) {
                                        $getreceiptno->increment('start_from', 1);
                                    }
                                }
                                }
                              }else {$error +=1;}
                            }
                        }else {$error +=1;}
                    }
                }
            }
            if($error==0) {
                return back()->with('success', 'Fee Collection Successfully Complete')->with('receipt_group_token_id', $receipt_group_token_id)->with('receipt_id', $feecollectionid);
            }else{
                return back()->with('danger', 'Sorry, Technical Problem, Please Contact Digi Shiksha Team');
            }
        }
        return back()->with('danger', 'Please select atleast one student');
    }

    public function iffeecollectionfailed($feecollectiontokenid)
    {

    }
}
