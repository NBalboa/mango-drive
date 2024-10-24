<x-layouts.admin>
    <x-content-header>Register Staff</x-content-header>
    <x-content>
        <div class="card card-default">
            <form id="createStaff" action="{{ route('staffs.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <x-form-group>
                        <x-form-label for='first_name'>First Name</x-form-label>
                        <x-form-input id="first_name" name='first_name' type='text' />
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='last_name'>Last Name</x-form-label>
                        <x-form-input id="last_name" name='last_name' type='text' />
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='middle_name'>Middle Name</x-form-label>
                        <x-form-input id="middle_name" name='middle_name' type='text' />
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='email'>Email</x-form-label>
                        <x-form-input id="email" name='email' type='email' />
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='phone'>Phone</x-form-label>
                        <x-form-input id="phone" name='phone' type='text' />
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='province'>Province</x-form-label>
                        <x-form-select name="province" id="province">
                            <option value="Zamboanga Del Sur">Zamboanga Del Sur</option>
                        </x-form-select>
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='city'>City</x-form-label>
                        <x-form-select name="city" id="city">
                            <option value="">Choose City</option>
                        </x-form-select>
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='barangay'>Barangay</x-form-label>
                        <x-form-select name="barangay" id="barangay">
                            <option selected value="">Choose Barangay</option>
                        </x-form-select>
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='street'>Street/Building/House/Lot/Block</x-form-label>
                        <x-form-input id="street" name='street' type='text' />
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='role'>Staff Role</x-form-label>
                        <x-form-select name="role" id="role">
                            <option selected value="">Choose Role</option>
                            <option value="{{ $ADMIN }}">Admin</option>
                            <option value="{{ $CASHIER }}">Cashier</option>
                            <option value="{{ $RIDER }}">Rider</option>
                        </x-form-select>
                    </x-form-group>
                    <div class="card-footer">
                        <button id="submitStaff" type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </x-content>
</x-layouts.admin>
