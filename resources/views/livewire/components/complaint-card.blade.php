<div>
    @if(!$complaint)
        <div class="text-center text-gray-500 py-4">
            Laporan tidak ditemukan.
        </div>
    @else
        <div class="report-card" style="
            width: 640px;
            max-width: 100%;
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            font-family: 'Inter', 'Roboto', sans-serif;
            color: #212121;
        ">
            {{-- Header --}}
            <div class="report-header" style="margin-bottom: 8px; position: relative;">

                {{-- 🔶 Indikator hanya untuk user (hilang di admin) --}}
                @cannot('admin')
                    <div style="
                        position: absolute;
                        top: 8px;
                        right: 0;
                        width: 12px;
                        height: 12px;
                        background-color: #FFC107;
                        border-radius: 50%;
                        border: 2px solid #FFFFFF;
                        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
                    "></div>
                @endcannot

                {{-- Header Bar --}}
                <div style="
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-start;
                    gap: 12px;
                    flex-wrap: wrap;
                ">
                    {{-- Kiri: Avatar & info --}}
                    <div style="display: flex; align-items: flex-start; gap: 10px;">
                        <div class="avatar" style="
                            width: 40px;
                            height: 40px;
                            border-radius: 50%;
                            background-color: #E3F2FD;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 16px;
                            font-weight: 600;
                            color: #1565C0;
                        ">
                            {{ strtoupper(substr($complaint->user->name ?? 'U', 0, 1)) }}
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 8px;">
                                <span style="font-size: 15px; font-weight: 600; color: #212121;">
                                    {{ $complaint->is_anonymous ? 'Anonim' : ($complaint->user->name ?? 'Pengguna') }}
                                </span>

                                {{-- Kategori --}}
                                @if($complaint->category)
                                    <span style="
                                        background-color: #FFF8E1;
                                        color: #FBC02D;
                                        font-size: 12px;
                                        font-weight: 600;
                                        padding: 2px 8px;
                                        border-radius: 6px;
                                    ">
                                        {{ $complaint->category->name }}
                                    </span>
                                @endif

                                {{-- Status --}}
                                @if($complaint->status === 'diproses')
                                    <span style="
                                        background-color: #FFF3CD;
                                        color: #FBC02D;
                                        font-size: 12px;
                                        font-weight: 600;
                                        padding: 2px 8px;
                                        border-radius: 6px;
                                    ">Diproses</span>
                                @elseif($complaint->status === 'selesai')
                                    <span style="
                                        background-color: #E8F5E9;
                                        color: #4CAF50;
                                        font-size: 12px;
                                        font-weight: 600;
                                        padding: 2px 8px;
                                        border-radius: 6px;
                                    ">Selesai</span>
                                @endif
                            </div>

                            {{-- Waktu & Lokasi --}}
                            <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #9E9E9E;">
                                <span>{{ $complaint->created_at->diffForHumans() }}</span>
                                <span>·</span>
                                <div style="display: flex; align-items: center; gap: 4px;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#757575" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <span>{{ $complaint->location ?? 'Lokasi tidak diketahui' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kanan: Tombol tindak untuk admin --}}
                    @can('admin')
                        <a href="{{ url('/admin/complaints/' . $complaint->id . '/edit') }}" style="
                            display: inline-flex;
                            align-items: center;
                            gap: 6px;
                            background-color: #FFC107;
                            color: #212121;
                            font-size: 12px;
                            font-weight: 600;
                            padding: 6px 12px;
                            border-radius: 6px;
                            text-decoration: none;
                            white-space: nowrap;
                            transition: background-color 0.2s;
                            height: 32px;
                        " onmouseover="this.style.backgroundColor='#FFB300'"
                          onmouseout="this.style.backgroundColor='#FFC107'">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Tindak
                        </a>
                    @endcan
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="report-description" style="font-size: 14px; margin-top: 10px;">
                {{ $complaint->content }}
            </div>

            {{-- Gambar --}}
            @if($complaint->media && $complaint->media->count() > 0)
                <div class="report-image" style="margin-top: 12px;">
                    <img src="{{ Storage::url($complaint->media->first()->file_url) }}" alt="Gambar laporan" style="
                        width: 100%;
                        border-radius: 10px;
                        object-fit: cover;
                    ">
                </div>
            @endif

            {{-- Status Box --}}
            @if(in_array($complaint->status, ['diproses', 'selesai']))
                @php
                    $statusStyles = [
                        'diproses' => ['bg' => '#FFF8E1', 'border' => '#FBC02D', 'title' => 'Sedang Diproses', 'desc' => 'Laporan Anda sedang ditinjau.'],
                        'selesai'  => ['bg' => '#E8F5E9', 'border' => '#4CAF50', 'title' => 'Laporan Selesai', 'desc' => 'Laporan Anda telah selesai ditindaklanjuti.'],
                    ];
                    $style = $statusStyles[$complaint->status];
                @endphp

                <div style="
                    background-color: {{ $style['bg'] }};
                    border-left: 4px solid {{ $style['border'] }};
                    padding: 12px 16px;
                    border-radius: 8px;
                    margin-top: 12px;
                ">
                    <div style="font-size: 13px; font-weight: 600;">{{ $style['title'] }}</div>
                    <div style="font-size: 13px; color: #757575;">{{ $style['desc'] }}</div>
                </div>
            @endif

            {{-- Footer Aksi --}}
            <livewire:components.complaint-actions :complaint="$complaint" :key="'actions-'.$complaint->id" />
        </div>
    @endif
</div>
