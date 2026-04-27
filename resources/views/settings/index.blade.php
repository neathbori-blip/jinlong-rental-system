{{-- resources/views/settings/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="max-w-[1200px] mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800 mb-2">
            <i class="fas fa-cog text-purple-600 mr-3"></i> Settings
        </h1>
        <p class="text-slate-500 text-sm">Manage your account, preferences, and system configuration</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-[280px,1fr] gap-8">
        <!-- Settings Sidebar -->
        <div class="bg-white rounded-2xl p-5 h-fit">
            <div class="flex flex-col gap-2">
                <button class="settings-nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-left font-medium transition-all duration-200 active" data-section="profile">
                    <i class="fas fa-user-circle w-5 text-slate-500"></i> Profile Settings
                </button>
                <button class="settings-nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-left font-medium transition-all duration-200" data-section="company">
                    <i class="fas fa-building w-5 text-slate-500"></i> Company Info
                </button>
                <button class="settings-nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-left font-medium transition-all duration-200" data-section="payment">
                    <i class="fas fa-credit-card w-5 text-slate-500"></i> Payment Settings
                </button>
                <button class="settings-nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-left font-medium transition-all duration-200" data-section="notification">
                    <i class="fas fa-bell w-5 text-slate-500"></i> Notifications
                </button>
                <button class="settings-nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-left font-medium transition-all duration-200" data-section="security">
                    <i class="fas fa-lock w-5 text-slate-500"></i> Security
                </button>
                <button class="settings-nav-item flex items-center gap-3 px-4 py-3 rounded-xl text-left font-medium transition-all duration-200" data-section="system">
                    <i class="fas fa-database w-5 text-slate-500"></i> System Preferences
                </button>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="settings-content">
            <!-- Profile Settings Section -->
            <div id="profile-section" class="settings-section active">
                <div class="bg-white rounded-2xl p-6 mb-6 border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 mb-5"><i class="fas fa-user-circle mr-2"></i> Personal Information</h3>
                    <form class="flex flex-col gap-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-semibold text-slate-600">Full Name</label>
                                <input type="text" value="Admin User" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-semibold text-slate-600">Email Address</label>
                                <input type="email" value="admin@renalhub.com" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-semibold text-slate-600">Phone Number</label>
                                <input type="tel" value="+1 (555) 123-4567" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-semibold text-slate-600">Role</label>
                                <input type="text" value="Super Administrator" disabled class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm bg-slate-100 text-slate-500">
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-semibold text-slate-600">Profile Picture</label>
                            <div class="flex items-center gap-5 mt-2">
                                <i class="fas fa-user-circle text-[80px] text-purple-600"></i>
                                <x-button variant="secondary" size="md" type="button">
                                    Upload New Picture
                                </x-button>
                            </div>
                        </div>
                        <div class="flex gap-3 mt-2">
                            <x-button variant="primary" size="md" type="submit">
                                Save Changes
                            </x-button>
                            <x-button variant="ghost" size="md" type="button">
                                Cancel
                            </x-button>
                        </div>
                    </form>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 mb-5"><i class="fas fa-clock mr-2"></i> Timezone & Language</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-semibold text-slate-600">Timezone</label>
                            <select class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500">
                                <option>America/New_York (EST)</option>
                                <option>America/Chicago (CST)</option>
                                <option>America/Denver (MST)</option>
                                <option>America/Los_Angeles (PST)</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-semibold text-slate-600">Language</label>
                            <select class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500">
                                <option>English (US)</option>
                                <option>Spanish</option>
                                <option>French</option>
                                <option>German</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Info Section -->
            <div id="company-section" class="settings-section hidden">
                <div class="bg-white rounded-2xl p-6 border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 mb-5"><i class="fas fa-building mr-2"></i> Company Information</h3>
                    <form class="flex flex-col gap-5">
                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-semibold text-slate-600">Company Name</label>
                            <input type="text" value="RentalHub Property Management" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-semibold text-slate-600">Tax ID / EIN</label>
                            <input type="text" value="XX-XXXXXXX" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-semibold text-slate-600">Address</label>
                            <input type="text" value="123 Business Ave, Suite 100" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-purple-500">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-semibold text-slate-600">City</label>
                                <input type="text" value="New York" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-semibold text-slate-600">State</label>
                                <input type="text" value="NY" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-semibold text-slate-600">ZIP Code</label>
                                <input type="text" value="10001" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm">
                            </div>
                        </div>
                        <div class="mt-2">
                            <x-button variant="primary" size="md" type="submit">
                                Save Changes
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Payment Settings Section -->
            <div id="payment-section" class="settings-section hidden">
                <div class="bg-white rounded-2xl p-6 mb-6 border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 mb-5"><i class="fas fa-credit-card mr-2"></i> Payment Gateway</h3>
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl">
                            <i class="fab fa-stripe text-4xl text-purple-600"></i>
                            <div class="flex-1">
                                <strong class="block text-sm">Stripe</strong>
                                <span class="text-xs text-slate-500">Connected</span>
                            </div>
                            <x-button variant="secondary" size="sm">
                                Configure
                            </x-button>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl">
                            <i class="fab fa-paypal text-4xl text-blue-500"></i>
                            <div class="flex-1">
                                <strong class="block text-sm">PayPal</strong>
                                <span class="text-xs text-slate-500">Not Connected</span>
                            </div>
                            <x-button variant="primary" size="sm">
                                Connect
                            </x-button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 mb-5"><i class="fas fa-dollar-sign mr-2"></i> Rent Collection Settings</h3>
                    <div class="flex flex-col gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="w-4 h-4"> Auto-charge rent on due date
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="w-4 h-4" checked> Send payment reminders
                        </label>
                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-semibold text-slate-600">Late Fee Amount</label>
                            <input type="text" value="$50" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm w-32">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-semibold text-slate-600">Grace Period (days)</label>
                            <input type="number" value="5" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm w-32">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notifications Section -->
            <div id="notification-section" class="settings-section hidden">
                <div class="bg-white rounded-2xl p-6 border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 mb-5"><i class="fas fa-bell mr-2"></i> Notification Preferences</h3>
                    <div class="flex flex-col">
                        <div class="flex justify-between items-center py-4 border-b border-slate-200">
                            <div>
                                <strong class="block text-sm">Email Notifications</strong>
                                <span class="text-xs text-slate-500">Receive important updates via email</span>
                            </div>
                            <label class="relative inline-block w-12 h-6">
                                <input type="checkbox" class="opacity-0 w-0 h-0" checked>
                                <span class="absolute cursor-pointer top-0 left-0 right-0 bottom-0 bg-slate-300 transition rounded-full before:absolute before:content-[''] before:h-4 before:w-4 before:left-1 before:bottom-1 before:bg-white before:transition before:rounded-full checked:bg-purple-600 checked:before:translate-x-6"></span>
                            </label>
                        </div>
                        <div class="flex justify-between items-center py-4 border-b border-slate-200">
                            <div>
                                <strong class="block text-sm">Payment Reminders</strong>
                                <span class="text-xs text-slate-500">Get notified when rent is due</span>
                            </div>
                            <label class="relative inline-block w-12 h-6">
                                <input type="checkbox" class="opacity-0 w-0 h-0" checked>
                                <span class="absolute cursor-pointer top-0 left-0 right-0 bottom-0 bg-slate-300 transition rounded-full before:absolute before:content-[''] before:h-4 before:w-4 before:left-1 before:bottom-1 before:bg-white before:transition before:rounded-full checked:bg-purple-600 checked:before:translate-x-6"></span>
                            </label>
                        </div>
                        <div class="flex justify-between items-center py-4 border-b border-slate-200">
                            <div>
                                <strong class="block text-sm">Maintenance Alerts</strong>
                                <span class="text-xs text-slate-500">Receive new maintenance requests</span>
                            </div>
                            <label class="relative inline-block w-12 h-6">
                                <input type="checkbox" class="opacity-0 w-0 h-0" checked>
                                <span class="absolute cursor-pointer top-0 left-0 right-0 bottom-0 bg-slate-300 transition rounded-full before:absolute before:content-[''] before:h-4 before:w-4 before:left-1 before:bottom-1 before:bg-white before:transition before:rounded-full checked:bg-purple-600 checked:before:translate-x-6"></span>
                            </label>
                        </div>
                        <div class="flex justify-between items-center py-4">
                            <div>
                                <strong class="block text-sm">Lease Expiration</strong>
                                <span class="text-xs text-slate-500">Get notified 30 days before lease ends</span>
                            </div>
                            <label class="relative inline-block w-12 h-6">
                                <input type="checkbox" class="opacity-0 w-0 h-0" checked>
                                <span class="absolute cursor-pointer top-0 left-0 right-0 bottom-0 bg-slate-300 transition rounded-full before:absolute before:content-[''] before:h-4 before:w-4 before:left-1 before:bottom-1 before:bg-white before:transition before:rounded-full checked:bg-purple-600 checked:before:translate-x-6"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Section -->
            <div id="security-section" class="settings-section hidden">
                <div class="bg-white rounded-2xl p-6 mb-6 border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 mb-5"><i class="fas fa-key mr-2"></i> Change Password</h3>
                    <form class="flex flex-col gap-4">
                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-semibold text-slate-600">Current Password</label>
                            <input type="password" placeholder="Enter current password" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-semibold text-slate-600">New Password</label>
                            <input type="password" placeholder="Enter new password" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-xs font-semibold text-slate-600">Confirm New Password</label>
                            <input type="password" placeholder="Confirm new password" class="px-3 py-2.5 border border-slate-200 rounded-xl text-sm">
                        </div>
                        <x-button variant="primary" size="md" type="submit" class="w-fit">
                            Update Password
                        </x-button>
                    </form>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 mb-5"><i class="fas fa-shield-alt mr-2"></i> Two-Factor Authentication</h3>
                    <p class="text-slate-600 text-sm mb-4">Add an extra layer of security to your account</p>
                    <x-button variant="outline" size="md">
                        Enable 2FA
                    </x-button>
                </div>
            </div>

            <!-- System Preferences Section -->
            <div id="system-section" class="settings-section hidden">
                <div class="bg-white rounded-2xl p-6 mb-6 border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 mb-5"><i class="fas fa-database mr-2"></i> Data Management</h3>
                    <div class="flex gap-3">
                        <x-button variant="secondary" size="md">
                            Export All Data
                        </x-button>
                        <x-button variant="secondary" size="md">
                            Create Backup
                        </x-button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 mb-5"><i class="fas fa-palette mr-2"></i> Appearance</h3>
                    <div class="flex gap-3">
                        <button class="theme-btn px-4 py-2 bg-slate-100 rounded-lg cursor-pointer transition active light">Light</button>
                        <button class="theme-btn px-4 py-2 bg-slate-100 rounded-lg cursor-pointer transition">Dark</button>
                        <button class="theme-btn px-4 py-2 bg-slate-100 rounded-lg cursor-pointer transition">Auto</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for active states -->
<style>
    .settings-nav-item.active {
        background: #667eea !important;
        color: white !important;
    }
    .settings-nav-item.active i {
        color: white !important;
    }
    .settings-nav-item:hover:not(.active) {
        background: #f1f5f9;
    }
    .theme-btn.active {
        background: #667eea !important;
        color: white !important;
    }
    /* Toggle switch styling */
    input:checked + span {
        background-color: #667eea;
    }
    input:checked + span:before {
        transform: translateX(24px);
    }
</style>

<script>
    // Section switching
    document.querySelectorAll('.settings-nav-item').forEach(item => {
        item.addEventListener('click', () => {
            // Update active state on nav buttons
            document.querySelectorAll('.settings-nav-item').forEach(nav => nav.classList.remove('active'));
            item.classList.add('active');
            
            // Show corresponding section
            const sectionId = `${item.dataset.section}-section`;
            document.querySelectorAll('.settings-section').forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(sectionId).classList.remove('hidden');
        });
    });

    // Theme buttons
    document.querySelectorAll('.theme-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.theme-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            alert(`Theme changed to ${btn.textContent} mode`);
        });
    });
</script>
@endsection