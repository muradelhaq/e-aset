<?php

namespace App\Filament\Resources\Elektroniks\Pages;

use App\Filament\Resources\Elektroniks\ElektronikResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewElektronik extends ViewRecord
{
    protected static string $resource = ElektronikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
