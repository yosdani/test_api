<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Test Documentación API",
 *      description="Endpoints de la app Test",
 *      @OA\Contact(
 *          email="ciudadana@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Endpoints de la app test"
 * )

 *
 * @OA\Tag(
 *     name="Api test",
 *     description="Endpoints de la app test"
 * )
 *  @OA\Get(
 *      path="/",
 *     description="Home page",
 *     @OA\Response(response="default", description="Welcome page")
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
