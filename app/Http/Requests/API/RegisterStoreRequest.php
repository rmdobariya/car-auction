<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'user_type' => 'required',
            'email' => 'required_if:user_type,=,seller,email:rfc,dns|unique:users,email,',
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_no' => 'required|digits_between:1,10',
            'password' => 'required',
            'device_type' => 'required',
            'device_token' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['status' => false, 'message' => $validator->errors()->first()], 200));
    }
}
