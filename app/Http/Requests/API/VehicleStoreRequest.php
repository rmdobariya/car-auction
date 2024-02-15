<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VehicleStoreRequest extends FormRequest
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
            'price' => 'required|integer',
            'bid_increment' => 'required_if:is_vehicle_type,=,car_for_auction',
            'auction_start_date' => 'required_if:is_vehicle_type,=,car_for_auction',
            'auction_end_date' => 'required_if:is_vehicle_type,=,car_for_auction',
            'auction_start_time' => 'required_if:is_vehicle_type,=,car_for_auction',
            'auction_end_time' => 'required_if:is_vehicle_type,=,car_for_auction',
            'main_image' => 'required_if:edit_value,=,0',
            'color_*' => 'required',
            'car_type_*' => 'required',
            'vehicle_category_id' => 'required',
            'short_description_*' => 'required',
            'description_*' => 'required',
            'name_*' => 'required',
            'is_vehicle_type' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['status' => false,'message' => $validator->errors()->first()], 200));
    }
}
