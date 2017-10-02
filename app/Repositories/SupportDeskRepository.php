<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\SupportDesk;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class SupportDeskRepository
 *
 * @author  Tim Joosten
 * @license MIT License
 * @package ActivismeBE\Repositories
 */
class SupportDeskRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return SupportDesk::class;
    }

    /**
     * Get all the support tickets for the authenticated user.
     *
     * @param  integer $userId The id from the authenticated user.
     * @return $this
     */
    public function assignedTickets($userId)
    {
        $relations = ['author', 'status', 'category'];

        return $this->model->with($relations)
            ->where('assignee_id', $userId);
    }
}