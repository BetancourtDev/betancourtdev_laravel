<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function home()
    {
        $brand = [
            'whatsapp_phone' => config('brand.whatsapp_phone'),
            'linkedin_url'   => config('brand.linkedin_url'),
            'github_url'     => config('brand.github_url'),
            'cv_url'         => config('brand.cv_url', asset('docs/CV-Kim-Betancourt.pdf')),
            'location'       => config('brand.location', 'Buenos Aires, Argentina'),
            'availability'   => config('brand.availability', 'Disponible para proyectos y oportunidades remotas'),
            'whatsapp_texts' => [
                'long'  => rawurlencode('Hola Kim! Vi tu web y quiero contarte mi idea. Mi proyecto es: _____. ¿Me orientás con tiempos y presupuesto?'),
                'brief' => rawurlencode('Hola Kim! Quiero cotizar. Mi rubro: _____. Necesito: _____. Fecha ideal: _____.'),
            ],
        ];

        $landing = config('landing');

        $profile = [
            'name' => 'Kim Betancourt',
            'role' => 'Full-stack Web Developer (Laravel)',
            // lo que un recruiter busca rápido:
            'headline' => 'Laravel · MySQL · Tailwind · Alpine · Vite · Seguridad · Performance',
            'summary'  => 'Construyo productos web mantenibles, rápidos y orientados a negocio. Enfoque en buenas prácticas, seguridad y DX.',
            'open_to'  => ['Freelance', 'Part-time', 'Full-time remoto'],
        ];

        $seo = [
            'title' => 'Betancourt Dev | Kim Betancourt - Desarrollo web y sistemas a medida',
            'description' => 'Soy Kim Betancourt (Betancourt Dev). Desarrollo sitios web y sistemas a medida con Laravel. Te ayudo a vender y ordenar tu negocio con tecnología real.',
        ];

        return view('pages.home.index', compact('brand', 'landing', 'profile', 'seo'));
    }
}
