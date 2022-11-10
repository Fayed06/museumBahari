<?php

namespace App\Http\Requests;

use App\Models\SubmissionLink;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSubmissionLinkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('submission_link_edit');
    }

    public function rules()
    {
        return [
            'link' => [
                'string',
                'required',
            ],
        ];
    }
}
