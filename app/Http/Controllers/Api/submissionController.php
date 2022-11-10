<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\SubmissionLink;

class submissionController extends Controller
{
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'link' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $link = SubmissionLink::create([
            'link' => $request->link,
        ]);


        return response()
            ->json(['data' => $link, ]);
    }
}
