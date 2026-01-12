<?php

namespace App\Filament\Resources\Kendaraans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class KendaraanForm
{
    public static function configure(Schema $schema): Schema
{
        return $schema
            ->components([
                // SECTION 1: IDENTITAS UTAMA
                Section::make('Informasi Dasar')
                    ->description('Data utama identitas kendaraan.')
                    ->icon('heroicon-o-identification')
                    ->schema([
                        Select::make('jenis')
                            ->label('Kategori Kendaraan')
                            ->options([
                                'Mobil' => 'Mobil',
                                'Motor' => 'Motor',
                                'Truck' => 'Truck',
                                'Bus' => 'Bus'
                            ])
                            ->required()

                            ->columnSpanFull(),

                        TextInput::make('nopol')
                            ->label('Nomor Polisi')
                            ->placeholder('Contoh: Z 1234 AB')
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('jenis_kendaraan')
                            ->label('Jenis Spesifik')
                            ->placeholder('Contoh: Mobil Ambulance, Motor Dinas'),

                        Grid::make(3)
                            ->schema([
                                TextInput::make('merk')->label('Merk')->placeholder('Toyota'),
                                TextInput::make('tipe')->label('Tipe')->placeholder('Avanza'),
                                TextInput::make('warna')->label('Warna')->placeholder('Hitam Metalik'),
                            ]),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),

                // SECTION 2: SPESIFIKASI MESIN & DOKUMEN KENDARAAN
                Section::make('Spesifikasi Teknis')
                    ->description('Detail teknis mesin dan nomor registrasi.')
                    ->icon('heroicon-o-wrench-screwdriver')
                    ->schema([
                        Select::make('tahun_pembuatan')
                            ->label('Tahun Pembuatan')
                            ->options(function () {
                                $current = (int) date('Y');
                                $years = range($current, 1950);
                                return array_combine($years, $years);
                            })
                            ->searchable()
                            ->native(false),

                        TextInput::make('isi_silinder')
                            ->label('Isi Silinder (CC)')
                            ->numeric()
                            ->suffix('CC'),

                        TextInput::make('no_rangka')->label('Nomor Rangka'),
                        TextInput::make('no_mesin')->label('Nomor Mesin'),
                        TextInput::make('no_bpkb')->label('Nomor BPKB')->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->columnSpanFull(),

                // SECTION 3: LEGALITAS & TANGGUNG JAWAB
                Section::make('Informasi Legal & Finansial')
                    ->description('Data kepemilikan, pajak, dan nilai aset.')
                    ->icon('heroicon-o-scale')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                DatePicker::make('tgl_pajak')->label('Jatuh Tempo Pajak')->native(false),
                                DatePicker::make('tgl_perolehan')->label('Tgl. Perolehan')->native(false),
                                TextInput::make('harga')->label('Harga')->numeric()->prefix('Rp'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('pemilik')->label('Nama Pemilik/Pemakai'),
                                TextInput::make('nip')->label('NIP'),
                                TextInput::make('jabatan')->label('Jabatan'),
                                TextInput::make('no_SK')->label('Nomor SK Penggunaan'),
                            ]),

                        Textarea::make('alamat')
                            ->label('Alamat Pemilik')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),

                // SECTION 4: MEDIA & CATATAN
                Section::make('Dokumen & Media')
                    ->description('Lampiran foto fisik dan dokumen pendukung.')
                    ->icon('heroicon-o-camera')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                FileUpload::make('foto')
                                    ->label('Foto Kendaraan')
                                    ->image()
                                    ->disk('public')
                                    ->imageEditor()
                                    ->directory('uploads/kendaraan'),

                                FileUpload::make('upload_SK')
                                    ->label('Scan SK (PDF)')
                                    ->disk('public')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->directory('documents/sk_kendaraan'),
                            ]),

                        Textarea::make('keterangan')
                            ->label('Catatan/Keterangan Kondisi')
                            ->rows(3),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),
            ]);
    }
}
