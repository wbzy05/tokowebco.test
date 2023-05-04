<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $validate = [
            'name' => ['required', 'unique:product_categories,name'],
            'created_by' => 'required'
        ];

        if($this->getMethod() == 'PUT'){
            $validate['name'] = ['required',
                Rule::unique('product_categories', 'name')->where(function ($query){
                    return $query->whereNull('deleted_at');
                })->ignore($this->product_category)
            ];
        }

        return $validate;
    }
}
