<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script type="module" src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
</head>
<body>

<div class="min-h-screen flex items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-2xl border border-gray-100">
        
        <div class="text-center">
            <div class="mx-auto h-12 w-12 rounded-full bg-[#3700B3] flex items-center justify-center shadow-lg">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="Open-Lock-Icon-Path-Here" />
                </svg>
            </div>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Account Login</h2>
            <p class="mt-2 text-sm text-gray-500">Enter your credentials to access the system</p>
        </div>

        <form method="POST" action="{{ url('/login/authenticate') }}">
               @csrf
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                    <input id="email" name="email" type="email" required 
                        class="appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#03dac6] focus:border-transparent transition-all duration-200" 
                        placeholder="yuor@email.com">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" required 
                        class="appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#03dac6] focus:border-transparent transition-all duration-200" 
                        placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember" type="checkbox" 
                        class="h-4 w-4 text-[#3700B3] focus:ring-[#03dac6] border-gray-300 rounded cursor-pointer">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-600 cursor-pointer my-4">Remember me</label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-[#3700B3] hover:text-[#03dac6] transition-colors my-4">Forgot password?</a>
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-[#3700B3] hover:bg-[#2a008a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#03dac6] transform transition-all active:scale-95 shadow-lg">
                    Sign In to Dashboard
                </button>
            </div>
        </form>

        <p class="text-center text-xs text-gray-400 uppercase tracking-widest mt-8">
            &copy; 2026 Internal System
        </p>
    </div>
</div>
    
</body>
</html>