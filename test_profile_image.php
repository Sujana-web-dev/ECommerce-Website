<?php
/**
 * Simple test to check if profile image functionality is working
 */

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\Schema;
use App\Models\User;

// Check if Laravel app can be loaded
try {
    $app = require_once 'bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo "✓ Laravel app loaded successfully\n";
    
    // Check if users table has profile_image column
    $columns = Schema::getColumnListing('users');
    if (in_array('profile_image', $columns)) {
        echo "✓ profile_image column exists in users table\n";
    } else {
        echo "✗ profile_image column missing from users table\n";
    }
    
    // Check if storage directory exists
    if (is_dir('storage/app/public/profile-images')) {
        echo "✓ Profile images directory exists\n";
    } else {
        echo "✗ Profile images directory missing\n";
    }
    
    // Check if symbolic link exists
    if (is_link('public/storage')) {
        echo "✓ Storage symbolic link exists\n";
    } else {
        echo "✗ Storage symbolic link missing - run 'php artisan storage:link'\n";
    }
    
    // Test User model methods
    $user = User::first();
    if ($user) {
        echo "✓ Found user: " . $user->name . "\n";
        echo "  Profile image URL: " . $user->profile_image_url . "\n";
        echo "  Avatar initials: " . $user->avatar_initials . "\n";
    } else {
        echo "✗ No users found in database\n";
    }
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "  File: " . $e->getFile() . "\n";
    echo "  Line: " . $e->getLine() . "\n";
}
