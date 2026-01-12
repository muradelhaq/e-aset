<?php

namespace App\Filament\Resources\Tanahs\Pages;

use App\Filament\Resources\Tanahs\TanahResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTanahs extends ListRecords
{
    protected static string $resource = TanahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
