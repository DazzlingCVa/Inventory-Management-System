<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $search = $request->input('search');

        $data = Category::when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('category_name', 'like', "%{$search}%");
            });
        })
            ->Paginate(10)
            ->withQueryString();
        return view('admin.categories.index', compact('data'));
    }


    public function create()
    {
        //
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        //

        $valid = $request->validate([
            "category_name" => "required",
            "status" => "required"
        ]);

        Category::create($valid);

        return redirect()->route('admin.categories.index')->with('sucess', "Categories Added Sucessfully ");
    }

    public function edit(Category $categoryDetails, $id)
    {
        //
        $cat = $categoryDetails->findOrFail($id);
        return view('admin.categories.edit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
         $valid = $request->validate([
            "category_name" => "required",
            "status" => "required"
        ]);

        $cat = Category::findOrFail($id);
        $cat->update($valid);
        return redirect()->route('admin.categories.index')->with('sucess', "Categories Updated Sucessfully ");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
       $cat = Category::findOrFail($id);
        $cat->status = 'Inactive';
        $cat->save();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categories Inactivated Successfully');
 
    }
}

