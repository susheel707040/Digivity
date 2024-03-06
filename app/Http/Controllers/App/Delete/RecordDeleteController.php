<?php

namespace App\Http\Controllers\App\Delete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use App\Models\MasterAdmin\InApp\Download;

class RecordDeleteController extends Controller
{
    public function destroy($id,$tbl)
    {
        return $tbl;
        if(auth::check())
        {
            $datetime = Carbon::now();
            DB::table($tbl)->where('id', $id)->update(['deleted_at' =>$datetime]);
            return back()->with('success','Record delete successful complete');
        }
       return back()->with('danger','Sorry, You are not authorised to delete this data');
    }
}
