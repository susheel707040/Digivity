<?php

namespace App\Models\MasterAdmin\Communication;

use App\Models\Record;

class UserSMSCopy extends Record
{
    protected $table="communication_user_sms_copy_table";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'designation',
        'name',
        'gender',
        'mobile_no',
        'email_id',
        'note',
        'status',
        'user_id'
    ];

    /*
     * Table Relation function
     */
    public function contactnoid()
    {
        return $this->mobile_no."_usercopy_".$this->id;
    }
    /**
     * parameter define to dynamic replace text sms and email value
     * @return array
     */
    public function parameters()
    {
        return [
            '---id---' => $this->contactnoid(),
            '{Designation}'=>$this->designation,
            '{FullName}' => $this->name,
            '{Gender}'=>ucwords($this->gender),
            '{ContactNo}'=>$this->mobile_no,
            '{Email}'=>$this->email_id,
            '{NowDate}' => nowdate('', 'd-M-Y'),
            '{NowDateTime}' => nowdate('', 'd-M-Y H:i:s'),
            '{Username}'=>'n/a',
            '{Psw}'=>'n/a'
        ];
    }

}
