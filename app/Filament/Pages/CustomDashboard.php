<?php

namespace App\Filament\Pages;

use App\Models\Kendaraan;
use App\Models\Tanah;
use App\Models\Bangunan;
use App\Models\Elektronik;
use Filament\Pages\Page;
use Filament\Support\Enums\IconSize;

class CustomDashboard extends Page
{
    // Ubah baris ini agar sesuai dengan standar Filament v3/v4
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static ?string $navigationLabel = 'Dashboard Utama';

    protected static ?string $title = 'Ringkasan Aset';

    protected static ?int $navigationSort = -2;

    protected string $view = 'filament.pages.custom-dashboard';

    public function getViewData(): array
    {
        return [
            'totalKendaraan' => Kendaraan::count(),
            'totalTanah' => Tanah::count(),
            'totalBangunan' => Bangunan::count(),
            'totalElektronik' => Elektronik::count(),
        ];
    }
}
