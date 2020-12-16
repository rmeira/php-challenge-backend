<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ShiporderItemRequest;
use App\Repositories\Contracts\ShiporderItemRepositoryInterface;
use Illuminate\Routing\Controller;

class ShiporderItemController extends Controller
{
    /**
     * Object model
     *
     * @var object
     */
    protected $shiporderItem;

    /**
     * Construction function
     *
     * @param ShiporderItemRepositoryInterface $shiporderItem
     */
    public function __construct(ShiporderItemRepositoryInterface $shiporderItem)
    {
        $this->shiporderItem = $shiporderItem;
        $this->middleware('permission:shiporder-item-index', ['only' => ['show', 'index']]);
        $this->middleware('permission:shiporder-item-store', ['only' => ['store']]);
        $this->middleware('permission:shiporder-item-update', ['only' => ['update']]);
        $this->middleware('permission:shiporder-item-delete', ['only' => ['destroy']]);
    }

    /**
     * @OA\Get(
     *      tags={"ShiporderItem"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="shiporderItem.index",
     *      summary="ShiporderItem index",
     *      security={{"token":{}}},
     *      path="/v1/shiporder-item",
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
     *              @OA\Schema(ref="#/components/schemas/ShiporderItem"),
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
        return response()->json($this->shiporderItem->all());
    }

    /**
     * @OA\Post(
     *      tags={"ShiporderItem"},
     *      operationId="shiporderItem.create",
     *      summary="ShiporderItem create",
     *      security={{"token":{}}},
     *      path="/v1/shiporder-item",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/ShiporderItem"),
     *         )
     *     ),
     *      @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/ShiporderItem"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="ShiporderItem does not have the right permission"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error. The given data was invalid."
     *     ),
     * ),
     */
    public function store(ShiporderItemRequest $request)
    {
        return response()->json($this->shiporderItem->create($request->all()));
    }

    /**
     * @OA\Get(
     *      tags={"ShiporderItem"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="shiporderItem.show",
     *      summary="ShiporderItem show",
     *      security={{"token":{}}},
     *      path="/v1/shiporder-item/{id}",
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
     *              @OA\Schema(ref="#/components/schemas/ShiporderItem"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="ShiporderItem does not have the right permission"
     *     ),
     * ),
     */
    public function show($id)
    {
        return response()->json($this->shiporderItem->find($id));
    }

    /**
     * @OA\Put(
     *      tags={"ShiporderItem"},
     *      operationId="shiporderItem.update",
     *      summary="ShiporderItem update",
     *      security={{"token":{}}},
     *      path="/v1/shiporder-item/{id}",
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
     *              @OA\Schema(ref="#/components/schemas/ShiporderItem"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="ShiporderItem does not have the right shiporderItem"
     *     )
     * ),
     */
    public function update(ShiporderItemRequest $request, $id)
    {
        return response()->json($this->shiporderItem->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *      tags={"ShiporderItem"},
     *      operationId="shiporderItem.destroy",
     *      summary="ShiporderItem destroy",
     *      security={{"token":{}}},
     *      path="/v1/shiporder-item/{id}",
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
     *         description="ShiporderItem does not have the right permission"
     *     )
     * ),
     */
    public function destroy($id)
    {
        return response()->json($this->shiporderItem->delete($id));
    }
}
