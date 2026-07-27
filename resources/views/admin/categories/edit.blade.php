@extends('layouts.app')

@section('content')

    <div class="container mt-4">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                <h4>Edit Category</h4>

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

                <form action="{{ route('admin.categories.update', $cat->id) }}" method="POST">

                    @csrf

                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Category Name</label>

                            <input type="text" name="category_name" class="form-control"
                                value="{{ old('category_name', $cat->category_name) }}">
                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">Status</label>

                            <select name="status" class="form-select">

                                <option value="Active" {{ $cat->status == 'Active' ? 'selected' : '' }}>

                                    Active

                                </option>

                                <option value="Inactive" {{ $cat->status == 'Inactive' ? 'selected' : '' }}>

                                    Inactive

                                </option>

                            </select>

                        </div>
                    </div>

                    <div class="mt-3">

                        <button type="submit" class="btn btn-success">

                            Update Category

                        </button>

                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">

                            Back

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection