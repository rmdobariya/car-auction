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
        $rules = [
            'edit_value' => 'required',
            'make_*' => 'required',
            'model_*' => 'required',
            'body_type_*' => 'required',
            'price' => 'required',
            'is_product' => 'required',
            'bid_increment' => 'required',
            'description_*' => 'required',
            'auction_start_time' => 'required',
            'auction_end_time' => 'required',
            'advance_payment' => 'required',
            'advance_payment_type' => 'required',
            'name_*' => 'required',
        ];
        if ($this->input('car_report_changed') == 1) {
            $rules['car_report'] = 'required|mimes:pdf';
        }

        return $rules;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()
        ], 422));
    }
}
