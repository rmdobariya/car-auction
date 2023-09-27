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
//            'minimumBidIncrement' => 'required',
//            'auction_start_date' => 'required',
//            'auction_start_time' => 'required',
//            'auction_end_date' => 'required',
//            'auction_end_time' => 'required',
            'main_image' => 'required',
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
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()
        ], 422));
    }
}
