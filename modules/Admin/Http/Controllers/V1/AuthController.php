<?php

namespace Modules\Admin\Http\Controllers\V1;

use App\Transformers\SuccessResource;
use Modules\Admin\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\LoginRequest;
use Modules\Admin\Repositories\Parameters\AuthLoginParam;
use Modules\Admin\Services\AuthService;
use Modules\Admin\Transformers\AuthResource;

class AuthController extends Controller
{
    /** @var AuthService */
    private AuthService $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        parent::__construct();
    }

    /**
     * User login
     *
     * @OA\Post(
     *     path="/v1/login",
     *     tags={"AUTH"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent(ref="#/components/schemas/AuthResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResource"),
     *     )
     * )
     * @param LoginRequest $request
     * @return AuthResource
     */
    public function login(LoginRequest $request): AuthResource
    {
        $params = new AuthLoginParam(
            $request->input('email'),
            $request->input('password'),
            $request->input('device_name'),
        );

        $auth = $this->authService->login($params);

        return AuthResource::make($auth);
    }

    /**
     * User logout
     *
     * @OA\Post(
     *     path="/v1/logout",
     *     tags={"AUTH"},
     *     security={{"BearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResource"),
     *     )
     * )
     * @return SuccessResource
     */
    public function logout(): SuccessResource
    {
        $this->authService->logout();

        return new SuccessResource();
    }
}
