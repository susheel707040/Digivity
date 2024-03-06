<?php

namespace App\Http\Controllers\App\MasterAdmin\Library\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Library\LibraryRequest;
use App\Models\MasterAdmin\Library\Library;
use App\Repositories\MasterAdmin\Library\LibraryRepositories;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        $library=(new LibraryRepositories())->librarylist();
        return view('app.erpmodule.MasterAdmin.Library.MasterSetting.define-library',compact(['library']));
    }

    public function store(LibraryRequest $request)
    {
        try {

            session(['keyid' => 'addModels','url'=>'0']);
            Library::create($request->all());
            return back()->with('success','Record Save Successful Complete');

        }catch (\Exception $e){
            return back()->with('danger','sorry, do not permission to create this record');
        }
    }

    public function editview(Library $library)
    {
        return view('erpmodule.MasterAdmin.Library.MasterSetting.Edit.edit-library',compact(['library']));
    }

    public function modify(Library $library,LibraryRequest $request)
    {
        try {

            session(['keyid' => 'editModels','url'=>'/MasterAdmin/Library/EditViewLibrary/'.$library->id.'/editview']);
            $library->update($request->validated());
            return back()->with('success','Record Update Successful Complete');

        }catch (\Exception $e){
            return back()->with('danger','sorry, do not permission to create this record');
        }
    }
}
