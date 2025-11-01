<?php

namespace App\Filament\Resources\ComplaintResource\RelationManagers;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProgressRelationManager extends RelationManager
{
    protected static string $relationship = 'progress';
    protected static ?string $title = 'Progres Penanganan';

    /**
     * 🧩 Form untuk tambah/edit progres
     */
    public function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
{
    return $schema->schema([
        // 🔹 Dropdown status dari tabel complaints
        Forms\Components\Select::make('status')
            ->label('Status Pengaduan')
            ->options([
                'terkirim' => 'Terkirim',
                'diproses' => 'Diproses',
                'selesai'  => 'Selesai',
            ])
            ->default(fn ($record) => $record?->complaint?->status ?? 'terkirim')
            ->required()
            ->helperText('Pilih status terbaru dari pengaduan ini.'),

        // 🔹 Tahapan progres
        Forms\Components\TextInput::make('status_update')
            ->label('Tahapan')
            ->placeholder('Contoh: Bahan datang, Pemasangan dimulai')
            ->required(),

        // 🔹 Deskripsi tambahan
        Forms\Components\Textarea::make('description')
            ->label('Deskripsi Progres')
            ->rows(3),

        // 🔹 Upload bukti gambar
        Forms\Components\FileUpload::make('media')
            ->label('Upload Bukti (maksimal 3 gambar)')
            ->multiple()
            ->maxFiles(3)
            ->image()
            ->disk('public')
            ->directory('progress/media')
            ->helperText('Unggah hingga 3 foto bukti progres.'),
    ]);
}


    /**
     * 🧱 Tabel untuk menampilkan data progres
     */
    public function table(Table $table): Table
    {
        return $table
            ->columns([
    Tables\Columns\TextColumn::make('status_update')
        ->label('Tahapan') // ⬅️ Ubah label
        ->badge()
        ->colors([
            'primary',
            'warning' => fn($state) => str_contains(strtolower($state), 'bahan'),
            'success' => fn($state) => str_contains(strtolower($state), 'selesai'),
        ])
        ->sortable(),

    Tables\Columns\TextColumn::make('complaint.status')
        ->label('Status')
        ->badge()
        ->colors([
            'gray' => 'terkirim',
            'warning' => 'diproses',
            'success' => 'selesai',
        ])
        ->sortable(),

    Tables\Columns\TextColumn::make('description')
        ->label('Deskripsi')
        ->limit(40),

    Tables\Columns\TextColumn::make('admin.name')
        ->label('Admin'),

    Tables\Columns\ImageColumn::make('media.file_url')
        ->label('Foto Bukti')
        ->square()
        ->stacked()
        ->limit(3),

    Tables\Columns\TextColumn::make('created_at')
        ->label('Tanggal')
        ->since(),
])

            ->headerActions([
    Actions\CreateAction::make()
    ->label('Tambah Progres')
    ->icon('heroicon-o-plus')
    ->visible(fn() => true)
    ->mutateFormDataUsing(function (array $data): array {
        $data['admin_id'] = auth()->id();
        return $data;
    })
   ->before(function (array $data, $livewire, $action) {
    // Ambil complaint aktif dari RelationManager
    $complaint = $livewire->ownerRecord;
    $progressCount = $complaint->progress()->count();

    // Cek: kalau status 'selesai' tapi belum ada progres sebelumnya
    if (($data['status'] ?? null) === 'selesai' && $progressCount < 1) {
        \Filament\Notifications\Notification::make()
            ->title('Gagal Menyimpan Progres')
            ->body('Tidak dapat menandai pengaduan sebagai "Selesai" tanpa progres sebelumnya.')
            ->danger()
            ->send();

        // 🚫 Batalkan aksi create dengan method cancel()
        $action->cancel();

        // Hentikan eksekusi fungsi supaya gak lanjut ke after()
        return;
    }
})


    ->after(function (Model $record, array $data): void {
        // Update status pengaduan utama
        if (isset($data['status'])) {
            $record->complaint->update(['status' => $data['status']]);
        }

        // Simpan media ke tabel progress_media
        if (!empty($data['media'])) {
            foreach ($data['media'] as $path) {
                $record->media()->create([
                    'file_url' => $path,
                    'file_type' => 'image',
                ]);
            }
        }
    })
    ->successNotification(
        \Filament\Notifications\Notification::make()
            ->title('Progres berhasil ditambahkan!')
            ->body('Progres pengaduan telah berhasil disimpan.')
            ->success()
    )
,
])

            ->actions([
                Actions\EditAction::make()
                    ->label('Edit')
                    ->successNotificationTitle('Progres berhasil diperbarui!'),

                Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->successNotificationTitle('Progres berhasil dihapus!'),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
