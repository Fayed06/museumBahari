<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRecommendationRequest;
use App\Http\Requests\StoreRecommendationRequest;
use App\Http\Requests\UpdateRecommendationRequest;
use App\Models\Recommendation;
use App\Models\Tag;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class RecommendationController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('recommendation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recommendations = Recommendation::with(['tag', 'media'])->get();

        $tags = Tag::get();

        return view('admin.recommendations.index', compact('recommendations', 'tags'));
    }

    public function create()
    {
        abort_if(Gate::denies('recommendation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.recommendations.create', compact('tags'));
    }

    public function store(StoreRecommendationRequest $request)
    {
        $recommendation = Recommendation::create($request->all());

        if ($request->input('overview_recommendation_image', false)) {
            $recommendation->addMedia(storage_path('tmp/uploads/' . basename($request->input('overview_recommendation_image'))))->toMediaCollection('overview_recommendation_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $recommendation->id]);
        }

        return redirect()->route('admin.recommendations.index');
    }

    public function edit(Recommendation $recommendation)
    {
        abort_if(Gate::denies('recommendation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $recommendation->load('tag');

        return view('admin.recommendations.edit', compact('recommendation', 'tags'));
    }

    public function update(UpdateRecommendationRequest $request, Recommendation $recommendation)
    {
        $recommendation->update($request->all());

        if ($request->input('overview_recommendation_image', false)) {
            if (!$recommendation->overview_recommendation_image || $request->input('overview_recommendation_image') !== $recommendation->overview_recommendation_image->file_name) {
                if ($recommendation->overview_recommendation_image) {
                    $recommendation->overview_recommendation_image->delete();
                }
                $recommendation->addMedia(storage_path('tmp/uploads/' . basename($request->input('overview_recommendation_image'))))->toMediaCollection('overview_recommendation_image');
            }
        } elseif ($recommendation->overview_recommendation_image) {
            $recommendation->overview_recommendation_image->delete();
        }

        return redirect()->route('admin.recommendations.index');
    }

    public function show(Recommendation $recommendation)
    {
        abort_if(Gate::denies('recommendation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recommendation->load('tag');

        return view('admin.recommendations.show', compact('recommendation'));
    }

    public function destroy(Recommendation $recommendation)
    {
        abort_if(Gate::denies('recommendation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recommendation->delete();

        return back();
    }

    public function massDestroy(MassDestroyRecommendationRequest $request)
    {
        Recommendation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('recommendation_create') && Gate::denies('recommendation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Recommendation();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
