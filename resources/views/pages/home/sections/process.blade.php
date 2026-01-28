@props([
  'process' => [],
  'phone' => null,
  'waTextBrief' => null,
])

<section id="proceso" class="mx-auto max-w-7xl px-4 py-20 md:py-32">
  <div class="text-center max-w-3xl mx-auto mb-16 reveal">
    <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-[var(--color-primary)]/10 to-[var(--color-accent)]/10 border border-[var(--color-primary)]/20 mb-6">
      <span class="text-sm font-semibold text-[var(--color-primary)]">Proceso</span>
    </div>

    <h2 class="text-4xl md:text-5xl font-extrabold mb-6">
      Cómo trabajo
    </h2>

    <p class="text-xl text-[var(--color-text-muted)]">
      Pasos simples, claros y medibles para que no haya incertidumbre.
    </p>
  </div>

  <div class="relative">
    {{-- línea sutil en desktop --}}
    <div class="hidden lg:block absolute left-8 right-8 top-[26px] h-[2px] opacity-30
                bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-accent)]"></div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
      @foreach($process as $i => $p)
        @php
          $n = str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT);
        @endphp

        <div class="reveal" style="animation-delay: {{ $i * 0.08 }}s">
          <div class="glass-card rounded-2xl p-8 h-full relative overflow-hidden">

            {{-- glow decor --}}
            <div class="absolute -top-24 -right-24 h-48 w-48 rounded-full blur-3xl opacity-20
                        bg-[var(--color-primary)]"></div>

            <div class="flex items-start gap-4">
              <div class="flex-shrink-0">
                <div class="w-14 h-14 rounded-2xl grid place-items-center
                            bg-[var(--color-primary)]/10 border border-[var(--color-primary)]/20">
                  <span class="text-2xl font-extrabold text-[var(--color-primary)]">
                    {{ $n }}
                  </span>
                </div>
              </div>

              <div class="flex-1">
                <h3 class="text-2xl font-bold mb-3">
                  {{ $p['title'] ?? '' }}
                </h3>

                <p class="text-[var(--color-text-muted)] leading-relaxed">
                  {{ $p['description'] ?? '' }}
                </p>
              </div>
            </div>

            <div class="mt-6 h-[1px] bg-white/5"></div>

            <div class="mt-4 flex items-center justify-between gap-3 text-xs text-[var(--color-text-muted)]">
              <div class="flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-[var(--color-primary)]/70"></span>
                <span>Etapa {{ $n }}</span>
              </div>

              <span class="opacity-80">Entrega con checklist</span>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- CTA final --}}
    <div class="mt-12 glass-card rounded-3xl p-8 md:p-10 reveal">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
          <h3 class="text-2xl md:text-3xl font-extrabold">
            ¿Listo para arrancar sin vueltas?
          </h3>
          <p class="mt-2 text-[var(--color-text-muted)]">
            Me pasás tu idea, te respondo con alcance + tiempos + propuesta clara.
          </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
          <a href="https://wa.me/{{ $phone }}?text={{ $waTextBrief }}"
             target="_blank" rel="noopener"
             class="btn-primary inline-flex items-center justify-center rounded-2xl px-7 py-3 font-bold">
            Pedir propuesta
          </a>

          <a href="#contacto"
             class="btn-secondary inline-flex items-center justify-center rounded-2xl px-7 py-3 font-semibold">
            Prefiero formulario
          </a>
        </div>
      </div>
    </div>

  </div>
</section>
