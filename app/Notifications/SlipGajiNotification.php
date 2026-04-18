<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class SlipGajiNotification extends Notification
{
    use Queueable;

    public $slip;

    public function __construct($slip)
    {
        $this->slip = $slip;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $periode = Carbon::createFromDate(
                $this->slip->tahun,
                $this->slip->bulan,
                1
            )
            ->locale('id')
            ->translatedFormat('F Y');

        return [
            'slip_id' => $this->slip->id,
            'bulan' => $this->slip->bulan,
            'tahun' => $this->slip->tahun,
            'total' => $this->slip->total_gaji,
            'pesan' => 'Slip gaji periode ' . $periode . ' telah tersedia.'
        ];
    }
}
