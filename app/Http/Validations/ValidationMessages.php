<?php

namespace App\Http\Validations;

class ValidationMessages
{
    public static function memberControllerMessages()
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nama.unique' => 'Nama sudah terdaftar.',
            'nama.min' => 'Nama minimal harus terdiri dari 3 karakter.',
            'nama.max' => 'Nama maksimal terdiri dari 50 karakter.',
            'telepon.required' => 'Telepon wajib diisi.',
            'telepon.numeric' => 'Telepon harus berupa angka.',
            'telepon.unique' => 'Telepon sudah terdaftar.',
            'telepon.digits_between' => 'Telepon harus terdiri dari 10 hingga 15 digit.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.min' => 'Alamat minimal harus terdiri dari 6 karakter.',
            'alamat.max' => 'Alamat maksimal terdiri dari 300 karakter.',
        ];
    }
}

?>
