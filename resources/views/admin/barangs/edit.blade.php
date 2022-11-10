@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.barang.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.barangs.update", [$barang->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama_barang">{{ trans('cruds.barang.fields.nama_barang') }}</label>
                <input class="form-control {{ $errors->has('nama_barang') ? 'is-invalid' : '' }}" type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                @if($errors->has('nama_barang'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_barang') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.barang.fields.nama_barang_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deskripsi_barang">{{ trans('cruds.barang.fields.deskripsi_barang') }}</label>
                <input class="form-control {{ $errors->has('deskripsi_barang') ? 'is-invalid' : '' }}" type="text" name="deskripsi_barang" id="deskripsi_barang" value="{{ old('deskripsi_barang', $barang->deskripsi_barang) }}">
                @if($errors->has('deskripsi_barang'))
                    <div class="invalid-feedback">
                        {{ $errors->first('deskripsi_barang') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.barang.fields.deskripsi_barang_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="gambar_barang">{{ trans('cruds.barang.fields.gambar_barang') }}</label>
                <div class="needsclick dropzone {{ $errors->has('gambar_barang') ? 'is-invalid' : '' }}" id="gambar_barang-dropzone">
                </div>
                @if($errors->has('gambar_barang'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gambar_barang') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.barang.fields.gambar_barang_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kode_barang">{{ trans('cruds.barang.fields.kode_barang') }}</label>
                <input class="form-control {{ $errors->has('kode_barang') ? 'is-invalid' : '' }}" type="text" name="kode_barang" id="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" required>
                @if($errors->has('kode_barang'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kode_barang') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.barang.fields.kode_barang_helper') }}</span>
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
    Dropzone.options.gambarBarangDropzone = {
    url: '{{ route('admin.barangs.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="gambar_barang"]').remove()
      $('form').append('<input type="hidden" name="gambar_barang" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="gambar_barang"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($barang) && $barang->gambar_barang)
      var file = {!! json_encode($barang->gambar_barang) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="gambar_barang" value="' + file.file_name + '">')
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