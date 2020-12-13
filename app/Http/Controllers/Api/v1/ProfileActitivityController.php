<?php

namespace App\Http\Controllers\Api\v1;

use App\Repositories\Contracts\ActivityRepositoryInterface;
use Illuminate\Routing\Controller;

class ProfileActitivityController extends Controller
{
    /**
     * Activity Object
     *
     * @var object
     */
    protected $activity;

    /**
     * Constructor controller
     *
     * @param ActivityRepositoryInterface $activity
     */
    public function __construct(ActivityRepositoryInterface $activity)
    {
        $this->activity = $activity;
    }

    /**
     * @OA\Get(
     *      tags={"ProfileActivity"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="profile-activities.index",
     *      summary="ProfileActivity index",
     *      security={{"token":{}}},
     *      path="/v1/profile-activities",
     *      @OA\Response(
     *          response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/User"),
     *         )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *      ),
     * ),
     */
    public function index()
    {
        return response()->json($this->activity->authUserLogs());
    }
}
