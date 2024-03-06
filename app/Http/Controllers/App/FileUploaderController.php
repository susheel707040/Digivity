<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class FileUploaderController extends Controller
{
    public function index(Request $request)
    {
        /**
         *image upload in storage
         */
        $data=[];
        if (request()->hasFile('file')) {
            $image = time() . '_' . $request->file('file')->getClientOriginalName();
            $path = $request->filepath;
            $request->file('file')->move(base_path('public/').$path, $image);
            $data['file_name'] =$request->file('file')->getClientOriginalName();
            $data['file_path'] =$path.$image;
        }
        $fileuploader=FileUploader::create($data);
        return response()->json([
            'status' => 'ok',
            'path' => $data['file_path'],
            'file_name'=>$data['file_name'],
            'fileid'=>$fileuploader->id
        ]);
    }

    public function getfile($folderid,$filename)
    {
        $path = storage_path("public/".$folderid."/".$filename);
        //dd($path);
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
