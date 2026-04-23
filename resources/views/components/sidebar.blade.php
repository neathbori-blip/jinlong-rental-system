<div class="w-64 h-screen bg-#3700B3 text-black fixed">

    <div class="p-4 text-2xl font-bold shadow">
        Rental System
    </div>

    <ul class="mt-4">

        <li>
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 hover:bg-secondary hover:text-black 
               {{ request()->routeIs('dashboard') ? 'bg-secondary text-black' : '' }}">
                Dashboard
            </a>
        </li>

        <li>
            <a href=""
               class="block px-4 py-2 hover:bg-secondary hover:text-black 
               {{ request()->routeIs('properties.*') ? 'bg-secondary text-black' : '' }}">
                Properties
            </a>
        </li>

        <li>
            <a href=""
               class="block px-4 py-2 hover:bg-secondary hover:text-black 
               {{ request()->routeIs('tenants.*') ? 'bg-secondary text-black' : '' }}">
                Tenants
            </a>
        </li>

        <li>
            <a href=""
               class="block px-4 py-2 hover:bg-secondary hover:text-black 
               {{ request()->routeIs('leases.*') ? 'bg-secondary text-black' : '' }}">
                Leases
            </a>
        </li>

        <li>
            <a href=""
               class="block px-4 py-2 hover:bg-secondary hover:text-black 
               {{ request()->routeIs('payments.*') ? 'bg-secondary text-black' : '' }}">
                Payments
            </a>
        </li>

    </ul>

</div>