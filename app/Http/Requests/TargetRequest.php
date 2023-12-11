<?php

namespace App\Http\Requests;

use App\Enum\TargetIdentifiedEnum;
use App\Enum\TargetTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TargetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'nullable|integer',
            'search_type' => ['required', Rule::in(TargetTypeEnum::getValues())],
            'identified' => ['required', Rule::in(TargetIdentifiedEnum::getValues())],
            'search_value' => 'required|string',
            'site_id' => 'required|integer|exists:sites,id',
        ];
    }
}
