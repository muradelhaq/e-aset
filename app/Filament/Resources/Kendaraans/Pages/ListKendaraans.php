<?php

namespace App\Filament\Resources\Kendaraans\Pages;

use App\Filament\Resources\Kendaraans\KendaraanResource;
use App\Filament\Exports\KendaraanExporter;
use App\Filament\Imports\KendaraanImporter;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListKendaraans extends ListRecords
{
    protected static string $resource = KendaraanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Aksi Import
            Actions\ImportAction::make()
                ->importer(KendaraanImporter::class)
                ->label('Impor Kendaraan')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info'), // Warna biru muda agar beda dengan tombol buat

            // Aksi Export
            Actions\ExportAction::make()
                ->exporter(KendaraanExporter::class)
                ->label('Ekspor Data')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('success'), // Warna hijau

            Actions\CreateAction::make()
                ->label('Tambah Kendaraan'),
        ];
    }
}
