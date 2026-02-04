<?php

namespace App\Http\Controllers;

use App\Actions\StoreLeadAction;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactLeadMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(
        ContactRequest $request,
        StoreLeadAction $storeLead
    ) {
        $data = $request->validated();
        unset($data['website']);

        // -------------------------------
        // Verificación reCAPTCHA v3
        // -------------------------------
        $token = $request->input('g-recaptcha-response');

        if (!$token) {
            return back()->withFragment('contacto')
                ->withErrors(['captcha' => 'No se envió el token de reCAPTCHA.']);
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $token,
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();

        // Debug opcional:
        // dd($result);

        $minScore = config('services.recaptcha.min_score', 0.5);

        if (!($result['success'] ?? false) || ($result['score'] ?? 0) < $minScore) {
            return back()->withFragment('contacto')
                ->withErrors(['captcha' => 'Falló la verificación anti-spam.']);
        }

        // -------------------------------
        // Guardar lead
        // -------------------------------
        $lead = $storeLead->execute($data, $request);

        // -------------------------------
        // Enviar mail
        // -------------------------------
        Mail::to(config('mail.from.address'))
            ->send(new ContactLeadMail([
                ...$data,
                'lead_id' => $lead->id,
            ]));

        return back()->withFragment('contacto')
            ->with('ok', '¡Listo! Mensaje enviado. Te respondo en breve 🙌');
    }
}
