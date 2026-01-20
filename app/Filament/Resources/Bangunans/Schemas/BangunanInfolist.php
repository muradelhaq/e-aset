<?php

namespace App\Filament\Resources\Bangunans\Schemas;

use App\Models\Bangunan;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class BangunanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(1)
                    ->schema([

                        // SECTION 1: IDENTITAS UTAMA
                        Section::make('Identitas Bangunan')
                            ->description('Informasi dasar mengenai kode dan jenis bangunan.')
                            ->icon('heroicon-o-identification')
                            ->schema([
                                TextEntry::make('kode_lokasi')->label('Kode Lokasi')->placeholder('-'),
                                TextEntry::make('jenis_bangunan')->label('Jenis Bangunan')->placeholder('-'),
                                TextEntry::make('kode_bangunan')->label('Kode Bangunan')->placeholder('-'),
                                TextEntry::make('register')->label('No. Register')->placeholder('-'),
                            ])->columns(2)->columnSpanFull(),

                        // SECTION 2: SPESIFIKASI FISIK
                        Section::make('Spesifikasi Fisik')
                            ->description('Detail teknis dan kondisi fisik bangunan.')
                            ->icon('heroicon-o-home')
                            ->schema([
                                TextEntry::make('kondisi_bangunan')
                                    ->label('Kondisi Bangunan')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'Baik' => 'success',
                                        'Rusak Ringan' => 'info',     // Biru
                                        'Rusak Sedang' => 'warning',  // Oranye/Kuning
                                        'Rusak Berat' => 'danger',    // Merah
                                        default => 'gray',
                                    })
                                    ->placeholder('-'),
                                TextEntry::make('bertingkat')->label('Jumlah Lantai (Tingkat)')->placeholder('-'),
                                TextEntry::make('beton')->label('Konstruksi Beton')->placeholder('-'),
                                TextEntry::make('luas_lantai')
                                    ->label('Luas Lantai (m²)')
                                    ->numeric()
                                    ->suffix(' m²')
                                    ->placeholder('-'),
                                TextEntry::make('luas')
                                    ->label('Luas Bangunan (m²)')
                                    ->numeric()
                                    ->suffix(' m²')
                                    ->placeholder('-'),
                            ])->columns(2),

                        // SECTION 3: LOKASI & LEGALITAS
                        Section::make('Lokasi & Dokumen Legal')
                            ->description('Informasi mengenai alamat, status tanah, dan asal-usul.')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                TextEntry::make('letak_alamat')
                                    ->label('Alamat Lengkap')
                                    ->columnSpanFull()
                                    ->placeholder('-'),
                                TextEntry::make('tanggal')
                                    ->label('Tanggal Dokumen')
                                    ->date('d M Y')
                                    ->placeholder('-'),
                                TextEntry::make('nomor')->label('Nomor Dokumen')->placeholder('-'),
                                TextEntry::make('status_tanah')->label('Status Tanah')->placeholder('-'),
                                TextEntry::make('nomor_kode_tanah')->label('No. Kode Tanah')->placeholder('-'),
                                TextEntry::make('asal_usul')->label('Asal Usul Perolehan')->placeholder('-'),
                                TextEntry::make('harga')
                                    ->label('Harga Perolehan')
                                    ->money('IDR')
                                    ->placeholder('-'),
                            ])->columns(2),

                        // SECTION 4: MEDIA & KETERANGAN
                        Section::make('Informasi Tambahan')
                            ->description('Lampiran foto dan catatan tambahan.')
                            ->icon('heroicon-o-plus-circle')
                            ->schema([
                                ImageEntry::make('foto')
                                    ->label('Foto Bangunan')
                                    ->columnSpanFull()
                                    ->placeholder('Tidak ada foto'),
                                TextEntry::make('pengurus_user')->label('Petugas Pengurus')->placeholder('-'),
                                TextEntry::make('ket')
                                    ->label('Keterangan Tambahan')
                                    ->columnSpanFull()
                                    ->placeholder('-'),

                                // Metadata Sistem (Opsional diletakkan di bawah keterangan)
                                TextEntry::make('created_at')
                                    ->label('Dibuat Pada')
                                    ->dateTime()
                                    ->color('gray'),
                                TextEntry::make('updated_at')
                                    ->label('Terakhir Diperbarui')
                                    ->dateTime()
                                    ->color('gray'),
                                TextEntry::make('deleted_at')
                                    ->label('Dihapus Pada')
                                    ->dateTime()
                                    ->color('danger')
                                    ->visible(fn ($record): bool => $record && method_exists($record, 'trashed') && $record->trashed()),
                            ])->columns(2),
                    ])->columnSpanFull(),
            ]);
    }
}
