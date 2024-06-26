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
            'variant_id' => ['required', 'integer', 'exists:variants,id'],
            'phase_length' => ['integer', 'gte:5'],
            'no_adjudication' => ['array', function($attribute, $value, $fail){
                $sum = collect($value)->values()->sum();
                if($sum > 6){
                    $fail("Cannot pause on all seven days of the week");
                }
            }],
            'no_adjudication.*' => ['boolean'],
            // 'start_when_ready' => ['boolean'],
            // 'join_phase_length' => ['required', 'gte:5', 'integer']
        ];
    }
}
