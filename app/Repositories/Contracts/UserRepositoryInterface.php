<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
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


    /**
     * Update a resource
     * @param int $id
     * @param array $data
     * @return object
     */
    public function update($id, array $data);

}
