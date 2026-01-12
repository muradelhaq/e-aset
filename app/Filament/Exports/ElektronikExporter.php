<?php

namespace App\Filament\Exports;

use App\Models\Elektronik;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ElektronikExporter extends Exporter
{
    protected static ?string $model = Elektronik::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('jenis_barang'),
            ExportColumn::make('merk'),
            ExportColumn::make('tipe'),
            ExportColumn::make('warna'),
            ExportColumn::make('spek'),
            ExportColumn::make('no_seri'),
            ExportColumn::make('tgl_perolehan'),
            ExportColumn::make('harga'),
            ExportColumn::make('kondisi'),
            ExportColumn::make('pemilik'),
            ExportColumn::make('keterangan'),
            ExportColumn::make('foto'),
            ExportColumn::make('no_sk'),
            ExportColumn::make('upload_SK'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('deleted_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your elektronik export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
