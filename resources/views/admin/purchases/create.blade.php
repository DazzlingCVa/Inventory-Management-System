@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <div class="card shadow">

            <div class="card-header bg-success text-white">

                <h4>Add Purchase</h4>

            </div>

            <div class="card-body">

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

                <form action="{{ route('admin.purchases.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Supplier

                            </label>

                            <select name="supplier_id" class="form-select" required>

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

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Purchase Date

                            </label>

                            <input type="date" name="purchase_date" value="{{ date('Y-m-d') }}" class="form-control"
                                required>

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

                                    <option value="{{ $product->id }}" data-price="{{ $product->purchase_price }}"
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

                                Purchase Price

                            </label>

                            <input type="number" step="0.01" name="price" id="price" class="form-control" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Quantity

                            </label>

                            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Total Amount

                            </label>

                            <input type="text" id="subtotal" class="form-control" readonly>

                        </div>

                    </div>

                    <div class="mt-4">

                        <button class="btn btn-success">

                            Save Purchase

                        </button>

                        <a href="{{ route('admin.purchases.index') }}" class="btn btn-secondary">

                            Back

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>

        let product = document.getElementById('product_id');

        let price = document.getElementById('price');

        let quantity = document.getElementById('quantity');

        let subtotal = document.getElementById('subtotal');

        let stock = document.getElementById('stock');

        product.addEventListener('change', function () {

            let option = this.options[this.selectedIndex];

            price.value = option.getAttribute('data-price');

            stock.value = option.getAttribute('data-stock');

            calculateTotal();

        });

        price.addEventListener('keyup', calculateTotal);

        quantity.addEventListener('keyup', calculateTotal);

        price.addEventListener('change', calculateTotal);

        quantity.addEventListener('change', calculateTotal);

        function calculateTotal() {

            let p = parseFloat(price.value) || 0;

            let q = parseInt(quantity.value) || 0;

            subtotal.value = (p * q).toFixed(2);

        }

    </script>

@endsection