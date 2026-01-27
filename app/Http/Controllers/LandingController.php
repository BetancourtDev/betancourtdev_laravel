<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function home()
    {
        // TODO: Podés traer testimonios/proyectos desde DB en v2.
        return view('pages.home');
    }
}
