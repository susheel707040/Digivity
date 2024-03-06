<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileStorage extends Model
{
    protected $table = "file_storage";
    protected $fillable = [
        'id',
        'integrate_id',
        'storage',
        'file_name',
        'extension',
        'file_size',
        'file_path',
        'base64',
        'cloud_id',
        'user_id'
    ];
}
