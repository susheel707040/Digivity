<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\FileTbl;
use App\Models\ReqCat;
use App\Models\ReqType;
use Illuminate\Http\Request;
use Image;

class CommonController extends Controller
{

    // public function uploadFile(Request $request, $fileName, $path)
    // {
    //     $imageName = '';
    //     if ($request->hasFile($fileName)) :
    //         $image = $request->file($fileName);
    //         $fileType = request()->$fileName->getClientOriginalExtension();
    //         $imageName = time() . '-' . random_int(1000000, 9999999) . '.' . $fileType;
    //         if ($fileType == 'JPG' || $fileType == 'jpg' || $fileType == 'PNG' || $fileType == 'png' || $fileType == 'jpeg' || $fileType == 'JPEG' || $fileType == 'svg') {
    //             $destinationPath = public_path($path);
    //             $img = Image::make($image->getRealPath());
    //             $img->resize(800, 800, function ($constraint) {
    //                 $constraint->aspectRatio();
    //             })->save($destinationPath . '/' . $imageName);
    //         }
    //         $imageName = $path . '/' . $imageName;
    //     endif;
    //     return $imageName;
    // }
}
