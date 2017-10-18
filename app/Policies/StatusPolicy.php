<?php

namespace ActivismeBE\Policies;

use ActivismeBE\User;
use ActivismeBE\Statusses;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class StatusPolicy
 *
 * @author  Tim Joosten
 * @license MIT license
 * @package ActivismeBE\Policies
 */
class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create statusses.
     *
     * @param  \ActivismeBE\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasrole('supervisor');
    }

    /**
     * Determine whether the user can delete the statusses.
     *
     * @param  \ActivismeBE\User  $user
     * @param  \ActivismeBE\Statusses  $statusses
     * @return mixed
     */
    public function delete(User $user, Statusses $statusses)
    {
        return $user->hasRole('supervisor') || $user->id == $statusses->author_id;
    }
}
