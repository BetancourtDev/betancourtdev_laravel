<?php

namespace App\Http\Controllers;

use App\Actions\StoreLeadAction;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactLeadMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(
        ContactRequest $request,
        StoreLeadAction $storeLead
    ) {
        // ✅ La validación de reCAPTCHA ya se hizo en ContactRequest

        $data = $request->validated();
        unset($data['website']);
        unset($data['g-recaptcha-response']); // No lo necesitamos en la BD

        // Guardar lead
        $lead = $storeLead->execute($data, $request);

        // Enviar mail
        Mail::to(config('mail.from.address'))
            ->send(new ContactLeadMail([
                ...$data,
                'lead_id' => $lead->id,
            ]));

        return back()->withFragment('contacto')
            ->with('ok', '¡Listo! Mensaje enviado. Te respondo en breve 🙌');
    }
}
