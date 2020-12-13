<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Routing\Controller;

class ProfileRoleController extends Controller
{
    /**
     * @OA\Get(
     *      tags={"ProfileRole"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="profile-roles.index",
     *      summary="ProfileRole index",
     *      security={{"token":{}}},
     *      path="/v1/profile-roles",
     *      @OA\Response(
     *          response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Role"),
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
        return response()->json(auth()->user()->roles);
    }
}
