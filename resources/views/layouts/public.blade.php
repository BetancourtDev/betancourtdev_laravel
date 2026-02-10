<!doctype html>
<html lang="es" class="no-js">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#0b1220">

<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>


    {{-- No-JS fallback (para que .reveal no quede invisible si falla JS) --}}
  <script>document.documentElement.classList.remove('no-js');</script>

  @php
    $title = trim($__env->yieldContent('title', 'Betancourt Dev | Kim Betancourt - Desarrollo web y software a medida'));
    $description = trim($__env->yieldContent('meta_description', 'Soy Kim Betancourt (Buenos Aires). Desarrollo software a medida, páginas web corporativas y asesoramiento SEO. Laravel, WordPress + Elementor.'));
    $canonical = url()->current();
    $ogImage = $__env->yieldContent('og_image') ?: asset('img/og-betancourtdev.jpg');
  @endphp

  <title>{{ $title }}</title>
  <meta name="description" content="{{ $description }}">
  <link rel="canonical" href="{{ $canonical }}">
  <meta name="robots" content="@yield('robots', 'index,follow')">


 {{-- OpenGraph --}}
  <meta property="og:type" content="website">
  <meta property="og:title" content="@yield('og_title', $title)">
  <meta property="og:description" content="@yield('og_description', $description)">
  <meta property="og:url" content="{{ $canonical }}">
  <meta property="og:image" content="{{ $ogImage }}">

{{-- Twitter --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="@yield('twitter_title', $title)">
  <meta name="twitter:description" content="@yield('twitter_description', $description)">
  <meta name="twitter:image" content="@yield('twitter_image', $ogImage)">

{{-- Schema.org --}}
<script type="application/ld+json">
@verbatim
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Kim Tech Global",
    "applicationCategory": "BusinessApplication",
    "url": "https://tu-dominio.com",
    "description": "Desarrollo web y software a medida. Landing pages y sistemas web.",
    "address": {
        "@type": "PostalAddress",
        "addressCountry": "AR"
    },
    "areaServed": ["AR", "LatAm"]
}
@endverbatim
</script>
  {{-- Estilos/Fonts específicos por página (tu HOME) --}}
@stack('styles')
  {{-- Vite --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased"> {{-- Agregué antialiased para mejor lectura --}}
  @include('partials.nav')

  <main>
    @yield('content')
  </main>

  @include('partials.footer')


  <x-cookie-consent />
    {{-- Scripts específicos por página (reveal, smooth scroll, etc.) --}}

  @stack('scripts')

</body>
</html>