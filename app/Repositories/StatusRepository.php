<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use ActivismeBE\Statusses;

/**
 * Class StatusRepository
 *
 * @author  Tim Joosten
 * @license MIT License
 * @package ActivismeBE\Repositories
 */
class StatusRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Statusses::class;
    }

    /**
     * Get all the statuses for the support tickets.
     *
     * @return $this
     */
    public function getStatuses()
    {
        return $this->model->with(['author']);
    }
}