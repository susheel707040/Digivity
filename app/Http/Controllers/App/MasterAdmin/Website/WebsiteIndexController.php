<?php

namespace App\Http\Controllers\App\MasterAdmin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteIndexController extends Controller
{
    public function index()
    {
       return view('app.erpmodule.MasterAdmin.Website.index');
    }
}
