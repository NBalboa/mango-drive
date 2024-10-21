<x-layouts.admin>
    <x-content-header>Staff Profile</x-content-header>
    <x-content>
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                            alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{ $staff->first_name }} {{ $staff->last_name }}</h5>
                        <p class="text-muted mb-3">
                            @if ($ADMIN === $staff->role)
                                Admin
                            @elseif ($CASHIER === $staff->role)
                                Cashier
                            @elseif ($RIDER === $staff->role)
                                Rider
                            @endif
                        </p>
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('staffs.edit', $staff->id) }}" class="btn btn-primary">Edit</a>
                            </div>
                            <div class="col">
                                <form id="confirmDelete" action="{{ route('staffs.delete', $staff->id) }}"
                                    method="POST">
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
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $staff->first_name }} {{ $staff->middle_name }}
                                    {{ $staff->last_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $staff->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $staff->phone }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    @if ($address->street)
                                        {{ $address->street }},
                                    @endif
                                    {{ $address->barangay }},
                                    {{ $address->city }},
                                    {{ $address->province }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
    </x-content>

</x-layouts.admin>
