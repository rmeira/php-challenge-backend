<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\StorageRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{

    /**
     *  @OA\Post(
     *     path="/v1/storage",
     *     tags={"Storage"},
     *     summary="Storage store",
     *     operationId="storage.store",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *    				 @OA\Property(property="file",
     *    					type="file",
     *                      required=true
     *    				),
     *                  @OA\Property(property="old_file",
     *    					type="string",
     *    					description="old_file",
     *    				),
     *    			),
     *         ),
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *    		@OA\MediaType(
     *    			mediaType="application/json",
     *    			@OA\Schema(
     *    				 @OA\Property(property="file",
     *    					type="string",
     *    					example="eyJ0eXAiOiJKV1QiLCJhbG.jpg",
     *    					description="Token"
     *    				),
     *    			),
     *    		),
     *    	),
     * )
     */
    public function store(StorageRequest $request)
    {
        $filename = $request->file->hashName();

        if (!$request->file('file')->storeAs(config('app.env') . '/', $filename)) {
            return response()->json("Houve um erro no upload", 400);
        }

        /** If has old file then delete */
        if (!empty($request->old_file)) {
            Storage::delete(config('app.env') . '/' . $request->old_file);
        }

        return response()->json($filename);
    }

    /**
     *  @OA\Get(
     *     path="/v1/storage",
     *     tags={"Storage"},
     *     summary="Storage show",
     *     operationId="storage.show",
     *     security={{"token":{}}},
     *     path="/v1/storage/{filename}",
     *     @OA\Parameter(
     *         name="filename",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */
    public function show($filename)
    {
        return storage_download($filename);
    }
}
