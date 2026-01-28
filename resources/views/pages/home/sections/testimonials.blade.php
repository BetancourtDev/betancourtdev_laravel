@php
  $testimonials = config('landing.testimonials', []);
@endphp

{{-- TESTIMONIOS --}}
<section id="testimonios" class="mx-auto max-w-7xl px-4 py-20 md:py-32">
  <div class="text-center max-w-3xl mx-auto mb-16 reveal">
    <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-[var(--color-primary)]/10 to-[var(--color-accent)]/10 border border-[var(--color-primary)]/20 mb-6">
      <span class="text-sm font-semibold text-[var(--color-primary)]">Testimonios</span>
    </div>

    <h2 class="text-4xl md:text-5xl font-extrabold mb-6">
      Lo que dicen mis clientes
    </h2>

    <p class="text-xl text-[var(--color-text-muted)]">
      Confianza real, feedback real. (Podés reemplazar estos testimonios cuando quieras.)
    </p>
  </div>

  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($testimonials as $i => $t)
      @php
        $name = $t['name'] ?? 'Cliente';
        $position = $t['position'] ?? '';
        $photo = $t['photo'] ?? null;
        $feedback = $t['feedback'] ?? '';
        $initials = collect(explode(' ', $name))
          ->filter()
          ->map(fn($p) => mb_strtoupper(mb_substr($p, 0, 1)))
          ->take(2)
          ->implode('');
      @endphp

      <div class="testimonial-card rounded-2xl p-8 reveal" style="animation-delay: {{ $i * 0.1 }}s">
        {{-- Stars --}}
        <div class="flex gap-1 mb-5" aria-label="5 estrellas">
          @for($j = 0; $j < 5; $j++)
            <svg class="w-5 h-5 text-[var(--color-accent)]" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          @endfor
        </div>

        {{-- Quote --}}
        <div class="relative">
          <div class="absolute -top-3 -left-2 text-5xl text-white/10 select-none">“</div>
          <p class="text-[var(--color-text-muted)] leading-relaxed mb-8 relative">
            {{ $feedback }}
          </p>
        </div>

        {{-- Person --}}
        <div class="flex items-center gap-4">
          @if($photo)
            <img
              src="{{ $photo }}"
              alt="{{ $name }}"
              loading="lazy"
              class="w-12 h-12 rounded-full object-cover border border-white/10"
            >
          @else
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-accent)]
                        flex items-center justify-center text-white font-bold">
              {{ $initials }}
            </div>
          @endif

          <div>
            <div class="font-bold">{{ $name }}</div>
            @if($position)
              <div class="text-sm text-[var(--color-text-muted)]">{{ $position }}</div>
            @endif
          </div>
        </div>
      </div>
    @endforeach
  </div>

  {{-- CTA mini --}}
  <div class="mt-12 text-center reveal">
    <p class="text-sm text-[var(--color-text-muted)]">
      ¿Querés resultados así en tu proyecto?
    </p>

    <div class="mt-4 flex flex-col sm:flex-row gap-3 justify-center">
      <a href="#contacto" class="btn-primary inline-flex items-center justify-center rounded-2xl px-6 py-3 font-bold">
        Pedir propuesta
      </a>
      <a href="#servicios" class="btn-secondary inline-flex items-center justify-center rounded-2xl px-6 py-3 font-semibold">
        Ver servicios
      </a>
    </div>
  </div>
</section>
