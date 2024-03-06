<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\AcademicSetting\CategoryRequest;
use App\Models\MasterAdmin\AcademicSetting\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category=Category::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-category',compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        session(['keyid'=>'addModels','url'=>0]);
        return back()->with('success','Record Save Successful Complete');
    }

    public function editview(Category $category)
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-category',compact('category'));
    }

    public function modify(Category $category,CategoryRequest $request)
    {
        $category->update($request->validated());
        session(['keyid' => 'editModels','url'=>'MasterAdmin/GlobalSetting/EditViewCategory/'.$category->id.'/edit']);
        return back()->with('success','Record Update Successful Complete');
    }
}
