<?php

namespace App\Http\Requests;

use App\Util\StatusExtract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateExtractRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'description' => 'required|string',
            'value' => 'required|integer',
            'status' => ['nullable', 'string', Rule::in(StatusExtract::casesString())],
            'category' => 'nullable|integer',
        ];
    }
}
