<?php


namespace App\Repositories\MasterAdmin\Staff;


use App\Models\MasterAdmin\Staff\Document;
use App\Models\MasterAdmin\Staff\ProfessionType;
use App\Models\MasterAdmin\Staff\SkillAndKnowledge;
use App\Models\MasterAdmin\Staff\StaffDepartment;
use App\Models\MasterAdmin\Staff\StaffDesignation;
use App\Models\MasterAdmin\Staff\StaffQualification;
use App\Models\MasterAdmin\Staff\StaffRecord;
use App\Models\MasterAdmin\Staff\StaffType;

class StaffRepositories
{

    public function professtiontypelist()
    {
        return ProfessionType::query()->record()->get();
    }

    public function stafftypelist()
    {
        return StaffType::query()->record()->get();
    }

    public static function staffdepartmentlist()
    {
        return StaffDepartment::query()->record()->get();
    }

    public function satffdesignationlist()
    {
        return StaffDesignation::query()->record()->get();
    }

    public function staffdocumentlist()
    {
        return Document::query()->record()->get();
    }

    public function staffqualificationlist()
    {
        return StaffQualification::query()->record()->get();
    }

    public function staffskillandknowledgelist()
    {
        return SkillAndKnowledge::query()->record()->get();
    }

    public function staffshortlist($search=null,$relation=null)
    {
        return StaffRecord::query()->search($search)->with(['department','designation','stafftype','professiontype','staffid'])->record()->get();
    }

}
