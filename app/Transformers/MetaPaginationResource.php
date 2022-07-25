<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @OA\Schema(
 *     properties={
 * @OA\Property(property="code", type="integer"),
 * @OA\Property(property="message", type="string"),
 * @OA\Property(property="errors", type="object"),
 * @OA\Property(property="pagination", type="object"),
 * @OA\Property(property="total", type="integer"),
 * @OA\Property(property="count", type="integer"),
 * @OA\Property(property="per_page", type="integer"),
 * @OA\Property(property="current_page", type="integer"),
 * @OA\Property(property="total_pages", type="integer")
 *     }
 * )
 */
class MetaPaginationResource extends JsonResource
{
    /**
     * @var int
     */
    public int $code;

    /**
     * @var string
     */
    public string $message;

    /**
     * @var array|null
     */
    public ?array $errors;

    /**
     * @var array|null
     */
    public ?array $pagination;


    /**
     * MetaResource constructor.
     * @param int        $code
     * @param string     $message
     * @param null       $errors
     * @param array|null $pagination
     */
    public function __construct(int $code, string $message, $errors = null, ?array $pagination = null)
    {
        $this->code = $code;
        $this->message = $message;
        $this->pagination = $pagination;
        $this->errors = $errors;
        parent::__construct($errors);
    }

    /**
     * @param        $request
     * @param int    $code
     * @param string $message
     * @param null   $errors
     * @param null   $pagination
     * @return array
     */
    public static function makeResponse($request, int $code, string $message, $errors = null, $pagination = null): array
    {
        return (new MetaPaginationResource($code, $message, $errors, $pagination))->toArray($request);
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $arr = [
            "code" => $this->code,
            "message" => $this->message,
        ];

        if ($this->errors !== null) {
            $arr['errors'] = $this->errors;
        }

        if ($this->pagination !== null) {
            $arr['pagination'] = $this->pagination;
        }

        return $arr;
    }
}
