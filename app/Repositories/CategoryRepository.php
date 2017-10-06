<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\Categories;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class CategoryRepository
 *
 * @author  Tim Joosten
 * @license MIT License
 * @package ActivismeBE\Repositories
 */
class CategoryRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Categories::class;
    }

    /**
     * Get the categories by field/value and return the entity.
     *
     * @param  string $column   The name for the database column.
     * @param  string $value    The value for the database column.
     * @return mixed
     */
    public function findCategories($column, $value)
    {
        return $this->model->where($column, $value);
    }
}