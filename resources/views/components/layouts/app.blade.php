<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Sapa Sumbar') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|roboto:400,500,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-white text-[#212121]">
    {{-- Navbar Component --}}
    @livewire('components.navbar')

    {{-- Main Layout --}}
    <div class="flex min-h-[calc(100vh-4rem)]">
        {{-- Left Sidebar --}}
        @livewire('components.sidebar-left')

        {{-- Main Content --}}
        <main class="flex-1 min-h-screen">
            {{ $slot }}
        </main>

        {{-- Right Sidebar --}}
        @livewire('components.sidebar-right')
    </div>

    {{-- Create Complaint Modal --}}
    @livewire('components.create-complaint-modal')

    @livewire('components.comment-modal')

    {{-- Scripts --}}
    @livewireScripts
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
