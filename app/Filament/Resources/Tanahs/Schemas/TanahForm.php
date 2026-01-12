<?php

namespace App\Filament\Resources\Tanahs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TanahForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_lokasi'),
                TextInput::make('jenis_barang'),
                TextInput::make('kode_barang'),
                TextInput::make('register'),
                TextInput::make('luas')
                    ->numeric(),
                TextInput::make('alamat'),
                TextInput::make('status_tanah'),
                TextInput::make('sertifikat'),
                TextInput::make('nomor_sertifikat'),
                TextInput::make('penggunaan'),
                TextInput::make('asal_usul'),
                TextInput::make('harga')
                    ->numeric(),
                DatePicker::make('tanggal_perolehan'),
                TextInput::make('pemilik'),
                Textarea::make('keterangan')
                    ->columnSpanFull(),
                TextInput::make('foto'),
                TextInput::make('no_sk'),
                TextInput::make('upload_SK'),
            ]);
    }
}
