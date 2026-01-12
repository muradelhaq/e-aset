<?php

namespace App\Filament\Resources\Elektroniks\Pages;

use App\Filament\Resources\Elektroniks\ElektronikResource;
use App\Filament\Exports\ElektronikExporter;
use App\Filament\Imports\ElektronikImporter;
use Filament\Actions\ImportAction;
use Filament\Actions\ExportAction;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListElektroniks extends ListRecords
{
    protected static string $resource = ElektronikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->importer(ElektronikImporter::class)
                ->label('Impor Kendaraan')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info'), // Warna biru muda agar beda dengan tombol buat

            // Aksi Export
            ExportAction::make()
                ->exporter(ElektronikExporter::class)
                ->label('Ekspor Data')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('success'), // Warna hijau

            CreateAction::make()
                ->label('Tambah Elektronik'),
        ];
    }
}
