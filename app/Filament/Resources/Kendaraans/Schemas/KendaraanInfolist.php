<?php

namespace App\Filament\Resources\Kendaraans\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Support\Facades\Storage;

class KendaraanInfolist
{
    public static function configure(Schema $schema): Schema
{
        return $schema
            ->components([

                // SECTION 1: IDENTITAS
                Section::make('Informasi Dasar')
                    ->icon('heroicon-o-identification')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('nopol')
                                    ->label('Nomor Polisi')
                                    ->weight('bold')
                                    ->copyable() // User bisa klik untuk salin nopol
                                    ->color('primary'),

                                TextEntry::make('jenis')
                                    ->label('Kategori')
                                    ->badge() // Mengubah menjadi badge agar lebih visual
                                    ->color(fn (string $state): string => match ($state) {
                                        'Mobil' => 'info',
                                        'Motor' => 'warning',
                                        'Truck' => 'danger',
                                        'Bus' => 'success',
                                        default => 'gray',
                                    }),

                                TextEntry::make('jenis_kendaraan')
                                    ->label('Jenis Spesifik'),
                            ]),

                        Grid::make(3)
                            ->schema([
                                TextEntry::make('merk')->label('Merk'),
                                TextEntry::make('tipe')->label('Tipe'),
                                TextEntry::make('warna')->label('Warna'),
                            ]),
                    ])
                    ->columnSpanFull(),

                // SECTION 2: TEKNIS
                Section::make('Spesifikasi Teknis')
                    ->icon('heroicon-o-wrench-screwdriver')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('tahun_pembuatan')->label('Tahun Pembuatan'),
                        TextEntry::make('isi_silinder')
                            ->label('Isi Silinder')
                            ->suffix(' CC'), // Menambahkan satuan CC
                        TextEntry::make('no_rangka')->label('Nomor Rangka'),
                        TextEntry::make('no_mesin')->label('Nomor Mesin'),
                        TextEntry::make('no_bpkb')->label('Nomor BPKB'),
                    ])->columns(2)->columnSpanFull(),

                // SECTION 3: LEGAL & FINANSIAL
                Section::make('Informasi Legal & Finansial')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        TextEntry::make('tgl_pajak')
                            ->label('Jatuh Tempo Pajak')
                            ->date('d F Y'), // Format tanggal lebih manusiawi
                        TextEntry::make('tgl_perolehan')
                            ->label('Tanggal Perolehan')
                            ->date('d F Y'),
                        TextEntry::make('harga')
                            ->label('Nilai Aset')
                            ->money('IDR'),
                        TextEntry::make('pemilik')->label('Nama Pemilik/Pemakai'),
                        TextEntry::make('no_SK')->label('Nomor SK Penggunaan'),
                    ])->columns(2)->columnSpanFull(),

                // SECTION 4: MEDIA & CATATAN
                Section::make('Media & Keterangan')
                    ->icon('heroicon-o-camera')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                ImageEntry::make('foto')
                                ->url(fn ($state) => $state
                                    ? Storage::disk('public')->url($state)
                                    : null
                                )
                                ->openUrlInNewTab()
                                ->label('Foto Kendaraan')
                                ->disk('public'),

                                Grid::make(1)
                                    ->schema([
                                        TextEntry::make('upload_SK')
                                            ->label('Dokumen SK')
                                            ->formatStateUsing(fn ($state) => $state ? 'Lihat/Unduh File PDF' : 'Tidak Ada Dokumen')
                                            ->icon('heroicon-o-document-text')
                                            ->color('primary')
                                            ->url(fn ($state) => $state ? Storage::disk('public')->url($state) : null)
                                            ->openUrlInNewTab(),

                                        TextEntry::make('keterangan')
                                            ->label('Catatan Keterangan')
                                            ->markdown() // Mendukung format teks jika ada bold/italic
                                            ->placeholder('Tidak ada catatan tambahan.'),
                                    ]),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
