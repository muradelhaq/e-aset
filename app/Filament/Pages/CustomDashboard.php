<?php

namespace App\Filament\Pages;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Kendaraan;
use Carbon\Carbon;
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

    public function mount(): void
    {
        if (session()->get('welcome_shown') !== true) {

            Notification::make()
                ->title('Selamat Datang 👋')
                ->body('Selamat bekerja, ' . Auth::user()->name .
                    '. Semoga harimu produktif di Sistem Informasi Manajemen Aset.')
                ->icon('heroicon-o-hand-raised')
                ->iconColor('success')
                ->duration(6000)
                ->send();

            session()->put('welcome_shown', true);
        }

        $this->checkPajakKendaraan();
    }

    protected function checkPajakKendaraan(): void
    {
        $batasHari = 30; // hari sebelum expired
        $hariIni = Carbon::now();

        $kendaraanExpiring = Kendaraan::whereDate(
            'tgl_pajak',
            '<=',
            $hariIni->copy()->addDays($batasHari)
        )
        ->whereDate('tgl_pajak', '>=', $hariIni)
        ->count();

        if ($kendaraanExpiring > 0) {
            Notification::make()
                ->title('⚠️ Pajak Kendaraan Akan Habis')
                ->body("Terdapat {$kendaraanExpiring} kendaraan dengan pajak yang akan jatuh tempo dalam {$batasHari} hari.")
                ->icon('heroicon-o-exclamation-triangle')
                ->iconColor('warning')
                ->persistent()
                ->send();
        }
        $sudahExpired = Kendaraan::whereDate('tgl_pajak', '<', $hariIni)->count();

        if ($sudahExpired > 0) {
            Notification::make()
                ->title('🚨 Pajak Kendaraan Kadaluarsa')
                ->body("Terdapat {$sudahExpired} kendaraan dengan pajak yang telah melewati masa berlaku.")
                ->icon('heroicon-o-x-circle')
                ->iconColor('danger')
                ->persistent()
                ->send();
        }
    }

    public function getViewData(): array
    {
        return [
            'totalKendaraan' => Kendaraan::count(),
            'totalTanah' => Tanah::count(),
            'totalBangunan' => Bangunan::count(),
            'totalElektronik' => Elektronik::count(),

            'chartData' => [
            'labels' => ['Kendaraan', 'Tanah', 'Bangunan', 'Elektronik'],
            'values' => [
                Kendaraan::count(),
                Tanah::count(),
                Bangunan::count(),
                Elektronik::count(),
            ],
        ],
        ];
    }

}
