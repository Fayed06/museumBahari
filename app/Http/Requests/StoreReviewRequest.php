<?php

namespace App\Http\Requests;

use App\Models\Review;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReviewRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('review_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'gadget_name' => [
                'string',
                'required',
            ],
            'design_description_image' => [
                'array',
            ],
            'performa_description_image' => [
                'array',
            ],
            'layar_description_image' => [
                'array',
            ],
            'baterai_description_image' => [
                'array',
            ],
            'konektifitas_description_image' => [
                'array',
            ],
            'read_time' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
