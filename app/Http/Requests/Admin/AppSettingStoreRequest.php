<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class AppSettingStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'setting_key.ANDROID_VERSION' => 'required',
            'setting_key.ANDROID_UPDATE_TEXT' => 'required',
            'setting_key.ANDROID_FORCE_UPDATE' => 'required',
            'setting_key.IOS_VERSION' => 'required',
            'setting_key.IOS_UPDATE_TEXT' => 'required',
            'setting_key.IOS_FORCE_UPDATE' => 'required',
        ];
    }

    public function failedValidation( Validator $validator )
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()
        ], 422));
    }
}
