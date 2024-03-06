<?php

namespace App\Http\Controllers\App\MasterAdmin\Library\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Library\AuthorRequest;
use App\Models\MasterAdmin\Library\Author;
use App\Repositories\MasterAdmin\Library\LibraryRepositories;
use Illuminate\Http\Request;

class LibraryAuthorController extends Controller
{
    public function index()
    {
        $alias = (new LibraryRepositories())->authorlist();
        return view('app.erpmodule.MasterAdmin.Library.MasterSetting.define-author', compact(['alias']));
    }

    public function store(AuthorRequest $request)
    {
        try {

            session(['keyid' => 'addModels', 'url' => '0']);
            Author::create($request->validated());
            return back()->with('success', 'Record Save Successful Complete');

        } catch (\Exception $e) {
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

    public function editview(Author $author)
    {
        return view('erpmodule.MasterAdmin.Library.MasterSetting.Edit.edit-author', compact(['author']));
    }

    public function modify(Author $author, AuthorRequest $request)
    {
        try {

            session(['keyid' => 'editModels', 'url' => '/MasterAdmin/Library/EditViewAuthor/' . $author->id . '/editview']);
            $author->update($request->validated());
            return back()->with('success', 'Record Update Successful Complete');

        } catch (\Exception $e) {
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }
}
