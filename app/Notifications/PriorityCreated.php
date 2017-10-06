<?php

namespace ActivismeBE\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class PriorityCreated
 *
 * @author  Tim Joosten
 * @license
 * @package ActivismeBE\Notifications
 */
class PriorityCreated extends Notification
{
    use Queueable;

    private $user; /** @var $user */

    /**
     * Create a new notification instance.
     *
     * @param  mixed $user The data for the currently authencated user.
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
            'message' => 'Er is een nieuwe support priority aangemaakt.',
            'route'   => 'support.index'
        ];
    }
}
