<?php

namespace App\Http\Controllers\Api\V1;

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

    public function store(Request $request)
    {
        $orderTicket = OrderTicket::create($request->all());
        if ($orderTicket) {
            if ($request->hasFile('bukti_pembayaran')) {
                $orderTicket->addMediaFromRequest('bukti_pembayaran')->toMediaCollection('bukti_pembayaran');
            }
        }
        return (new OrderTicketResource($orderTicket))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
