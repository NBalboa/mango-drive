<x-layouts.admin>
    <x-content-header>Products</x-content-header>
    <x-content>
        <x-table-card>
            <x-table-card-header>
                Lists
                <div id="loader" class="spinner-border" role="status" style="height: 20px; width: 20px; display:none">
                    <span class="sr-only">Loading...</span>
                </div>
            </x-table-card-header>
            <x-table-card-body>
                <x-table>
                    <x-table-header>
                        <x-table-header-item>Image</x-table-header-item>
                        <x-table-header-item>Name</x-table-header-item>
                        <x-table-header-item>Description</x-table-header-item>
                        <x-table-header-item>Price</x-table-header-item>
                        <x-table-header-item>Quantity</x-table-header-item>
                        <x-table-header-item>Category</x-table-header-item>
                        <x-table-header-item>Available</x-table-header-item>
                    </x-table-header>
                    <x-table-body>
                        @foreach ($products as $product)
                            <x-table-body-row>
                                <x-table-body-item>
                                    <img src="{{ Storage::url($product->image) }}" alt="product image"
                                        class="rounded-circle img-fluid" style="width: 50px; height 50px">
                                </x-table-body-item>
                                <x-table-body-item>
                                    <a href="{{ route('products.profile', $product->id) }}">

                                        {{ $product->name }}
                                    </a>
                                </x-table-body-item>
                                <x-table-body-item>
                                    {{ $product->description }}
                                </x-table-body-item>
                                <x-table-body-item>
                                    {{ $product->price }}
                                </x-table-body-item>
                                <x-table-body-item>
                                    @if ($product->sold_by_quantity === $IS_QUANTITY)
                                        {{ $product->stock->quantity }}
                                    @else
                                        N/A
                                    @endif
                                </x-table-body-item>
                                <x-table-body-item>
                                    {{ $product->category->name }}
                                </x-table-body-item>

                                <x-table-body-item>

                                    <input type="checkbox" name="{{ $product->name }}" id="{{ $product->id }}"
                                        data-bootstrap-switch data-token="{{ csrf_token() }}"
                                        {{ $product->is_available === $IS_AVAILABLE ? 'checked' : '' }}
                                        data-off-color="danger" data-on-color="success">
                                </x-table-body-item>
                            </x-table-body-row>
                        @endforeach

                    </x-table-body>
                </x-table>
            </x-table-card-body>
            <x-table-card-footer />
        </x-table-card>
        <a href="{{ route('products.create') }}" class="btn btn-inline-block btn-primary float-right">Create
            Product</a>
    </x-content>
</x-layouts.admin>
