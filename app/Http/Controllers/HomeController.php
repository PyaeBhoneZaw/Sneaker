<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ShoeController;
use App\Models\Shoe;
use App\Models\Brand;
use App\Models\ShoeModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $data = Shoe::orderBy('created_at', 'desc')->take(8)->get();
        // return view('home', ['shoes' => $data]);

        $nikeShoe = Shoe::where('shoe_model_id', 1)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $jordanShoe = Shoe::where('shoe_model_id', 7)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();


        return view('home', ['nikeShoes' => $nikeShoe, 'ajShoes' => $jordanShoe]);
    }
}
