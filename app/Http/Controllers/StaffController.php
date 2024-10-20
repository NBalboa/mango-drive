<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\StaffRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffController extends Controller
{

    public function index()
    {
        $staffs  = User::with('addresses')->staffs()->get();
        return view('Admin.staff', [
            'staffs' => $staffs,
            'ADMIN' => UserRole::ADMIN->value,
            'CASHIER' => UserRole::CASHIER->value,
            'RIDER' => UserRole::RIDER->value
        ]);
    }

    public function create()
    {
        return view('Admin.staff-create', [
            'ADMIN' => UserRole::ADMIN->value,
            'CASHIER' => UserRole::CASHIER->value,
            'RIDER' => UserRole::RIDER->value
        ]);
    }

    public function store(StaffRequest $request)
    {

        DB::beginTransaction();
        try {
            $user = User::create([
                'role' => $request->input('role'),
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
            return response()->json(['success' => 'Staff created successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e], 400);
        }
    }

    public function edit() {}

    public function update() {}

    public function delete() {}
}
