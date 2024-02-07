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
            'make_*' => 'required',
            'model_*' => 'required',
            'trim_*' => 'required',
            'kms_driven' => 'required',
            'owners' => 'required',
            'transmission_*' => 'required',
            'fuel_type_*' => 'required',
            'body_type_*' => 'required',
            'registration_*' => 'required',
            'mileage_*' => 'required',
            'price' => 'required',
            'car_type_*' => 'required',
            'color_*' => 'required',
            'is_product' => 'required',
            'bid_increment' => 'required',
            'short_description_*' => 'required',
            'description_*' => 'required',
            'auction_start_time' => 'required',
            'auction_end_time' => 'required',
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
