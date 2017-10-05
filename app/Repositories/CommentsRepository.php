<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\Comments;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class CommentsRepository
 *
 * @author  Tim Joosten
 * @license MIT License
 * @package ActivismeBE\Repositories
 */
class CommentsRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Comments::class;
    }
}