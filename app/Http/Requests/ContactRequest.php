<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\RecaptchaV3;


class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return ! session()->has('ok');
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:80'],
            'email'   => ['required', 'email', 'max:120'],
            'phone'  => ['nullable', 'string', 'max:20'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
            'g-recaptcha-response' => ['required', new RecaptchaV3('contact')],

            // honeypot
            'website' => ['nullable', 'max:0'],


            'utm_source'   => ['nullable', 'string', 'max:100'],
            'utm_medium'   => ['nullable', 'string', 'max:100'],
            'utm_campaign' => ['nullable', 'string', 'max:100'],
            'source'       => ['nullable', 'string', 'max:50'],



        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Decime tu nombre 🙂',
            'email.email'   => 'Ese email no parece válido.',
            'phone.max'     => 'El número de teléfono es muy largo.',
            'message.min'   => 'Contame un poquito más (mínimo 10 caracteres).',
        ];
    }

    protected function prepareForValidation(): void
    {
        // normaliza (evita espacios raros)
        $this->merge([
            'name'  => is_string($this->name) ? trim($this->name) : $this->name,
            'email' => is_string($this->email) ? trim($this->email) : $this->email,
            'phone' => is_string($this->phone) ? trim($this->phone) : $this->phone,
        ]);
    }
}
