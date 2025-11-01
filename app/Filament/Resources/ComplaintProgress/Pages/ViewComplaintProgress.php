<?php

namespace App\Filament\Resources\ComplaintProgress\Pages;

use App\Filament\Resources\ComplaintProgress\ComplaintProgressResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewComplaintProgress extends ViewRecord
{
    protected static string $resource = ComplaintProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
