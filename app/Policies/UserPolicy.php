<?php

namespace ActivismeBE\Policies;

use ActivismeBE\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user.
     *
     * @param  \ActivismeBE\User  $user
     * @param  \ActivismeBE\User  $userDb
     * @return mixed
     */
    public function view(User $user, User $userDb)
    {
        //
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \ActivismeBE\User  $userDb
     * @return mixed
     */
    public function create(User $userDb)
    {
        //
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \ActivismeBE\User  $user
     * @param  \ActivismeBE\User  $userDb
     * @return mixed
     */
    public function update(User $user, User $userDb)
    {
        //
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \ActivismeBE\User  $user
     * @param  \ActivismeBE\User  $userDb
     * @return mixed
     */
    public function delete(User $user, User $userDb)
    {
        return $user->hasRole('supoervisor') || $user->id == $userDb->id;
    }
}
