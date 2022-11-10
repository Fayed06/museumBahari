@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.review.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reviews.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.id') }}
                        </th>
                        <td>
                            {{ $review->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.title') }}
                        </th>
                        <td>
                            {{ $review->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.gadget_name') }}
                        </th>
                        <td>
                            {{ $review->gadget_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.overview_description') }}
                        </th>
                        <td>
                            {!! $review->overview_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.overview_description_image') }}
                        </th>
                        <td>
                            @if($review->overview_description_image)
                                <a href="{{ $review->overview_description_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $review->overview_description_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.desain_description') }}
                        </th>
                        <td>
                            {!! $review->desain_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.design_description_image') }}
                        </th>
                        <td>
                            @foreach($review->design_description_image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.performa_description') }}
                        </th>
                        <td>
                            {!! $review->performa_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.performa_description_image') }}
                        </th>
                        <td>
                            @foreach($review->performa_description_image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.layar_description') }}
                        </th>
                        <td>
                            {!! $review->layar_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.layar_description_image') }}
                        </th>
                        <td>
                            @foreach($review->layar_description_image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.baterai_description') }}
                        </th>
                        <td>
                            {!! $review->baterai_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.baterai_description_image') }}
                        </th>
                        <td>
                            @foreach($review->baterai_description_image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.konektivitas_description') }}
                        </th>
                        <td>
                            {!! $review->konektivitas_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.konektifitas_description_image') }}
                        </th>
                        <td>
                            @foreach($review->konektifitas_description_image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.kesimpulan') }}
                        </th>
                        <td>
                            {!! $review->kesimpulan !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.tag') }}
                        </th>
                        <td>
                            {{ $review->tag->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.review.fields.read_time') }}
                        </th>
                        <td>
                            {{ $review->read_time }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reviews.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection