<?php

namespace App\Actions;

use App\Models\Lead;
use Illuminate\Http\Request;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;

class StoreLeadAction
{
    public function execute(array $data, Request $request): Lead
    {
        return Lead::create([
            'name'    => $data['name'],
            'email'   => $data['email'],
            'phone'   => $this->normalizePhone($data['phone'] ?? null, $request),
            'message' => $data['message'],

            'source'  => 'contact-form',

            'utm_source'   => $request->query('utm_source'),
            'utm_medium'   => $request->query('utm_medium'),
            'utm_campaign' => $request->query('utm_campaign'),

            'ip'         => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 1000),

            'status' => 'new',
        ]);
    }

    private function normalizePhone(?string $phone, Request $request): ?string
    {
        if (!$phone) return null;

        $cleanPhone = preg_replace('/[^\d\+]/', '', $phone);
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();

        try {
            $number = $phoneUtil->parse($cleanPhone, 'AR');
            if ($phoneUtil->isValidNumber($number)) {
                return $phoneUtil->format($number, \libphonenumber\PhoneNumberFormat::E164);
            }
            return $phone; // inválido → enviamos tal cual
        } catch (\Throwable $e) {
            return $phone;
        }
    }
}
