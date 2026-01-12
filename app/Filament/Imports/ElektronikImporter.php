<?php

namespace App\Filament\Imports;

use App\Models\Elektronik;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class ElektronikImporter extends Importer
{
    protected static ?string $model = Elektronik::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('jenis_barang')
                ->rules(['max:255']),
            ImportColumn::make('merk')
                ->rules(['max:255']),
            ImportColumn::make('tipe')
                ->rules(['max:255']),
            ImportColumn::make('warna')
                ->rules(['max:50']),
            ImportColumn::make('spek')
                ->rules(['max:255']),
            ImportColumn::make('no_seri')
                ->rules(['max:100']),
            ImportColumn::make('tgl_perolehan')
                ->rules(['date']),
            ImportColumn::make('harga')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('kondisi')
                ->rules(['max:50']),
            ImportColumn::make('pemilik')
                ->rules(['max:255']),
            ImportColumn::make('keterangan'),
            ImportColumn::make('foto')
                ->rules(['max:255']),
            ImportColumn::make('no_sk')
                ->rules(['max:100']),
            ImportColumn::make('upload_SK')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): Elektronik
    {
        return Elektronik::firstOrNew([
            'id' => $this->data['id'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your elektronik import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
