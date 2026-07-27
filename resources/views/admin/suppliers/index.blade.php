@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <div class="row mb-3">

            <div class="col-md-6">

                <h2>Supplier List</h2>

            </div>

            <div class="col-md-6">

                <form action="{{ route('admin.suppliers.index') }}" method="GET">

                    <div class="input-group">

                        <input type="text" name="search" class="form-control" placeholder="Search by Supplier Name..."
                            value="{{ request('search') }}">

                        <button class="btn btn-primary" type="submit">

                            Search

                        </button>

                        <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary">

                            Reset

                        </a>

                        <a href="{{ route('admin.suppliers.create') }}" class="btn btn-success">

                            + Add Suppliers

                        </a>

                    </div>

                </form>

            </div>
        </div>
        <br>
        <div class="table-responsive">

            <table class="table table-bordered table-hover table-striped text-center align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Supplier Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>GST Number</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($data as $sup)

                        <tr>


                            <td>{{ $sup->supplier_name }}</td>
                            <td>{{ $sup->email }}</td>
                            <td>{{ $sup->mobile }}</td>
                            <td>{{ $sup->address }}</td>
                            <td>{{ $sup->gst_number }}</td>
                            <td>

                                @if($sup->status == 'Active')

                                    <span class="badge bg-success">

                                        Active

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Inactive

                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('admin.suppliers.edit', $sup->id) }}" class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form action="{{ route("admin.suppliers.destroy", $sup->id) }}" method="POST" class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this Supplier?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9">

                                No Supplier Found

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="d-flex justify-content-end mt-3">
                {{ $data->links('pagination::simple-bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection