@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/profile-image.css') }}">
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-slate-50 to-blue-50">
    <!-- Header Section with Custom Color -->
    <div class="bg-gradient-to-r from-[#1D293D] to-gray-900 shadow-2xl">
        <div class="px-6 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center text-sm text-gray-300 mb-3">
                <span class="hover:text-white transition-colors">Dashboard</span>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-white font-medium">Profile Settings</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-white mb-1">Admin Profile Settings</h1>
                    <p class="text-gray-200">Manage your account information and preferences</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#ec4642] to-red-600 text-white rounded-xl font-medium shadow-lg">
                        <i class="fas fa-crown mr-2"></i>
                        Administrator
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Profile Overview Card -->
            <div class="lg:col-span-1">
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/20">
                    <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-8 text-center">
                        <div class="relative inline-block">
                            <img src="{{ $user->profile_image_url }}" 
                                 alt="Profile Picture" 
                                 class="w-24 h-24 rounded-full border-4 border-white shadow-lg"
                                 id="profileImage">
                            <button type="button" class="absolute bottom-0 right-0 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white rounded-full p-2 shadow-lg transition-colors duration-200" id="changeAvatarBtn">
                                <i class="fas fa-camera text-sm"></i>
                            </button>
                        </div>
                        <h3 class="text-xl font-bold text-white mt-4">{{ $user->full_name ?? $user->name }}</h3>
                        <p class="text-gray-200">{{ $user->role === 'admin' ? 'System Administrator' : ucfirst($user->role) }}</p>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-envelope w-5 text-[#1D293D]"></i>
                                <span class="ml-3 text-sm">{{ $user->email }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-calendar w-5 text-[#1D293D]"></i>
                                <span class="ml-3 text-sm">Joined {{ $stats['joined_date'] }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-clock w-5 text-[#1D293D]"></i>
                                <span class="ml-3 text-sm">Last login: {{ $stats['last_login'] }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="font-semibold text-gray-900 mb-3">Account Stats</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-[#1D293D]">{{ $stats['actions_today'] }}</div>
                                    <div class="text-xs text-gray-500">Actions Today</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-[#1D293D]">{{ $stats['system_health'] }}%</div>
                                    <div class="text-xs text-gray-500">System Health</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Personal Information -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                    <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-user text-white mr-2"></i>
                            Personal Information
                        </h2>
                    </div>
                    <div class="p-6">
                        <form id="profileForm" class="space-y-6" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="profileImageInput" class="hidden" accept="image/*">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                    <input type="text" 
                                           name="first_name"
                                           value="{{ $user->first_name ?? (explode(' ', $user->name)[0] ?? '') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] transition-colors bg-white/80 backdrop-blur-sm"
                                           required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                    <input type="text" 
                                           name="last_name"
                                           value="{{ $user->last_name ?? (count(explode(' ', $user->name)) > 1 ? explode(' ', $user->name)[1] : '') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] transition-colors bg-white/80 backdrop-blur-sm"
                                           required>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                                <input type="text" 
                                       name="username"
                                       value="{{ $user->username }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] transition-colors bg-white/80 backdrop-blur-sm"
                                       required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" 
                                       name="email"
                                       value="{{ $user->email }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] transition-colors bg-white/80 backdrop-blur-sm"
                                       required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" 
                                       name="phone"
                                       value="{{ $user->phone ?? '' }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] transition-colors bg-white/80 backdrop-blur-sm"
                                       placeholder="+1 (555) 123-4567">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                                <textarea name="bio" 
                                          rows="4" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] transition-colors bg-white/80 backdrop-blur-sm"
                                          placeholder="Tell us about yourself...">{{ $user->bio ?? 'System administrator with expertise in managing e-commerce platforms and ensuring optimal user experience.' }}</textarea>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" 
                                        class="bg-gradient-to-r from-[#1D293D] to-gray-700 text-white px-6 py-3 rounded-lg hover:from-gray-700 hover:to-[#1D293D] transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center gap-2">
                                    <i class="fas fa-save"></i>
                                    <span>Save Changes</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                    <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-shield-alt text-white mr-2"></i>
                            Security Settings
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            
                            <!-- Change Password -->
                            <div>
                                <h3 class="font-medium text-gray-900 mb-4">Change Password</h3>
                                <form id="passwordForm" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                        <input type="password" 
                                               name="current_password"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] transition-colors bg-white/80 backdrop-blur-sm"
                                               required>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                            <input type="password" 
                                                   name="password"
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] transition-colors bg-white/80 backdrop-blur-sm"
                                                   required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                                            <input type="password" 
                                                   name="password_confirmation"
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] transition-colors bg-white/80 backdrop-blur-sm"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit" 
                                                class="bg-gradient-to-r from-[#ec4642] to-red-600 text-white px-6 py-3 rounded-lg hover:from-red-600 hover:to-[#ec4642] transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center gap-2">
                                            <i class="fas fa-key"></i>
                                            <span>Update Password</span>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Login Sessions -->
                            <div class="pt-6 border-t border-gray-200">
                                <h3 class="font-medium text-gray-900 mb-4">Active Sessions</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between p-4 bg-white/70 backdrop-blur-sm rounded-lg border border-gray-200 shadow-sm">
                                        <div class="flex items-center">
                                            <i class="fas fa-desktop text-[#1D293D] mr-3"></i>
                                            <div>
                                                <div class="font-medium text-gray-900">Windows PC - Chrome</div>
                                                <div class="text-sm text-gray-600">Current session • New York, US</div>
                                            </div>
                                        </div>
                                        <span class="text-xs bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 px-2 py-1 rounded-full border border-green-200">Active</span>
                                    </div>
                                    <div class="flex items-center justify-between p-4 bg-white/70 backdrop-blur-sm rounded-lg border border-gray-200 shadow-sm">
                                        <div class="flex items-center">
                                            <i class="fas fa-mobile-alt text-gray-400 mr-3"></i>
                                            <div>
                                                <div class="font-medium text-gray-900">iPhone - Safari</div>
                                                <div class="text-sm text-gray-600">2 hours ago • New York, US</div>
                                            </div>
                                        </div>
                                        <button class="text-[#ec4642] hover:text-red-700 text-sm font-medium transition-colors duration-200">Revoke</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Preferences -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                    <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-cogs text-white mr-2"></i>
                            Preferences
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            
                            <!-- Notifications -->
                            <div>
                                <h3 class="font-medium text-gray-900 mb-4">Notification Settings</h3>
                                <form id="preferencesForm" class="space-y-4">
                                    @csrf
                                    
                                    <div class="flex items-center justify-between p-4 bg-white/70 backdrop-blur-sm rounded-lg border border-gray-200 shadow-sm">
                                        <div>
                                            <div class="font-medium text-gray-900">Push Notifications</div>
                                            <div class="text-sm text-gray-600">Receive real-time alerts</div>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" 
                                                   name="push_notifications"
                                                   class="sr-only peer" 
                                                   {{ $user->preferences['push_notifications'] ? 'checked' : '' }}>
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#1D293D]/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#1D293D]"></div>
                                        </label>
                                    </div>
                                    
                                    <div class="flex items-center justify-between p-4 bg-white/70 backdrop-blur-sm rounded-lg border border-gray-200 shadow-sm">
                                        <div>
                                            <div class="font-medium text-gray-900">Marketing Updates</div>
                                            <div class="text-sm text-gray-600">Product updates and news</div>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" 
                                                   name="marketing_updates"
                                                   class="sr-only peer" 
                                                   {{ $user->preferences['marketing_updates'] ? 'checked' : '' }}>
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#1D293D]/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#1D293D]"></div>
                                        </label>
                                    </div>
                                </form>
                            </div>

                            <div class="flex justify-end pt-6">
                                <button type="button" 
                                        id="savePreferencesBtn"
                                        class="bg-gradient-to-r from-[#1D293D] to-gray-700 text-white px-6 py-3 rounded-lg hover:from-gray-700 hover:to-[#1D293D] transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center gap-2">
                                    <i class="fas fa-save"></i>
                                    <span>Save Preferences</span>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Profile image upload
        const profileImageInput = document.getElementById('profileImageInput');
        const changeAvatarBtn = document.getElementById('changeAvatarBtn');
        const profileImage = document.getElementById('profileImage');

        changeAvatarBtn.addEventListener('click', function() {
            profileImageInput.click();
        });

        profileImageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file type
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    showNotification('Please select a valid image file (JPEG, PNG, JPG, GIF)', 'error');
                    return;
                }
                
                // Validate file size (2MB max)
                if (file.size > 2048 * 1024) {
                    showNotification('Image size must be less than 2MB', 'error');
                    return;
                }
                
                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                    profileImage.classList.add('profile-image-loading');
                };
                reader.readAsDataURL(file);
            }
        });

        // Profile form submission
        document.getElementById('profileForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const profileImageFile = profileImageInput.files[0];
            if (profileImageFile) {
                formData.append('profile_image', profileImageFile);
            }
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.querySelector('span').textContent;
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.querySelector('span').textContent = 'Saving...';
            submitBtn.querySelector('i').className = 'fas fa-spinner fa-spin';
            
            try {
                const response = await fetch('{{ route("settings.profile.update") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                                       document.querySelector('input[name="_token"]').value
                    }
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    showNotification(data.message, 'success');
                    
                    // Update profile display if needed
                    if (data.user) {
                        document.querySelector('h3.text-xl').textContent = data.user.name;
                        if (data.user.profile_image_url) {
                            // Remove loading state and add success animation
                            profileImage.classList.remove('profile-image-loading');
                            profileImage.classList.add('profile-image-success');
                            
                            // Update profile image in profile page
                            profileImage.src = data.user.profile_image_url;
                            
                            // Update profile image in header if it exists
                            const headerProfileImg = document.querySelector('header img[alt*="Profile"]');
                            if (headerProfileImg) {
                                headerProfileImg.src = data.user.profile_image_url;
                            }
                            
                            // Update any other profile images with class profile-avatar
                            document.querySelectorAll('.profile-avatar').forEach(img => {
                                img.src = data.user.profile_image_url;
                            });
                            
                            // Remove success animation after it completes
                            setTimeout(() => {
                                profileImage.classList.remove('profile-image-success');
                            }, 500);
                        }
                    }
                } else {
                    // Show validation errors or general error
                    let errorMessage = data.message || 'Failed to update profile';
                    if (data.errors) {
                        const errors = Object.values(data.errors).flat();
                        errorMessage += ': ' + errors.join(', ');
                    }
                    if (data.debug) {
                        console.error('Debug info:', data.debug);
                        errorMessage += ' (Check console for details)';
                    }
                    showNotification(errorMessage, 'error');
                }
            } catch (error) {
                console.error('Profile update error:', error);
                showNotification('An error occurred while updating profile', 'error');
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                submitBtn.querySelector('span').textContent = originalText;
                submitBtn.querySelector('i').className = 'fas fa-save';
            }
        });

        // Password form submission
        document.getElementById('passwordForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.querySelector('span').textContent;
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.querySelector('span').textContent = 'Updating...';
            submitBtn.querySelector('i').className = 'fas fa-spinner fa-spin';
            
            try {
                const response = await fetch('{{ route("settings.profile.password") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showNotification(data.message, 'success');
                    this.reset(); // Clear form
                } else {
                    showNotification(data.message || 'Failed to update password', 'error');
                }
            } catch (error) {
                console.error('Password update error:', error);
                showNotification('An error occurred while updating password', 'error');
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                submitBtn.querySelector('span').textContent = originalText;
                submitBtn.querySelector('i').className = 'fas fa-key';
            }
        });

        // Preferences handling
        const preferencesForm = document.getElementById('preferencesForm');
        const savePreferencesBtn = document.getElementById('savePreferencesBtn');
        
        // Auto-save preferences when checkboxes or selects change
        preferencesForm.addEventListener('change', function() {
            savePreferences();
        });

        // Save preferences button
        savePreferencesBtn.addEventListener('click', function() {
            savePreferences();
        });

        async function savePreferences() {
            const formData = new FormData(preferencesForm);
            const originalText = savePreferencesBtn.querySelector('span').textContent;
            
            // Show loading state
            savePreferencesBtn.disabled = true;
            savePreferencesBtn.querySelector('span').textContent = 'Saving...';
            savePreferencesBtn.querySelector('i').className = 'fas fa-spinner fa-spin';
            
            try {
                const response = await fetch('{{ route("settings.profile.preferences") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showNotification(data.message, 'success');
                } else {
                    showNotification(data.message || 'Failed to update preferences', 'error');
                }
            } catch (error) {
                console.error('Preferences update error:', error);
                showNotification('An error occurred while updating preferences', 'error');
            } finally {
                // Reset button state
                savePreferencesBtn.disabled = false;
                savePreferencesBtn.querySelector('span').textContent = originalText;
                savePreferencesBtn.querySelector('i').className = 'fas fa-save';
            }
        }
    });

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-xl text-white shadow-2xl transition-all transform translate-x-0 backdrop-blur-sm ${
            type === 'success' ? 'bg-gradient-to-r from-[#1D293D] to-gray-700' : 
            type === 'error' ? 'bg-gradient-to-r from-[#ec4642] to-red-600' : 
            'bg-gradient-to-r from-blue-500 to-blue-600'
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
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }

    // Password strength indicator
    document.addEventListener('input', function(e) {
        if (e.target.name === 'password') {
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
                'Strong': 'text-[#1D293D]'
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
