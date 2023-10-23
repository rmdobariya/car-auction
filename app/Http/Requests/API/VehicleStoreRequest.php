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
            'price' => 'required|integer',
            'bid_increment' => 'required|integer',
            'minimumBidIncrement' => 'required_if:is_vehicle_type,=,car_for_auction',
            'auction_start_date' => 'required_if:is_vehicle_type,=,car_for_auction',
            'auction_start_time' => 'required_if:is_vehicle_type,=,car_for_auction',
            'auction_end_date' => 'required_if:is_vehicle_type,=,car_for_auction',
            'auction_end_time' => 'required_if:is_vehicle_type,=,car_for_auction',
            'main_image' => 'required_if:edit_value,=,0',
            'color' => 'required',
            'car_type' => 'required',
            'vehicle_category_id' => 'required',
            'short_description_*' => 'required',
            'description_*' => 'required',
            'name_*' => 'required',
            'is_vehicle_type' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message' => $validator->errors()->first()], 422));
    }
}
