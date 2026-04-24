{{-- resources/views/tenants/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Tenant Management System')

@section('content')
<div class="tenant-container">
    <!-- Modern Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card stat-card-primary">
            <div class="stat-card-inner">
                <div class="stat-left">
                    <div class="stat-label">Total Tenants</div>
                    <div class="stat-value">{{ isset($totalTenants) ? $totalTenants : 0 }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-trend">
                <i class="fas fa-chart-line"></i> <span>All registered tenants</span>
            </div>
        </div>

        <div class="stat-card stat-card-success">
            <div class="stat-card-inner">
                <div class="stat-left">
                    <div class="stat-label">Active Tenants</div>
                    <div class="stat-value">{{ isset($activeTenants) ? $activeTenants : 0 }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
            <div class="stat-trend">
                <i class="fas fa-check-circle"></i> <span>Currently active</span>
            </div>
        </div>

        <div class="stat-card stat-card-warning">
            <div class="stat-card-inner">
                <div class="stat-left">
                    <div class="stat-label">Monthly Revenue</div>
                    <div class="stat-value">${{ isset($totalMonthlyRent) ? number_format($totalMonthlyRent, 0) : 0 }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <div class="stat-trend">
                <i class="fas fa-calendar-alt"></i> <span>Expected this month</span>
            </div>
        </div>

        <div class="stat-card stat-card-info">
            <div class="stat-card-inner">
                <div class="stat-left">
                    <div class="stat-label">Occupancy Rate</div>
                    <div class="stat-value">
                        @php
                            $total = isset($totalTenants) ? $totalTenants : 0;
                            $active = isset($activeTenants) ? $activeTenants : 0;
                            $rate = $total > 0 ? round(($active / $total) * 100) : 0;
                        @endphp
                        {{ $rate }}%
                    </div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-building"></i>
                </div>
            </div>
            <div class="stat-trend">
                <i class="fas fa-home"></i> <span>{{ $total - $active }} units available</span>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="content-card">
        <div class="card-header">
            <div class="header-title">
                <i class="fas fa-users" style="color: #3b82f6;"></i>
                <h3>Tenants Directory</h3>
                <span class="badge-count">{{ isset($tenants) ? $tenants->count() : 0 }} total</span>
            </div>
            <button class="btn-primary" id="openAddModalBtn">
                <i class="fas fa-plus-circle"></i> Add New Tenant
            </button>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-section">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" class="search-input" 
                       placeholder="Search by name, email, or unit number...">
            </div>
            <div class="filter-group">
                <select id="statusFilter" class="filter-select">
                    <option value="all">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <button class="btn-refresh" onclick="window.location.reload()">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>

        <!-- Tenants Table -->
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tenant Details</th>
                        <th>Contact Info</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Lease Info</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tenantTableBody">
                    @forelse(isset($tenants) && $tenants->count() > 0 ? $tenants : [] as $tenant)
                    <tr class="tenant-row" data-status="{{ $tenant->status }}" 
                        data-name="{{ strtolower($tenant->full_name) }}" 
                        data-email="{{ strtolower($tenant->email) }}" 
                        data-unit="{{ strtolower($tenant->unit) }}">
                        <td class="id-cell">#{{ $tenant->id }}</td>
                        <td>
                            <div class="tenant-info">
                                <div class="avatar">
                                    {{ strtoupper(substr($tenant->full_name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="tenant-name">{{ $tenant->full_name }}</div>
                                    <div class="tenant-meta">Joined: {{ $tenant->created_at->format('M d, Y') }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="contact-info">
                                <div><i class="fas fa-envelope"></i> {{ $tenant->email }}</div>
                                <div><i class="fas fa-phone"></i> {{ $tenant->phone ?? 'Not provided' }}</div>
                            </div>
                        </td>
                        <td>
                            <span class="unit-badge">{{ $tenant->unit }}</span>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $tenant->status }}">
                                {{ ucfirst($tenant->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="lease-info">
                                <div><i class="fas fa-calendar-alt"></i> {{ $tenant->lease_start_date ? date('M d, Y', strtotime($tenant->lease_start_date)) : 'No date set' }}</div>
                                <div><i class="fas fa-dollar-sign"></i> ${{ number_format($tenant->monthly_rent ?? 0, 2) }}/mo</div>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button onclick="viewTenant({{ $tenant->id }})" class="action-btn view-btn" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editTenant({{ $tenant->id }})" class="action-btn edit-btn" title="Edit Tenant">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteTenant({{ $tenant->id }})" class="action-btn delete-btn" title="Delete Tenant">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="empty-state">
                            <i class="fas fa-users" style="font-size: 64px; color: #cbd5e1;"></i>
                            <h4>No tenants found</h4>
                            <p>Click "Add New Tenant" to get started</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modern Modal -->
<div id="tenantModal" class="modern-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">
                <i class="fas fa-user-plus"></i> Add New Tenant
            </h3>
            <button class="modal-close" id="closeModalBtn">&times;</button>
        </div>
        
        <form id="tenantForm" onsubmit="return false;">
            @csrf
            <input type="hidden" id="tenantId" name="tenant_id">
            
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Full Name <span class="required">*</span></label>
                        <input type="text" id="fullName" name="full_name" required placeholder="Enter full name">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email Address <span class="required">*</span></label>
                        <input type="email" id="email" name="email" required placeholder="Enter email address">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-phone"></i> Phone Number</label>
                        <input type="text" id="phone" name="phone" placeholder="Enter phone number">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-building"></i> Unit/Apartment <span class="required">*</span></label>
                        <input type="text" id="unit" name="unit" required placeholder="Enter unit number">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-tag"></i> Status</label>
                        <select id="status" name="status">
                            <option value="active">✅ Active</option>
                            <option value="inactive">⭕ Inactive</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-calendar"></i> Lease Start Date</label>
                        <input type="date" id="leaseStartDate" name="lease_start_date">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-dollar-sign"></i> Monthly Rent</label>
                        <input type="number" id="monthlyRent" name="monthly_rent" step="0.01" placeholder="0.00">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-shield-alt"></i> Security Deposit</label>
                        <input type="number" id="securityDeposit" name="security_deposit" step="0.01" placeholder="0.00">
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-map-marker-alt"></i> Address</label>
                    <textarea id="address" name="address" rows="2" placeholder="Enter full address"></textarea>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-ambulance"></i> Emergency Contact</label>
                    <textarea id="emergencyContact" name="emergency_contact" rows="2" 
                              placeholder="Name: John Doe, Phone: (555) 123-4567, Relation: Brother"></textarea>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn-secondary" id="cancelModalBtn">Cancel</button>
                <button type="submit" class="btn-primary" id="saveTenantBtn">
                    <i class="fas fa-save"></i> Save Tenant
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        const rows = document.querySelectorAll('.tenant-row');
        
        rows.forEach(row => {
            const name = row.getAttribute('data-name') || '';
            const email = row.getAttribute('data-email') || '';
            const unit = row.getAttribute('data-unit') || '';
            const status = row.getAttribute('data-status') || '';
            
            const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm) || unit.includes(searchTerm);
            const matchesStatus = statusValue === 'all' || status === statusValue;
            
            if (matchesSearch && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    if (searchInput) searchInput.addEventListener('input', filterTable);
    if (statusFilter) statusFilter.addEventListener('change', filterTable);
    
    // Modal handling
    const modal = document.getElementById('tenantModal');
    const modalTitle = document.getElementById('modalTitle');
    
    function closeModal() {
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
    
    function openModal() {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    const openAddModalBtn = document.getElementById('openAddModalBtn');
    if (openAddModalBtn) {
        openAddModalBtn.addEventListener('click', () => {
            modalTitle.innerHTML = '<i class="fas fa-user-plus"></i> Add New Tenant';
            document.getElementById('tenantForm').reset();
            document.getElementById('tenantId').value = '';
            document.getElementById('leaseStartDate').value = new Date().toISOString().slice(0,10);
            openModal();
        });
    }
    
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    
    if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
    if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeModal);
    
    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });
    }
    
    // Save tenant
    const saveTenantBtn = document.getElementById('saveTenantBtn');
    if (saveTenantBtn) {
        saveTenantBtn.addEventListener('click', async function(e) {
            e.preventDefault();
            
            const tenantId = document.getElementById('tenantId').value;
            const isEdit = tenantId !== '';
            
            const formData = new FormData();
            formData.append('full_name', document.getElementById('fullName').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('phone', document.getElementById('phone').value);
            formData.append('unit', document.getElementById('unit').value);
            formData.append('status', document.getElementById('status').value);
            formData.append('lease_start_date', document.getElementById('leaseStartDate').value);
            formData.append('monthly_rent', document.getElementById('monthlyRent').value);
            formData.append('security_deposit', document.getElementById('securityDeposit').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('emergency_contact', document.getElementById('emergencyContact').value);
            
            let url = '/tenants';
            let method = 'POST';
            
            if (isEdit) {
                url = `/tenants/${tenantId}`;
                formData.append('_method', 'PUT');
            }
            
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(() => window.location.reload(), 2000);
                } else if (data.errors) {
                    let errorMsg = '';
                    for (let key in data.errors) {
                        errorMsg += data.errors[key][0] + '\n';
                    }
                    Swal.fire('Validation Error', errorMsg, 'error');
                }
            } catch (error) {
                Swal.fire('Error', 'Something went wrong!', 'error');
            }
        });
    }
});

// View tenant details
window.viewTenant = async function(id) {
    try {
        const response = await fetch(`/tenants/${id}`);
        const tenant = await response.json();
        
        Swal.fire({
            title: '<div style="font-size: 24px;">Tenant Details</div>',
            html: `
                <div style="text-align: left;">
                    <div style="background: #f8fafc; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                        <h4 style="color: #3b82f6; margin-bottom: 10px;"><i class="fas fa-user"></i> Personal Information</h4>
                        <p><strong>Full Name:</strong> ${tenant.full_name}</p>
                        <p><strong>Email:</strong> ${tenant.email}</p>
                        <p><strong>Phone:</strong> ${tenant.phone || '-'}</p>
                    </div>
                    <div style="background: #f8fafc; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                        <h4 style="color: #3b82f6; margin-bottom: 10px;"><i class="fas fa-home"></i> Property Details</h4>
                        <p><strong>Unit:</strong> ${tenant.unit}</p>
                        <p><strong>Status:</strong> <span style="padding: 4px 8px; border-radius: 5px; background: ${tenant.status === 'active' ? '#d1fae5' : '#fee2e2'}; color: ${tenant.status === 'active' ? '#065f46' : '#991b1b'}">${tenant.status.toUpperCase()}</span></p>
                        ${tenant.address ? `<p><strong>Address:</strong> ${tenant.address}</p>` : ''}
                    </div>
                    <div style="background: #f8fafc; padding: 15px; border-radius: 10px;">
                        <h4 style="color: #3b82f6; margin-bottom: 10px;"><i class="fas fa-file-invoice-dollar"></i> Financial & Lease</h4>
                        <p><strong>Lease Start:</strong> ${tenant.lease_start_date || 'N/A'}</p>
                        <p><strong>Monthly Rent:</strong> <strong style="color: #059669;">$${parseFloat(tenant.monthly_rent || 0).toLocaleString()}</strong></p>
                        <p><strong>Security Deposit:</strong> $${parseFloat(tenant.security_deposit || 0).toLocaleString()}</p>
                        ${tenant.emergency_contact ? `<p><strong>Emergency Contact:</strong> ${tenant.emergency_contact}</p>` : ''}
                    </div>
                </div>
            `,
            icon: 'info',
            confirmButtonColor: '#3b82f6',
            width: '600px'
        });
    } catch (error) {
        Swal.fire('Error', 'Could not load tenant details', 'error');
    }
};

// Edit tenant
window.editTenant = async function(id) {
    try {
        const response = await fetch(`/tenants/${id}`);
        const tenant = await response.json();
        
        const modal = document.getElementById('tenantModal');
        const modalTitle = document.getElementById('modalTitle');
        
        modalTitle.innerHTML = '<i class="fas fa-user-edit"></i> Edit Tenant';
        document.getElementById('tenantId').value = tenant.id;
        document.getElementById('fullName').value = tenant.full_name;
        document.getElementById('email').value = tenant.email;
        document.getElementById('phone').value = tenant.phone || '';
        document.getElementById('unit').value = tenant.unit;
        document.getElementById('status').value = tenant.status;
        document.getElementById('leaseStartDate').value = tenant.lease_start_date || '';
        document.getElementById('monthlyRent').value = tenant.monthly_rent || 0;
        document.getElementById('securityDeposit').value = tenant.security_deposit || 0;
        document.getElementById('address').value = tenant.address || '';
        document.getElementById('emergencyContact').value = tenant.emergency_contact || '';
        
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    } catch (error) {
        Swal.fire('Error', 'Could not load tenant data', 'error');
    }
};

// Delete tenant
window.deleteTenant = async function(id) {
    const result = await Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!'
    });
    
    if (result.isConfirmed) {
        try {
            const response = await fetch(`/tenants/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                Swal.fire('Deleted!', data.message, 'success');
                setTimeout(() => window.location.reload(), 1500);
            }
        } catch (error) {
            Swal.fire('Error', 'Could not delete tenant', 'error');
        }
    }
};
</script>

<style>
/* Modern CSS Styles */
.tenant-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

/* Stats Cards */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    transition: all 0.3s;
    cursor: pointer;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
}

.stat-card-primary {
    border-left: 4px solid #3b82f6;
}

.stat-card-success {
    border-left: 4px solid #10b981;
}

.stat-card-warning {
    border-left: 4px solid #f59e0b;
}

.stat-card-info {
    border-left: 4px solid #8b5cf6;
}

.stat-card-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.stat-label {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 8px;
}

.stat-value {
    font-size: 32px;
    font-weight: 700;
    color: #1f2937;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.stat-card-primary .stat-icon {
    background: #eff6ff;
    color: #3b82f6;
}

.stat-card-success .stat-icon {
    background: #d1fae5;
    color: #10b981;
}

.stat-card-warning .stat-icon {
    background: #fed7aa;
    color: #f59e0b;
}

.stat-card-info .stat-icon {
    background: #ede9fe;
    color: #8b5cf6;
}

.stat-trend {
    font-size: 12px;
    color: #6b7280;
    padding-top: 12px;
    border-top: 1px solid #e5e7eb;
}

/* Content Card */
.content-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-header {
    padding: 24px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.header-title {
    display: flex;
    align-items: center;
    gap: 12px;
}

.header-title h3 {
    font-size: 20px;
    font-weight: 600;
    color: #1f2937;
    margin: 0;
}

.badge-count {
    background: #eff6ff;
    color: #3b82f6;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
}

.btn-primary {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(59,130,246,0.3);
}

/* Search Section */
.search-section {
    padding: 20px 24px;
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.search-box {
    position: relative;
    flex: 1;
    max-width: 350px;
}

.search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
}

.search-input {
    width: 100%;
    padding: 10px 10px 10px 38px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    font-family: inherit;
    transition: all 0.3s;
}

.search-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
}

.filter-group {
    display: flex;
    gap: 10px;
}

.filter-select {
    padding: 10px 15px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    font-family: inherit;
    cursor: pointer;
}

.btn-refresh {
    padding: 10px 15px;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-refresh:hover {
    background: #f3f4f6;
}

/* Modern Table */
.table-responsive {
    overflow-x: auto;
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
}

.modern-table thead {
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
}

.modern-table th {
    text-align: left;
    padding: 15px 20px;
    font-weight: 600;
    color: #374151;
    font-size: 14px;
}

.modern-table td {
    padding: 16px 20px;
    border-bottom: 1px solid #f3f4f6;
}

.tenant-row:hover {
    background: #fefce8;
}

.id-cell {
    font-weight: 600;
    color: #6b7280;
}

.tenant-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 14px;
}

.tenant-name {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 4px;
}

.tenant-meta {
    font-size: 12px;
    color: #6b7280;
}

.contact-info div {
    font-size: 13px;
    margin-bottom: 4px;
    color: #4b5563;
}

.contact-info i {
    width: 20px;
    color: #9ca3af;
}

.unit-badge {
    background: #f3e8ff;
    color: #9333ea;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.status-active {
    background: #d1fae5;
    color: #065f46;
}

.status-inactive {
    background: #fee2e2;
    color: #991b1b;
}

.lease-info div {
    font-size: 13px;
    margin-bottom: 4px;
    color: #4b5563;
}

.lease-info i {
    width: 20px;
    color: #9ca3af;
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.action-btn {
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.view-btn {
    background: #eff6ff;
    color: #3b82f6;
}

.edit-btn {
    background: #fef3c7;
    color: #d97706;
}

.delete-btn {
    background: #fee2e2;
    color: #dc2626;
}

.action-btn:hover {
    transform: scale(1.1);
}

.empty-state {
    text-align: center;
    padding: 60px !important;
}

.empty-state h4 {
    margin: 15px 0 10px;
    color: #374151;
}

.empty-state p {
    color: #6b7280;
}

/* Modern Modal */
.modern-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 2000;
    justify-content: center;
    align-items: center;
    backdrop-filter: blur(4px);
}

.modern-modal.show {
    display: flex;
}

.modal-content {
    background: white;
    border-radius: 20px;
    width: 90%;
    max-width: 700px;
    max-height: 90vh;
    overflow-y: auto;
    animation: slideUp 0.3s;
}

@keyframes slideUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.modal-header {
    padding: 20px 24px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    font-size: 20px;
    color: #1f2937;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.modal-close {
    background: none;
    border: none;
    font-size: 28px;
    cursor: pointer;
    color: #9ca3af;
    transition: all 0.2s;
}

.modal-close:hover {
    color: #1f2937;
}

.modal-body {
    padding: 24px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #374151;
    font-size: 14px;
}

.required {
    color: #ef4444;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    font-family: inherit;
    transition: all 0.3s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
}

.modal-footer {
    padding: 20px 24px;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

.btn-secondary {
    padding: 10px 20px;
    background: #f3f4f6;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s;
}

.btn-secondary:hover {
    background: #e5e7eb;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }
    
    .search-section {
        flex-direction: column;
        align-items: stretch;
    }
    
    .search-box {
        max-width: 100%;
    }
}
</style>
@endsection