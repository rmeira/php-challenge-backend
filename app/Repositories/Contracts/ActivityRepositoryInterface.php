<?php

namespace App\Repositories\Contracts;

interface ActivityRepositoryInterface
{
    /**
     * Return all resources
     * @return object
     */
    public function all();

    /**
     * Find a resource
     * @param int $id
     * @return object
     */
    public function find($id);
}
