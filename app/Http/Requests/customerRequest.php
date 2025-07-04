<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class customerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'nullable|string',
            'country' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'limitation_year' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
