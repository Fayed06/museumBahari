<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySubmissionLinkRequest;
use App\Http\Requests\StoreSubmissionLinkRequest;
use App\Http\Requests\UpdateSubmissionLinkRequest;
use App\Models\SubmissionLink;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubmissionLinkController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('submission_link_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submissionLinks = SubmissionLink::all();

        return view('admin.submissionLinks.index', compact('submissionLinks'));
    }

    public function create()
    {
        abort_if(Gate::denies('submission_link_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.submissionLinks.create');
    }

    public function store(StoreSubmissionLinkRequest $request)
    {
        $submissionLink = SubmissionLink::create($request->all());

        return redirect()->route('admin.submission-links.index');
    }

    public function edit(SubmissionLink $submissionLink)
    {
        abort_if(Gate::denies('submission_link_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.submissionLinks.edit', compact('submissionLink'));
    }

    public function update(UpdateSubmissionLinkRequest $request, SubmissionLink $submissionLink)
    {
        $submissionLink->update($request->all());

        return redirect()->route('admin.submission-links.index');
    }

    public function show(SubmissionLink $submissionLink)
    {
        abort_if(Gate::denies('submission_link_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.submissionLinks.show', compact('submissionLink'));
    }

    public function destroy(SubmissionLink $submissionLink)
    {
        abort_if(Gate::denies('submission_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submissionLink->delete();

        return back();
    }

    public function massDestroy(MassDestroySubmissionLinkRequest $request)
    {
        SubmissionLink::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
