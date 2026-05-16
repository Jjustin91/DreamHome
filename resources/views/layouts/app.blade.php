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
                
                @if (isset($header))
                    <header class="bg-white shadow border-b border-dh-sand/30">
                        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-dh-light p-6">
                    {{ $slot }}
                </main>

            </div>
        </div>
    </body>
</html>