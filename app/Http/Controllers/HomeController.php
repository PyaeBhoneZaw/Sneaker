<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ShoeController;
use App\Models\Shoe;

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
        // $shoes = session('shoes', collect()); // Use 'collect()' as a fallback if 'shoes' is not set
        $data = Shoe::orderBy('created_at', 'desc')->take(8)->get();
        return view('home', ['shoes' => $data]);
    }
}
