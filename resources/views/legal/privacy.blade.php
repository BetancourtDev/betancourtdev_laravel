@extends('layouts.app')

@section('title', 'Políticas de Privacidad | Betancourt Dev')
@section('meta_description', 'Política de privacidad de Betancourt Dev: cómo recopilamos, usamos y protegemos tus datos al contactarnos o navegar el sitio.')

@section('content')
@php
  $brand = config('brand.name', 'Betancourt Dev');
  $email = config('mail.from.address', 'contacto@betancourtdev.com');
  $lastUpdate = '27/01/2026'; // actualizalo cuando edites el documento
@endphp

<section class="mx-auto max-w-4xl px-4 pt-16 pb-20">
  <div class="glass-card rounded-3xl p-8 md:p-12">
    <div class="flex flex-col gap-3">
      <span class="tag w-fit">Legal</span>
      <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">Políticas de Privacidad</h1>
      <p class="text-[var(--color-text-muted)] text-lg">
        Última actualización: <span class="font-semibold text-slate-200">{{ $lastUpdate }}</span>
      </p>
    </div>

    <div class="prose prose-invert max-w-none mt-10 prose-p:text-[var(--color-text-muted)] prose-li:text-[var(--color-text-muted)] prose-a:text-[var(--color-primary)]">
      <h2>1. Quiénes somos</h2>
      <p>
        Este sitio es operado por <strong>{{ $brand }}</strong> (en adelante, “{{ $brand }}”).
        Si tenés dudas sobre esta Política, podés contactarnos al correo:
        <a href="mailto:{{ $email }}">{{ $email }}</a>.
      </p>

      <h2>2. Qué datos recopilamos</h2>
      <p>Podemos recopilar datos de las siguientes formas:</p>
      <ul>
        <li><strong>Datos que nos brindás voluntariamente</strong>: nombre, email, mensaje y cualquier información que envíes mediante formularios o WhatsApp.</li>
        <li><strong>Datos técnicos</strong>: información básica del dispositivo/navegador, páginas visitadas y eventos de uso (si se utilizan herramientas de analítica).</li>
        <li><strong>Cookies</strong>: archivos que permiten recordar preferencias y medir uso del sitio (ver sección de Cookies).</li>
      </ul>

      <h2>3. Para qué usamos tus datos</h2>
      <ul>
        <li>Responder consultas y cotizaciones.</li>
        <li>Coordinar reuniones o seguimiento de proyectos.</li>
        <li>Mejorar el sitio (rendimiento, contenido, experiencia de usuario).</li>
        <li>Cumplir obligaciones legales si corresponde.</li>
      </ul>

      <h2>4. Base legal</h2>
      <p>
        Tratamos tus datos principalmente por <strong>consentimiento</strong> (cuando completás un formulario o aceptás cookies)
        y/o por <strong>interés legítimo</strong> (mejoras del sitio, prevención de abuso/spam), según corresponda.
      </p>

      <h2>5. Con quién compartimos tus datos</h2>
      <p>
        No vendemos tus datos. Podríamos compartirlos solo con proveedores que ayudan a operar el sitio
        (por ejemplo: hosting, email, analítica), siempre bajo condiciones de confidencialidad y seguridad.
      </p>

      <h2>6. WhatsApp</h2>
      <p>
        Si nos contactás por WhatsApp, la comunicación queda sujeta también a las políticas y términos de WhatsApp/Meta.
        Te recomendamos no enviar información sensible por ese canal.
      </p>

      <h2>7. Seguridad</h2>
      <p>
        Implementamos medidas razonables para proteger tus datos (controles de acceso, buenas prácticas de desarrollo,
        protección contra spam y abuso). Aun así, ningún sistema es 100% infalible.
      </p>

      <h2>8. Conservación</h2>
      <p>
        Conservamos tus datos el tiempo necesario para responder tu consulta, dar seguimiento comercial o cumplir obligaciones legales.
        Podés solicitar la eliminación (ver sección “Tus derechos”).
      </p>

      <h2>9. Cookies</h2>
      <p>
        Usamos cookies para:
      </p>
      <ul>
        <li><strong>Necesarias</strong>: para funciones básicas (por ejemplo, guardar el estado de consentimiento de cookies).</li>
        <li><strong>Analítica</strong> (si está habilitada): para entender cómo se usa el sitio y mejorarlo.</li>
      </ul>
      <p>
        Podés aceptar o rechazar cookies desde el banner/consentimiento. También podés gestionar cookies desde tu navegador.
      </p>

      <h2>10. Tus derechos</h2>
      <p>
        Podés solicitar acceso, actualización o eliminación de tus datos personales, escribiendo a
        <a href="mailto:{{ $email }}">{{ $email }}</a>. Responderemos dentro de un plazo razonable.
      </p>

       </div>
</section>
@endsection