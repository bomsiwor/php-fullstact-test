<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyClientRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:250',
            'is_project' => 'required|boolean',
            'self_capture' => 'required|boolean',
            'client_prefix' => 'required|string|size:4|unique:my_client,client_prefix',
            'client_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:50|regex:/^\+?[0-9]+$/',
            'city' => 'nullable|string|max:50',
        ];
    }
}
