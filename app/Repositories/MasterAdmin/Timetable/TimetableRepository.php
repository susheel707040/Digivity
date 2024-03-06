<?php


namespace App\Repositories\MasterAdmin\Timetable;
use App\Models\MasterAdmin\Timetable\Timetable;
use App\Repositories\MasterAdmin\RepositoryContract;

class TimetableRepository extends RepositoryContract
{
    public function timetablelist($search)
    {
        return Timetable::query()->where($search)->record()->get();
    }
}
