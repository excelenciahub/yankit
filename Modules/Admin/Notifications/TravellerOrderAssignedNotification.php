<?php

namespace Modules\Admin\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

class TravellerOrderAssignedNotification extends Notification
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
                    ->greeting('Hello ' . $this->order->journey->traveller->name)
                    ->line(new HtmlString('This email is to inform you that order(<b>'.$this->order->order_no.'</b>) has been assigned to you. Sender detail is as below.'))
                    ->line(
                        new HtmlString(
                            '<b>Name:</b> '.$this->order->sender->name.'<br/>'.
                            '<b>Phone:</b> '.$this->order->sender->phone.'<br/>'.
                            '<b>Pickup Date:</b> '.$this->order->pickup_date.'<br/>'.
                            '<b>Pickup Time:</b> '.$this->order->pickup_time.'<br/>'.
                            '<b>Weight:</b> '.$this->order->weights.'<br/>'.
                            '<b>Price:</b> '.$this->order->journey->price_with_symbol
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
