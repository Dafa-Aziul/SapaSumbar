<?php

namespace App\Filament\Resources\ComplaintProgress\Pages;

use App\Filament\Resources\ComplaintProgress\ComplaintProgressResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListComplaintProgress extends ListRecords
{
    protected static string $resource = ComplaintProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
