<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderTicket;
use App\Http\Resources\ticketResource;
use Validator;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreOrderTicketRequest;
use App\Http\Resources\Admin\OrderTicketResource;
use Symfony\Component\HttpFoundation\Response;


class TicketController extends Controller
{
    use MediaUploadingTrait;

    public function getAll()
    {
        $data = OrderTicket::latest()->get();
        return response()->json([ticketResource::collection($data), 'ticket fetched.']);
    }

    public function order(Request $request)
    {
        $validator = Validator::make($request->all());

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $data = OrderTicket::create();

        return response()
            ->json(['data' => $data, ]);
    }

    public function store(Request $request)
    {
        $orderTicket = OrderTicket::create($request->all());

        if ($request->input('bukti_pembayaran', false)) {
            $orderTicket->addMedia(storage_path('storage/app/public' . basename($request->input('bukti_pembayaran'))))->toMediaCollection('bukti_pembayaran');
            // $orderTicket=$request->file->store('storage/app/public');
        }
        return (new OrderTicketResource($orderTicket))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
