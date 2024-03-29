<?php


namespace App\Models;


use App\Helper\NewEloquentBuilder;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;


class Record extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($model) {
            $user = auth()->user();
            if ($user) {
            if (in_array('school_id', $model->fillable))
                $model->school_id = $user->school_id;

            if (in_array('branches_id', $model->fillable))
                $model->branches_id = $user->branches_id;

            if (in_array('academic_id', $model->fillable))
                $model->academic_id =  $user->academic_id;

            if (in_array('financial_id', $model->fillable))
                $model->financial_id = $user->financial_id;

            if (in_array('user_id', $model->fillable))
                $model->user_id = $user->id;

            if (in_array('start_date', $model->fillable))
                $model->start_date = Carbon::createFromDate($model->start_date)->format('Y-m-d');

            if (in_array('end_date', $model->fillable))
                $model->end_date = Carbon::createFromDate($model->end_date)->format('Y-m-d');

            if (in_array('dob', $model->fillable))
                $model->dob = Carbon::createFromDate($model->dob)->format('Y-m-d');

            if (in_array('admission_date', $model->fillable))
                $model->admission_date = Carbon::createFromDate($model->admission_date)->format('Y-m-d');
            }
        });

        static::updating(function ($model) {

            if (in_array('start_date', $model->fillable))
                $model->start_date = Carbon::createFromDate($model->start_date)->format('Y-m-d');

            if (in_array('end_date', $model->fillable))
                $model->end_date = Carbon::createFromDate($model->end_date)->format('Y-m-d');

        });

    }

    public function scopeRecord($query)
    {
        $table=$this->getTable();
        /**
         * table get school_id,branch_id,academic_id,finance_id
         */

        if (in_array('school_id', $this->fillable))
            $query = $query->where($table.'.school_id', auth()->user()->school_id);

        if (in_array('branches_id', $this->fillable))
            $query = $query->where($table.'.branches_id', auth()->user()->branches_id);

        if (in_array('academic_id', $this->fillable))
            $query = $query->where($table.'.academic_id', auth()->user()->academic_id);

        if (in_array('financial_id', $this->fillable))
            $query = $query->where($table.'.financial_id', auth()->user()->financial_id);

        return $query;
    }

    public function newEloquentBuilder($query)
    {
        return new NewEloquentBuilder($query);
    }
    
}
