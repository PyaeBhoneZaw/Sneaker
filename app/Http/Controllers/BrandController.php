<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

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
            'brand_name' => ['required', 'unique:brands']
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data = new Brand;
        $data->brand_name = request()->brand_name;
        $data->save();

        return redirect('/brands/add')->with('info', 'Brand Added');
    }

    public function delete($id)
    {
        $shoe = Shoe::find($id);
        $brand = Brand::find($id);
        if ($shoe) {
            return back()->withErrors('There is a related shoe. Cannot Delete');
        }
        $brand->delete();
        return back()->with('info', 'Brand Deleted');
    }
    public function dashboard()
    {
        $data = Brand::all();
        return view('brands.brand_dashboard', ['brands' => $data]);
    }
}