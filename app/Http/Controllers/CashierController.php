<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashierRequest;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        return view('Admin.cashier');
    }
    public function create()
    {
        return view('Admin.cashier-create');
    }
    public function store(CashierRequest $request)
    {
        return response()->json(['success' => 'Cashier created successfully!'], 201);
    }
    public function edit() {}

    public function update() {}

    public function delete() {}
}
