<?php

namespace App\Http\Requests;

use App\Models\Barang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBarangRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('barang_edit');
    }

    public function rules()
    {
        return [
            'nama_barang' => [
                'string',
                'required',
            ],
            'gambar_barang' => [
                'array',
                'required',
            ],
            'gambar_barang.*' => [
                'required',
            ],
            'kode_barang' => [
                'string',
                'required',
                'unique:barangs,kode_barang,' . request()->route('barang')->id,
            ],
        ];
    }
}
