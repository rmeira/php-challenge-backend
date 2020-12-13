<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * @OA\Schema()
 */
class Permission extends SpatiePermission
{
    use LogsActivity, HasFactory;

    /**
     * Fillable tables
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relations
     *
     * @var array
     */
    protected $relations = [
        'roles',
        'activities',
        'users'
    ];

    /**
     * @OA\Property(
     *     description="ID",
     *     title="ID",
     * )
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     description="Name",
     *     title="Name",
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     description="Description",
     *     title="Description",
     * )
     *
     * @var string
     */
    private $description;

    /**
     * @OA\Property(
     *     description="Guard name",
     *     title="Guard name",
     *     default="api",
     * )
     *
     * @var string
     */
    protected $guard_name = 'api';

    /**
     * @OA\Property(
     *     format="datetime",
     *     description="Created At",
     *     title="Created At",
     * )
     *
     * @var \Datetime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     format="datetime",
     *     description="Update At",
     *     title="Update At",
     * )
     *
     * @var \Datetime
     */
    private $updated_at;

    /**
     * Save all changes on log
     * @var boolean
     */
    protected static $logFillable = true;
}
