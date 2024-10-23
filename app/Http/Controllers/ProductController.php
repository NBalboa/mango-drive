<?php

namespace App\Http\Controllers;

use App\Enums\IsAvailable;
use App\Enums\IsQuantity;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductAvailableRequest;
use App\Http\Requests\UpdateRequestProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('category', 'stock')->notDeleted()->get();
        $IS_QUANTITY = IsQuantity::YES->value;
        $IS_AVAILABLE = IsAvailable::YES->value;
        return view('Admin.product', [
            'products' => $products,
            'IS_QUANTITY' => $IS_QUANTITY,
            'IS_AVAILABLE' => $IS_AVAILABLE
        ]);
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
                'quantity' => 'required|numeric',
                'supplier' => 'required|numeric'
            ]);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product/images', 'public');
        }

        DB::beginTransaction();
        try {
            $product = Product::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category'),
                'sold_by_quantity' => ($request->input('sold_by_quantity') === "on" ? IsQuantity::YES->value : IsQuantity::NO->value),
                'image' => $path
            ]);

            if ($sold_by_quantity === "on") {
                Stock::create([
                    'supplier_id' => $request->input('supplier'),
                    'product_id' => $product->id,
                    'quantity' => $request->input('quantity')
                ]);
            }

            DB::commit();
            return response()->json(['success' => 'Product created successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e], 400);
        }
    }

    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();
        $suppliers = Supplier::select('id', 'name')->get();

        $stock = $product->stock()->first();
        $supplier = null;
        if ($stock) {
            $supplier = $stock->supplier()->first();
        }

        return view('Admin.product-edit', [
            'product' => $product,
            'categories' => $categories,
            'suppliers' => $suppliers,
            'p_supplier' => $supplier
        ]);
    }
    public function update(UpdateRequestProduct $request, Product $product)
    {

        $stock = $product->stock()->first();
        if ($stock) {
            $request->validate([
                'supplier' => 'required|numeric'
            ]);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product/images', 'public');
            $product->image = $path;
            $product->save();
        }

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category'),
        ]);
        if ($stock) {
            $stock->update([
                'supplier_id' => $request->input('supplier'),
            ]);
        }


        return response()->json(['success' => 'Product updated successfully'], 201);
    }

    public function profile(Product $product)
    {
        $IS_QUANTITY = IsQuantity::YES->value;
        $IS_AVAILABLE = IsAvailable::YES->value;
        $category = $product->category()->get()->first();
        $stock = $product->stock()->with('supplier')->first();
        return view('Admin.product-profile', [
            'product' => $product,
            'category' => $category,
            'stock' => $stock,
            'IS_QUANTITY' => $IS_QUANTITY,
            'IS_AVAILABLE' => $IS_AVAILABLE,
        ]);
    }


    public function updateAvailabity(UpdateProductAvailableRequest $request, Product $product)
    {
        $product->is_available = $request->input('state') === 'true' ? IsAvailable::YES->value : IsAvailable::NO->value;
        $product->save();
        return response()->json(['success' => 'Availability updated successfully'], 201);
    }
}
