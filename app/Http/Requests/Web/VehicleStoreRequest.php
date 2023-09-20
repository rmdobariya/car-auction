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
            'carname' => 'required',
            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'description' => 'required',
            'milage' => 'required',
            'bodType' => 'required',
            'exterioColor' => 'required',
            'carType' => 'required',
            'ratingvalue' => 'required',
            'minimumBidIncrement' => 'required',
            'initialPrice' => 'required',
//            'phone' => 'required|digits_between:1,10',
//            'email' => 'required|unique:users,email',
//            'user_type' => 'required',
//            'term' => 'required',
//            'password' => 'required|min:8',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()
        ], 422));
    }
}
