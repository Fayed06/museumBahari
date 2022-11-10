<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreOrderTicketRequest;
use App\Http\Requests\UpdateOrderTicketRequest;
use App\Http\Resources\Admin\OrderTicketResource;
use App\Models\OrderTicket;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderTicketApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('order_ticket_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrderTicketResource(OrderTicket::all());
    }

    public function store(StoreOrderTicketRequest $request)
    {
        $orderTicket = OrderTicket::create($request->all());

        if ($request->input('bukti_pembayaran', false)) {
            $orderTicket->addMedia(storage_path('tmp/uploads/' . basename($request->input('bukti_pembayaran'))))->toMediaCollection('bukti_pembayaran');
        }

        return (new OrderTicketResource($orderTicket))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OrderTicket $orderTicket)
    {
        abort_if(Gate::denies('order_ticket_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrderTicketResource($orderTicket);
    }

    public function update(UpdateOrderTicketRequest $request, OrderTicket $orderTicket)
    {
        $orderTicket->update($request->all());

        if ($request->input('bukti_pembayaran', false)) {
            if (!$orderTicket->bukti_pembayaran || $request->input('bukti_pembayaran') !== $orderTicket->bukti_pembayaran->file_name) {
                if ($orderTicket->bukti_pembayaran) {
                    $orderTicket->bukti_pembayaran->delete();
                }
                $orderTicket->addMedia(storage_path('tmp/uploads/' . basename($request->input('bukti_pembayaran'))))->toMediaCollection('bukti_pembayaran');
            }
        } elseif ($orderTicket->bukti_pembayaran) {
            $orderTicket->bukti_pembayaran->delete();
        }

        return (new OrderTicketResource($orderTicket))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OrderTicket $orderTicket)
    {
        abort_if(Gate::denies('order_ticket_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderTicket->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
