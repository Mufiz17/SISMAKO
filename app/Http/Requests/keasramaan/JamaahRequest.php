<?php

namespace App\Http\Requests\keasramaan;

use Illuminate\Foundation\Http\FormRequest;

class JamaahRequest extends FormRequest
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
            // 'kelas' => 'required|string|max:10',
            'status' => 'required|array',
            'status.*' => 'in:Hadir,Sakit,Alpha',
            'nama_siswa' => 'required|array',
            'nama_siswa.*' => 'string|max:75',
            'sholat' => 'required|string|in:subuh,dzuhur,ashar,maghrib,isya',
            'path_dokumentasi' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }
}