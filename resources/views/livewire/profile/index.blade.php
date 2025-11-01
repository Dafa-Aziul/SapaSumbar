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
        padding: 40px 24px;
        background-color: #FFFFFF;
        min-width: 0;
        overflow-y: auto;
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
        width: 100%;
    }

    .form-field {
        display: flex;
        align-items: center;
        margin-bottom: 24px;
        gap: 16px;
    }

    .form-label {
        font-size: 16px;
        font-weight: 500;
        color: #4B5563;
        margin-bottom: 0;
        flex-basis: 120px;
        flex-shrink: 0;
        font-family: 'Inter', sans-serif;
        white-space: nowrap;
        overflow: visible;
    }

    .form-input-group {
        display: flex;
        align-items: center;
        gap: 8px;
        flex: 1;
        min-width: 0;
    }

    .form-input {
        flex: 1;
        height: 42px;
        padding: 10px 14px;
        font-size: 16px;
        border: 1px solid #CBD5E1;
        border-radius: 6px;
        background-color: #FFFFFF;
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
        background-color: #F1F5F9;
        color: #4B5563;
        border: 1px solid #CBD5E1;
    }

    .form-input::placeholder {
        color: #9CA3AF;
    }

    .form-value {
        flex: 1;
        height: 42px;
        padding: 10px 14px;
        font-size: 16px;
        border: 1px solid #CBD5E1;
        border-radius: 6px;
        background-color: #F8FAFC;
        color: #111827;
        font-family: 'Inter', sans-serif;
        display: flex;
        align-items: center;
        line-height: 1.4;
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

        .form-field {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .form-label {
            flex-basis: auto;
            font-size: 14px;
        }

        .form-input-group {
            width: 100%;
            flex-wrap: wrap;
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

        <div class="profile-form">
            {{-- Nama Field --}}
            <div class="form-field">
                <label class="form-label">Nama</label>
                <div class="form-input-group">
                    <span class="form-value">{{ auth()->user()->name }}</span>
                </div>
            </div>

            {{-- Email Field --}}
            <div class="form-field">
                <label class="form-label">Email</label>
                <div class="form-input-group">
                    <span class="form-value">{{ auth()->user()->email }}</span>
                </div>
            </div>

            {{-- No HP Field --}}
            <div class="form-field">
                <label class="form-label">No HP</label>
                <div class="form-input-group">
                    <span class="form-value">{{ auth()->user()->no_wa ?? 'Belum diisi' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>


