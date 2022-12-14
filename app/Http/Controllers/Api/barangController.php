<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Http\Resources\barangResource;


class BarangController extends Controller
{
    public function getAll()
    {
        $data = Barang::latest()->get();
        return response()->json([barangResource::collection($data), 'Barang fetched.']);
    }

    public function getOnebyId($id)
    {
        $data = Barang::find($id);
        if (is_null($data)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new barangResource($data)]);
    }
    public function getOneByKode($kode_barang)
    {
        $data = Barang::find($kode_barang);
        if (is_null($data)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'berhasil mengambil data salah satu barang',
            'data' =>  new barangResource($data)
        ]);
    }
}
