<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UlasanRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'feedback' => 'required',
            'rating' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
        ];
    }

    public function attributes()
    {
        return [
            'feedback' => 'Ulasan',
            'rating' => 'Rating',
        ];
    }
}
