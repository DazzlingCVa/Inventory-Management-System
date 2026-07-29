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

                    Sales History

                </h4>

                <a href="{{ route('admin.sales.create') }}" class="btn btn-light">

                    + Add Sale

                </a>

            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('admin.sales.index') }}" class="mb-3">

                    <div class="row">

                        <div class="col-md-4">

                            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="Search Invoice / Customer">

                        </div>

                        <div class="col-md-2">

                            <button class="btn btn-primary">

                                Search

                            </button>

                        </div>

                    </div>

                </form>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="table-dark text-center">

                            <tr>

                                <th>S.No</th>

                                <th>Invoice No</th>

                                <th>Customer Name</th>

                                <th>Sale Date</th>

                                <th>Total Amount</th>

                                <th width="220">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($data as $key => $sale)

                                <tr>

                                    <td class="text-center">

                                        {{ $data->firstItem() + $key }}

                                    </td>

                                    <td>

                                        {{ $sale->invoice_no }}

                                    </td>

                                    <td>

                                        {{ $sale->customer_name }}

                                    </td>

                                    <td>

                                        {{ date('d-m-Y', strtotime($sale->sale_date)) }}

                                    </td>

                                    <td>

                                        ₹ {{ number_format($sale->total_amount, 2) }}

                                    </td>

                                    <td class="text-center">

                                        <a href="{{ route('admin.sales.invoice', $sale->id) }}" class="btn btn-success btn-sm">

                                            PDF

                                        </a>

                                        <form action="{{ route('admin.sales.destroy', $sale->id) }}" method="POST"
                                            style="display:inline;">

                                            @csrf

                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this Sale?')">

                                                Delete

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="text-center text-danger">

                                        No Sales Found

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