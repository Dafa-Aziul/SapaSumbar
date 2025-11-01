# 📁 Struktur File Website LangsungTindak

Dokumentasi struktur file untuk memudahkan navigasi dan pemahaman proyek.

## 🗂️ Struktur Folder Utama

```
SapaSumbar/
├── app/
│   └── Livewire/
│       └── Components/
│           ├── Navbar.php                    # Komponen Livewire Navbar
│           ├── SidebarLeft.php               # Komponen Livewire Left Sidebar
│           └── SidebarRight.php              # Komponen Livewire Right Sidebar
│
├── resources/
│   ├── css/
│   │   └── app.css                          # Stylesheet utama (Tailwind CSS)
│   │
│   ├── js/
│   │   └── app.js                           # JavaScript utama
│   │
│   └── views/
│       ├── layouts/
│       │   └── main.blade.php               # Layout utama untuk semua halaman
│       │
│       ├── livewire/
│       │   └── components/
│       │       ├── navbar.blade.php         # View komponen Navbar Livewire
│       │       ├── sidebar-left.blade.php   # View komponen Left Sidebar Livewire
│       │       └── sidebar-right.blade.php  # View komponen Right Sidebar Livewire
│       │
│       └── pages/
│           ├── home.blade.php               # Halaman Beranda
│           ├── pengaduan-saya.blade.php     # Halaman Pengaduan Saya
│           ├── notifikasi.blade.php         # Halaman Notifikasi
│           ├── maps.blade.php               # Halaman Maps
│           └── profile.blade.php            # Halaman Profile
│
└── routes/
    └── web.php                              # Route aplikasi web
```

## 📄 Penjelasan File

### **Komponen Livewire**

#### `app/Livewire/Components/Navbar.php`
- **Fungsi**: Class komponen Livewire untuk navbar
- **Properties**:
  - `$searchQuery`: Menyimpan query pencarian
  - `$showMobileMenu`: State untuk toggle menu mobile
  - `$showMobileSearch`: State untuk toggle search mobile

#### `app/Livewire/Components/SidebarLeft.php`
- **Fungsi**: Class komponen Livewire untuk left sidebar
- **Properties**:
  - `$activeCategory`: Kategori yang sedang aktif
  - `$showMobileSidebar`: State untuk toggle sidebar mobile
  - `$categories`: Array kategori menu
  - `$statistics`: Array data statistik
- **Methods**:
  - `selectCategory()`: Mengubah kategori aktif
  - `toggleMobileSidebar()`: Toggle sidebar di mobile

#### `app/Livewire/Components/SidebarRight.php`
- **Fungsi**: Class komponen Livewire untuk right sidebar
- **Properties**:
  - `$showFilterDropdown`: State untuk toggle dropdown filter
  - `$filterStatus`: Array status filter (diproses, selesai)
  - `$sortBy`: Pilihan sorting (terbaru, terpopuler)
- **Methods**:
  - `toggleFilterDropdown()`: Toggle dropdown filter
  - `toggleFilterStatus()`: Toggle status filter
  - `setSortBy()`: Set opsi sorting
  - `createReport()`: Handler tombol buat pengaduan

### **Views**

#### `resources/views/layouts/main.blade.php`
- **Fungsi**: Layout utama yang digunakan semua halaman
- **Fitur**:
  - Include Livewire styles & scripts
  - Include Navbar component
  - Yield untuk content halaman
  - Meta tags & fonts (Inter/Roboto)

#### `resources/views/livewire/components/navbar.blade.php`
- **Fungsi**: Template view untuk komponen navbar
- **Fitur**:
  - Area Branding (Logo + Text)
  - Search Bar (responsive)
  - Menu Navigasi (5 menu items)
  - Responsive design (Desktop/Tablet/Mobile)

#### `resources/views/livewire/components/sidebar-left.blade.php`
- **Fungsi**: Template view untuk komponen left sidebar
- **Fitur**:
  - Section Kategori dengan 4 menu items
  - Section Statistik dengan 3 statistik items
  - Responsive design (Desktop/Tablet/Mobile)
  - Mobile overlay & slide-in sidebar

#### `resources/views/livewire/components/sidebar-right.blade.php`
- **Fungsi**: Template view untuk komponen right sidebar
- **Fitur**:
  - Primary Button "Buat Pengaduan"
  - Dropdown Filter "Terapkan Filter"
  - Filter Status (Diproses, Selesai)
  - Sort Options (Terbaru, Terpopuler)
  - Responsive design (Desktop only)

#### `resources/views/pages/*.blade.php`
- **Fungsi**: Halaman-halaman aplikasi
- **Halaman yang tersedia**:
  - `home.blade.php`: Halaman beranda
  - `pengaduan-saya.blade.php`: Halaman daftar pengaduan
  - `notifikasi.blade.php`: Halaman notifikasi
  - `maps.blade.php`: Halaman peta pengaduan
  - `profile.blade.php`: Halaman profil user

### **Routes**

#### `routes/web.php`
- **Fungsi**: Definisi route aplikasi
- **Routes yang tersedia**:
  - `/` → Halaman Home
  - `/pengaduan-saya` → Halaman Pengaduan Saya
  - `/notifikasi` → Halaman Notifikasi
  - `/maps` → Halaman Maps
  - `/profile` → Halaman Profile

## 🎨 Spesifikasi Navbar

### **Desktop (≥1024px)**
- Full layout dengan search bar di tengah (320px)
- Menu dengan ikon + label vertikal
- 5 menu items: Home, Pengaduan Saya, Notifikasi, Maps, Profile

### **Tablet (768px - 1023px)**
- Search bar mengecil menjadi 240px
- Menu menjadi ikon saja (tanpa label)
- Layout tetap horizontal

### **Mobile (<768px)**
- Search bar disembunyikan (dapat diakses via icon)
- Menu menjadi hamburger menu
- Layout vertikal dalam dropdown

## 🔧 Teknologi yang Digunakan

- **Laravel 12**: Framework PHP
- **Livewire 3**: Full-stack framework untuk Laravel
- **Tailwind CSS 4**: Utility-first CSS framework
- **Vite**: Build tool untuk assets

## 📝 Cara Menambah Halaman Baru

1. Buat file baru di `resources/views/pages/nama-halaman.blade.php`
2. Extend layout main: `@extends('layouts.main')`
3. Definisikan section content dengan `@section('content')`
4. Tambahkan route di `routes/web.php`
5. Update menu di navbar jika diperlukan

## 🎯 Cara Menambah Menu Baru di Navbar

Edit file `resources/views/livewire/components/navbar.blade.php`:

1. **Desktop Menu**: Tambahkan item baru di section "Area Kanan (Menu Navigasi) - Desktop"
2. **Tablet Menu**: Tambahkan item baru di section "Tablet: Menu Icons Only"
3. **Mobile Menu**: Tambahkan item baru di section "Mobile Menu Dropdown"

## 🚀 Cara Menjalankan

```bash
# Install dependencies
composer install
npm install

# Build assets
npm run dev
# atau untuk production
npm run build

# Jalankan server
php artisan serve
```

## 📦 Dependencies

- `livewire/livewire`: ^3.6
- `laravel/framework`: ^12.0
- `tailwindcss`: ^4.0.0

