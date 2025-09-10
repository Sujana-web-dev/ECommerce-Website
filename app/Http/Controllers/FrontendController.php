<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
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
        
        // Get all products with category relationships
        $products = Product::with('category')->paginate(12); // Paginate with 12 products per page
        
        return view('frontend.single.all_products', compact('pageTitle', 'products'));
    }
}
