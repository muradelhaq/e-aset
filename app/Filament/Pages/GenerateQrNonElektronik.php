<?php

namespace App\Filament\Pages;

use App\Models\NonElektronik;
use App\Models\QrNonElektronik;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class GenerateQrNonElektronik extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-qr-code';

    protected static string | \UnitEnum | null $navigationGroup = 'Non Elektronik';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Generate Kode QR';

    protected static ?string $modelLabel = 'Generate Kode QR';

    protected static ?string $pluralModelLabel = 'Generate Kode QR';

    protected string $view = 'filament.pages.generate-qr-non-elektronik';

    /* ================= TABLE ================= */
    public function table(Table $table): Table
    {
        return $table
            ->query(NonElektronik::query())
            ->columns([
                TextColumn::make('jenis_barang')
                    ->label('Jenis Barang')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama_barang')
                    ->label('Nama Barang')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('merk')
                    ->searchable(),

                TextColumn::make('pemilik')
                    ->label('Pemilik'),

                TextColumn::make('updated_at')
                    ->label('Update')
                    ->dateTime(),
            ])

            /* ========== ROW ACTIONS ========== */
            ->actions([
                Action::make('status_qr')
                    ->label('Lihat QR')
                    ->icon('heroicon-o-qr-code')
                    ->color('info')
                    ->visible(fn ($record) => $record->qrCode()->exists())
                    ->url(fn ($record) => route(
                        'non-elektronik.show',
                        $record->qrCode->kode_qr
                    ))
                    ->openUrlInNewTab(),

                Action::make('print_qr')
                    ->label('Cetak QR')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->visible(fn ($record) => $record->qrCode()->exists())
                    ->url(fn ($record) => route('non-elektronik.print', [
                        'kode' => $record->qrCode->kode_qr,
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
                            ->map(fn ($r) => optional($r->qrCode)->kode_qr)
                            ->filter()
                            ->unique()
                            ->implode(',');

                        return $codes
                            ? url('/non-elektronik/print-bulk?codes=' . urlencode($codes))
                            : '#';
                    })
                    ->openUrlInNewTab(),
            ]);
    }

    /* ================= STATE ================= */
    public array $qrGeneratedIds = [];

    /* ================= LOGIC ================= */
    public function generateQr(Collection $records): void
    {
        $this->qrGeneratedIds = [];

        foreach ($records as $record) {

            $uniqueCode = 'QR-NE-' . strtoupper(Str::random(10));
            $publicUrl  = url('/non-elektronik/' . $uniqueCode);

            $qrEntry = QrNonElektronik::updateOrCreate(
                ['non_elektronik_id' => $record->id],
                [
                    'kode_qr' => $uniqueCode,
                    'url'     => $publicUrl,
                    'qr_path' => 'qrcodes/non-elektronik/' . $uniqueCode . '.png',
                ]
            );

            $this->qrGeneratedIds[] = $qrEntry->id;
        }

        $this->dispatch('qr-generated');
    }
}
