<?php

namespace App;

use App\Models\Record;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Record
{
    /**
     * Fill ables
     *
     * @var array
     */
    protected $fillable = [
        'name', 'alias'
    ];

    /**
     * Get user associated with role
     *
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
