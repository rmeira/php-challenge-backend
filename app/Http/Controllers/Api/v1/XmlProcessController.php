<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\XmlProcessRequest;
use App\Repositories\Contracts\XmlProcessRepositoryInterface;
use Illuminate\Routing\Controller;

class XmlProcessController extends Controller
{
    /**
     * Object model
     *
     * @var object
     */
    protected $xmlProcess;

    /**
     * Construction function
     *
     * @param XmlProcessRepositoryInterface $xmlProcess
     */
    public function __construct(XmlProcessRepositoryInterface $xmlProcess)
    {
        $this->xmlProcess = $xmlProcess;
        $this->middleware('permission:xml-process-index', ['only' => ['show', 'index']]);
        $this->middleware('permission:xml-process-store', ['only' => ['store']]);
        $this->middleware('permission:xml-process-update', ['only' => ['update']]);
        $this->middleware('permission:xml-process-delete', ['only' => ['destroy']]);
    }

    /**
     * @OA\Get(
     *      tags={"XmlProcess"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="xmlProcess.index",
     *      summary="XmlProcess index",
     *      security={{"token":{}}},
     *      path="/v1/xml-process",
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
     *              @OA\Schema(ref="#/components/schemas/XmlProcess"),
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
        return response()->json($this->xmlProcess->all());
    }

    /**
     * @OA\Post(
     *      tags={"XmlProcess"},
     *      operationId="xmlProcess.create",
     *      summary="XmlProcess create",
     *      security={{"token":{}}},
     *      path="/v1/xml-process",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/XmlProcess"),
     *         )
     *     ),
     *      @OA\Response(response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/XmlProcess"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="XmlProcess does not have the right permission"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error. The given data was invalid."
     *     ),
     * ),
     */
    public function store(XmlProcessRequest $request)
    {
        return response()->json($this->xmlProcess->create($request->all()));
    }

    /**
     * @OA\Get(
     *      tags={"XmlProcess"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="xmlProcess.show",
     *      summary="XmlProcess show",
     *      security={{"token":{}}},
     *      path="/v1/xml-process/{id}",
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
     *              @OA\Schema(ref="#/components/schemas/XmlProcess"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="XmlProcess does not have the right permission"
     *     ),
     * ),
     */
    public function show($id)
    {
        return response()->json($this->xmlProcess->find($id));
    }

    /**
     * @OA\Put(
     *      tags={"XmlProcess"},
     *      operationId="xmlProcess.update",
     *      summary="XmlProcess update",
     *      security={{"token":{}}},
     *      path="/v1/xml-process/{id}",
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
     *              @OA\Schema(ref="#/components/schemas/XmlProcess"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="XmlProcess does not have the right xmlProcess"
     *     )
     * ),
     */
    public function update(XmlProcessRequest $request, $id)
    {
        return response()->json($this->xmlProcess->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *      tags={"XmlProcess"},
     *      operationId="xmlProcess.destroy",
     *      summary="XmlProcess destroy",
     *      security={{"token":{}}},
     *      path="/v1/xml-process/{id}",
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
     *         description="XmlProcess does not have the right permission"
     *     )
     * ),
     */
    public function destroy($id)
    {
        return response()->json($this->xmlProcess->delete($id));
    }
}
