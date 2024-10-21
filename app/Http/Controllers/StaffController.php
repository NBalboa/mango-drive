<?php

namespace App\Http\Controllers;

use App\Enums\IsDeleted;
use App\Enums\UserRole;
use App\Http\Requests\StaffRequest;
use App\Http\Requests\UpdateStaffRequest;
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
        $staffs  = User::with('addresses')->notDeleted()->staffs()->get();
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

    public function edit(User $staff)
    {
        $address = Address::where('user_id', $staff->id)->first();
        return view('Admin.staff-edit', [
            'ADMIN' => UserRole::ADMIN->value,
            'CASHIER' => UserRole::CASHIER->value,
            'RIDER' => UserRole::RIDER->value,
            'address' => $address,
            'staff' => $staff
        ]);
    }

    public function update(UpdateStaffRequest $request, User $staff)
    {
        $staff->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'middle_name' => $request->input('middle_name'),
        ]);

        $address = Address::where('user_id', $staff->id)->first();

        $address->update([
            'street' => $request->input('street'),
            'barangay' => $request->input('barangay'),
            'city' => $request->input('city'),
            'province' => $request->input('province')
        ]);

        return response()->json(['success' => 'Staff updated successfully'], 201);
    }


    public function profile(User $staff)
    {
        $address = Address::address($staff->id);
        return view('Admin.staff-profile', [
            'ADMIN' => UserRole::ADMIN->value,
            'CASHIER' => UserRole::CASHIER->value,
            'RIDER' => UserRole::RIDER->value,
            'staff' => $staff,
            'address' => $address
        ]);
    }

    public function delete(User $staff)
    {
        $staff->is_deleted = IsDeleted::YES->value;
        $staff->save();
        return redirect()->route('staffs.index');
    }
}
