<?php

namespace Modules\Sender\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

class NewOrderSenderNotification extends Notification
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
                    ->greeting('Hello ' . $this->order->sender->name)
                    ->line(new HtmlString('This email is to inform you that you have added new order. Order detail is as below.'))
                    ->line(
                        new HtmlString(
                            '<b>Departure Airport:</b> '.$this->order->departure_airport->address.'<br/>'.
                            '<b>Destination Airport:</b> '.$this->order->destination_airport->address.'<br/>'.
                            '<b>Pickup Date:</b> '.$this->order->pickup_date.'<br/>'.
                            '<b>Pickup Time:</b> '.$this->order->pickup_time.'<br/>'.
                            '<b>Weight:</b> '.$this->order->weights.'<br/>'.
                            '<b>Price:</b> '.$this->order->price_with_symbol.'<br/>'
                        )
                    )
                    ->line('You can login by clicking below button and view your order.')
                    ->action('Login', route('login'))
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
