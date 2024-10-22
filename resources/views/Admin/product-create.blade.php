<x-layouts.admin>
    <x-content-header>Create Product</x-content-header>
    <x-content>
        <div class="row">
            <div class="col">
                <x-button-modal target="modalSupplier" class="btn btn-primary float-right mb-3 ml-2">Create
                    Supplier</x-button-modal>
                <x-button-modal target="modalCategory" class="btn btn-primary float-right mb-3">Create
                    Category</x-button-modal>
            </div>
        </div>
        <div class="card card-default">
            <form id="createProduct" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <x-form-group>
                        <x-form-label for='name'>Name</x-form-label>
                        <x-form-input id="name" name='name' type='text' />
                    </x-form-group>

                    <x-form-group>
                        <x-form-label for='description'>Description</x-form-label>
                        <x-form-input id="description" name='description' type='text' />
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='price'>Price</x-form-label>
                        <x-form-input id="price" name='price' type='number' />
                    </x-form-group>

                    <x-form-group>
                        <x-form-label for='category'>Category</x-form-label>
                        <x-form-select name="category" id="category">
                            <option selected value="">Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </x-form-select>
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='supplier'>Supplier</x-form-label>
                        <x-form-select name="supplier" id="supplier">
                            <option selected value="">Choose Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </x-form-select>
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='sold_by_quantity'>Sold by Quantity</x-form-label>
                        <input type="checkbox" name="sold_by_quantity" id="sold_by_quantity" checked
                            data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </x-form-group>
                    <x-form-group>

                        <x-form-label for='quantity'>Quantity</x-form-label>
                        <x-form-input id="quantity" name='quantity' type='number' />
                    </x-form-group>
                    <x-form-group>
                        <x-form-label for='image'>Image</x-form-label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image"
                                accept="image/png, image/jpeg, image/jpg" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                        <div class="row mt-2" id="preview" style="display: none">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <img id="imagePreview" alt="avatar" class="rounded-circle img-fluid"
                                            style="width: 150px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-form-group>
                    <div class="card-footer bg-transparent">
                        <button id="submitProduct" type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>

        <div class="row">
            <x-modal id="modalCategory" title="Create Category">
                <form id="createCategory" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="card-body">
                        <x-form-group>
                            <x-form-label for='category_name'>Name</x-form-label>
                            <x-form-input id="category_name" name='category_name' type='text' />
                        </x-form-group>
                        <div class="card-footer bg-transparent">
                            <button id="submitCategory" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </x-modal>
        </div>
        <div class="row">
            <x-modal id="modalSupplier" title="Create Supplier">
                <form id="createSupplier" action="{{ route('suppliers.store') }}">
                    @csrf
                    <div class="card-body">
                        <x-form-group>
                            <x-form-label for='supplier_name'>Name</x-form-label>
                            <x-form-input id="supplier_name" name='supplier_name' type='text' />
                        </x-form-group>
                        <div class="card-footer bg-transparent">
                            <button id="submitSupplier" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </x-modal>
        </div>
    </x-content>
</x-layouts.admin>
