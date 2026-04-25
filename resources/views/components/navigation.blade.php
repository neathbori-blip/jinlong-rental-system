<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="px-6 py-4 flex justify-between items-center">
        <!-- Page Title -->
        <h2 class="text-2xl font-bold text-gray-800">
            @yield('page-title', 'Dashboard')
        </h2>

        <!-- Right Side -->
        <div class="flex items-center space-x-4">
            <!-- Notifications -->
            <button class="relative p-2 text-gray-500 hover:text-primary transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span class="absolute top-1 right-1 w-2 h-2 bg-secondary rounded-full"></span>
            </button>

            <!-- User Menu -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?background=03dac6&color=3700B3&name='.urlencode(Auth::user()->name ?? 'User') }}" alt="">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 border border-gray-200" style="display: none;">
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Account Settings</a>
                    <hr class="my-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>