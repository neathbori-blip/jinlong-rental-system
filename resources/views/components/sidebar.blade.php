<div class="w-64 h-screen bg-green/100 shadow text-black fixed">

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

          <li>
            <a href=""
               class="block px-4 py-2 hover:bg-secondary hover:text-black 
               {{ request()->routeIs('maintennce.*') ? 'bg-secondary text-black' : '' }}">
                Maintenance
            </a>
        </li>



          <li>
            <a href=""
               class="block px-4 py-2 hover:bg-secondary hover:text-black 
               {{ request()->routeIs('reports.*') ? 'bg-secondary text-black' : '' }}">
                reports
            </a>
        </li>



          <li>
            <a href=""
               class="block px-4 py-2 hover:bg-secondary hover:text-black 
               {{ request()->routeIs('settings.*') ? 'bg-secondary text-black' : '' }}">
                Settings
            </a>
        </li>


           <li>
            <a href=""
               class="block px-4 py-2 hover:bg-secondary hover:text-black 
               {{ request()->routeIs('logout.*') ? 'bg-secondary text-black' : '' }}">
                Logout
            </a>
        </li>

    </ul>

</div>