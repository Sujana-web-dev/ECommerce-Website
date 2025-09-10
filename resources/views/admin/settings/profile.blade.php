@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                            <i class="fas fa-user-circle text-emerald-600 mr-3"></i>
                            Admin Profile Settings
                        </h1>
                        <p class="text-gray-600 mt-1">Manage your account information and preferences</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                            <i class="fas fa-crown mr-1"></i>
                            Administrator
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Profile Overview Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-8 text-center">
                        <div class="relative inline-block">
                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=059669&color=ffffff&size=120&rounded=true" 
                                 alt="Profile Picture" 
                                 class="w-24 h-24 rounded-full border-4 border-white shadow-lg">
                            <button class="absolute bottom-0 right-0 bg-white text-emerald-600 rounded-full p-2 shadow-lg hover:bg-emerald-50 transition-colors">
                                <i class="fas fa-camera text-sm"></i>
                            </button>
                        </div>
                        <h3 class="text-xl font-bold text-white mt-4">Admin User</h3>
                        <p class="text-emerald-100">System Administrator</p>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-envelope w-5 text-emerald-600"></i>
                                <span class="ml-3 text-sm">admin@emporium.com</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-calendar w-5 text-emerald-600"></i>
                                <span class="ml-3 text-sm">Joined March 2024</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-clock w-5 text-emerald-600"></i>
                                <span class="ml-3 text-sm">Last login: Today 2:30 PM</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="font-semibold text-gray-900 mb-3">Account Stats</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-emerald-600">156</div>
                                    <div class="text-xs text-gray-500">Actions Today</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-emerald-600">98%</div>
                                    <div class="text-xs text-gray-500">System Health</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-lg mt-6 p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <button class="w-full text-left flex items-center px-4 py-3 rounded-lg bg-gray-50 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                            <i class="fas fa-download w-5"></i>
                            <span class="ml-3">Download Account Data</span>
                        </button>
                        <button class="w-full text-left flex items-center px-4 py-3 rounded-lg bg-gray-50 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                            <i class="fas fa-shield-alt w-5"></i>
                            <span class="ml-3">Security Log</span>
                        </button>
                        <button class="w-full text-left flex items-center px-4 py-3 rounded-lg bg-gray-50 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                            <i class="fas fa-history w-5"></i>
                            <span class="ml-3">Activity History</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Personal Information -->
                <div class="bg-white rounded-2xl shadow-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-user text-emerald-600 mr-2"></i>
                            Personal Information
                        </h2>
                    </div>
                    <div class="p-6">
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                    <input type="text" 
                                           value="Admin" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                    <input type="text" 
                                           value="User" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" 
                                       value="admin@emporium.com" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" 
                                       value="+1 (555) 123-4567" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                                <textarea rows="4" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                                          placeholder="Tell us about yourself...">System administrator with 5+ years of experience managing e-commerce platforms and ensuring optimal user experience.</textarea>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" 
                                        class="bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition-colors">
                                    <i class="fas fa-save mr-2"></i>
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="bg-white rounded-2xl shadow-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-shield-alt text-emerald-600 mr-2"></i>
                            Security Settings
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            
                            <!-- Change Password -->
                            <div>
                                <h3 class="font-medium text-gray-900 mb-4">Change Password</h3>
                                <form class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                        <input type="password" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                            <input type="password" 
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                                            <input type="password" 
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                        </div>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit" 
                                                class="bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition-colors">
                                            <i class="fas fa-key mr-2"></i>
                                            Update Password
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Two-Factor Authentication -->
                            <div class="pt-6 border-t border-gray-200">
                                <h3 class="font-medium text-gray-900 mb-4">Two-Factor Authentication</h3>
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-900">2FA Protection</h4>
                                        <p class="text-sm text-gray-600">Add an extra layer of security to your account</p>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               id="2fa-toggle" 
                                               class="w-5 h-5 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                        <label for="2fa-toggle" class="ml-3 text-sm font-medium text-gray-700">Enable 2FA</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Login Sessions -->
                            <div class="pt-6 border-t border-gray-200">
                                <h3 class="font-medium text-gray-900 mb-4">Active Sessions</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-desktop text-emerald-600 mr-3"></i>
                                            <div>
                                                <div class="font-medium text-gray-900">Windows PC - Chrome</div>
                                                <div class="text-sm text-gray-600">Current session • New York, US</div>
                                            </div>
                                        </div>
                                        <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-1 rounded-full">Active</span>
                                    </div>
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-mobile-alt text-gray-400 mr-3"></i>
                                            <div>
                                                <div class="font-medium text-gray-900">iPhone - Safari</div>
                                                <div class="text-sm text-gray-600">2 hours ago • New York, US</div>
                                            </div>
                                        </div>
                                        <button class="text-red-600 hover:text-red-700 text-sm">Revoke</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Preferences -->
                <div class="bg-white rounded-2xl shadow-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-cogs text-emerald-600 mr-2"></i>
                            Preferences
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            
                            <!-- Notifications -->
                            <div>
                                <h3 class="font-medium text-gray-900 mb-4">Notification Settings</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="font-medium text-gray-900">Email Notifications</div>
                                            <div class="text-sm text-gray-600">Receive updates via email</div>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" checked>
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                                        </label>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="font-medium text-gray-900">Push Notifications</div>
                                            <div class="text-sm text-gray-600">Receive real-time alerts</div>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" checked>
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                                        </label>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="font-medium text-gray-900">Marketing Updates</div>
                                            <div class="text-sm text-gray-600">Product updates and news</div>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Display Settings -->
                            <div class="pt-6 border-t border-gray-200">
                                <h3 class="font-medium text-gray-900 mb-4">Display Settings</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Theme</label>
                                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                            <option value="light" selected>Light Mode</option>
                                            <option value="dark">Dark Mode</option>
                                            <option value="auto">Auto (System)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Language</label>
                                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                            <option value="en" selected>English</option>
                                            <option value="es">Español</option>
                                            <option value="fr">Français</option>
                                            <option value="de">Deutsch</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end pt-6">
                                <button type="submit" 
                                        class="bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition-colors">
                                    <i class="fas fa-save mr-2"></i>
                                    Save Preferences
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // Profile picture upload
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle switches
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Show notification
                showNotification('Settings updated successfully', 'success');
            });
        });

        // Form submissions
        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                showNotification('Profile updated successfully', 'success');
            });
        });

        // Profile picture change
        document.querySelector('.fa-camera').closest('button').addEventListener('click', function() {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.querySelector('img[alt="Profile Picture"]').src = e.target.result;
                        showNotification('Profile picture updated', 'success');
                    };
                    reader.readAsDataURL(file);
                }
            };
            input.click();
        });
    });

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white shadow-lg transition-all transform translate-x-0 ${
            type === 'success' ? 'bg-emerald-500' : 
            type === 'error' ? 'bg-red-500' : 
            'bg-blue-500'
        }`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check' : type === 'error' ? 'fa-times' : 'fa-info'} mr-2"></i>
                ${message}
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Password strength indicator
    document.addEventListener('input', function(e) {
        if (e.target.type === 'password' && e.target.previousElementSibling.textContent === 'New Password') {
            const password = e.target.value;
            const strength = checkPasswordStrength(password);
            
            let strengthDiv = e.target.parentNode.querySelector('.password-strength');
            if (!strengthDiv) {
                strengthDiv = document.createElement('div');
                strengthDiv.className = 'password-strength mt-2 text-xs';
                e.target.parentNode.appendChild(strengthDiv);
            }
            
            const colors = {
                'Very Weak': 'text-red-600',
                'Weak': 'text-orange-600', 
                'Fair': 'text-yellow-600',
                'Good': 'text-blue-600',
                'Strong': 'text-emerald-600'
            };
            
            strengthDiv.className = `password-strength mt-2 text-xs ${colors[strength]}`;
            strengthDiv.textContent = `Password strength: ${strength}`;
        }
    });

    function checkPasswordStrength(password) {
        if (password.length < 6) return 'Very Weak';
        if (password.length < 8) return 'Weak';
        
        let score = 0;
        if (/[a-z]/.test(password)) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;
        
        if (score < 2) return 'Fair';
        if (score < 3) return 'Good';
        return 'Strong';
    }
</script>
@endsection
