@php
  $faqs = config('landing.faqs', []);
@endphp

{{-- FAQ --}}
<section id="faq" class="mx-auto max-w-4xl px-4 py-20 md:py-32">
  <div class="text-center mb-16 reveal">
    <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-[var(--color-primary)]/10 to-[var(--color-accent)]/10 border border-[var(--color-primary)]/20 mb-6">
      <span class="text-sm font-semibold text-[var(--color-primary)]">FAQ</span>
    </div>

    <h2 class="text-4xl md:text-5xl font-extrabold mb-6">
      Preguntas frecuentes
    </h2>

    <p class="text-xl text-[var(--color-text-muted)]">
      Respuestas cortas, claras y sin vueltas.
    </p>
  </div>

  <div class="space-y-4" x-data="{ open: 0 }">
    @foreach($faqs as $i => $f)
      @php
        $q = $f['question'] ?? '';
        $a = $f['answer'] ?? '';
        $id = $i + 1;
      @endphp

      <div class="faq-item rounded-2xl overflow-hidden reveal" style="animation-delay: {{ $i * 0.08 }}s">
        <button
          type="button"
          class="w-full flex items-start justify-between gap-6 p-6 md:p-8 text-left"
          @click="open = (open === {{ $id }} ? 0 : {{ $id }})"
          :aria-expanded="open === {{ $id }}"
          aria-controls="faq-{{ $id }}"
        >
          <div class="flex items-start gap-3">
            <span class="mt-1 text-[var(--color-primary)] font-bold">→</span>
            <span class="text-lg md:text-xl font-bold leading-snug">
              {{ $q }}
            </span>
          </div>

          <span class="flex-shrink-0 mt-1">
            <svg
              class="w-6 h-6 transition-transform duration-200"
              :class="open === {{ $id }} ? 'rotate-45 text-[var(--color-primary)]' : 'rotate-0 text-white/70'"
              fill="none" stroke="currentColor" viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14"/>
            </svg>
          </span>
        </button>

        <div
          id="faq-{{ $id }}"
          x-show="open === {{ $id }}"
          x-collapse
          class="px-6 md:px-8 pb-6 md:pb-8"
        >
          <div class="h-[1px] bg-white/5 mb-5"></div>
          <p class="text-[var(--color-text-muted)] leading-relaxed pl-7">
            {{ $a }}
          </p>
        </div>
      </div>
    @endforeach
  </div>

  {{-- CTA mini --}}
  <div class="mt-12 text-center reveal">
    <p class="text-sm text-[var(--color-text-muted)]">
      ¿Seguís con dudas? Te respondo rápido.
    </p>

    <div class="mt-4 flex flex-col sm:flex-row gap-3 justify-center">
      <a href="#contacto" class="btn-primary inline-flex items-center justify-center rounded-2xl px-6 py-3 font-bold">
        Escribirme
      </a>
      <a href="#servicios" class="btn-secondary inline-flex items-center justify-center rounded-2xl px-6 py-3 font-semibold">
        Ver servicios
      </a>
    </div>
  </div>
</section>
