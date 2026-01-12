<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Models\Service;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->components([
            Section::make('Informasi Service')
                ->columnSpanFull() // Ingat: v4 butuh 2 argumen di make()
                ->schema([

                    // Untuk menampilkan relasi kendaraan
                    TextEntry::make('kendaraan.jenis', 'Kendaraan')
                        ->icon('heroicon-m-truck')
                        ->formatStateUsing(function ($state, $record) {
                                if (! $record || ! $record->kendaraan) {
                                    return '-';
                                }
                                $k = $record->kendaraan;
                                return "{$k->jenis} — {$k->merk} ({$k->pemilik})";
                            })
                        ->color('primary'),

                    TextEntry::make('kendaraan.nopol', 'Nomor Polisi')
                        ->copyable()
                        ->color('danger'), // User bisa klik untuk copy nopol

                    TextEntry::make('tanggal_service', 'Tanggal Service')
                        ->date('d F Y'), // Format tanggal lebih manusiawi

                    TextEntry::make('deskripsi', 'Deskripsi Service')
                        ->prose(), // Agar tampilan teks panjang lebih rapi

                    TextEntry::make('biaya', 'Biaya Service')
                        ->money('IDR') // Otomatis format Rp dan desimal
                        ->weight('bold')
                        ->color('success'),
                ])
                ->columns(2), // Membuat layout 2 kolom agar lebih rapi
        ]);

    }
}
