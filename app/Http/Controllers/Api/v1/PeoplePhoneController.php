<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\PeoplePhoneRequest;
use App\Repositories\Contracts\PeoplePhoneRepositoryInterface;
use Illuminate\Routing\Controller;

class PeoplePhoneController extends Controller
{
    /**
     * Object model
     *
     * @var object
     */
    protected $peoplePhone;

    /**
     * Construction function
     *
     * @param PeoplePhoneRepositoryInterface $peoplePhone
     */
    public function __construct(PeoplePhoneRepositoryInterface $peoplePhone)
    {
        $this->peoplePhone = $peoplePhone;
        $this->middleware('permission:people-phones-index', ['only' => ['show', 'index']]);
        $this->middleware('permission:people-phones-store', ['only' => ['store']]);
        $this->middleware('permission:people-phones-update', ['only' => ['update']]);
        $this->middleware('permission:people-phones-delete', ['only' => ['destroy']]);
    }

    /**
     * @OA\Get(
     *      tags={"PeoplePhone"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="peoplePhone.index",
     *      summary="PeoplePhone index",
     *      security={{"token":{}}},
     *      path="/v1/people-phones",
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
     *              @OA\Schema(ref="#/components/schemas/PeoplePhone"),
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
        return response()->json($this->peoplePhone->all());
    }

    /**
     * @OA\Post(
     *      tags={"PeoplePhone"},
     *      operationId="peoplePhone.create",
     *      summary="PeoplePhone create",
     *      security={{"token":{}}},
     *      path="/v1/people-phones",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/PeoplePhone"),
     *         )
     *     ),
     *      @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/PeoplePhone"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="PeoplePhone does not have the right permission"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error. The given data was invalid."
     *     ),
     * ),
     */
    public function store(PeoplePhoneRequest $request)
    {
        return response()->json($this->peoplePhone->create($request->all()));
    }

    /**
     * @OA\Get(
     *      tags={"PeoplePhone"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="peoplePhone.show",
     *      summary="PeoplePhone show",
     *      security={{"token":{}}},
     *      path="/v1/people-phones/{id}",
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
     *              @OA\Schema(ref="#/components/schemas/PeoplePhone"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="PeoplePhone does not have the right permission"
     *     ),
     * ),
     */
    public function show($id)
    {
        return response()->json($this->peoplePhone->find($id));
    }

    /**
     * @OA\Put(
     *      tags={"PeoplePhone"},
     *      operationId="peoplePhone.update",
     *      summary="PeoplePhone update",
     *      security={{"token":{}}},
     *      path="/v1/people-phones/{id}",
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
     *              @OA\Schema(ref="#/components/schemas/PeoplePhone"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="PeoplePhone does not have the right peoplePhone"
     *     )
     * ),
     */
    public function update(PeoplePhoneRequest $request, $id)
    {
        return response()->json($this->peoplePhone->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *      tags={"PeoplePhone"},
     *      operationId="peoplePhone.destroy",
     *      summary="PeoplePhone destroy",
     *      security={{"token":{}}},
     *      path="/v1/people-phones/{id}",
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
     *         description="PeoplePhone does not have the right permission"
     *     )
     * ),
     */
    public function destroy($id)
    {
        return response()->json($this->peoplePhone->delete($id));
    }
}
