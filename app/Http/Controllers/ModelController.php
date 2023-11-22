<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ShoeModel;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function add()
    {
        $brand = Brand::with('shoeModel')->get();
        $model = ShoeModel::all();
        return view('shoe_models.add_models', [
            'brands' => $brand,
            'models' => $model
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'brand' => 'required',
            'model_name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data = new ShoeModel;
        $data->name = request()->model_name;
        $data->brand_id = request()->brand;
        $data->save();

        return redirect('/brands/add')->with('info', 'Brand Added');
    }
}
