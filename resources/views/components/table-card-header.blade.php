<div class="card-header">
    <h3 class="card-title">{{ $slot }}</h3>
    <div class="card-tools">
        <form>
            <div class="input-group input-group-sm">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                <x-form-select id="role" name=role>
                    <option>Admin</option>
                    <option>Cashier</option>
                    <option>Rider</option>
                </x-form-select>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
