<?php

namespace App\Models\MasterAdmin\Finance\FeeSetting;

use App\Models\MasterAdmin\Finance\StudentFeeHeadInstalmentAvoid;
use App\Models\MasterAdmin\Finance\StudentFeeHeadInstalmentConcession;
use App\Models\MasterAdmin\Finance\StudentFeeHeadInstalmentFineConcession;
use App\Models\Record;
use Illuminate\Support\Facades\DB;

class FeeStructure extends Record
{
    protected $table="finance_fee_head_structure";
    protected $fillable=[
        'id',
        'financial_id',
        'pay_id',
        'fee_to',
        'fee_group_id',
        'student_id',
        'fee_applicable',
        'admission_category',
        'fee_head_id',
        'fee_type',
        'foreign_fee_head_id',
        'fee_amount',
        'custom_fee_id',
        'custom_fee_pay_status',
        'user_id'
    ];


    public function feehead()
    {
    return $this->belongsTo(FeeHead::class,'fee_head_id','id');
    }

    public function feeheadinstalment()
    {
      return $this->hasMany(FeeHeadInstallment::class,'foreign_fee_head_id','foreign_fee_head_id');
    }
    public function feestructureinstalment()
    {
        return $this->hasMany(FeeStructureInstalment::class,'fee_head_structure_id','id');
    }

    public function feeheadconcessiontype()
    {
        return $this->hasMany(ConcessionSetting::class,'foreign_fee_head_id','foreign_fee_head_id');
    }

    public function feeheadinstalmentconcession()
    {
        return $this->hasMany(StudentFeeHeadInstalmentConcession::class,'foreign_fee_head_id','foreign_fee_head_id');
    }

    public function feeheadinstalmentfineconcession()
    {
        return $this->hasMany(StudentFeeHeadInstalmentFineConcession::class,'foreign_fee_head_id','foreign_fee_head_id');
    }

    public function feeheadfine()
    {
        return $this->hasMany(FineSetting::class,'foreign_fee_head_id','foreign_fee_head_id');
    }

    public function feeheadinstalmentavoid()
    {
        return $this->belongsTo(StudentFeeHeadInstalmentAvoid::class,'foreign_fee_head_id','foreign_fee_head_id');
    }
}
