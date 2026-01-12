<?php

namespace App\Filament\Resources\ServiceElektroniks\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class ServiceElektronikInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Service')
                    ->schema([
                        TextEntry::make('elektronik')
                            ->label('Barang Elektronik')
                            ->formatStateUsing(function ($state, $record) {
                                if (! $record || ! $record->elektronik) {
                                    return '-';
                                }
                                $e = $record->elektronik;
                                return "{$e->jenis_barang} — {$e->merk} ({$e->pemilik})";
                            })
                            ->icon('heroicon-o-computer-desktop') // ganti ke icon yang tersedia
                            ->color('primary')
                            ->columnSpanFull(),

                        TextEntry::make('tanggal_service')
                            ->label('Tanggal Service')
                            ->date()
                            ->placeholder('-'),

                        TextEntry::make('deskripsi')
                            ->label('Deskripsi')
                            ->placeholder('-')
                            ->columnSpanFull(),

                        TextEntry::make('biaya')
                            ->label('Biaya')
                            ->color('success')
                            ->weight('bold')
                            ->money('IDR')
                            ->html(), // render HTML agar warna berlaku


                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
