<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function add()
    {
        $data = Brand::all();
        return view('brands.add_brand');
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'brand_name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data = new Brand;
        $data->name = request()->brand_name;
        $data->save();

        return redirect('/brands/add')->with('info', 'Brand Added');
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return back()->with('info', 'Brand Deleted');
    }
    public function dashboard()
    {
        $data = Brand::all();
        return view('brands.brand_dashboard', ['brands' => $data]);
    }
}
