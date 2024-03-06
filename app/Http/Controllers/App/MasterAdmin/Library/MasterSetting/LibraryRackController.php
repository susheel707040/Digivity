<?php

namespace App\Http\Controllers\App\MasterAdmin\Library\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Library\RacksRequest;
use App\Models\MasterAdmin\Library\Racks;
use App\Repositories\MasterAdmin\Library\LibraryRepositories;
use Illuminate\Http\Request;

class LibraryRackController extends Controller
{
    public function index()
    {
        $racks=(new LibraryRepositories())->rackslist();
        return view('app.erpmodule.MasterAdmin.Library.MasterSetting.define-racks',compact(['racks']));
    }

    public function store(RacksRequest $request)
    {
        try {

            session(['keyid' => 'addModels','url'=>'0']);
            Racks::create($request->validated());
            return back()->with('success','Record Save Successful Complete');

        }catch (\Exception $e){
            return back()->with('danger','sorry, do not permission to create this record');
        }
    }

    public function editview(Racks $racks)
    {
        return view('erpmodule.MasterAdmin.Library.MasterSetting.Edit.edit-racks',compact(['racks']));
    }

    public function modify(Racks $racks,RacksRequest $request)
    {
        try {

            session(['keyid' => 'editModels','url'=>'/MasterAdmin/Library/EditViewRacks/'.$racks->id.'/editview']);
            $racks->update($request->validated());
            return back()->with('success','Record Update Successful Complete');

        }catch (\Exception $e){
            return back()->with('danger','sorry, do not permission to create this record');
        }
    }
}
