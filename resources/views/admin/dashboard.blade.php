@extends('layouts.app')

@section('content')

    <h2 class="mb-4">

        Dashboard

    </h2>

    <div class="row">

        <div class="col-md-3 mb-3">

            <div class="card bg-primary text-white shadow">

                <div class="card-body text-center">

                    <h5>Total Categories</h5>

                    <h2>{{ $totalCategories }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card bg-success text-white shadow">

                <div class="card-body text-center">

                    <h5>Total Suppliers</h5>

                    <h2>{{ $totalSuppliers }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card bg-warning text-dark shadow">

                <div class="card-body text-center">

                    <h5>Total Products</h5>

                    <h2>{{ $totalProducts }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card bg-danger text-white shadow">

                <div class="card-body text-center">

                    <h5>Total Sales</h5>

                    <h2>{{ $totalSales }}</h2>

                </div>

            </div>

        </div>

    </div>

    <div class="row mt-3">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-secondary text-white">

                    Quick Information

                </div>

                <div class="card-body">

                    <p>

                        Welcome to Inventory Management System.

                    </p>

                    <p>

                        Use the sidebar to manage Categories, Suppliers, Products, Purchases and Sales.

                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-info text-white">

                    Today's Summary

                </div>

                <div class="card-body">

                    <table class="table table-bordered">

                        <tr>

                            <th>Total Purchase</th>

                            <td>{{ $todayPurchases }}</td>

                        </tr>

                        <tr>

                            <th>Total Sale</th>

                            <td>{{ $todaySales }}</td>

                        </tr>

                        <tr>

                            <th>Available Products</th>

                            <td>{{  $availableProducts}}</td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection