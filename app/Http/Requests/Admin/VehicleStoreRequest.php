<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class VehicleStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'edit_value' => 'required',
            'year' => 'required',
            'make' => 'required',
            'model' => 'required',
            'trim' => 'required',
            'kms_driven' => 'required',
            'owners' => 'required',
            'transmission' => 'required',
            'fuel_type' => 'required',
            'body_type' => 'required',
            'registration' => 'required',
            'mileage' => 'required',
            'price' => 'required',
            'short_description_*' => 'required',
            'description_*' => 'required',
            'name_*' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()
        ], 422));
    }
}
