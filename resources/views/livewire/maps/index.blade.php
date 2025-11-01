<div class="p-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#212121] mb-2">Peta Pengaduan</h1>
        <p class="text-[#757575] text-sm">Lihat lokasi pengaduan yang sedang aktif di peta interaktif</p>
    </div>

    <!-- Map Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-lg border border-[#E0E0E0] p-4">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-[#C1121F] bg-opacity-10 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#C1121F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-[#757575]">Total Pengaduan</p>
                    <p class="text-xl font-bold text-[#212121]">{{ count($complaints) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-[#E0E0E0] p-4">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-[#FFC107] bg-opacity-10 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#FFC107]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-[#757575]">Dalam Proses</p>
                    <p class="text-xl font-bold text-[#212121]">{{ count(array_filter($complaints, fn($c) => $c['status'] === 'in_progress')) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-[#E0E0E0] p-4">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-[#4CAF50] bg-opacity-10 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#4CAF50]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-[#757575]">Selesai</p>
                    <p class="text-xl font-bold text-[#212121]">{{ count(array_filter($complaints, fn($c) => $c['status'] === 'resolved')) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Container -->
    <div class="bg-white rounded-lg border border-[#E0E0E0] overflow-hidden">
        <div id="map" class="w-full h-96 md:h-[500px]"></div>
    </div>

    <!-- Map Scripts -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <script>
        document.addEventListener('livewire:loaded', function () {
            // Initialize map
            const map = L.map('map').setView([-0.9471, 100.4172], 8); // Center on West Sumatra

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Add markers for complaints
            @foreach($complaints as $complaint)
                @php
                    $location = json_decode($complaint['location'], true);
                    if ($location && isset($location['lat']) && isset($location['lng'])) {
                @endphp
                L.marker([{{ $location['lat'] }}, {{ $location['lng'] }}])
                    .addTo(map)
                    .bindPopup(`
                        <div class="p-2">
                            <h3 class="font-bold text-sm mb-1">{{ $complaint['category']['name'] ?? 'Pengaduan' }}</h3>
                            <p class="text-xs text-gray-600 mb-2">{{ Str::limit($complaint['content'], 100) }}</p>
                            <span class="inline-block px-2 py-1 text-xs rounded-full
                                {{ $complaint['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                   ($complaint['status'] === 'in_progress' ? 'bg-blue-100 text-blue-800' :
                                    'bg-green-100 text-green-800') }}">
                                {{ ucfirst(str_replace('_', ' ', $complaint['status'])) }}
                            </span>
                        </div>
                    `);
                @php
                    }
                @endphp
            @endforeach

            // Fit map to show all markers
            const group = new L.featureGroup([]);
            @foreach($complaints as $complaint)
                @php
                    $location = json_decode($complaint['location'], true);
                    if ($location && isset($location['lat']) && isset($location['lng'])) {
                @endphp
                group.addLayer(L.marker([{{ $location['lat'] }}, {{ $location['lng'] }}]));
                @php
                    }
                @endphp
            @endforeach

            if (group.getLayers().length > 0) {
                map.fitBounds(group.getBounds().pad(0.1));
            }
        });
    </script>
</div>
