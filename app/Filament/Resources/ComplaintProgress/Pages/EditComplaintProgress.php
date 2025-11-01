<?php

namespace App\Filament\Resources\ComplaintProgress\Pages;

use App\Filament\Resources\ComplaintProgress\ComplaintProgressResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditComplaintProgress extends EditRecord
{
    protected static string $resource = ComplaintProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
