<?php

namespace App\Http\Requests;

class ProductRequest extends ApiFormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Category ID is required',
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must be less than 100 characters',
            'description.required' => 'Description is required',
            'description.string' => 'Description must be a string',
            'description.max' => 'Description must be less than 255 characters',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'stock.required' => 'Stock is required',
            'stock.numeric' => 'Stock must be a number',
        ];
    }
}
