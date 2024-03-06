<?php

namespace App\Http\Controllers\App\Exports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class ExportPdfController extends Controller
{
    public function exportviewpdf(Request $request)
    {
        $data =$request->tabledata;
        $pdf = PDF::loadView('app.Print.export-pdf', compact('data'))->setPaper('A4');
        return $pdf->download('itsolutionstuff.pdf');
    }
}
