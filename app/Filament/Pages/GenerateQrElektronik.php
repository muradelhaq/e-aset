<?php

namespace App\Filament\Pages;

use App\Models\Elektronik;
use App\Models\QrElektronik;
use Filament\Actions\Action;
use Filament\Actions\StaticAction;
use Illuminate\Support\Str;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Collection;

class GenerateQrElektronik extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-qr-code';
    protected static ?string $recordTitleAttribute = 'Generate Kode QR';

    protected static string | \UnitEnum | null $navigationGroup = 'Elektronik';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Generate Kode QR';

    // Label untuk judul halaman dan tombol (Singular)
    protected static ?string $modelLabel = 'Generate Kode QR';

    // Label untuk data jamak (Plural)
    protected static ?string $pluralModelLabel = 'Generate Kode QR';
    protected string $view = 'filament.pages.generate-qr-elektronik';

    public function table(Table $table): Table
    {
        return $table
            ->query(Elektronik::query())
            ->columns([
                TextColumn::make('jenis_barang')
                    ->label('Jenis')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('merk')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tipe')
                    ->searchable(),

                TextColumn::make('no_seri')
                    ->label('No Seri')
                    ->searchable(),

                TextColumn::make('updated_at')
                    ->label('Update')
                    ->dateTime(),
            ])

            ->actions([
             Action::make('status_qr')
                ->label('Lihat QR')
                ->icon('heroicon-o-qr-code')
                ->color('info')
                ->visible(fn ($record) => $record->qrElektroniks()->exists())
                ->url(fn ($record) => route(
                    'elektronik.show',
                    $record->qrElektroniks()->first()->kode_qr
                ))
                ->openUrlInNewTab(), // opsional

            Action::make('print_qr')
                ->label('Cetak QR')
                ->icon('heroicon-o-printer')
                ->color('success')
                ->visible(fn ($record) => $record->qrElektroniks()->exists())
                ->url(fn ($record) => route('elektronik.print', [
                    'kode' => $record->qrElektroniks()->latest()->first()->kode_qr,
                ]))
                ->openUrlInNewTab(),

            ])

            /* ========== BULK ACTIONS ========== */
            ->bulkActions([
                BulkAction::make('generateQr')
                    ->label('Generate QR Code Terpilih')
                    ->icon('heroicon-o-qr-code')
                    ->action(fn (Collection $records) => $this->generateQr($records))
                    ->deselectRecordsAfterCompletion(),
                BulkAction::make('printBulkQr')
                    ->label('Preview Cetak QR Terpilih')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->url(function (Collection $records) {
                        $codes = $records
                            ->map(fn($r) => optional($r->qrElektroniks()->latest()->first())->kode_qr)
                            ->filter()
                            ->unique()
                            ->implode(',');

                        return $codes ? url('/elektronik/print-bulk?codes=' . urlencode($codes)) : '#';
                    })
                    ->openUrlInNewTab(),
            ]);
    }

    public $selectedRecords = [];

    public $qrGeneratedIds = [];

    public function generateQr(Collection $records)
    {
        $this->qrGeneratedIds = [];

        foreach ($records as $record) {

            $uniqueCode = 'QR-' . strtoupper(Str::random(10));
            $publicUrl  = url('/elektronik/' . $uniqueCode);

            $qrEntry = QrElektronik::updateOrCreate(
                ['elektronik_id' => $record->id], // KUNCI
                [
                    'kode_qr' => $uniqueCode,
                    'url'     => $publicUrl,
                    'qr_path' => 'qrcodes/' . $uniqueCode . '.png',
                ]
            );

            $this->qrGeneratedIds[] = $qrEntry->id;
        }

        $this->dispatch('qr-generated');
    }

}
