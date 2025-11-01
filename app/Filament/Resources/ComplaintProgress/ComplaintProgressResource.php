<?php

namespace App\Filament\Resources\ComplaintProgress;

use App\Filament\Resources\ComplaintProgress\Pages\CreateComplaintProgress;
use App\Filament\Resources\ComplaintProgress\Pages\EditComplaintProgress;
use App\Filament\Resources\ComplaintProgress\Pages\ListComplaintProgress;
use App\Filament\Resources\ComplaintProgress\Pages\ViewComplaintProgress;
use App\Filament\Resources\ComplaintProgress\Schemas\ComplaintProgressForm;
use App\Filament\Resources\ComplaintProgress\Schemas\ComplaintProgressInfolist;
use App\Filament\Resources\ComplaintProgress\Tables\ComplaintProgressTable;
use App\Models\ComplaintProgress;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ComplaintProgressResource extends Resource
{
    protected static ?string $model = ComplaintProgress::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Complaint Progress';

    public static function form(Schema $schema): Schema
    {
        return ComplaintProgressForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ComplaintProgressInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ComplaintProgressTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComplaintProgress::route('/'),
            'create' => CreateComplaintProgress::route('/create'),
            'view' => ViewComplaintProgress::route('/{record}'),
            'edit' => EditComplaintProgress::route('/{record}/edit'),
        ];
    }
}
