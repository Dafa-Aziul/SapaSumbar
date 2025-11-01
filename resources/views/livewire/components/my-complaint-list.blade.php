<div>
    <div class="my-complaints-container" style="max-width: 640px; margin: 0 auto; padding: 20px;">
        @forelse ($complaints as $complaint)
        <div style="
                background: #FFFFFF;
                border: 1px solid #E5E7EB;
                border-radius: 12px;
                padding: 20px;
                margin-bottom: 24px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            ">

            {{-- HEADER --}}
            <div class="report-header" style="margin-bottom: 8px;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    {{-- Avatar --}}
                    <div style="
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
                            @else
                            <span style="
                                background-color: #ECEFF1;
                                color: #607D8B;
                                font-size: 12px;
                                font-weight: 600;
                                padding: 2px 8px;
                                border-radius: 6px;
                                white-space: nowrap;
                            ">
                                Menunggu
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

            {{-- DESKRIPSI --}}
            <div style="
                font-size: 14px;
                line-height: 1.6;
                color: #212121;
                margin-top: 8px;
                margin-bottom: 12px;
            ">
                {{ $complaint->content }}
            </div>

            {{-- GAMBAR --}}
            @if($complaint->media && $complaint->media->count() > 0)
            <div style="margin-top: 12px;">
                <img src="{{ asset($complaint->media->first()->file_url) }}" alt="Gambar laporan"
                    style="width: 100%; border-radius: 10px; object-fit: cover;">
            </div>
            @endif

            {{-- PROGRESS --}}
            @if($complaint->progress && $complaint->progress->count() > 0)
            <div style="margin-top: 16px;">
                <p style="font-weight: 600; color: #111827; font-size: 15px; margin-bottom: 10px;">
                    Progress Pengaduan
                </p>
                <div style="position: relative; padding-left: 20px;">
                    @foreach ($complaint->progress as $step)
                    <div style="position: relative; margin-bottom: 16px;">
                        @if (!$loop->last)
                        <span style="
                            position: absolute;
                            left: 7px;
                            top: 12px;
                            bottom: -10px;
                            width: 2px;
                            background: #E5E7EB;
                        "></span>
                        @endif

                        <span style="
                            position: absolute;
                            left: 0;
                            top: 6px;
                            width: 14px;
                            height: 14px;
                            border-radius: 50%;
                            background:
                                @if ($step->status === 'selesai') #16A34A
                                @elseif ($step->status === 'diproses') #FACC15
                                @else #9CA3AF
                                @endif;
                        "></span>

                        <div style="margin-left: 24px;">
                            <p style="font-size: 14px; font-weight: 600; color: #111827; margin: 0;">
                                {{ $step->title }}
                            </p>
                            <p style="font-size: 13px; color: #6B7280; margin: 2px 0 2px 0;">
                                {{ $step->description }}
                            </p>
                            <p style="font-size: 12px; color: #9CA3AF; margin: 0;">
                                {{ $step->created_at?->format('d M Y, H:i') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- FOOTER ICON --}}
            <div style="
                display:flex;
                align-items:center;
                gap:20px;
                padding-top:12px;
                border-top:1px solid #E0E0E0;
                margin-top:16px;
                color:#616161;
            ">
                {{-- Vote count --}}
                <div style="display:flex;align-items:center;gap:6px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 4l6 8H6l6-8z" />
                    </svg>
                    <span style="font-size:13px;">{{ $complaint->votes->count() }}</span>
                </div>

                {{-- Comment count --}}
                <div style="display:flex;align-items:center;gap:6px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span style="font-size:13px;">{{ $complaint->responses->count() ?? 0 }}</span>
                </div>
            </div>
        </div>
        @empty
        <div style="
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            padding: 48px 24px;
            text-align: center;
        ">
            <p style="color: #6B7280; font-size: 16px;">Belum ada pengaduan yang dilaporkan</p>
        </div>
        @endforelse
    </div>

    {{-- CSS internal --}}
    <style>
        @media (max-width: 768px) {
            .my-complaints-container {
                padding: 16px !important;
            }
        }
    </style>
</div>
