<?php


namespace App\Repositories\MasterAdmin\Communication;

use App\Models\MasterAdmin\Communication\CommunicationSMSRecord;
use App\Models\MasterAdmin\Communication\CommunicationType;
use App\Models\MasterAdmin\Communication\EmailTemplate;
use App\Models\MasterAdmin\Communication\FixHeaderFooter;
use App\Models\MasterAdmin\Communication\PhoneBookContact;
use App\Models\MasterAdmin\Communication\PhoneBookGroup;
use App\Models\MasterAdmin\Communication\SMSTemplate;
use App\Models\MasterAdmin\Communication\UserSMSCopy;
use App\Repositories\MasterAdmin\RepositoryContract;

class CommunicationRepository extends RepositoryContract
{
    public function comunicationtypelist()
    {
        return CommunicationType::query()->record()->get();
    }

    public function fixheaderfooterlist()
    {
        return FixHeaderFooter::query()->record()->get();
    }

    public function usersmscopylist()
    {
        return UserSMSCopy::query()->where(['status'=>'active'])->record()->get();
    }

    public function smstemplate()
    {
        return SMSTemplate::query()->record()->get();
    }

    public function phonebookgrouplist()
    {
       return PhoneBookGroup::query()->record()->get();
    }

    public function phonebookcontactlist()
    {
      return PhoneBookContact::query()->record()->get();
    }

    public function smstemplatelist($search)
    {
        if(empty($search)){$search=[];}
        return SMSTemplate::query()->search($search)->record()->get();
    }

    public function emailtemplatelist($search=null)
    {
        if(empty($search)){$search=[];}
        return EmailTemplate::query()->where($search)->record()->get();
    }

    public function communicationsmsreport($search=null,$relation=null)
    {
        return CommunicationSMSRecord::query()->search($search)->with(['communicationtype'])->record()->get();
    }
}
