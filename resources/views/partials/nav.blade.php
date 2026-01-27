@php
  $phone = config('brand.whatsapp_phone');
  $waTextNav = rawurlencode(config('brand.whatsapp_default_text'));
@endphp

<header class="sticky top-0 z-50">
  {{-- Barra superior glass --}}
  <div class="mx-auto max-w-7xl px-4 pt-4">
    <div class="glass-card rounded-2xl px-4 py-3 md:px-6 md:py-4">
      <div class="flex items-center justify-between gap-3">

        {{-- Brand --}}
        <a href="{{ url('/') }}" class="flex items-center gap-3 group">
          <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-accent)] rounded-2xl blur-md opacity-40 group-hover:opacity-60 transition"></div>
            <div class="relative h-10 w-10 rounded-2xl border border-white/10 bg-slate-950/40 flex items-center justify-center">
              {{-- Podés reemplazar por tu logo --}}
              <span class="font-extrabold text-sm tracking-tight text-white">BD</span>
            </div>
          </div>

          <div class="leading-tight">
            <div class="font-extrabold text-white text-base md:text-lg">
              Betancourt Dev
            </div>
            <div class="text-xs text-[var(--color-text-muted)]">
              Web • Sistemas • SEO
            </div>
          </div>
        </a>

        {{-- Desktop nav --}}
        <nav class="hidden lg:flex items-center gap-6 text-sm font-semibold">
          <a href="#sobre-mi" class="text-slate-200/90 hover:text-white transition">Sobre mí</a>
          <a href="#servicios" class="text-slate-200/90 hover:text-white transition">Servicios</a>
          <a href="#proceso" class="text-slate-200/90 hover:text-white transition">Proceso</a>
          <a href="#testimonios" class="text-slate-200/90 hover:text-white transition">Testimonios</a>
          <a href="#faq" class="text-slate-200/90 hover:text-white transition">FAQ</a>
          <a href="#contacto" class="text-slate-200/90 hover:text-white transition">Contacto</a>
        </nav>

        {{-- Right actions --}}
        <div class="flex items-center gap-2">
          {{-- Botón secundario (desktop) --}}
          <a href="#contacto"
             class="hidden md:inline-flex items-center justify-center rounded-xl px-4 py-2 text-sm font-bold border-2 border-white/10 hover:border-white/20 hover:bg-white/5 transition">
            Agendar consulta
          </a>

          {{-- CTA WhatsApp --}}
          <a href="https://wa.me/{{ $phone }}?text={{ $waTextNav }}"
             target="_blank" rel="noopener"
             class="btn-primary inline-flex items-center justify-center rounded-xl px-4 py-2 text-sm md:text-base">
            Cotizar por WhatsApp
            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </a>

          {{-- Mobile menu button --}}
          <button
            type="button"
            class="lg:hidden inline-flex items-center justify-center rounded-xl px-3 py-2 border border-white/10 hover:border-white/20 hover:bg-white/5 transition"
            aria-controls="mobileMenu"
            aria-expanded="false"
            data-nav-toggle
          >
            <span class="sr-only">Abrir menú</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" data-nav-icon="open">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" data-nav-icon="close">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
      </div>

      {{-- Mobile menu --}}
      <div id="mobileMenu" class="lg:hidden hidden pt-4" data-nav-menu>
        <div class="h-px bg-white/10 mb-4"></div>

        <nav class="grid gap-2 text-sm font-semibold">
          @foreach([
            ['#sobre-mi','Sobre mí'],
            ['#servicios','Servicios'],
            ['#proceso','Proceso'],
            ['#testimonios','Testimonios'],
            ['#faq','FAQ'],
            ['#contacto','Contacto'],
          ] as $item)
            <a href="{{ $item[0] }}"
               class="rounded-xl px-4 py-3 border border-white/10 bg-slate-950/40 hover:bg-white/5 hover:border-white/20 transition"
               data-nav-link>
              {{ $item[1] }}
            </a>
          @endforeach
        </nav>

        <div class="mt-4 flex gap-2">
          <a href="#contacto"
             class="flex-1 inline-flex items-center justify-center rounded-xl px-4 py-3 font-bold border-2 border-white/10 hover:border-white/20 hover:bg-white/5 transition"
             data-nav-link>
            Agendar consulta
          </a>

          <a href="https://wa.me/{{ $phone }}?text={{ $waTextNav }}"
             target="_blank" rel="noopener"
             class="flex-1 btn-primary inline-flex items-center justify-center rounded-xl px-4 py-3 font-bold"
          >
            WhatsApp
          </a>
        </div>
      </div>
    </div>
  </div>
</header>
