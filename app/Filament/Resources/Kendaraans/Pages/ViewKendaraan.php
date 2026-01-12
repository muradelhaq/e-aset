<?php

namespace App\Filament\Resources\Kendaraans\Pages;

use App\Filament\Resources\Kendaraans\KendaraanResource;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKendaraan extends ViewRecord
{
    protected static string $resource = KendaraanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make()
        ];
    }
}
