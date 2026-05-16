<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DreamHome Property Management</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50">
        
        <nav class="absolute top-0 w-full px-6 py-4">
            <div class="flex justify-end max-w-7xl mx-auto">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-dh-forest hover:text-dh-charcoal transition-colors focus:outline-none">Go to Dashboard &rarr;</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-dh-charcoal hover:text-dh-forest transition-colors focus:outline-none">Staff Login</a>
                    @endauth
                @endif
            </div>
        </nav>

        <main class="flex flex-col items-center justify-center min-h-screen px-4 bg-dh-light sm:px-6 lg:px-8">
            <div class="w-full max-w-4xl text-center">
                
                <div class="flex items-center justify-center w-24 h-24 mx-auto mb-8 rounded-2xl shadow-xl bg-dh-forest">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>

                <h1 class="text-5xl font-black tracking-tight text-dh-charcoal sm:text-7xl">
                    Dream<span class="text-dh-sand">Home</span>
                </h1>
                
                <p class="max-w-2xl mx-auto mt-6 text-lg font-medium leading-8 text-gray-600 sm:text-xl">
                    Internal Property Management System. Authorized personnel only. 
                    Manage branches, staff, properties, and client rentals securely.
                </p>

                <div class="flex items-center justify-center mt-10 gap-x-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-4 text-sm font-bold tracking-widest text-white uppercase transition-all duration-200 rounded-lg shadow-md bg-dh-forest hover:bg-dh-charcoal hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dh-forest">
                            Access Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-8 py-4 text-sm font-bold tracking-widest text-white uppercase transition-all duration-200 rounded-lg shadow-md bg-dh-forest hover:bg-dh-charcoal hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dh-forest">
                            Access Staff Portal
                        </a>
                    @endauth
                </div>

            </div>
        </main>

    </body>
</html>