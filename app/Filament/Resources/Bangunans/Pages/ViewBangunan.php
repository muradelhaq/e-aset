<?php

namespace App\Filament\Resources\Bangunans\Pages;

use App\Filament\Resources\Bangunans\BangunanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBangunan extends ViewRecord
{
    protected static string $resource = BangunanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
