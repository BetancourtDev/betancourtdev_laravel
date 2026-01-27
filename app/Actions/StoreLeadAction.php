<?php

namespace App\Actions;

use App\Models\Lead;
use Illuminate\Http\Request;

class StoreLeadAction
{
    public function execute(array $data, Request $request): Lead
    {
        return Lead::create([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'message'    => $data['message'],

            'source'     => 'contact-form',

            'utm_source'   => $request->query('utm_source'),
            'utm_medium'   => $request->query('utm_medium'),
            'utm_campaign' => $request->query('utm_campaign'),

            'ip'         => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 1000),

            'status'     => 'new',
        ]);
    }
}
