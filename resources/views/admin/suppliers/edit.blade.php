@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                <h4>Edit Suppliers</h4>

            </div>

            <div class="card-body">

                @if ($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <form action="{{ route('admin.suppliers.update', $sup->id) }}" method="POST">
                    @csrf

                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Supplier Name</label>

                            <input type="text" name="supplier_name" class="form-control"
                                value="{{ old('supplier_name', $sup->supplier_name)}}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Email</label>

                            <input type="email" name="email" class="form-control" value="{{ old('email', $sup->email) }}">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Mobile</label>

                            <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $sup->mobile) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Address</label>

                            <input type="text" name="address" class="form-control"
                                value="{{ old('address', $sup->address) }}">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">GST Number</label>

                            <input type="text" name="gst_number" class="form-control"
                                value="{{ old('gst_number', $sup->gst_number) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Status</label>

                            <select name="status" class="form-select">

                                <option value="Active" {{ $sup->status == 'Active' ? 'selected' : '' }}>

                                    Active

                                </option>

                                <option value="Inactive" {{ $sup->status == 'Inactive' ? 'selected' : '' }}>

                                    Inactive

                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="mt-3">

                        <button type="submit" class="btn btn-success">

                            Update Supplier

                        </button>

                        <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary">

                            Back

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection