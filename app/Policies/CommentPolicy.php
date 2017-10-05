<?php

namespace ActivismeBE\Policies;

use ActivismeBE\User;
use ActivismeBE\Comments;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the comments.
     *
     * @param  \ActivismeBE\User  $user
     * @param  \ActivismeBE\Comments  $comments
     * @return mixed
     */
    public function view(User $user, Comments $comments)
    {
        //
    }

    /**
     * Determine whether the user can create comments.
     *
     * @param  \ActivismeBE\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the comments.
     *
     * @param  \ActivismeBE\User  $user
     * @param  \ActivismeBE\Comments  $comments
     * @return mixed
     */
    public function update(User $user, Comments $comments)
    {
        //
    }

    /**
     * Determine whether the user can delete the comments.
     *
     * @param  \ActivismeBE\User      $user
     * @param  \ActivismeBE\Comments  $comments
     * @return mixed
     */
    public function delete(User $user, Comments $comments)
    {
        return $user->id == $comments->author_id;
    }
}
