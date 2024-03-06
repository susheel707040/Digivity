<?php

namespace App\Models\MasterAdmin\Communication;
use App\Models\Record;

class PhoneBookContact extends Record
{
    protected $table = "communication_phonebook";
    protected $fillable = [
        'school_id',
        'branches_id',
        'group_id',
        'title',
        'name',
        'gender',
        'contact_no',
        'email',
        'company',
        'designation',
        'status',
        'user_id'
    ];
}
