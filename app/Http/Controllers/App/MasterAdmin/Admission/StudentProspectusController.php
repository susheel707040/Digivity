<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission;

use App\Helper\AutoSendSMSNotification;
use App\Helper\DBGetLastId;
use App\Helper\FormNoGenerate;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Admission\StudentProspectusPaymentRequest;
use App\Http\Requests\MasterAdmin\Admission\StudentProspectusRequest;
use App\Models\MasterAdmin\Admission\StudentProspectus;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeGroupWithMapCourse;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeStructure;
use App\Models\MasterAdmin\Finance\StudentFeeCollection;
use App\Models\MasterAdmin\Finance\StudentFeeCollectionFeeHeadRecord;
use App\Models\MasterAdmin\Finance\StudentFeeCollectionInstalmentRecord;
use Illuminate\Http\Request;

class StudentProspectusController extends Controller
{
    use AutoSendSMSNotification;
    /*
     * Prospectus Index Page
     */
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.StudentInformation.Entry.ProspectusEntry');
    }

    /*
     * Prospectus Entry
     */
    public function store(StudentProspectusRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();

        $data = array_merge($data, ['admission_date' => nowdate($request->admission_date, 'Y-m-d')]);
        $data = array_merge($data, ['dob' => nowdate($request->dob, 'Y-m-d')]);

        /*
         * admission no or sr no get auto fill
         */
        if (FormNoGenerate::generate('prospectus_no')) {
            $getprospectusno = FormNoGenerate::generate('prospectus_no');
            if ($getprospectusno->should_be == "auto") {
                $data = array_merge($data, ['pros_no' => $getprospectusno->GetNo()]);
            }
        }
//  Check if profile image file is present in the request
 if ($request->hasFile('student_photo')) {
    $profileImage = $request->file('student_photo');

    $BannerfileName = $profileImage->getClientOriginalName();

    // Move the file to the desired location
    $profileImage->move(public_path('uploads/prospectuus_image'), $BannerfileName);

    // Update the data array with the file name
    $data['student_photo'] = $BannerfileName;
}

        $studentprospectus = StudentProspectus::create($data);

        if ($studentprospectus) {
            /*
             * Prospectus Number Increment Number
             */
            if (isset($getprospectusno)) {
                $getprospectusno->increment('start_from', 1);
            }
            /*
             * SMS Notification
             */
            try {
                $this->smsnotification('prospectus-entry',StudentProspectus::class,['search'=>['id'=>$studentprospectus->id]]);
            } catch (\Exception $e) {
                // Handle exception if SMS notification fails
            }

            return redirect('/MasterAdmin/StudentInformation/ProspectusPayment/' . $studentprospectus->id . '/Entry');
        }

        return back()->with('danger', 'Sorry, Request failed, Please try again.');
    }


    /*
     * Prospectus Edit View
     */
    public function editview(StudentProspectus $studentprospectus)
    {
        return view('app.erpmodule.MasterAdmin.StudentInformation.Entry.Edit.edit-prospectus', compact(['studentprospectus']));
    }

    /*
     * Prospectus Edit
     */
    public function modify(StudentProspectus $studentprospectus, StudentProspectusRequest $request)
    {
        // dd($request->all());
        try {
            $data = $request->validated();
            $data = array_merge($data, ['admission_date' => nowdate($request->admission_date, 'Y-m-d')]);
            $data = array_merge($data, ['dob' => nowdate($request->dob, 'Y-m-d')]);

            if ($request->hasFile('student_photo')) {
                $profileImage = $request->file('student_photo');
                $BannerfileName = $profileImage->getClientOriginalName();
                // Move the file to the desired location
                $profileImage->move(public_path('uploads/prospectuus_image'), $BannerfileName);
                // Update the data array with the file name
                $data['student_photo'] = $BannerfileName;

                // Delete old image if it exists
                if ($studentprospectus->student_photo) {
                    $oldImagePath = public_path('uploads/prospectuus_image/' . $studentprospectus->student_photo);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }


            $studentprospectus->update($data);
            return back()->with('success', 'Record Update Successful Complete');
        } catch (\Exception $e) {
        }
        return back()->with('danger', 'Sorry, Request failed, Please try again.');
    }

    /*
     * Prospectus Payment Page Preview
     */
    public function paymentprocess(StudentProspectus $studentprospectus)
    {
        $feestructure = [];
        $classid = $studentprospectus->course_id;
        //get fee group id
        $feegroup = FeeGroupWithMapCourse::query()->where('course_id', $classid)->record()->first();
        if ($feegroup) {
            $feegroupid = $feegroup->fee_group_id;
            /*
             * Get Student Fee Structure
             */
            $feestructure = FeeStructure::query()->with(['feehead', 'feeheadinstalment', 'feestructureinstalment'])->search(['fee_group_id' => $feegroupid, 'fee_applicable' => 'new', 'form_sale' => 'yes'], ['feehead'])->get()->sortBy('priority');
        }
        return view('app.erpmodule.MasterAdmin.StudentInformation.Entry.ProspectusPayment', compact(['studentprospectus', 'feestructure']));
    }

    /*
     * Prospectus Payment Entry
     */
    public function prospectuspaymentcollection(StudentProspectusPaymentRequest $request)
    {
        $request->validated();

        $paidamt = $request->paid_amount;
        $receipt_group_token_id = 0;
        if (isset($request->prospectus_id)) {
            $prospectus = StudentProspectus::find($request->prospectus_id);
            if ($prospectus) {
                //student fee collection total receipt student wise
                $receiptamount = collect(['subtotal' => 0, 'concessiontotal' => 0, 'finetotal' => 0, 'feepayable' => 0, 'paidamount' => 0, 'balance' => 0]);


                /*
                 * Check Fee Duplicate Entry
                 */
                $feecollectionexist = StudentFeeCollection::query()->where('receipt_group_token_id', $request->receiptgroupid)->count();
                if ($feecollectionexist == 0) {
                    $receipt_group_token_id = $request->receiptgroupid;

                    /*
                     * generate fee receipt number
                     */
                    $fee_receipt_id = DBGetLastId::getlastid('finance_fee_collection_record') + 1;
                    if (FormNoGenerate::generate('fee_receipt_no')) {
                        $getreceiptno = FormNoGenerate::generate('fee_receipt_no');
                        if ($getreceiptno->GetNo()) {
                            $fee_receipt_id = $getreceiptno->GetNo();
                        }
                    }

                    $data = [
                        'receipt_group_token_id' => $receipt_group_token_id,
                        'receipt_id' => $fee_receipt_id,
                        'receipt_date' => nowdate($request->receipt_date, 'Y-m-d'),
                        'student_id' => 0,
                        'prospectus_id' => $request->prospectus_id,
                        'course_id' => $request->course_id,
                        'entry_mode' => $request->entry_mode,
                        'paymode_id' => $request->paymode_id,
                        'bank' => $request->bank,
                        'instrument_no' => $request->instrument_no,
                        'instrument_date' => $request->instrument_date ? nowdate($request->instrument_date, 'Y-m-d') : null,
                        'concession_remark' => $request->concession_remark,
                        'fee_remark' => $request->fee_remark
                    ];

                    //fee collection model data create student wise
                    $feecollection = StudentFeeCollection::create($data);
                    $feecollectionid = $feecollection->id;

                    foreach ($request->fee_structure_id as $feestructureid) {

                        $feeheadid = $request["fee_head_" . $feestructureid . "_id"];
                        $feeheadpriority = $request["fee_head_priority_" . $feestructureid . "_id"];
                        $customfeeid = $request["custom_fee_" . $feestructureid . "_id"];

                        //fee collection fee head data create this model
                        $feecollectionfeehead = StudentFeeCollectionFeeHeadRecord::create(['fee_collection_id' => $feecollectionid, 'fee_structure_id' => $feestructureid, 'fee_head_id' => $feeheadid, 'custom_fee_id' => $customfeeid, 'priority' => $feeheadpriority]);
                        //define fee head instalment sum amounts
                        $feeheadarr = collect(["subtotal" => 0, 'concessiontotal' => 0, 'finetotal' => 0, 'totalpay' => 0]);

                        $datainsert2 = array();
                        foreach ($request["fee_head_" . $feestructureid . "_instalment_id"] as $instalmentid) {

                            $instalment_amount = $request["fee_head_" . $feestructureid . "_instalment_" . $instalmentid . "_amount"];
                            $instalment_concession = $request["fee_head_" . $feestructureid . "_instalment_" . $instalmentid . "_concession"];
                            $instalment_fine = 0;
                            $instalment_total = (($instalment_amount + $instalment_fine) - $instalment_concession);

                            $datainsert2[] = [
                                'fee_collection_id' => $feecollectionid,
                                'receipt_group_token_id' => $receipt_group_token_id,
                                'student_id' => 0,
                                'fee_collection_fee_head_id' => $feecollectionfeehead->id,
                                'fee_structure_id' => $feestructureid,
                                'fee_head_id' => $feeheadid,
                                'custom_fee_id' => $customfeeid,
                                'fee_head_priority' => $feeheadpriority,
                                'instalment_id' => $instalmentid,
                                'instalment_unique_id' => $instalmentid,
                                'instalment_priority' => $request["fee_head_" . $feestructureid . "_instalment_" . $instalmentid . "_priority"],
                                'instalment_print_name' => $request["fee_head_" . $feestructureid . "_instalment_" . $instalmentid . "_print_name"],
                                'instalment_amount' => $instalment_amount,
                                'instalment_concession' => $instalment_concession,
                                'instalment_fine' => 0,
                                'instalment_total_amount' => $instalment_total,
                                'instalment_paid' => 0,
                                'instalment_bal' => 0
                            ];

                            $feeheadarr['subtotal'] += $instalment_amount;
                            $feeheadarr['concessiontotal'] += $instalment_concession;
                            $feeheadarr['finetotal'] += $instalment_fine;
                            $feeheadarr['totalpay'] += $instalment_total;

                            //student fee collection fee head record update data
                            $feecollectionfeehead->update(['sub_total' => $feeheadarr['subtotal'], 'concession_total' => $feeheadarr['concessiontotal'], 'fine_total' => $feeheadarr['finetotal'], 'total' => $feeheadarr['totalpay']]);

                            //fee receipt collection sum
                            $receiptamount['subtotal'] += $feeheadarr['subtotal'];
                            $receiptamount['concessiontotal'] += $feeheadarr['concessiontotal'];
                            $receiptamount['finetotal'] += $feeheadarr['finetotal'];
                            $receiptamount['feepayable'] += $feeheadarr['totalpay'];

                        }
                        //fee collection bulk fee head instalment create data in model
                        $feecollection->feeheadinstalmentrecord()->attach($datainsert2);

                        $instalmentpaymentupdate = StudentFeeCollectionInstalmentRecord::query()->where('fee_collection_id', $feecollectionid)->orderBy('instalment_priority')->orderBy('fee_head_priority')->get();

                        foreach ($instalmentpaymentupdate as $instalmentdata) {
                            if (!empty($paidamt) || ($instalmentdata->instalment_total_amount > 0)) {
                                if ($instalmentdata->instalment_total_amount <= $paidamt) {
                                    $dataupdate = ['instalment_paid' => $instalmentdata->instalment_total_amount, 'instalment_bal' => 0, 'paid_status' => 'paid'];
                                } else {
                                    $dataupdate = ['instalment_paid' => $paidamt, 'instalment_bal' => ($instalmentdata->instalment_total_amount - $paidamt), 'paid_status' => 'unpaid'];
                                }

                                $updateinstalment = StudentFeeCollectionInstalmentRecord::find($instalmentdata->id);
                                $updateinstalment->update($dataupdate);
                            }
                        }
                        //receipt final update
                        $balance = $receiptamount['feepayable'] - $paidamt;
                        $feecollection->update(['sub_total' => $receiptamount['subtotal'], 'concession_total' => $receiptamount['concessiontotal'], 'fine_total' => $receiptamount['finetotal'], 'fee_payable' => $receiptamount['feepayable'], 'paid_amount' => $paidamt, 'balance' => $balance, 'receipt_status' => 'paid']);


                        /*
                         * Fee Receipt auto update
                         */
                        if (isset($getreceiptno)) {
                            $getreceiptno->increment('start_from', 1);
                        }

                    }
                    /*
                     * Prospectus Update
                     */
                    try {
                        $prospectus->update(['pay_status'=>'paid','payable_amt'=>$receiptamount['feepayable'],'paid_amt'=>$paidamt]);
                    }catch (\Exception $e){}

                    return redirect('/MasterAdmin/Finance/Receipt/' . $feecollectionid . '/' . $receipt_group_token_id . '/Print');
                }
            }
        }
    }

}
