<?php

namespace App\Filament\Resources\NonElektroniks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class NonElektronikForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /* ================= SECTION 1 ================= */
                Section::make('Informasi Dasar Barang')
                    ->description('Identitas dan karakteristik barang non elektronik.')
                    ->icon('heroicon-o-archive-box')
                    ->schema([
                        TextInput::make('jenis_barang')
                            ->label('Jenis Barang')
                            ->placeholder('Contoh: Meja, Kursi, Lemari')
                            ->required(),

                        TextInput::make('nama_barang')
                            ->label('Nama Barang')
                            ->required(),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('merk')->label('Merk'),
                                TextInput::make('bahan')->label('Bahan'),
                                TextInput::make('warna')->label('Warna'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('ukuran')->label('Ukuran'),
                                TextInput::make('jumlah')->label('Jumlah')->numeric(),
                            ]),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),

                /* ================= SECTION 2 ================= */
                Section::make('Perolehan & Kondisi')
                    ->description('Informasi tanggal perolehan, nilai aset, dan kondisi.')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        DatePicker::make('tgl_perolehan')
                            ->label('Tanggal Perolehan')
                            ->native(false)
                            ->displayFormat('d/m/Y'),

                        TextInput::make('harga')
                            ->label('Harga Perolehan')
                            ->numeric()
                            ->prefix('Rp'),

                        Select::make('kondisi')
                            ->label('Kondisi Barang')
                            ->native(false)
                            ->options([
                                'Baik' => 'Baik',
                                'Rusak Ringan' => 'Rusak Ringan',
                                'Rusak Berat' => 'Rusak Berat',
                                'Tidak Layak Pakai' => 'Tidak Layak Pakai',
                                'Hilang' => 'Hilang',
                            ])
                            ->required(),

                        TextInput::make('pemilik')
                            ->label('Penanggung Jawab / Pemilik'),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->columnSpanFull(),

                /* ================= SECTION 3 ================= */
                Section::make('Dokumen & Keterangan')
                    ->description('Dokumen pendukung dan catatan tambahan.')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        TextInput::make('no_sk')
                            ->label('Nomor SK / Dokumen Pendukung'),

                        Grid::make(2)
                            ->schema([
                                FileUpload::make('foto')
                                    ->label('Foto Barang')
                                    ->image()
                                    ->imageEditor()
                                    ->disk('public')
                                    ->directory('uploads/non-elektronik'),

                                FileUpload::make('upload_sk')
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
