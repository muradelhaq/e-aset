<?php

namespace App\Filament\Resources\Bangunans\Pages;

use App\Filament\Resources\Bangunans\BangunanResource;
use App\Filament\Exports\BangunanExporter;
use App\Filament\Imports\BangunanImporter;
use Filament\Actions\ImportAction;
use Filament\Actions\ExportAction;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBangunans extends ListRecords
{
    protected static string $resource = BangunanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->importer(BangunanImporter::class)
                ->label('Impor Bangunan')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info'), // Warna biru muda agar beda dengan tombol buat

            // Aksi Export
            ExportAction::make()
                ->exporter(BangunanExporter::class)
                ->label('Ekspor Banguanan')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('success'), // Warna hijau

            CreateAction::make()
                ->label('Tambah Bangunan')
        ];
    }
}
