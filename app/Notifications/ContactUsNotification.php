<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ContactUsNotification extends Notification
{
    use Queueable;

    private $request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
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
        return (new MailMessage)
                    ->greeting('Hello ' . $this->request->admin->name)
                    ->line(new HtmlString('Your have received new contact request as below.'))
                    ->line(
                        new HtmlString(
                            '<b>First Name:</b> '.$this->request->first_name.'<br/>'.
                            '<b>Last Name:</b> '.$this->request->last_name.'<br/>'.
                            '<b>Email:</b> '.$this->request->email.'<br/>'.
                            '<b>Phone:</b> '.$this->request->phone.'<br/>'.
                            '<b>Message:</b> '.$this->request->message.'<br/>'
                        )
                    )
                    ->line('Thank you for using our application!');
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
