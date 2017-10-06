<?php

namespace ActivismeBE\Policies;

use ActivismeBE\SupportDesk;
use ActivismeBE\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class SupportDeskPolicy
 *
 * @author  Tim Joosten
 * @license MIT LICENSE
 * @package ActivismeBE\Policies
 */
class SupportDeskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create comments.
     *
     * @param  \ActivismeBE\SupportDesk $ticket     The ticket model in the application.
     * @return boolean
     */
    public function store(User $user, SupportDesk $ticket)
    {
        return (int) $user->id === (int) $ticket->author_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the comments.
     *
     * @param  \ActivismeBE\User         $user      The user model in the application.
     * @param  \ActivismeBE\SupportDesk  $ticket    The ticket model in the application. 
     * @return boolean
     */
    public function update(User $user, SupportDesk $ticket)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the comments.
     *
     * @param  \ActivismeBE\User        $user       The user model in the application.
     * @param  \ActivismeBE\SupportDesk $ticket     The ticket model in the application.
     * @return boolean
     */
    public function delete(User $user, SupportDesk $ticket)
    {
        return $user->hasRole('admin') || (int) $user->id === (int) $ticket->author_id;
    }
}
