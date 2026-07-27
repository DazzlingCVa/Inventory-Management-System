<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $search = $request->input('search');

        $data = Supplier::when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('supplier_name', 'like', "%{$search}%");
            });
        })
            ->Paginate(10)
            ->withQueryString();
        return view('admin.suppliers.index', compact('data'));
    }


    public function create()
    {
        //
        return view('admin.suppliers.create');
    }

    public function store(Request $request)
    {
        //

        $valid = $request->validate([
            'supplier_name' => 'required|max:100',
            'email' => 'required|email|unique:suppliers,email',
            'mobile' => 'required|digits:10|unique:suppliers,mobile',
            'address' => 'required',
            'gst_number' => 'required|max:15|unique:suppliers,gst_number',
            'status' => 'required',
        ]);

        Supplier::create($valid);

        return redirect()->route('admin.suppliers.index')->with('sucess', "Suppliers Added Sucessfully ");
    }

    public function edit(Supplier $categoryDetails, $id)
    {
        //
        $sup = $categoryDetails->findOrFail($id);
        return view('admin.suppliers.edit', compact('sup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $valid = $request->validate([
            'supplier_name' => 'required|max:100',
            'email' => 'required|email|unique:suppliers,email,' . $id,
            'mobile' => 'required|digits:10|unique:suppliers,mobile,' . $id,
            'address' => 'required',
            'gst_number' => 'required|max:15|unique:suppliers,gst_number,' . $id,
            'status' => 'required',
        ]);

        $sup = Supplier::findOrFail($id);
        $sup->update($valid);
        return redirect()->route('admin.suppliers.index')->with('sucess', "Suppliers Updated Sucessfully ");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $sup = Supplier::findOrFail($id);
        $sup->status = 'Inactive';
        $sup->save();

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Suppliers Inactivated Successfully');

    }
}
