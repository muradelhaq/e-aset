<?php

namespace App\Filament\Resources\Elektroniks\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Support\Facades\Storage;

class ElektronikInfolist
{
    public static function configure(Schema $schema): Schema
{
        return $schema
            ->components([

                // SECTION 1: SPESIFIKASI BARANG
                Section::make('Informasi Dasar & Spesifikasi')
                    ->icon('heroicon-o-cpu-chip')
                    ->description('Detail teknis dan identitas perangkat elektronik.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('jenis_barang')
                                    ->label('Jenis Barang')
                                    ->weight('bold')
                                    ->color('primary'),

                                TextEntry::make('no_seri')
                                    ->label('Nomor Seri (S/N)')
                                    ->icon('heroicon-m-qr-code')
                                    ->copyable() // Sangat berguna untuk aset IT
                                    ->placeholder('Tidak ada S/N'),

                                TextEntry::make('merk')
                                    ->label('Merk/Brand'),
                            ]),

                        Grid::make(3)
                            ->schema([
                                TextEntry::make('tipe')->label('Tipe Model'),
                                TextEntry::make('warna')->label('Warna'),
                                TextEntry::make('pemilik')->label('Penanggung Jawab'),
                            ]),

                        TextEntry::make('spek')
                            ->label('Spesifikasi Lengkap')
                            ->markdown()
                            ->prose() // Membuat tampilan teks panjang lebih rapi
                            ->placeholder('Spesifikasi belum diisi')
                            ->columnSpanFull(),
                    ])->columnSpanFull(),

                // SECTION 2: STATUS & NILAI
                Section::make('Finansial & Kondisi')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        TextEntry::make('tgl_perolehan')
                            ->label('Tanggal Perolehan')
                            ->date('d F Y'),

                        TextEntry::make('harga')
                            ->label('Harga Perolehan')
                            ->money('IDR'),

                        TextEntry::make('kondisi')
                            ->label('Kondisi Saat Ini')
                            ->badge() // Menggunakan badge berwarna
                            ->color(fn (string $state): string => match ($state) {
                                'Baik' => 'success',
                                'Rusak Ringan' => 'warning',
                                'Rusak Berat', 'Tidak Berfungsi' => 'danger',
                                'Dalam Perbaikan' => 'info',
                                'Hilang' => 'gray',
                                default => 'gray',
                            }),
                    ])->columns(3)->columnSpanFull(),

                // SECTION 3: DOKUMEN & MEDIA
                Section::make('Dokumen & Media')
                    ->icon('heroicon-o-document-magnifying-glass')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                ImageEntry::make('foto')
                                    ->url(fn ($state) => $state
                                        ? Storage::disk('public')->url($state)
                                        : null
                                    )
                                    ->openUrlInNewTab()
                                    ->label('Foto Elektronik')
                                    ->disk('public'),

                                Grid::make(1)
                                    ->schema([
                                        TextEntry::make('no_sk')
                                            ->label('Nomor SK/Dokumen')
                                            ->icon('heroicon-o-hashtag'),

                                        TextEntry::make('upload_SK')
                                            ->label('File SK Pendukung')
                                            ->formatStateUsing(fn ($state) => $state ? 'Download / Lihat Dokumen PDF' : '-')
                                            ->icon('heroicon-o-arrow-down-tray')
                                            ->color('primary')
                                            ->url(fn ($state) => $state ? Storage::disk('public')->url($state) : null)
                                            ->openUrlInNewTab(),

                                        TextEntry::make('keterangan')
                                            ->label('Catatan Keterangan')
                                            ->placeholder('Tidak ada catatan.'),
                                    ]),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
