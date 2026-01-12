<?php

namespace App\Filament\Resources\ServiceElektroniks\Pages;

use App\Filament\Resources\ServiceElektroniks\ServiceElektronikResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServiceElektroniks extends ListRecords
{
    protected static string $resource = ServiceElektronikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
