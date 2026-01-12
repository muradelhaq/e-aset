<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use App\Models\Kendaraan;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Informasi Service')
                    ->columnSpanFull()
                    ->schema([
                        Select::make('kendaraan_id')
                            ->label('Kendaraan')
                            ->options(Kendaraan::all()->pluck('nopol', 'id'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $kendaraan = Kendaraan::find($state);
                                    $set('nopol', $kendaraan?->nopol);
                                }
                            })
                            ->default(request()->get('kendaraan_id')),

                        TextInput::make('nopol')
                            ->label('Nomor Polisi')
                            ->disabled()
                            ->dehydrated(true),

                        DatePicker::make('tanggal_service')
                            ->label('Tanggal Service')
                            ->required()
                            ->default(now()),

                        Textarea::make('deskripsi')
                            ->label('Deskripsi Service')
                            ->required()
                            ->rows(4)
                            ->placeholder('Contoh: Ganti oli mesin, tune up, servis berkala, dll.'),

                        TextInput::make('biaya')
                            ->label('Biaya Service')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('0')
                            ->formatStateUsing(fn ($state) => $state ? number_format($state, 0, ',', '.') : '')
                    ])
            ]);
    }
}
