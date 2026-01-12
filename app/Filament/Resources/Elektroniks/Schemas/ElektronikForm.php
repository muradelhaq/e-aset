<?php

namespace App\Filament\Resources\Elektroniks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;

class ElektronikForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // SECTION 1: SPESIFIKASI TEKNIS
                Section::make('Informasi Dasar & Spesifikasi')
                    ->description('Detail identitas barang dan spesifikasi teknis.')
                    ->icon('heroicon-o-cpu-chip')
                    ->schema([
                        TextInput::make('jenis_barang')
                            ->label('Jenis Barang')
                            ->placeholder('Contoh: Laptop, Printer, dsb.')
                            ->required(),

                        TextInput::make('no_seri')
                            ->label('Nomor Seri (S/N)')
                            ->unique(ignoreRecord: true),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('merk')->label('Merk'),
                                TextInput::make('tipe')->label('Tipe'),
                                TextInput::make('warna')->label('Warna'),
                            ]),

                        Textarea::make('spek')
                            ->label('Spesifikasi Lengkap')
                            ->placeholder('Contoh: RAM 16GB, SSD 512GB, Intel i7...')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->collapsible()->columnSpanFull(),

                // SECTION 2: STATUS & NILAI ASET
                Section::make('Finansial & Kondisi')
                    ->description('Informasi perolehan aset dan status saat ini.')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        DatePicker::make('tgl_perolehan')
                            ->label('Tanggal Perolehan')
                            ->native(false) // UI lebih modern
                            ->displayFormat('d/m/Y'),

                        TextInput::make('harga')
                            ->label('Harga Perolehan')
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('0'),

                        Select::make('kondisi')
                            ->label('Kondisi Barang')
                            ->native(false)
                            ->options([
                                'Baik' => 'Baik',
                                'Rusak Ringan' => 'Rusak Ringan',
                                'Rusak Berat' => 'Rusak Berat',
                                'Tidak Berfungsi' => 'Tidak Berfungsi',
                                'Dalam Perbaikan' => 'Dalam Perbaikan',
                                'Hilang' => 'Hilang'
                            ])
                            ->required(),

                        TextInput::make('pemilik')
                            ->label('Penanggung Jawab / Pemilik'),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->columnSpanFull(),

                // SECTION 3: ADMINISTRASI & DOKUMEN
                Section::make('Dokumen & Media')
                    ->description('Lampiran bukti fisik dan dokumen legalitas.')
                    ->icon('heroicon-o-document-plus')
                    ->schema([
                        TextInput::make('no_sk')
                            ->label('Nomor SK / Dokumen Pendukung')
                            ->placeholder('Masukkan nomor SK aset'),

                        Grid::make(2)
                            ->schema([
                                FileUpload::make('foto')
                                    ->label('Foto Fisik Barang')
                                    ->image()
                                    ->disk('public')
                                    ->imageEditor() // Memungkinkan user crop foto
                                    ->directory('uploads/elektronik'),

                                FileUpload::make('upload_SK')
                                    ->label('Dokumen SK (PDF)')
                                    ->disk('public')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->directory('documents/sk')
                                    ->maxSize(5120),
                            ]),

                        Textarea::make('keterangan')
                            ->label('Catatan Tambahan')
                            ->rows(3),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),
            ]);
    }
}
