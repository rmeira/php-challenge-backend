<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\PeoplePhoneRepositoryInterface;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\PeoplePhone;

class PeoplePhoneRepository implements PeoplePhoneRepositoryInterface
{
    /**
     * PeoplePhone model
     *
     * @var PeoplePhone
     */
    protected $peoplePhone;

    /**
     * PeoplePhone repository constructor
     *
     * @param PeoplePhone $peoplePhone
     */
    public function __construct(PeoplePhone $peoplePhone)
    {
        $this->peoplePhone = $peoplePhone;
    }

    /**
     * Return all resources
     * @return object
     */
    public function all()
    {
        return QueryBuilder::for($this->peoplePhone)
            ->allowedFilters($this->peoplePhone->getFillable())
            ->allowedFields($this->peoplePhone->getFillable())
            ->allowedSorts($this->peoplePhone->getFillable())
            ->allowedIncludes($this->peoplePhone->getRelations())
            ->get();
    }

    /**
     * Find a resource
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        return QueryBuilder::for($this->peoplePhone)
            ->allowedFields($this->peoplePhone->getFillable())
            ->allowedIncludes($this->peoplePhone->getRelations())
            ->findOrFail($id);
    }

    /**
     * Create a resource
     * @param array $data
     * @return mixed|object
     */
    public function create(array $data)
    {
        $peoplePhone = new $this->peoplePhone;
        $peoplePhone->fill($data);
        $peoplePhone->save();

        return $peoplePhone;
    }

    /**
     * Update a resource
     * @param int $id
     * @param array $data
     * @return object
     */
    public function update($id, array $data)
    {
        $peoplePhone = $this->peoplePhone->findOrFail($id);
        $peoplePhone->fill($data);
        $peoplePhone->save();

        return $peoplePhone;
    }

    /**
     * Delete a resource
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->peoplePhone->findOrFail($id)->delete();
    }
}
