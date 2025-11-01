<div class="profile-page">
    {{-- Content --}}
    <div class="profile-content">
        <h1 class="page-title">Pengaturan Profil</h1>

        <form class="profile-form">
            {{-- Nama --}}
            <div class="form-field">
                <label class="form-label" for="name">Nama</label>
                <div class="form-input-group">
                    <input type="text"
                           id="name"
                           wire:model="name"
                           class="form-input"
                           placeholder="Nama Lengkap"
                           readonly>
                    <button type="button"
                            class="btn-edit"
                            disabled
                            style="opacity:0.6; cursor:default;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414
                                  a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Email --}}
            <div class="form-field">
                <label class="form-label" for="email">Email</label>
                <div class="form-input-group">
                    <input type="email"
                           id="email"
                           wire:model="email"
                           class="form-input"
                           readonly>
                </div>
            </div>

            {{-- Nomor HP --}}
            <div class="form-field">
                <label class="form-label" for="no_wa">No HP</label>
                <div class="form-input-group">
                    <input type="tel"
                           id="no_wa"
                           wire:model="no_wa"
                           class="form-input"
                           readonly>
                </div>
            </div>

            {{-- Password --}}
            <div class="form-field">
                <label class="form-label">Password</label>
                <div class="password-field">
                    <button type="button" class="btn-reset-password">
                        <span class="btn-reset-password-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H7v-4l1.743-1.743A6 6 0 0121 9z" />
                            </svg>
                        </span>
                        Reset Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
