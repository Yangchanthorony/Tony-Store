<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class employeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'section' => 'required|string|max:255',
            'staff' => 'integer',
            // Add other validation rules as needed
        ];
    }
}
