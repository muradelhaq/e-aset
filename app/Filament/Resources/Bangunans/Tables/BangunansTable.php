<?php

namespace App\Filament\Resources\Bangunans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
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
         * IDENTITAS BANGUNAN
         * ======================= */
        TextColumn::make('kode_lokasi')
            ->label('Kode Lokasi')
            ->searchable()
            ->sortable(),

        TextColumn::make('jenis_bangunan')
            ->label('Jenis Bangunan')
            ->searchable()
            ->sortable(),

        TextColumn::make('kode_bangunan')
            ->label('Kode Bangunan')
            ->searchable(),

        TextColumn::make('register')
            ->label('Register')
            ->searchable(),


        /* =======================
         * KONDISI & STRUKTUR
         * ======================= */
        TextColumn::make('kondisi_bangunan')
            ->label('Kondisi')
            ->badge()
            ->color(fn (string $state): string => match ($state) {
                'Baik' => 'success',
                'Rusak Ringan' => 'warning',
                'Rusak Berat' => 'danger',
                default => 'gray',
            }),

        TextColumn::make('bertingkat')
            ->label('Bertingkat')
            ->badge(),

        TextColumn::make('beton')
            ->label('Konstruksi Beton')
            ->badge(),


        /* =======================
         * DIMENSI & LUAS
         * ======================= */
        TextColumn::make('luas_lantai')
            ->label('Luas Lantai (m²)')
            ->numeric()
            ->sortable(),

        TextColumn::make('luas')
            ->label('Luas Tanah (m²)')
            ->numeric()
            ->sortable(),


        /* =======================
         * LOKASI & LEGALITAS
         * ======================= */
        TextColumn::make('letak_alamat')
            ->label('Alamat')
            ->limit(40)
            ->tooltip(fn ($state) => $state)
            ->searchable(),

        TextColumn::make('status_tanah')
            ->label('Status Tanah')
            ->searchable(),

        TextColumn::make('nomor_kode_tanah')
            ->label('Kode Tanah')
            ->searchable(),


        /* =======================
         * ADMINISTRASI
         * ======================= */
        TextColumn::make('nomor')
            ->label('Nomor Dokumen')
            ->searchable(),

        TextColumn::make('asal_usul')
            ->label('Asal Usul')
            ->searchable(),

        TextColumn::make('harga')
            ->label('Nilai Aset')
            ->money('IDR')
            ->sortable(),

        TextColumn::make('tanggal')
            ->label('Tanggal Perolehan')
            ->date('d M Y')
            ->sortable(),


        /* =======================
         * MEDIA & PENGELOLA
         * ======================= */
        TextColumn::make('foto')
            ->label('Foto')
            ->toggleable(isToggledHiddenByDefault: true),

        TextColumn::make('pengurus_user')
            ->label('Pengurus')
            ->searchable(),


        /* =======================
         * SISTEM
         * ======================= */
        TextColumn::make('deleted_at')
            ->label('Dihapus')
            ->dateTime()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true),

        TextColumn::make('created_at')
            ->label('Dibuat')
            ->dateTime()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true),

        TextColumn::make('updated_at')
            ->label('Diperbarui')
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
