<?php

namespace App\Filament\Resources\NonElektroniks\Pages;

use App\Filament\Resources\NonElektroniks\NonElektronikResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewNonElektronik extends ViewRecord
{
    protected static string $resource = NonElektronikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
