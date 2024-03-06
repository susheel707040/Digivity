<?php

namespace App\Models;

use App\Models\Record;

class FileUploader extends Record
{
    protected $table="file_upload_record";
    protected $fillable=[
        'id',
        'file_name',
        'file_path',
        'user_id'
    ];
}
