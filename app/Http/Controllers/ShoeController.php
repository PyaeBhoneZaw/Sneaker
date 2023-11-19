<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
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
        $data = [
            ["id" => 1, "name" => "Nike"],
            ["id" => 2, "name" => "Adidas"],
            ["id" => 3, "name" => "Air Jordan"]
        ];
        return view('shoes.add', [
            'brands' => $data
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
        $data->model_id = request()->model;
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
            'model' => 'required',
            'price' => 'required',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data = Shoe::find($id);
        $data->shoe_name = request()->shoe_name;
        $data->model_id = request()->model;
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
}
