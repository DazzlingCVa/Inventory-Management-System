<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Product List
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data = Product::with(['category', 'supplier'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('product_code', 'like', "%{$search}%")
                        ->orWhere('product_name', 'like', "%{$search}%");
                });
            })
            ->paginate(10)
            ->withQueryString();
        return view(
            'admin.products.index',
            compact('data')
        );
    }

    /**
     * Add Product Form
     */
    public function create()
    {
        $categories = Category::where('status', 'Active')->get();
        $suppliers = Supplier::where('status', 'Active')->get();
        return view(
            'admin.products.create',
            compact('categories', 'suppliers')
        );
    }

    /**
     * Save Product
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required|unique:products',
            'product_name' => 'required|max:100',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'purchase_price' => 'required|numeric|min:1',
            'selling_price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(
                public_path('uploads/products'),
                $imageName
            );
        }
        Product::create([
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'stock' => $request->stock,
            'image' => $imageName,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product Added Successfully');
    }

    /**
     * Edit Product
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('status', 'Active')->get();
        $suppliers = Supplier::where('status', 'Active')->get();
        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories',
                'suppliers'
            )
        );
    }

    /**
     * Update Product
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_code' =>
                'required|unique:products,product_code,' . $id,
            'product_name' => 'required|max:100',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'purchase_price' => 'required|numeric|min:1',
            'selling_price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required',

        ]);

        $product = Product::findOrFail($id);
        $imageName = $product->image;
        if ($request->hasFile('image')) {
            if (
                $product->image &&
                file_exists(public_path('uploads/products/' . $product->image))
            ) {
                unlink(
                    public_path('uploads/products/' . $product->image)
                );
            }
            $image = $request->file('image');
            $imageName = time() . '.' .
                $image->getClientOriginalExtension();
            $image->move(
                public_path('uploads/products'),
                $imageName
            );
        }
        $product->update([
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'stock' => $request->stock,
            'image' => $imageName,
            'status' => $request->status,

        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product Updated Successfully');
    }

    /**
     * Inactive Product
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'status' => 'Inactive'
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product Inactivated Successfully');
    }
}