<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, LogsActivity, HasRoles, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Relations
     *
     * @var array
     */
    protected $relations = [
        'roles',
        'permissions',
        'activities'
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
     *     description="email",
     *     title="email",
     *     required=true
     * )
     *
     * @var string
     */
    private $email;

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
     * Gard name for rules and permissions
     *
     * @var string
     */
    protected $guard_name = 'api';

    /**
     * Scope for get user by email
     *
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeEmail($query, $value)
    {
        return $query->where('email', $value);
    }
}
