<?php

namespace Modules\Partner\Http\Controllers\V1;

use App\Transformers\SuccessResource;
use Laravel\Socialite\Facades\Socialite;
use Modules\Partner\Http\Controllers\Controller;
use Modules\Partner\Http\Requests\LoginRequest;
use Modules\Partner\Http\Requests\LoginSocialRequest;
use Modules\Partner\Repositories\Parameters\AuthLoginParam;
use Modules\Partner\Repositories\UserRepository;
use Modules\Partner\Services\AuthService;
use Modules\Partner\Transformers\AuthResource;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends Controller
{
    /** @var AuthService */
    private AuthService $authService;

    /** @var UserRepository */
    private UserRepository $userRepository;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService, UserRepository $userRepository)
    {
        $this->authService = $authService;
        $this->userRepository = $userRepository;
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
        );
        $auth = $this->authService->login($params);

        return AuthResource::make($auth);
    }

    /**
     * @param string $provider
     * @return RedirectResponse
     */
    public function redirectToProvider(string $provider): RedirectResponse
    {
        return $this->authService->redirect($provider);
    }

    /**
     * @param LoginSocialRequest $request
     * @param string             $provider
     * @return AuthResource
     */
    public function socialLogin(LoginSocialRequest $request, string $provider): AuthResource
    {
        $auth = $this->authService->socialLogin($request, $provider);

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

    public function testSql()
    {
        $this->userRepository->testQuery();
    }
}
