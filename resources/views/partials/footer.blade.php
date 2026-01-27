<footer class="border-t border-white/10">
  <div class="mx-auto max-w-6xl px-4 py-10 text-sm text-slate-400">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
      <div>© {{ date('Y') }} Betancourt Dev</div>
      <div class="flex gap-4">
        <a class="hover:text-white" href="{{ route('privacy') }}">Privacidad</a>
        <a class="hover:text-white" href="{{ route('cookies') }}">Cookies</a>
      </div>
    </div>
  </div>
</footer>
