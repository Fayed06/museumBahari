<?php

namespace App\Http\Requests;

use App\Models\SubmissionLink;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySubmissionLinkRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('submission_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:submission_links,id',
        ];
    }
}
