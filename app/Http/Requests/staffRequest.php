<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class staffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
              'name' => 'required|string|max:255',
            // 'position' => 'required|string|max:255',
            'gender' => 'nullable|string|max:20',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // ✅ Corrected rule
              'section_id' => ['required', 'exists:employees,id'],

        ];
    }
    
    
}
