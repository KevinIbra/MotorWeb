<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Offer;

class OfferStatusUpdated extends Notification
{
    use Queueable;

    protected Offer $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $motor = $this->offer->motor;
        $title = 'Penawaran Anda ' . ucfirst($this->offer->status);

        return (new MailMessage)
            ->subject($title)
            ->greeting("Halo {$notifiable->name},")
            ->line("Penawaran Anda untuk motor: " . ($motor->maker?->name ?? '-') . ' ' . ($motor->motorModel?->name ?? '-') . " telah {$this->offer->status}.")
            ->line("Jumlah: Rp " . number_format($this->offer->amount, 0, ',', '.'))
            ->action('Lihat Penawaran', url("/offers/{$this->offer->id}"))
            ->line('Terima kasih telah menggunakan layanan kami.');
    }

    public function toDatabase($notifiable): array
    {
        $motor = $this->offer->motor;

        return [
            'offer_id' => $this->offer->id,
            'status' => $this->offer->status,
            'amount' => $this->offer->amount,
            'motor_id' => $motor->id ?? null,
            'motor_title' => ($motor->maker?->name ?? '') . ' ' . ($motor->motorModel?->name ?? ''),
            'message' => $this->offer->message,
            'url' => url("/offers/{$this->offer->id}")
        ];
    }

    public function toArray($notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}