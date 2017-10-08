<?php

namespace ActivismeBE\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class NewUser
 *
 * @package ActivismeBE\Mail
 */
class NewUser extends Mailable
{
    use Queueable, SerializesModels;

    private $input;     /** @var mixed  $input    The given date for the newly created user.    */
    private $password;  /** @var string $password The generated password for the user.          */

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($input, $password)
    {
        $this->input    = $input;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('users.new-user-email')
            ->subject('Nieuwe login voor: ' . $this->input->name)
            ->with(['input' => $this->input, 'password' => $this->password]);
    }
}
