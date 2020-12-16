<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShiporderItemRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shiporder_id' => 'integer|required',
            'title' => 'required',
            'note' => 'required',
            'quantity' => 'integer|required',
            'price' => 'numeric|required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
