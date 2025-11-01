{{-- Sidebar Khusus untuk Halaman Profile --}}
@if (request()->routeIs('profile'))
    <aside class="profile-sidebar w-60 bg-[#FAFAFA] border-r border-[#E0E0E0] font-['Inter','Roboto',sans-serif] text-[#424242] fixed top-16 bottom-0 overflow-y-auto" style="padding: 24px 16px;">
        <ul class="sidebar-menu">
            <li class="sidebar-menu-item">
                <a href="{{ route('profile') }}" class="sidebar-menu-link active flex items-center px-3 py-2 rounded-lg gap-3 text-sm font-medium cursor-pointer transition-all duration-200 bg-[#FFEAEA] text-[#E53935]">
                    <svg class="sidebar-menu-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Pengaturan Profil
                </a>
            </li>

            <li class="sidebar-menu-item mt-2">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                            class="sidebar-menu-link flex items-center px-3 py-2 rounded-lg gap-3 text-sm font-medium cursor-pointer transition-all duration-200 text-[#424242] hover:bg-[#FFF2F2] hover:text-[#E53935]"
                            style="width: 100%; text-align: left; background: transparent; border: none;">
                        <svg class="sidebar-menu-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Log Out
                    </button>
                </form>
            </li>
        </ul>
    </aside>

@else
    {{-- Sidebar Biasa untuk Kategori & Statistik --}}
    <aside class="hidden lg:flex flex-col w-60 bg-[#FAFAFA] border-r border-[#E0E0E0] font-['Inter','Roboto',sans-serif] text-[#424242] fixed top-16 bottom-0 overflow-y-auto" style="padding: 24px 16px;">
        {{-- Section: Kategori --}}
        <section style="margin-bottom: 24px;">
            <h2 class="text-[13px] font-bold text-[#616161] mb-2 tracking-[0.3px]">Kategori</h2>
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
                        <span class="w-5 h-5 flex-shrink-0">
                            {{-- ikon kategori --}}
                            @if($category['icon'] === 'list')
                                <svg class="w-5 h-5 {{ $activeCategory === $category['id'] ? 'text-[#E53935]' : 'text-[#9E9E9E]' }}" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                </svg>
                            @endif
                        </span>
                        <span class="flex-1 text-left tracking-[0.2px]">{{ $category['label'] }}</span>
                    </button>
                @endforeach
            </div>
        </section>

        {{-- Section: Statistik --}}
        <section class="border-t border-[#E0E0E0]" style="margin-top: 24px; padding-top: 16px;">
            <h2 class="text-[13px] font-semibold text-[#616161] mb-2">Statistik</h2>
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
@endif
