<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'name' => 'required',
            'secondName' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=> 'Поле имя обязательно для заполнения',
            'secondName' => 'Поле имя обязательно для заполнения',
            'phone.required'=> 'Поле телефон обязательно для заполнения',
            'email.required'=> 'Поле Email обязательно для заполнения',
            'message.required'=> 'Поле сообщение обязательно для заполнения',
        ];
    }
}
