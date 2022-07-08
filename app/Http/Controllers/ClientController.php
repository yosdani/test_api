<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    /**
     * List of Client
     * @return JsonResponse
     * @OA\Get (
     *      path="/clients",
     *      tags={"Client"},
     *      summary="Get all clients",
     *      description="Returns the list of clients",
     *      @OA\Response(
     *          response=200,
     *          description="List of all  clients ",
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
        $clients = Client::paginate(10);
        return response()->json([
            'success' =>true,
            'clients'=> ClientResource::collection($clients)
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
     * Create a new client
     * @param Request $request
     * @return JsonResponse
     *  * @OA\Post (
     *      path="/clients",
     *      tags={"Client"},
     *      summary="Create a new client",
     *      description="Returns created client",
     *    @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                     property="name",
     *                     description="name of client",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="ci",
     *                     description="ci of client",
     *                     type="long"
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

        $client = Client::create($request->all());

        return response()->json($client, 200);
    }

    /**
     * Get client by id
     *
     * @param int $id
     * @return JsonResponse
     *  @OA\Put (
     *      path="/clients/{id}",
     *      tags={"Client"},
     *      summary="Get a client by id",
     *      description="Returns the client",
     *     @OA\Parameter(
     *          name="id",
     *          description="Client id",
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
     *          description="The Client not be found",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function show($id)
    {
        $client=Client::where('id', $id)->with('vehicles')->get();

        if (!$client) {
            return response()->json("This client does not exist", '404');
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
    public function update(Request $request, $id)
    {
        $parameters = $request->only(
            'name',
            'ci'

        );

        $client = Client::find($id);
        if (!$client) {
            return response()->json("This client does not exist", '400');
        }

        $client->name = $parameters['name'];
        $client->ci = $parameters['ci'];

        $client->save();

        return response()->json('updated', 200);
    }

    /**
     * Delete client by id
     *
     * @param int $id
     * @return JsonResponse
     *  @OA\Delete (
     *      path="/clients/{id}",
     *      tags={"Client"},
     *      summary="Delete a client by id",
     *      description="Returns the client",
     *     @OA\Parameter(
     *          name="id",
     *          description="Client id",
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
     *          description="This client does not exist",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function destroy($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json("This client does not exist", '400');
        }

        Client::destroy($id);
        return  response()->json('deleted', 200);
    }
}
