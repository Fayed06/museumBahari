<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\eventResource;

class eventController extends Controller
{
    public function getAll()
    {
        $data = event::latest()->get();
        return response()->json([eventResource::collection($data), 'event fetched.']);
    }

    public function getOnebyId($id)
    {
        $data = event::find($id);
        if (is_null($data)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new eventResource($data)]);
    }
}
