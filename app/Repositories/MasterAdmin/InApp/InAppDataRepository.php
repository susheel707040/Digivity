<?php


namespace App\Repositories\MasterAdmin\InApp;


use App\Models\MasterAdmin\InApp\Assignment;
use App\Models\MasterAdmin\InApp\Calendar;
use App\Models\MasterAdmin\InApp\CalendarType;
use App\Models\MasterAdmin\InApp\Download;
use App\Models\MasterAdmin\InApp\Homework;
use App\Models\MasterAdmin\InApp\Notice;
use App\Models\MasterAdmin\InApp\Syllabus;
use App\Repositories\MasterAdmin\RepositoryContract;

class InAppDataRepository extends RepositoryContract
{
    public function homeworklist($search=null,$relation=null)
    {
        return Homework::query()->search($search)->with(['course','section','attachment','user'])->record()->get();
    }

    public function noticelist($search=null,$relation=null)
    {
        return Notice::query()->search($search)->with(['course','section','student','staff','attachment','user'])->record()->get();
    }

    public function downloadlist($search=null,$relation=null)
    {
        return Download::query()->search($search)->record()->get();
    }

    public function assignmentlist($search=null,$relation=null)
    {
        return Assignment::query()->search($search)->with(['course','section','subject','attachment','user'])->record()->get();
    }

    public function syllabuslist($search=null,$relation=null)
    {
        return Syllabus::query()->search($search)->with(['course','subject','attachment','user'])->record()->get();
    }

    public function calendartypelist($search=null,$relation=null)
    {
        return CalendarType::query()->search($search)->orderBy('priority','asc')->record()->get();
    }

    public function calendarlist($search=null,$relation=null)
    {
        return Calendar::query()->search($search)->with(['calendartype'])->record()->get();
    }
}
