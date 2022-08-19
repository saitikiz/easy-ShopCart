<?php

namespace App\Http\Requests;

use App\Models\Cart;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCartRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cart_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'status' => [
                'string',
                'required',
            ],
        ];
    }
}
