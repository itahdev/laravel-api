<?php

namespace Modules\Partner\Http\Controllers\V1;

use App\Transformers\SuccessResource;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Modules\Partner\Http\Controllers\Controller;
use Modules\Partner\Services\UserService;

class UserController extends Controller
{
    /** @var UserService */
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        parent::__construct();
    }

    /**
     * Notification test.
     *
     * @OA\Post(
     *     path="/v1/users/token",
     *     tags={"USERS"},
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
    public function token(): SuccessResource
    {
        $token = $this->userService->customFcmToken();

        return SuccessResource::make([
            'token' => $token,
        ]);
    }

    /**
     * @return SuccessResource
     */
    public function notify(): SuccessResource
    {
        $this->userService->notify();

        return SuccessResource::make([]);
    }
}
