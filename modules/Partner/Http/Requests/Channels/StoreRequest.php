<?php

namespace Modules\Partner\Http\Requests\Channels;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     properties={
 *          @OA\Property(property="user_id", type="integer"),
 *          @OA\Property(property="message", type="string"),
 *     }
 * )
 */
class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'message' => 'nullable',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
