<?php

namespace App\Notifications;

use App\Booking;
use Illuminate\Bus\Queueable;
use App\Payment as AppPayment;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Payment extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $payment;
    protected $booking;
    public function __construct(Booking $booking, AppPayment $payment)
    {
        //
        // return $payment;
        $this->booking = $booking;
        $this->payment = $payment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return $this->payment;
        return (new MailMessage)
            ->line("Your payment for " . $this->booking->service->name . " has bee made successfully. Your booking date id " . $this->booking->date . " to " . $this->booking->end)
            ->action('Payment details', url('/user/payments/' . $this->payment->id))
            ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
