<?php

namespace App\Filament\Imports;

use App\Models\Kendaraan;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class KendaraanImporter extends Importer
{
    protected static ?string $model = Kendaraan::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nopol')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('jenis_kendaraan')
                ->rules(['max:255']),
            ImportColumn::make('jenis')
                ->rules(['max:255']),
            ImportColumn::make('merk')
                ->rules(['max:255']),
            ImportColumn::make('tipe')
                ->rules(['max:255']),
            ImportColumn::make('warna')
                ->rules(['max:255']),
            ImportColumn::make('tahun_pembuatan')
                ->rules(['max:255']),
            ImportColumn::make('isi_silinder')
                ->rules(['max:255']),
            ImportColumn::make('no_rangka')
                ->rules(['max:255']),
            ImportColumn::make('no_bpkb')
                ->rules(['max:255']),
            ImportColumn::make('no_mesin')
                ->rules(['max:255']),
            ImportColumn::make('tgl_pajak')
                ->rules(['date']),
            ImportColumn::make('tgl_perolehan')
                ->rules(['date']),
            ImportColumn::make('harga')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('pemilik')
                ->rules(['max:255']),
            ImportColumn::make('nip')
                ->rules(['max:255']),
            ImportColumn::make('alamat')
                ->rules(['max:255']),
            ImportColumn::make('jabatan')
                ->rules(['max:255']),
            ImportColumn::make('no_SK')
                ->rules(['max:255']),
            ImportColumn::make('upload_SK')
                ->rules(['max:255']),
            ImportColumn::make('keterangan')
                ->rules(['max:255']),
            ImportColumn::make('foto')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): Kendaraan
    {
        return Kendaraan::firstOrNew([
            'id' => $this->data['id'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your kendaraan import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
