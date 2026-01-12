<?php

namespace App\Filament\Resources\Tanahs\Schemas;

use App\Models\Tanah;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TanahInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kode_lokasi')
                    ->placeholder('-'),
                TextEntry::make('jenis_barang')
                    ->placeholder('-'),
                TextEntry::make('kode_barang')
                    ->placeholder('-'),
                TextEntry::make('register')
                    ->placeholder('-'),
                TextEntry::make('luas')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('alamat')
                    ->placeholder('-'),
                TextEntry::make('status_tanah')
                    ->placeholder('-'),
                TextEntry::make('sertifikat')
                    ->placeholder('-'),
                TextEntry::make('nomor_sertifikat')
                    ->placeholder('-'),
                TextEntry::make('penggunaan')
                    ->placeholder('-'),
                TextEntry::make('asal_usul')
                    ->placeholder('-'),
                TextEntry::make('harga')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('tanggal_perolehan')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('pemilik')
                    ->placeholder('-'),
                TextEntry::make('keterangan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('foto')
                    ->placeholder('-'),
                TextEntry::make('no_sk')
                    ->placeholder('-'),
                TextEntry::make('upload_SK')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Tanah $record): bool => $record->trashed()),
            ]);
    }
}
