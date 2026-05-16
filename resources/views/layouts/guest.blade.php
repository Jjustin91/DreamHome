<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>DreamHome Property Management</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50">
        <div class="flex flex-col items-center min-h-screen pt-6 sm:justify-center sm:pt-0">
            
            <div>
                <a href="/" class="flex items-center gap-3 group focus:outline-none">
                    <div class="p-2 transition-colors duration-300 rounded-lg shadow-md bg-dh-forest group-hover:bg-dh-sand">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <span class="text-3xl font-black tracking-widest uppercase text-dh-charcoal">
                        Dream<span class="text-dh-sand">Home</span>
                    </span>
                </a>
            </div>

            <div class="w-full mt-8 sm:max-w-md">
                {{ $slot }}
            </div>
            
        </div>
    </body>
</html>