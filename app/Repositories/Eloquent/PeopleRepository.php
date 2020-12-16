<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\PeopleRepositoryInterface;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\People;

class PeopleRepository implements PeopleRepositoryInterface
{
    /**
     * People model
     *
     * @var People
     */
    protected $people;

    /**
     * People repository constructor
     *
     * @param People $people
     */
    public function __construct(People $people)
    {
        $this->people = $people;
    }

    /**
     * Return all resources
     * @return object
     */
    public function all()
    {
        return QueryBuilder::for($this->people)
            ->allowedFilters($this->people->getFillable())
            ->allowedFields($this->people->getFillable())
            ->allowedSorts($this->people->getFillable())
            ->allowedIncludes($this->people->getRelations())
            ->get();
    }

    /**
     * Find a resource
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        return QueryBuilder::for($this->people)
            ->allowedFields($this->people->getFillable())
            ->allowedIncludes($this->people->getRelations())
            ->findOrFail($id);
    }

    /**
     * Create a resource
     * @param array $data
     * @return mixed|object
     */
    public function create(array $data)
    {
        $people = new $this->people;
        $people->fill($data);
        $people->save();

        return $people;
    }

    /**
     * Update a resource
     * @param int $id
     * @param array $data
     * @return object
     */
    public function update($id, array $data)
    {
        $people = $this->people->findOrFail($id);
        $people->fill($data);
        $people->save();

        return $people;
    }

    /**
     * Delete a resource
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->people->findOrFail($id)->delete();
    }
}
