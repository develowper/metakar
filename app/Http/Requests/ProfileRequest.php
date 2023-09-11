<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use App\Http\Helpers\Variable;
use App\Models\Business;
use App\Models\Category;
use App\Models\County;
use App\Models\Sport;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
        $editMode = (bool)optional($user)->id;
        $request = $this;
        $tmp = [];
        $phoneChanged = optional($user)->phone != $this->phone;

        if (!$this->cmnd)
            $tmp = array_merge($tmp, [
                'fullname' => ['required', 'max:100', Rule::unique('users', 'fullname')->ignore(optional($user)->id)],
                'card' => ['nullable', 'digits:16', Rule::unique('users', 'card')->ignore($user->id)],
                'phone' => ['required', 'numeric', 'digits:11', 'regex:/^09[0-9]+$/', Rule::unique('users', 'phone')->ignore($user->id)],
                'phone_verify' => [Rule::requiredIf(function () use ($request, $user, $phoneChanged, $editMode) {
                    return $phoneChanged
                        || !$user || (!$editMode && $request->phone != $user->phone);
                }), !$user || (!$editMode && $request->phone != $user->phone) ? Rule::exists('sms_verify', 'code')->where(function ($query) use ($request) {
                    return $query->where('phone', $request->phone);
                }) : '',],
            ]);


        if ($this->cmnd == 'upload-img')
            $tmp = array_merge($tmp, [
                'img' => ['required', 'base64_image_size:' . Variable::SITE_IMAGE_LIMIT_MB * 1024, 'base64_image_mime:' . implode(",", Variable::SITE_ALLOWED_MIMES)],

            ]);
        return $tmp;
    }

    public function messages()
    {

        return [

            'fullname.required' => sprintf(__("validator.required"), __('fullname')),
            'fullname.max' => sprintf(__("validator.max_len"), 100, mb_strlen($this->fullname)),

            'phone.required' => sprintf(__("validator.required"), __('phone')),
            'phone.unique' => sprintf(__("validator.unique"), __('phone')),
            'phone_verify.required' => sprintf(__("validator.required"), __('phone_verify')),
            'phone_verify.exists' => sprintf(__("validator.invalid"), __('phone_verify')),


            'card.digits' => sprintf(__("validator.digits"), __('card'), 16),

            'img.required' => sprintf(__("validator.required"), __('image')),
            'img.base64_image_size' => sprintf(__("validator.max_size"), __("image"), Variable::SITE_IMAGE_LIMIT_MB),
            'img.base64_image_mime' => sprintf(__("validator.invalid_format"), __("image"), implode(",", Variable::SITE_ALLOWED_MIMES)),

        ];
    }
}
