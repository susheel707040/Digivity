<?php

namespace App\Http\Controllers\App\MasterAdmin\Transport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransportIndexController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.transport.index');
    }
}
