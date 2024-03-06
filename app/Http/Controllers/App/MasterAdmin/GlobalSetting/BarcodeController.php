<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterAdmin\Library\Book;

class BarcodeController extends Controller
{
    public function index($for)
    {
        if($for=="library"){
            return view('app.erpmodule.MasterAdmin.Library.MasterSetting.generate-barcode');
        }
    }

    public function barcodeprint(Request $request)
    {
        //dd($request->all());
        $search=[];
        if(isset($request->db_model_search)){
            $search=unserialize($request->db_model_search);
        }
        $barcode="";
        $barcodetemplate="";
        $datas=$request->db_model::query()->whereIn('id',explode(",",$request->db_ids))->search($search)->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.Barcode.barcode-print',compact(['datas','barcode','barcodetemplate']));
    }
}
