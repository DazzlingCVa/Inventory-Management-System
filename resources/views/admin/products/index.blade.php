@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                <div class="d-flex justify-content-between align-items-center">

                    <h4>Product List</h4>

                    <a href="{{ route('admin.products.create') }}" class="btn btn-light">

                        + Add Product

                    </a>

                </div>

            </div>

            <div class="card-body">

                @if(session('success'))

                    <div class="alert alert-success">

                        {{ session('success') }}

                    </div>

                @endif

                {{-- Search --}}

                <form method="GET" action="{{ route('admin.products.index') }}" class="mb-3">

                    <div class="row">

                        <div class="col-md-4">

                            <input type="text" name="search" class="form-control" placeholder="Search Product..."
                                value="{{ request('search') }}">

                        </div>

                        <div class="col-md-2">

                            <button class="btn btn-primary">

                                Search

                            </button>

                        </div>

                    </div>

                </form>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover text-center align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>S.No</th>

                                <th>Image</th>

                                <th>Product Code</th>

                                <th>Product Name</th>

                                <th>Category</th>

                                <th>Supplier</th>

                                <th>Purchase Price</th>

                                <th>Selling Price</th>

                                <th>Stock</th>

                                <th>Status</th>

                                <th width="170">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($data as $key => $product)

                                <tr>

                                    <td>

                                        {{ $data->firstItem() + $key }}

                                    </td>

                                    <td>

                                        @if($product->image)

                                            <img src="{{ asset('uploads/products/' . $product->image) }}" width="60" height="60"
                                                class="rounded border">

                                        @else

                                            No Image

                                        @endif

                                    </td>

                                    <td>

                                        {{ $product->product_code }}

                                    </td>

                                    <td>

                                        {{ $product->product_name }}

                                    </td>

                                    <td>

                                        {{ $product->category->category_name }}

                                    </td>

                                    <td>

                                        {{ $product->supplier->supplier_name }}

                                    </td>

                                    <td>

                                        ₹ {{ number_format($product->purchase_price, 2) }}

                                    </td>

                                    <td>

                                        ₹ {{ number_format($product->selling_price, 2) }}

                                    </td>

                                    <td>

                                        {{ $product->stock }}

                                    </td>

                                    <td>

                                        @if($product->status == 'Active')

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

                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn btn-warning btn-sm">

                                            Edit

                                        </a>

                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                            style="display:inline;">

                                            @csrf

                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">

                                                Inactive

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="11">

                                        No Products Found

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="d-flex justify-content-end">

                    {{ $data->links('pagination::simple-bootstrap-5') }}

                </div>

            </div>

        </div>

    </div>

@endsection