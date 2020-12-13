<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\PermissionRepositoryInterface;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    /**
     * Permission model
     *
     * @var Permission
     */
    protected $permission;

    /**
     * Permission repository constructor
     *
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    /**
     * Return all permission's
     *
     * @return object
     */
    public function all()
    {
        return QueryBuilder::for($this->permission)
            ->allowedFilters($this->permission->getFillable())
            ->allowedFields($this->permission->getFillable())
            ->allowedSorts($this->permission->getFillable())
            ->allowedIncludes($this->permission->getRelations())
            ->get();
    }

    /**
     * Find a permission than return
     *
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        return QueryBuilder::for($this->permission)
            ->allowedFields($this->permission->getFillable())
            ->allowedIncludes($this->permission->getRelations())
            ->findOrFail($id);
    }

    /**
     * Create a new translate
     *
     * @param Array $data
     * @param permissionValidator $validator
     * @return Object
     */
    public function create(array $data)
    {
        $permission = new $this->permission;
        $permission->fill($data);
        $permission->save();

        return $permission;
    }

    /**
     * Create a new permission
     *
     * @param array $data
     * @return object
     */
    public function update($id, array $data)
    {
        $permission = $this->permission->findOrFail($id);
        $permission->fill($data);
        $permission->save();

        return $permission;
    }

    /**
     * Delete a resource
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->permission->findOrFail($id)->delete();
    }
}
