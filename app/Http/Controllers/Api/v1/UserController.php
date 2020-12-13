<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;

class UserController extends Controller
{
    /**
     * Object model
     *
     * @var object
     */
    protected $user;

    /**
     * Construction function
     *
     * @param UserRepositoryInterface $user
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
        $this->middleware('permission:users-index', ['only' => ['show', 'index']]);
        $this->middleware('permission:users-store', ['only' => ['store']]);
        $this->middleware('permission:users-update', ['only' => ['update']]);
        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
    }

    /**
     * @OA\Get(
     *      tags={"User"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="users.index",
     *      summary="User index",
     *      security={{"token":{}}},
     *      path="/v1/users",
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
     *     @OA\Response(response="200", description="A list of users",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/User"),
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
        return response()->json($this->user->all());
    }

    /**
     * @OA\Post(
     *      tags={"User"},
     *      operationId="users.create",
     *      summary="User create",
     *      security={{"token":{}}},
     *      path="/v1/users",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/User"),
     *         )
     *     ),
     *      @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/User"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="400",
     *          description="User is not found"
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="User does not have the right permission"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error. The given data was invalid."
     *     ),
     * ),
     */
    public function store(UserRequest $request)
    {
        return response()->json($this->user->create($request->all()));
    }

    /**
     * @OA\Get(
     *      tags={"User"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="users.show",
     *      summary="User show",
     *      security={{"token":{}}},
     *      path="/v1/users/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the user",
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
     *     @OA\Response(response="200", description="Return a user",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/User"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="User does not have the right permission"
     *     ),
     * ),
     */
    public function show($id)
    {
        return response()->json($this->user->find($id));
    }

    /**
     * @OA\Put(
     *      tags={"User"},
     *      operationId="user.update",
     *      summary="User update",
     *      description="Returns a array of objects of user",
     *      security={{"token":{}}},
     *      path="/v1/user/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the user",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *      @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/User"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="User does not have the right users"
     *     )
     * ),
     */
    public function update(UserRequest $request, $id)
    {
        return response()->json($this->user->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *      tags={"User"},
     *      operationId="users.destroy",
     *      summary="User destroy",
     *      security={{"token":{}}},
     *      path="/v1/users/{id}",
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
     *         description="User does not have the right permission: users-delete"
     *     )
     * ),
     */
    public function destroy($id)
    {
        return response()->json($this->user->delete($id));
    }
}
