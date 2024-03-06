<?php


namespace App\Helper;

use App\Models\FileStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait FileUpload
{

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public static function upload($filerequest,$parameters = null)
    {
        /*
         * Auth check if auth enable
         */
        $userid = 1;
        if (auth()->user()) {$userid = auth()->user()->id;}
        /*
         * DB Id
         */
        $db_id=0;
        if(isset($parameters['db_id'])){
          $db_id=$parameters['db_id'];
        }
        /*
         * Integrate id
         */
        $integrate="file";
        if(isset($parameters['integrate'])){
            $integrate=$parameters['integrate'];
        }

        //File Extension
        $extension=".jpg";
        if(isset($parameters['extension'])&&($parameters['extension'])){
         $extension=$parameters['extension'];
        }

        //if file base 64 then converted and save
        if(isset($parameters['base64'])&&$parameters['base64']==true){
            //dd(getMimeType($filerequest));
            $image = str_replace('data:image/jpeg;base64,', '', $filerequest);
            $image = str_replace(' ', '+', $image);
            $FileName = $integrate.'_'.$db_id.'_'.time().rand().$extension;
            $FilePath=$integrate."/".$FileName;
            Storage::disk('public')->put($FilePath, base64_decode($image));
        }
        // else{
        //    $FileName=time()."-".$filerequest->getClientOriginalName();
        //    $extension=$filerequest->extension();
        //    $FilePath=$integrate."/".$FileName;
        //    Storage::disk('public')->put($FilePath,$filerequest->get());
        // }

        else{
            $FileName = time() . "-" . $filerequest->getClientOriginalName();
            $extension = $filerequest->extension();
            $FilePath = $integrate . "/" . $FileName;
            $destinationPath = 'profile_image';
            
            // Assuming $filerequest is an instance of UploadedFile
            $filerequest->move(public_path($destinationPath), $FileName);
            
           
     
        }

        /*
         * File Storage Entry
         */
        $data = [
            'integrate_id' => 'student',
            'storage' => 'local',
            'file_name' => $FileName,
            'extension' => $extension,
            'file_size' => null,
            'file_path' => $FilePath,
            'base64' => null,
            'cloud_id' => null,
            'user_id' => $userid,
        ];
        $filestorage = FileStorage::create($data);
        if ($filestorage) {
            return [
                'file_id'=>$filestorage->id,
                'file_name'=>$FileName,
                'file_extension'=>$extension
            ];
        }
        return 0;
    }
}
