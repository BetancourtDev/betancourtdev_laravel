<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookieConsentController extends Controller
{
    public function accept(Request $request)
    {
        // 180 días
        $minutes = 60 * 24 * 180;

        // Podés guardar "all" si aceptó analíticas también
        return back()->withCookie(cookie(
            'bd_cookie_consent',
            'accepted',
            $minutes,
            path: '/',
            domain: null,
            secure: $request->isSecure(),
            httpOnly: false,   // debe ser false si lo querés leer desde JS
            raw: false,
            sameSite: 'Lax'
        ));
    }

    public function reject(Request $request)
    {
        $minutes = 60 * 24 * 180;

        return back()->withCookie(cookie(
            'bd_cookie_consent',
            'rejected',
            $minutes,
            path: '/',
            domain: null,
            secure: $request->isSecure(),
            httpOnly: false,
            raw: false,
            sameSite: 'Lax'
        ));
    }
}
