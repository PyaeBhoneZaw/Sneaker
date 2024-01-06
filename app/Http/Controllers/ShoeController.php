<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Shoe;
use App\Models\ShoeModel;
use Illuminate\Http\Request;

class ShoeController extends Controller
{


    public function __construct()
    {
        $this->middleware('admin')->only(['add', 'create']);
    }
    public function index()
    {
        $data = Shoe::latest()->paginate(12);
        return view('index', [
            'shoes' => $data
        ]);
    }
    public function dashboard()
    {
        $data = Shoe::all();
        return view('shoes.shoes_dashboard', ['shoes' => $data]);
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

    public function create(Request $request)
    {
        $validator = validator($request->all(), [
            'shoe_name' => 'required',
            'model' => 'required',
            'price' => 'required',
            'shoe_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data = new Shoe;
        $data->shoe_name = $request->shoe_name;
        $data->shoe_model_id = $request->model;
        $data->price = $request->price;

        if (request()->hasFile('shoe_image')) {
            $originalName = request()->file('shoe_image')->getClientOriginalName();
            $imgPath = request()->file('shoe_image')->storeAs('public/images/shoes', $originalName);
            $data->shoe_image = $imgPath;
        }

        $data->size = json_encode([3.5, 4, 4.5, 5, 5.5, 6, 6.5, 7, 7.5, 8, 8.5, 9, 9.5, 10, 10.5, 11, 11.5, 12, 12.5, 13, 14, 15, 16, 17, 18]);
        $data->save();

        return redirect('/shoes')->with('info', 'Shoe Added');
    }


    public function edit($id)
    {
        $data = Shoe::find($id);
        return view('/shoes', compact('shoe'));
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

    public function delete($id)
    {
        $shoe = Shoe::find($id);
        $shoe->delete();
        return back()->with('info', 'Shoe Deleted');
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
