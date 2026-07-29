@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <div class="card shadow">

            <div class="card-header bg-success text-white">

                <h4>Add Sale</h4>

            </div>

            <div class="card-body">

                <form action="{{ route('admin.sales.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Customer Name

                            </label>

                            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Sale Date

                            </label>

                            <input type="date" name="sale_date" class="form-control" value="{{ date('Y-m-d') }}" required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Product

                            </label>

                            <select name="product_id" id="product_id" class="form-select" required>

                                <option value="">

                                    Select Product

                                </option>

                                @foreach($products as $product)

                                    <option value="{{ $product->id }}" data-price="{{ $product->selling_price }}"
                                        data-stock="{{ $product->stock }}">

                                        {{ $product->product_name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Current Stock

                            </label>

                            <input type="text" id="stock" class="form-control" readonly>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Selling Price

                            </label>

                            <input type="number" name="price" id="price" step="0.01" class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Quantity

                            </label>

                            <input type="number" name="quantity" id="quantity" min="1" class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Total Amount

                            </label>

                            <input type="text" id="subtotal" class="form-control" readonly>

                        </div>

                    </div>

                    <div class="mt-4">

                        <button type="submit" class="btn btn-success">

                            Save Sale

                        </button>

                        <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary">

                            Back

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>

        let product = document.getElementById('product_id');

        let stock = document.getElementById('stock');

        let price = document.getElementById('price');

        let quantity = document.getElementById('quantity');

        let subtotal = document.getElementById('subtotal');

        product.addEventListener('change', function () {

            let option = this.options[this.selectedIndex];

            stock.value = option.getAttribute('data-stock');

            price.value = option.getAttribute('data-price');

            calculateTotal();

        });

        price.addEventListener('keyup', calculateTotal);
        price.addEventListener('change', calculateTotal);

        quantity.addEventListener('keyup', calculateTotal);
        quantity.addEventListener('change', calculateTotal);

        function calculateTotal() {

            let p = parseFloat(price.value) || 0;

            let q = parseInt(quantity.value) || 0;

            subtotal.value = (p * q).toFixed(2);

        }

    </script>

@endsection