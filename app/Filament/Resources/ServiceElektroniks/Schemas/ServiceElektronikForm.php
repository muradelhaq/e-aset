<?php

namespace App\Filament\Resources\ServiceElektroniks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use App\Models\Elektronik;
use App\Models\ServiceElektronik;

class ServiceElektronikForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
                ->components([
                    Section::make('Informasi Service')
                        ->schema([
                            Select::make('elektronik_id')
                                ->label('Barang Elektronik')
                                ->options(function () {
                                    return Elektronik::query()
                                        ->orderBy('jenis_barang')
                                        ->get()
                                        ->mapWithKeys(fn($item) => [$item->id => "{$item->jenis_barang} — {$item->merk} ({$item->pemilik})"])
                                        ->toArray();
                                })
                                ->searchable()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    if ($state) {
                                        $elektronik = Elektronik::find($state);
                                        if ($elektronik) {
                                            $set('jenis_barang', $elektronik->jenis_barang);
                                            $set('merk', $elektronik->merk);
                                            $set('pemilik', $elektronik->pemilik);
                                        }
                                    }
                                })
                                ->default(request()->get('elektronik_id')),

                            TextInput::make('jenis_barang')
                                ->label('Jenis Barang')
                                ->disabled()
                                ->dehydrated()
                                ->required(),

                            TextInput::make('merk')
                                ->label('Merk')
                                ->disabled()
                                ->dehydrated()
                                ->required(),

                            TextInput::make('pemilik')
                                ->label('Pemilik/Pengguna')
                                ->disabled()
                                ->dehydrated()
                                ->required(),

                            DatePicker::make('tanggal_service')
                                ->label('Tanggal Service')
                                ->required()
                                ->default(now()),

                            Textarea::make('deskripsi')
                                ->label('Deskripsi Service')
                                ->required()
                                ->rows(4)
                                ->placeholder('Contoh: Pembersihan internal, perbaikan hardware, instalasi software, dll.'),

                            TextInput::make('biaya')
                                ->label('Biaya Service')
                                ->required()
                                ->numeric()
                                ->prefix('Rp')
                                ->placeholder('0')
                                ->formatStateUsing(fn ($state) => $state ? number_format($state, 0, ',', '.') : ''),
                        ])
                        ->columns(1)
                        ->columnSpanFull(),
                ]);
    }
}
