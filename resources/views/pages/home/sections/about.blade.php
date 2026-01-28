{{-- ABOUT / VALUES --}}
<section id="sobre-mi" class="mx-auto max-w-7xl px-4 py-20 md:py-32">
  <div class="grid lg:grid-cols-2 gap-16 items-center">
    <div class="space-y-6 reveal">
      <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-[var(--color-primary)]/10 to-[var(--color-accent)]/10 border border-[var(--color-primary)]/20">
        <span class="text-sm font-semibold text-[var(--color-primary)]">
          {{ $about['badge'] ?? 'Sobre mí' }}
        </span>
      </div>

      <h2 class="text-4xl md:text-5xl font-extrabold leading-tight">
        {{ $about['headline'] ?? 'Tecnología real para' }}
        <span class="block mt-2 text-[var(--color-primary)]">
          {{ $about['headline_highlight'] ?? 'negocios reales' }}
        </span>
      </h2>

      <div class="space-y-4 text-lg text-[var(--color-text-muted)] leading-relaxed">
        @foreach(($about['paragraphs'] ?? []) as $p)
          <p>{{ $p }}</p>
        @endforeach
      </div>

      <div class="flex gap-4 pt-4">
        <a href="https://wa.me/{{ $phone }}?text={{ $waTextBrief }}"
           target="_blank" rel="noopener"
           class="btn-primary inline-flex items-center justify-center rounded-2xl px-8 py-4">
          {{ $about['cta_primary'] ?? 'Hablar conmigo' }}
        </a>

        <a href="{{ $about['cta_secondary_href'] ?? '#servicios' }}"
           class="btn-secondary inline-flex items-center justify-center rounded-2xl px-8 py-4">
          {{ $about['cta_secondary'] ?? 'Ver servicios' }}
        </a>
      </div>
    </div>

    <div class="space-y-4 reveal">
      @foreach(($values ?? []) as $v)
        <div class="glass-card rounded-2xl p-6 group">
          <div class="flex items-start gap-4">
            <div class="text-4xl">{{ $v['icon'] ?? '✅' }}</div>

            <div class="flex-1">
              <h3 class="text-xl font-bold mb-2 group-hover:text-[var(--color-primary)] transition-colors">
                {{ $v['title'] ?? '' }}
              </h3>

              <p class="text-[var(--color-text-muted)]">
                {{ $v['description'] ?? '' }}
              </p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
