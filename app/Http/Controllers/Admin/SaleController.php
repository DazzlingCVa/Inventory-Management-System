<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;

class SaleController extends Controller
{
    /**
     * Sales History
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $data = Sale::when($search, function ($query) use ($search) {

            $query->where('invoice_no', 'like', "%{$search}%")
                ->orWhere('customer_name', 'like', "%{$search}%");

        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.sales.index',
            compact('data')
        );
    }

    /**
     * Create Sale
     */
    public function create()
    {
        $products = Product::where('status', 'Active')
            ->orderBy('product_name')
            ->get();

        return view(
            'admin.sales.create',
            compact('products')
        );
    }

    /**
     * Store Sale
     */
    public function store(Request $request)
    {
        $request->validate([

            'customer_name' => 'required',

            'sale_date' => 'required',

            'product_id' => 'required',

            'quantity' => 'required|integer|min:1',

            'price' => 'required|numeric|min:1',

        ]);

        $product = Product::findOrFail($request->product_id);

        /**
         * Check Stock
         */

        if ($request->quantity > $product->stock) {

            return back()
                ->withInput()
                ->with('error', 'Insufficient Stock');

        }

        $subtotal = $request->quantity * $request->price;

        /**
         * Create Sale
         */

        $sale = Sale::create([

            'customer_name' => $request->customer_name,

            'invoice_no' => 'SAL' . time(),

            'sale_date' => $request->sale_date,

            'total_amount' => $subtotal,

        ]);

        /**
         * Create Sale Item
         */

        SaleItem::create([

            'sale_id' => $sale->id,

            'product_id' => $request->product_id,

            'quantity' => $request->quantity,

            'price' => $request->price,

            'subtotal' => $subtotal,

        ]);

        /**
         * Reduce Stock
         */

        $product->decrement(
            'stock',
            $request->quantity
        );

        return redirect()
            ->route('admin.sales.index')
            ->with(
                'success',
                'Sale Added Successfully.'
            );
    }

    /**
     * Delete Sale
     */
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);

        foreach ($sale->saleItems as $item) {

            $product = Product::find($item->product_id);

            if ($product) {

                $product->increment(
                    'stock',
                    $item->quantity
                );

            }

            $item->delete();
        }

        $sale->delete();

        return redirect()
            ->route('admin.sales.index')
            ->with(
                'success',
                'Sale Deleted Successfully.'
            );
    }
}