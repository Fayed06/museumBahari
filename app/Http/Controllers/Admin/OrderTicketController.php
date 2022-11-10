<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOrderTicketRequest;
use App\Http\Requests\StoreOrderTicketRequest;
use App\Http\Requests\UpdateOrderTicketRequest;
use App\Models\OrderTicket;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class OrderTicketController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('order_ticket_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderTickets = OrderTicket::with(['media'])->get();

        return view('admin.orderTickets.index', compact('orderTickets'));
    }

    public function create()
    {
        abort_if(Gate::denies('order_ticket_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.orderTickets.create');
    }

    public function store(StoreOrderTicketRequest $request)
    {
        $orderTicket = OrderTicket::create($request->all());

        if ($request->input('bukti_pembayaran', false)) {
            $orderTicket->addMedia(storage_path('tmp/uploads/' . basename($request->input('bukti_pembayaran'))))->toMediaCollection('bukti_pembayaran');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $orderTicket->id]);
        }

        return redirect()->route('admin.order-tickets.index');
    }

    public function edit(OrderTicket $orderTicket)
    {
        abort_if(Gate::denies('order_ticket_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.orderTickets.edit', compact('orderTicket'));
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

        return redirect()->route('admin.order-tickets.index');
    }

    public function show(OrderTicket $orderTicket)
    {
        abort_if(Gate::denies('order_ticket_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.orderTickets.show', compact('orderTicket'));
    }

    public function destroy(OrderTicket $orderTicket)
    {
        abort_if(Gate::denies('order_ticket_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderTicket->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderTicketRequest $request)
    {
        OrderTicket::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('order_ticket_create') && Gate::denies('order_ticket_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new OrderTicket();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
