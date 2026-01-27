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
        $data = $request->validated();
        unset($data['website']);

        // Guardar lead
        $lead = $storeLead->execute($data, $request);

        // Enviar mail
        Mail::to(config('mail.from.address'))
            ->send(new ContactLeadMail([
                ...$data,
                'lead_id' => $lead->id,
            ]));

        return back()->with('ok', '¡Listo! Mensaje enviado. Te respondo en breve 🙌');
    }
}
