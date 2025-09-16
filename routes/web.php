<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InboxController;

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

// Contact Routes
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

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

// Search products
Route::get('/search', [App\Http\Controllers\FrontendController::class, 'searchProducts'])->name('products.search');


//Backend Part

// (Handled by admin middleware group above)


//product
Route::get('/product/add', [ProductController::class, 'addProduct'])->name('product.add');
Route::get('/product/list', [ProductController::class, 'listProduct'])->name('product.list');
Route::post('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('/product/edit/{id}', [ProductController::class, 'editForm'])->name('product.edit');
Route::post('/product/edit/post', [ProductController::class, 'editPost'])->name('product.edit.post');
Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('/product/details/{id}', [ProductController::class, 'getProductDetails'])->name('product.details');



// Product Category 
Route::get('/productCategory/add', [CategoryController::class, 'addCategory'])->name('category.add');
Route::post('/productCategory/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/productCategory/list', [CategoryController::class, 'listCategory'])->name('category.list');
Route::get('/productCategory/edit/{id}', [CategoryController::class, 'editForm'])->name('category.edit');
Route::post('/productCategory/update', [CategoryController::class, 'editPost'])->name('category.update');
Route::get('/productCategory/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');









// Cart Routes
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/stock-status', [CartController::class, 'getStockStatus'])->name('cart.stock-status');
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
        // Fetch all orders with their items and products for analytics
        $orders = \App\Models\Order::with(['user', 'items.product.category'])->orderBy('created_at', 'desc')->get();
        return view('admin.analytics.salesReport', compact('orders'));
    })->name('analytics.sales');

    // Payment Methods
    Route::get('/payment-methods', function () {
        $pageTitle = "Payment Methods";
        return view('admin.settings.paymentMethod', compact('pageTitle'));
    })->name('settings.payment-methods');

    // Admin Profile
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('settings.profile');
    Route::post('/profile/update', [App\Http\Controllers\Admin\ProfileController::class, 'updateProfile'])->name('settings.profile.update');
    Route::post('/profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('settings.profile.password');
    Route::post('/profile/preferences', [App\Http\Controllers\Admin\ProfileController::class, 'updatePreferences'])->name('settings.profile.preferences');

    // Inbox & Messages
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.messages');
    
    // Update contact status
    Route::patch('/inbox/{contact}/status', [InboxController::class, 'updateStatus'])->name('inbox.update-status');
    
    // Delete contact
    Route::delete('/inbox/{contact}', [InboxController::class, 'destroy'])->name('inbox.delete');
    Route::get('/messages', function () {
        $pageTitle = "Message List";
        return view('admin.inbox.messageList', compact('pageTitle'));
    })->name('inbox.messages');
});



Route::middleware('auth')->group(function () {
    Route::get('/cart/invoice/{id}', [CheckoutController::class,'invoice'])->name('cart.invoice');
});



Route::get('/product/{id}', [ProductController::class, 'view'])->name('product.view');

// Debug route to check profile setup
Route::get('/debug-profile', function () {
    $user = auth()->user();
    if (!$user) {
        return response()->json(['error' => 'Not authenticated']);
    }
    
    return response()->json([
        'user_id' => $user->id,
        'user_data' => $user->toArray(),
        'table_columns' => \Illuminate\Support\Facades\Schema::getColumnListing('users'),
        'routes' => [
            'profile_update' => route('settings.profile.update'),
            'profile_password' => route('settings.profile.password'),
            'profile_preferences' => route('settings.profile.preferences'),
        ]
    ]);
});

// Temporary route to setup admin profile (REMOVE IN PRODUCTION)
Route::get('/setup-admin-profile', function () {
    try {
        // Run the migration programmatically if it hasn't been run
        if (!\Illuminate\Support\Facades\Schema::hasColumn('users', 'first_name')) {
            \Illuminate\Support\Facades\Schema::table('users', function ($table) {
                $table->string('first_name')->nullable()->after('name');
                $table->string('last_name')->nullable()->after('first_name');
                $table->string('phone', 20)->nullable()->after('email');
                $table->text('bio')->nullable()->after('phone');
                $table->string('profile_image')->nullable()->after('bio');
                $table->json('preferences')->nullable()->after('profile_image');
            });
        }

        // Find or create admin user
        $admin = \App\Models\User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'password' => bcrypt('Admin@123'),
                'role' => 'admin',
                'user_type' => 'admin'
            ]
        );

        // Update admin with profile data
        $admin->update([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'phone' => '+1 (555) 123-4567',
            'bio' => 'System administrator with 5+ years of experience managing e-commerce platforms and ensuring optimal user experience. Passionate about technology and committed to delivering exceptional digital solutions.',
            'preferences' => json_encode([
                'email_notifications' => true,
                'push_notifications' => true,
                'marketing_updates' => false,
                'theme' => 'light',
                'language' => 'en',
                'two_factor_enabled' => false,
            ])
        ]);

        return response()->json([
            'message' => 'Admin profile setup completed successfully!',
            'admin' => [
                'email' => $admin->email,
                'name' => $admin->full_name,
                'role' => $admin->role,
                'profile_complete' => true
            ],
            'login_credentials' => [
                'email' => 'admin@admin.com',
                'password' => 'Admin@123'
            ],
            'next_step' => 'Login with the credentials above and visit /admin/profile to manage your profile.'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Setup failed: ' . $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});

// Temporary route to create admin user (REMOVE IN PRODUCTION)
Route::get('/create-admin', function () {
    $admin = \App\Models\User::firstOrCreate(
        ['email' => 'admin@admin.com'],
        [
            'name' => 'Admin User',
            'username' => 'admin',
            'password' => bcrypt('Admin@123'),
            'role' => 'admin',
            'user_type' => 'admin'
        ]
    );
    
    return response()->json([
        'message' => 'Admin user created/updated successfully!',
        'admin' => [
            'email' => $admin->email,
            'name' => $admin->name,
            'role' => $admin->role
        ],
        'login_credentials' => [
            'email' => 'admin@admin.com',
            'password' => 'Admin@123'
        ]
    ]);
});