<?php

namespace App\Http\Controllers\App\MasterAdmin\Library\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Library\LibraryGenreRequest;
use App\Models\MasterAdmin\Library\LibraryGenre;
use App\Repositories\MasterAdmin\Library\LibraryRepositories;
use Illuminate\Http\Request;

class LibraryGenreController extends Controller
{
    public function index()
    {
        $genre=(new LibraryRepositories())->genrelist();
        return view('app.erpmodule.MasterAdmin.Library.MasterSetting.define-genre',compact(['genre']));
    }

    public function store(LibraryGenreRequest $request)
    {
        try {

            session(['keyid' => 'addModels','url'=>'0']);
            LibraryGenre::create($request->validated());
            return back()->with('success','Record Save Successful Complete');

        }catch (\Exception $e){
            return back()->with('danger','sorry, do not permission to create this record');
        }
    }

    public function editview(LibraryGenre $librarygenre)
    {
        return view('erpmodule.MasterAdmin.Library.MasterSetting.Edit.edit-genre',compact(['librarygenre']));
    }

    public function modify(LibraryGenre $librarygenre,LibraryGenreRequest $request)
    {
        try {

            session(['keyid' => 'editModels','url'=>'/MasterAdmin/Library/EditViewGenres/'.$librarygenre->id.'/editview']);
            $librarygenre->update($request->all());
            return back()->with('success','Record Update Successful Complete');
        }catch (\Exception $e){
            return back()->with('danger','sorry, do not permission to create this record');
        }
    }
}
