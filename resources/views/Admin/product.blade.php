<x-layouts.admin>
    <x-content-header>Products</x-content-header>
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
                        <x-table-body-row>
                            <x-table-body-item>

                            </x-table-body-item>
                            <x-table-body-item>

                            </x-table-body-item>
                            <x-table-body-item></x-table-body-item>
                            <x-table-body-item></x-table-body-item>
                            <x-table-body-item>

                            </x-table-body-item>
                        </x-table-body-row>
                    </x-table-body>
                </x-table>
            </x-table-card-body>
            <x-table-card-footer />
        </x-table-card>
        <a href="{{ route('products.create') }}" class="btn btn-inline-block btn-primary float-right">Create Product</a>
    </x-content>
</x-layouts.admin>
