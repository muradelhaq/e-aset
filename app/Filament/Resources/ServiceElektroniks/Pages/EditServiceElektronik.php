<?php

namespace App\Filament\Resources\ServiceElektroniks\Pages;

use App\Filament\Resources\ServiceElektroniks\ServiceElektronikResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceElektronik extends EditRecord
{
    protected static string $resource = ServiceElektronikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
