<div>
<nav class="fixed top-0 left-0 right-0 z-50 h-16 w-full max-w-full bg-white border-b border-[#E0E0E0] px-4 md:px-6 flex items-center justify-between font-['Inter','Roboto',sans-serif] text-[#212121] text-sm">
    {{-- Area Kiri (Branding) --}}
    <div class="flex items-center gap-1 flex-shrink-0">
        {{-- Logo Box --}}
        <div class="flex items-center justify-center flex-shrink-0">
            <img
                src="{{ asset('image/SapaSumbar.png') }}"
                alt="Sapa Sumbar Logo"
                class="h-25 w-auto object-contain md:h-25"
                style="max-height: 125px;"
            >
        </div>
        {{-- Brand Text --}}
        <span class="text-sm md:text-base font-bold" style="color: #760206 !important;">Sapa Sumbar</span>
    </div>

    {{-- Area Tengah (Search Bar) - Tablet & Desktop --}}
    <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 z-10">
        <div class="relative md:w-60 lg:w-80 h-9 bg-[#F5F5F5] rounded-lg max-w-[calc(100vw-32rem)]">
            {{-- Search Icon --}}
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#9E9E9E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            {{-- Input Field --}}
            <input
                type="text"
                wire:model.live.debounce.300ms="searchQuery"
                placeholder="Cari Pengaduan"
                class="w-full h-full bg-transparent border-none outline-none text-[#212121] placeholder:text-[#9E9E9E] text-sm pl-9 pr-3 rounded-lg focus:ring-2 focus:ring-[#C1121F] focus:ring-opacity-50"
            />
        </div>
    </div>

    {{-- Area Kanan (Menu Navigasi) - Desktop --}}
    <div class="hidden xl:flex items-center gap-6 flex-shrink-0">
        {{-- Home Menu --}}
        <a href="/" class="flex flex-col items-center gap-1 group {{ request()->is('/') ? 'active' : '' }}">
            <svg class="w-5 h-5 {{ request()->is('/') ? 'text-[#C1121F]' : 'text-[#757575] group-hover:text-[#C1121F] transition-colors' }}" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            <span class="text-xs font-medium {{ request()->is('/') ? 'text-[#C1121F]' : 'text-[#757575] group-hover:text-[#C1121F] transition-colors' }}">Home</span>
        </a>

        {{-- Pengaduan Saya Menu --}}
        <a href="{{ route('my-complaints') }}" class="flex flex-col items-center gap-1 group {{ request()->is('my-complaints*') ? 'active' : '' }}">
            <svg class="w-5 h-5 {{ request()->is('my-complaints*') ? 'text-[#C1121F]' : 'text-[#757575] group-hover:text-[#C1121F] transition-colors' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="text-xs font-medium {{ request()->is('my-complaints*') ? 'text-[#C1121F]' : 'text-[#757575] group-hover:text-[#C1121F] transition-colors' }}">Pengaduan Saya</span>
        </a>

        {{-- Notifikasi Menu --}}
        <a href="/notifikasi" class="flex flex-col items-center gap-1 group {{ request()->is('notifikasi*') ? 'active' : '' }}">
            <svg class="w-5 h-5 {{ request()->is('notifikasi*') ? 'text-[#C1121F]' : 'text-[#757575] group-hover:text-[#C1121F] transition-colors' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="text-xs font-medium {{ request()->is('notifikasi*') ? 'text-[#C1121F]' : 'text-[#757575] group-hover:text-[#C1121F] transition-colors' }}">Notifikasi</span>
        </a>

        {{-- Maps Menu --}}
        <a href="/maps" class="flex flex-col items-center gap-1 group {{ request()->is('maps*') ? 'active' : '' }}">
            <svg class="w-5 h-5 {{ request()->is('maps*') ? 'text-[#C1121F]' : 'text-[#757575] group-hover:text-[#C1121F] transition-colors' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-xs font-medium {{ request()->is('maps*') ? 'text-[#C1121F]' : 'text-[#757575] group-hover:text-[#C1121F] transition-colors' }}">Maps</span>
        </a>

        {{-- Profile Menu --}}
        <a href="{{ route('profile') }}" class="flex flex-col items-center gap-1 group {{ request()->is('profile*') ? 'active' : '' }}">
            <svg class="w-5 h-5 {{ request()->is('profile*') ? 'text-[#C1121F]' : 'text-[#757575] group-hover:text-[#C1121F] transition-colors' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="text-xs font-medium {{ request()->is('profile*') ? 'text-[#C1121F]' : 'text-[#757575] group-hover:text-[#C1121F] transition-colors' }}">Profile</span>
        </a>
    </div>

    {{-- Tablet: Menu Icons Only --}}
    <div class="hidden md:flex xl:hidden items-center gap-3 flex-shrink-0">
        <a href="/" class="p-2 {{ request()->is('/') ? 'text-[#C1121F]' : 'text-[#757575] hover:text-[#C1121F] transition-colors' }}">
            <svg class="w-5 h-5" fill="{{ request()->is('/') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
        </a>
        @can('user')
        <a href="{{ route('my-complaints') }}" class="p-2 {{ request()->is('my-complaints*') ? 'text-[#C1121F]' : 'text-[#757575] hover:text-[#C1121F] transition-colors' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </a>
        <a href="/notifikasi" class="p-2 {{ request()->is('notifikasi*') ? 'text-[#C1121F]' : 'text-[#757575] hover:text-[#C1121F] transition-colors' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </a>
        @endcan

        <a href="/maps" class="p-2 {{ request()->is('maps*') ? 'text-[#C1121F]' : 'text-[#757575] hover:text-[#C1121F] transition-colors' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </a>
        @can('user')
        <a href="/profile" class="p-2 {{ request()->is('profile*') ? 'text-[#C1121F]' : 'text-[#757575] hover:text-[#C1121F] transition-colors' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </a>
        @endcan
    </div>

    {{-- Mobile Menu Button & Search --}}
    <div class="flex md:hidden items-center gap-3">
        {{-- Sidebar Toggle Button --}}
        <button
            onclick="window.dispatchEvent(new CustomEvent('toggle-sidebar'))"
            class="p-2 text-[#757575] hover:text-[#C1121F] transition-colors"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        {{-- Mobile Search Icon --}}
        <button wire:click="$toggle('showMobileSearch')" class="p-2 text-[#757575] hover:text-[#C1121F] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>

        {{-- Mobile Menu Toggle --}}
        <button wire:click="$toggle('showMobileMenu')" class="p-2 text-[#757575] hover:text-[#C1121F] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    {{-- Mobile Search Bar --}}
    @if($showMobileSearch ?? false)
    <div class="absolute top-full left-0 right-0 bg-white border-b border-[#E0E0E0] p-4 md:hidden z-40">
        <div class="relative w-full h-9 bg-[#F5F5F5] rounded-lg">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-[#9E9E9E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
                type="text"
                wire:model.live.debounce.300ms="searchQuery"
                placeholder="Cari Pengaduan"
                class="w-full h-full bg-transparent border-none outline-none text-[#212121] placeholder:text-[#9E9E9E] text-sm pl-9 pr-3 rounded-lg"
                wire:blur="$set('showMobileSearch', false)"
            />
        </div>
    </div>
    @endif

    {{-- Mobile Menu Dropdown --}}
    @if($showMobileMenu ?? false)
    <div class="absolute top-full left-0 right-0 bg-white border-b border-[#E0E0E0] shadow-lg md:hidden z-40">
        <div class="flex flex-col py-2">
            <a href="/" class="flex items-center gap-3 px-6 py-3 hover:bg-[#F5F5F5] transition-colors {{ request()->is('/') ? 'text-[#C1121F]' : 'text-[#212121]' }}">
                <svg class="w-5 h-5" fill="{{ request()->is('/') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                <span class="text-sm font-medium">Home</span>
            </a>
            <a href="{{ route('my-complaints') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-[#F5F5F5] transition-colors {{ request()->is('my-complaints*') ? 'text-[#C1121F]' : 'text-[#212121]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="text-sm font-medium">Pengaduan Saya</span>
            </a>
            <a href="/notifikasi" class="flex items-center gap-3 px-6 py-3 hover:bg-[#F5F5F5] transition-colors {{ request()->is('notifikasi*') ? 'text-[#C1121F]' : 'text-[#212121]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="text-sm font-medium">Notifikasi</span>
            </a>
            <a href="/maps" class="flex items-center gap-3 px-6 py-3 hover:bg-[#F5F5F5] transition-colors {{ request()->is('maps*') ? 'text-[#C1121F]' : 'text-[#212121]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="text-sm font-medium">Maps</span>
            </a>
            <a href="/profile" class="flex items-center gap-3 px-6 py-3 hover:bg-[#F5F5F5] transition-colors {{ request()->is('profile*') ? 'text-[#C1121F]' : 'text-[#212121]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-sm font-medium">Profile</span>
            </a>
        </div>
    </div>
    @endif
</nav>

{{-- Spacer untuk fixed navbar --}}
<div class="h-16"></div>
</div>
