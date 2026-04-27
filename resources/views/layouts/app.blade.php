<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jinglong Rental</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Custom scrollbar and additional styles */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        .sidebar-transition {
            transition: all 0.3s ease;
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
        }
        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .modal-animation {
            animation: modalSlideIn 0.3s ease;
        }
    </style>
</head>
<body class="font-inter bg-gray-100">
    
    <!-- Sidebar -->
    <div class="sidebar fixed left-0 top-0 w-[260px] h-full bg-gradient-to-br from-purple-600 to-purple-800 text-white z-[1000] sidebar-transition" id="sidebar">
        <div class="text-center py-6 px-5 border-b border-white/10">
            <h3 class="text-2xl font-semibold">
                <i class="fas fa-key mr-2"></i> Jing Long
            </h3>
            <p class="text-xs opacity-80 mt-1">Property Management</p>
        </div>
        
        <div class="py-5">
            <div class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }} px-6 py-3 mx-0 my-1 transition-all duration-300 hover:bg-white/10 hover:pl-7 cursor-pointer {{ request()->routeIs('dashboard') ? 'bg-white/20 border-l-4 border-white' : '' }}">
                <a href="{{ route('dashboard') }}" class="text-white no-underline flex items-center gap-3">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            
            <div class="sidebar-item {{ request()->routeIs('properties.*') ? 'active' : '' }} px-6 py-3 mx-0 my-1 transition-all duration-300 hover:bg-white/10 hover:pl-7 cursor-pointer {{ request()->routeIs('properties.*') ? 'bg-white/20 border-l-4 border-white' : '' }}">
                <a href="{{ route('properties.index') }}" class="text-white no-underline flex items-center gap-3">
                    <i class="fas fa-building w-5"></i>
                    <span>Properties</span>
                </a>
            </div>
            
            <div class="sidebar-item {{ request()->routeIs('tenants.*') ? 'active' : '' }} px-6 py-3 mx-0 my-1 transition-all duration-300 hover:bg-white/10 hover:pl-7 cursor-pointer {{ request()->routeIs('tenants.*') ? 'bg-white/20 border-l-4 border-white' : '' }}">
                <a href="{{ route('tenants.index') }}" class="text-white no-underline flex items-center gap-3">
                    <i class="fas fa-users w-5"></i>
                    <span>Tenants</span>
                </a>
            </div>
            
            <div class="sidebar-item {{ request()->routeIs('payments.*') ? 'active' : '' }} px-6 py-3 mx-0 my-1 transition-all duration-300 hover:bg-white/10 hover:pl-7 cursor-pointer {{ request()->routeIs('payments.*') ? 'bg-white/20 border-l-4 border-white' : '' }}">
                <a href="{{ route('payments.index') }}" class="text-white no-underline flex items-center gap-3">
                    <i class="fas fa-money-bill-wave w-5"></i>
                    <span>Payments</span>
                </a>
            </div>
            
            <div class="sidebar-item {{ request()->routeIs('leases.*') ? 'active' : '' }} px-6 py-3 mx-0 my-1 transition-all duration-300 hover:bg-white/10 hover:pl-7 cursor-pointer {{ request()->routeIs('leases.*') ? 'bg-white/20 border-l-4 border-white' : '' }}">
                <a href="{{ route('leases.index') }}" class="text-white no-underline flex items-center gap-3">
                    <i class="fas fa-file-signature w-5"></i>
                    <span>Leases</span>
                </a>
            </div>
            
            <div class="sidebar-item {{ request()->routeIs('maintenance.*') ? 'active' : '' }} px-6 py-3 mx-0 my-1 transition-all duration-300 hover:bg-white/10 hover:pl-7 cursor-pointer {{ request()->routeIs('maintenance.*') ? 'bg-white/20 border-l-4 border-white' : '' }}">
                <a href="{{ route('maintenance.index') }}" class="text-white no-underline flex items-center gap-3">
                    <i class="fas fa-tools w-5"></i>
                    <span>Maintenance</span>
                </a>
            </div>
            
            <div class="sidebar-item {{ request()->routeIs('reports.*') ? 'active' : '' }} px-6 py-3 mx-0 my-1 transition-all duration-300 hover:bg-white/10 hover:pl-7 cursor-pointer {{ request()->routeIs('reports.*') ? 'bg-white/20 border-l-4 border-white' : '' }}">
                <a href="{{ route('reports.index') }}" class="text-white no-underline flex items-center gap-3">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Reports</span>
                </a>
            </div>
            
            <div class="sidebar-item {{ request()->routeIs('settings.*') ? 'active' : '' }} px-6 py-3 mx-0 my-1 transition-all duration-300 hover:bg-white/10 hover:pl-7 cursor-pointer {{ request()->routeIs('settings.*') ? 'bg-white/20 border-l-4 border-white' : '' }}">
                <a href="{{ route('settings.index') }}" class="text-white no-underline flex items-center gap-3">
                    <i class="fas fa-cog w-5"></i>
                    <span>Settings</span>
                </a>
            </div>
            
            <div class="sidebar-item px-6 py-3 mx-0 my-1 transition-all duration-300 hover:bg-white/10 hover:pl-7 cursor-pointer">
                <a href="javascript:void(0)" onclick="showLogoutModal()" class="text-white no-underline flex items-center gap-3">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>

   
    <div class="main-content ml-[260px] transition-all duration-300 max-md:ml-0" id="mainContent">
        <!-- Top Navbar -->
        <div class="bg-white px-8 py-4 shadow-sm flex justify-between items-center">
            <div class="menu-toggle hidden text-2xl cursor-pointer max-md:block" id="menuToggle">
                <i class="fas fa-bars"></i>
            </div>
            <div class="user-info flex items-center gap-4">
                <span>Welcome, {{ Auth::user()->name ?? 'Admin' }}</span>
                <div class="user-avatar w-10 h-10 bg-gradient-to-br from-purple-600 to-purple-800 rounded-full flex items-center justify-center text-white font-bold">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="p-8">
            @yield('content')
        </div>
    </div>

    <!-- Logout Modal -->
    <div id="logoutModal" class="modal hidden fixed top-0 left-0 w-full h-full bg-black/50 z-[9999] items-center justify-center">
        <div class="modal-content bg-white rounded-2xl w-[90%] max-w-md overflow-hidden modal-animation">
            <div class="modal-header bg-gradient-to-br from-purple-600 to-purple-800 text-white p-5 text-center">
                <i class="fas fa-sign-out-alt text-5xl mb-2"></i>
                <h3 class="text-xl font-semibold">Confirm Logout</h3>
            </div>
            <div class="modal-body p-8 text-center">
                <p class="text-gray-800">Are you sure you want to logout?</p>
                <p class="text-xs text-gray-500 mt-2">You will need to login again to access your account.</p>
            </div>
            <div class="modal-footer p-5 flex gap-3 justify-center border-t border-gray-200">
                <button class="btn-cancel-logout bg-gray-100 text-gray-700 px-5 py-2 rounded-xl cursor-pointer font-medium hover:bg-gray-200 transition" id="cancelLogoutBtn">
                    <i class="fas fa-times mr-1"></i> Cancel
                </button>
                <form method="POST" action="{{ route('logout') }}" id="logoutForm" class="inline">
                    @csrf
                    <button type="submit" class="btn-confirm-logout bg-red-500 text-white px-5 py-2 rounded-xl cursor-pointer font-medium hover:bg-red-600 transition">
                        <i class="fas fa-sign-out-alt mr-1"></i> Yes, Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('-left-[260px]');
                sidebar.classList.toggle('left-0');
            });
        }

        // Logout modal functions
        function showLogoutModal() {
            const modal = document.getElementById('logoutModal');
            if (modal) {
                modal.style.display = 'flex';
                modal.classList.remove('hidden');
            }
        }

        function hideLogoutModal() {
            const modal = document.getElementById('logoutModal');
            if (modal) {
                modal.style.display = 'none';
                modal.classList.add('hidden');
            }
        }

        // Close modal when clicking outside
        const logoutModal = document.getElementById('logoutModal');
        if (logoutModal) {
            logoutModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    hideLogoutModal();
                }
            });
        }

        // Cancel button
        const cancelBtn = document.getElementById('cancelLogoutBtn');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', hideLogoutModal);
        }
        
        // Handle responsive sidebar on window resize
        function handleResponsive() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('-left-[260px]');
                sidebar.classList.remove('left-0');
                mainContent.style.marginLeft = '';
            }
        }
        
        window.addEventListener('resize', handleResponsive);
        handleResponsive();
    </script>
    
    <!-- Additional Tailwind Utilities -->
    <style>
        @media (max-width: 768px) {
            .sidebar {
                left: -260px;
            }
            .sidebar.active {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
        
        /* Re-create the sidebar transition for mobile */
        .sidebar {
            transition: left 0.3s ease;
        }
    </style>
</body>
</html>