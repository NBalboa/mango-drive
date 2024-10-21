<x-layouts.admin>
    <x-content-header>Edit Staff</x-content-header>
    <x-content>
        <div class="card card-default">
            <form id="editStaff" action="{{ route('staffs.update', $staff->id) }}">
                @csrf
                <div class="card-body">
                    <x-form-group>
                        <x-form-label for='first_name'>First Name</x-form-label>
                        <x-form-input id="first_name" name='first_name' type='text' value="{{ $staff->first_name }}" />
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='last_name'>Last Name</x-form-label>
                        <x-form-input id="last_name" name='last_name' type='text' value="{{ $staff->last_name }}" />
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='middle_name'>Middle Name</x-form-label>
                        <x-form-input id="middle_name" name='middle_name' type='text'
                            value="{{ $staff->middle_name }}" />
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='province'>Province</x-form-label>
                        <x-form-select name="province" id="province">
                            <option value="{{ $address->province }}" selected>{{ $address->province }}</option>
                        </x-form-select>
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='city'>City</x-form-label>
                        <x-form-select name="city" id="city">
                            <option value="{{ $address->city }}" selected>{{ $address->city }}</option>
                        </x-form-select>
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='barangay'>Barangay</x-form-label>
                        <x-form-select name="barangay" id="barangay">
                            <option value="{{ $address->barangay }}" selected>{{ $address->barangay }}</option>
                        </x-form-select>
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='street'>Street/Building/House/Lot/Block</x-form-label>
                        <x-form-input id="street" name='street' type='text' value="{{ $address->street }}" />
                    </x-form-group>
                    <div class="card-footer">
                        <button id="submitStaff" type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </x-content>
</x-layouts.admin>
