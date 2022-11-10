@extends('layouts.admin')
@section('content')
@can('order_ticket_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.order-tickets.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.orderTicket.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.orderTicket.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-OrderTicket">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.orderTicket.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.orderTicket.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.orderTicket.fields.jumlah_tiket') }}
                        </th>
                        <th>
                            {{ trans('cruds.orderTicket.fields.tanggal_pemesanan') }}
                        </th>
                        <th>
                            {{ trans('cruds.orderTicket.fields.bukti_pembayaran') }}
                        </th>
                        <th>
                            {{ trans('cruds.orderTicket.fields.valid') }}
                        </th>
                        <th>
                            {{ trans('cruds.orderTicket.fields.status_tiket') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderTickets as $key => $orderTicket)
                        <tr data-entry-id="{{ $orderTicket->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $orderTicket->id ?? '' }}
                            </td>
                            <td>
                                {{ $orderTicket->email ?? '' }}
                            </td>
                            <td>
                                {{ $orderTicket->jumlah_tiket ?? '' }}
                            </td>
                            <td>
                                {{ $orderTicket->tanggal_pemesanan ?? '' }}
                            </td>
                            <td>
                                @if($orderTicket->bukti_pembayaran)
                                    <a href="{{ $orderTicket->bukti_pembayaran->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                <span style="display:none">{{ $orderTicket->valid ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $orderTicket->valid ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ App\Models\OrderTicket::STATUS_TIKET_SELECT[$orderTicket->status_tiket] ?? '' }}
                            </td>
                            <td>
                                @can('order_ticket_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.order-tickets.show', $orderTicket->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('order_ticket_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.order-tickets.edit', $orderTicket->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('order_ticket_delete')
                                    <form action="{{ route('admin.order-tickets.destroy', $orderTicket->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('order_ticket_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.order-tickets.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-OrderTicket:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection