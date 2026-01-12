<?php

namespace App\Filament\Resources\Elektroniks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ElektroniksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenis_barang')
                    ->searchable(),
                TextColumn::make('merk')
                    ->searchable(),
                TextColumn::make('tipe')
                    ->searchable(),
                TextColumn::make('warna')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('spek')
                    ->label('Spesifikasi')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('no_seri')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                BadgeColumn::make('kondisi')
                    ->label('Kondisi')
                    // tampilkan state apa adanya (atau ubah sesuai kebutuhan)
                    ->formatStateUsing(fn($state) => $state ?? '-')
                    // warna berdasarkan nilai kondisi
                    ->colors([
                        'success'   => 'Baik',            // hijau
                        'warning'   => 'Rusak Ringan',    // kuning
                        'danger'    => 'Rusak Berat',     // merah tua
                        'secondary' => 'Tidak Berfungsi', // abu-abu
                        'primary'   => 'Dalam Perbaikan', // biru
                        'gray'      => 'Hilang',          // abu-abu gelap
                    ])
                    ->sortable()
                    ->searchable(),
                TextColumn::make('pemilik')
                    ->searchable(),
                TextColumn::make('harga')
                    ->money('IDR')
                    ->label('Harga')
                    ->sortable(),
                TextColumn::make('tgl_perolehan')
                    ->date()
                    ->sortable(),
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->visibility('public')
                    ->size(40)
                    ->circular()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('no_sk')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('upload_SK')
                    ->label('Upload SK')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
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
