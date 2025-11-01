<div>
    <div
        x-data="{ open: @entangle('showMobileSidebar') }"
        @toggle-sidebar.window="open = !open"
    >
        {{-- Desktop & Tablet Sidebar (SUDAH DIPERBAIKI) --}}
        <aside class="hidden lg:flex flex-col w-60 bg-[#FAFAFA] border-r border-[#E0E0E0] font-['Inter','Roboto',sans-serif] text-[#424242] fixed top-16 bottom-0 overflow-y-auto" style="padding: 24px 16px;">
            {{-- Section: Kategori --}}
            <section style="margin-bottom: 24px;">
                {{-- Title Kategori --}}
                <h2 class="text-[13px] font-bold text-[#616161] mb-2 tracking-[0.3px]">Kategori</h2>

                {{-- Menu Items --}}
                <div class="flex flex-col" style="gap: 4px;">
                    @foreach($categories as $category)
                        <button
                            wire:click="selectCategory('{{ $category['id'] }}')"
                            class="h-10 w-full flex items-center px-3 py-2 rounded-lg gap-3 text-sm font-medium cursor-pointer transition-all duration-200
                                {{ $activeCategory === $category['id']
                                    ? 'bg-[#FFEAEA] text-[#E53935]'
                                    : 'bg-transparent text-[#424242] hover:bg-[#FFF2F2] hover:text-[#E53935]'
                                }}"
                        >
                            {{-- Icon --}}
                            <span class="w-5 h-5 flex-shrink-0">
                                @if($category['icon'] === 'list')
                                    {{-- Exclamation Square Fill Icon untuk Semua Pengaduan --}}
                                    <svg class="w-5 h-5 {{ $activeCategory === $category['id'] ? 'text-[#E53935]' : 'text-[#9E9E9E]' }}" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                    </svg>
                                @elseif($category['icon'] === 'alert')
                                    {{-- Hand/Palm Icon untuk Pungli --}}
                                    <svg class="w-5 h-5 {{ $activeCategory === $category['id'] ? 'text-[#E53935]' : 'text-[#9E9E9E]' }}" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23 5.5V20c0 2.2-1.8 4-4 4h-7.3c-1.08 0-2.1-.43-2.85-1.19L1 14.83s1.26-1.23 1.3-1.25c.22-.19.49-.29.79-.29.22 0 .42.06.6.16.04.01 4.31 2.46 4.31 2.46V4c0-.83.67-1.5 1.5-1.5S11 3.17 11 4v7h1V1.5c0-.83.67-1.5 1.5-1.5S15 .67 15 1.5V11h1V2.5c0-.83.67-1.5 1.5-1.5S19 1.67 19 2.5V11h1V5.5c0-.83.67-1.5 1.5-1.5S23 4.67 23 5.5z"/>
                                    </svg>
                                @elseif($category['icon'] === 'disaster')
                                    {{-- Flame Icon untuk Bencana Darurat --}}
                                    <svg class="w-5 h-5 {{ $activeCategory === $category['id'] ? 'text-[#E53935]' : 'text-[#9E9E9E]' }}" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15"/>
                                    </svg>
                                @elseif($category['icon'] === 'building')
                                    {{-- Building Icon untuk Kerusakan Fasilitas --}}
                                    <svg class="w-5 h-5 {{ $activeCategory === $category['id'] ? 'text-[#E53935]' : 'text-[#9E9E9E]' }}" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/>
                                    </svg>
                                @endif
                            </span>

                            {{-- Label --}}
                            <span class="flex-1 text-left tracking-[0.2px]">{{ $category['label'] }}</span>
                        </button>
                    @endforeach
                </div>
            </section>

            {{-- Section: Statistik --}}
            <section class="border-t border-[#E0E0E0]" style="margin-top: 24px; padding-top: 16px;">
                {{-- Title Statistik --}}
                <h2 class="text-[13px] font-semibold text-[#616161] mb-2">Statistik</h2>

                {{-- Statistik Items --}}
                <div class="flex flex-col" style="gap: 8px;">
                    @foreach($statistics as $stat)
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-medium text-[#757575]">{{ $stat['label'] }}</span>
                            <span class="text-xl font-semibold leading-[1.4]" style="color: {{ $stat['color'] }};">
                                {{ $stat['value'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </section>
        </aside>

        {{-- Mobile Sidebar Overlay & Sidebar (TIDAK PERLU DIUBAH) --}}
        <div x-show="open" x-cloak>
            {{-- Overlay --}}
            <div
                @click="open = false"
                class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"
            ></div>

            {{-- Mobile Sidebar --}}
            <aside class="fixed left-0 top-0 h-screen w-60 bg-[#FAFAFA] border-r border-[#E0E0E0] font-['Inter','Roboto',sans-serif] text-[#424242] z-50 overflow-y-auto lg:hidden" style="padding: 24px 16px;">
                {{-- Section: Kategori --}}
                <section style="margin-bottom: 24px;">
                    {{-- Title Kategori --}}
                    <h2 class="text-[13px] font-bold text-[#616161] mb-2 tracking-[0.3px]">Kategori</h2>

                    {{-- Menu Items --}}
                    <div class="flex flex-col" style="gap: 4px;">
                        @foreach($categories as $category)
                            <button
                                wire:click="selectCategory('{{ $category['id'] }}')"
                                class="h-10 w-full flex items-center px-3 py-2 rounded-lg gap-3 text-sm font-medium cursor-pointer transition-all duration-200
                                    {{ $activeCategory === $category['id']
                                        ? 'bg-[#FFEAEA] text-[#E53935]'
                                        : 'bg-transparent text-[#424242] hover:bg-[#FFF2F2] hover:text-[#E53935]'
                                    }}"
                            >
                                {{-- Icon --}}
                                <span class="w-5 h-5 flex-shrink-0">
                                    @if($category['icon'] === 'list')
                                        {{-- Exclamation Square Fill Icon untuk Semua Pengaduan --}}
                                        <svg class="w-5 h-5 {{ $activeCategory === $category['id'] ? 'text-[#E53935]' : 'text-[#9E9E9E]' }}" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                        </svg>
                                    @elseif($category['icon'] === 'alert')
                                        {{-- Hand/Palm Icon untuk Pungli --}}
                                        <svg class="w-5 h-5 {{ $activeCategory === $category['id'] ? 'text-[#E53935]' : 'text-[#9E9E9E]' }}" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23 5.5V20c0 2.2-1.8 4-4 4h-7.3c-1.08 0-2.1-.43-2.85-1.19L1 14.83s1.26-1.23 1.3-1.25c.22-.19.49-.29.79-.29.22 0 .42.06.6.16.04.01 4.31 2.46 4.31 2.46V4c0-.83.67-1.5 1.5-1.5S11 3.17 11 4v7h1V1.5c0-.83.67-1.5 1.5-1.5S15 .67 15 1.5V11h1V2.5c0-.83.67-1.5 1.5-1.5S19 1.67 19 2.5V11h1V5.5c0-.83.67-1.5 1.5-1.5S23 4.67 23 5.5z"/>
                                        </svg>
                                    @elseif($category['icon'] === 'disaster')
                                        {{-- Flame Icon untuk Bencana Darurat --}}
                                        <svg class="w-5 h-5 {{ $activeCategory === $category['id'] ? 'text-[#E53935]' : 'text-[#9E9E9E]' }}" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15"/>
                                        </svg>
                                    @elseif($category['icon'] === 'building')
                                        {{-- Building Icon untuk Kerusakan Fasilitas --}}
                                        <svg class="w-5 h-5 {{ $activeCategory === $category['id'] ? 'text-[#E53935]' : 'text-[#9E9E9E]' }}" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/>
                                        </svg>
                                    @endif
                                </span>

                                {{-- Label --}}
                                <span class="flex-1 text-left tracking-[0.2px]">{{ $category['label'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </section>

                {{-- Section: Statistik --}}
                <section class="border-t border-[#E0E0E0]" style="margin-top: 24px; padding-top: 16px;">
                    {{-- Title Statistik --}}
                    <h2 class="text-[13px] font-semibold text-[#616161] mb-2">Statistik</h2>

                    {{-- Statistik Items --}}
                    <div class="flex flex-col" style="gap: 8px;">
                        @foreach($statistics as $stat)
                            <div class="flex flex-col gap-1">
                                <span class="text-xs font-medium text-[#757575]">{{ $stat['label'] }}</span>
                                <span class="text-xl font-semibold leading-[1.4]" style="color: {{ $stat['color'] }};">
                                    {{ $stat['value'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </section>
            </aside>
        </div>

        {{-- Alpine.js x-cloak style --}}
        <style>
            [x-cloak] { display: none !important; }
        </style>
    </div>
</div>
