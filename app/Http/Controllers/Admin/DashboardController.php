<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalSuppliers = Supplier::where('status', 'Active')->count();
        $totalCategories = Category::where('status', 'Active')->count();
        $totalSales = Sale::all()->count();
        $availableProducts = Product::where('status', 'Active')
            ->where('stock', '>', 0)
            ->count();
        $todayPurchases = Purchase::whereDate('purchase_date', today())->count();
        $todaySales = Sale::whereDate('sale_date', today())->count();
        // $lowStockProducts = Product::where('status', 'Active')
        //     ->where('stock', '<', 5)
        //     ->get();


        return view('admin.dashboard', compact(

            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'totalSales',
            'availableProducts',
            'todaySales',
            'todayPurchases'
        ));
    }
}