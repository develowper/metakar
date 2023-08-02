<?php

namespace App\Http\Requests;

use App\Http\Helpers\Variable;
use App\Models\Category;
use App\Models\County;
use App\Models\Sport;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BusinessRequest extends FormRequest
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
        $user = auth()->user();
        $types = Category::pluck('id');
        $request = $this;
        $tmp = [];
        if ($this->cmnd)
            return [

            ];
        $tmp = [
            'lang' => ['required', Rule::in(Variable::LANGS)],
            'name' => ['required', 'max:100', Rule::unique('sites', 'name')->ignore($this->id)],
            'link' => ['required', 'starts_with:https://', 'url', 'max:1024', Rule::unique('sites', 'name')->ignore($this->id)],
            'tags' => ['nullable', 'max:1024'],
            'province' => 'required|in:' . County::where('id', $this->county)->firstOrNew()->province_id,
            'county' => 'required|' . Rule::in(County::pluck('id')),
            'category' => ['nullable', Rule::in($types)],
            'description' => ['nullable', 'max:2048'],
            'img' => ['nullable', 'base64_image_size:' . Variable::SITE_IMAGE_LIMIT_MB * 1024, 'base64_image_mime:' . implode(",", Variable::SITE_ALLOWED_MIMES)],
            'phone' => 'required|numeric|digits:11|regex:/^09[0-9]+$/' . '|unique:businesses,phone',
            'phone_verify' => [Rule::requiredIf(function () use ($request, $user) {
                return !$user || $request->phone != $user->phone;
            }), !$user || $request->phone != $user->phone ? Rule::exists('sms_verify', 'code')->where(function ($query) use ($request) {
                return $query->where('phone', $request->phone);
            }) : '',],
        ];
        if (isset($request->uploading))
            $tmp = array_merge($tmp, [
                'images' => 'required|array|min:1|max:' . Variable::BUSINESS_IMAGE_LIMIT,
                'images.*' => 'required|base64_image'/*.'|base64_size:2048'*/,
            ]);
        return $tmp;
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
            'link.starts_with' => sprintf(__("validator.starts_with"), __('link'), "https://"),

            'category.in' => sprintf(__("validator.invalid"), __('lang')),

            'tags.max' => sprintf(__("validator.max_len"), 1024, mb_strlen($this->tags)),

            'description.max' => sprintf(__("validator.max_len"), 2048, mb_strlen($this->description)),


            'images.max' => sprintf(__("validator.max_images"), Variable::BUSINESS_IMAGE_LIMIT),

            'images.required' => sprintf(__("validator.required"), __('image')),
            'images.*.base64_image_size' => sprintf(__("validator.max_size"), Variable::SITE_IMAGE_LIMIT_MB),
            'images.*.base64_image_mime' => sprintf(__("validator.invalid_format"), implode(",", Variable::SITE_ALLOWED_MIMES)),
        ];
    }
}
