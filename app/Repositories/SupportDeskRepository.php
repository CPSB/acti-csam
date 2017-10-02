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
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function assignedTickets($userId)
    {
        return $this->model->with(['author', 'status', 'category'])
            ->where('assignee_id', $userId);
    }

    /**
     * Get the support tickets bsed on labels.
     *
     * @param  array $statusLabels The array from the status labels.
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function getTickets(array $statusLabels)
    {
        $statusWhere = function ($query) use ($statusLabels) {
            foreach ($statusLabels as $key => $value) {
                $query->where(['name' => $key[0]]);
                $query->where(['name' => $key[1]]);
            }
        };

        return $this->model->with(['author', 'status' => $statusWhere, 'category']);
    }
}