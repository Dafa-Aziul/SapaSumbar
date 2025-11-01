<div>
    <div class="notification-page-wrapper" style="
        background: #FFFFFF;
        padding: 24px;
        max-width: 960px;
        margin: 0 auto;
        font-family: 'Inter', sans-serif;
    ">
        {{-- Judul Halaman --}}
        <h1 class="page-title" style="
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 24px;
        ">Notifikasi</h1>

        {{-- Daftar Notifikasi --}}
        <div class="notification-list" style="
            display: flex;
            flex-direction: column;
            gap: 16px;
        ">
            @forelse($notifications as $notification)
                <div
                    wire:key="notification-{{ $notification['id'] }}"
                    class="notification-item {{ $notification['is_read'] ? 'read' : 'unread' }}"
                    style="
                        position: relative;
                        padding: 16px;
                        background: #FFFFFF;
                        border: 1px solid {{ $notification['is_read'] ? '#E5E7EB' : '#D90429' }};
                        border-radius: 12px;
                        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
                        cursor: pointer;
                        transition: all 0.2s;
                    "
                    wire:click="markAsRead({{ $notification['id'] }})"
                >
                    {{-- Ikon Lonceng (Unread) --}}
                    @if(!$notification['is_read'])
                    <div style="
                        position: absolute;
                        top: 16px;
                        right: 16px;
                        width: 18px;
                        height: 18px;
                        color: #D90429;
                    ">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </div>
                    @endif

                    {{-- Judul Notifikasi --}}
                    <div class="notification-title" style="
                        font-size: 16px;
                        font-weight: 600;
                        color: #111827;
                        margin-bottom: 4px;
                        padding-right: {{ $notification['is_read'] ? '0' : '30px' }};
                    ">
                        {{ $notification['title'] }}
                    </div>

                    {{-- Deskripsi Notifikasi --}}
                    <div class="notification-description" style="
                        font-size: 14px;
                        font-weight: 400;
                        color: #6B7280;
                        line-height: 1.5;
                        margin-top: 4px;
                    ">
                        {{ $notification['description'] }}
                    </div>

                    {{-- Timestamp --}}
                    <div class="notification-timestamp" style="
                        font-size: 12px;
                        font-weight: 400;
                        color: #9CA3AF;
                        margin-top: 12px;
                    ">
                        @php
                            $createdAt = is_object($notification['created_at'])
                                ? $notification['created_at']
                                : \Carbon\Carbon::parse($notification['created_at']);
                            echo $createdAt->diffForHumans();
                        @endphp
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
                    <p style="color: #6B7280; font-size: 16px;">Tidak ada notifikasi</p>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .notification-item:hover {
            background-color: #F9FAFB !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .notification-page-wrapper {
                padding: 16px !important;
            }
        }

        @media (max-width: 480px) {
            .notification-page-wrapper {
                padding: 12px !important;
            }

            .page-title {
                font-size: 18px !important;
                margin-bottom: 16px !important;
            }
        }
    </style>
</div>

