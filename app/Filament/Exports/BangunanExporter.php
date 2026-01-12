<?php

namespace App\Filament\Exports;

use App\Models\Bangunan;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class BangunanExporter extends Exporter
{
    protected static ?string $model = Bangunan::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('kode_lokasi'),
            ExportColumn::make('jenis_bangunan'),
            ExportColumn::make('kode_bangunan'),
            ExportColumn::make('register'),
            ExportColumn::make('kondisi_bangunan'),
            ExportColumn::make('bertingkat'),
            ExportColumn::make('beton'),
            ExportColumn::make('luas_lantai'),
            ExportColumn::make('letak_alamat'),
            ExportColumn::make('tanggal'),
            ExportColumn::make('nomor'),
            ExportColumn::make('luas'),
            ExportColumn::make('status_tanah'),
            ExportColumn::make('nomor_kode_tanah'),
            ExportColumn::make('asal_usul'),
            ExportColumn::make('harga'),
            ExportColumn::make('ket'),
            ExportColumn::make('foto'),
            ExportColumn::make('pengurus_user'),
            ExportColumn::make('deleted_at'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your bangunan export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
