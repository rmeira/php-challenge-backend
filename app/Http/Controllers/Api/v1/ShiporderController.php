<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ShiporderRequest;
use App\Repositories\Contracts\ShiporderRepositoryInterface;
use Illuminate\Routing\Controller;

class ShiporderController extends Controller
{
    /**
     * Object model
     *
     * @var object
     */
    protected $shiporder;

    /**
     * Construction function
     *
     * @param ShiporderRepositoryInterface $shiporder
     */
    public function __construct(ShiporderRepositoryInterface $shiporder)
    {
        $this->shiporder = $shiporder;
        $this->middleware('permission:shiporders-index', ['only' => ['show', 'index']]);
        $this->middleware('permission:shiporders-store', ['only' => ['store']]);
        $this->middleware('permission:shiporders-update', ['only' => ['update']]);
        $this->middleware('permission:shiporders-delete', ['only' => ['destroy']]);
    }

    /**
     * @OA\Get(
     *      tags={"Shiporder"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="shiporder.index",
     *      summary="Shiporder index",
     *      security={{"token":{}}},
     *      path="/v1/shiporders",
     *      @OA\Parameter(
     *         in="query",
     *         name="include",
     *         parameter="include",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="filter",
     *         parameter="filter",
     *         @OA\Schema(type="string")
     *     ),
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
     *     @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Shiporder"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     )
     * ),
     */
    public function index()
    {
        return response()->json($this->shiporder->all());
    }

    /**
     * @OA\Post(
     *      tags={"Shiporder"},
     *      operationId="shiporder.create",
     *      summary="Shiporder create",
     *      security={{"token":{}}},
     *      path="/v1/shiporders",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Shiporder"),
     *         )
     *     ),
     *      @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Shiporder"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Shiporder does not have the right permission"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error. The given data was invalid."
     *     ),
     * ),
     */
    public function store(ShiporderRequest $request)
    {
        return response()->json($this->shiporder->create($request->all()));
    }

    /**
     * @OA\Get(
     *      tags={"Shiporder"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="shiporder.show",
     *      summary="Shiporder show",
     *      security={{"token":{}}},
     *      path="/v1/shiporders/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="include",
     *         parameter="include",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="fields",
     *         parameter="fields",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Shiporder"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Shiporder does not have the right permission"
     *     ),
     * ),
     */
    public function show($id)
    {
        return response()->json($this->shiporder->find($id));
    }

    /**
     * @OA\Put(
     *      tags={"Shiporder"},
     *      operationId="shiporder.update",
     *      summary="Shiporder update",
     *      security={{"token":{}}},
     *      path="/v1/shiporders/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *      @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Shiporder"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Shiporder does not have the right shiporder"
     *     )
     * ),
     */
    public function update(ShiporderRequest $request, $id)
    {
        return response()->json($this->shiporder->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *      tags={"Shiporder"},
     *      operationId="shiporder.destroy",
     *      summary="Shiporder destroy",
     *      security={{"token":{}}},
     *      path="/v1/shiporders/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *         )
     *      ),
     *      @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *    				 @OA\Property(
     *                      property="boolean",
     *    					type="boolean",
     *    					example="true",
     *    				),
     *    			),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Shiporder does not have the right permission"
     *     )
     * ),
     */
    public function destroy($id)
    {
        return response()->json($this->shiporder->delete($id));
    }
}
