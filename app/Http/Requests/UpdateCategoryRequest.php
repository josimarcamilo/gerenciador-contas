<?php

namespace App\Http\Requests;

use App\Util\StatusExtract;
use App\Util\TypeExtract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'planned' => 'nullable|integer',
        ];
    }
}
