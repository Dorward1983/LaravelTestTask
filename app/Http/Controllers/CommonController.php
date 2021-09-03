<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\WearepentagonApiTrait;

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
    use WearepentagonApiTrait;

    /**
     * @OA\Get(
     *     path="/api/get-feed",
     *     tags={"Feed"},
     *     summary="Get feed",
     *     description="Get random test feed from api.",
     *     @OA\Response(response="200",description="ok"),
     * )
     */
    public function getFeed(): string
    {
        $response = $this->prepareData();
        if (!empty($response['model'])) {
            $response['data'] = $response['model']::saveFromApi($response['data']);
        }

        return json_encode($response);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('index');
    }
}
