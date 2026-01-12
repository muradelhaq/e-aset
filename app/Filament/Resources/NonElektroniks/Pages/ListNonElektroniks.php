<?php

namespace App\Filament\Resources\NonElektroniks\Pages;

use App\Filament\Resources\NonElektroniks\NonElektronikResource;
use App\Filament\Exports\NonElektronikExporter;
use App\Filament\Imports\NonElektronikImporter;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;


class ListNonElektroniks extends ListRecords
{
    protected static string $resource = NonElektronikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ImportAction::make()
                ->importer(NonElektronikImporter::class)
                ->label('Impor Kendaraan')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info'), // Warna biru muda agar beda dengan tombol buat

            // Aksi Export
            Actions\ExportAction::make()
                ->exporter(NonElektronikExporter::class)
                ->label('Ekspor Data')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('success'), // Warna hijau

            Actions\CreateAction::make()
                ->label('Tambah Non Elektronik'),
        ];
    }
}
