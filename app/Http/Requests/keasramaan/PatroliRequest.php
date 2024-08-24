<?php

namespace App\Http\Requests\keasramaan;

use Illuminate\Foundation\Http\FormRequest;

class PatroliRequest extends FormRequest
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
            'tanggal' => 'required|date',
            'area' => 'required|string|max:100',
            'status_patroli' => 'required',
        ];
    }
}