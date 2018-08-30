<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PagesRequest;
use App\Models\Pages;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index()
    {
        $pages = Pages::all();

        return view('admin.pages.list', ['pages' => $pages]);
    }

    public function create()
    {
        return view('admin.pages.edit');
    }

    public function store(PagesRequest $request)
    {
        Pages::create($request->all());
        return redirect()->route('pages.index');
    }

    public function edit($id)
    {
        $page = Pages::find($id);
        return view('admin.pages.edit', ['page' => $page]);
    }

    public function update(PagesRequest $request, $id)
    {
        $page = Pages::find($id);
        $page->update($request->all());
        return redirect()->route('pages.index');
    }

    public function destroy($id)
    {
        Pages::find($id)->delete();
        return redirect()->route('pages.index');
    }
}
