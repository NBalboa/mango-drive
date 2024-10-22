<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index()
    {
        $suppliers = Supplier::select('id', 'name')->get();
        return response()->json(['suppliers' => $suppliers]);
    }

    public function store(SupplierRequest $request)
    {
        Supplier::create([
            'name' => $request->input('supplier_name')
        ]);

        return response()->json(['success' => 'supplier created successfully'], 201);
    }
}
