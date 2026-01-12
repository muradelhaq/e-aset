<?php

namespace App\Filament\Resources\Elektroniks\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Table as FilamentTable;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class ServiceElektroniksRelationManager extends RelationManager
{
    protected static string $relationship = 'serviceElektroniks'; // pastikan nama method di model Elektronik
    protected static ?string $recordTitleAttribute = 'deskripsi';

     public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('tanggal_service')
                    ->label('Tanggal Service')
                    ->required()
                    ->default(now()),

                Textarea::make('deskripsi')
                    ->label('Deskripsi Service')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('biaya')
                    ->label('Biaya')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal_service')->label('Tanggal')->date()->sortable(),
                TextColumn::make('deskripsi')->label('Deskripsi')->limit(80)->wrap(),
                TextColumn::make('biaya')
                    ->label('Biaya')
                    ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : '-')
                    ->sortable()
                    ->alignEnd(),
                TextColumn::make('created_at')->label('Dibuat')->dateTime()->toggleable(),
            ])
 
            ->defaultSort('tanggal_service', 'desc');
    }
}
