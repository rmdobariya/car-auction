<?php

namespace App\Http\Requests\Web;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VehicleStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'edit_value' => 'required',
//            'year' => 'required',
            'make_*' => 'required',
            'model_*' => 'required',
//            'trim_*' => 'required',
//            'kms_driven' => 'required',
//            'owners' => 'required',
//            'transmission_*' => 'required',
//            'fuel_type_*' => 'required',
            'body_type_*' => 'required',
//            'registration_*' => 'required',
//            'mileage_*' => 'required',
            'price' => 'required|integer',
            'bid_increment' => 'required_if:is_vehicle_type,car_for_auction|integer',
            'minimumBidIncrement' => 'required_if:is_vehicle_type,car_for_auction|integer',
            'auction_start_date' => 'required_if:is_vehicle_type,car_for_auction',
            'auction_end_date' => 'required_if:is_vehicle_type,car_for_auction',
            'auction_start_time' => 'required_if:is_vehicle_type,car_for_auction',
            'auction_end_time' => 'required_if:is_vehicle_type,car_for_auction',
            'main_image' => 'required_if:edit_value,0',
//            'color_*' => 'required',
//            'car_type_*' => 'required',
            'vehicle_category_id' => 'required',
//            'short_description_*' => 'required',
            'description_*' => 'required',
            'name_*' => 'required',
            'is_vehicle_type' => 'required',
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

