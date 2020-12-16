<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\PeopleRequest;
use App\Repositories\Contracts\PeopleRepositoryInterface;
use Illuminate\Routing\Controller;

class PeopleController extends Controller
{
    /**
     * Object model
     *
     * @var object
     */
    protected $people;

    /**
     * Construction function
     *
     * @param PeopleRepositoryInterface $people
     */
    public function __construct(PeopleRepositoryInterface $people)
    {
        $this->people = $people;
        $this->middleware('permission:people-index', ['only' => ['show', 'index']]);
        $this->middleware('permission:people-store', ['only' => ['store']]);
        $this->middleware('permission:people-update', ['only' => ['update']]);
        $this->middleware('permission:people-delete', ['only' => ['destroy']]);
    }

    /**
     * @OA\Get(
     *      tags={"People"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="people.index",
     *      summary="People index",
     *      security={{"token":{}}},
     *      path="/v1/people",
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
     *              @OA\Schema(ref="#/components/schemas/People"),
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
        return response()->json($this->people->all());
    }

    /**
     * @OA\Post(
     *      tags={"People"},
     *      operationId="people.create",
     *      summary="People create",
     *      security={{"token":{}}},
     *      path="/v1/people",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/People"),
     *         )
     *     ),
     *      @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/People"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="People does not have the right permission"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error. The given data was invalid."
     *     ),
     * ),
     */
    public function store(PeopleRequest $request)
    {
        return response()->json($this->people->create($request->all()));
    }

    /**
     * @OA\Get(
     *      tags={"People"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="people.show",
     *      summary="People show",
     *      security={{"token":{}}},
     *      path="/v1/people/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the people",
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
     *              @OA\Schema(ref="#/components/schemas/People"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="People does not have the right permission"
     *     ),
     * ),
     */
    public function show($id)
    {
        return response()->json($this->people->find($id));
    }

    /**
     * @OA\Put(
     *      tags={"People"},
     *      operationId="people.update",
     *      summary="People update",
     *      security={{"token":{}}},
     *      path="/v1/people/{id}",
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
     *              @OA\Schema(ref="#/components/schemas/People"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="People does not have the right people"
     *     )
     * ),
     */
    public function update(PeopleRequest $request, $id)
    {
        return response()->json($this->people->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *      tags={"People"},
     *      operationId="people.destroy",
     *      summary="People destroy",
     *      security={{"token":{}}},
     *      path="/v1/people/{id}",
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
     *         description="People does not have the right permission"
     *     )
     * ),
     */
    public function destroy($id)
    {
        return response()->json($this->people->delete($id));
    }
}
