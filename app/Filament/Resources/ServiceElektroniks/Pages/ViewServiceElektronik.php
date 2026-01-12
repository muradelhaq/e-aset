<?php

namespace App\Filament\Resources\ServiceElektroniks\Pages;

use App\Filament\Resources\ServiceElektroniks\ServiceElektronikResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewServiceElektronik extends ViewRecord
{
    protected static string $resource = ServiceElektronikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
