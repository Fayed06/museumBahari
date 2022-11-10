@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.orderTicket.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.order-tickets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.orderTicket.fields.id') }}
                        </th>
                        <td>
                            {{ $orderTicket->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderTicket.fields.email') }}
                        </th>
                        <td>
                            {{ $orderTicket->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderTicket.fields.jumlah_tiket') }}
                        </th>
                        <td>
                            {{ $orderTicket->jumlah_tiket }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderTicket.fields.tanggal_pemesanan') }}
                        </th>
                        <td>
                            {{ $orderTicket->tanggal_pemesanan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderTicket.fields.bukti_pembayaran') }}
                        </th>
                        <td>
                            @if($orderTicket->bukti_pembayaran)
                                <a href="{{ $orderTicket->bukti_pembayaran->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderTicket.fields.valid') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $orderTicket->valid ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderTicket.fields.status_tiket') }}
                        </th>
                        <td>
                            {{ App\Models\OrderTicket::STATUS_TIKET_SELECT[$orderTicket->status_tiket] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.order-tickets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection