<x-layouts.app>
    <x-slot:title>Notifikasi - Sapa Sumbar</x-slot:title>

    <div class="container mx-auto px-6 py-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#212121] mb-2">Notifikasi</h1>
            <p class="text-[#757575]">Lihat semua pembaruan status pengaduan Anda</p>
        </div>

        @livewire('notifikasi.index')
    </div>
</x-layouts.app>
