<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::select('id', 'name')->get();
        return response()->json(['categories' => $categories]);
    }


    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->input('category_name')
        ]);

        return response()->json(['success' => 'Category created successfully'], 201);
    }
}
