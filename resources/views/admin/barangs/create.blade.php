@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.barang.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.barangs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_barang">{{ trans('cruds.barang.fields.nama_barang') }}</label>
                <input class="form-control {{ $errors->has('nama_barang') ? 'is-invalid' : '' }}" type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', '') }}" required>
                @if($errors->has('nama_barang'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_barang') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.barang.fields.nama_barang_helper') }}</span>
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
                <input class="form-control {{ $errors->has('kode_barang') ? 'is-invalid' : '' }}" type="text" name="kode_barang" id="kode_barang" value="{{ old('kode_barang', '') }}" required>
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
    var uploadedGambarBarangMap = {}
Dropzone.options.gambarBarangDropzone = {
    url: '{{ route('admin.barangs.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="gambar_barang[]" value="' + response.name + '">')
      uploadedGambarBarangMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedGambarBarangMap[file.name]
      }
      $('form').find('input[name="gambar_barang[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($barang) && $barang->gambar_barang)
      var files = {!! json_encode($barang->gambar_barang) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="gambar_barang[]" value="' + file.file_name + '">')
        }
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