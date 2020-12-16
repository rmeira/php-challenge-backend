<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ShiporderItemRepositoryInterface;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\ShiporderItem;

class ShiporderItemRepository implements ShiporderItemRepositoryInterface
{
    /**
     * ShiporderItem model
     *
     * @var ShiporderItem
     */
    protected $shiporderItem;

    /**
     * ShiporderItem repository constructor
     *
     * @param ShiporderItem $shiporderItem
     */
    public function __construct(ShiporderItem $shiporderItem)
    {
        $this->shiporderItem = $shiporderItem;
    }

    /**
     * Return all resources
     * @return object
     */
    public function all()
    {
        return QueryBuilder::for($this->shiporderItem)
            ->allowedFilters($this->shiporderItem->getFillable())
            ->allowedFields($this->shiporderItem->getFillable())
            ->allowedSorts($this->shiporderItem->getFillable())
            ->allowedIncludes($this->shiporderItem->getRelations())
            ->get();
    }

    /**
     * Find a resource
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        return QueryBuilder::for($this->shiporderItem)
            ->allowedFields($this->shiporderItem->getFillable())
            ->allowedIncludes($this->shiporderItem->getRelations())
            ->findOrFail($id);
    }

    /**
     * Create a resource
     * @param array $data
     * @return mixed|object
     */
    public function create(array $data)
    {
        $shiporderItem = new $this->shiporderItem;
        $shiporderItem->fill($data);
        $shiporderItem->save();

        return $shiporderItem;
    }

    /**
     * Update a resource
     * @param int $id
     * @param array $data
     * @return object
     */
    public function update($id, array $data)
    {
        $shiporderItem = $this->shiporderItem->findOrFail($id);
        $shiporderItem->fill($data);
        $shiporderItem->save();

        return $shiporderItem;
    }

    /**
     * Delete a resource
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->shiporderItem->findOrFail($id)->delete();
    }
}
