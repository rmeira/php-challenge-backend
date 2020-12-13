<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoleRepositoryInterface;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * Role model
     *
     * @var Role
     */
    protected $role;

    /**
     * Fields for query builder
     *
     * @var array
     */
    protected $fields = [
        'name',
        'guard_name',
        'description'
    ];

    /**
     * Relations
     *
     * @var array
     */
    protected $relation = ['permissions', 'activities', 'users'];

    /**
     * Role repository constructor
     *
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * Return all resources
     * @return object
     */
    public function all()
    {
        return QueryBuilder::for($this->role)
            ->allowedFilters($this->role->getFillable())
            ->allowedFields($this->role->getFillable())
            ->allowedSorts($this->role->getFillable())
            ->allowedIncludes($this->role->getRelations())
            ->get();
    }

    /**
     * Find a resource
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        return QueryBuilder::for($this->role)
            ->allowedFields($this->role->getFillable())
            ->allowedIncludes($this->role->getRelations())
            ->findOrFail($id);
    }

    /**
     * Create a resource
     * @param array $data
     * @return mixed|object
     */
    public function create(array $data)
    {
        $role = new $this->role;
        $role->fill($data);
        $role->save();

        return $role;
    }

    /**
     * Update a resource
     * @param int $id
     * @param array $data
     * @return object
     */
    public function update($id, array $data)
    {
        $role = $this->role->findOrFail($id);
        $role->fill($data);
        $role->save();

        if (!empty($data['give_permission'])) {
            $role->givePermissionTo($data['give_permission']);
        }

        if (!empty($data['revoke_permission'])) {
            $role->revokePermissionTo($data['revoke_permission']);
        }

        return $role;
    }

    /**
     * Delete a resource
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->role->findOrFail($id)->delete();
    }
}
