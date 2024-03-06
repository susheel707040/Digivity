<?php


namespace App\Helper;


use App\Models\FileStorage;
use App\Models\Tenant;
use Illuminate\Support\Facades\Storage;

class FileUrl
{
    public static function filepath($fileid)
    {
        $filestorage=FileStorage::find($fileid);
        if($filestorage){
           if($filestorage->storage=="local"){

            // Tenant::where()->first();
            $tenantId = tenant('id');
            $path = 'tenant'.$tenantId.'/app/public/';
               $filepath=Storage::disk('local')->url($path.$filestorage->file_path);
               if(!file_exists(base_path($filepath))){
                   return url('assets/images/no-file.png');
               }
               return url($filepath);
           }
        }
        return url('assets/images/no-file.png');
    }
}
