<?php

namespace App\Filament\Resources\Tanahs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class TanahForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /* ===============================
                 * SECTION 1: IDENTITAS ASET
                 * =============================== */
                Section::make('Identitas Aset Tanah')
                    ->description('Informasi utama identitas dan klasifikasi aset tanah.')
                    ->icon('heroicon-o-identification')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('kode_lokasi')
                                    ->label('Kode Lokasi')
                                    ->required(),

                                TextInput::make('kode_barang')
                                    ->label('Kode Barang')
                                    ->required(),

                                TextInput::make('jenis_barang')
                                    ->label('Jenis Barang')
                                    ->required(),

                                TextInput::make('register')
                                    ->label('Register')
                                    ->required(),
                            ]),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),

                /* ===============================
                 * SECTION 2: DATA FISIK TANAH
                 * =============================== */
                Section::make('Data Fisik Tanah')
                    ->description('Detail fisik dan pemanfaatan tanah.')
                    ->icon('heroicon-o-map')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('luas')
                                    ->label('Luas Tanah')
                                    ->numeric()
                                    ->suffix('m²')
                                    ->required(),

                                Select::make('status_tanah')
                                    ->label('Status Tanah')
                                    ->options([
                                        'Milik' => 'Milik',
                                        'Sewa' => 'Sewa',
                                        'Pinjam Pakai' => 'Pinjam Pakai',
                                        'Hibah' => 'Hibah',
                                    ])
                                    ->native(false),

                                TextInput::make('penggunaan')
                                    ->label('Penggunaan'),
                            ]),

                        TextInput::make('asal_usul')
                            ->label('Asal Usul'),

                        Textarea::make('alamat')
                            ->label('Alamat Lengkap')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),

                /* ===============================
                 * SECTION 3: LEGALITAS & SERTIFIKAT
                 * =============================== */
                Section::make('Legalitas & Sertifikat')
                    ->description('Data hukum dan bukti kepemilikan tanah.')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('sertifikat')
                                    ->label('Jenis Sertifikat')
                                    ->options([
                                        'SHM' => 'SHM',
                                        'HGB' => 'HGB',
                                        'Hak Pakai' => 'Hak Pakai',
                                        'Tidak Bersertifikat' => 'Tidak Bersertifikat',
                                    ])
                                    ->native(false),

                                TextInput::make('nomor_sertifikat')
                                    ->label('Nomor Sertifikat'),
                            ]),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),

                /* ===============================
                 * SECTION 4: PEROLEHAN & NILAI ASET
                 * =============================== */
                Section::make('Perolehan & Nilai Aset')
                    ->description('Informasi perolehan dan nilai aset tanah.')
                    ->icon('heroicon-o-currency-dollar')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                DatePicker::make('tanggal_perolehan')
                                    ->label('Tanggal Perolehan')
                                    ->native(false)
                                    ->required(),

                                TextInput::make('harga')
                                    ->label('Nilai Perolehan')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required(),

                                TextInput::make('pemilik')
                                    ->label('Pemilik/Pengguna'),
                            ]),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),

                /* ===============================
                 * SECTION 5: DOKUMEN & KETERANGAN
                 * =============================== */
                Section::make('Dokumen & Keterangan')
                    ->description('Lampiran dokumen pendukung dan catatan tambahan.')
                    ->icon('heroicon-o-paper-clip')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                FileUpload::make('foto')
                                    ->label('Foto Lokasi Tanah')
                                    ->image()
                                    ->disk('public')
                                    ->directory('uploads/tanah')
                                    ->imageEditor(),

                                FileUpload::make('upload_SK')
                                    ->label('Upload SK (PDF)')
                                    ->disk('public')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->directory('documents/sk_tanah'),
                            ]),

                        TextInput::make('no_sk')
                            ->label('Nomor SK'),

                        Textarea::make('keterangan')
                            ->label('Keterangan Tambahan')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),
            ]);
    }
}
