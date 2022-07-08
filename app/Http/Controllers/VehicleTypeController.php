<?php

namespace App\Http\Controllers;

use App\Http\Resources\VehicleTypeResource;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VehicleTypeController extends Controller
{
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',

        ]);
    }

    /**
     * List of Vehicle type
     * @return JsonResponse
     * @OA\Get (
     *      path="/vehicletype_list",
     *      tags={"Vehicle Type"},
     *      summary="Get all vehicle types",
     *      description="Returns the list of vehicle type",
     *      @OA\Response(
     *          response=200,
     *          description="List of all  vehicles types ",
     *
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function index(): JsonResponse
    {
        $types = VehicleType::paginate(10);
        return response()->json([
            'success' =>true,
            'vehicles types'=> VehicleTypeResource::collection($types)
        ], 200);
    }

    /**
     * Create a new vehicle type
     * @param Request $request
     * @return JsonResponse
     *  * @OA\Post (
     *      path="/vehicletype",
     *      tags={"Vehicle Type"},
     *      summary="Create a new vehicle Type",
     *      description="Returns created vehicleType",
     *    @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                     property="name",
     *                     description="Name of vehicle type",
     *                     type="string"
     *                 ),
     *
     *             )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $type = VehicleType::create($request->all());

        return response()->json($type, 200);
    }
}
