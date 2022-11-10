@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.orderTicket.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.order-tickets.update", [$orderTicket->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.orderTicket.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $orderTicket->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderTicket.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jumlah_tiket">{{ trans('cruds.orderTicket.fields.jumlah_tiket') }}</label>
                <input class="form-control {{ $errors->has('jumlah_tiket') ? 'is-invalid' : '' }}" type="number" name="jumlah_tiket" id="jumlah_tiket" value="{{ old('jumlah_tiket', $orderTicket->jumlah_tiket) }}" step="1" required>
                @if($errors->has('jumlah_tiket'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jumlah_tiket') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderTicket.fields.jumlah_tiket_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tanggal_pemesanan">{{ trans('cruds.orderTicket.fields.tanggal_pemesanan') }}</label>
                <input class="form-control date {{ $errors->has('tanggal_pemesanan') ? 'is-invalid' : '' }}" type="text" name="tanggal_pemesanan" id="tanggal_pemesanan" value="{{ old('tanggal_pemesanan', $orderTicket->tanggal_pemesanan) }}" required>
                @if($errors->has('tanggal_pemesanan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tanggal_pemesanan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderTicket.fields.tanggal_pemesanan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bukti_pembayaran">{{ trans('cruds.orderTicket.fields.bukti_pembayaran') }}</label>
                <div class="needsclick dropzone {{ $errors->has('bukti_pembayaran') ? 'is-invalid' : '' }}" id="bukti_pembayaran-dropzone">
                </div>
                @if($errors->has('bukti_pembayaran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bukti_pembayaran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderTicket.fields.bukti_pembayaran_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('valid') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="valid" value="0">
                    <input class="form-check-input" type="checkbox" name="valid" id="valid" value="1" {{ $orderTicket->valid || old('valid', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="valid">{{ trans('cruds.orderTicket.fields.valid') }}</label>
                </div>
                @if($errors->has('valid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('valid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderTicket.fields.valid_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.orderTicket.fields.status_tiket') }}</label>
                <select class="form-control {{ $errors->has('status_tiket') ? 'is-invalid' : '' }}" name="status_tiket" id="status_tiket">
                    <option value disabled {{ old('status_tiket', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\OrderTicket::STATUS_TIKET_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status_tiket', $orderTicket->status_tiket) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status_tiket'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status_tiket') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderTicket.fields.status_tiket_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.buktiPembayaranDropzone = {
    url: '{{ route('admin.order-tickets.storeMedia') }}',
    maxFilesize: 5, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').find('input[name="bukti_pembayaran"]').remove()
      $('form').append('<input type="hidden" name="bukti_pembayaran" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="bukti_pembayaran"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($orderTicket) && $orderTicket->bukti_pembayaran)
      var file = {!! json_encode($orderTicket->bukti_pembayaran) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="bukti_pembayaran" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection