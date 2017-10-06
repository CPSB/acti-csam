<?php

namespace ActivismeBE\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CategoryCreated extends Notification
{
    use Queueable;

    private $user; /** @var $user */

    /**
     * Create a new notification instance.
     *
     * @param  mixed $user The variable for the authencated user data.
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'avatar'  => asset($this->user->avatar),
            'message' => 'Er is een nieuwe support category aangemaakt.',
            'route'   => 'support.index'
        ];
    }
}
