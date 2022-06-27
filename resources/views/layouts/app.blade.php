<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="app-url" content="{{ config('app.url') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if (isset($bearerToken))
            @php
                $bearerToken = StrToArray($bearerToken);
            @endphp
            @if (is_array($bearerToken))
                @foreach ($bearerToken as $k => $v)
                    <meta name="{{ $k }}" content="{{ $v }}">
                @endforeach
            @else
                <meta name="bearer-token" content="{{ $bearerToken }}">
            @endif
        @endif

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        {!! LoadAssets([
            "bs-css",
        ]) !!}

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset(config('app.logo_apple_touch')) }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(config('app.logo_32')) }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(config('app.logo_16')) }}">
        <link rel="shortcut icon" href="{{ asset(config('app.logo_shortcut')) }}">

        @livewireStyles

        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        {!! LoadAssets([
            "jq",
            "bs-js",
        ]) !!}
        @livewireScripts
        @stack('scripts')
    </body>
</html>
