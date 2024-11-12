<?php

return [
    'required' => 'Kolom :attribute wajib diisi.',
    'email' => 'Kolom :attribute harus berupa alamat email yang valid.',
    'numeric' => 'Kolom :attribute harus berupa angka.',
    'min' => [
        'numeric' => 'Kolom :attribute harus minimal :min.',
        'string' => 'Kolom :attribute harus terdiri dari minimal :min karakter.',
    ],
    'max' => [
        'numeric' => 'Kolom :attribute tidak boleh lebih dari :max.',
        'string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
    ],
    'integer' => 'Kolom :attribute harus berupa bilangan bulat.',
    'digits' => 'Kolom :attribute harus terdiri dari :digits digit.',
    'between' => [
        'numeric' => 'Kolom :attribute harus di antara :min dan :max.',
        'string' => 'Kolom :attribute harus di antara :min dan :max karakter.',
    ],
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    
    // Tambahkan aturan validasi lainnya
];
