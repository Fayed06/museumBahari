@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.review.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reviews.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.review.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="gadget_name">{{ trans('cruds.review.fields.gadget_name') }}</label>
                <input class="form-control {{ $errors->has('gadget_name') ? 'is-invalid' : '' }}" type="text" name="gadget_name" id="gadget_name" value="{{ old('gadget_name', '') }}" required>
                @if($errors->has('gadget_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gadget_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.gadget_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="overview_description">{{ trans('cruds.review.fields.overview_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('overview_description') ? 'is-invalid' : '' }}" name="overview_description" id="overview_description">{!! old('overview_description') !!}</textarea>
                @if($errors->has('overview_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('overview_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.overview_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="overview_description_image">{{ trans('cruds.review.fields.overview_description_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('overview_description_image') ? 'is-invalid' : '' }}" id="overview_description_image-dropzone">
                </div>
                @if($errors->has('overview_description_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('overview_description_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.overview_description_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="desain_description">{{ trans('cruds.review.fields.desain_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('desain_description') ? 'is-invalid' : '' }}" name="desain_description" id="desain_description">{!! old('desain_description') !!}</textarea>
                @if($errors->has('desain_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('desain_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.desain_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="design_description_image">{{ trans('cruds.review.fields.design_description_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('design_description_image') ? 'is-invalid' : '' }}" id="design_description_image-dropzone">
                </div>
                @if($errors->has('design_description_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('design_description_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.design_description_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="performa_description">{{ trans('cruds.review.fields.performa_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('performa_description') ? 'is-invalid' : '' }}" name="performa_description" id="performa_description">{!! old('performa_description') !!}</textarea>
                @if($errors->has('performa_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('performa_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.performa_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="performa_description_image">{{ trans('cruds.review.fields.performa_description_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('performa_description_image') ? 'is-invalid' : '' }}" id="performa_description_image-dropzone">
                </div>
                @if($errors->has('performa_description_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('performa_description_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.performa_description_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="layar_description">{{ trans('cruds.review.fields.layar_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('layar_description') ? 'is-invalid' : '' }}" name="layar_description" id="layar_description">{!! old('layar_description') !!}</textarea>
                @if($errors->has('layar_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('layar_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.layar_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="layar_description_image">{{ trans('cruds.review.fields.layar_description_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('layar_description_image') ? 'is-invalid' : '' }}" id="layar_description_image-dropzone">
                </div>
                @if($errors->has('layar_description_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('layar_description_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.layar_description_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="baterai_description">{{ trans('cruds.review.fields.baterai_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('baterai_description') ? 'is-invalid' : '' }}" name="baterai_description" id="baterai_description">{!! old('baterai_description') !!}</textarea>
                @if($errors->has('baterai_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('baterai_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.baterai_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="baterai_description_image">{{ trans('cruds.review.fields.baterai_description_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('baterai_description_image') ? 'is-invalid' : '' }}" id="baterai_description_image-dropzone">
                </div>
                @if($errors->has('baterai_description_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('baterai_description_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.baterai_description_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="konektivitas_description">{{ trans('cruds.review.fields.konektivitas_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('konektivitas_description') ? 'is-invalid' : '' }}" name="konektivitas_description" id="konektivitas_description">{!! old('konektivitas_description') !!}</textarea>
                @if($errors->has('konektivitas_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('konektivitas_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.konektivitas_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="konektifitas_description_image">{{ trans('cruds.review.fields.konektifitas_description_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('konektifitas_description_image') ? 'is-invalid' : '' }}" id="konektifitas_description_image-dropzone">
                </div>
                @if($errors->has('konektifitas_description_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('konektifitas_description_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.konektifitas_description_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kesimpulan">{{ trans('cruds.review.fields.kesimpulan') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('kesimpulan') ? 'is-invalid' : '' }}" name="kesimpulan" id="kesimpulan">{!! old('kesimpulan') !!}</textarea>
                @if($errors->has('kesimpulan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kesimpulan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.kesimpulan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tag_id">{{ trans('cruds.review.fields.tag') }}</label>
                <select class="form-control select2 {{ $errors->has('tag') ? 'is-invalid' : '' }}" name="tag_id" id="tag_id">
                    @foreach($tags as $id => $entry)
                        <option value="{{ $id }}" {{ old('tag_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('tag'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tag') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.tag_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="read_time">{{ trans('cruds.review.fields.read_time') }}</label>
                <input class="form-control {{ $errors->has('read_time') ? 'is-invalid' : '' }}" type="number" name="read_time" id="read_time" value="{{ old('read_time', '') }}" step="1" required>
                @if($errors->has('read_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('read_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.read_time_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.reviews.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $review->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.overviewDescriptionImageDropzone = {
    url: '{{ route('admin.reviews.storeMedia') }}',
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
      $('form').find('input[name="overview_description_image"]').remove()
      $('form').append('<input type="hidden" name="overview_description_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="overview_description_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($review) && $review->overview_description_image)
      var file = {!! json_encode($review->overview_description_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="overview_description_image" value="' + file.file_name + '">')
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
<script>
    var uploadedDesignDescriptionImageMap = {}
Dropzone.options.designDescriptionImageDropzone = {
    url: '{{ route('admin.reviews.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="design_description_image[]" value="' + response.name + '">')
      uploadedDesignDescriptionImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDesignDescriptionImageMap[file.name]
      }
      $('form').find('input[name="design_description_image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($review) && $review->design_description_image)
      var files = {!! json_encode($review->design_description_image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="design_description_image[]" value="' + file.file_name + '">')
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
<script>
    var uploadedPerformaDescriptionImageMap = {}
Dropzone.options.performaDescriptionImageDropzone = {
    url: '{{ route('admin.reviews.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="performa_description_image[]" value="' + response.name + '">')
      uploadedPerformaDescriptionImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPerformaDescriptionImageMap[file.name]
      }
      $('form').find('input[name="performa_description_image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($review) && $review->performa_description_image)
      var files = {!! json_encode($review->performa_description_image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="performa_description_image[]" value="' + file.file_name + '">')
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
<script>
    var uploadedLayarDescriptionImageMap = {}
Dropzone.options.layarDescriptionImageDropzone = {
    url: '{{ route('admin.reviews.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="layar_description_image[]" value="' + response.name + '">')
      uploadedLayarDescriptionImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedLayarDescriptionImageMap[file.name]
      }
      $('form').find('input[name="layar_description_image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($review) && $review->layar_description_image)
      var files = {!! json_encode($review->layar_description_image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="layar_description_image[]" value="' + file.file_name + '">')
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
<script>
    var uploadedBateraiDescriptionImageMap = {}
Dropzone.options.bateraiDescriptionImageDropzone = {
    url: '{{ route('admin.reviews.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="baterai_description_image[]" value="' + response.name + '">')
      uploadedBateraiDescriptionImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedBateraiDescriptionImageMap[file.name]
      }
      $('form').find('input[name="baterai_description_image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($review) && $review->baterai_description_image)
      var files = {!! json_encode($review->baterai_description_image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="baterai_description_image[]" value="' + file.file_name + '">')
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
<script>
    var uploadedKonektifitasDescriptionImageMap = {}
Dropzone.options.konektifitasDescriptionImageDropzone = {
    url: '{{ route('admin.reviews.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="konektifitas_description_image[]" value="' + response.name + '">')
      uploadedKonektifitasDescriptionImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedKonektifitasDescriptionImageMap[file.name]
      }
      $('form').find('input[name="konektifitas_description_image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($review) && $review->konektifitas_description_image)
      var files = {!! json_encode($review->konektifitas_description_image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="konektifitas_description_image[]" value="' + file.file_name + '">')
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