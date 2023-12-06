<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
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
            'name' => '',
            'phone' => 'required|min:16|max:16',
            'email' => 'required|email',
            'message' => 'max:200',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=> 'Поле имя обязательно для заполнения',
            
            'phone.required'=> 'Поле телефон обязательно для заполнения',
            'phone.min'=> 'Поле телефон должно состоять из 11 цифр',
            'phone.max'=> 'Поле телефон должно состоять из 11 цифр',

            'email.required'=> 'Поле Email обязательно для заполнения',
            'email.email'=> 'Неверный Email',

            // 'message.required'=> 'Поле сообщение обязательно для заполнения',
            // 'message.min'=> 'Поле сообщение должно быть размером от 0 до 200 символов',
            'message.max'=> 'Поле сообщение должно быть размером от 0 до 200 символов',
        ];
    }
}
