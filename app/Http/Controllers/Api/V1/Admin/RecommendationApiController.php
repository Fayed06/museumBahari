<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreRecommendationRequest;
use App\Http\Requests\UpdateRecommendationRequest;
use App\Http\Resources\Admin\RecommendationResource;
use App\Models\Recommendation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecommendationApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('recommendation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RecommendationResource(Recommendation::with(['tag'])->get());
    }

    public function store(StoreRecommendationRequest $request)
    {
        $recommendation = Recommendation::create($request->all());

        if ($request->input('overview_recommendation_image', false)) {
            $recommendation->addMedia(storage_path('tmp/uploads/' . basename($request->input('overview_recommendation_image'))))->toMediaCollection('overview_recommendation_image');
        }

        return (new RecommendationResource($recommendation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Recommendation $recommendation)
    {
        abort_if(Gate::denies('recommendation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RecommendationResource($recommendation->load(['tag']));
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

        return (new RecommendationResource($recommendation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Recommendation $recommendation)
    {
        abort_if(Gate::denies('recommendation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recommendation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
