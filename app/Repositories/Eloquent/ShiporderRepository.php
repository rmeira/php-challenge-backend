<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ShiporderRepositoryInterface;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Shiporder;

class ShiporderRepository implements ShiporderRepositoryInterface
{
    /**
     * Shiporder model
     *
     * @var Shiporder
     */
    protected $shiporder;

    /**
     * Shiporder repository constructor
     *
     * @param Shiporder $shiporder
     */
    public function __construct(Shiporder $shiporder)
    {
        $this->shiporder = $shiporder;
    }

    /**
     * Return all resources
     * @return object
     */
    public function all()
    {
        return QueryBuilder::for($this->shiporder)
            ->allowedFilters($this->shiporder->getFillable())
            ->allowedFields($this->shiporder->getFillable())
            ->allowedSorts($this->shiporder->getFillable())
            ->allowedIncludes($this->shiporder->getRelations())
            ->get();
    }

    /**
     * Find a resource
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        return QueryBuilder::for($this->shiporder)
            ->allowedFields($this->shiporder->getFillable())
            ->allowedIncludes($this->shiporder->getRelations())
            ->findOrFail($id);
    }

    /**
     * Create a resource
     * @param array $data
     * @return mixed|object
     */
    public function create(array $data)
    {
        $shiporder = new $this->shiporder;
        $shiporder->fill($data);
        $shiporder->save();

        return $shiporder;
    }

    /**
     * Update a resource
     * @param int $id
     * @param array $data
     * @return object
     */
    public function update($id, array $data)
    {
        $shiporder = $this->shiporder->findOrFail($id);
        $shiporder->fill($data);
        $shiporder->save();

        return $shiporder;
    }

    /**
     * Delete a resource
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->shiporder->findOrFail($id)->delete();
    }
}
