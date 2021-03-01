<?php

namespace Modules\Sender\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

class AdminOrderPaymentNotification extends Notification
{
    use Queueable;

    private $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hello ' . $this->order->admin->name)
                    ->line(new HtmlString('Your have received payment for the order <b>'.$this->order->order_no.'</b>. Payment detail is as below.'))
                    ->line(
                        new HtmlString(
                            '<b>Payment Status:</b> '.$this->order->payment->payment_status.'<br/>'.
                            '<b>Payment Method:</b> '.$this->order->payment->payment_method.'<br/>'.
                            '<b>Payment Date:</b> '.$this->order->payment->payment_date.'<br/>'.
                            '<b>Amount:</b> '.$this->order->payment->price_with_symbol.'<br/>'
                        )
                    )
                    ->line('You can login by clicking below button and view order.')
                    ->action('Login', route('admin.login'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
