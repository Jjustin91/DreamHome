{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'DreamHome') }} - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f0ebe6] font-sans" style="margin:0; overflow: hidden;">

    <div style="display: flex; height: 100vh;">

        {{-- ── SIDEBAR: fixed, never scrolls ── --}}
        <aside style="width: 220px; flex-shrink: 0; height: 100vh; position: fixed; top: 0; left: 0; overflow: hidden; z-index: 20;">
            @include('layouts.navigation')
        </aside>

        {{-- ── MAIN: starts after sidebar, only this scrolls ── --}}
        <div style="margin-left: 220px; flex: 1; display: flex; flex-direction: column; height: 100vh; overflow-y: auto; min-width: 0;">

            {{-- Top Bar --}}
            <header class="bg-white border-b border-stone-200 px-8 py-4 flex items-center justify-between sticky top-0 z-10">
                <h1 class="text-lg font-semibold text-stone-800">@yield('title', 'Dashboard')</h1>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-[#c9996b] rounded-full flex items-center justify-center text-white font-semibold text-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="text-sm font-medium text-stone-700">{{ Auth::user()->name }}</span>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-6">
                @if(session('success'))
                    <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>