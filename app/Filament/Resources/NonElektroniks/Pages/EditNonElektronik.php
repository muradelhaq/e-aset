<?php

namespace App\Filament\Resources\NonElektroniks\Pages;

use App\Filament\Resources\NonElektroniks\NonElektronikResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditNonElektronik extends EditRecord
{
    protected static string $resource = NonElektronikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
