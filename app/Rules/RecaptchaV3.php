<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class RecaptchaV3 implements ValidationRule
{
    public function __construct(
        private string $action = 'contact'
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value) || $value === '') {
            $fail('Validación anti-spam requerida.');
            return;
        }

        $secret = config('services.recaptcha.secret');
        $minScore = (float) config('services.recaptcha.min_score', 0.5);

        if (!$secret) {
            // En dev podrías permitir si falta secret, pero mejor fallar seguro
            $fail('reCAPTCHA no configurado.');
            return;
        }

        $resp = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secret,
            'response' => $value,
        ]);

        if (!$resp->ok()) {
            $fail('No se pudo verificar reCAPTCHA.');
            return;
        }

        $data = $resp->json();

        // v3: success + score + action
        if (empty($data['success'])) {
            $fail('Falló la verificación anti-spam.');
            return;
        }

        if (!empty($data['action']) && $data['action'] !== $this->action) {
            $fail('Acción de seguridad inválida.');
            return;
        }

        $score = (float) ($data['score'] ?? 0);
        if ($score < $minScore) {
            $fail('Tu verificación de seguridad no fue suficiente. Probá de nuevo.');
        }
    }
}
