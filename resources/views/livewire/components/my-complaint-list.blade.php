<div>
    <div class="my-complaints-container" style="max-width: 640px; margin: 0 auto; padding: 20px;">
        @forelse ($complaints as $complaint)
@php
    // Fallback untuk $complaint jika null atau bukan objek (misal: array dari JSON)
    $complaintObj = is_object($complaint) ? $complaint : (object)$complaint;

    // Ambil ID, buat unik jika tidak ada
    $complaintId = $complaintObj->id ?? uniqid();
    $uniqueId = 'complaint-' . $complaintId;

    // Persiapan data dengan fallback
    $user = (object)($complaintObj->user ?? ['name' => 'Pengguna']);
    $userName = $user->name ?? 'Pengguna';
    $userInitials = strtoupper(substr($userName, 0, 1));
    $userInitials .= strtoupper(substr(explode(' ', $userName)[1] ?? '', 0, 1));

    $category = (object)($complaintObj->category ?? ['name' => 'Kategori']);
    $categoryName = $category->name ?? 'Kategori';

    $createdAt = $complaintObj->created_at ?? now();
    $createdAtParsed = is_object($createdAt) ? $createdAt : \Carbon\Carbon::parse($createdAt);

    $content = $complaintObj->content ?? 'Tidak ada deskripsi.';
    $status = $complaintObj->status ?? 'terkirim';

    // Logika media (gambar)
    $media = $complaintObj->media ?? collect([]);
    $firstMedia = null;
    if (is_object($media) && method_exists($media, 'first')) {
        $firstMedia = $media->first();
    } elseif (is_array($media) && count($media) > 0) {
        $firstMedia = (object)$media[0];
    } elseif ($media instanceof \Illuminate\Support\Collection) {
        $firstMedia = $media->first();
    }

    // Logika progress
    $progressCollection = $complaintObj->progress ?? collect([]);
    $firstProgress = null;
    if (is_object($progressCollection) && method_exists($progressCollection, 'first')) {
        $firstProgress = $progressCollection->first();
    } elseif (is_array($progressCollection) && count($progressCollection) > 0) {
        $firstProgress = (object)$progressCollection[0];
    } elseif ($progressCollection instanceof \Illuminate\Support\Collection) {
        $firstProgress = $progressCollection->first();
    }

    $progressSteps = [
        ['status' => 'completed', 'title' => 'Pengaduan Terkirim', 'desc' => 'Pengaduan Anda telah diterima dan sedang dalam antrian untuk ditinjau.', 'date' => $createdAtParsed],
        ['status' => $status === 'diproses' ? 'active' : ($status === 'selesai' ? 'completed' : 'pending'), 'title' => 'Ditindak Lanjuti', 'desc' => 'Tim sedang melakukan investigasi terkait pengaduan Anda.', 'date' => $firstProgress->created_at ?? null],
        ['status' => $status === 'selesai' ? 'completed' : 'pending', 'title' => 'Selesai', 'desc' => 'Pengaduan telah selesai ditangani.', 'date' => ($status === 'selesai' ? ($complaintObj->updated_at ?? null) : null)], // Tampilkan tanggal update jika selesai
    ];

    // Logika vote
    $votesCount = 0;
    if (isset($complaintObj->votes)) {
        if (is_object($complaintObj->votes) && method_exists($complaintObj->votes, 'count')) {
            $votesCount = $complaintObj->votes->count();
        } elseif (is_array($complaintObj->votes)) {
            $votesCount = count($complaintObj->votes);
        } elseif ($complaintObj->votes instanceof \Illuminate\Support\Collection) {
             $votesCount = $complaintObj->votes->count();
        }
    }

    // Logika response
    $responsesCount = 0;
    if (isset($complaintObj->responses)) {
        if (is_object($complaintObj->responses) && method_exists($complaintObj->responses, 'count')) {
            $responsesCount = $complaintObj->responses->count();
        } elseif (is_array($complaintObj->responses)) {
            $responsesCount = count($complaintObj->responses);
        } elseif ($complaintObj->responses instanceof \Illuminate\Support\Collection) {
            $responsesCount = $complaintObj->responses->count();
        }
    }

@endphp
<div class="complaint-card" style="
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    margin-bottom: 20px;
    font-family: 'Inter', sans-serif;
    max-width: 100%; /* Ditambahkan untuk responsif */
" x-data="{ showProgress{{ $complaintId }}: false }">

    {{-- Card Header --}}
    <div class="card-header" style="
        display: flex;
        align-items: center;
        padding: 20px 20px 16px 20px;
    ">
        {{-- Avatar --}}
        <div style="
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #E0E7FF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #4338CA;
            font-size: 16px;
            flex-shrink: 0;
        ">
            {{ $userInitials }}
        </div>

        {{-- Author Info --}}
        <div style="margin-left: 12px; flex: 1; min-width: 0;">
            {{-- Nama & Tag --}}
            <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                <span class="author-name" style="
                    font-weight: 600;
                    color: #111827;
                    font-size: 16px;
                ">{{ $userName }}</span>
                @if($categoryName !== 'Kategori')
                <span style="
                    background: #FEE2E2;
                    color: #B91C1C;
                    font-size: 12px;
                    padding: 2px 8px;
                    border-radius: 12px;
                    font-weight: 500;
                ">{{ $categoryName }}</span>
                @endif
            </div>

            {{-- Meta Info --}}
            <div style="display: flex; align-items: center; gap: 8px; margin-top: 2px; flex-wrap: wrap;">
                <span style="font-size: 14px; color: #6B7280;">
                    {{ $createdAtParsed->diffForHumans() }}
                </span>
                <span style="color: #9CA3AF; font-size: 14px;">•</span>
                <div style="display: flex; align-items: center; gap: 4px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <span style="font-size: 14px; color: #6B7280;">{{ $complaint->location ?? 'Lokasi tidak diketahui' }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Body --}}
    <div class="card-body" style="padding: 0 20px 20px 20px;">
        {{-- Teks Aduan --}}
        <p class="complaint-content" style="
            color: #374151;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 16px;
            word-break: break-word; /* Ditambahkan untuk mobile */
        ">{{ $content }}</p>

        {{-- Gambar Aduan --}}
        @if($firstMedia && isset($firstMedia->file_url))
        <img
            src="{{ asset($firstMedia->file_url) }}"
            alt="Gambar pengaduan"
            style="
                width: 100%;
                height: auto;
                border-radius: 8px;
                object-fit: cover;
                background-color: #F3F4F6; /* Placeholder saat loading */
            "
        >
        @endif
    </div>

    {{-- Card Info Box --}}
    <div class="info-box" style="
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin: 0 20px 20px 20px;
        background: #EFF6FF;
        border: 1px solid #BFDBFE;
        padding: 16px;
        border-radius: 8px;
    ">
        {{-- Icon Box --}}
        <div style="
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #DBEAFE;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        ">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2">
                <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>

        {{-- Text Box --}}
        <div style="flex: 1; min-width: 0;">
            <div class="info-box-title" style="
                font-weight: 600;
                color: #1E4ED8;
                margin-bottom: 4px;
                font-size: 15px;
            ">
                @if($status === 'terkirim')
                    Pengaduan Terkirim
                @elseif($status === 'diproses')
                    Pengaduan Diproses
                @elseif($status === 'selesai')
                    Pengaduan Selesai
                @else
                    Pengaduan Terkirim
                @endif
            </div>
            <div class="info-box-desc" style="
                font-size: 14px;
                color: #1D4ED8;
                line-height: 1.5;
                margin-bottom: 8px;
            ">
                @if($status === 'terkirim')
                    Pengaduan Anda telah diterima dan sedang dalam antrian untuk ditinjau.
                @elseif($status === 'diproses')
                    Pengaduan Anda sedang dalam proses penanganan oleh tim terkait.
                @elseif($status === 'selesai')
                    Pengaduan Anda telah selesai ditangani. Terima kasih atas kontribusinya.
                @else
                    Pengaduan Anda telah diterima dan sedang dalam antrian untuk ditinjau.
                @endif
            </div>
            <button
                @click="showProgress{{ $complaintId }} = !showProgress{{ $complaintId }}"
                class="progress-toggle-btn"
                style="
                    display: flex;
                    align-items: center;
                    gap: 4px;
                    font-size: 14px;
                    font-weight: 500;
                    color: #1D4ED8;
                    background: none;
                    border: none;
                    cursor: pointer;
                    padding: 0;
                    transition: all 0.2s;
                "
            >
                Lihat progress Pengaduan
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" :style="'transform: rotate(' + (showProgress{{ $complaintId }} ? '180deg' : '0deg') + '); transition: transform 0.2s;'">
                    <path d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Card Progress --}}
    <div class="progress-section" x-show="showProgress{{ $complaintId }}" x-cloak style="padding: 0 20px 20px 20px;">
        <h3 class="progress-title" style="
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 16px;
        ">Progress Pengaduan</h3>

        <ul class="progress-timeline" style="
            position: relative;
            border-left: 2px solid #E5E7EB;
            margin-left: 14px;
            padding-left: 0;
            list-style: none;
        ">
            @foreach($progressSteps as $index => $step)
            <li class="progress-step" style="
                position: relative;
                padding-left: 28px;
                margin-bottom: 24px;
            ">
                {{-- Icon Dot --}}
                <div class="progress-dot" style="
                    position: absolute;
                    left: -15px;
                    top: -2px; /* Disesuaikan agar lebih pas di tengah */
                    width: 28px;
                    height: 28px;
                    border-radius: 50%;
                    background: {{ $step['status'] === 'completed' ? '#16A34A' : ($step['status'] === 'active' ? '#2563EB' : '#9CA3AF') }};
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border: 2px solid #FFFFFF;
                    box-shadow: 0 0 0 2px {{ $step['status'] === 'completed' ? '#16A34A' : ($step['status'] === 'active' ? '#2563EB' : '#9CA3AF') }};
                ">
                    @if($step['status'] === 'completed')
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    @elseif($step['status'] === 'active')
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    @else
                    <div style="width: 8px; height: 8px; border-radius: 50%; background: #FFFFFF;"></div>
                    @endif
                </div>

                {{-- Content --}}
                <div>
                    <div class="progress-step-title" style="
                        font-weight: 600;
                        color: {{ $step['status'] === 'pending' ? '#9CA3AF' : '#111827' }};
                        margin-bottom: 4px;
                        font-size: 15px; /* Disesuaikan */
                    ">{{ $step['title'] }}</div>
                    <div class="progress-step-desc" style="
                        font-size: 14px;
                        color: {{ $step['status'] === 'pending' ? '#9CA3AF' : '#6B7280' }};
                        margin-bottom: 4px;
                        line-height: 1.5;
                    ">{{ $step['desc'] }}</div>
                    @if($step['date'])
                    <div class="progress-step-date" style="
                        font-size: 12px;
                        color: #9CA3AF;
                    ">
                        @php
                            $date = $step['date'];
                            if (is_object($date) && method_exists($date, 'format')) {
                                echo $date->format('d F Y, H:i');
                            } elseif (is_string($date)) {
                                echo \Carbon\Carbon::parse($date)->format('d F Y, H:i');
                            }
                        @endphp
                    </div>
                    @endif
                </div>
            </li>
            @endforeach
        </ul>
    </div>

    {{-- Card Footer --}}
    <div class="card-footer" style="
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px 20px;
        border-top: 1px solid #E5E7EB;
    ">
        {{-- Vote Button --}}
        <button class="vote-btn" style="
            display: flex;
            align-items: center;
            gap: 6px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            /* color: #6B7280; <-- Pindah ke CSS */
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s;
        ">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
            </svg>
            <span>Vote ({{ $votesCount }})</span>
        </button>

        {{-- Comment Button --}}
        <button class="comment-btn" style="
            display: flex;
            align-items: center;
            gap: 6px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            /* color: #6B7280; <-- Pindah ke CSS */
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s;
        " @click="window.dispatchEvent(new Event('show-comment-modal'))">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            <span>Comment ({{ $responsesCount }})</span>
        </button>
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

    <style>
        [x-cloak] { display: none !important; }

        /* Gaya Hover untuk Tombol (Menggantikan onmouseover) */
        .progress-toggle-btn:hover {
            text-decoration: underline;
        }
        .vote-btn,
        .comment-btn {
            color: #6B7280;
        }
        .vote-btn:hover,
        .comment-btn:hover {
            color: #111827;
        }

        /* Media Query untuk Mobile */
        @media (max-width: 600px) {
            /* Perkecil padding di sekeliling card */
            .card-header {
                padding: 16px !important;
            }
            .card-body {
                padding: 0 16px 16px 16px !important;
            }
            .info-box {
                margin-left: 16px !important;
                margin-right: 16px !important;
                padding: 12px !important;
            }
            .progress-section {
                padding: 0 16px 16px 16px !important;
            }
            .card-footer {
                padding: 16px !important;
                gap: 12px !important; /* Kurangi jarak antar tombol */
            }

            /* Perkecil font size */
            .author-name {
                font-size: 15px !important;
            }
            .complaint-content,
            .info-box-desc,
            .progress-step-desc,
            .vote-btn,
            .comment-btn,
            .progress-toggle-btn {
                font-size: 13px !important;
            }
            .info-box-title,
            .progress-step-title {
                font-size: 14px !important;
            }
            .progress-title {
                font-size: 15px !important;
            }

            /* Sesuaikan timeline progress */
            .progress-timeline {
                margin-left: 10px !important;
            }
            .progress-step {
                padding-left: 24px !important;
                margin-bottom: 20px !important;
            }
            .progress-dot {
                left: -13px !important;
                width: 24px !important;
                height: 24px !important;
            }
            .progress-dot svg {
                width: 14px !important;
                height: 14px !important;
            }
        }
        @media (max-width: 768px) {
            .my-complaints-container {
                padding: 16px !important;
            }
        }
    </style>
</div>
