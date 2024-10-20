<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\CashierRequest;
use App\Models\Address;
use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        DB::beginTransaction();
        try {
            $user = User::create([
                'role' => UserRole::CASHIER,
                'remember_token' => Str::random(10),
                'password' => Hash::make('password'),
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'middle_name' => $request->input('middle_name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
            ]);

            Address::create([
                'user_id' => $user->id,
                'street' => $request->input('street'),
                'barangay' => $request->input('barangay'),
                'city' => $request->input('city'),
                'province' => $request->input('province')
            ]);

            DB::commit();
            return response()->json(['success' => 'Cashier created successfully!'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e], 400);
        }
    }
    public function edit() {}

    public function update() {}

    public function delete() {}
}
