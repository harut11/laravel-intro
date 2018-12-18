<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommentAddedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;
    protected $item;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($item, $message)
    {
        $this->message = $message;
        $this->item = $item;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'/*, 'nexmo'*/];
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
                    ->greeting('You have a comment in one of Your items.')
                    ->action('View Item', route('items.show', $this->item->slug))
                    ->line($this->message);
    }

    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->to('37441226543')
            ->content('You have a new comment on your item');
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
