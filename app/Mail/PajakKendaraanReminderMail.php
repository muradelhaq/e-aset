<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PajakKendaraanReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $akanExpired;
    public $sudahExpired;

    public function __construct($akanExpired, $sudahExpired)
    {
        $this->akanExpired = $akanExpired;
        $this->sudahExpired = $sudahExpired;
    }

    public function build()
    {
        return $this->subject('Notifikasi Pajak Kendaraan')
            ->view('emails.pajak-kendaraan');
    }
}

