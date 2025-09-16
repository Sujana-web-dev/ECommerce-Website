<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    // Show add product form
    public function addProduct()
    {
        $category = ProductCategory::all();

        return view('admin.product.add', [
            'category' => $category,
            'pageTitle' => 'Add Product',
        ]);
    }

    // Common form renderer
    private function productForm($pageTitle, $product = null, $category = null)
    {
        return view('admin.product.add', compact('pageTitle', 'product', 'category'));
    }

    // Store new product
    public function create(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'cat_id' => 'required',
            'amount' => 'required|numeric',
            'details' => 'nullable|string',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock'  => 'required|integer|min:0',
        ]);

        $product = new Product();
        $product->name   = $request->name;
        $product->cat_id = $request->cat_id;
        $product->amount = $request->amount;
        $product->details = $request->details;
        $product->stock  = $request->stock;

        // Handle file upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        return redirect()->route('product.list')->with('success', 'Product created successfully!');
    }

    // Show product list
    public function listProduct(Request $request)
    {
        $pageTitle = "List Product";
        
        // Start building the query
        $query = Product::with('category');
        
        // Apply search filter if search term exists
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('details', 'like', '%' . $searchTerm . '%')
                  ->orWhere('amount', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('category', function($categoryQuery) use ($searchTerm) {
                      $categoryQuery->where('name', 'like', '%' . $searchTerm . '%');
                  });
            });
        }
        
        // Get paginated results
        $products = $query->latest()->paginate(10);

        return view('admin.product.list', compact('pageTitle', 'products'));
    }

    // Show edit form
    public function editForm($id)
    {
        $product  = Product::findOrFail($id);
        $category = ProductCategory::all();

        return view('admin.product.add', [
            'product'   => $product,
            'category'  => $category,
            'pageTitle' => 'Edit Product',
        ]);
    }

    // Update product
    public function editPost(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'cat_id' => 'required',
            'amount' => 'required|numeric',
            'details' => 'nullable|string',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock'  => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($request->id);

        $product->name   = $request->name;
        $product->cat_id = $request->cat_id;
        $product->amount = $request->amount;
        $product->details = $request->details;
        $product->stock  = $request->stock;

        // Only update image if new one is uploaded
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        return redirect()->route('product.list')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function delete($id)
    {
        $delete = Product::findOrFail($id);
        $delete->delete();

        return back()->with('success', 'Product deleted successfully!');
    }

    // View single product
    public function view($id)
    {
        $product = Product::findOrFail($id);
        return view('product.view', compact('product'));
    }

    // Get product details for AJAX (Quick View)
    public function getProductDetails($id)
    {
        try {
            $product = Product::with('category')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'details' => $product->details,
                    'amount' => $product->amount,
                    'original_price' => $product->original_price,
                    'discount' => $product->discount,
                    'stock' => $product->stock,
                    'available_stock' => $product->available_stock ?? $product->stock,
                    'image' => $product->image ? asset('storage/' . $product->image) : null,
                    'category' => $product->category->name ?? 'N/A',
                    'created_at' => $product->created_at->format('M d, Y'),
                    'updated_at' => $product->updated_at->format('M d, Y'),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }
    }


    public function index()
    {
        $cartCount = 3;
        $wishlistCount = 2;
        $products = Product::with('category')->latest()->paginate(8);

        return view('welcome', compact('cartCount', 'wishlistCount', 'products'));
    }
}
