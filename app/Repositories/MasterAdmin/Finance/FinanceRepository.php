<?php


namespace App\Repositories\MasterAdmin\Finance;

use App\Models\MasterAdmin\Finance\FeeSetting\FeeStructure as FeeSettingFeeStructure;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Models\MasterAdmin\Finance\FeeSetting\ConcessionSetting;
use App\Models\MasterAdmin\Finance\FeeSetting\ConcessionType;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeAccount;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeGroup;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeHead;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeHeadInstallment;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeStructure;
use App\Models\MasterAdmin\Finance\FeeSetting\FineSetting;
use App\Models\MasterAdmin\Finance\Paymode;
use App\Models\MasterAdmin\Finance\StudentFeeCollection;
use App\Models\MasterAdmin\Finance\StudentFeeCollectionInstalmentRecord;
use App\Models\MasterAdmin\Finance\StudentFeeHeadInstalmentAvoid;
use App\Models\MasterAdmin\Finance\StudentFeeHeadInstalmentConcession;
use App\Models\MasterAdmin\Finance\StudentFeeHeadInstalmentFineConcession;
use App\Repositories\MasterAdmin\RepositoryContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FinanceRepository extends RepositoryContract
{
    public function paymodelist($search=null)
    {
        if(!isset($search)){$search=[];}
        return Paymode::query()->where($search)->record()->get();
    }

    public function feeaccountlist($search)
    {
        return FeeAccount::query()->where($search)->record()->get();
    }

    public function feeheadlist($search)
    {
        return FeeHead::query()->where($search)->record()->get();
    }

    public function feeheadwithinstalmentlist($search)
    {
        return FeeHead::query()->where($search)->with(['feeheadinstalment'])->record()->get();
    }

    public function feeheadinstalmentlist($search)
    {
        return FeeHeadInstallment::query()->where($search)->with(['feehead'])->record()->get();
    }

    public function feeheadinstalmentgrouplist($search=null)
    {
        return FeeHeadInstallment::query()->search($search)->record()->GroupBy('instalment_unique_id')->OrderBy('start_date','asc')->OrderBy('sequence','asc')->get();
    }

    public function feegrouplist($search)
    {
        return FeeGroup::query()->where($search)->with(['feeaccount'])->record()->get();
    }

    public function feeheadstructurelist($search)
    {
        return FeeSettingFeeStructure::query()->where($search)->with(['feestructureinstalment'])->record()->get();
    }

    public function concessiontypelist($search)
    {
        return ConcessionType::query()->orderBy('sequence', 'asc')->record()->get();
    }

    public function concessionassignsettinglist($search)
    {
        return ConcessionSetting::query()->where($search)->record()->get();
    }

    public function finesettinglist($search)
    {
        return FineSetting::query()->where($search)->record()->get();
    }

    public function feeheadinstalmentavoid($search)
    {
        return StudentFeeHeadInstalmentAvoid::query()->where($search)->record()->get();
    }

    public function feeheadinstalmentconcession($search)
    {
        return StudentFeeHeadInstalmentConcession::query()->where($search)->record()->get();
    }

    public function feeheadfineconcession($search)
    {
        return StudentFeeHeadInstalmentFineConcession::query()->where($search)->record()->get();
    }

    public function feecollectionlist($search)
    {
        return StudentFeeCollection::query()->where($search)->orderBy('id','desc')->record()->get();
    }

    public function feecollectionfulllist($search=null,$relation=null)
    {
        return StudentFeeCollection::query()->search($search)->with(['feeheadrecord','feeheadinstalmentfull','paymode','student'])->orderBy('id','desc')->record()->get();
    }

    public function feecollectioninstalmentgrouplist($search=null,$relation=null)
    {
        return StudentFeeCollectionInstalmentRecord::query()->where($search)->GroupBy('instalment_unique_id')->orderBy('instalment_priority','asc')->select('instalment_unique_id')->get()->toArray();
    }

    public function studentacledgerlist($search)
    {
        return StudentRecord::query()->whereNotNull($search)->whereNotNull('ac_ledger_no')->groupBy('ac_ledger_no')->record()->get(['ac_ledger_no'])->SortBy('ac_ledger_no');

    }

    public function feeinstalmentdates()
    {
        return FeeHeadInstallment::query()->record()->orderBy('start_date','asc')
            ->groupBy(DB::raw('YEAR(start_date)'), DB::raw('MONTH(start_date)'))->get(['start_date']);
    }

}
