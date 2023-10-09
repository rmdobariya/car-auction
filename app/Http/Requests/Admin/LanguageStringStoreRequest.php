<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class LanguageStringStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.*.required' => 'The String Value is required.',
        ];
    }

    public function rules(): array
    {
        return [
            'edit_value'   => 'required|integer',
            'app_or_panel' => 'required',
            'name_key'     => ['required', Rule::unique('language_strings')->where('app_or_panel', $this->app_or_panel)->ignore($this->edit_value)],
            "name.*"       => "required",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        //write your bussiness logic here otherwise it will give same old JSON response
        throw new HttpResponseException(response()->json([
            'success' => false, 'message' => $validator->errors()->first()
        ], 422));
    }
}

