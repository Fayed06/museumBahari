<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubmissionLinkRequest;
use App\Http\Requests\UpdateSubmissionLinkRequest;
use App\Http\Resources\Admin\SubmissionLinkResource;
use App\Models\SubmissionLink;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubmissionLinkApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('submission_link_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubmissionLinkResource(SubmissionLink::all());
    }

    public function store(StoreSubmissionLinkRequest $request)
    {
        $submissionLink = SubmissionLink::create($request->all());

        return (new SubmissionLinkResource($submissionLink))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SubmissionLink $submissionLink)
    {
        abort_if(Gate::denies('submission_link_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubmissionLinkResource($submissionLink);
    }

    public function update(UpdateSubmissionLinkRequest $request, SubmissionLink $submissionLink)
    {
        $submissionLink->update($request->all());

        return (new SubmissionLinkResource($submissionLink))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SubmissionLink $submissionLink)
    {
        abort_if(Gate::denies('submission_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submissionLink->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
