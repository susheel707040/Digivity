<?php


namespace App\Repositories\MasterAdmin\Finance;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeStructure;
use App\Models\MasterAdmin\Finance\FeeSetting\FineSetting;
use App\Models\MasterAdmin\Finance\StudentFeeCollection;
use App\Models\MasterAdmin\Transport\MasterSetting\TransportRouteFeeCharge;
use App\Repositories\MasterAdmin\RepositoryContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class FinanceFeeCollectionRepository extends RepositoryContract
{

    public function studentfeerecord($studentparameter,$feeuptodate,$feepayid)
    {

        //fee structure from to date
        if(is_array($feeuptodate)&&(count($feeuptodate))){
            $from_date=$feeuptodate['from_date']?$feeuptodate['from_date']:"2020-04-01";
            $to_date=$feeuptodate['to_date']?$feeuptodate['to_date']:nowdate('','Y-m-d');
        }else{ $from_date="2000-04-01"; $to_date=$feeuptodate; }

        //define variables
        $studentid=$studentparameter['studentid']; $courseid=$studentparameter['courseid'];
        $feegroupid=$studentparameter['feegroupid']; $studentconcessionid=$studentparameter['feeconcessionid'];
        $studentfeeheadidavoid=$studentparameter['feeheadidavoid']; $adm_type=$studentparameter['adm_type'];
        $adm_category=$studentparameter['adm_category'];

        $feetype=['late-fee'];
        $feetypecharges=[];
        if(!empty($studentparameter['transportid'])){
            $feetype=array_merge($feetype,['transport']);
            $transportcharge=TransportRouteFeeCharge::query()->select(array('instalment_id','fee_amount'))->where('route_relation_id',$studentparameter['transportid'])->record()->get();
            $feetypecharges['transport']=collect($transportcharge)->mapWithKeys(function ($i) {return [$i['instalment_id'] => $i['fee_amount']];})->toArray();
        }

        //fine setting get
        $finesetting=FineSetting::query()->where(['fee_group_id'=>$feegroupid])->select(['fee_head_id','foreign_fee_head_id','instalment_id','fine_type','instalment_max_limit','fine_max_limit'])->record()->get();

        //pay fee particular search
        $feepaysearch=[];
        if(!empty($feepayid)){$feepaysearch=explode(",",$feepayid);}

        //print_r(microtime());

        //previous fee payment details
        $studentpaymentdata=collect(StudentFeeCollection::query()->where(['student_id'=>$studentid,'receipt_status'=>'paid'])->with(['feeheadinstalment'])->record()->get()->pluck('feeheadinstalment')->flatten())->reverse();



        //current fee payable data
        $feestructure = FeeStructure::query()->where(function ($query) use($studentid,$feegroupid) {$query->where(['fee_to' => 'group', 'fee_group_id' => $feegroupid])->orwhere(function ($query) use($studentid) {$query->where(['fee_to'=>'student','student_id'=>$studentid]);});})
            ->where(function ($query) use($adm_type){$query->whereNull('fee_applicable')->orwhere('fee_applicable',$adm_type);})
            ->where(function ($query) use($adm_category){$query->whereNull('admission_category')->orwhere('admission_category',$adm_category);})
            ->where(function($query) use($feetype){$query->whereNull('fee_type')->orWhereIn('fee_type',$feetype);})
            ->whereNull('custom_fee_pay_status')
            ->whereNotIn('foreign_fee_head_id',explode(',',$studentfeeheadidavoid))
            ->where(function($query) use($feepaysearch){ if(count($feepaysearch)){$query->whereIn('fee_head_id',$feepaysearch);}})
            ->with(['feehead'=>function($query){$query->orderBy('priority','asc');},
                'feeheadinstalment'=>function($query){$query->orderBy('sequence','asc');},
                'feestructureinstalment',
                'feeheadconcessiontype' => function ($query) use($studentconcessionid) {$query->where('concession_type_id', $studentconcessionid);},
                'feeheadinstalmentconcession'=> function ($query) use($studentid) {$query->where(['student_id'=>$studentid,'adjust_status'=>'0']);},
                'feeheadinstalmentfineconcession'=> function ($query) use($studentid) {$query->where('student_id', $studentid);},
                'feeheadfine'=> function ($query) use($feegroupid) {$query->where('fee_group_id', $feegroupid);},
                'feeheadinstalmentavoid'=>function ($query) use($studentid) {$query->where('student_id', $studentid);}])
            ->record()->get()->sortBy('feehead.priority');

        //fee Structure Loops
        $studentfeestructureresult = array();
        foreach ($feestructure as $data) {

            //fee head instalment avoids
            if(isset($data->feeheadinstalmentavoid->instalment_id)){$feeheadinstalmentavoid=explode(",",$data->feeheadinstalmentavoid->instalment_id);}else{$feeheadinstalmentavoid=array();}
            $feeheadinstalment=collect($data->feeheadinstalment)->whereNotIn('instalment_id',$feeheadinstalmentavoid);

               if(isset($studentparameter['withoutpaid_fee'])&&($studentparameter['withoutpaid_fee']==true)){
                   $lastpaymentdata=[];
               }else {
                   //previous fee payment instalment pay check
                   $lastpaymentdata = $studentpaymentdata->where('fee_head_id', $data->fee_head_id)->reverse()->mapWithKeys(function ($i) {
                       return [$i['instalment_id'] => ['instalment_id' => $i['instalment_id'], 'bal' => $i['instalment_bal'], 'status' => $i['paid_status']]];
                   });
               }

               //Fee Instalment Paid
                $feeheadinstalmentpaid = collect($feeheadinstalment)->map(function ($i) use ($lastpaymentdata) {
                    if (!empty($lastpaymentdata[$i->instalment_id])) {
                        if ($lastpaymentdata[$i->instalment_id]['status'] == "paid") {
                            return $i->instalment_id;
                        }
                    }
                })->toArray();

               //select only pay instalment
                $onlypayinstalment = collect($feeheadinstalment)->whereNotIn('instalment_id', $feeheadinstalmentpaid);

                //fee head all instalment array
                $feeheadallinstalment = collect($onlypayinstalment);

                //fee head pay instalment array
                $feeinstalment = collect($onlypayinstalment)->where('start_date', '>=', date('Y-m-d', strtotime($from_date)))
                    ->where('start_date', '<=', date('Y-m-d', strtotime($to_date)))
                    ->sortBy('sequence')->mapWithKeys(function ($i) {
                    return [$i['instalment_id'] => $i['instalment_id']];
                })->toArray();

                 //fee head instalment print name
                $feeinstalmentprint = collect($data->feeheadinstalment)->mapWithKeys(function ($i) {return [$i['instalment_id'] => $i['print_name']];})->toArray();

                //fee head instalment sequence
                $feeinstalmentsequence = collect($onlypayinstalment)->mapWithKeys(function ($i) {return [$i['instalment_id'] => $i['sequence']];})->toArray();


                //Fee Strucutre Instalment Amount
                $feestructureamount = collect($data->feestructureinstalment)->whereNotIn('instalment_id', $feeheadinstalmentpaid)->mapWithKeys(function ($i) use ($lastpaymentdata,$data,$feetypecharges) {
                    //if previous fee paid/unpaid status
                    if (!empty($lastpaymentdata[$i['instalment_id']])) {
                        return [$i['instalment_id'] => $lastpaymentdata[$i['instalment_id']]['bal']];
                    }
                    //fee type amount import others modules
                    if(array_key_exists($data->fee_type,$feetypecharges)){
                        if(isset($feetypecharges[$data->fee_type][$i['instalment_id']])){
                            return [$i['instalment_id'] => $feetypecharges[$data->fee_type][$i['instalment_id']]];
                        }
                    }
                    //late fee charges calculate
                    if($data->fee_type=="late-fee"){
                        return [$i['instalment_id'] => $i['fee_amount']];
                    }

                    return [$i['instalment_id'] => $i['fee_amount']];
                })->toArray();

                 /**
                 * fee structure fee concession type & student fee concession
                 */
                $feeheadconcession=collect($data->feeheadconcessiontype)->mapWithKeys(function ($i) {return [$i['instalment_id'] => [$i['concession_type'],$i['concession']]];})->toArray();
                $studentfeeheadconcession=collect($data->feeheadinstalmentconcession)->mapWithKeys(function ($i) {return [$i['instalment_id'] => [$i['concession_type'],$i['concession']]];})->toArray();

                $feeheadinstalmentconcession = collect($data->feeheadinstalment)->whereNotIn('instalment_id', $feeheadinstalmentpaid)->mapWithKeys(function ($i) use ($feestructureamount,$lastpaymentdata,$feeheadconcession,$studentfeeheadconcession) {
                    $concession = 0;
                    //IF Previous Fee Paid/Un-Paid Status
                    if (!empty($lastpaymentdata[$i['instalment_id']])) {
                        //student fee head concession
                        if (isset($studentfeeheadconcession[$i['instalment_id']])) {
                            if ($studentfeeheadconcession[$i['instalment_id']][0] == "f") {
                                $concession += $studentfeeheadconcession[$i['instalment_id']][1];
                            } else {
                                $concession += (($feestructureamount[$i['instalment_id']] * $studentfeeheadconcession[$i['instalment_id']][1]) / 100);
                            }
                        }
                    }else {
                        //regular concession type
                        if (isset($feeheadconcession[$i['instalment_id']])) {
                            if ($feeheadconcession[$i['instalment_id']][0] == 'f') {
                                $concession += $feeheadconcession[$i['instalment_id']][1];
                            } else {
                                $concession += (($feestructureamount[$i['instalment_id']] * $feeheadconcession[$i['instalment_id']][1]) / 100);
                            }
                        }
                        //student fee head concession
                        if (isset($studentfeeheadconcession[$i['instalment_id']])) {
                            if ($studentfeeheadconcession[$i['instalment_id']][0] == "f") {
                                $concession += $studentfeeheadconcession[$i['instalment_id']][1];
                            } else {
                                $concession += (($feestructureamount[$i['instalment_id']] * $studentfeeheadconcession[$i['instalment_id']][1]) / 100);
                            }
                        }
                    }
                    return [$i['instalment_id'] => $concession];
                })->toArray();



                //fee head instalment fine/late fee
                $totalfine = array();
                $feeheadfine=collect($data->feeheadfine)->mapWithKeys(function ($i) {return [$i['instalment_id'] => [$i['fine_type'],$i['fine'],$i['instalment_max_limit'],$i['fine_max_limit']]];})->toArray();
                $feeheadfineconcession=collect($data->feeheadinstalmentfineconcession)->mapWithKeys(function ($i) {return [$i['instalment_id'] => [$i['concession_type'],$i['concession'],$i['instalment_avoid']]];})->toArray();

                $feeheadinstalmentfine = collect($data->feeheadinstalment)->whereNotIn('instalment_id', $feeheadinstalmentpaid)->mapWithKeys(function ($i) use ($feeheadallinstalment, $lastpaymentdata,$feeheadfine,$feeheadfineconcession) {
                    //if previous fee paid/unpaid status
                    if (!empty($lastpaymentdata[$i['instalment_id']])) {
                        return [$i['instalment_id'] => 0];
                    }
                    global $totalfine;
                    $feeheadallinstalmentresult = $feeheadallinstalment->where('instalment_id', $i['instalment_id'])->shift();

                    //check fee head instalment fine apply yes/no
                    if (((isset($feeheadallinstalmentresult->fine_apply))&&$feeheadallinstalmentresult->fine_apply == "yes")) {
                        if(isset($feeheadfine[$i['instalment_id']])){

                            //student fine disable
                            if(isset($feeheadfineconcession[$i['instalment_id']])&&($feeheadfineconcession[$i['instalment_id']][2]=="yes")){
                                return [$i['instalment_id'] => 0];
                            }

                            if($feeheadfine[$i['instalment_id']][0]=="day"){
                                $todaydate = Carbon::parse();
                                $feeduedate = Carbon::parse($feeheadallinstalmentresult->end_date);
                                $dayno = $feeduedate->diffInDays($todaydate);
                                $latefee = ($dayno * $feeheadfine[$i['instalment_id']][1]);
                                if($feeheadfine[$i['instalment_id']][2]<$latefee) {
                                    $latefee=$feeheadfine[$i['instalment_id']][2];
                                }

                            }else if($feeheadfine[$i['instalment_id']][0]=="month"){
                                $latefee = $feeheadfine[$i['instalment_id']][1];
                            }else if($feeheadfine[$i['instalment_id']][0]=="once"){
                                $latefee = $feeheadfine[$i['instalment_id']][1];
                            }
                            // fee head max limit fine
                            $totalfine += $latefee;
                            if($feeheadfine[$i['instalment_id']][3]!="0.00"){
                                if($feeheadfine[$i['instalment_id']][3]<=$totalfine){
                                    $latefeediffrence=$totalfine-$feeheadfine[$i['instalment_id']][3];
                                    $latefee=$latefee-$latefeediffrence;
                                }
                            }
                            //student late fee concession
                            $latefeeconcession=0;
                            if(isset($feeheadfineconcession[$i['instalment_id']])){
                                if($feeheadfineconcession[$i['instalment_id']][0]=="f"){
                                    $latefeeconcession=$feeheadfineconcession[$i['instalment_id']][1];
                                }else{
                                    $latefeeconcession=numberformat(($latefee*$feeheadfineconcession[$i['instalment_id']][1])/100);
                                }
                            }
                            if($latefeeconcession<$latefee){
                                $latefee=$latefee-$latefeeconcession;
                            }

                            return [$i['instalment_id'] => $latefee];

                        }else{
                            return [$i['instalment_id'] => 0];
                        }
                    } else {
                        return [$i['instalment_id'] => 0];
                    }
                })->toArray();

                //student fee structure create for show ui
                $studentfeestructureresult[] = [
                    'fee_structure_id' => $data->id,
                    'fee_head_id' => $data->fee_head_id,
                    'foreign_fee_head_id' => $data->foreign_fee_head_id,
                    'fee_head' => $data->feehead->fee_head,
                    'custom_fee_id' => $data->custom_fee_id,
                    'fee_head_sequence' => $data->feehead->priority,
                    'fee_head_amount' => $data->feehead->fee_head_amount,
                    'fee_instalment_paid' => $feeheadinstalmentpaid,
                    'fee_head_full_instalment' => collect($data->feeheadinstalment)->map(function ($i) {return $i->instalment_id;})->toArray(),
                    'fee_head_all_instalment' => collect($feeheadinstalment)->map(function ($i) {return $i->instalment_id;})->toArray(),
                    'fee_head_instalment_start_date' => collect($data->feeheadinstalment)->mapWithKeys(function ($i) {return [$i['instalment_id']=>$i['start_date']];})->toArray(),
                    'fee_head_instalment' => collect($onlypayinstalment)->map(function ($i) {return $i->instalment_id;})->toArray(),
                    'fee_head_instalment_sequence' => $feeinstalmentsequence,
                    'fee_head_instalment_print' => $feeinstalmentprint,
                    'fee_structure_instalment_amount' => $feestructureamount,
                    'fee_head_instalment_concession' => $feeheadinstalmentconcession,
                    'fee_head_instalment_late_fee' => $feeheadinstalmentfine,
                    'select_pay_instalment_print' => array_intersect_key($feeinstalmentprint, $feeinstalment),
                    'select_pay_instalment' => $feeinstalment,
                    'select_pay_instalment_amount' => array_intersect_key($feestructureamount, $feeinstalment),
                    'select_pay_instalment_concession' => array_intersect_key($feeheadinstalmentconcession, $feeinstalment),
                    'select_pay_instalment_late_fee' => array_intersect_key($feeheadinstalmentfine, $feeinstalment),
                    'fee_instalment_count' => count($feeinstalment)
                ];

        }
        $studentfeeresult[]=$studentfeestructureresult;
        //fee total calculation variable
        $subtotal=array_sum(collect(array_column($studentfeestructureresult,'select_pay_instalment_amount'))->map(function ($i){return array_sum($i);})->all());
        $concessiontotal=array_sum(collect(array_column($studentfeestructureresult,'select_pay_instalment_concession'))->map(function ($i){return array_sum($i);})->all());
        $latefeetotal=array_sum(collect(array_column($studentfeestructureresult,'select_pay_instalment_late_fee'))->map(function ($i){return array_sum($i);})->all());
        $feepayable=(($subtotal-$concessiontotal)+$latefeetotal);

        $studentfeeresult[]=['subtotal'=>$subtotal];
        $studentfeeresult[]=['concessiontotal'=>$concessiontotal];
        $studentfeeresult[]=['finetotal'=>$latefeetotal];
        $studentfeeresult[]=['excesstotal'=>0];
        $studentfeeresult[]=['feepayable'=>$feepayable];

        //echo "<br/>";
        //print_r(microtime());
        //dd($studentfeeresult);
        //die();
        return $studentfeeresult;

    }
}
