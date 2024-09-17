<?php

namespace App\Http\Requests\keasramaan;

use Illuminate\Foundation\Http\FormRequest;

class LabRequest extends FormRequest
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
            'guru_id' => 'required|exists:guru,id',
            'kelas_id' => 'required|exists:data_kelas,id',
            'siswa_id' => 'required|exists:siswa,id',
            'keterangan' => 'required|string',
            'start' => 'required|date_format:H:i:s',
            'end' => 'required|date_format:H:i:s',
        ];
    }
}
