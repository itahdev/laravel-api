<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *  @OA\Schema(
 *     @OA\Property(
 *         property="file",
 *         type="string",
 *         format="binary"
 *     )
 * )
 */
class UploadFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'file' => 'required|mimes:jpg,png,jpeg|max:5120'
        ];
    }
}
