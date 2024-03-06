<?php

namespace App\Helper;


use App\Models\MasterAdmin\Communication\UserSMSCopy;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;

class GetContactNumber
{
    public static function getcontactnumber($request)
    {
        $contactno = array();
        $parameters = array();
        /**
         * user duplicate copy get contact number
         */
        if (isset($request["usercopyid"])) {
            if (!is_array($request["usercopyid"])) {
                $usercopyids = explode(",", $request["usercopyid"]);
            } else {
                $usercopyids = $request["usercopyid"];
            }
            if (is_array($usercopyids)&&(count($usercopyids)>0)) {
                $duplicatecopy = UserSMSCopy::query()->whereIn('id',$usercopyids)->get();
                $usersmscopy = collect($duplicatecopy->map->contactnoid())->toArray();
                if ($usersmscopy) {
                    $parameters[] = collect($duplicatecopy->map->parameters());
                    $contactno[] = implode("-", $usersmscopy);
                }
            }
        }
        /**
         * course and section get contact number
         */
        if (isset($request["coursesectionid"])) {
            foreach ($request["coursesectionid"] as $coursesectionval) {
                $coursesection = explode("@", $coursesectionval);
                $course_id = $coursesection[0];
                $section_id = $coursesection[1];
                /**
                 * get student mobile number
                 */
                $studentdata = (new StudentRepository())->studentcontactlist(['course_id' => $course_id, 'section_id' => $section_id]);
                $studentcontactno = collect($studentdata->map->contactnoid())->toArray();
                if ($studentcontactno) {
                    $parameters[] = collect($studentdata->map->parameters());
                    $contactno[] = implode("-", $studentcontactno);
                }
            }
        }
        /**
         * student id to get contact number
         */
        if (isset($request["studentid"])) {
            if (!is_array($request["studentid"])) {
                $studentids = explode(",", $request["studentid"]);
            } else {
                $studentids = $request["studentid"];
            }
            if (is_array($studentids)&&(count($studentids)>0)) {
                $studentdata = (new StudentRepository())->studentcontactlist(['customsearch' => ['whereIn' => ['student_id' => $studentids]]]);
                $studentcontactno = collect($studentdata->map->contactnoid())->toArray();
                if ($studentcontactno) {
                    $parameters[] = collect($studentdata->map->parameters());
                    $contactno[] = implode("-", $studentcontactno);
                }
            }
        }

        /*
         * staff get contact number designation wise
         */
        if(isset($request['designationid'])&&(count($request['designationid'])>0)){
            $designationids=$request['designationid'];
            if(is_array($designationids)&&(count($designationids)>0)) {
                $staffdata = (new StaffRepositories())->staffshortlist(['customsearch' => ['whereIn' => ['designation_id' => $designationids]]]);
                $staffcontactno = collect($staffdata->map->contactnoid())->toArray();
                if ($staffcontactno) {
                    $parameters[] = collect($staffdata->map->parameters());
                    $contactno[] = implode("-", $staffcontactno);
                }
            }
        }
        /*
         * Staff get contact number satff id wise
         */
        if(isset($request['staffid'])){
            if (!is_array($request["staffid"])) {
                $staffids = explode(",", $request["staffid"]);
            } else {
                $staffids = $request["staffid"];
            }
            if (is_array($staffids)&&(count($staffids)>0)) {
                $staffdata = (new StaffRepositories())->staffshortlist(['customsearch' => ['whereIn' => ['id' => $staffids]]]);
                $staffcontactno = collect($staffdata->map->contactnoid())->toArray();
                if ($staffcontactno) {
                    $parameters[] = collect($staffdata->map->parameters());
                    $contactno[] = implode("-", $staffcontactno);
                }
            }
        }
        /*
         * phone book get contact number
         */

        /*
         * contact number direct pass
         */
        if (isset($request["contactno"])) {
            if (!is_array($request["contactno"])) {
                $contacttoarray = explode(",", $request["contactno"]);
                $contactno[] = implode('-', $contacttoarray);
            } else {
                $contactno[] = implode('-', $request["contactno"]);
            }
        }

        $datareturn = ['contactno' => explode('-', implode('-', $contactno)),
            'parameters' => $parameters];
        return $datareturn;
    }
}
