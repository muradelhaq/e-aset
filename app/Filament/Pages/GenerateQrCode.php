<?php

namespace App\Filament\Pages;

use App\Models\Kendaraan;
use Filament\Actions\Action;
use Filament\Actions\StaticAction;
use App\Models\QrKendaraan;
use Illuminate\Support\Str;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Collection;

class GenerateQrCode extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-qr-code';
    protected static ?string $recordTitleAttribute = 'Generate Kode QR';

    protected static string | \UnitEnum | null $navigationGroup = 'Kendaraan';

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationLabel = 'Generate Kode QR';

    // Label untuk judul halaman dan tombol (Singular)
    protected static ?string $modelLabel = 'Generate Kode QR';

    // Label untuk data jamak (Plural)
    protected static ?string $pluralModelLabel = 'Generate Kode QR';
    protected string $view = 'filament.pages.generate-qr-code';

    public function table(Table $table): Table
    {
        return $table
            ->query(Kendaraan::query())
            ->columns([
                TextColumn::make('nopol')->searchable()->sortable(),
                TextColumn::make('jenis_kendaraan')->searchable()->sortable(),
                TextColumn::make('keterangan')->searchable(),
                TextColumn::make('updated_at')->sortable(),
            ])
            ->actions([
             Action::make('status_qr')
                ->label('Lihat QR')
                ->icon('heroicon-o-qr-code')
                ->color('info')
                ->visible(fn ($record) => $record->qr_codes()->exists())
                ->url(fn ($record) => route(
                    'kendaraan.show',
                    $record->qr_codes()->first()->kode_qr
                ))
                ->openUrlInNewTab(), // opsional

            Action::make('print_qr')
                ->label('Cetak QR')
                ->icon('heroicon-o-printer')
                ->color('success')
                ->visible(fn ($record) => $record->qr_codes()->exists())
                ->url(fn ($record) => route('kendaraan.print', [
                    'kode' => $record->qr_codes()->latest()->first()->kode_qr,
                ]))
                ->openUrlInNewTab(),

            ])
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
                            ->map(fn($r) => optional($r->qr_codes()->latest()->first())->kode_qr)
                            ->filter()
                            ->unique()
                            ->implode(',');

                        return $codes ? url('/kendaraan/print-bulk?codes=' . urlencode($codes)) : '#';
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
            $publicUrl  = url('/kendaraan/' . $uniqueCode);

            $qrEntry = QrKendaraan::updateOrCreate(
                ['kendaraan_id' => $record->id], // KUNCI
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
