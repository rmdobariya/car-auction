<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class BankStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'setting_key.BANK_NAME' => 'required',
            'setting_key.IBAN' => 'required',
            'setting_key.ACCOUNT_NO' => 'required',
            'setting_key.LOCATION' => 'required',
            'setting_key.NATIONAL_ID_NO' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()
        ], 422));
    }
}
