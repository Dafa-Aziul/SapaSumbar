@if(!$complaint)
<div class="text-center text-gray-500 py-4">Laporan tidak ditemukan.</div>
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
    <div class="report-header" style="margin-bottom: 8px;">
        <div style="display: flex; align-items: center; gap: 12px;">
            {{-- Avatar --}}
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
                flex-shrink: 0;
            ">
                {{ strtoupper(substr($complaint->user->name ?? 'U', 0, 1)) }}
            </div>

            {{-- Nama, Kategori, Status --}}
            <div style="flex: 1; min-width: 0;">
                <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 8px;">
                    <span style="font-size: 15px; font-weight: 600; color: #212121;">
                        {{ $complaint->user->name ?? 'Anonim' }}
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
                            white-space: nowrap;
                        ">
                        {{ $complaint->category->name }}
                    </span>
                    @endif

                    {{-- Status Badge --}}
                    @if($complaint->status === 'diproses')
                    <span style="
                            background-color: #FFF3CD;
                            color: #FBC02D;
                            font-size: 12px;
                            font-weight: 600;
                            padding: 2px 8px;
                            border-radius: 6px;
                            white-space: nowrap;
                        ">
                        Diproses
                    </span>
                    @elseif($complaint->status === 'selesai')
                    <span style="
                            background-color: #E8F5E9;
                            color: #4CAF50;
                            font-size: 12px;
                            font-weight: 600;
                            padding: 2px 8px;
                            border-radius: 6px;
                            white-space: nowrap;
                        ">
                        Selesai
                    </span>
                    @endif
                </div>

                {{-- Waktu & Lokasi --}}
                <div style="
                    display: flex;
                    align-items: center;
                    gap: 6px;
                    margin-top: 4px;
                    font-size: 12px;
                    color: #9E9E9E;
                ">
                    <span>{{ $complaint->created_at->diffForHumans() }}</span>
                    <span>·</span>
                    <div style="display: flex; align-items: center; gap: 4px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#757575" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span style="font-size: 13px; color: #757575;">
                            {{ $complaint->location ?? 'Lokasi tidak diketahui' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Deskripsi --}}
    <div class="report-description" style="
        font-size: 14px;
        line-height: 1.6;
        color: #212121;
        margin-top: 8px;
        margin-bottom: 12px;
    ">
        {{ $complaint->content }}
    </div>

    {{-- Gambar --}}
    @if($complaint->media && $complaint->media->count() > 0)
    <div class="report-image" style="margin-top: 12px;">
        <img src="{{ asset($complaint->media->first()->file_url) }}" alt="Gambar laporan" style="
                    width: 100%;
                    border-radius: 10px;
                    object-fit: cover;
                ">
    </div>
    @endif

    {{-- Status Box (hanya jika diproses / selesai) --}}
    @if(in_array($complaint->status, ['diproses', 'selesai']))
    @php
    $statusStyles = [
    'diproses' => [
    'bg' => '#FFF8E1',
    'border' => '#FBC02D',
    'title' => 'Sedang Diproses',
    'desc' => 'Laporan Anda sedang ditinjau oleh pihak terkait.',
    ],
    'selesai' => [
    'bg' => '#E8F5E9',
    'border' => '#4CAF50',
    'title' => 'Laporan Selesai',
    'desc' => 'Laporan Anda telah selesai ditindaklanjuti. Terima kasih atas partisipasi Anda!',
    ],
    ];
    $style = $statusStyles[$complaint->status];
    $latestProgress = $complaint->progress()->latest()->first();
    @endphp

    <div class="report-status" style="
            background-color: {{ $style['bg'] }};
            border-left: 4px solid {{ $style['border'] }};
            padding: 12px 16px;
            border-radius: 8px;
            margin-top: 12px;
            transition: all 0.3s ease-in-out;
        ">
        <div style="font-size: 13px; font-weight: 600; color: #212121; margin-bottom: 4px;">
            {{ $style['title'] }}
        </div>
        <div style="font-size: 13px; color: #757575; margin-bottom: 8px;">
            {{ $style['desc'] }}
        </div>

        {{-- Progress Information --}}
        @if($latestProgress)
        <div style="
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid rgba(0,0,0,0.1);
        ">
            <div style="font-size: 12px; font-weight: 600; color: #212121; margin-bottom: 6px;">
                📋 Update Terbaru:
            </div>
            <div style="font-size: 13px; color: #212121; line-height: 1.5; margin-bottom: 10px;">
                {{ $latestProgress->description }}
            </div>
            <div style="font-size: 11px; color: #9E9E9E;">
                Oleh: <strong>{{ $latestProgress->admin->name ?? 'Admin' }}</strong> · {{ $latestProgress->created_at->format('d M Y H:i') }}
            </div>

            {{-- Progress Media (Foto) --}}
            @if($latestProgress->media && $latestProgress->media->count() > 0)
            <div style="margin-top: 10px;">
                <div style="font-size: 12px; font-weight: 600; color: #212121; margin-bottom: 8px;">
                    🖼️ Dokumentasi:
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 8px;">
                    @foreach($latestProgress->media as $media)
                    <div style="
                        position: relative;
                        overflow: hidden;
                        border-radius: 6px;
                        aspect-ratio: 1;
                        cursor: pointer;
                        transition: transform 0.2s;
                    " onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        <img src="{{ asset('storage/' . $media->file_url) }}" alt="Foto progres" style="
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        ">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif
    </div>

    {{-- All Progress Timeline --}}
    @if($complaint->progress && $complaint->progress->count() > 1)
    <div style="
        margin-top: 12px;
        padding: 12px 16px;
        background-color: #FAFAFA;
        border: 1px solid #E0E0E0;
        border-radius: 8px;
    ">
        <div style="font-size: 12px; font-weight: 600; color: #212121; margin-bottom: 10px;">
            📊 Riwayat Progres:
        </div>
        <div style="display: flex; flex-direction: column; gap: 10px;">
            @foreach($complaint->progress->sortByDesc('created_at') as $progress)
            <div style="
                padding: 10px;
                background-color: #FFFFFF;
                border-radius: 6px;
                border-left: 3px solid
                @if($progress->status_update === 'selesai') #4CAF50 @else #FBC02D @endif;
            ">
                <div style="font-size: 12px; font-weight: 600; color: #212121;">
                    {{ ucfirst($progress->status_update) }} - {{ $progress->created_at->format('d M Y') }}
                </div>
                <div style="font-size: 12px; color: #757575; margin-top: 4px;">
                    {{ Str::limit($progress->description, 100) }}
                </div>
                <div style="font-size: 11px; color: #9E9E9E; margin-top: 4px;">
                    {{ $progress->admin->name ?? 'Admin' }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @endif

    {{-- Footer Aksi --}}
    <livewire:components.complaint-actions :complaint="$complaint" :key="'actions-'.$complaint->id" />
</div>
@endif
