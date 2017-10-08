<?php

namespace ActivismeBE\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserBlocked extends Mailable
{
    use Queueable, SerializesModels;

    private $user;  /** @var mixed $user  The user that returned form the database. */
    private $input; /** @var mixed $input The input given from the form.            */

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $input)
    {
        $this->user  = $user;
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('users.user-blocked-email')
            ->subject('Blokkering van het account: ' . $this->user->name)
            ->with(['user' => $this->user, 'input' => $this->input]);
    }
}
