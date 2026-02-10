@props([
  'phone' => null,
  'waText' => null,
])

<section id="contacto" class="mx-auto max-w-7xl px-4 py-20 md:py-32 mb-20">
  <div class="glass-card rounded-3xl p-8 md:p-16">
    <div class="grid lg:grid-cols-2 gap-16 items-center">

      {{-- Left --}}
      <div class="space-y-6 reveal">
        <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-[var(--color-primary)]/10 to-[var(--color-accent)]/10 border border-[var(--color-primary)]/20">
          <span class="text-sm font-semibold text-[var(--color-primary)]">Contacto</span>
        </div>

        <h2 class="text-4xl md:text-5xl font-extrabold leading-tight">
          ¿Hablamos de tu proyecto?
        </h2>

        <p class="text-xl text-[var(--color-text-muted)] leading-relaxed">
          Contame qué querés construir y te respondo con una propuesta clara en menos de 24 horas.
        </p>

        <div class="space-y-4 pt-4">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-[var(--color-primary)]/10 flex items-center justify-center">
              <svg class="w-6 h-6 text-[var(--color-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div>
              <div class="font-semibold">Respuesta rápida</div>
              <div class="text-sm text-[var(--color-text-muted)]">En menos de 24 horas hábiles</div>
            </div>
          </div>

          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-[var(--color-primary)]/10 flex items-center justify-center">
              <svg class="w-6 h-6 text-[var(--color-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div>
              <div class="font-semibold">Sin compromiso</div>
              <div class="text-sm text-[var(--color-text-muted)]">Primera consulta gratis</div>
            </div>
          </div>
        </div>

        <a
          href="https://wa.me/{{ $phone }}?text={{ $waText }}"
          target="_blank" rel="noopener"
          class="btn-primary inline-flex items-center justify-center rounded-2xl px-8 py-4 text-lg"
        >
          <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
          </svg>
          Escribir por WhatsApp
        </a>
      </div>

      {{-- Right --}}
      <div class="reveal">
        <x-flash-messages />

        <form method="POST" action="{{ route('contact.send') }}" class="space-y-6" id="contact-form">
          @csrf

          {{-- honeypot --}}
          <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

          {{-- recaptcha v3 token --}}
        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">


          <div>
            <label for="name" class="block text-sm font-semibold mb-2">Nombre</label>
            <input id="name" name="name" required value="{{ old('name') }}"
                   class="form-input w-full rounded-xl px-4 py-3">
          </div>

          <div>
            <label for="email" class="block text-sm font-semibold mb-2">Email</label>
            <input id="email" name="email" type="email" required value="{{ old('email') }}"
                   class="form-input w-full rounded-xl px-4 py-3">
          </div>

          <div> <label for="phone" class="block text-sm font-semibold mb-2">Teléfono</label> <input id="phone" name="phone" type="tel" class="form-input w-full rounded-xl px-4 py-3" placeholder="Tu número"> </div>

          <div>
            <label for="message" class="block text-sm font-semibold mb-2">¿Qué necesitás?</label>
            <textarea id="message" name="message" rows="5" required
                      class="form-input w-full rounded-xl px-4 py-3 resize-none">{{ old('message') }}</textarea>
          </div>

          <button type="submit" class="btn-primary w-full rounded-2xl px-8 py-4 font-bold text-lg" id="contact-submit">
            Enviar mensaje
          </button>
        </form>
      </div>

    </div>
  </div>
</section>


