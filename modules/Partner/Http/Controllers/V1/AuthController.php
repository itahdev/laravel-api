<?php

namespace Modules\Partner\Http\Controllers\V1;

use Modules\Partner\Http\Controllers\Controller;
use Modules\Partner\Http\Requests\LoginRequest;
use Modules\Partner\Repositories\Parameters\AuthLoginParam;
use Modules\Partner\Services\AuthService;
use Modules\Partner\Transformers\AuthResource;

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
        );
        $auth = $this->authService->login($params);

        return AuthResource::make($auth);
    }
}
