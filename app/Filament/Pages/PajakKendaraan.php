<?php

namespace App\Filament\Pages;

use App\Models\Kendaraan;
use Carbon\Carbon;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Builder;

class PajakKendaraan extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'Pajak Kendaraan';

    protected static string | \UnitEnum | null $navigationGroup = 'Kendaraan';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?int $navigationSort = 5;

    protected string $view = 'filament.pages.pajak-kendaraan';

    public int $currentMonth;
    public int $currentYear;
    public string $selectedFilter = 'all';

    public function mount(): void
    {
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
    }

    /* ====== LOGIC SAMA SEPERTI SEBELUMNYA ====== */

    public function getStatsData(): array
    {
        return [
            'total'       => Kendaraan::count(),
            'expired'     => Kendaraan::whereDate('tgl_pajak', '<', now())->count(),
            'will_expire' => Kendaraan::whereBetween('tgl_pajak', [now(), now()->addDays(7)])->count(),
            'this_month'  => Kendaraan::whereMonth('tgl_pajak', now()->month)->count(),
        ];
    }

    public function setFilter(string $filter): void
    {
        $this->selectedFilter = $filter;
    }

    public function getCurrentMonthName(): string
    {
        return Carbon::create($this->currentYear, $this->currentMonth)
            ->translatedFormat('F Y');
    }

    public function previousMonth(): void
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }

    public function nextMonth(): void
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }

    public function getCalendarData()
    {
        return Kendaraan::query()
            ->whereMonth('tgl_pajak', $this->currentMonth)
            ->whereYear('tgl_pajak', $this->currentYear)
            ->get()
            ->groupBy(fn ($item) => Carbon::parse($item->tgl_pajak)->day);
    }

    protected function getTableQuery(): Builder
    {
        return Kendaraan::query()
            ->when($this->selectedFilter === 'expired',
                fn ($q) => $q->whereDate('tgl_pajak', '<', now())
            )
            ->when($this->selectedFilter === 'will_expire',
                fn ($q) => $q->whereBetween('tgl_pajak', [now(), now()->addDays(7)])
            )
            ->when($this->selectedFilter === 'this_month',
                fn ($q) => $q->whereMonth('tgl_pajak', now()->month)
            );
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('nopol')->label('No Polisi'),
            Tables\Columns\TextColumn::make('tgl_pajak')->date(),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return Kendaraan::query()
        ->whereDate('tgl_pajak', '>=', Carbon::today())
        ->whereDate('tgl_pajak', '<=', Carbon::today()->addDays(7))
        ->count();

    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }
}
