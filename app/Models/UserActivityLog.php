<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    public $timestamps = false;
    protected $table="user_activity_log";
    protected $fillable=[
        'id',
        'user_id',
        'logs',
        'activity_status',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
