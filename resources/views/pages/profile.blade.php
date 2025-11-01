@extends('layouts.main')

@section('title', 'Profile - Sapa Sumbar')

@section('content')
<style>
    .profile-page {
        display: flex;
        min-height: calc(100vh - 4rem);
        background-color: #FFFFFF;
    }

    /* Sidebar */
    .profile-sidebar {
        width: 240px;
        background-color: #FFFFFF;
        border-right: 1px solid #E0E0E0;
        padding: 20px 0;
        flex-shrink: 0;
    }

    .sidebar-logo {
        height: 32px;
        width: auto;
        margin: 20px 0 24px 20px;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-menu-item {
        margin: 0;
    }

    .sidebar-menu-link {
        display: flex;
        align-items: center;
        padding: 10px 16px;
        margin: 0 12px 4px 12px;
        color: #616161;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.2s;
        font-family: 'Inter', sans-serif;
    }

    .sidebar-menu-link:hover {
        background-color: #F5F5F5;
    }

    .sidebar-menu-link.active {
        background-color: #FDEAEA;
        color: #B71C1C;
        font-weight: 600;
    }

    .sidebar-menu-icon {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        flex-shrink: 0;
    }

    /* Content Area */
    .profile-content {
        flex: 1;
        padding: 40px 60px;
        background-color: #FFFFFF;
        min-width: 0;
    }

    .page-title {
        font-size: 22px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 32px;
        line-height: 1.3;
        font-family: 'Inter', sans-serif;
    }

    .profile-form {
        max-width: 600px;
    }

    /* ======================================
    PERUBAHAN UTAMA CSS DIMULAI DI SINI
    ======================================
    */

    .form-field {
        display: flex;          /* 1. Menggunakan Flexbox */
        align-items: center;  /* 2. Menyejajarkan label & input secara vertikal */
        margin-bottom: 24px;
        gap: 16px;              /* 3. Memberi jarak antara label dan input */
    }

    .form-label {
        /* display: block; -> Tidak perlu lagi */
        font-size: 16px;        /* 4. Menyesuaikan ukuran font label */
        font-weight: 500;       /* 5. Menyesuaikan ketebalan font label */
        color: #4B5563;
        margin-bottom: 0;       /* 6. Menghapus margin bawah */
        flex-basis: 80px;       /* 7. Memberi lebar tetap pada label */
        flex-shrink: 0;         /* 8. Mencegah label menyusut */
        font-family: 'Inter', sans-serif;
    }

    .form-input-group {
        display: flex;
        align-items: center;
        gap: 8px;
        flex: 1;                /* 9. Membuat grup input mengisi sisa ruang */
    }

    .form-input {
        flex: 1;
        height: 42px;
        padding: 10px 14px;
        font-size: 16px;        /* 10. Menyesuaikan font input */
        border: 1px solid #CBD5E1;
        border-radius: 6px;
        background-color: #FFFFFF; /* 11. Background default diubah jadi PUTIH */
        color: #111827;
        font-family: 'Inter', sans-serif;
        transition: all 0.2s;
    }

    .form-input:focus {
        outline: none;
        border: 1.5px solid #B91C1C;
        background-color: #FFFFFF;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    .form-input:disabled {
        cursor: default;
        background-color: #F1F5F9; /* 12. Background disabled diubah jadi ABU-ABU MUDA */
        color: #4B5563;
        border: 1px solid #CBD5E1;
    }

    .form-input::placeholder {
        color: #9CA3AF;
    }

    .btn-edit {
        width: 42px;            /* 13. Menyamakan tinggi/lebar tombol */
        height: 42px;           /* 13. Menyamakan tinggi/lebar tombol */
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #C62828;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        flex-shrink: 0;
    }

    .btn-edit:hover {
        background-color: #B71C1C;
    }

    .btn-edit svg {
        width: 18px;
        height: 18px;
        color: #FFFFFF;
    }

    .password-field {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;                /* 14. Membuat field password mengisi sisa ruang */
    }

    .btn-reset-password {
        display: flex;
        align-items: center;
        gap: 8px;
        height: 42px;           /* 15. Menyamakan tinggi tombol */
        padding: 0 16px;
        background-color: #C62828;
        color: #FFFFFF;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        font-family: 'Inter', sans-serif;
    }

    /* ======================================
    PERUBAHAN UTAMA CSS BERAKHIR DI SINI
    ======================================
    */

    .btn-reset-password:hover {
        background-color: #B71C1C;
        box-shadow: 0 3px 6px rgba(220, 38, 38, 0.25);
    }

    .btn-reset-password:active {
        transform: translateY(1px);
    }

    .btn-reset-password-icon {
        width: 16px;
        height: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .btn-reset-password-icon svg {
        width: 16px;
        height: 16px;
        color: #FFFFFF;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-page {
            flex-direction: column;
        }

        .profile-sidebar {
            width: 100%;
            border-right: none;
            border-bottom: 1px solid #E0E0E0;
            padding: 16px 0;
        }

        .sidebar-logo {
            margin: 0 0 16px 16px;
        }

        .sidebar-menu {
            display: flex;
            gap: 8px;
            padding: 0 16px;
            overflow-x: auto;
        }

        .sidebar-menu-item {
            flex-shrink: 0;
        }

        .sidebar-menu-link {
            margin: 0;
            white-space: nowrap;
        }

        .profile-content {
            padding: 32px 24px;
        }

        .form-field {
            margin-bottom: 24px;
        }
    }

    @media (max-width: 480px) {
        .profile-content {
            padding: 24px 16px;
        }

        .page-title {
            font-size: 20px;
            margin-bottom: 24px;
        }

        /* Penyesuaian responsive untuk label di kiri */
        .form-field {
            flex-direction: column; /* Mengembalikan ke layout vertikal di HP */
            align-items: flex-start; /* Label rata kiri */
            gap: 8px; /* Jarak antara label dan input */
        }

        .form-label {
            flex-basis: auto; /* Hapus lebar tetap di HP */
            font-size: 14px; /* Kembalikan ke font lebih kecil */
        }

        .form-input-group {
            width: 100%; /* Input group jadi lebar penuh */
        }

        .password-field {
            width: 100%;
        }

        .btn-reset-password {
            width: 100%;
            justify-content: center;
        }

        .form-input-group {
            flex-wrap: wrap;
        }

        .btn-edit {
            width: 100%;
            height: 44px;
        }
    }
</style>

<div class="profile-page">
    {{-- Sidebar --}}
    <aside class="profile-sidebar">
        <ul class="sidebar-menu">
            <li class="sidebar-menu-item">
                <a href="{{ route('profile') }}" class="sidebar-menu-link active">
                    <svg class="sidebar-menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Pengaturan Profil
                </a>
            </li>
            <li class="sidebar-menu-item">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="sidebar-menu-link" style="width: 100%; text-align: left; background: transparent; border: none; cursor: pointer;">
                        <svg class="sidebar-menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Log Out
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    {{-- Main Content --}}
    <div class="profile-content">
        <h1 class="page-title">Pengaturan Profil</h1>

        <form class="profile-form">
            {{-- 
            ======================================
            PERUBAHAN UTAMA HTML DIMULAI DI SINI
            ======================================
            --}}
            
            {{-- Nama Field --}}
            <div class="form-field">
                <label class="form-label" for="name">Nama</label>
                <div class="form-input-group">
                    <input 
                        type="text" 
                        id="name"
                        name="name"
                        class="form-input" 
                        value="{{ auth()->user()->name ?? '' }}"
                        placeholder="Nama Lengkap"
                        {{-- Atribut "disabled" DIHAPUS agar background putih --}}
                    >
                    <button type="button" class="btn-edit" onclick="enableEdit('name')">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Email Field --}}
            <div class="form-field">
                <label class="form-label" for="email">Email</label>
                <div class="form-input-group">
                    <input 
                        type="email" 
                        id="email"
                        name="email"
                        class="form-input" 
                        value="{{ auth()->user()->email ?? '' }}"
                        placeholder="nama@email.com"
                        disabled {{-- Biarkan disabled agar background abu-abu --}}
                    >
                    {{-- Tombol "Edit" DIHAPUS agar sesuai gambar --}}
                </div>
            </div>

            {{-- No HP Field --}}
            <div class="form-field">
                <label class="form-label" for="no_wa">No HP</label>
                <div class="form-input-group">
                    <input 
                        type="tel" 
                        id="no_wa"
                        name="no_wa"
                        class="form-input" 
                        value="{{ auth()->user()->no_wa ?? '' }}"
                        placeholder="08xx-xxxx-xxxx"
                        disabled {{-- Biarkan disabled agar background abu-abu --}}
                    >
                    {{-- Tombol "Edit" DIHAPUS agar sesuai gambar --}}
                </div>
            </div>

            {{-- Password Field --}}
            <div class="form-field">
                {{-- Inline style DIHAPUS dari label --}}
                <label class="form-label">Password</label>
                <div class="password-field">
                    <button type="button" class="btn-reset-password">
                        <span class="btn-reset-password-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {{-- Mengganti Ikon agar sesuai gambar --}}
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H7v-4l1.743-1.743A6 6 0 0121 9z" />
                            </svg>
                        </span>
                        Reset Password
                    </button>
                </div>
            </div>
            
            {{-- 
            ======================================
            PERUBAHAN UTAMA HTML BERAKHIR DI SINI
            ======================================
            --}}
        </form>
    </div>
</div>

<script>
    function enableEdit(fieldId) {
        const input = document.getElementById(fieldId);
        if (input.disabled) {
            input.disabled = false;
            input.focus();
            input.style.backgroundColor = '#FFFFFF';
        }
    }

    // Blok "click outside" DIHAPUS untuk menyederhanakan
</script>
@endsection

