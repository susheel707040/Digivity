<?php

namespace App\Models\MasterAdmin\Communication;
use App\Models\Record;

class PhoneBookGroup extends Record
{
    protected $table = "communication_phonebook_group";
    protected $fillable = [
        'school_id',
        'branches_id',
        'phonebook_group',
        'status',
        'user_id'
    ];
}
