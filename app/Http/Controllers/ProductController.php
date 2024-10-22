<?php

namespace App\Http\Controllers;

use App\Enums\IsQuantity;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        return view('Admin.product');
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $suppliers = Supplier::select('id', 'name')->get();

        return view('Admin.product-create', [
            'categories' => $categories,
            'suppliers' => $suppliers
        ]);
    }


    public function store(ProductRequest $request)
    {
        $sold_by_quantity = $request->input('sold_by_quantity');

        if ($sold_by_quantity === "on") {
            $request->validate([
                'quantity' => 'required|numeric'
            ]);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product/images', 'public');
        }

        DB::beginTransaction();
        try {
            Product::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category'),
                'supplier_id' => $request->input('supplier'),
                'quantity' => ($request->input('sold_by_quantity') === "on" ? $request->input('quantity') : null),
                'sold_by_quantity' => ($request->input('sold_by_quantity') === "on" ? IsQuantity::YES->value : IsQuantity::NO->value),
                'image' => $path
            ]);

            DB::commit();
            return response()->json(['success' => 'Product created successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e], 400);
        }
    }
}
