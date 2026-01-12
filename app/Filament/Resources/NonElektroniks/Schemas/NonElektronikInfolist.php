<?php

namespace App\Filament\Resources\NonElektroniks\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Illuminate\Support\Facades\Storage;

class NonElektronikInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /* ================= SECTION 1 ================= */
                Section::make('Informasi Dasar Barang')
                    ->icon('heroicon-o-archive-box')
                    ->description('Identitas dan karakteristik barang non elektronik.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('jenis_barang')
                                    ->label('Jenis Barang')
                                    ->weight('bold')
                                    ->color('primary'),

                                TextEntry::make('nama_barang')
                                    ->label('Nama Barang'),

                                TextEntry::make('merk')
                                    ->label('Merk / Brand')
                                    ->placeholder('-'),
                            ]),

                        Grid::make(3)
                            ->schema([
                                TextEntry::make('bahan')
                                    ->label('Bahan')
                                    ->placeholder('-'),

                                TextEntry::make('warna')
                                    ->label('Warna')
                                    ->placeholder('-'),

                                TextEntry::make('ukuran')
                                    ->label('Ukuran / Dimensi')
                                    ->placeholder('-'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextEntry::make('jumlah')
                                    ->label('Jumlah')
                                    ->suffix(' Unit'),

                                TextEntry::make('pemilik')
                                    ->label('Penanggung Jawab')
                                    ->placeholder('-'),
                            ]),
                    ])
                    ->columnSpanFull(),

                /* ================= SECTION 2 ================= */
                Section::make('Perolehan & Kondisi')
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
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Baik' => 'success',
                                'Rusak Ringan' => 'warning',
                                'Rusak Berat', 'Tidak Layak Pakai' => 'danger',
                                'Hilang' => 'gray',
                                default => 'gray',
                            }),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                /* ================= SECTION 3 ================= */
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
                                    ->label('Foto Barang')
                                    ->disk('public'),

                                Grid::make(1)
                                    ->schema([
                                        TextEntry::make('no_sk')
                                            ->label('Nomor SK / Dokumen')
                                            ->icon('heroicon-o-hashtag')
                                            ->placeholder('-'),

                                        TextEntry::make('upload_sk')
                                            ->label('File SK Pendukung')
                                            ->formatStateUsing(fn ($state) => $state
                                                ? 'Download / Lihat Dokumen PDF'
                                                : '-'
                                            )
                                            ->icon('heroicon-o-arrow-down-tray')
                                            ->color('primary')
                                            ->url(fn ($state) => $state
                                                ? Storage::disk('public')->url($state)
                                                : null
                                            )
                                            ->openUrlInNewTab(),

                                        TextEntry::make('keterangan')
                                            ->label('Catatan Keterangan')
                                            ->placeholder('Tidak ada catatan.'),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
