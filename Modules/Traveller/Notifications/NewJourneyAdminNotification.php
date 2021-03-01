<?php

namespace Modules\Traveller\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

class NewJourneyAdminNotification extends Notification
{
    use Queueable;

    private $journey;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($journey)
    {
        $this->journey = $journey;
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
                    ->greeting('Hello ' . $this->journey->admin->name)
                    ->line(new HtmlString('This email is to inform you that <b>'.$this->journey->traveller->name.'</b> has added new journey. Journey detail is as below.'))
                    ->line(
                        new HtmlString(
                            '<b>Email:</b> '.$this->journey->traveller->email.'<br/>'.
                            '<b>Phone:</b> '.$this->journey->traveller->phone.'<br/>'.
                            '<b>Departure Airport:</b> '.$this->journey->departure_airport->address.'<br/>'.
                            '<b>Destination Airport:</b> '.$this->journey->destination_airport->address.'<br/>'.
                            '<b>Pickup Date:</b> '.$this->journey->pickup_date.'<br/>'.
                            '<b>Pickup Time:</b> '.$this->journey->pickup_time.'<br/>'.
                            '<b>Weight:</b> '.$this->journey->weight.'<br/>'.
                            '<b>Price:</b> '.$this->journey->price_with_symbol.'<br/>'
                        )
                    )
                    ->line('You can login by clicking below button and view journey.')
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
