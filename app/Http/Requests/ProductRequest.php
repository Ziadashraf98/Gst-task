<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'=>'required|string',
            'description'=>'nullable|string',
            'price'=>'required|numeric',
            'old_price'=>'nullable|numeric',
            'image'=>'required|image',
            'images'=>'required|array',
            'category_id'=>'required|exists:categories,id',
        ];
    }
}
