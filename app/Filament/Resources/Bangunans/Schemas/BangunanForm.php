<?php

namespace App\Filament\Resources\Bangunans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload; // Untuk foto
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BangunanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(1) // Menggunakan grid 2 kolom untuk layout utama
                    ->schema([

                        // SECTION 1: IDENTITAS UTAMA
                        Section::make('Identitas Bangunan')
                            ->description('Informasi dasar mengenai kode dan jenis bangunan.')
                            ->icon('heroicon-o-identification')
                            ->schema([
                                TextInput::make('kode_lokasi')->label('Kode Lokasi'),
                                TextInput::make('jenis_bangunan')->label('Jenis Bangunan'),
                                TextInput::make('kode_bangunan')->label('Kode Bangunan'),
                                TextInput::make('register')->label('No. Register'),
                            ])->columns(2)->columnSpanFull(),

                        // SECTION 2: SPESIFIKASI FISIK
                        Section::make('Spesifikasi Fisik')
                            ->description('Detail teknis dan kondisi fisik bangunan.')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Select::make('kondisi_bangunan')
                                ->label('Kondisi Bangunan')
                                ->options([
                                    'Baik' => 'Baik',
                                    'Rusak Ringan' => 'Rusak Ringan',
                                    'Rusak Sedang' => 'Rusak Sedang',
                                    'Rusak Berat' => 'Rusak Berat',
                                ])
                                ->required()
                                ->native(false)
                                ->prefixIcon('heroicon-m-check-badge'), // Menambah icon untuk mempercantik UI
                                TextInput::make('bertingkat')->label('Jumlah Lantai (Tingkat)'),
                                TextInput::make('beton')->label('Konstruksi Beton'),
                                TextInput::make('luas_lantai')->numeric()->label('Luas Lantai (m²)'),
                                TextInput::make('luas')->numeric()->label('Luas Bangunan (m²)'),
                            ])->columns(2),

                        // SECTION 3: LOKASI & LEGALITAS
                        Section::make('Lokasi & Dokumen Legal')
                            ->description('Informasi mengenai alamat, status tanah, dan asal-usul.')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                TextInput::make('letak_alamat')->label('Alamat Lengkap')->columnSpanFull(),
                                DatePicker::make('tanggal')->label('Tanggal Dokumen'),
                                TextInput::make('nomor')->label('Nomor Dokumen'),
                                TextInput::make('status_tanah')->label('Status Tanah'),
                                TextInput::make('nomor_kode_tanah')->label('No. Kode Tanah'),
                                TextInput::make('asal_usul')->label('Asal Usul Perolehan'),
                                TextInput::make('harga')->numeric()->prefix('Rp')->label('Harga Perolehan'),
                            ])->columns(2),

                        // SECTION 4: MEDIA & KETERANGAN
                        Section::make('Informasi Tambahan')
                            ->description('Lampiran foto dan catatan tambahan.')
                            ->icon('heroicon-o-plus-circle')
                            ->schema([
                                FileUpload::make('foto')
                                    ->label('Foto Bangunan')
                                    ->image()
                                    ->disk('public')
                                    ->directory('uploads/bangunan')
                                    ->columnSpanFull(),
                                TextInput::make('pengurus_user')->label('Petugas Pengurus'),
                                Textarea::make('ket')
                                    ->label('Keterangan Tambahan')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ])->columns(1),
                    ])->columnSpanFull(),
            ]);
    }
}
