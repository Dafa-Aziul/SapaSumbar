@extends('layouts.main')

@section('title', 'Pengaduan Saya - Sapa Sumbar')

@section('content')
<div class="container mx-auto px-6 py-8 max-w-7xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#212121] mb-2">Pengaduan Saya</h1>
        <p class="text-[#757575]">Lihat dan kelola semua pengaduan yang telah Anda laporkan</p>
    </div>

    <div class="bg-white border border-[#E0E0E0] rounded-lg p-6">
        <p class="text-[#757575] text-center py-8">Belum ada pengaduan yang dilaporkan</p>
    </div>
</div>
@endsection

