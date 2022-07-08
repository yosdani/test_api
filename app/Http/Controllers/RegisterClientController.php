<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegisterClientResource;
use App\Models\RegisterClient;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RegisterClientController extends Controller
{
    /**
     * List of Register client
     * @return JsonResponse
     * @OA\Get (
     *      path="/registers",
     *      tags={"Register"},
     *      summary="Get all registers of client",
     *      description="Returns the list of registers clients",
     *      @OA\Response(
     *          response=200,
     *          description="List of all  registers clients ",
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
        $registers = RegisterClient::paginate(10);
        return response()->json([
            'success' =>true,
            'registers'=> RegisterClientResource::collection($registers)
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
     * Create a new register
     * @param Request $request
     * @return JsonResponse
     *  * @OA\Post (
     *      path="/registers",
     *      tags={"Register"},
     *      summary="Create a new register",
     *      description="Returns created register",
     *    @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                     property="vehicle_id",
     *                     description="Id of the vehicle",
     *                     type="string"
     *                 ),
     *
     *                 @OA\Property(
     *                     property="client_id",
     *                     description="ID of the client",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="date",
     *                     description="date of the register",
     *                     type="date"
     *                 ),
     *                   @OA\Property(
     *                     property="start_time",
     *                     description="start time of the register",
     *                     type="datetime"
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
    public function store(Request $request)
    {
        $register = RegisterClient::create($request->all());

        return response()->json($register, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * update a  register
     * @param Request $request
     * @return JsonResponse
     *  * @OA\Put (
     *      path="/registers",
     *      tags={"Register"},
     *      summary="Update a  register",
     *      description="Returns updated register",
     *    @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                     property="end_time",
     *                     description="end time of the register",
     *                     type="datetime"
     *                 ),
     *
     *                 @OA\Property(
     *                     property="total_time",
     *                     description="total time ",
     *                     type="float"
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
     *          description="This register does not exist"
     *      ),
     *
     * )
     */
    public function update(Request $request, $id): JsonResponse
    {
        $parameters = $request->only(
            'end_time', 'total_time'

        );

        $register = RegisterClient::find($id);
        if (!$register) {
            return response()->json("This register does not exist", '400');
        }

        $register->end_time = $parameters['end_time'];
        $register->total_time = $parameters['total_time'];
        $register->amount = $parameters['total_time']*0.5;
        $register->save();

        return response()->json('updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
