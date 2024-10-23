<x-layouts.admin>
    <x-content-header>Product</x-content-header>
    <x-content>
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{ Storage::url($product->image) }}" alt="product image" class="rounded-circle img-fluid"
                            style="width: 150px;">
                        </p>
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                            </div>
                            <div class="col">
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger ms-1 ms-1">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    {{ $product->name }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Description</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Price</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    {{ $product->price }}
                                </p>
                            </div>
                        </div>
                        @if ($product->sold_by_quantity === $IS_QUANTITY)
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Quantity</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        {{ $stock->quantity }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Category</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    {{ $category->name }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Available</p>
                            </div>
                            <div class="col-sm-9">
                                <input type="checkbox" name="{{ $product->name }}" id="{{ $product->id }}"
                                    data-bootstrap-switch data-token="{{ csrf_token() }}"
                                    {{ $product->is_available === $IS_AVAILABLE ? 'checked' : '' }}
                                    data-off-color="danger" data-on-color="success">
                            </div>
                        </div>
                    </div>
                </div>
    </x-content>

</x-layouts.admin>
