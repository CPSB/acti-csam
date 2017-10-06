<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use ActivismeBE\Priorities;

/**
 * Class PriorityRepository
 *
 * @author  Tim Joosten
 * @license MIT License
 * @package ActivismeBE\Repositories
 */
class PriorityRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Priorities::class;
    }

    /**
     * Get the base entity for the model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function entity()
    {
        return $this->model;
    }
}