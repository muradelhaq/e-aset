<?php

namespace App\Filament\Resources\Kendaraans\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions;

class ServicesRelationManager extends RelationManager
{
    protected static string $relationship = 'services';

    protected static ?string $title = 'Riwayat Service Kendaraan';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('tanggal_service')
                    ->label('Tanggal Service')
                    ->required(),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('biaya')
                    ->label('Biaya')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
            ]);
    }


    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal_service')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),

                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(40)
                    ->wrap(),

                TextColumn::make('biaya')
                    ->label('Biaya')
                    ->money('IDR')
                    ->sortable(),
            ])

            ->actions([

            ]);
    }
}
