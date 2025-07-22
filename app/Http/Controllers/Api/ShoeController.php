<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shoe;
use App\Models\Brand;
use App\Models\ShoeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ShoeController extends Controller
{
    /**
     * Display a listing of shoes with pagination and filtering
     */
    public function index(Request $request)
    {
        $query = Shoe::with(['shoeModel.brand']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('shoe_name', 'like', "%{$search}%")
                  ->orWhereHas('shoeModel', function ($modelQuery) use ($search) {
                      $modelQuery->where('model_name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('shoeModel.brand', function ($brandQuery) use ($search) {
                      $brandQuery->where('brand_name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by brand
        if ($request->has('brand_id') && $request->brand_id) {
            $query->whereHas('shoeModel', function ($modelQuery) use ($request) {
                $modelQuery->where('brand_id', $request->brand_id);
            });
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by availability
        if ($request->has('in_stock') && $request->in_stock) {
            $query->where('stock_quantity', '>', 0);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        if (in_array($sortBy, ['shoe_name', 'price', 'stock_quantity', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $perPage = $request->get('per_page', 12);
        $shoes = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => [
                'shoes' => $shoes->items(),
                'pagination' => [
                    'current_page' => $shoes->currentPage(),
                    'last_page' => $shoes->lastPage(),
                    'per_page' => $shoes->perPage(),
                    'total' => $shoes->total(),
                    'from' => $shoes->firstItem(),
                    'to' => $shoes->lastItem(),
                ]
            ]
        ]);
    }

    /**
     * Store a newly created shoe
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shoe_name' => 'required|string|max:255|unique:shoes',
            'shoe_model_id' => 'required|exists:shoe_models,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'shoe_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sizes' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $shoe = new Shoe();
        $shoe->user_id = Auth::id();
        $shoe->shoe_name = $request->shoe_name;
        $shoe->shoe_model_id = $request->shoe_model_id;
        $shoe->price = $request->price;
        $shoe->stock_quantity = $request->stock_quantity;

        // Handle image upload
        if ($request->hasFile('shoe_image')) {
            $originalName = $request->file('shoe_image')->getClientOriginalName();
            $imagePath = $request->file('shoe_image')->storeAs('public/images/shoes', $originalName);
            $shoe->shoe_image = $imagePath;
        }

        // Handle sizes
        $sizes = $request->sizes ?? [3.5, 4, 4.5, 5, 5.5, 6, 6.5, 7, 7.5, 8, 8.5, 9, 9.5, 10, 10.5, 11, 11.5, 12, 12.5, 13, 14, 15, 16, 17, 18];
        $shoe->size = json_encode($sizes);

        $shoe->save();

        // Load relationships
        $shoe->load(['shoeModel.brand']);

        return response()->json([
            'success' => true,
            'message' => 'Shoe created successfully',
            'data' => $shoe
        ], 201);
    }

    /**
     * Display the specified shoe
     */
    public function show($id)
    {
        $shoe = Shoe::with(['shoeModel.brand'])->find($id);

        if (!$shoe) {
            return response()->json([
                'success' => false,
                'message' => 'Shoe not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $shoe
        ]);
    }

    /**
     * Update the specified shoe
     */
    public function update(Request $request, $id)
    {
        $shoe = Shoe::find($id);

        if (!$shoe) {
            return response()->json([
                'success' => false,
                'message' => 'Shoe not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'shoe_name' => 'sometimes|required|string|max:255|unique:shoes,shoe_name,' . $id,
            'shoe_model_id' => 'sometimes|required|exists:shoe_models,id',
            'price' => 'sometimes|required|numeric|min:0',
            'stock_quantity' => 'sometimes|required|integer|min:0',
            'shoe_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sizes' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update fields
        if ($request->has('shoe_name')) {
            $shoe->shoe_name = $request->shoe_name;
        }
        if ($request->has('shoe_model_id')) {
            $shoe->shoe_model_id = $request->shoe_model_id;
        }
        if ($request->has('price')) {
            $shoe->price = $request->price;
        }
        if ($request->has('stock_quantity')) {
            $shoe->stock_quantity = $request->stock_quantity;
        }

        // Handle image upload
        if ($request->hasFile('shoe_image')) {
            // Delete old image if exists
            if ($shoe->shoe_image) {
                Storage::delete($shoe->shoe_image);
            }

            $originalName = $request->file('shoe_image')->getClientOriginalName();
            $imagePath = $request->file('shoe_image')->storeAs('public/images/shoes', $originalName);
            $shoe->shoe_image = $imagePath;
        }

        // Handle sizes
        if ($request->has('sizes')) {
            $shoe->size = json_encode($request->sizes);
        }

        $shoe->save();

        // Load relationships
        $shoe->load(['shoeModel.brand']);

        return response()->json([
            'success' => true,
            'message' => 'Shoe updated successfully',
            'data' => $shoe
        ]);
    }

    /**
     * Remove the specified shoe
     */
    public function destroy($id)
    {
        $shoe = Shoe::find($id);

        if (!$shoe) {
            return response()->json([
                'success' => false,
                'message' => 'Shoe not found'
            ], 404);
        }

        // Delete image if exists
        if ($shoe->shoe_image) {
            Storage::delete($shoe->shoe_image);
        }

        $shoe->delete();

        return response()->json([
            'success' => true,
            'message' => 'Shoe deleted successfully'
        ]);
    }

    /**
     * Search shoes
     */
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keyword' => 'required|string|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $keyword = $request->keyword;

        $shoes = Shoe::with(['shoeModel.brand'])
            ->where('shoe_name', 'like', "%{$keyword}%")
            ->orWhereHas('shoeModel', function ($modelQuery) use ($keyword) {
                $modelQuery->where('model_name', 'like', "%{$keyword}%");
            })
            ->orWhereHas('shoeModel.brand', function ($brandQuery) use ($keyword) {
                $brandQuery->where('brand_name', 'like', "%{$keyword}%");
            })
            ->paginate(12);

        return response()->json([
            'success' => true,
            'data' => [
                'shoes' => $shoes->items(),
                'pagination' => [
                    'current_page' => $shoes->currentPage(),
                    'last_page' => $shoes->lastPage(),
                    'per_page' => $shoes->perPage(),
                    'total' => $shoes->total(),
                ]
            ]
        ]);
    }
}
