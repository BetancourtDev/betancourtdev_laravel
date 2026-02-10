<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
            Log::error('reCAPTCHA: Secret key no configurada');
            $fail('reCAPTCHA no configurado.');
            return;
        }

        $resp = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secret,
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        if (!$resp->ok()) {
            Log::error('reCAPTCHA: Error de conexión', ['status' => $resp->status()]);
            $fail('No se pudo verificar reCAPTCHA.');
            return;
        }

        $data = $resp->json();

        Log::info('reCAPTCHA validación', [
            'success' => $data['success'] ?? false,
            'score' => $data['score'] ?? null,
            'action' => $data['action'] ?? null,
            'error_codes' => $data['error-codes'] ?? [],
        ]);

        if (empty($data['success'])) {
            $errorCodes = $data['error-codes'] ?? [];
            Log::warning('reCAPTCHA falló', ['error_codes' => $errorCodes]);

            $message = 'Falló la verificación anti-spam.';
            if (in_array('timeout-or-duplicate', $errorCodes)) {
                $message = 'El token expiró. Por favor, intentá de nuevo.';
            }

            $fail($message);
            return;
        }

        if (!empty($data['action']) && $data['action'] !== $this->action) {
            Log::warning('reCAPTCHA action incorrecta', [
                'expected' => $this->action,
                'received' => $data['action'],
            ]);
            $fail('Acción de seguridad inválida.');
            return;
        }

        $score = (float) ($data['score'] ?? 0);
        if ($score < $minScore) {
            Log::warning('reCAPTCHA score bajo', ['score' => $score, 'min' => $minScore]);
            $fail('Tu verificación de seguridad no fue suficiente. Probá de nuevo.');
        }
    }
}
