@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.recommendation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.recommendations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.recommendation.fields.id') }}
                        </th>
                        <td>
                            {{ $recommendation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.recommendation.fields.title') }}
                        </th>
                        <td>
                            {{ $recommendation->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.recommendation.fields.overview_description') }}
                        </th>
                        <td>
                            {!! $recommendation->overview_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.recommendation.fields.overview_recommendation_image') }}
                        </th>
                        <td>
                            @if($recommendation->overview_recommendation_image)
                                <a href="{{ $recommendation->overview_recommendation_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $recommendation->overview_recommendation_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.recommendation.fields.tag') }}
                        </th>
                        <td>
                            {{ $recommendation->tag->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.recommendations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection