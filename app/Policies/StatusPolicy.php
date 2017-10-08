<?php

namespace ActivismeBE\Policies;

use ActivismeBE\User;
use ActivismeBE\Statusses;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the statusses.
     *
     * @param  \ActivismeBE\User  $user
     * @param  \ActivismeBE\Statusses  $statusses
     * @return mixed
     */
    public function view(User $user, Statusses $statusses)
    {
        //
    }

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
     * Determine whether the user can update the statusses.
     *
     * @param  \ActivismeBE\User  $user
     * @param  \ActivismeBE\Statusses  $statusses
     * @return mixed
     */
    public function update(User $user, Statusses $statusses)
    {
        //
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
        //
    }
}
