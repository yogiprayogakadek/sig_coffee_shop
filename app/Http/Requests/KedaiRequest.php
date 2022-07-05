<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class KedaiRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'nama_kedai' => 'required',
            'alamat_kedai' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'deskripsi' => 'required',
        ];

        if(!Request::instance()->has('id_kedai')) {
            $rules += [
                'foto' => 'required',
                'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        } else {
            $rules += [
                'foto' => 'nullable',
                'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah tersedia',
            'numeric' => ':attribute harus berupa angka',
            'image' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berupa gambar',
            'max' => ':attribute tidak boleh lebih dari 2MB',
        ];
    }

    public function attributes()
    {
        $attr = [
            'nama_kedai' => 'Nama Kedai',
            'alamat_kedai' => 'Alamat Kedai',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'deskripsi' => 'Deskripsi',
            'foto' => 'Foto',
        ];

        return $attr;
    }
}
