<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyReviewRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use App\Models\Tag;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reviews = Review::with(['tag', 'media'])->get();

        $tags = Tag::get();

        return view('admin.reviews.index', compact('reviews', 'tags'));
    }

    public function create()
    {
        abort_if(Gate::denies('review_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.reviews.create', compact('tags'));
    }

    public function store(StoreReviewRequest $request)
    {
        $review = Review::create($request->all());

        if ($request->input('overview_description_image', false)) {
            $review->addMedia(storage_path('tmp/uploads/' . basename($request->input('overview_description_image'))))->toMediaCollection('overview_description_image');
        }

        foreach ($request->input('design_description_image', []) as $file) {
            $review->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('design_description_image');
        }

        foreach ($request->input('performa_description_image', []) as $file) {
            $review->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('performa_description_image');
        }

        foreach ($request->input('layar_description_image', []) as $file) {
            $review->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('layar_description_image');
        }

        foreach ($request->input('baterai_description_image', []) as $file) {
            $review->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('baterai_description_image');
        }

        foreach ($request->input('konektifitas_description_image', []) as $file) {
            $review->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('konektifitas_description_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $review->id]);
        }

        return redirect()->route('admin.reviews.index');
    }

    public function edit(Review $review)
    {
        abort_if(Gate::denies('review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $review->load('tag');

        return view('admin.reviews.edit', compact('review', 'tags'));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->all());

        if ($request->input('overview_description_image', false)) {
            if (!$review->overview_description_image || $request->input('overview_description_image') !== $review->overview_description_image->file_name) {
                if ($review->overview_description_image) {
                    $review->overview_description_image->delete();
                }
                $review->addMedia(storage_path('tmp/uploads/' . basename($request->input('overview_description_image'))))->toMediaCollection('overview_description_image');
            }
        } elseif ($review->overview_description_image) {
            $review->overview_description_image->delete();
        }

        if (count($review->design_description_image) > 0) {
            foreach ($review->design_description_image as $media) {
                if (!in_array($media->file_name, $request->input('design_description_image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $review->design_description_image->pluck('file_name')->toArray();
        foreach ($request->input('design_description_image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $review->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('design_description_image');
            }
        }

        if (count($review->performa_description_image) > 0) {
            foreach ($review->performa_description_image as $media) {
                if (!in_array($media->file_name, $request->input('performa_description_image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $review->performa_description_image->pluck('file_name')->toArray();
        foreach ($request->input('performa_description_image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $review->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('performa_description_image');
            }
        }

        if (count($review->layar_description_image) > 0) {
            foreach ($review->layar_description_image as $media) {
                if (!in_array($media->file_name, $request->input('layar_description_image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $review->layar_description_image->pluck('file_name')->toArray();
        foreach ($request->input('layar_description_image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $review->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('layar_description_image');
            }
        }

        if (count($review->baterai_description_image) > 0) {
            foreach ($review->baterai_description_image as $media) {
                if (!in_array($media->file_name, $request->input('baterai_description_image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $review->baterai_description_image->pluck('file_name')->toArray();
        foreach ($request->input('baterai_description_image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $review->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('baterai_description_image');
            }
        }

        if (count($review->konektifitas_description_image) > 0) {
            foreach ($review->konektifitas_description_image as $media) {
                if (!in_array($media->file_name, $request->input('konektifitas_description_image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $review->konektifitas_description_image->pluck('file_name')->toArray();
        foreach ($request->input('konektifitas_description_image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $review->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('konektifitas_description_image');
            }
        }

        return redirect()->route('admin.reviews.index');
    }

    public function show(Review $review)
    {
        abort_if(Gate::denies('review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->load('tag');

        return view('admin.reviews.show', compact('review'));
    }

    public function destroy(Review $review)
    {
        abort_if(Gate::denies('review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $review->delete();

        return back();
    }

    public function massDestroy(MassDestroyReviewRequest $request)
    {
        Review::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('review_create') && Gate::denies('review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Review();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
