<?php

namespace App\Filament\Resources\Tanahs\Pages;

use App\Filament\Resources\Tanahs\TanahResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTanah extends ViewRecord
{
    protected static string $resource = TanahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
