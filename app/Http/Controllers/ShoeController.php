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

    public function detail($id)
    {
        return "Controller Shoe Detail";
    }
}
