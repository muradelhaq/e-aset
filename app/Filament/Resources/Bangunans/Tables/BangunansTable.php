<?php

namespace App\Filament\Resources\Bangunans\Tables;

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
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BangunansTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->columns([
            /* =======================
            * KOLOM UTAMA (TAMPIL)
            * ======================= */
            TextColumn::make('jenis_bangunan')
                ->label('Jenis Bangunan')
                ->searchable()
                ->sortable(),

            TextColumn::make('kondisi_bangunan')
                ->label('Kondisi')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Baik' => 'success',
                    'Rusak Ringan' => 'info',     // Biru
                    'Rusak Sedang' => 'warning',  // Oranye/Kuning
                    'Rusak Berat' => 'danger',    // Merah
                    default => 'gray',
                }),

            TextColumn::make('luas_lantai')
                ->label('Luas (m²)')
                ->numeric()
                ->sortable(),

            TextColumn::make('harga')
                ->label('Nilai Aset')
                ->money('IDR')
                ->sortable(),

            TextColumn::make('letak_alamat')
                ->label('Alamat')
                ->limit(30)
                ->searchable(),

            /* =======================
            * KOLOM PENDUKUNG (HIDDEN BY DEFAULT)
            * ======================= */
            // Identitas
            TextColumn::make('kode_lokasi')
                ->label('Kode Lokasi')
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('kode_bangunan')
                ->label('Kode Bangunan')
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('register')
                ->label('Register')
                ->toggleable(isToggledHiddenByDefault: true),

            // Struktur
            TextColumn::make('bertingkat')
                ->label('Bertingkat')
                ->badge()
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('beton')
                ->label('Konstruksi Beton')
                ->badge()
                ->toggleable(isToggledHiddenByDefault: true),

            // Detail Tanah
            TextColumn::make('luas')
                ->label('Luas Tanah')
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('status_tanah')
                ->label('Status Tanah')
                ->toggleable(isToggledHiddenByDefault: true),

            // Administrasi & Sistem
            TextColumn::make('tanggal')
                ->label('Tgl Perolehan')
                ->date()
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('pengurus_user')
                ->label('Pengurus')
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('updated_at')
                ->label('Terakhir Diupdate')
                ->dateTime()
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
            ]);}
}
