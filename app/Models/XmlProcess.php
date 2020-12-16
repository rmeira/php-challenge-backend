<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


/**
 * @OA\Schema()
 */
class XmlProcess extends Model
{
    use LogsActivity, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file',
        'table',
        'processed',
        'errors',
        'processed_at',
        'details',
    ];

    /**
     * Cast attributes
     *
     * @var array
     */
    protected $casts = [
        'processed' => 'boolean',
        'errors' => 'boolean',
    ];

    /**
     * Dates cast
     *
     * @var array
     */
    protected $dates = [
        'processed_at'
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
     *     description="address",
     *     title="address",
     *     required=true
     * )
     *
     * @var string
     */
    private $address;


    /**
     * @OA\Property(
     *     description="city",
     *     title="city",
     *     required=true
     * )
     *
     * @var string
     */
    private $city;


    /**
     * @OA\Property(
     *     description="country",
     *     title="country",
     *     required=true
     * )
     *
     * @var string
     */
    private $country;

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
