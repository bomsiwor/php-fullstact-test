<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) :
            $errors = (new ValidationException($validator))->getMessage();

            throw new HttpResponseException(
                response()->json([
                    'message' => $errors,
                    'data' => $validator->errors()->getMessageBag(),
                ], 422)
            );
        endif;

        parent::failedValidation($validator);
    }
}
