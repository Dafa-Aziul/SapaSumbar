<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplaintResource\Pages;
use App\Models\Complaint;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms;
use Filament\Forms\Components\Select;

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Complaints';
    protected static \UnitEnum|string|null $navigationGroup = 'Laporan Pengaduan';

    // \U0001f4cb Table tampilan Complaints
    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Pelapor')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable(),

                TextColumn::make('content')
                    ->label('Deskripsi')
                    ->limit(50),

                // \U0001f5bc\ufe0f Tampilkan gambar pertama dari tabel complaint_media
                ImageColumn::make('media.file_url')
                    ->label('Lampiran')
                    ->circular()
                    ->limit(1),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'in_progress',
                        'success' => 'resolved',
                    ])
                    ->formatStateUsing(fn($state) => match ($state) {
                        'pending' => 'Menunggu',
                        'in_progress' => 'Diproses',
                        'resolved' => 'Selesai',
                        default => $state,
                    })
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i'),
            ])
            ->filters([])
            ->actions([
                // \u270f\ufe0f Hanya bisa edit status
                \Filament\Actions\EditAction::make()
                    ->label('Ubah Status')
                    ->form([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Menunggu',
                                'in_progress' => 'Diproses',
                                'resolved' => 'Selesai',
                            ])
                            ->required(),
                    ]),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }

    // \U0001f6ab Hilangkan form create (admin tidak buat aduan)
    public static function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema->schema([]);
    }

    // \U0001f517 Tidak perlu relation manager di halaman ini
    public static function getRelations(): array
    {
        return [];
    }

    // \U0001f9ed Halaman
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComplaints::route('/'),
            'edit' => Pages\EditComplaint::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
