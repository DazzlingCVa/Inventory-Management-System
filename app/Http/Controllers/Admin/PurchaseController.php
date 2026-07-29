<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Purchase List
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data = Purchase::with('supplier')
            ->when($search, function ($query) use ($search) {
                $query->where('invoice_no', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view(
            'admin.purchases.index',
            compact('data')
        );
    }

    /**
     * Purchase Form
     */
    public function create()
    {
        $suppliers = Supplier::where('status', 'Active')->get();
        $products = Product::where('status', 'Active')->get();
        return view(
            'admin.purchases.create',
            compact('suppliers', 'products')
        );
    }

    /**
     * Save Purchase
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required',
            'purchase_date' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:1',
        ]);
        DB::beginTransaction();
        try {
            $subtotal = $request->quantity * $request->price;
            $purchase = Purchase::create([
                'supplier_id' => $request->supplier_id,
                'invoice_no' => 'INV' . time(),
                'purchase_date' => $request->purchase_date,
                'total_amount' => $subtotal,
            ]);
            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'subtotal' => $subtotal,
            ]);

            // Increase Stock
            $product = Product::findOrFail($request->product_id);
            $product->stock += $request->quantity;
            $product->save();
            DB::commit();
            return redirect()
                ->route('admin.purchases.index')
                ->with('success', 'Purchase Saved Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Delete Purchase
     */
    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $item = PurchaseItem::where('purchase_id', $purchase->id)->first();
        if ($item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->stock -= $item->quantity;
                $product->save();
            }
            $item->delete();
        }
        $purchase->delete();

        return redirect()
            ->route('admin.purchases.index')
            ->with('success', 'Purchase Deleted Successfully');
    }
}