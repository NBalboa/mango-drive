<x-layouts.admin>
    <x-content-header>Cashiers</x-content-header>
    <x-content>
        <x-table-card>
            <x-table-card-header>
                List
            </x-table-card-header>
            <x-table-card-body>
                <x-table>
                    <x-table-header>
                        <x-table-header-item>Name</x-table-header-item>
                        <x-table-header-item>Address</x-table-header-item>
                        <x-table-header-item>Email</x-table-header-item>
                        <x-table-header-item>Phone No.</x-table-header-item>
                    </x-table-header>
                    <x-table-body>
                        <x-table-body-row>
                            <x-table-body-item>Test</x-table-body-item>
                            <x-table-body-item>Test</x-table-body-item>
                            <x-table-body-item>Test</x-table-body-item>
                            <x-table-body-item>Test</x-table-body-item>
                        </x-table-body-row>
                    </x-table-body>
                </x-table>
            </x-table-card-body>
            <x-table-card-footer />
        </x-table-card>
        <a href="/admin/cashiers/create" class="btn btn-inline-block btn-primary float-right">Register</a>
    </x-content>
</x-layouts.admin>
