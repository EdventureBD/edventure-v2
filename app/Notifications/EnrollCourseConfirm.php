<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnrollCourseConfirm extends Notification
{
    use Queueable;

    public $data;
    public $course;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data, $course)
    {
        $this->data = $data;
        $this->course = $course;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
         return ['mail', 'database'];
       // return ['database'];
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
            ->line(auth()->user()->name . " want to buy " . $this->course->title)
            ->line('Payment Information: ')
            ->line('1. Contact: ' . $this->data['contact'])
            ->line('2. Eemail: ' . $this->data['email'])
            ->line('3. Period: ' . $this->data['month'])
            ->line('4. Method: ' . $this->data['method'])
            ->line('5. Bkash number: ' . $this->data['transectionNumber'])
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase()
    {
        return [
            'user' => auth()->user()->name,
            'email' => $this->data['email'],
            'course' => $this->course->title,
            'amount' => $this->data['amount'],
            'period' => $this->data['month'],
            'method' => $this->data['method'],
            'trx_id' => $this->data['transectionID'],
            'bkash_number' => $this->data['transectionNumber'],
            'user_number' => $this->data['contact'],
        ];
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
