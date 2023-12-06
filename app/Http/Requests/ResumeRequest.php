<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResumeRequest extends FormRequest
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
            'email' => 'email|required',
            'vacancy' => 'required',
            'message' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=> 'Поле имя обязательно для заполнения',
            'secondName.required' => 'Поле имя обязательно для заполнения',
            'phone.required'=> 'Поле телефон обязательно для заполнения',
            'email.required'=> 'Поле Email обязательно для заполнения',
            'vacancy.required'=> 'Поле вакансия обязательно для заполнения',
            'message.required'=> 'Поле сообщение обязательно для заполнения',
        ];
    }
}
