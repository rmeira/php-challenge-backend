<?php

namespace App\Http\Controllers\Api\v1;

use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Http\Requests\PermissionRequest;
use Illuminate\Routing\Controller;

class PermissionController extends Controller
{
    /**
     * Permission repository
     *
     * @var $permission
     */
    protected $permission;

    /**
     * Permission construction function
     *
     * @param PermissionRepositoryInterface $permission
     */
    public function __construct(PermissionRepositoryInterface $permission)
    {
        $this->permission = $permission;
        $this->middleware('permission:permissions-index', ['only' => ['index', 'show']]);
        $this->middleware('permission:permissions-store', ['only' => ['store']]);
        $this->middleware('permission:permissions-update', ['only' => ['update']]);
        $this->middleware('permission:permissions-delete', ['only' => ['destroy']]);
    }

    /**
     * @OA\Get(
     *      tags={"Permission"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="permissions.index",
     *      summary="Permission index",
     *      security={{"token":{}}},
     *      path="/v1/permissions",
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
     *     @OA\Response(
     *          response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Permission"),
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
        return response()->json($this->permission->all());
    }

    /**
     * @OA\Post(
     *      tags={"Permission"},
     *      operationId="permissions.store",
     *      summary="Permission store",
     *      security={{"token":{}}},
     *      path="/v1/permissions",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Permission"),
     *         )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Permission"),
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
     *         response=422,
     *         description="Validation"
     *     )
     * ),
     */
    public function store(PermissionRequest $request)
    {
        return response()->json($this->permission->create($request->all()));
    }

    /**
     * @OA\Get(
     *      tags={"Permission"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="permissions.show",
     *      summary="Permission show",
     *      security={{"token":{}}},
     *      path="/v1/permissions/{id}",
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
     *     @OA\Response(
     *          response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Permission"),
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
        return response()->json($this->permission->find($id));
    }

    /**
     * @OA\Put(
     *      tags={"Permission"},
     *      operationId="permissions.update",
     *      summary="Permission update",
     *      security={{"token":{}}},
     *      path="/v1/permissions/{id}",
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
     *              @OA\Schema(ref="#/components/schemas/Permission"),
     *         )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Permission"),
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
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation"
     *     )
     * ),
     */
    public function update(PermissionRequest $request, $id)
    {
        return response()->json($this->permission->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *      tags={"Permission"},
     *      operationId="permissions.destroy",
     *      summary="Permission destroy",
     *      description="Delete permission",
     *      security={{"token":{}}},
     *      path="/v1/permissions/{id}",
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
     *      @OA\Response(response="200", description="Updated permission",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *    				 @OA\Property(
     *                      property="boolean",
     *    					type="boolean",
     *    					example="true",
     *    					description="If invalidation token return true"
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
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * ),
     */
    public function destroy($id)
    {
        return response()->json($this->permission->delete($id));
    }
}
