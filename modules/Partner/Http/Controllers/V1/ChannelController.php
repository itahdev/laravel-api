<?php

namespace Modules\Partner\Http\Controllers\V1;

use App\Transformers\SuccessResource;
use Modules\Partner\Http\Controllers\Controller;
use Modules\Partner\Http\Requests\Channels\StoreRequest;
use Modules\Partner\Services\ChannelService;

class ChannelController extends Controller
{
    /** @var ChannelService */
    private ChannelService $channelService;

    /**
     * @param ChannelService $channelService
     */
    public function __construct(ChannelService $channelService)
    {
        $this->channelService = $channelService;
        parent::__construct();
    }

    /**
     * Notification test.
     *
     * @OA\Post(
     *     path="/v1/channels",
     *     tags={"CHANNELS"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreRequest")
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
     * @param StoreRequest $request
     * @return SuccessResource
     */
    public function store(StoreRequest $request): SuccessResource
    {
        $this->channelService->singleNotify(
            $request->input('user_id'),
            $request->input('message'),
        );

        return SuccessResource::make([]);
    }
}
