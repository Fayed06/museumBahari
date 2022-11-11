<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\eventResource;

class EventController extends Controller
{
    public function getAll()
    {
        $data = event::latest()->get();
        return response()->json([
            'status' => 'success',
            'message' => 'berhasil mengambil data semua event',
            'data' => eventResource::collection($data)

        ]);
    }

    public function getOnebyId($id)
    {
        $data = event::find($id);
        if (is_null($data)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'berhasil mengambil data salah satu event',
            'data' =>  new eventResource($data)
        ]);
    }
}
