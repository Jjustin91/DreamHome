<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DreamHome') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-dh-charcoal">
        <div class="flex h-screen bg-dh-light">
            
            @include('layouts.sidebar')

            <div class="flex flex-col flex-1 overflow-hidden">
                
                <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-dh-sand/30 shadow-sm">
                    
                    <div>
                        @if (isset($header))
                            {{ $header }}
                        @endif
                    </div>

                    <div class="flex items-center">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 transition duration-150 ease-in-out border border-transparent rounded-md group focus:outline-none hover:bg-dh-light/50">
                            
                            <div class="hidden text-right sm:block">
                                <div class="text-sm font-bold leading-none transition-colors text-dh-charcoal group-hover:text-dh-forest">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="mt-1 text-xs font-semibold tracking-wider uppercase text-dh-sand">
                                    {{ Auth::user()->roles->first()->name ?? 'Staff' }}
                                </div>
                            </div>

                            <div class="flex items-center justify-center w-10 h-10 font-bold transition-transform duration-300 rounded-full shadow-inner bg-dh-forest text-dh-light group-hover:scale-105">
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            </div>
                            
                        </a>
                    </div>
                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-dh-light p-6">
                    {{ $slot }}
                </main>

            </div>
        </div>
    </body>
</html>