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
            'is_vehicle_type' => 'required',
            'make_*' => 'required',
            'model_*' => 'required',
            'body_type_*' => 'required',
            'price' => 'required|integer',
            'bid_increment' => 'required_if:is_vehicle_type,car_for_auction|integer',
            'is_product' => 'required_if:is_vehicle_type,car_for_auction',
            'description_*' => 'required',
            'auction_start_date' => 'required_if:is_vehicle_type,car_for_auction',
            'auction_end_date' => 'required_if:is_vehicle_type,car_for_auction',
            'auction_start_time' => 'required_if:is_vehicle_type,car_for_auction',
            'auction_end_time' => 'required_if:is_vehicle_type,car_for_auction',
            'advance_payment' => 'required_if:is_vehicle_type,car_for_auction',
            'advance_payment_type' => 'required_if:is_vehicle_type,car_for_auction',
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
