<?php

namespace App\Models;

use Spatie\Activitylog\Models\Activity as Activitylog;
use Spatie\QueryBuilder\AllowedFilter;

/**
 * @OA\Schema()
 */
class Activity extends Activitylog
{

    /**
     * Database table name
     * @var string
     */
    protected $table = 'activities';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'causer_id',
        'subject_type'
    ];

    /**
     * Casts types
     *
     * @var array
     */
    protected $casts = [
        'causer_id' => 'integer',
    ];

    /**
     * Relations
     *
     * @var array
     */
    protected $relations = [
        'causer'
    ];

    /**
     * @OA\Property(
     *     format="int64",
     *     description="ID",
     *     title="ID",
     * )
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     description="Log Name",
     *     title="Log Name",
     * )
     *
     * @var string
     */
    private $log_name;

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
     *     format="int64",
     *     description="Id from model has activity",
     *     title="Subject Id",
     * )
     *
     * @var integer
     */
    private $subject_id;

    /**
     * @OA\Property(
     *     description="Subject Type class",
     *     title="Subject Id",
     * )
     *
     * @var string
     */
    private $subject_type;

    /**
     * @OA\Property(
     *     format="int64",
     *     description="User id responsible for causer activity",
     *     title="Causer Id",
     * )
     *
     * @var integer
     */
    private $causer_id;

    /**
     * @OA\Property(
     *     description="Causer Type class from user",
     *     title="Causer Type",
     * )
     *
     * @var string
     */
    private $causer_type;

    /**
     * @OA\Property(
     *     description="Properties changes",
     *     title="Properties",
     * )
     *
     * @var string
     */
    private $properties;

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
}
