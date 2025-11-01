@if(!$complaint)
    <div>Complaint not found</div>
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

            {{-- Nama & Kategori --}}
            <div style="flex: 1; min-width: 0;">
                <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 8px;">
                    <span style="
                        font-size: 15px;
                        font-weight: 600;
                        color: #212121;
                    ">
                        {{ $complaint->user->name ?? 'Pengguna' }}
                    </span>
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
                            Terminal Bus Aur Kuning
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

    {{-- Gambar (jika ada) --}}
    @if($complaint->media && $complaint->media->count() > 0)
    <div class="report-image" style="margin-top: 12px;">
        <img
            src="{{ asset($complaint->media->first()->file_url) }}"
            alt="Gambar laporan"
            style="
                width: 100%;
                max-height: auto;
                border-radius: 10px;
                object-fit: cover;
            "
        >
    </div>
    @endif

    {{-- Status Box --}}
    <div class="report-status" style="
        background-color: #FFF8E1;
        border-left: 4px solid #FBC02D;
        padding: 12px 16px;
        border-radius: 0 0 12px 12px;
        margin-top: 12px;
    ">
        <div style="
            font-size: 13px;
            font-weight: 600;
            color: #212121;
            margin-bottom: 4px;
        ">
            @if($complaint->status === 'pending' || $complaint->status === 'terkirim')
                Dalam Proses
            @elseif($complaint->status === 'processing' || $complaint->status === 'diproses')
                Sedang Diproses
            @elseif($complaint->status === 'completed' || $complaint->status === 'selesai')
                Selesai
            @else
                Dalam Proses
            @endif
        </div>
        <div style="
            font-size: 13px;
            color: #757575;
        ">
            @if($complaint->status === 'pending' || $complaint->status === 'terkirim')
                Tim kami sedang melakukan investigasi terkait laporan Anda. Kami akan menindaklanjuti dalam waktu 2×24 jam. Terima kasih atas laporannya.
            @elseif($complaint->status === 'processing' || $complaint->status === 'diproses')
                Laporan Anda sedang dalam proses penanganan oleh tim terkait.
            @elseif($complaint->status === 'completed' || $complaint->status === 'selesai')
                Laporan Anda telah selesai ditangani. Terima kasih atas kontribusinya.
            @else
                Tim kami sedang melakukan investigasi terkait laporan Anda. Kami akan menindaklanjuti dalam waktu 2×24 jam. Terima kasih atas laporannya.
            @endif
        </div>
    </div>

    {{-- Footer Aksi --}}
    <div class="report-footer-actions" style="
        display: flex;
        align-items: center;
        gap: 24px;
        padding-top: 12px;
        border-top: 1px solid #E0E0E0;
        margin-top: 12px;
    ">
        {{-- Vote Button --}}
        <button
            wire:click="vote"
            class="vote-button"
            style="
                display: flex;
                align-items: center;
                gap: 6px;
                background: none;
                border: none;
                cursor: pointer;
                padding: 0;
                font-size: 13px;
                font-weight: 500;
                color: #616161;
                transition: color 0.2s;
            "
            onmouseover="this.style.color='#E53935'"
            onmouseout="this.style.color='#616161'"
        >
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M7 13l5 5 5-5M7 6l5 5 5-5"></path>
            </svg>
            <span>Vote ({{ $complaint->votes->count() ?? 0 }})</span>
        </button>

        {{-- Comment Button --}}
        <button
            class="comment-button"
            style="
                display: flex;
                align-items: center;
                gap: 6px;
                background: none;
                border: none;
                cursor: pointer;
                padding: 0;
                font-size: 13px;
                font-weight: 500;
                color: #616161;
                transition: color 0.2s;
            "
            onmouseover="this.style.color='#E53935'"
            onmouseout="this.style.color='#616161'"
        >
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            <span>Comment ({{ $complaint->responses->count() ?? 0 }})</span>
        </button>
    </div>

    <style>
        /* Responsive styles */
        @media (max-width: 768px) {
            .report-card {
                width: 100% !important;
                padding: 16px !important;
            }
        }

        @media (max-width: 480px) {
            .report-card {
                width: 100% !important;
                padding: 16px !important;
            }

            .report-description {
                font-size: 13px !important;
            }

            .vote-button,
            .comment-button {
                font-size: 12px !important;
            }

            .vote-button svg,
            .comment-button svg {
                width: 14px !important;
                height: 14px !important;
            }
        }
    </style>
</div>
@endif

