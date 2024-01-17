<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Shoe;
use App\Models\ShoeModel;
use Illuminate\Database\Eloquent\Model;
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
        $shoes = Shoe::whereHas('shoeModel', function ($query) use ($id) {
            $query->where('brand_id', $id);
        })->get();

        if ($shoes->isNotEmpty()) {
            return back()->withErrors('There are related shoes. Cannot Delete');
        }

        $brand = Brand::find($id);

        if ($brand) {
            $brand->delete();
            return back()->with('info', 'Brand Deleted');
        } else {
            return back()->withErrors('Brand not found');
        }
    }


    public function dashboard()
    {
        $data = Brand::all();
        return view('brands.brand_dashboard', ['brands' => $data]);
    }
}
