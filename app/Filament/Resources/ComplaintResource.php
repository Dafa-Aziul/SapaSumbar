<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Complaint;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\ComplaintResource\Pages;
use App\Filament\Resources\ComplaintResource\Pages\EditComplaint;
use App\Filament\Resources\ComplaintResource\Pages\ViewComplaint;
use App\Filament\Resources\ComplaintResource\Pages\ListComplaints;
use App\Filament\Resources\ComplaintResource\Pages\CreateComplaint;
use App\Filament\Resources\ComplaintResource\RelationManagers\ProgressRelationManager;


class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Complaints';
    protected static \UnitEnum|string|null $navigationGroup = 'Laporan Pengaduan';

    // 📋 Tabel Complaint
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

                ImageColumn::make('lampiran')
                    ->label('Lampiran')
                    ->getStateUsing(
                        fn($record) =>
                        $record->media->map(fn($m) => asset( 'storage/'.$m->file_url))->toArray()
                    )
                    ->limit(3)
                    ->stacked()
                    ->circular(),



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
                EditAction::make()
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
                DeleteAction::make(),
                ViewAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([]);
    }

    public static function getRelations(): array
    {
        return [
            ProgressRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComplaints::route('/'),
            'view' => Pages\ViewComplaint::route('/{record}'),
            'edit' => Pages\EditComplaint::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')->label('ID'),
                TextEntry::make('user.name')->label('Pelapor'),
                TextEntry::make('category.name')->label('Kategori'),
                TextEntry::make('content')->label('Deskripsi'),

                ImageEntry::make('lampiran')
                    ->label('Lampiran')
                    ->getStateUsing(
                        fn($record) =>
                        $record->media->map(fn($m) => asset( 'storage/'.$m->file_url))->toArray()
                    )
                    ->hidden(fn($record) => $record->media->isEmpty())
                    ->columnSpanFull()
                    ->limit(3)
                    ->circular(),


                TextEntry::make('status')->columnSpanFull(),
            ]);
    }
}
