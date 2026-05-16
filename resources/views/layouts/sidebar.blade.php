<aside class="flex flex-col w-64 h-screen px-4 py-8 overflow-y-auto bg-dh-charcoal border-r rtl:border-r-0 rtl:border-l border-dh-charcoal shadow-lg">
    
    <div class="flex items-center justify-center mb-6">
        <span class="text-2xl font-bold text-dh-light tracking-wider uppercase">
            Dream<span class="text-dh-sand">Home</span>
        </span>
    </div>

    <div class="flex items-center px-2 pb-6 mb-6 border-b border-dh-forest/50">
        <div class="w-10 h-10 rounded-full bg-dh-forest flex items-center justify-center text-dh-light font-bold">
            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium text-dh-light">{{ Auth::user()->name ?? 'User Name' }}</p>
            <p class="text-xs text-dh-sand">System Role</p>
        </div>
    </div>

    <div class="flex flex-col justify-between flex-1 mt-2">
        <nav class="-mx-3 space-y-2">
            
            <a class="flex items-center px-3 py-2 text-dh-light transition-colors duration-300 transform rounded-lg bg-dh-forest" href="{{ route('dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-dh-sand">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                <span class="mx-2 text-sm font-medium text-dh-light">Dashboard</span>
            </a>

            @role('Super Admin')
                <div class="pt-4 pb-1">
                    <p class="px-3 text-xs font-semibold tracking-wider text-dh-sand uppercase">System Setup</p>
                </div>
                
                <a class="flex items-center px-3 py-2 text-dh-light/80 transition-colors duration-300 transform rounded-lg hover:bg-dh-forest hover:text-dh-light" href="/branches">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Manage Branches</span>
                </a>

                <a class="flex items-center px-3 py-2 text-dh-light/80 transition-colors duration-300 transform rounded-lg hover:bg-dh-forest hover:text-dh-light" href="/system-managers">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">System Managers</span>
                </a>
            @endrole

            @role('Manager')
                <div class="pt-4 pb-1">
                    <p class="px-3 text-xs font-semibold tracking-wider text-dh-sand uppercase">Branch Management</p>
                </div>
                
                <a class="flex items-center px-3 py-2 text-dh-light/80 transition-colors duration-300 transform rounded-lg hover:bg-dh-forest hover:text-dh-light" href="/staff">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Manage Staff</span>
                </a>

                <a class="flex items-center px-3 py-2 mt-2 text-dh-light/80 transition-colors duration-300 transform rounded-lg hover:bg-dh-forest hover:text-dh-light" href="/reports/branch">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Branch Reports</span>
                </a>
            @endrole

            @role('Supervisor')
                <div class="pt-4 pb-1">
                    <p class="px-3 text-xs font-semibold tracking-wider text-dh-sand uppercase">Operations</p>
                </div>
                
                <a class="flex items-center px-3 py-2 text-dh-light/80 transition-colors duration-300 transform rounded-lg hover:bg-dh-forest hover:text-dh-light" href="/properties">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Properties & Owners</span>
                </a>

                <a class="flex items-center px-3 py-2 mt-2 text-dh-light/80 transition-colors duration-300 transform rounded-lg hover:bg-dh-forest hover:text-dh-light" href="/clients">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Clients & Renters</span>
                </a>
                
                <a class="flex items-center px-3 py-2 mt-2 text-dh-light/80 transition-colors duration-300 transform rounded-lg hover:bg-dh-forest hover:text-dh-light" href="/leases">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <span class="mx-2 text-sm font-medium">Lease Agreements</span>
                </a>
            @endrole

            <a class="flex items-center px-3 py-2 mt-4 text-dh-light/80 transition-colors duration-300 transform rounded-lg hover:bg-dh-forest hover:text-dh-light" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
                </svg>
                <span class="mx-2 text-sm font-medium">Placeholder Two</span>
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