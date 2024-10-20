<x-layouts.admin>
    <x-content-header>Staffs</x-content-header>
    <x-content>
        <x-table-card>
            <x-table-card-header>
                Lists
            </x-table-card-header>
            <x-table-card-body>
                <x-table>
                    <x-table-header>
                        <x-table-header-item>Name</x-table-header-item>
                        <x-table-header-item>Address</x-table-header-item>
                        <x-table-header-item>Email</x-table-header-item>
                        <x-table-header-item>Phone</x-table-header-item>
                        <x-table-header-item>Role</x-table-header-item>
                    </x-table-header>
                    <x-table-body>
                        @foreach ($staffs as $staff)
                            <x-table-body-row>

                                <x-table-body-item>{{ $staff->last_name }}, {{ $staff->first_name }}</x-table-body-item>
                                <x-table-body-item>
                                    @if ($staff->addresses->first())
                                        {{ $staff->addresses->first()->street }},
                                        {{ $staff->addresses->first()->barangay }},
                                        {{ $staff->addresses->first()->city }},
                                        {{ $staff->addresses->first()->province }}
                                    @endif
                                </x-table-body-item>
                                <x-table-body-item>{{ $staff->email }}</x-table-body-item>
                                <x-table-body-item>{{ $staff->phone }}</x-table-body-item>
                                <x-table-body-item>
                                    @if ($ADMIN === $staff->role)
                                        ADMIN
                                    @elseif ($CASHIER === $staff->role)
                                        CASHIER
                                    @elseif ($RIDER === $staff->role)
                                        RIDER
                                    @endif
                                </x-table-body-item>
                            </x-table-body-row>
                        @endforeach

                    </x-table-body>
                </x-table>
            </x-table-card-body>
            <x-table-card-footer />
        </x-table-card>
        <a href="/admin/staffs/create" class="btn btn-inline-block btn-primary float-right">Register Staff</a>
    </x-content>
</x-layouts.admin>
