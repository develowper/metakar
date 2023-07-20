<?php

namespace App\Http\Requests;

use App\Http\Helpers\Variable;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $types = Category::pluck('id');

        if ($this->cmnd)
            return [
                'charge' => ['required_if:cmnd,charge', 'numeric', 'gt:0'],
                'view_fee' => ['required_if:cmnd,view-fee', 'numeric', 'gt:0'],
            ];
        return [
            'lang' => ['required', Rule::in(Variable::LANGS)],
            'name' => ['required', 'max:100'],
            'link' => ['required', 'starts_with:http', 'url', 'max:1024',],
            'tags' => ['nullable', 'max:1024'],
            'category' => ['nullable', Rule::in($types)],
            'description' => ['nullable', 'max:2048'],
            'img' => ['required', 'base64_image_size:' . Variable::SITE_IMAGE_LIMIT_MB * 1024, 'base64_image_mime:' . implode(",", Variable::SITE_ALLOWED_MIMES)],

        ];
    }

    public function messages()
    {
        if ($this->cmnd)
            return [
                'charge.numeric' => sprintf(__("validator.invalid"), __('charge_amount')),
                'charge.gt' => sprintf(__("validator.invalid"), __('charge_amount')),
                'charge.required_if' => sprintf(__("validator.invalid"), __('charge_amount')),

            ];
        return [
            'lang.required' => sprintf(__("validator.required"), __('lang')),
            'lang.in' => sprintf(__("validator.invalid"), __('lang')),

            'name.required' => sprintf(__("validator.required"), __('title')),
            'name.max' => sprintf(__("validator.max_len"), 2048, mb_strlen($this->name)),

            'link.required' => sprintf(__("validator.required"), __('link')),
            'link.max' => sprintf(__("validator.max_len"), 1024, mb_strlen($this->link)),
            'link.url' => sprintf(__("validator.invalid"), __('link')),
            'link.starts_with' => sprintf(__("validator.starts_with"), __('link'), "http " . __('or') . " https"),

            'category.in' => sprintf(__("validator.invalid"), __('lang')),

            'tags.max' => sprintf(__("validator.max_len"), 1024, mb_strlen($this->tags)),

            'description.max' => sprintf(__("validator.max_len"), 2048, mb_strlen($this->description)),

            'img.required' => sprintf(__("validator.required"), __('image')),
            'img.base64_image_size' => sprintf(__("validator.max_size"), Variable::SITE_IMAGE_LIMIT_MB),
            'img.base64_image_mime' => sprintf(__("validator.invalid_format"), implode(",", Variable::SITE_ALLOWED_MIMES)),
        ];
    }
}
