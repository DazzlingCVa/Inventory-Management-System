@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                <h4>Add Product</h4>

            </div>

            <div class="card-body">

                @if($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Product Code
                            </label>

                            <input type="text" name="product_code" class="form-control" value="{{ old('product_code') }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Product Name
                            </label>

                            <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Category
                            </label>

                            <select name="category_id" class="form-select">

                                <option value="">
                                    Select Category
                                </option>

                                @foreach($categories as $category)

                                    <option value="{{ $category->id }}">

                                        {{ $category->category_name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Supplier
                            </label>

                            <select name="supplier_id" class="form-select">

                                <option value="">
                                    Select Supplier
                                </option>

                                @foreach($suppliers as $supplier)

                                    <option value="{{ $supplier->id }}">

                                        {{ $supplier->supplier_name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Purchase Price

                            </label>

                            <input type="number" step="0.01" name="purchase_price" class="form-control"
                                value="{{ old('purchase_price') }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Selling Price

                            </label>

                            <input type="number" step="0.01" name="selling_price" class="form-control"
                                value="{{ old('selling_price') }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Stock

                            </label>

                            <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Product Image

                            </label>

                            <input type="file" name="image" class="form-control" accept="image/*"
                                onchange="previewImage(event)">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Image Preview

                            </label>

                            <br>

                            <img id="preview" src=""
                                style="display:none;width:120px;height:120px;border:1px solid #ccc;padding:5px;">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="status" class="form-select">

                                <option value="Active">

                                    Active

                                </option>

                                <option value="Inactive">

                                    Inactive

                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="mt-4">

                        <button class="btn btn-success">

                            Save Product

                        </button>

                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">

                            Back

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>

        function previewImage(event) {
            let preview = document.getElementById('preview');

            preview.src = URL.createObjectURL(event.target.files[0]);

            preview.style.display = "block";
        }

    </script>

@endsection