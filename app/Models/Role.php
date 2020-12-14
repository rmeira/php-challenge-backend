<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @OA\Schema()
 */
class Role extends SpatieRole
{

    use LogsActivity, HasFactory;

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
     * Fillable tables
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name'
    ];

    /**
     * Relations
     *
     * @var array
     */
    protected $relations = [
        'permissions',
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
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     description="Description",
     *     title="Description",
     * )
     * @var string
     */
    private $description;

    /**
     * @OA\Property(
     *     description="Give permission on this role",
     *     title="Give permission on this role",
     * )
     *
     * @var integer
     */
    private $give_permission;

    /**
     * @OA\Property(
     *     description="Revoke permission on this role",
     *     title="Revoke permission on this role",
     * )
     *
     * @var integer
     */
    private $revoke_permission;

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
