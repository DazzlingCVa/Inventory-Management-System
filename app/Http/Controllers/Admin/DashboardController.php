<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::where('status', 'Active')->count();
        $totalSuppliers = Supplier::where('status', 'Active')->count();
        $totalCategories = Category::where('status', 'Active')->count();


        return view('admin.dashboard', compact(

            'totalProducts',
            'totalCategories',
            'totalSuppliers'
        ));
    }
}