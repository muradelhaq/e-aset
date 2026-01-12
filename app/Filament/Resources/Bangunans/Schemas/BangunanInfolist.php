<?php

namespace App\Filament\Resources\Bangunans\Schemas;

use App\Models\Bangunan;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BangunanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kode_lokasi')
                    ->placeholder('-'),
                TextEntry::make('jenis_bangunan')
                    ->placeholder('-'),
                TextEntry::make('kode_bangunan')
                    ->placeholder('-'),
                TextEntry::make('register')
                    ->placeholder('-'),
                TextEntry::make('kondisi_bangunan')
                    ->placeholder('-'),
                TextEntry::make('bertingkat')
                    ->placeholder('-'),
                TextEntry::make('beton')
                    ->placeholder('-'),
                TextEntry::make('luas_lantai')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('letak_alamat')
                    ->placeholder('-'),
                TextEntry::make('tanggal')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('nomor')
                    ->placeholder('-'),
                TextEntry::make('luas')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('status_tanah')
                    ->placeholder('-'),
                TextEntry::make('nomor_kode_tanah')
                    ->placeholder('-'),
                TextEntry::make('asal_usul')
                    ->placeholder('-'),
                TextEntry::make('harga')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('ket')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('foto')
                    ->placeholder('-'),
                TextEntry::make('pengurus_user')
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Bangunan $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
