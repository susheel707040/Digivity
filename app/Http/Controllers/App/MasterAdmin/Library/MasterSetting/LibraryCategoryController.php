<?php

namespace App\Http\Controllers\App\MasterAdmin\Library\MasterSetting;

use App\Helper\SMSFailure;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Library\LibraryCategoryRequest;
use App\Models\MasterAdmin\Library\LibraryCategory;
use App\Repositories\MasterAdmin\Library\LibraryRepositories;


class LibraryCategoryController extends Controller
{
    public function index()
    {
        $itemcateory=(new LibraryRepositories())->libraryitemcategorylist();
        return view('app.erpmodule.MasterAdmin.Library.MasterSetting.define-category',compact(['itemcateory']));
    }

    public function store(LibraryCategoryRequest $request)
    {
        try {

            session(['keyid' => 'addModels','url'=>'0']);
            LibraryCategory::create($request->validated());
            return back()->with('success','Record Save Successful Complete');

        }catch (\Exception $e){
            SMSFailure::ExceptionHandlerEmail($e->getMessage());
            return back()->with('danger','sorry, do not permission to create this record');
        }
    }

    public function editview(LibraryCategory $libraryCategory)
    {
        return view('erpmodule.MasterAdmin.Library.MasterSetting.Edit.edit-category',compact(['libraryCategory']));
    }

    public function modify(LibraryCategory $libraryCategory,LibraryCategoryRequest $request)
    {
        try {

            session(['keyid' => 'editModels','url'=>'/MasterAdmin/Library/EditViewItemCategory/'.$libraryCategory->id.'/editview']);
            $libraryCategory->update($request->validated());
            return back()->with('success','Record Update Successful Complete');

        }catch (\Exception $e){
            SMSFailure::ExceptionHandlerEmail($e->getMessage());
            return back()->with('danger','sorry, do not permission to create this record');
        }
    }
}
