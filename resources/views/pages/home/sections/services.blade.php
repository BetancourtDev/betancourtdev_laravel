@php
  $services = config('landing.services', []);
@endphp

{{-- SERVICIOS --}}
<section id="servicios" class="mx-auto max-w-7xl px-4 py-20 md:py-32">
  <div class="text-center max-w-3xl mx-auto mb-16 reveal">
    <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-[var(--color-primary)]/10 to-[var(--color-accent)]/10 border border-[var(--color-primary)]/20 mb-6">
      <span class="text-sm font-semibold text-[var(--color-primary)]">Servicios</span>
    </div>

    <h2 class="text-4xl md:text-5xl font-extrabold mb-6">
      ¿Qué hago?
    </h2>

    <p class="text-xl text-[var(--color-text-muted)]">
      Elijo la solución según tu objetivo, no al revés.
    </p>
  </div>

  <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($services as $i => $s)
      @php
        $title = $s['title'] ?? '';
        $waMsg = rawurlencode("Hola Kim! Me interesa: {$title}. Mi idea es: _____.");
      @endphp

      <div class="service-card reveal" style="animation-delay: {{ $i * 0.1 }}s">
        <div class="text-5xl mb-6">{{ $s['icon'] ?? '✨' }}</div>

        <h3 class="text-2xl font-bold mb-3">{{ $title }}</h3>
        <p class="text-[var(--color-text-muted)] mb-6">{{ $s['description'] ?? '' }}</p>

        <ul class="space-y-3 mb-8">
          @foreach(($s['bullets'] ?? []) as $b)
            <li class="flex items-center gap-3 text-sm">
              <svg class="w-5 h-5 text-[var(--color-primary)] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <span>{{ $b }}</span>
            </li>
          @endforeach
        </ul>

        <a href="https://wa.me/{{ $phone }}?text={{ $waMsg }}"
           target="_blank" rel="noopener"
           class="btn-secondary inline-flex w-full items-center justify-center rounded-xl px-6 py-3 group">
          Consultar
          <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </a>
      </div>
    @endforeach
  </div>
</section>
