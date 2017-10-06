<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use ActivismeBE\User;

/**
 * Class UsersRepository
 *
 * @package ActivismeBE\Repositories
 */
class UsersRepository extends Repository
{

    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Get all the users with the role admin.
     *
     * @return mixed
     */
    public function getAdmins()
    {
        return $this->model->role('admin')->get();
    }

    /**
     * Get the pure eloquent entity from the model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function entity()
    {
        return $this->model;
    }
}