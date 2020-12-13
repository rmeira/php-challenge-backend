<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ProfileNotificationController extends Controller
{
    /**
     * @OA\Get(
     *      tags={"ProfileNotification"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="profile-notifications.index",
     *      summary="ProfileNotification index",
     *      security={{"token":{}}},
     *      path="/v1/profile-notifications",
     *      @OA\Response(
     *          response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *    				 @OA\Property(property="id",
     *    					type="string",
     *    					description="Id"
     *    				),
     *    				@OA\Property(property="type",
     *    					type="string",
     *    					description="Type"
     *    				),
     *                  @OA\Property(property="notifiable_type",
     *    					type="string",
     *    					description="Notifiable Type"
     *    				),
     *                  @OA\Property(property="notifiable_id",
     *    					type="integer",
     *    					description="Notifiable Id"
     *    				),
     *                  @OA\Property(property="data",
     *    					type="object",
     *    					description="Data"
     *    				),
     *                  @OA\Property(property="read_at",
     *    					type="datetime",
     *    					description="Read At"
     *    				),
     *                  @OA\Property(property="created_at",
     *    					type="datetime",
     *    					description="Created At"
     *    				),
     *                  @OA\Property(property="updated_at",
     *    					type="datetime",
     *    					description="Updated At"
     *    				),
     *    			),
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
        return response()->json(auth()->user()->unreadNotifications);
    }

    /**
     * @OA\Get(
     *      tags={"ProfileNotification"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="profile-notifications.show",
     *      summary="ProfileNotification show",
     *      security={{"token":{}}},
     *      path="/v1/profile-notifications/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Response(
     *          response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *    				 @OA\Property(property="id",
     *    					type="string",
     *    					description="Id"
     *    				),
     *    				@OA\Property(property="type",
     *    					type="string",
     *    					description="Type"
     *    				),
     *                  @OA\Property(property="notifiable_type",
     *    					type="string",
     *    					description="Notifiable Type"
     *    				),
     *                  @OA\Property(property="notifiable_id",
     *    					type="integer",
     *    					description="Notifiable Id"
     *    				),
     *                  @OA\Property(property="data",
     *    					type="object",
     *    					description="Data"
     *    				),
     *                  @OA\Property(property="read_at",
     *    					type="datetime",
     *    					description="Read At"
     *    				),
     *                  @OA\Property(property="created_at",
     *    					type="datetime",
     *    					description="Created At"
     *    				),
     *                  @OA\Property(property="updated_at",
     *    					type="datetime",
     *    					description="Updated At"
     *    				),
     *    			),
     *         )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * ),
     */
    public function show($id)
    {
        return response()->json(auth()->user()->notifications()->findOrFail($id));
    }

    /**
     * @OA\Put(
     *      tags={"ProfileNotification"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      operationId="profile-notifications.update",
     *      summary="ProfileNotification update",
     *      security={{"token":{}}},
     *      path="/v1/profile-notifications/{id}",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the profile notification",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *    				 @OA\Property(property="id",
     *    					type="string",
     *    					description="Id"
     *    				),
     *    				@OA\Property(property="type",
     *    					type="string",
     *    					description="Type"
     *    				),
     *                  @OA\Property(property="notifiable_type",
     *    					type="string",
     *    					description="Notifiable Type"
     *    				),
     *                  @OA\Property(property="notifiable_id",
     *    					type="integer",
     *    					description="Notifiable Id"
     *    				),
     *                  @OA\Property(property="data",
     *    					type="object",
     *    					description="Data"
     *    				),
     *                  @OA\Property(property="read_at",
     *    					type="datetime",
     *    					description="Read At"
     *    				),
     *                  @OA\Property(property="created_at",
     *    					type="datetime",
     *    					description="Created At"
     *    				),
     *                  @OA\Property(property="updated_at",
     *    					type="datetime",
     *    					description="Updated At"
     *    				),
     *    			),
     *         )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *    				 @OA\Property(property="id",
     *    					type="string",
     *    					description="Id"
     *    				),
     *    				@OA\Property(property="type",
     *    					type="string",
     *    					description="Type"
     *    				),
     *                  @OA\Property(property="notifiable_type",
     *    					type="string",
     *    					description="Notifiable Type"
     *    				),
     *                  @OA\Property(property="notifiable_id",
     *    					type="integer",
     *    					description="Notifiable Id"
     *    				),
     *                  @OA\Property(property="data",
     *    					type="object",
     *    					description="Data"
     *    				),
     *                  @OA\Property(property="read_at",
     *    					type="datetime",
     *    					description="Read At"
     *    				),
     *                  @OA\Property(property="created_at",
     *    					type="datetime",
     *    					description="Created At"
     *    				),
     *                  @OA\Property(property="updated_at",
     *    					type="datetime",
     *    					description="Updated At"
     *    				),
     *    			),
     *         )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * ),
     */
    public function update(Request $request, $id)
    {
        $notification = $request->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return response()->json($notification);
    }

    /**
     * @OA\Delete(
     *      tags={"ProfileNotification"},
     *      operationId="profile-notifications.destroy",
     *      summary="ProfileNotification delete",
     *      security={{"token":{}}},
     *      path="/v1/profile-notifications/{id}",
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
     *      @OA\Response(
     *          response="200",
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
     *         response=404,
     *         description="Not Found"
     *     )
     * ),
     */
    public function destroy($id)
    {
        return response()->json(auth()->user()->notifications()->findOrFail($id)->destroy());
    }
}
