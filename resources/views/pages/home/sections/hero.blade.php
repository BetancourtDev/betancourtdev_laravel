{{-- HERO SECTION --}}
<section class="mx-auto max-w-7xl px-4 pt-20 pb-16 md:pt-32 md:pb-24 relative overflow-hidden">
  <div class="grid lg:grid-cols-2 gap-16 items-center">
    <div class="space-y-8 fade-in-up">
      <div class="space-y-4">
        <div class="inline-block">
          <span class="tag">{{ $hero['badge'] ?? '👋 Hola, soy Kim Betancourt' }}</span>
        </div>

        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight leading-[1.1]">
          {{ $hero['headline'] ?? 'Desarrollo web' }}
          <span class="block mt-2 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-accent)] bg-clip-text text-transparent">
            {{ $hero['headline_highlight'] ?? 'que impulsa negocios' }}
          </span>
        </h1>

        <p class="text-xl md:text-2xl text-[var(--color-text-muted)] leading-relaxed max-w-xl">
          {{ $hero['subheadline'] ?? 'Creo sitios web y sistemas a medida para emprendedores y pymes que quieren diferenciarse con tecnología real.' }}
        </p>
      </div>

      <div class="flex flex-col sm:flex-row gap-4">
        <a href="https://wa.me/{{ $phone }}?text={{ $waText }}"
           target="_blank" rel="noopener"
           class="btn-primary inline-flex items-center justify-center rounded-2xl px-8 py-4 text-lg">
          {{ $hero['cta_primary'] ?? 'Cotizar proyecto' }}
          <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </a>

        <a href="{{ $hero['cta_secondary_href'] ?? '#servicios' }}"
           class="btn-secondary inline-flex items-center justify-center rounded-2xl px-8 py-4 text-lg">
          {{ $hero['cta_secondary'] ?? 'Ver servicios' }}
        </a>
      </div>

      <div class="flex flex-wrap gap-4 pt-4">
        @foreach(($hero['tags'] ?? []) as $tag)
          <span class="tag">{{ $tag }}</span>
        @endforeach
      </div>
    </div>

    {{-- Profile card with stats --}}
    <div class="glass-card rounded-3xl p-8 space-y-8 fade-in-up delay-2 float">
      <div class="flex items-start gap-6">
        <div class="relative">
          <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-accent)] rounded-3xl blur-xl opacity-50"></div>
          <img
            src="{{ $hero['profile_image'] ?? asset('img/kim_betancourt.avif') }}"
            alt="{{ $hero['profile_alt'] ?? 'Kim Betancourt' }}"
            class="relative h-24 w-24 rounded-3xl object-cover border-2 border-[var(--color-primary)]"
            loading="lazy" decoding="async"
          >
        </div>

        <div class="flex-1">
          <h3 class="text-2xl font-bold">{{ $hero['profile_title'] ?? 'Betancourt Dev' }}</h3>
          <p class="text-[var(--color-text-muted)] mt-1">{{ $hero['profile_subtitle'] ?? 'Desarrollo web / sistemas a medida' }}</p>

          <div class="flex items-center gap-2 mt-3">
            <div class="w-2 h-2 bg-[var(--color-primary)] rounded-full animate-pulse"></div>
            <span class="text-sm text-[var(--color-text-muted)]">
              {{ $hero['availability_text'] ?? 'Disponible para nuevos proyectos' }}
            </span>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-3 gap-4">
        @foreach(($hero['stats'] ?? []) as $stat)
          <div class="stat-card glass-card rounded-2xl p-4 text-center">
            <div class="text-3xl font-bold bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-accent)] bg-clip-text text-transparent">
              {{ $stat['value'] ?? '' }}
            </div>
            <div class="text-sm text-[var(--color-text-muted)] mt-1">
              {{ $stat['label'] ?? '' }}
            </div>
          </div>
        @endforeach
      </div>

      <a
        class="block text-center rounded-2xl px-6 py-3 font-semibold border-2 border-[var(--color-primary)] text-[var(--color-primary)] hover:bg-[var(--color-primary)] hover:text-[var(--color-bg)] transition-all"
        href="{{ $hero['profile_cta_href'] ?? '#contacto' }}"
      >
        {{ $hero['profile_cta'] ?? 'Prefiero formulario' }}
      </a>
    </div>
  </div>
</section>
