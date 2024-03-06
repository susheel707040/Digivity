<?php


namespace App\Repositories\MasterAdmin\StudentInformation;

use App\Models\MasterAdmin\Admission\StudentProspectus;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Repositories\MasterAdmin\RepositoryContract;

class StudentRepository extends RepositoryContract
{
    function IsNullOrEmptyString($str){
        return ($str === null || trim($str) === '');
    }
    public function studentshortlist($search = null, $addonrelation = null, $status = null)
    {
        $status = ['status' => 'active'];
        $sort_order_by_name = "";
        $sort_order_by_admisson_no = "";
        if (isset($search['status']) && ($search['status'] == 'inactive')) {
            $status = ['status' => 'inactive'];
        }

        if (isset($search['sortby'])) {
            $sort_by_field = explode("-", $search['sortby']);
            switch($sort_by_field[0]) {
                case "first_name":
                    $sort_order_by_name = $sort_by_field[1];
                break;
                case "admission_no":
                    $sort_order_by_admisson_no = $sort_by_field[1];
                break;
            }
        }
        $relation = ['student'];
        if ($addonrelation != null) {
            $relation = array_merge($relation, $addonrelation);
        }

        $student_data = StudentRecord::query()->where($status)->search($search, $relation)
        ->with([
            'student' => function($query) use ($sort_order_by_name) {
                if(!$this->IsNullOrEmptyString($sort_order_by_name)) {
                    return $query->orderBy('first_name', $sort_order_by_name);
                }
                return $query;
            },
            'course',
            'section',
            'feegroup'
        ]);

        if(!$this->IsNullOrEmptyString($sort_order_by_admisson_no)) {
            $student_data->orderBy('admission_no', $sort_order_by_admisson_no);
        }
        return $student_data->record()->get();
    }

    public function studentlonglist($search = null, $relation = null, $status = null)
    {
        $status = ['status' => 'active'];
        if (isset($status) && ($status == 'inactive')) {
            $status = ['status' => 'inactive'];
        }
        return StudentRecord::query()->where($status)->with(['student', 'course', 'section', 'feegroup', 'concession'])->record()->get();
    }

    public function studentcontactlist($search = null, $relation = null, $status = null)
    {
        $status = ['status' => 'active'];
        if (isset($status) && ($status == 'inactive')) {
            $status = ['status' => 'inactive'];
        }
        return StudentRecord::query()->where($status)->search($search)->with(['student', 'course', 'section'])->record()->get();
    }

    public function prospectuslist($search = null, $relation = null)
    {
        return StudentProspectus::query()->search($search)->with(['course'])->record()->get();
    }
}
