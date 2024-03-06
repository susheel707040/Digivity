<?php

namespace App\Http\Controllers\App\MasterAdmin\Library\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Library\TagRequest;
use App\Models\MasterAdmin\Library\Tag;
use App\Repositories\MasterAdmin\Library\LibraryRepositories;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tag=(new LibraryRepositories())->taglist();
        return view('app.erpmodule.MasterAdmin.Library.MasterSetting.define-tag',compact(['tag']));
    }

    public function store(TagRequest $request)
    {
        try {

            session(['keyid' => 'addModels', 'url' => '0']);
            Tag::create($request->validated());
            return back()->with('success','Record Update Successful Complete');

        }catch (\Exception $e){
            return back()->with('danger','sorry, do not permission to create this record');
        }
    }

    public function editview(Tag $tag)
    {
        return view('erpmodule.MasterAdmin.Library.MasterSetting.Edit.edit-tag',compact(['tag']));
    }

    public function modify(Tag $tag,TagRequest $request)
    {

        try {

            session(['keyid' => 'editModels','url'=>'/MasterAdmin/Library/EditViewTag/'.$tag->id.'/editview']);
            $tag->update($request->validated());
            return back()->with('success','Record Update Successful Complete');

        }catch (\Exception $e){
            return back()->with('danger','sorry, do not permission to create this record');
        }

    }
}
