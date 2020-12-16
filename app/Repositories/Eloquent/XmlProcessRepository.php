<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\XmlProcessRepositoryInterface;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\XmlProcess;

class XmlProcessRepository implements XmlProcessRepositoryInterface
{
    /**
     * XmlProcess model
     *
     * @var XmlProcess
     */
    protected $xmlProcess;

    /**
     * XmlProcess repository constructor
     *
     * @param XmlProcess $xmlProcess
     */
    public function __construct(XmlProcess $xmlProcess)
    {
        $this->xmlProcess = $xmlProcess;
    }

    /**
     * Return all resources
     * @return object
     */
    public function all()
    {
        return QueryBuilder::for($this->xmlProcess)
            ->allowedFilters($this->xmlProcess->getFillable())
            ->allowedFields($this->xmlProcess->getFillable())
            ->allowedSorts($this->xmlProcess->getFillable())
            ->allowedIncludes($this->xmlProcess->getRelations())
            ->get();
    }

    /**
     * Find a resource
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        return QueryBuilder::for($this->xmlProcess)
            ->allowedFields($this->xmlProcess->getFillable())
            ->allowedIncludes($this->xmlProcess->getRelations())
            ->findOrFail($id);
    }

    /**
     * Create a resource
     * @param array $data
     * @return mixed|object
     */
    public function create(array $data)
    {
        $xmlProcess = new $this->xmlProcess;
        $xmlProcess->fill($data);
        $xmlProcess->save();

        return $xmlProcess;
    }

    /**
     * Update a resource
     * @param int $id
     * @param array $data
     * @return object
     */
    public function update($id, array $data)
    {
        $xmlProcess = $this->xmlProcess->findOrFail($id);
        $xmlProcess->fill($data);
        $xmlProcess->save();

        return $xmlProcess;
    }

    /**
     * Delete a resource
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->xmlProcess->findOrFail($id)->delete();
    }
}
