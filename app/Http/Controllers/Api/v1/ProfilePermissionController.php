<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Routing\Controller;

class ProfilePermissionController extends Controller
{
    /**
     * @OA\Get(
     *      tags={"ProfilePermission"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="profile-permissions.index",
     *      summary="ProfilePermission index",
     *      security={{"token":{}}},
     *      path="/v1/profile-permissions",
     *      @OA\Response(response="200", description="ProfilePermission from user authentication",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/Permission"),
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
        return response()->json(auth()->user()->getAllPermissions());
    }
}
