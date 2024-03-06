<?php

namespace App\Http\Controllers\App\MasterAdmin\Staff\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Staff\SkillAndKnowledgeRequest;
use App\Models\MasterAdmin\Staff\SkillAndKnowledge;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use Illuminate\Http\Request;

class SkillAndKnowledgeController extends Controller
{
    public function index()
    {
        $skillandknowledge = (new StaffRepositories())->staffskillandknowledgelist();
        return view('app.erpmodule.MasterAdmin.Staff.MasterSetting.define-skill-and-knowledge', compact('skillandknowledge'));
    }

    public function store(SkillAndKnowledgeRequest $request)
    {
        SkillAndKnowledge::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success', 'Record Create Successful Complete');
    }

    public function editview(SkillAndKnowledge $skillandknowledge)
    {
        return view('app.erpmodule.MasterAdmin.Staff.MasterSetting.edit.edit-skill-and-knowledge',compact('skillandknowledge'));
    }

    public function modify(SkillAndKnowledge $skillandknowledge, SkillAndKnowledgeRequest $request)
    {
        $skillandknowledge->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/Staff/EditViewSkillAndKnowledge/' . $skillandknowledge->id . '/editview']);
        return back()->with('success', 'Record Update Successful Complete');
    }
}
