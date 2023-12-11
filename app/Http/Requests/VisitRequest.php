<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitRequest extends FormRequest
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
            'site_id' => 'required|integer|exists:sites,id',
            //'client_id' => 'required|string|exists:clients,id',
            'client_id' => 'required|string',
//            'last_visit_time' => 'required|datetime',
//            'pages_visited' => 'required|json',
            'pages_visited' => 'required|string',
            'session_duration' => 'required|integer',
            'visit_count' => 'required|integer',
            'referrer' => 'required|string',
        ];
    }
}
