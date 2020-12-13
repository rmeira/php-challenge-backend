<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ActivityRepositoryInterface;
use App\Models\Activity;
use Spatie\QueryBuilder\QueryBuilder;

class ActivityRepository implements ActivityRepositoryInterface
{
    /**
     * Activity model
     * @var Activity
     */
    protected $activity;

    /**
     * ActivityRepository constructor.
     * @param Activity $activity
     */
    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Return all resources
     * @return object
     */
    public function all()
    {
        return QueryBuilder::for($this->activity)
            ->allowedFilters($this->activity->getFillable())
            ->allowedFields($this->activity->getFillable())
            ->allowedSorts($this->activity->getFillable())
            ->allowedIncludes($this->activity->getRelations())
            ->defaultSort('-created_at')
            ->limit(empty(request()->query()['limit']) ? 500 : request()->query()['limit'])
            ->get();
    }

    /**
     * Find a resource
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        return QueryBuilder::for($this->activity)
            ->allowedFields($this->activity->getFillable())
            ->allowedIncludes($this->activity->getRelations())
            ->findOrFail($id);
    }

    /**
     * Return all auth user activities
     *
     * @return mixed
     */
    public function authUserLogs()
    {
        return $this->activity->where('causer_id', auth()->user()->id)->orderBy('id', 'desc')->limit(50)->get();
    }
}
