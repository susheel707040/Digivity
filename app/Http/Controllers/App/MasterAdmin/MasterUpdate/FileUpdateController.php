<?php

namespace App\Http\Controllers\App\MasterAdmin\MasterUpdate;

use App\Helper\FileUpload;
use App\Helper\FileUrl;
use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use Illuminate\Http\Request;

class FileUpdateController extends Controller
{
    use FileUpload;
    public function fileupdate(Request $request)
    {
        // return $request;

        $integrate="file";
        if(isset($request->integrate)){
            $integrate=$request->integrate;
        }
        //get Student
        if(isset($request->model)) {
            $modelname=new $request->model;
            $model = $modelname::find($request->model_id);
            if ($model) {
                //file upload in server
                $fileupload = $this->upload($request->file('profile_img'), ['integrate' => 'student']);
                if (isset($fileupload['file_id']) && ($fileupload['file_id'])) {
                    $model->update([$request->model_column => $fileupload['file_id']]);
                    if ($model) {
                        return response()->json([
                            'result' => 1,
                            'profilepath' => FileUrl::filepath($fileupload['file_id']),
                            'message' => 'File Update Successful Complete.'
                        ], 200);
                    }
                }
            }
            return response()->json([
                'result' => 0,
                'message' => 'Sorry,Request failed,Please try again.'
            ], 200);
        }
        return response()->json([
            'result' => 0,
            'message' => 'Sorry,Model Missing, Please Contact Digi Shiksha Team'
        ], 200);
    }
}
