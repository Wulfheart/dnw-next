<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:games'],
            'variant_id' => ['required', 'string', 'exists:variants,id'],
            'phase_length' => ['integer', 'gte:5', 'required'],
            'no_adjudication' => ['array'],
            'no_adjudication.*' => ['boolean', 'accepted'],
            // 'start_when_ready' => ['boolean'],
            // 'join_phase_length' => ['required', 'gte:5', 'integer']
        ];
    }
}
