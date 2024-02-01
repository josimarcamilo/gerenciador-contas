<?php

namespace App\Http\Requests;

use App\Util\StatusExtract;
use App\Util\TypeExtract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExtractRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'budget' => 'required|date',
            'type' => ['required', 'string', Rule::in(TypeExtract::casesString())],
            'description' => 'required|string',
            'value' => 'required|integer',
            'status' => ['nullable', 'string', Rule::in(StatusExtract::casesString())],
            'category' => 'nullable|integer',
        ];
    }
}
