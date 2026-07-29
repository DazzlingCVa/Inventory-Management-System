@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        <div class="card shadow">

            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

                <h4 class="mb-0">

                    Purchase History

                </h4>

                <a href="{{ route('admin.purchases.create') }}" class="btn btn-light">

                    + New Purchase

                </a>

            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('admin.purchases.index') }}" class="row mb-3">

                    <div class="col-md-4">

                        <input type="text" name="search" class="form-control" placeholder="Search Invoice Number..."
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-primary">

                            Search

                        </button>

                    </div>

                </form>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover text-center align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>S.No</th>

                                <th>Invoice No</th>

                                <th>Supplier</th>

                                <th>Purchase Date</th>

                                <th>Total Amount</th>

                                <th width="180">

                                    Action

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($data as $key => $purchase)

                                <tr>

                                    <td>

                                        {{ $data->firstItem() + $key }}

                                    </td>

                                    <td>

                                        {{ $purchase->invoice_no }}

                                    </td>

                                    <td>

                                        {{ $purchase->supplier->supplier_name }}

                                    </td>

                                    <td>

                                        {{ date('d-m-Y', strtotime($purchase->purchase_date)) }}

                                    </td>

                                    <td>

                                        ₹ {{ number_format($purchase->total_amount, 2) }}

                                    </td>

                                    <td>

                                        <a href="{{ route('admin.purchase.invoice', $purchase->id) }}"
                                            class="btn btn-success btn-sm">

                                            PDF

                                        </a>

                                        <form action="{{ route('admin.purchases.destroy', $purchase->id) }}" method="POST"
                                            style="display:inline;">

                                            @csrf

                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this Purchase?')">

                                                Delete

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6">

                                        No Purchase Records Found

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="d-flex justify-content-end">

                    {{ $data->links('pagination::bootstrap-5') }}

                </div>

            </div>

        </div>

    </div>

@endsection