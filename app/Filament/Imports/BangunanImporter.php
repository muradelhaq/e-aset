<?php

namespace App\Filament\Imports;

use App\Models\Bangunan;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class BangunanImporter extends Importer
{
    protected static ?string $model = Bangunan::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('kode_lokasi')
                ->rules(['max:255']),
            ImportColumn::make('jenis_bangunan')
                ->rules(['max:255']),
            ImportColumn::make('kode_bangunan')
                ->rules(['max:255']),
            ImportColumn::make('register')
                ->rules(['max:255']),
            ImportColumn::make('kondisi_bangunan')
                ->rules(['max:255']),
            ImportColumn::make('bertingkat')
                ->rules(['max:255']),
            ImportColumn::make('beton')
                ->rules(['max:255']),
            ImportColumn::make('luas_lantai')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('letak_alamat')
                ->rules(['max:255']),
            ImportColumn::make('tanggal')
                ->rules(['date']),
            ImportColumn::make('nomor')
                ->rules(['max:255']),
            ImportColumn::make('luas')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('status_tanah')
                ->rules(['max:255']),
            ImportColumn::make('nomor_kode_tanah')
                ->rules(['max:255']),
            ImportColumn::make('asal_usul')
                ->rules(['max:255']),
            ImportColumn::make('harga')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('ket'),
            ImportColumn::make('foto')
                ->rules(['max:255']),
            ImportColumn::make('pengurus_user')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): Bangunan
    {
        return Bangunan::firstOrNew([
            'id' => $this->data['id'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your bangunan import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
