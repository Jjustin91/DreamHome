<aside class="flex flex-col w-64 h-screen px-4 py-8 overflow-y-auto bg-dh-charcoal border-r rtl:border-r-0 rtl:border-l border-dh-charcoal shadow-lg">
    
    <div class="flex items-center justify-center pb-6 mt-2 mb-6 border-b border-dh-sand/20">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
            
        <div class="p-2 transition-colors duration-300 rounded-lg shadow-md bg-dh-forest group-hover:bg-dh-sand">
            <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10L12 3l9 7" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 9v11a1 1 0 001 1h12a1 1 0 001-1V9" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V14a1 1 0 011-1h4a1 1 0 011 1v7" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 6.5V3h-2v1.5" />
            </svg>
        </div>
            
            <span class="text-2xl font-black tracking-widest text-white uppercase">
                Dream<span class="text-dh-sand">Home</span>
            </span>
            
        </a>
    </div>

    <div class="flex flex-col justify-between flex-1 mt-2">
        <nav class="-mx-3 space-y-2">
            
            <a class="flex items-center px-3 py-2 transition-colors duration-300 transform rounded-lg {{ request()->routeIs('dashboard') ? 'bg-dh-forest text-dh-light' : 'text-dh-light/80 hover:bg-dh-forest hover:text-dh-light' }}" href="{{ route('dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-dh-sand' : '' }}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                <span class="mx-2 text-sm font-medium">Dashboard</span>
            </a>

            @role('Super Admin')
                <div class="pt-4 pb-1">
                    <p class="px-3 text-xs font-semibold tracking-wider text-dh-sand uppercase">System Setup</p>
                </div>
                
                <a class="flex items-center px-3 py-2 transition-colors duration-300 transform rounded-lg {{ request()->routeIs('branches.*') ? 'bg-dh-forest text-dh-light' : 'text-dh-light/80 hover:bg-dh-forest hover:text-dh-light' }}" href="{{ route('branches.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('branches.*') ? 'text-dh-sand' : '' }}">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Manage Branches</span>
                </a>

                <a class="flex items-center px-3 py-2 transition-colors duration-300 transform rounded-lg {{ request()->routeIs('managers.*') ? 'bg-dh-forest text-dh-light' : 'text-dh-light/80 hover:bg-dh-forest hover:text-dh-light' }}" href="{{ route('managers.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('managers.*') ? 'text-dh-sand' : '' }}">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">System Managers</span>
                </a>
            @endrole

            @hasanyrole('Super Admin|Manager')
                <div class="pt-4 pb-1">
                    <p class="px-3 text-xs font-semibold tracking-wider text-dh-sand uppercase">Branch Management</p>
                </div>
                
                <a class="flex items-center px-3 py-2 transition-colors duration-300 transform rounded-lg {{ request()->routeIs('staff.*') ? 'bg-dh-forest text-dh-light' : 'text-dh-light/80 hover:bg-dh-forest hover:text-dh-light' }}" href="{{ route('staff.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('staff.*') ? 'text-dh-sand' : '' }}">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Manage Staff</span>
                </a>
                
                <a class="flex items-center px-3 py-2 mt-2 transition-colors duration-300 transform rounded-lg {{ request()->routeIs('newspapers.*') ? 'bg-dh-forest text-dh-light' : 'text-dh-light/80 hover:bg-dh-forest hover:text-dh-light' }}" href="{{ route('newspapers.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('newspapers.*') ? 'text-dh-sand' : '' }}">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Newspapers</span>
                </a>
            @endhasanyrole

            @hasanyrole('Super Admin|Manager|Supervisor')
                <div class="pt-4 pb-1">
                    <p class="px-3 text-xs font-semibold tracking-wider text-dh-sand uppercase">Admin Operations</p>
                </div>
                
                <a class="flex items-center px-3 py-2 transition-colors duration-300 transform rounded-lg {{ request()->routeIs('properties.*') ? 'bg-dh-forest text-dh-light' : 'text-dh-light/80 hover:bg-dh-forest hover:text-dh-light' }}" href="{{ route('properties.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('properties.*') ? 'text-dh-sand' : '' }}">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Properties</span>
                </a>

                <a class="flex items-center px-3 py-2 mt-2 transition-colors duration-300 transform rounded-lg {{ request()->routeIs('owners.*') ? 'bg-dh-forest text-dh-light' : 'text-dh-light/80 hover:bg-dh-forest hover:text-dh-light' }}" href="{{ route('owners.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('owners.*') ? 'text-dh-sand' : '' }}">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Owners</span>
                </a>

                <a class="flex items-center px-3 py-2 mt-2 transition-colors duration-300 transform rounded-lg {{ request()->routeIs('clients.*') ? 'bg-dh-forest text-dh-light' : 'text-dh-light/80 hover:bg-dh-forest hover:text-dh-light' }}" href="{{ route('clients.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('clients.*') ? 'text-dh-sand' : '' }}">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Clients & Renters</span>
                </a>
                
                <a class="flex items-center px-3 py-2 mt-2 transition-colors duration-300 transform rounded-lg {{ request()->routeIs('leases.*') ? 'bg-dh-forest text-dh-light' : 'text-dh-light/80 hover:bg-dh-forest hover:text-dh-light' }}" href="{{ route('leases.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('leases.*') ? 'text-dh-sand' : '' }}">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Lease Agreements</span>
                </a>
            @endhasanyrole

            {{-- ------------------------------------------------------------- --}}
            {{-- MODULE 3: ALL STAFF OPERATIONS (Unrestricted)                   --}}
            {{-- ------------------------------------------------------------- --}}
            <div class="pt-4 pb-1">
                <p class="px-3 text-xs font-semibold tracking-wider text-dh-sand uppercase">Field Operations</p>
            </div>
            
            <a class="flex items-center px-3 py-2 transition-colors duration-300 transform rounded-lg {{ request()->routeIs('viewings.*') ? 'bg-dh-forest text-dh-light' : 'text-dh-light/80 hover:bg-dh-forest hover:text-dh-light' }}" href="{{ route('viewings.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('viewings.*') ? 'text-dh-sand' : '' }}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="mx-2 text-sm font-medium">Property Viewings</span>
            </a>

            <a class="flex items-center px-3 py-2 mt-2 transition-colors duration-300 transform rounded-lg {{ request()->routeIs('inspections.*') ? 'bg-dh-forest text-dh-light' : 'text-dh-light/80 hover:bg-dh-forest hover:text-dh-light' }}" href="{{ route('inspections.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('inspections.*') ? 'text-dh-sand' : '' }}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
                <span class="mx-2 text-sm font-medium">Inspections</span>
            </a>

            <a class="flex items-center px-3 py-2 mt-2 transition-colors duration-300 transform rounded-lg {{ request()->routeIs('adverts.*') ? 'bg-dh-forest text-dh-light' : 'text-dh-light/80 hover:bg-dh-forest hover:text-dh-light' }}" href="{{ route('adverts.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ request()->routeIs('adverts.*') ? 'text-dh-sand' : '' }}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="mx-2 text-sm font-medium">Adverts</span>
            </a>

        </nav>

        <div class="mt-8">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-3 py-2 text-dh-sand transition-colors duration-300 transform rounded-lg hover:bg-dh-forest hover:text-dh-light">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Log Out</span>
                </button>
            </form>
        </div>
    </div>
</aside>