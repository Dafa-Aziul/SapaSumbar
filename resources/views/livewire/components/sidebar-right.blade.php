<div>
    <aside
        class="hidden lg:flex flex-col w-60 bg-white fixed top-16 right-0 bottom-0 overflow-y-auto font-['Inter',sans-serif]"
        style="padding: 32px 24px; gap: 16px;">

        <button type="button" wire:click="createReport"
            class="w-full rounded-lg bg-[#D32F2F] text-white text-sm font-semibold flex items-center transition-colors hover:bg-[#B71C1C] active:bg-[#C62828] cursor-pointer"
            style="height: 44px; padding-left: 8px;">
            <svg class="w-4 h-4 text-white ml-2" fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
            <span class="flex-1 text-center ml-2">Buat Pengaduan</span>
        </button>

        {{-- Dropdown Button - Terapkan Filter --}}
        <div x-data="{ filterOpen: false, statusOpen: false }" class="relative w-full">
            {{-- Button --}}
            <button type="button" @click="filterOpen = !filterOpen"
                class="w-full flex items-center justify-center transition-colors cursor-pointer font-['Roboto',sans-serif] font-semibold text-[#C1121F]"
                style="height: 44px; border-radius: 10px 10px 0px 0px; background-color: #f9e7e9; padding: 0px 12px; gap: 8px; font-size: 16px; line-height: 124%;">
                <svg class="w-4 h-4 text-[#C1121F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4h18v2.586a1 1 0 0 1-.293.707l-6.414 6.414a1 1 0 0 0-.293.707V17l-4 4v-6.586a1 1 0 0 0-.293-.707L3.293 7.293A1 1 0 0 1 3 6.586V4z" />
                </svg>
                <span>Terapkan Filter</span>
                <svg class="w-3 h-3 text-[#C1121F] transform transition-transform duration-200"
                    :class="filterOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            {{-- Filter Dropdown Content --}}
            <div x-show="filterOpen" @click.away="filterOpen = false; statusOpen = false"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
                class="absolute top-full left-0 w-full z-[60] font-['Roboto',sans-serif]"
                style="box-shadow: 0px 10px 15px -3px rgba(0, 0, 0, 0.1), 0px 4px 6px -4px rgba(0, 0, 0, 0.1); border-radius: 0px 0px 10px 10px; background-color: #fff; border: 0.7px solid rgba(0, 0, 0, 0.1); overflow-y: auto; display: flex; flex-direction: column; padding: 10px 0px 24px; gap: 10px; font-size: 14px; color: #0a0a0a; max-height: calc(100vh - 200px);">
                {{-- Section 1: Filter Status --}}
                <div class="w-full flex flex-col">
                    {{-- Dialog Header --}}
                    <div class="w-full border-b border-[#b2b2b2] flex flex-col items-start" style="padding: 10px 20px;">
                        <div class="w-full flex items-center">
                            <h3 class="font-semibold text-[#0a0a0a]" style="font-size: 14px; line-height: 124%;">Filter
                                Status</h3>
                        </div>
                    </div>

                    {{-- Filter Status Items --}}
                    <div class="w-full flex flex-col items-start" style="padding: 0px 20px; gap: 13px;">
                        <button type="button" wire:click="toggleFilterStatus('diproses')"
                            class="w-full flex items-center cursor-pointer transition-colors {{ $filterStatus['diproses'] ? 'bg-[#E3F2FD]' : 'hover:bg-[#F5F5F5]' }}"
                            style="height: 44px; border-radius: 8px; padding: 0px 12px; gap: 8px;">
                            <svg class="w-[18px] h-[18px] text-[#F9A825]" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                                <path
                                    d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                            </svg>
                            <span class="text-[#050505]" style="font-size: 14px; line-height: 124%;">Diproses</span>
                        </button>

                        <button type="button" wire:click="toggleFilterStatus('selesai')"
                            class="w-full flex items-center cursor-pointer transition-colors {{ $filterStatus['selesai'] ? 'bg-[#E3F2FD]' : 'hover:bg-[#F5F5F5]' }}"
                            style="height: 44px; border-radius: 8px; padding: 0px 12px; gap: 8px;">
                            <svg class="w-[18px] h-[18px] text-[#4CAF50]" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486z" />
                            </svg>
                            <span class="text-[#050505]" style="font-size: 14px; line-height: 124%;">Selesai</span>
                        </button>
                    </div>
                </div>

                {{-- Section 2: Urutkan --}}
                <div class="w-full flex flex-col">
                    {{-- Dialog Header --}}
                    <div class="w-full border-b border-[#b2b2b2] flex flex-col items-start" style="padding: 10px 20px;">
                        <div class="w-full flex items-center">
                            <h3 class="font-semibold text-[#0a0a0a]" style="font-size: 14px; line-height: 124%;">Urutkan
                            </h3>
                        </div>
                    </div>

                    {{-- Sort Items --}}
                    <div class="w-full flex flex-col items-start" style="padding: 0px 20px; gap: 13px;">
                        <button type="button" wire:click="setSortBy('terbaru')"
                            class="w-full flex items-center cursor-pointer transition-colors hover:bg-[#F5F5F5]"
                            style="height: 44px; border-radius: 8px; padding: 0px 12px; gap: 8px;">
                            <svg class="w-[18px] h-[18px] text-[#1565C0]" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z" />
                                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z" />
                                <path
                                    d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5" />
                            </svg>
                            <span class="text-[#050505]" style="font-size: 14px; line-height: 124%;">Terbaru</span>
                        </button>

                        <button type="button" wire:click="setSortBy('terpopuler')"
                            class="w-full flex items-center cursor-pointer transition-colors hover:bg-[#F5F5F5]"
                            style="height: 44px; border-radius: 8px; padding: 0px 12px; gap: 8px;">
                            <svg class="w-[18px] h-[18px] text-[#8E24AA]" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <span class="text-[#050505]" style="font-size: 14px; line-height: 124%;">Terpopuler</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</div>