<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\CartService;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function dashboard()
    {
        $pageTitle = "Home";
        
        // Get only 4 featured products for landing page
        $featuredProducts = Product::with('category')
            ->limit(4) // Show only 4 products on landing page
            ->get();
            
        return view('frontend.index', compact('pageTitle', 'featuredProducts'));
    }

    public function electronics()
    {
        $pageTitle = "Electronics Items";

        // Get all electronics products in a single collection
        $products = Product::whereHas('category', function ($q) {
            $q->whereIn('name', ['Smartphones', 'Laptops', 'Headphones', 'Smartwatches']);
        })->get();

        // Calculate available stock for each product (original stock - items in current user's cart)
        $products = $products->map(function ($product) {
            $quantityInCart = $this->cartService->getProductQuantityInCart($product->id);
            $product->available_stock = max(0, $product->stock - $quantityInCart);
            return $product;
        });

        $categories = ProductCategory::all(); // Get all categories
        $categories = productCategory::all(); // Get all categories

        // Pass to the view
        return view('frontend.single.electronics', compact('pageTitle', 'products'));
    }



    public function fashion()
    {
        $pageTitle = "Fashion";

        // Get all electronics products in a single collection
        $products = Product::whereHas('category', function ($q) {
            $q->whereIn('name', ['Women', 'Men', 'Accessories', 'Shoes']);
        })->get();

        // Calculate available stock for each product (original stock - items in current user's cart)
        $products = $products->map(function ($product) {
            $quantityInCart = $this->cartService->getProductQuantityInCart($product->id);
            $product->available_stock = max(0, $product->stock - $quantityInCart);
            return $product;
        });

        $categories = ProductCategory::all(); // Get all categories
        $categories = productCategory::all(); // Get all categories

        return view('frontend.single.fashion', compact('pageTitle', 'products'));
    }

    public function home_garden()
    {
        $pageTitle = "Home & Garden";

        // Get all home & garden products in a single collection
        $products = Product::whereHas('category', function ($q) {
            $q->whereIn('name', ['Indoor Plants', 'Garden Tools', 'Home Decor', 'Outdoor', 'Furniture']);
        })->get();

        // Calculate available stock for each product (original stock - items in current user's cart)
        $products = $products->map(function ($product) {
            $quantityInCart = $this->cartService->getProductQuantityInCart($product->id);
            $product->available_stock = max(0, $product->stock - $quantityInCart);
            return $product;
        });

        return view('frontend.single.home_garden', compact('pageTitle', 'products'));
    }


    //sports

    public function sports()
    {
        $pageTitle = "Sports Items";

        // Get all sports products in a single collection
        $products = Product::whereHas('category', function ($q) {
            $q->whereIn('name', ['Football', 'Basketball', 'Tennis', 'Cricket']);
        })->get();

        // Calculate available stock for each product (original stock - items in current user's cart)
        $products = $products->map(function ($product) {
            $quantityInCart = $this->cartService->getProductQuantityInCart($product->id);
            $product->available_stock = max(0, $product->stock - $quantityInCart);
            return $product;
        });

        return view('frontend.single.sports', compact('pageTitle', 'products'));
    }



    // Beauty

    public function beauty()
    {
        $pageTitle = "Beauty Items";

        // Get all beauty products in a single collection
        $products = Product::whereHas('category', function ($q) {
            $q->whereIn('name', ['Makeup', 'Skincare', 'Haircare', 'Fragrances']);
        })->get();

        // Calculate available stock for each product (original stock - items in current user's cart)
        $products = $products->map(function ($product) {
            $quantityInCart = $this->cartService->getProductQuantityInCart($product->id);
            $product->available_stock = max(0, $product->stock - $quantityInCart);
            return $product;
        });

        // Pass to the view
        return view('frontend.single.beauty', compact('pageTitle', 'products'));
    }


    // Books
    public function books()
    {
        $pageTitle = "Books";

        // Get all books in a single collection
        $products = Product::whereHas('category', function ($q) {
            $q->whereIn('name', ['Fiction', 'Non-Fiction', 'Science', 'History']);
        })->get();

        // Calculate available stock for each product (original stock - items in current user's cart)
        $products = $products->map(function ($product) {
            $quantityInCart = $this->cartService->getProductQuantityInCart($product->id);
            $product->available_stock = max(0, $product->stock - $quantityInCart);
            return $product;
        });

        // Pass to the view
        return view('frontend.single.books', compact('pageTitle', 'products'));
    }


    public function contact()
    {
        $pageTitle = "Contact";
        return view('frontend.single.contact', compact('pageTitle'));
    }

    public function about()
    {
        $pageTitle = "About";
        return view('frontend.single.about', compact('pageTitle'));
    }

    public function cardSection()
    {
        $pageTitle = "Card Section";
        return view('frontend.single.card_section', compact('pageTitle'));
    }

    // Show all products
    public function allProducts()
    {
        $pageTitle = "All Products";
        
        // Get all products with category relationships and stock information
        $products = Product::with('category')
            ->select('id', 'name', 'amount', 'cat_id', 'details', 'image', 'stock', 'created_at', 'updated_at')
            ->paginate(12); // Paginate with 12 products per page

        // Calculate available stock for each product (original stock - items in current user's cart)
        $products->getCollection()->transform(function ($product) {
            $quantityInCart = $this->cartService->getProductQuantityInCart($product->id);
            $product->available_stock = max(0, $product->stock - $quantityInCart);
            return $product;
        });
        
        return view('frontend.single.all_products', compact('pageTitle', 'products'));
    }

    // Search products functionality
    public function searchProducts(Request $request)
    {
        $pageTitle = "Search Results";
        $query = $request->get('query');
        
        if (empty($query)) {
            return redirect()->route('all.products')->with('error', 'Please enter a search term');
        }
        
        // Define book-related categories for smart search
        $bookCategories = ['Fiction', 'History', 'Non-Fiction', 'Science', 'Books'];
        
        // Search products with intelligent category mapping
        $products = Product::with('category')
            ->where(function($q) use ($query, $bookCategories) {
                // Search in product name
                $q->where('name', 'LIKE', '%' . $query . '%')
                  // Search in product details
                  ->orWhere('details', 'LIKE', '%' . $query . '%')
                  // Search in category name
                  ->orWhereHas('category', function($categoryQuery) use ($query) {
                      $categoryQuery->where('name', 'LIKE', '%' . $query . '%');
                  });
                  
                // Smart search: if searching for "books", also search book-related categories
                if (strtolower($query) === 'books' || strtolower($query) === 'book') {
                    $q->orWhereHas('category', function($categoryQuery) use ($bookCategories) {
                        $categoryQuery->whereIn('name', $bookCategories);
                    });
                }
                
                // Smart search: if searching for "electronics", include laptops, etc.
                if (strtolower($query) === 'electronics' || strtolower($query) === 'electronic') {
                    $q->orWhereHas('category', function($categoryQuery) {
                        $categoryQuery->whereIn('name', ['Laptops', 'Electronics']);
                    });
                }
                
                // Smart search: if searching for "fashion", include clothing categories
                if (strtolower($query) === 'fashion' || strtolower($query) === 'clothing' || strtolower($query) === 'clothes') {
                    $q->orWhereHas('category', function($categoryQuery) {
                        $categoryQuery->whereIn('name', ['Women', 'Men', 'Kids']);
                    });
                }
                
                // Smart search: if searching for "beauty", include makeup
                if (strtolower($query) === 'beauty' || strtolower($query) === 'cosmetics') {
                    $q->orWhereHas('category', function($categoryQuery) {
                        $categoryQuery->whereIn('name', ['Makeup']);
                    });
                }
                
                // Smart search: if searching for "sports", include related categories
                if (strtolower($query) === 'sports' || strtolower($query) === 'sport') {
                    $q->orWhereHas('category', function($categoryQuery) {
                        $categoryQuery->whereIn('name', ['Football', 'Basketball']);
                    });
                }
                
                // Smart search: if searching for "home", include related categories
                if (strtolower($query) === 'home' || strtolower($query) === 'garden') {
                    $q->orWhereHas('category', function($categoryQuery) {
                        $categoryQuery->whereIn('name', ['Indoor Plants', 'Garden Tools', 'Home Decor', 'Outdoor', 'Furnitures']);
                    });
                }
            })
            ->paginate(12)
            ->appends(['query' => $query]);

        // Calculate available stock for each product
        $products->getCollection()->transform(function ($product) {
            $quantityInCart = $this->cartService->getProductQuantityInCart($product->id);
            $product->available_stock = max(0, $product->stock - $quantityInCart);
            return $product;
        });
        
        // Count total results for display with same logic
        $totalResults = Product::where(function($q) use ($query, $bookCategories) {
            $q->where('name', 'LIKE', '%' . $query . '%')
              ->orWhere('details', 'LIKE', '%' . $query . '%')
              ->orWhereHas('category', function($categoryQuery) use ($query) {
                  $categoryQuery->where('name', 'LIKE', '%' . $query . '%');
              });
              
            // Apply same smart search logic for counting
            if (strtolower($query) === 'books' || strtolower($query) === 'book') {
                $q->orWhereHas('category', function($categoryQuery) use ($bookCategories) {
                    $categoryQuery->whereIn('name', $bookCategories);
                });
            }
            
            if (strtolower($query) === 'electronics' || strtolower($query) === 'electronic') {
                $q->orWhereHas('category', function($categoryQuery) {
                    $categoryQuery->whereIn('name', ['Laptops', 'Electronics']);
                });
            }
            
            if (strtolower($query) === 'fashion' || strtolower($query) === 'clothing' || strtolower($query) === 'clothes') {
                $q->orWhereHas('category', function($categoryQuery) {
                    $categoryQuery->whereIn('name', ['Women', 'Men', 'Kids']);
                });
            }
            
            if (strtolower($query) === 'beauty' || strtolower($query) === 'cosmetics') {
                $q->orWhereHas('category', function($categoryQuery) {
                    $categoryQuery->whereIn('name', ['Makeup']);
                });
            }
            
            if (strtolower($query) === 'sports' || strtolower($query) === 'sport') {
                $q->orWhereHas('category', function($categoryQuery) {
                    $categoryQuery->whereIn('name', ['Football', 'Basketball']);
                });
            }
            
            if (strtolower($query) === 'home' || strtolower($query) === 'garden') {
                $q->orWhereHas('category', function($categoryQuery) {
                    $categoryQuery->whereIn('name', ['Indoor Plants', 'Garden Tools', 'Home Decor', 'Outdoor', 'Furnitures']);
                });
            }
        })->count();
        
        return view('frontend.single.search_results', compact('pageTitle', 'products', 'query', 'totalResults'));
    }
}
