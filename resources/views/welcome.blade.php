<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'DreamHome') }} - Staff Portal</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-dh-light text-dh-charcoal selection:bg-dh-sand selection:text-white">
        <div class="relative flex items-center justify-center min-h-screen sm:pt-0">
            
            <div class="max-w-4xl mx-auto text-center sm:px-6 lg:px-8">
                <div class="flex justify-center mb-8">
                    <x-application-logo />
                </div>

                <h1 class="text-4xl font-bold tracking-tight text-dh-charcoal sm:text-6xl">
                    Property Management <br/>
                    <span class="text-dh-forest">Simplified.</span>
                </h1>
                <p class="mt-6 text-lg leading-8 text-dh-charcoal/80">
                    Internal staff portal for DreamHome property, branch, and lease administration.
                </p>

                <div class="flex items-center justify-center mt-10 gap-x-6">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-8 py-3 text-sm font-semibold transition-colors rounded-md shadow-sm bg-dh-charcoal text-dh-light hover:bg-dh-forest focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">Go to Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-8 py-3 text-sm font-semibold transition-colors rounded-md shadow-sm bg-dh-charcoal text-dh-light hover:bg-dh-forest focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">Staff Login</a>
                        @endauth
                    @endif
                </div>
            </div>

        </div>
    </body>
</html>