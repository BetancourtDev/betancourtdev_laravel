@extends('layouts.public')

@section('title','Política de Cookies | Betancourt Dev')
@section('meta_description','Información sobre el uso de cookies en Betancourt Dev: necesarias y analíticas.')

@section('content')
<section class="mx-auto max-w-4xl px-4 pt-16 pb-20">
  <div class="glass-card rounded-3xl p-8 md:p-12">
    <span class="tag">Legal</span>
    <h1 class="mt-4 text-4xl md:text-5xl font-extrabold">Política de Cookies</h1>
    <p class="mt-4 text-[var(--color-text-muted)]">
      Usamos cookies para funciones necesarias del sitio y, si aceptás, cookies analíticas para mejorar la experiencia.
    </p>

    <div class="mt-8 space-y-5 text-[var(--color-text-muted)] leading-relaxed">
      <div>
        <h2 class="text-xl font-bold text-slate-100">Cookies necesarias</h2>
        <p>Permiten funciones básicas como recordar tu preferencia de consentimiento.</p>
      </div>

      <div>
        <h2 class="text-xl font-bold text-slate-100">Cookies analíticas (opcional)</h2>
        <p>Se usan para medir uso del sitio y mejorar contenido/experiencia. Solo se activan si aceptás.</p>
      </div>

      <div>
        <h2 class="text-xl font-bold text-slate-100">Cómo gestionar cookies</h2>
        <p>Podés borrar o bloquear cookies desde la configuración de tu navegador.</p>
      </div>
    </div>

    <div class="mt-10">
      <a href="{{ url('/') }}" class="btn-secondary inline-flex items-center justify-center rounded-2xl px-6 py-3 font-semibold">
        Volver al inicio
      </a>
    </div>
  </div>
</section>
@endsection
