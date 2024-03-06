<?php

namespace App\Exports;

use App\Models\MasterAdmin\GlobalSetting\DynamicReportSetting;
use http\Env\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelFile implements FromView
{
    protected $tabledata;
    protected $colspan;

    function __construct($tabledata,$colspan) {
        $this->tabledata = $tabledata;
        $this->colspan=$colspan;
    }
    public function view(): View
    {
        $schoolname="";
        $schooladdress="";
        return view('app.Print.export-excel',['data'=>$this->tabledata,'colspan'=>$this->colspan,'schoolname'=>$schoolname,'schooladdress'=>$schooladdress]);
    }
}
