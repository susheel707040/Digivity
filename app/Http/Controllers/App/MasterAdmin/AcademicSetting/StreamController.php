<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\AcademicSetting\StreamRequest;
use App\Models\MasterAdmin\AcademicSetting\Stream;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    public function index()
    {
        $stream=Stream::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-stream',compact('stream'));
    }

    public function store(StreamRequest $request)
    {
        Stream::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success','Record Save Successful Complete');
    }

    public function editview(Stream $stream)
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-stream',compact('stream'));
    }

    public function modify(Stream $stream,StreamRequest $request)
    {
        $stream->update($request->validated());
        session(['keyid' => 'editModels','url'=>'MasterAdmin/GlobalSetting/EditViewStream/'.$stream->id.'/edit']);
        return back()->with('success','Record Update Successful Complete');
    }
}
