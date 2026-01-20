<?php

namespace App\Filament\Pages;

use App\Models\Bangunan;
use App\Models\QrBangunan;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class GenerateQrBangunan extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-qr-code';

    protected static string | \UnitEnum | null $navigationGroup = 'Bangunan';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationLabel = 'Generate Kode QR';

    protected static ?string $modelLabel = 'Generate Kode QR';

    protected static ?string $pluralModelLabel = 'Generate Kode QR';

    protected string $view = 'filament.pages.generate-qr-bangunan';

    public function table(Table $table): Table
    {
        return $table
            ->query(Bangunan::query())
            ->columns([
                TextColumn::make('nama_bangunan')
                    ->label('Nama Bangunan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis_bangunan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('keterangan')
                    ->searchable(),

                TextColumn::make('updated_at')
                    ->sortable(),
            ])
            ->actions([

                Action::make('status_qr')
                    ->label('Lihat QR')
                    ->icon('heroicon-o-qr-code')
                    ->color('info')
                    ->visible(fn ($record) => $record->qr_codes()->exists())
                    ->url(fn ($record) => route(
                        'bangunan.show',
                        $record->qr_codes()->first()->kode_qr
                    ))
                    ->openUrlInNewTab(),

                Action::make('print_qr')
                    ->label('Cetak QR')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->visible(fn ($record) => $record->qr_codes()->exists())
                    ->url(fn ($record) => route('bangunan.print', [
                        'kode' => $record->qr_codes()->latest()->first()->kode_qr,
                    ]))
                    ->openUrlInNewTab(),

            ])
            ->bulkActions([

                BulkAction::make('generateQr')
                    ->label('Generate QR Terpilih')
                    ->icon('heroicon-o-qr-code')
                    ->action(fn (Collection $records) => $this->generateQr($records))
                    ->deselectRecordsAfterCompletion(),

                BulkAction::make('printBulkQr')
                    ->label('Preview Cetak QR Terpilih')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->url(function (Collection $records) {
                        $codes = $records
                            ->map(fn ($r) => optional($r->qr_codes()->latest()->first())->kode_qr)
                            ->filter()
                            ->unique()
                            ->implode(',');

                        return $codes
                            ? url('/bangunan/print-bulk?codes=' . urlencode($codes))
                            : '#';
                    })
                    ->openUrlInNewTab(),
            ]);
    }

    public $selectedRecords = [];

    public $qrGeneratedIds = [];

    public function generateQr(Collection $records): void
    {
        $this->qrGeneratedIds = [];

        foreach ($records as $record) {

            $uniqueCode = 'QR-' . strtoupper(Str::random(10));
            $publicUrl  = url('/bangunan/' . $uniqueCode);

            $qrEntry = QrBangunan::updateOrCreate(
                ['bangunan_id' => $record->id], // ⬅️ KUNCI (ANTI DUPLIKAT)
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
