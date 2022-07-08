<?php

namespace App\Http\Controllers;

use App\Http\Resources\VehicleResource;
use App\Models\Client;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
    /**
     * List of Vehicle
     * @return JsonResponse
     * @OA\Get (
     *      path="/vehicles",
     *      tags={"Vehicle"},
     *      summary="Get all vehicles",
     *      description="Returns the list of vehicles",
     *      @OA\Response(
     *          response=200,
     *          description="List of all  vehicles ",
     *
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function index()
    {
        $vehicles = Vehicle::paginate(10);
        return response()->json([
            'success' =>true,
            'vehicles'=> VehicleResource::collection($vehicles)
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Create a new vehicle
     * @param Request $request
     * @return JsonResponse
     *  * @OA\Post (
     *      path="/vehicles",
     *      tags={"Vehicle"},
     *      summary="Create a new vehicle",
     *      description="Returns created vehicle",
     *    @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                     property="enrollment",
     *                     description="enrollment of vehicle",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="color",
     *                     description="colorof vehicle",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="client_id",
     *                     description="ID of the client",
     *                     type="string"
     *                 ),
     *                   @OA\Property(
     *                     property="vehicle_type_id",
     *                     description="ID of the vehicle Type",
     *                     type="string"
     *                 ),
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
        $vehicle = Vehicle::create($request->all());

        return response()->json($vehicle, 200);
    }

    /**
     * Get vehicle by id
     *
     * @param int $id
     * @return JsonResponse
     *  @OA\Put (
     *      path="/vehicles/{id}",
     *      tags={"Vehicle"},
     *      summary="Get a vehicle by id",
     *      description="Returns the vehicle",
     *     @OA\Parameter(
     *          name="id",
     *          description="Vehicle id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="The Vehicle not be found",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function show($id): JsonResponse
    {
        $client=Client::where('id', $id)->with('vehicles')->get();

        if (!$client) {
            return response()->json("This vehicle does not exist", '404');
        }
        return response()->json($client, 200) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): JsonResponse
    {
        $parameters = $request->only(
            'enrollment','color','client_id'

        );

        $vehicle = Vehicle::find($id);
        if (!$vehicle) {
            return response()->json("This vehicle does not exist", '400');
        }

        $vehicle->enrollment = $parameters['enrollment'];
        $vehicle->color = $parameters['color'];
        $vehicle->client_id = $parameters['client_id'];
        $vehicle->save();

        return response()->json('updated', 200);
    }

    /**
     * Delete vehicle by id
     *
     * @param int $id
     * @return JsonResponse
     *  @OA\Delete (
     *      path="/vehicles/{id}",
     *      tags={"Vehicle"},
     *      summary="Delete a vehicle by id",
     *      description="Returns the client",
     *     @OA\Parameter(
     *          name="id",
     *          description="Vehicle id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="This vehicle does not exist",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json("This vehicle does not exist", '400');
        }

        Vehicle::destroy($id);
        return  response()->json('deleted', 200);
    }
}
