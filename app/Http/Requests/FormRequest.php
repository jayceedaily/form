<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormRequest extends Request
{
    protected function failedValidation(Validator $validator) {

        throw new HttpResponseException(response()->json($validator->errors(), 422));

    }
}
