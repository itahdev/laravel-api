<?php

namespace Modules\Admin\Transformers;

use App\Transformers\SuccessResource;

/**
 * @OA\Schema(
 *     properties={
 *          @OA\Property(
 *              property="meta",
 *              ref="#/components/schemas/MetaResource"
 *          ),
 *          @OA\Property(
 *              property="data",
 *              type="object",
 *              @OA\Property(property="token", type="string"),
 *              @OA\Property(property="role", type="string")
 *          )
 *     }
 * )
 */
class AuthResource extends SuccessResource
{
    // implement code
}
