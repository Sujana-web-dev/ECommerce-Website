<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\ProductCategory\CategoryController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Orders\OrdersController; 
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Cart\AdminCartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();


Route::get('/login', function () {
    $pageTitle = "Login";
    return view('frontend.auth.login', compact('pageTitle'));
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'You have been logged out.');
})->name('logout');

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'signOut'])->name('logout');

Route::get('/register', function () {
    $pageTitle = "Register";
    return view('frontend.auth.register', compact('pageTitle'));
})->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('register.custom');

// Dashboard for normal login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    // Checkout route protected
    Route::get('/checkout', function () {
        return view('frontend.cart.checkOut');
    })->name('checkout');
});


Route::middleware('auth')->group(function(){
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admindashboard', [AdminController::class, 'index'])->name('admindashboard');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\FrontendController::class, 'dashboard'])->name('dashboard');
Route::get('/electronics', [App\Http\Controllers\FrontendController::class, 'electronics'])->name('electronics');
Route::get('/fashion', [App\Http\Controllers\FrontendController::class, 'fashion'])->name('fashion');
Route::get('/home_garden', [App\Http\Controllers\FrontendController::class, 'home_garden'])->name('home_garden');
Route::get('/sports', [App\Http\Controllers\FrontendController::class, 'sports'])->name('sports');
Route::get('/beauty', [App\Http\Controllers\FrontendController::class, 'beauty'])->name('beauty');
Route::get('/books', [App\Http\Controllers\FrontendController::class, 'books'])->name('books');
Route::get('/contact', [App\Http\Controllers\FrontendController::class, 'contact'])->name('contact');
Route::get('/about', [App\Http\Controllers\FrontendController::class, 'about'])->name('about');

//card section
Route::get('/card-section', [App\Http\Controllers\FrontendController::class, 'cardSection'])->name('card.section');

// All products
Route::get('/all-products', [App\Http\Controllers\FrontendController::class, 'allProducts'])->name('all.products');


//Backend Part

// (Handled by admin middleware group above)


//product
Route::get('/product/add', [ProductController::class, 'addProduct'])->name('product.add');
Route::get('/product/list', [ProductController::class, 'listProduct'])->name('product.list');
Route::post('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('/product/edit/{id}', [ProductController::class, 'editForm'])->name('product.edit');
Route::post('/product/edit/post', [ProductController::class, 'editPost'])->name('product.edit.post');
Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');



// Product Category 
Route::get('/productCategory/add', [CategoryController::class, 'addCategory'])->name('category.add');
Route::post('/productCategory/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/productCategory/list', [CategoryController::class, 'listCategory'])->name('category.list');
Route::get('/productCategory/edit/{id}', [CategoryController::class, 'editForm'])->name('category.edit');
Route::post('/productCategory/update', [CategoryController::class, 'editPost'])->name('category.update');
Route::get('/productCategory/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');









// Cart Routes
Route::prefix('cart')->group(function () {
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
});



// Orders routes
Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
    Route::get('/orders/pending', [OrdersController::class, 'pending'])->name('orders.pending');
    Route::get('/orders/approved', [OrdersController::class, 'approved'])->name('orders.approved');
    Route::get('/orders/processing', [OrdersController::class, 'processing'])->name('orders.processing');
    Route::get('/orders/out-for-delivery', [OrdersController::class, 'outForDelivery'])->name('orders.out_for_delivery');
    Route::get('/orders/completed', [OrdersController::class, 'completed'])->name('orders.completed');
    Route::get('/orders/cancelled', [OrdersController::class, 'cancelled'])->name('orders.cancelled');
    Route::get('/orders/shipping', [OrdersController::class, 'shipping'])->name('orders.shipping');
    Route::get('/orders/{id}', [OrdersController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/status', [OrdersController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');

    // User routes
    Route::get('/my-orders', [OrdersController::class, 'userOrderHistory'])->name('orders.history');
    Route::get('/my-orders/{id}', [OrdersController::class, 'userOrderDetails'])->name('orders.details');
    Route::post('/orders/{id}/cancel', [OrdersController::class, 'cancelOrder'])->name('orders.cancel');
});

// Customer Management Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.list');
    Route::get('/customers/{id}/details', [CustomerController::class, 'getCustomerDetails'])->name('customers.details');
    
    Route::get('/customers/reviews', function () {
        return view('admin.customers.customerReviews');
    })->name('customers.reviews');
});

// Analytics Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/analytics/sales', function () {
        return view('admin.analytics.salesReport');
    })->name('analytics.sales');

    // Payment Methods
    Route::get('/payment-methods', function () {
        $pageTitle = "Payment Methods";
        return view('admin.settings.paymentMethod', compact('pageTitle'));
    })->name('settings.payment-methods');

    // Admin Profile
    Route::get('/profile', function () {
        $pageTitle = "Admin Profile";
        return view('admin.settings.profile', compact('pageTitle'));
    })->name('settings.profile');

    // Inbox & Messages
    Route::get('/messages', function () {
        $pageTitle = "Message List";
        return view('admin.inbox.messageList', compact('pageTitle'));
    })->name('inbox.messages');
});



Route::middleware('auth')->group(function () {
    Route::get('/cart/invoice/{id}', [CheckoutController::class,'invoice'])->name('cart.invoice');
});



Route::get('/product/{id}', [ProductController::class, 'view'])->name('product.view');




