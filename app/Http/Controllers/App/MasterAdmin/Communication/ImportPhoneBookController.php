<?php

namespace App\Http\Controllers\App\MasterAdmin\Communication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImportPhoneBookController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Communication.PhoneBook.import-phonebook');
    }

    public function importphonebook()
    {

    }

    public function exportphonebook()
    {

    }
}
