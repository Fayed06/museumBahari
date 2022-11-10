<?php

namespace App\Http\Controllers;

use App\Models\SubmissionLink;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index()
    {
        $data = SubmissionLink::latest()->paginate(10);
        return [
            "status" => 1,
            "data" => $data
        ];
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required',
        ]);

        $data = SubmissionLink::create($request->all());
        return [
            "status" => 1,
            "data" => $data
        ];
    }


    public function show(SubmissionLink $data)
    {
        return [
            "status" => 1,
            "data" =>$data
        ];
    }


    public function edit(SubmissionLink $data)
    {
        //
    }


    public function update(Request $request, SubmissionLink $data)
    {
        $request->validate([
            'link' => 'required',
        ]);

        $data->update($request->all());

        return [
            "status" => 1,
            "data" => $data,
            "msg" => "Data updated successfully"
        ];
    }


    public function destroy(SubmissionLink $data)
    {
        $data->delete();
        return [
            "status" => 1,
            "data" => $data,
            "msg" => "Data deleted successfully"
        ];
    }
}
