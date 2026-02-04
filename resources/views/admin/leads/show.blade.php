  <x-app-layout>
    <x-slot name="title">Lead: {{ $lead->name }} | Admin</x-slot>

    @php
      // helpers de UI
      $status = $lead->status ?? 'new';

      $statusStyles = [
        'new' => 'bg-blue-500/10 text-blue-200 border-blue-500/20',
        'contacted' => 'bg-emerald-500/10 text-emerald-200 border-emerald-500/20',
        'qualified' => 'bg-violet-500/10 text-violet-200 border-violet-500/20',
        'closed' => 'bg-slate-500/10 text-slate-200 border-white/10',
        'spam' => 'bg-red-500/10 text-red-200 border-red-500/20',
      ];

      $badgeClass = $statusStyles[$status] ?? 'bg-white/5 text-slate-200 border-white/10';

      $mailTo = 'mailto:' . $lead->email . '?subject=' . rawurlencode('Betancourt Dev | Sobre tu consulta')
        . '&body=' . rawurlencode("Hola {$lead->name}!\n\nGracias por escribir.\n\nVi tu mensaje:\n\"{$lead->message}\"\n\nContame un poco más:\n- Objetivo\n- Plazo ideal\n- Presupuesto aproximado\n\nAbrazo,\nKim Betancourt");

      $waPhone = config('brand.whatsapp_phone');
      $waText = rawurlencode("Hola {$lead->name}! Soy Kim (Betancourt Dev). Vi tu consulta:\n\"{$lead->message}\"\n\nPara orientarte mejor:\n1) ¿Cuál es el objetivo?\n2) ¿Tenés fecha ideal?\n3) ¿Tenés presupuesto estimado?\n");
      $waLink = $waPhone ? "https://wa.me/{$waPhone}?text={$waText}" : null;
    @endphp

    <div class="mx-auto max-w-7xl px-4 py-8 lg:py-10">
      {{-- Top bar --}}
      <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="space-y-2">
          <a href="{{ route('admin.leads.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-slate-100">
            <span>←</span> <span>Volver a Leads</span>
          </a>

          <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-3">
            <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight">{{ $lead->name }}</h1>

            <span class="inline-flex items-center gap-2 rounded-full border px-3 py-1 text-sm {{ $badgeClass }}">
              <span class="inline-block h-2 w-2 rounded-full bg-current opacity-70"></span>
              <span class="capitalize">{{ $status }}</span>
            </span>
          </div>

          <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:gap-4 text-slate-400">
            <a href="mailto:{{ $lead->email }}" class="hover:text-slate-100">{{ $lead->email }}</a>
            <span class="hidden sm:inline">·</span>
            <span>Creado: {{ $lead->created_at->format('d/m/Y H:i') }}</span>
            @if($lead->contacted_at)
              <span class="hidden sm:inline">·</span>
              <span>Contactado: {{ $lead->contacted_at->format('d/m/Y H:i') }}</span>
            @endif
          </div>

          <div>
    <div class="text-xs text-slate-400">Teléfono</div>
    <div class="font-semibold text-sm text-slate-200">
        {{ $lead->phone ?? '-' }}
    </div>
</div>

        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
          <a href="{{ $mailTo }}"
            class="btn-secondary rounded-2xl px-5 py-3 font-semibold inline-flex items-center justify-center">
            Responder por email
          </a>

          @if($waLink)
            <a href="{{ $waLink }}" target="_blank" rel="noopener"
              class="btn-primary rounded-2xl px-5 py-3 font-bold inline-flex items-center justify-center">
              WhatsApp
            </a>
          @endif
        </div>
      </div>

      @if(session('ok'))
        <div class="mt-6 rounded-2xl border border-green-500/30 bg-green-500/10 p-4 text-sm">
          {{ session('ok') }}
        </div>
      @endif

      {{-- Main grid --}}
      <div class="mt-8 grid gap-6 lg:grid-cols-3">
        {{-- Left: message + quick actions --}}
        <div class="lg:col-span-2 space-y-6">
          <div class="glass-card rounded-3xl p-6 sm:p-8">
            <div class="flex items-start justify-between gap-4">
              <div>
                <h2 class="text-xl font-bold">Mensaje</h2>
                <p class="text-slate-400 text-sm mt-1">Texto tal cual llegó desde el formulario.</p>
              </div>

              <div class="flex gap-2">
                <button type="button"
                  class="btn-secondary rounded-xl px-4 py-2 text-sm"
                  onclick="navigator.clipboard.writeText(@js($lead->message))">
                  Copiar
                </button>
              </div>
            </div>

            <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 p-5">
              <p class="text-slate-100 leading-relaxed whitespace-pre-line">{{ $lead->message }}</p>
            </div>
          </div>

          <div class="glass-card rounded-3xl p-6 sm:p-8">
            <h3 class="text-lg font-bold mb-4">Acciones</h3>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
              <form method="POST" action="{{ route('admin.leads.contacted', $lead) }}">
                @csrf @method('PATCH')
                <button
                  class="btn-primary rounded-2xl px-5 py-3 font-bold w-full sm:w-auto"
                  @disabled($lead->contacted_at)
                  title="{{ $lead->contacted_at ? 'Ya está contactado' : '' }}"
                >
                  {{ $lead->contacted_at ? 'Ya contactado ✅' : 'Marcar como contactado' }}
                </button>
              </form>

              <form method="POST" action="{{ route('admin.leads.status', $lead) }}" class="flex gap-2">
                @csrf @method('PATCH')

                <select name="status" class="form-input rounded-xl px-4 py-2">
                  @foreach($statuses as $st)
                    <option value="{{ $st }}" @selected($lead->status===$st)>{{ $st }}</option>
                  @endforeach
                </select>

                <button class="btn-secondary rounded-xl px-4 py-2 font-semibold">
                  Guardar
                </button>
              </form>
            </div>

            <p class="mt-4 text-xs text-slate-400">
              Tip: marcar como <b>spam</b> si detectás bots. Marcar como <b>qualified</b> si hay fit real.
            </p>
          </div>
        </div>

        {{-- Right: lead details --}}
        <aside class="glass-card rounded-3xl p-6 sm:p-8 space-y-6">
          <div>
            <h3 class="text-lg font-bold">Lead details</h3>
            <p class="text-slate-400 text-sm mt-1">Metadata útil para seguimiento.</p>
          </div>

          <div class="grid gap-4">
            <div>
              <div class="text-xs text-slate-400">Origen</div>
              <div class="font-semibold">{{ $lead->source ?? '-' }}</div>
            </div>

            <div>
              <div class="text-xs text-slate-400">UTM</div>
              <div class="mt-2 flex flex-wrap gap-2">
                <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs">
                  source: {{ $lead->utm_source ?? '-' }}
                </span>
                <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs">
                  medium: {{ $lead->utm_medium ?? '-' }}
                </span>
                <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs">
                  campaign: {{ $lead->utm_campaign ?? '-' }}
                </span>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <div class="text-xs text-slate-400">IP</div>
                <div class="text-sm text-slate-200">{{ $lead->ip ?? '-' }}</div>
              </div>
              <div>
                <div class="text-xs text-slate-400">Creado</div>
                <div class="text-sm text-slate-200">{{ $lead->created_at->format('d/m/Y H:i') }}</div>
              </div>
            </div>

            <div>
              <div class="text-xs text-slate-400">User Agent</div>
              <div class="mt-2 text-xs text-slate-400 break-words rounded-2xl border border-white/10 bg-white/5 p-3">
                {{ $lead->user_agent ?? '-' }}
              </div>
            </div>

            <div>
              <div class="text-xs text-slate-400">Contactado</div>
              <div class="text-sm text-slate-200">
                {{ $lead->contacted_at ? $lead->contacted_at->format('d/m/Y H:i') : '-' }}
              </div>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </x-app-layout>
