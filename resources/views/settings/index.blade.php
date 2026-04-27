{{-- resources/views/settings/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="settings-container">
    <div class="page-header">
        <h1><i class="fas fa-cog"></i> Settings</h1>
        <p>Manage your account, preferences, and system configuration</p>
    </div>

    <div class="settings-layout">
        <div class="settings-sidebar">
            <div class="settings-nav">
                <button class="settings-nav-item active" data-section="profile">
                    <i class="fas fa-user-circle"></i> Profile Settings
                </button>
                <button class="settings-nav-item" data-section="company">
                    <i class="fas fa-building"></i> Company Info
                </button>
                <button class="settings-nav-item" data-section="payment">
                    <i class="fas fa-credit-card"></i> Payment Settings
                </button>
                <button class="settings-nav-item" data-section="notification">
                    <i class="fas fa-bell"></i> Notifications
                </button>
                <button class="settings-nav-item" data-section="security">
                    <i class="fas fa-lock"></i> Security
                </button>
                <button class="settings-nav-item" data-section="system">
                    <i class="fas fa-database"></i> System Preferences
                </button>
            </div>
        </div>

        <div class="settings-content">
            <!-- Profile Settings -->
            <div id="profile-section" class="settings-section active">
                <div class="settings-card">
                    <h3><i class="fas fa-user-circle"></i> Personal Information</h3>
                    <form class="settings-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" value="Admin User" class="form-input">
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" value="admin@renalhub.com" class="form-input">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="tel" value="+1 (555) 123-4567" class="form-input">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" value="Super Administrator" disabled class="form-input disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Profile Picture</label>
                            <div class="avatar-upload">
                                <div class="avatar-preview">
                                    <i class="fas fa-user-circle" style="font-size: 80px; color: #667eea;"></i>
                                </div>
                                <button type="button" class="btn-upload">Upload New Picture</button>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-save">Save Changes</button>
                            <button type="button" class="btn-cancel">Cancel</button>
                        </div>
                    </form>
                </div>

                <div class="settings-card">
                    <h3><i class="fas fa-clock"></i> Timezone & Language</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Timezone</label>
                            <select class="form-input">
                                <option>America/New_York (EST)</option>
                                <option>America/Chicago (CST)</option>
                                <option>America/Denver (MST)</option>
                                <option>America/Los_Angeles (PST)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Language</label>
                            <select class="form-input">
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
            <div id="company-section" class="settings-section">
                <div class="settings-card">
                    <h3><i class="fas fa-building"></i> Company Information</h3>
                    <form class="settings-form">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" value="RentalHub Property Management" class="form-input">
                        </div>
                        <div class="form-group">
                            <label>Tax ID / EIN</label>
                            <input type="text" value="XX-XXXXXXX" class="form-input">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" value="123 Business Ave, Suite 100" class="form-input">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" value="New York" class="form-input">
                            </div>
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" value="NY" class="form-input">
                            </div>
                            <div class="form-group">
                                <label>ZIP Code</label>
                                <input type="text" value="10001" class="form-input">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-save">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Payment Settings -->
            <div id="payment-section" class="settings-section">
                <div class="settings-card">
                    <h3><i class="fas fa-credit-card"></i> Payment Gateway</h3>
                    <div class="payment-methods">
                        <div class="payment-method">
                            <i class="fab fa-stripe"></i>
                            <div class="payment-info">
                                <strong>Stripe</strong>
                                <span>Connected</span>
                            </div>
                            <button class="btn-configure">Configure</button>
                        </div>
                        <div class="payment-method">
                            <i class="fab fa-paypal"></i>
                            <div class="payment-info">
                                <strong>PayPal</strong>
                                <span>Not Connected</span>
                            </div>
                            <button class="btn-connect">Connect</button>
                        </div>
                    </div>
                </div>

                <div class="settings-card">
                    <h3><i class="fas fa-dollar-sign"></i> Rent Collection Settings</h3>
                    <div class="form-group">
                        <label><input type="checkbox"> Auto-charge rent on due date</label>
                    </div>
                    <div class="form-group">
                        <label><input type="checkbox"> Send payment reminders</label>
                    </div>
                    <div class="form-group">
                        <label>Late Fee Amount</label>
                        <input type="text" value="$50" class="form-input">
                    </div>
                    <div class="form-group">
                        <label>Grace Period (days)</label>
                        <input type="number" value="5" class="form-input">
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div id="notification-section" class="settings-section">
                <div class="settings-card">
                    <h3><i class="fas fa-bell"></i> Notification Preferences</h3>
                    <div class="notification-option">
                        <div class="option-info">
                            <strong>Email Notifications</strong>
                            <span>Receive important updates via email</span>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="notification-option">
                        <div class="option-info">
                            <strong>Payment Reminders</strong>
                            <span>Get notified when rent is due</span>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="notification-option">
                        <div class="option-info">
                            <strong>Maintenance Alerts</strong>
                            <span>Receive new maintenance requests</span>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="notification-option">
                        <div class="option-info">
                            <strong>Lease Expiration</strong>
                            <span>Get notified 30 days before lease ends</span>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Security -->
            <div id="security-section" class="settings-section">
                <div class="settings-card">
                    <h3><i class="fas fa-key"></i> Change Password</h3>
                    <form class="settings-form">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" placeholder="Enter current password" class="form-input">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" placeholder="Enter new password" class="form-input">
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" placeholder="Confirm new password" class="form-input">
                        </div>
                        <button type="submit" class="btn-save">Update Password</button>
                    </form>
                </div>

                <div class="settings-card">
                    <h3><i class="fas fa-shield-alt"></i> Two-Factor Authentication</h3>
                    <p>Add an extra layer of security to your account</p>
                    <button class="btn-enable">Enable 2FA</button>
                </div>
            </div>

            <!-- System Preferences -->
            <div id="system-section" class="settings-section">
                <div class="settings-card">
                    <h3><i class="fas fa-database"></i> Data Management</h3>
                    <button class="btn-export-data">Export All Data</button>
                    <button class="btn-backup">Create Backup</button>
                </div>
                <div class="settings-card">
                    <h3><i class="fas fa-palette"></i> Appearance</h3>
                    <div class="theme-options">
                        <button class="theme-btn light active">Light</button>
                        <button class="theme-btn dark">Dark</button>
                        <button class="theme-btn auto">Auto</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.settings-container { max-width: 1200px; margin: 0 auto; }
.settings-layout { display: grid; grid-template-columns: 280px 1fr; gap: 30px; }
.settings-sidebar { background: white; border-radius: 20px; padding: 20px; height: fit-content; }
.settings-nav { display: flex; flex-direction: column; gap: 8px; }
.settings-nav-item { padding: 12px 16px; background: none; border: none; border-radius: 12px; cursor: pointer; text-align: left; font-weight: 500; transition: 0.2s; display: flex; align-items: center; gap: 12px; }
.settings-nav-item i { width: 20px; color: #64748b; }
.settings-nav-item.active { background: #667eea; color: white; }
.settings-nav-item.active i { color: white; }
.settings-nav-item:hover:not(.active) { background: #f1f5f9; }
.settings-section { display: none; }
.settings-section.active { display: block; }
.settings-card { background: white; border-radius: 20px; padding: 24px; margin-bottom: 24px; border: 1px solid #eef2f6; }
.settings-card h3 { margin-bottom: 20px; font-size: 18px; color: #1e293b; }
.settings-form { display: flex; flex-direction: column; gap: 20px; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.form-group { display: flex; flex-direction: column; gap: 8px; }
.form-group label { font-size: 13px; font-weight: 600; color: #475569; }
.form-input { padding: 10px 14px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; }
.form-input.disabled { background: #f1f5f9; color: #94a3b8; }
.avatar-upload { display: flex; align-items: center; gap: 20px; margin-top: 10px; }
.btn-upload, .btn-save, .btn-cancel, .btn-configure, .btn-connect, .btn-enable, .btn-export-data, .btn-backup { padding: 10px 20px; border-radius: 10px; cursor: pointer; font-weight: 500; transition: 0.2s; }
.btn-save { background: #667eea; color: white; border: none; }
.btn-cancel { background: #f1f5f9; border: none; }
.form-actions { display: flex; gap: 12px; margin-top: 10px; }
.payment-methods { display: flex; flex-direction: column; gap: 15px; }
.payment-method { display: flex; align-items: center; gap: 15px; padding: 15px; background: #f8fafc; border-radius: 12px; }
.payment-method i { font-size: 40px; }
.payment-info { flex: 1; }
.payment-info strong { display: block; }
.payment-info span { font-size: 12px; color: #64748b; }
.notification-option { display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid #e2e8f0; }
.option-info strong { display: block; margin-bottom: 4px; }
.option-info span { font-size: 12px; color: #64748b; }
.toggle-switch { position: relative; display: inline-block; width: 50px; height: 24px; }
.toggle-switch input { opacity: 0; width: 0; height: 0; }
.toggle-slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; transition: 0.3s; border-radius: 24px; }
.toggle-slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: 0.3s; border-radius: 50%; }
input:checked + .toggle-slider { background-color: #667eea; }
input:checked + .toggle-slider:before { transform: translateX(26px); }
.theme-options { display: flex; gap: 12px; }
.theme-btn { padding: 8px 16px; background: #f1f5f9; border: none; border-radius: 8px; cursor: pointer; }
.theme-btn.active { background: #667eea; color: white; }
@media (max-width: 768px) { .settings-layout { grid-template-columns: 1fr; } .form-row { grid-template-columns: 1fr; } }
</style>

<script>
document.querySelectorAll('.settings-nav-item').forEach(item => {
    item.addEventListener('click', () => {
        document.querySelectorAll('.settings-nav-item').forEach(nav => nav.classList.remove('active'));
        document.querySelectorAll('.settings-section').forEach(section => section.classList.remove('active'));
        item.classList.add('active');
        document.getElementById(`${item.dataset.section}-section`).classList.add('active');
    });
});

document.querySelectorAll('.theme-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.theme-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        alert(`Theme changed to ${btn.textContent} mode`);
    });
});
</script>
@endsection