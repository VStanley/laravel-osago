<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AutoCategoryRequest;
use App\Models\AutoCategories;
use App\Http\Controllers\Controller;

class AutoCategoriesController extends Controller
{
    public function index()
    {
        $autoCategories = AutoCategories::all();

        return view('admin.autoCategories.edit', [ 'autoCategories' =>  $autoCategories ]);
    }

    public function update(AutoCategoryRequest $request, $id)
    {
        $autoCategories = AutoCategories::find($id);

        $autoCategories->update($request->all());
        return redirect()->route('autoCategories.index');
    }

}
