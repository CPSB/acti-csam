<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\SupportDesk;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class SupportDeskRepository
 *
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
}