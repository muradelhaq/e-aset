<?php

namespace App\Filament\Resources\NonElektroniks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class NonElektroniksTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('nama_barang')
                ->searchable()
                ->sortable(),

            TextColumn::make('jenis_barang')
                ->searchable(),

            TextColumn::make('merk'),

            TextColumn::make('kondisi')
                ->badge(),

            TextColumn::make('harga')
                ->money('IDR'),

            TextColumn::make('tgl_perolehan')
                ->date(),
        ])
        ->filters([
            TrashedFilter::make(),
        ])
        ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
        ->bulkActions([
            DeleteBulkAction::make(),
        ]);}
}
