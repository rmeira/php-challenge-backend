<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


/**
 * @OA\Schema()
 */
class People extends Model
{
    use LogsActivity, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'person_id',
    ];

    /**
     * Relations
     *
     * @var array
     */
    protected $relations = [
        'phones',
        'shiporders',
        'shiporders.items',
    ];

    /**
     * Cast attributes
     *
     * @var array
     */
    protected $casts = [
        'person_id' => 'integer'
    ];

    /**
     * Save all changes on log
     * @var boolean
     */
    protected static $logFillable = true;

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
     *     description="name",
     *     title="name",
     *     required=true
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     description="person_id",
     *     title="person_id",
     *     required=true
     * )
     *
     * @var integer
     */
    private $person_id;

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
