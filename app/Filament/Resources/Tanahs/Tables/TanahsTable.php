<?php

namespace App\Filament\Resources\Tanahs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class TanahsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_lokasi')
                    ->searchable(),
                TextColumn::make('jenis_barang')
                    ->searchable(),
                TextColumn::make('kode_barang')
                    ->searchable(),
                TextColumn::make('register')
                    ->searchable(),
                TextColumn::make('luas')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('alamat')
                    ->searchable(),
                TextColumn::make('status_tanah')
                    ->searchable(),
                TextColumn::make('sertifikat')
                    ->searchable(),
                TextColumn::make('nomor_sertifikat')
                    ->searchable(),
                TextColumn::make('penggunaan')
                    ->searchable(),
                TextColumn::make('asal_usul')
                    ->searchable(),
                TextColumn::make('harga')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tanggal_perolehan')
                    ->date()
                    ->sortable(),
                TextColumn::make('pemilik')
                    ->searchable(),
                TextColumn::make('foto')
                    ->searchable(),
                TextColumn::make('no_sk')
                    ->searchable(),
                TextColumn::make('upload_SK')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
