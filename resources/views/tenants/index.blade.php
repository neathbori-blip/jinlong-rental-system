@extends('layouts.app')

@section('title', 'Tenant Management')

@section('content')
<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <h4>Total Tenants</h4>
            <div class="stat-number" id="totalTenants">{{ $totalTenants ?? 0 }}</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-info">
            <h4>Active Tenants</h4>
            <div class="stat-number" id="activeTenants">{{ $activeTenants ?? 0 }}</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-user-check"></i>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-info">
            <h4>Inactive Tenants</h4>
            <div class="stat-number" id="inactiveTenants">{{ ($totalTenants ?? 0) - ($activeTenants ?? 0) }}</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-user-slash"></i>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-info">
            <h4>Monthly Revenue</h4>
            <div class="stat-number">${{ number_format($totalMonthlyRent ?? 0, 2) }}</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-dollar-sign"></i>
        </div>
    </div>
</div>

<!-- Tenants Table -->
<div class="recent-section">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
        <div class="section-title">
            <i class="fas fa-users" style="color: #667eea;"></i> Tenants Directory
        </div>
        <button id="openAddModalBtn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 500; transition: all 0.3s;">
            <i class="fas fa-plus-circle"></i> Add New Tenant
        </button>
    </div>
    
    <!-- Search Bar -->
    <div style="margin-bottom: 20px;">
        <div style="position: relative; max-width: 300px;">
            <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #999;"></i>
            <input type="text" id="searchInput" 
                   style="width: 100%; padding: 10px 10px 10px 35px; border: 1px solid #ddd; border-radius: 8px; font-family: 'Inter', sans-serif;"
                   placeholder="Search by name, email, or unit...">
        </div>
    </div>
    
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Unit</th>
                    <th>Status</th>
                    <th>Lease Start</th>
                    <th>Rent</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tenantTableBody">
                @forelse($tenants ?? [] as $tenant)
                <tr class="tenant-row" data-name="{{ strtolower($tenant->full_name) }}" data-email="{{ strtolower($tenant->email) }}" data-unit="{{ strtolower($tenant->unit) }}">
                    <td>{{ $tenant->id }}</td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                                <i class="fas fa-user" style="font-size: 14px;"></i>
                            </div>
                            <strong>{{ $tenant->full_name }}</strong>
                        </div>
                    </td>
                    <td>{{ $tenant->email }}</td>
                    <td>{{ $tenant->phone ?? '-' }}</td>
                    <td><span style="background: #f0f0f0; padding: 4px 8px; border-radius: 5px; font-size: 12px;">{{ $tenant->unit }}</span></td>
                    <td>
                        <span class="badge {{ $tenant->status === 'active' ? 'badge-active' : 'badge-pending' }}">
                            {{ ucfirst($tenant->status) }}
                        </span>
                    </td>
                    <td>{{ $tenant->lease_start_date ? date('M d, Y', strtotime($tenant->lease_start_date)) : 'N/A' }}</td>
                    <td><strong>${{ number_format($tenant->monthly_rent ?? 0, 2) }}</strong></td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <button onclick="viewTenant({{ $tenant->id }})" style="background: none; border: none; cursor: pointer; color: #2196F3; font-size: 16px;" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button onclick="editTenant({{ $tenant->id }})" style="background: none; border: none; cursor: pointer; color: #FF9800; font-size: 16px;" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteTenant({{ $tenant->id }})" style="background: none; border: none; cursor: pointer; color: #f44336; font-size: 16px;" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align: center; padding: 50px; color: #999;">
                        <i class="fas fa-users" style="font-size: 48px; margin-bottom: 15px; display: block;"></i>
                        No tenants found. Click "Add New Tenant" to get started.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Tenant Modal -->
<div id="tenantModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2000; justify-content: center; align-items: center;">
    <div style="background: white; border-radius: 12px; width: 90%; max-width: 600px; max-height: 90vh; overflow-y: auto;">
        <div style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
            <h3 id="modalTitle" style="color: #333;">
                <i class="fas fa-user-plus" style="color: #667eea;"></i> Add New Tenant
            </h3>
            <button id="closeModalBtn" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #999;">&times;</button>
        </div>
        
        <div style="padding: 20px;">
            <form id="tenantForm" onsubmit="return false;">
                @csrf
                <input type="hidden" id="tenantId" name="tenant_id">
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555;">Full Name *</label>
                    <input type="text" id="fullName" name="full_name" required 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-family: 'Inter', sans-serif;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555;">Email *</label>
                    <input type="email" id="email" name="email" required 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-family: 'Inter', sans-serif;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555;">Phone Number</label>
                    <input type="text" id="phone" name="phone" 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-family: 'Inter', sans-serif;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555;">Unit/Apartment *</label>
                    <input type="text" id="unit" name="unit" required 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-family: 'Inter', sans-serif;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555;">Status</label>
                    <select id="status" name="status" 
                            style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-family: 'Inter', sans-serif;">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555;">Lease Start Date</label>
                    <input type="date" id="leaseStartDate" name="lease_start_date" 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-family: 'Inter', sans-serif;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555;">Monthly Rent ($)</label>
                    <input type="number" id="monthlyRent" name="monthly_rent" step="0.01" 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-family: 'Inter', sans-serif;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555;">Security Deposit ($)</label>
                    <input type="number" id="securityDeposit" name="security_deposit" step="0.01" 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-family: 'Inter', sans-serif;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555;">Address</label>
                    <textarea id="address" name="address" rows="2" 
                              style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-family: 'Inter', sans-serif;"></textarea>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555;">Emergency Contact</label>
                    <textarea id="emergencyContact" name="emergency_contact" rows="2" 
                              style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-family: 'Inter', sans-serif;"></textarea>
                </div>
            </form>
        </div>
        
        <div style="padding: 20px; border-top: 1px solid #eee; display: flex; justify-content: flex-end; gap: 10px;">
            <button id="cancelModalBtn" style="padding: 10px 20px; background: #f0f0f0; border: none; border-radius: 6px; cursor: pointer;">Cancel</button>
            <button id="saveTenantBtn" style="padding: 10px 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 6px; cursor: pointer;">
                <i class="fas fa-save"></i> Save Tenant
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Wait for DOM to load
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page loaded');
    
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.tenant-row');
            
            rows.forEach(row => {
                const name = row.getAttribute('data-name') || '';
                const email = row.getAttribute('data-email') || '';
                const unit = row.getAttribute('data-unit') || '';
                
                if (name.includes(searchTerm) || email.includes(searchTerm) || unit.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    // Modal handling
    const modal = document.getElementById('tenantModal');
    const modalTitle = document.getElementById('modalTitle');
    
    // Open add modal
    const openAddModalBtn = document.getElementById('openAddModalBtn');
    if (openAddModalBtn) {
        openAddModalBtn.addEventListener('click', () => {
            modalTitle.innerHTML = '<i class="fas fa-user-plus" style="color: #667eea;"></i> Add New Tenant';
            document.getElementById('tenantForm').reset();
            document.getElementById('tenantId').value = '';
            document.getElementById('leaseStartDate').value = new Date().toISOString().slice(0,10);
            modal.style.display = 'flex';
        });
    }
    
    // Close modal functions
    function closeModal() {
        modal.style.display = 'none';
    }
    
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    
    if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
    if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeModal);
    
    // Click outside to close
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
    
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
                    Swal.fire('Error!', errorMsg, 'error');
                }
            } catch (error) {
                Swal.fire('Error!', 'Something went wrong!', 'error');
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
            title: '<div style="color: #667eea;">Tenant Details</div>',
            html: `
                <div style="text-align: left;">
                    <p><strong>Full Name:</strong> ${tenant.full_name}</p>
                    <p><strong>Email:</strong> ${tenant.email}</p>
                    <p><strong>Phone:</strong> ${tenant.phone || '-'}</p>
                    <p><strong>Unit:</strong> ${tenant.unit}</p>
                    <p><strong>Status:</strong> <span class="badge ${tenant.status === 'active' ? 'badge-active' : 'badge-pending'}">${tenant.status}</span></p>
                    <p><strong>Lease Start:</strong> ${tenant.lease_start_date || 'N/A'}</p>
                    <p><strong>Monthly Rent:</strong> <strong>$${parseFloat(tenant.monthly_rent || 0).toLocaleString()}</strong></p>
                    ${tenant.address ? `<p><strong>Address:</strong> ${tenant.address}</p>` : ''}
                    ${tenant.emergency_contact ? `<p><strong>Emergency Contact:</strong> ${tenant.emergency_contact}</p>` : ''}
                </div>
            `,
            icon: 'info',
            confirmButtonColor: '#667eea'
        });
    } catch (error) {
        Swal.fire('Error!', 'Could not load tenant details', 'error');
    }
};

// Edit tenant
window.editTenant = async function(id) {
    try {
        const response = await fetch(`/tenants/${id}`);
        const tenant = await response.json();
        
        const modal = document.getElementById('tenantModal');
        const modalTitle = document.getElementById('modalTitle');
        
        modalTitle.innerHTML = '<i class="fas fa-user-edit" style="color: #667eea;"></i> Edit Tenant';
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
        
        modal.style.display = 'flex';
    } catch (error) {
        Swal.fire('Error!', 'Could not load tenant data', 'error');
    }
};

// Delete tenant
window.deleteTenant = async function(id) {
    const result = await Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#667eea',
        cancelButtonColor: '#d33',
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
            Swal.fire('Error!', 'Could not delete tenant', 'error');
        }
    }
};
</script>

<style>
    .tenant-row {
        transition: all 0.3s;
    }
    .tenant-row:hover {
        background-color: #f9f9f9;
    }
    button:hover {
        opacity: 0.8;
        transform: scale(1.05);
        transition: all 0.2s;
    }
</style>
@endsection