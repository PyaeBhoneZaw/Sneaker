<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Shoe;
use App\Models\ShoeModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function add()
    {
        $brand = Brand::with('shoeModels')->get();
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
            'model_name' => ['required', 'unique:shoe_models'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data = new ShoeModel;
        $data->model_name = request()->model_name;
        $data->brand_id = request()->brand;
        $data->save();

        return back()->with('info', 'Model Added');
    }


    public function delete($id)
    {
        $shoeModel = ShoeModel::find($id);
        $brand = $shoeModel->brand;

        if ($brand) {
            return back()->withErrors('There is a related brand. Cannot Delete');
        }

        $shoeModel->delete();
        return back()->with('info', 'Model Deleted');
    }

    public function dashboard()
    {
        $data = ShoeModel::all();
        return view('shoe_models.model_dashboard', ['models' => $data]);
    }
}
