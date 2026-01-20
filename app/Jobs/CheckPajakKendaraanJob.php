<?php

namespace App\Jobs;

use App\Models\Kendaraan;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\PajakKendaraanMail;

class CheckPajakKendaraanJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public function handle(): void
    {
        $hariIni = Carbon::now();
        $batasHari = 30;

        $akanHabis = Kendaraan::whereDate('tgl_pajak', '>', $hariIni)
            ->whereDate('tgl_pajak', '<=', $hariIni->copy()->addDays($batasHari))
            ->get();

        $expired = Kendaraan::whereDate('tgl_pajak', '<', $hariIni)->get();

        if ($akanHabis->count() || $expired->count()) {
            Mail::to(config('mail.admin_email'))
                ->send(new PajakKendaraanMail($akanHabis, $expired));
        }
    }
}
