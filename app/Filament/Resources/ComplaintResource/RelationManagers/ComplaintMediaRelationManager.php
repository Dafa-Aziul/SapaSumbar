<?php

namespace App\Filament\Resources\ComplaintResource\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ComplaintMediaRelationManager extends RelationManager
{
    protected static string $relationship = 'media'; // relasi di model Complaint

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            FileUpload::make('file_url')
                ->label('Lampiran (Gambar/Video)')
                ->directory('complaints/media')
                ->preserveFilenames()
                ->multiple()
                ->maxSize(2048)
                ->enableOpen()
                ->enableDownload(),
        ]);
    }

    public function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                ImageColumn::make('file_url')->label('Preview'),
                TextColumn::make('file_type')->label('Tipe File'),
                TextColumn::make('created_at')->label('Diupload')->dateTime(),
            ])
            ->headerActions([
                \Filament\Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }
}
