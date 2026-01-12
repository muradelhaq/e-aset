<?php

namespace App\Filament\Resources\Kendaraans\Tables;

use App\Filament\Resources\Services\ServiceResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class KendaraansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nopol')
                    ->label('No. Polisi')
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('jenis')
                    ->label('Jenis Kendaraan')
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state ?? '-')
                    ->colors([
                        'Mobil' => 'primary',
                        'Motor' => 'warning',
                        'Truck' => 'danger',
                        'Bus' => 'success',
                    ]),
                TextColumn::make('merk')
                    ->label('Merk')
                    ->searchable(),
                TextColumn::make('tipe')
                    ->label('Tipe'),
                TextColumn::make('tahun_pembuatan')
                    ->label('Tahun')
                    ->sortable(),
                TextColumn::make('pemilik')
                    ->label('Pemilik')
                    ->searchable(),
                TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('tgl_pajak')
                    ->label('Jatuh Tempo Pajak')
                    ->date()
                    ->sortable(),
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->visibility('public')
                    ->size(40)
                    ->circular(),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('jenis_kendaraan')
                    ->label('Jenis Kendaraan')
                    ->options([
                        'Mobil' => 'Mobil',
                        'Motor' => 'Motor',
                        'Truck' => 'Truck',
                        'Bus' => 'Bus'
                    ]),
                Filter::make('pajak_jatuh_tempo')
                    ->label('Pajak Akan Jatuh Tempo')
                    ->query(fn ($query) => $query->where('tgl_pajak', '<=', now()->addMonths(3))),
            ])
            ->recordActions([
                Action::make('service')
                    ->label('Service')
                    ->icon('heroicon-o-wrench-screwdriver')
                    ->color('success')
                    ->url(fn ($record) => ServiceResource::getUrl('create', ['kendaraan_id' => $record->id]))
                    ->tooltip('Tambah Riwayat Service'),
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
