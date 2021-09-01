<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @group Authentication
 *
 * ###APIs for managing authentication
 *
 * Class AuthController
 * @package App\Http\Controllers\Auth
 *
 * @OA\Info(title="ToDo API", version="0.1")
 */
class CommonController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/get-feed",
     *     tags={"Feed"},
     *     summary="Get feed",
     *     description="Get random test feed from api.",
     *     @OA\Response(response="401",description="Unauthorized"),
     * )
     */
    public function getFeed() {

    }
}
