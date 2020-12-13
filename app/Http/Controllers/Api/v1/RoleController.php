<?php

namespace App\Http\Controllers\Api\v1;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Http\Requests\RoleRequest;
use Illuminate\Routing\Controller;

class RoleController extends Controller
{
    /**
     * Role repository
     *
     * @var $role
     */
    protected $role;

    /**
     * Role construction function
     *
     * @param RoleRepositoryInterface $role
     */
    public function __construct(RoleRepositoryInterface $role)
    {
        $this->role = $role;
        $this->middleware('permission:roles-index', ['only' => ['show', 'index']]);
        $this->middleware('permission:roles-store', ['only' => ['store']]);
        $this->middleware('permission:roles-update', ['only' => ['update']]);
        $this->middleware('permission:roles-delete', ['only' => ['destroy']]);
    }

    /**
     * @OA\Get(
     *      tags={"Role"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="roles.index",
     *      summary="Role index",
     *      security={{"token":{}}},
     *      path="/v1/roles",
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
     *     @OA\Response(response="200", description="A list of roles",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Role"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="User does not have the right permissions"
     *     )
     * ),
     */
    public function index()
    {
        return response()->json($this->role->all());
    }

    /**
     * @OA\Post(
     *      tags={"Role"},
     *      operationId="roles.create",
     *      summary="Role create",
     *      security={{"token":{}}},
     *      path="/v1/roles",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Role"),
     *         )
     *      ),
     *      @OA\Response(response="200", description="Created permission",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Role"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="User does not have the right permissions"
     *     )
     * ),
     */
    public function store(RoleRequest $request)
    {
        return response()->json($this->role->create($request->all()));
    }

    /**
     * @OA\Get(
     *      tags={"Role"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="roles.show",
     *      summary="Role show",
     *      security={{"token":{}}},
     *      path="/v1/roles/{id}",
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
     *              @OA\Schema(ref="#/components/schemas/Role"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="User does not have the right permission: roles"
     *     )
     * ),
     */
    public function show($id)
    {
        return response()->json($this->role->find($id));
    }

    /**
     * @OA\Put(
     *      tags={"Role"},
     *      operationId="roles.update",
     *      summary="Update permission",
     *      description="Returns a array of objects of roles",
     *      security={{"token":{}}},
     *      path="/v1/roles/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Role"),
     *         )
     *      ),
     *      @OA\Response(response="200", description="Updated permission",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Role"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="User does not have the right permission: roles-update"
     *     )
     * ),
     */
    public function update(RoleRequest $request, $id)
    {
        return response()->json($this->role->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *      tags={"Role"},
     *      operationId="roles.destroy",
     *      summary="Role destroy",
     *      security={{"token":{}}},
     *      path="/v1/roles/{id}",
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
     *         description="User does not have the right permissions"
     *     )
     * ),
     */
    public function destroy($id)
    {
        return response()->json($this->role->delete($id));
    }
}
