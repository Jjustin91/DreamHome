<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DreamHome - Property Management</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-[#ede9e6] text-[#5c4f4a] font-sans">
        <div class="relative min-h-screen flex flex-col selection:bg-[#c9996b] selection:text-white">
            <nav class="w-full bg-white border-b border-[#5c4f4a]/10 px-6 py-4 flex justify-between items-center shadow-sm">
                <div class="flex items-center gap-3">
                    <x-application-logo class="w-10 h-10 text-[#5c4f4a]" />
                    <span class="font-bold text-xl tracking-tight text-[#5c4f4a]">DreamHome</span>
                </div>
                
                @if (Route::has('login'))
                    <div class="flex items-center gap-4 font-medium">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-[#5c766d] hover:text-[#c9996b] transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-[#5c766d] hover:text-[#c9996b] transition">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-[#5c4f4a] text-white px-4 py-2 rounded-md hover:bg-[#5c766d] transition shadow-sm">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>

            <main class="flex-1 flex items-center justify-center p-6 lg:p-8">
                <div class="max-w-3xl w-full text-center space-y-8">
                    <div class="w-24 h-24 mx-auto bg-white rounded-full flex items-center justify-center shadow-sm border border-[#5c4f4a]/10 mb-8">
                        <x-application-logo class="w-14 h-14 text-[#c9996b]" />
                    </div>
                    
                    <h1 class="text-4xl lg:text-6xl font-bold text-[#5c4f4a] tracking-tight">
                        Premium Property Management
                    </h1>
                    
                    <p class="text-lg text-[#5c766d] max-w-xl mx-auto leading-relaxed">
                        Streamline your real estate operations. Manage properties, coordinate leases, and track inspections all from one secure dashboard.
                    </p>

                    <div class="pt-4 flex justify-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-[#5c4f4a] text-white font-semibold rounded-lg hover:bg-[#5c766d] transition shadow-sm">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-8 py-3 bg-[#5c4f4a] text-white font-semibold rounded-lg hover:bg-[#5c766d] transition shadow-sm">
                                Access System
                            </a>
                        @endauth
                    </div>
                </div>
            </main>
            
            <footer class="w-full text-center py-6 text-sm text-[#5c766d] border-t border-[#5c4f4a]/10 bg-white">
                &copy; {{ date('Y') }} DreamHome Properties. All rights reserved.
            </footer>
        </div>
    </body>
</html>