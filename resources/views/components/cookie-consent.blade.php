@php
  $consent = request()->cookie('bd_cookie_consent'); // accepted | rejected | null
@endphp

@if(!$consent)
  <div
    class="fixed bottom-0 inset-x-0 z-50 px-4 pb-4"
    data-cookie-banner
  >
    <div class="mx-auto max-w-7xl">
      <div class="glass-card rounded-2xl p-4 md:p-5 border border-white/10">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
          <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
            Usamos cookies <strong class="text-slate-100">necesarias</strong> y (opcionalmente) <strong class="text-slate-100">analíticas</strong> para mejorar tu experiencia.
            <a class="underline text-[var(--color-primary)] hover:opacity-80" href="{{ route('cookies') }}">Ver política de cookies</a>.
          </p>

          <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
            <form method="POST" action="{{ route('cookie.reject') }}">
              @csrf
              <button type="submit"
                class="btn-secondary inline-flex items-center justify-center rounded-xl px-4 py-2 text-sm font-bold">
                Rechazar
              </button>
            </form>

            <form method="POST" action="{{ route('cookie.accept') }}">
              @csrf
              <button type="submit"
                class="btn-primary inline-flex items-center justify-center rounded-xl px-4 py-2 text-sm font-bold">
                Aceptar
              </button>
            </form>
          </div>
        </div>

        <button
          type="button"
          class="mt-3 text-xs text-[var(--color-text-muted)] underline hover:opacity-80"
          data-cookie-dismiss
        >
          Cerrar
        </button>
      </div>
    </div>
  </div>

  {{-- Sin Alpine: cerrar banner con JS simple --}}
  @push('scripts')
  <script>
    (() => {
      const banner = document.querySelector('[data-cookie-banner]');
      const dismiss = document.querySelector('[data-cookie-dismiss]');
      if (!banner || !dismiss) return;
      dismiss.addEventListener('click', () => banner.remove());
    })();
  </script>
  @endpush
@endif
