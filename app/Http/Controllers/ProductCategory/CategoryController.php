<?php

namespace App\Http\Controllers\ProductCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    public function addCategory()
    {
        $pageTitle = "Add Product Category";
        return $this->categoryForm($pageTitle);
    }

    private function categoryForm($pageTitle, $category = null)
    {
        return view('admin.product_category.addCategory', compact('pageTitle', 'category'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ProductCategory::create($request->only(['name']));

        return redirect()->route('category.list')->with('success', 'Category added successfully.');
    }

    public function listCategory(Request $request)
    {
        $pageTitle = "List Product Categories";
        
        $query = ProductCategory::query();

        // Handle search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('details', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $categories = $query->latest()->paginate(10);

        return view('admin.product_category.listCategory', compact('pageTitle', 'categories'));
    }

    public function editForm($id)
    {
        $pageTitle = "Edit Product Category";
        $category = ProductCategory::findOrFail($id);

        return $this->categoryForm($pageTitle, $category);
    }

    public function editPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
        ]);

        $category = ProductCategory::findOrFail($request->id);
        $category->update($request->only(['name', 'details']));

        return redirect()->route('category.list')->with('success', 'Category updated successfully.');
    }

    public function delete($id)
    {
        ProductCategory::findOrFail($id)->delete();
        return back()->with('success', 'Category deleted successfully.');
    }
}
