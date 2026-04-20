<!DOCTYPE html>
<html lang="en">
<head>
    @vite('resources/css/app.css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>SalesMartly · Unified Team Chat Platform</title>
    <!-- Tailwind CSS v3 + Google Fonts + Font Awesome Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom config override for better brand feel -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'Segoe UI', 'sans-serif'],
                    },
                    colors: 
                        brand: {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    },
                    boxShadow: {
                        'soft': '0 12px 30px -12px rgba(0, 0, 0, 0.08)',
                        'card': '0 20px 35px -12px rgba(0, 0, 0, 0.05)',
                    }
                }
            }
        
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* smooth transitions & focus rings */
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        .focus-ring:focus {
            outline: none;
            ring: 2px solid #3b82f6;
            ring-offset: 2px;
        }
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.12);
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800">

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <!-- main two-column layout: signup form + right visual content -->
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-start">
            
            <!-- LEFT COLUMN: Registration Card -->
            <div class="bg-white rounded-3xl shadow-card border border-gray-100/80 overflow-hidden transition-all duration-200">
                <div class="p-6 sm:p-8 lg:p-10">
                    <!-- Brand headline -->
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold tracking-tight bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">JinLong System</h1>
                        <p class="text-gray-500 mt-1 text-sm">Supercharge team collaboration</p>
                    </div>

                    <!-- Signup heading -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Sign up and start a free plan</h2>
                        <div class="flex items-center gap-1 mt-2 text-sm text-gray-600">
                            <span>Already have an account?</span>
                            <a href="#" class="font-medium text-brand-600 hover:text-brand-700 transition-colors">Login</a>
                        </div>
                    </div>

                    <!-- Registration form (pure HTML/CSS, ready for Laravel backend) -->
                    <form action="#" method="POST" class="space-y-5">
                        <!-- Account name field -->
                        <div>
                            <label for="account_name" class="block text-sm font-medium text-gray-700 mb-1.5">Account name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <i class="fas fa-building text-sm"></i>