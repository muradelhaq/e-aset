<?php

namespace App\Filament\Resources\Tanahs\Schemas;

use App\Models\Tanah;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class TanahInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /* ===============================
                 * IDENTITAS ASET
                 * =============================== */
                Section::make('Identitas Aset Tanah')
                    ->description('Informasi utama identitas dan klasifikasi aset tanah.')
                    ->icon('heroicon-o-identification')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('kode_lokasi')
                                    ->label('Kode Lokasi')
                                    ->placeholder('-'),

                                TextEntry::make('kode_barang')
                                    ->label('Kode Barang')
                                    ->placeholder('-'),

                                TextEntry::make('jenis_barang')
                                    ->label('Jenis Barang')
                                    ->placeholder('-'),

                                TextEntry::make('register')
                                    ->label('Register')
                                    ->placeholder('-'),
                            ]),
                    ])
                    ->columnSpanFull(),

                /* ===============================
                 * DATA FISIK TANAH
                 * =============================== */
                Section::make('Data Fisik Tanah')
                    ->description('Informasi fisik dan pemanfaatan tanah.')
                    ->icon('heroicon-o-map')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('luas')
                                    ->label('Luas Tanah')
                                    ->numeric()
                                    ->suffix(' m²')
                                    ->placeholder('-'),

                                TextEntry::make('status_tanah')
                                    ->label('Status Tanah')
                                    ->placeholder('-'),

                                TextEntry::make('penggunaan')
                                    ->label('Penggunaan')
                                    ->placeholder('-'),
                            ]),

                        TextEntry::make('asal_usul')
                            ->label('Asal Usul')
                            ->placeholder('-'),

                        TextEntry::make('alamat')
                            ->label('Alamat Lengkap')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                /* ===============================
                 * LEGALITAS & SERTIFIKAT
                 * =============================== */
                Section::make('Legalitas & Sertifikat')
                    ->description('Data hukum dan sertifikat kepemilikan tanah.')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('sertifikat')
                                    ->label('Jenis Sertifikat')
                                    ->placeholder('-'),

                                TextEntry::make('nomor_sertifikat')
                                    ->label('Nomor Sertifikat')
                                    ->placeholder('-'),
                            ]),
                    ])
                    ->columnSpanFull(),

                /* ===============================
                 * PEROLEHAN & NILAI ASET
                 * =============================== */
                Section::make('Perolehan & Nilai Aset')
                    ->description('Informasi perolehan dan nilai aset tanah.')
                    ->icon('heroicon-o-currency-dollar')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('tanggal_perolehan')
                                    ->label('Tanggal Perolehan')
                                    ->date()
                                    ->placeholder('-'),

                                TextEntry::make('harga')
                                    ->label('Nilai Perolehan')
                                    ->numeric()
                                    ->prefix('Rp ')
                                    ->placeholder('-'),

                                TextEntry::make('pemilik')
                                    ->label('Pemilik / Pengguna')
                                    ->placeholder('-'),
                            ]),
                    ])
                    ->columnSpanFull(),

                /* ===============================
                 * DOKUMEN & KETERANGAN
                 * =============================== */
                Section::make('Dokumen & Keterangan')
                    ->description('Lampiran dokumen pendukung dan catatan tambahan.')
                    ->icon('heroicon-o-paper-clip')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('foto')
                                    ->label('Foto Tanah')
                                    ->placeholder('-'),

                                TextEntry::make('upload_SK')
                                    ->label('Dokumen SK')
                                    ->placeholder('-'),
                            ]),

                        TextEntry::make('no_sk')
                            ->label('Nomor SK')
                            ->placeholder('-'),

                        TextEntry::make('keterangan')
                            ->label('Keterangan Tambahan')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                /* ===============================
                 * INFORMASI SISTEM
                 * =============================== */
                Section::make('Informasi Sistem')
                    ->description('Data pencatatan sistem.')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Dibuat Pada')
                                    ->dateTime()
                                    ->placeholder('-'),

                                TextEntry::make('updated_at')
                                    ->label('Terakhir Diubah')
                                    ->dateTime()
                                    ->placeholder('-'),

                                TextEntry::make('deleted_at')
                                    ->label('Dihapus Pada')
                                    ->dateTime()
                                    ->visible(fn (Tanah $record): bool => $record->trashed()),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
