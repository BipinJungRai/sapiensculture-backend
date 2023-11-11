<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'category_name' => 'required|string|max:50',
            ]);

            Category::insert($validated);
            toastr()->success('A category is added successfully!');
            return back();
        } catch (Exception $th) {
            toastr()->error('Falied with ' . $th->getMessage());
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category2)
    {

        return view('admin.category.edit', compact('category2'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category2)
    {
        try {
            $validated = $request->validate([
                'category_name' => 'required|string|max:50',
                'status' => 'required|in:active,inactive',
            ]);

            $category2->update($validated);
            toastr()->success('A category is updated successfully!');
            return back();
        } catch (Exception $th) {
            toastr()->error('Falied with ' . $th->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category2)
    {
        try {
            $category2->delete();
            toastr()->success('A category is deleted successfully!');
            return back();
        } catch (Exception $th) {
            toastr()->error('Falied with ' . $th->getMessage());
            return back();
        }
    }
}
