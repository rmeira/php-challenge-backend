<?php

namespace App\Http\Controllers\Api\v1;

use App\Repositories\Contracts\ActivityRepositoryInterface;
use Illuminate\Routing\Controller;

class ActivityController extends Controller
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
        $this->middleware('permission:activities-index', ['only' => ['index', 'show']]);
    }


    /**
     * @OA\Get(
     *      tags={"Activity"},
     *      operationId="activities.index",
     *      summary="Activity index",
     *      security={{"token":{}}},
     *      path="/v1/activities",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          ),
     *      ),
     *      @OA\Parameter(
     *         in="query",
     *         name="filter",
     *         parameter="filter",
     *         @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *         in="query",
     *         name="fields",
     *         parameter="fields",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="sort",
     *         parameter="sort",
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Response(
     *          response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Activity"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized"
     *     ),
     * ),
     */
    public function index()
    {
        return response()->json($this->activity->all());
    }

    /**
     * @OA\Get(
     *      tags={"Activity"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="activities.show",
     *      summary="Activity show",
     *      security={{"token":{}}},
     *      path="/v1/activities/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *      ),
     *      @OA\Parameter(
     *         in="query",
     *         name="fields",
     *         parameter="fields",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Activity"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * ),
     */
    public function show($id)
    {
        return response()->json($this->activity->find($id));
    }
}
