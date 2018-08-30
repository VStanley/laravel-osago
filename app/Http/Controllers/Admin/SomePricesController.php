<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SomePricesRequest;
use App\Models\SomePrices;
use App\Http\Controllers\Controller;

class SomePricesController extends Controller
{
    public function index()
    {
        $somePrices = SomePrices::all();

        return view('admin.somePrices.edit', ['somePrices' => $somePrices]);
    }

    public function update(SomePricesRequest $request, $id)
    {
        $autoCategories = SomePrices::find($id);

        $autoCategories->update($request->all());
        return redirect()->route('somePrices.index');
    }
}
