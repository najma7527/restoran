<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Menentukan apakah user diizinkan membuat request ini.
     */
    public function authorize(): bool
    {
        return true; // izinkan semua user untuk mengakses form login
    }

    /**
     * Aturan validasi untuk form login.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ];
    }

    /**
     * Pesan custom (opsional).
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            
        ];
    }
}
