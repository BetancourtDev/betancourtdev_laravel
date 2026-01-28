@props([
  'stack' => [],
  'brand' => [],
  'profile' => [],
])

<section id="stack" class="mx-auto max-w-7xl px-4 py-20 md:py-32">
  <div class="text-center max-w-3xl mx-auto mb-12 reveal">
    <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-[var(--color-primary)]/10 to-[var(--color-accent)]/10 border border-[var(--color-primary)]/20 mb-6">
      <span class="text-sm font-semibold text-[var(--color-primary)]">Stack</span>
    </div>

    <h2 class="text-4xl md:text-5xl font-extrabold mb-5">
      Tecnologías y prácticas
    </h2>

    <p class="text-xl text-[var(--color-text-muted)]">
      <span class="text-slate-100 font-semibold">{{ $profile['role'] ?? 'Full-stack Developer' }}</span>
      · {{ $profile['headline'] ?? 'Laravel · Performance · Seguridad' }}
    </p>

    <p class="mt-4 text-[var(--color-text-muted)]">
      {{ $profile['summary'] ?? '' }}
    </p>

    <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
      <a href="{{ $brand['linkedin_url'] ?? '#' }}"
         class="btn-secondary inline-flex items-center justify-center rounded-2xl px-6 py-3 font-semibold"
         target="_blank" rel="noopener">
        LinkedIn
      </a>

      <a href="{{ $brand['github_url'] ?? '#' }}"
         class="btn-secondary inline-flex items-center justify-center rounded-2xl px-6 py-3 font-semibold"
         target="_blank" rel="noopener">
        GitHub
      </a>

      <a href="{{ $brand['cv_url'] ?? '#' }}"
         class="btn-primary inline-flex items-center justify-center rounded-2xl px-6 py-3 font-bold"
         target="_blank" rel="noopener">
        Descargar CV
      </a>
    </div>

    <div class="mt-7 text-sm text-[var(--color-text-muted)]">
      <span class="text-slate-100 font-semibold">{{ $brand['location'] ?? 'Buenos Aires, Argentina' }}</span>
      · <span class="text-slate-100 font-semibold">{{ $brand['availability'] ?? '' }}</span>
      @if(!empty($profile['open_to']))
        · <span class="opacity-90">Open to:</span>
        <span class="text-slate-100 font-semibold">{{ implode(' · ', $profile['open_to']) }}</span>
      @endif
    </div>
  </div>

  <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($stack as $i => $b)
      <div class="glass-card rounded-2xl p-6 reveal" style="animation-delay: {{ $i * 0.08 }}s">
        <div class="text-4xl mb-4">{{ $b['icon'] ?? '⚙️' }}</div>
        <h3 class="text-xl font-bold mb-4">{{ $b['title'] ?? '' }}</h3>

        <ul class="space-y-3 text-sm text-[var(--color-text-muted)]">
          @foreach(($b['technologies'] ?? []) as $it)
            <li class="flex items-start gap-2">
              <span class="mt-1 text-[var(--color-primary)]">•</span>
              <span>{{ $it }}</span>
            </li>
          @endforeach
        </ul>
      </div>
    @endforeach
  </div>
</section>
