<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Shoe;
use App\Models\ShoeModel;
use Illuminate\Http\Request;

class ShoeController extends Controller
{
    public function index()
    {
        $data = Shoe::all();
        return view('index', [
            'shoes' => $data
        ]);
    }

    public function home()
    {
        $data = Shoe::orderBy('created_at', 'desc')->take(8)->get();
        return view('home', [
            'shoes' => $data
        ]);
    }

    public function add()
    {
        $brand = Brand::with('shoeModels')->get();
        $model = ShoeModel::all();
        return view('shoes.add', [
            'brands' => $brand,
            'models' => $model
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'shoe_name' => 'required',
            'model' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data = new Shoe;
        $data->shoe_name = request()->shoe_name;
        $data->shoe_model_id = request()->model;
        $data->price = request()->price;
        $data->save();

        return redirect('/shoes')->with('info', 'Shoe Added');
    }

    public function edit($id)
    {
        $data = Shoe::find($id);
        return view('shoes.edit', compact('shoe'));
    }

    public function update($id)
    {
        $validator = validator(request()->all(), [
            'shoe_name' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data = Shoe::find($id);
        $data->shoe_name = request()->shoe_name;
        $data->price = request()->price;
        $data->save();

        return redirect('/shoes')->with('info', 'Shoe Updated');
    }


    public function detail($id)
    {
        $data = Shoe::find($id);
        return view('shoes.detail', [
            'shoe' => $data
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $shoes = Shoe::where('shoe_name', 'like', "%$query%")
            ->orWhereHas('shoeModel', function ($modelQuery) use ($query) {
                $modelQuery->where('name', 'like', "%$query%");
            })
            ->orWhereHas('shoeModel.brand', function ($brandQuery) use ($query) {
                $brandQuery->where('name', 'like', "%$query%");
            })
            ->get();

        // Pass the results to a view or return as needed
        return view('search-results', ['query' => $query, 'shoes' => $shoes]);
    }
}
