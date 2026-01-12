<?php

namespace App\Filament\Exports;

use App\Models\Kendaraan;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class KendaraanExporter extends Exporter
{
    protected static ?string $model = Kendaraan::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('nopol'),
            ExportColumn::make('jenis_kendaraan'),
            ExportColumn::make('jenis'),
            ExportColumn::make('merk'),
            ExportColumn::make('tipe'),
            ExportColumn::make('warna'),
            ExportColumn::make('tahun_pembuatan'),
            ExportColumn::make('isi_silinder'),
            ExportColumn::make('no_rangka'),
            ExportColumn::make('no_bpkb'),
            ExportColumn::make('no_mesin'),
            ExportColumn::make('tgl_pajak'),
            ExportColumn::make('tgl_perolehan'),
            ExportColumn::make('harga'),
            ExportColumn::make('pemilik'),
            ExportColumn::make('nip'),
            ExportColumn::make('alamat'),
            ExportColumn::make('jabatan'),
            ExportColumn::make('no_SK'),
            ExportColumn::make('upload_SK'),
            ExportColumn::make('keterangan'),
            ExportColumn::make('foto'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('deleted_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your kendaraan export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
