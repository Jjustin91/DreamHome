<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') | DreamHome</title>
        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @yield('extra-styles')
    </head>
    <body class="font-sans antialiased bg-[#F3F2F1]">
        <div class="flex min-h-screen">
            <aside class="w-64 bg-[#5C5047] text-white flex-shrink-0 fixed h-full z-10">
                <div class="p-6 mb-4">
                    <h1 class="text-2xl font-bold tracking-tight text-[#EEEAE4]">DreamHome</h1>
                </div>
                
                <nav class="px-4 space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-[#C9956A] text-white' : 'text-gray-300 hover:bg-[#4E443C]' }}">
                        Dashboard
                    </a>
                    @if(auth()->user()->job_title === 'Admin')
                        <a href="{{ route('admin.staff.index') }}" 
                        class="flex items-center px-4 py-3 rounded-lg transition 
                        {{ request()->routeIs('admin.staff.*') 
                            ? 'bg-[#C9956A] text-white' : 'text-gray-300 hover:bg-[#4E443C]' }}">
                            {{ __('Manage Staff') }}
                        </a>
                        <a href="{{ route('admin.branches.index') }}" 
                        class="flex items-center px-4 py-3 rounded-lg transition 
                        {{ request()->routeIs('admin.branches.*') 
                            ? 'bg-[#C9956A] text-white' : 'text-gray-300 hover:bg-[#4E443C]' }}">
                            {{ __('Branches') }}
                        </a>

                    @endif
                    <a href="{{ route('properties.index') }}" class="flex items-center px-4 py-3 rounded-lg transition {{ request()->routeIs('properties.*') ? 'bg-[#C9956A] text-white' : 'text-gray-300 hover:bg-[#4E443C]' }}">
                        Properties
                    </a>

                    <a href="{{ route('owners.index') }}" class="flex items-center px-4 py-3 rounded-lg transition {{ request()->routeIs('owners.*') ? 'bg-[#C9956A] text-white' : 'text-gray-300 hover:bg-[#4E443C]' }}">
                        Owners
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 rounded-lg transition text-gray-300 hover:bg-[#4E443C]">
                        Leases
                    </a>

                </nav>

                <div class="absolute bottom-0 w-full p-6 border-t border-[#4E443C]">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 text-gray-300 hover:text-white transition">
                            Log Out
                        </button>
                    </form>
                </div>
            </aside>

            <div class="flex-1 ml-64">
                <header class="bg-white/80 backdrop-blur-md h-16 border-b border-gray-200 flex items-center justify-between px-8 sticky top-0 z-10">
                    <h2 class="font-semibold text-lg text-gray-800">@yield('breadcrumb')</h2>
                    
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-bold text-[#C9956A] uppercase tracking-widest">{{ Auth::user()->job_title }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-[#C9956A] flex items-center justify-center text-white font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </header>

                <main class="p-8">
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>