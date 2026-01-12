<?php

namespace App\Filament\Imports;

use App\Models\NonElektronik;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class NonElektronikImporter extends Importer
{
    protected static ?string $model = NonElektronik::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('jenis_barang')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('nama_barang')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('bahan')
                ->rules(['max:255']),
            ImportColumn::make('warna')
                ->rules(['max:255']),
            ImportColumn::make('ukuran')
                ->rules(['max:255']),
            ImportColumn::make('jumlah')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('merk')
                ->rules(['max:255']),
            ImportColumn::make('tgl_perolehan')
                ->rules(['date']),
            ImportColumn::make('harga')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('kondisi')
                ->rules(['max:255']),
            ImportColumn::make('pemilik')
                ->rules(['max:255']),
            ImportColumn::make('keterangan'),
            ImportColumn::make('foto')
                ->rules(['max:255']),
            ImportColumn::make('no_sk')
                ->rules(['max:255']),
            ImportColumn::make('upload_sk')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): NonElektronik
    {
        return NonElektronik::firstOrNew([
            'id' => $this->data['id'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your non elektronik import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
