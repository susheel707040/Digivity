<?php

namespace App\Http\Controllers\MasterAdmin\Admission;

use App\Helper\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentPhotoController extends Controller
{
    use FileUpload;
    /*
     * Mobile App Student Photo Store
     */
    public function appstorephoto(Request $request)
    {
        $data=$request->all();
        if((isset($data['imageFile']))&&($data['DB_ID'])){
            $studentid=$data['DB_ID'];

            //find student
            $student=StudentRecord::find($studentid);

            //image upload and get file id
            $fileresult=$this->upload($data['imageFile'],['base64'=>true,'integrate'=>'student','db_id'=>$student->id]);

            /*
             * Student Update Profile Picture
             */
            $student->update(['profile_img'=>$fileresult['file_id']]);
            /*
             * User Profile Picture Update
             */
            $user=User::find($student->ac_user_id);
            if($user) {
                $user->update(['profile_img' => $fileresult['file_id']]);
            }
            if(($student)&&($user)){
                return response()->json([
                    'result' => 1,
                    'message' => 'data found',
                    'success' => null
                ],200);
            }
        }

        return response()->json([
            'result' => 0,
            'message' => 'data not found'
        ],400);

    }
}
