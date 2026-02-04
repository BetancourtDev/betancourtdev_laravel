<x-app-layout>

<x-slot name="title">Leads | Admin</x-slot>

@php
  $statusLabels = [
    'new' => 'Nuevos',
    'contacted' => 'Contactados',
    'qualified' => 'Calificados',
    'closed' => 'Cerrados',
    'spam' => 'Spam',
  ];

  $statusColors = [
    'new' => 'border-blue-500/30 bg-blue-500/10 text-blue-200',
    'contacted' => 'border-yellow-500/30 bg-yellow-500/10 text-yellow-200',
    'qualified' => 'border-purple-500/30 bg-purple-500/10 text-purple-200',
    'closed' => 'border-green-500/30 bg-green-500/10 text-green-200',
    'spam' => 'border-red-500/30 bg-red-500/10 text-red-200',
  ];

  $activeStatus = request('status');
@endphp


<div class="mx-auto max-w-7xl px-4 py-10" x-data="{ filtersOpen: false }">

  {{-- Header --}}
  <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
      <h1 class="text-3xl font-extrabold tracking-tight">Leads</h1>
      <p class="text-slate-400">Mini CRM · contactos recibidos desde la web.</p>
    </div>

    <div class="flex flex-wrap gap-2">
      <button type="button"
        class="btn-secondary rounded-xl px-4 py-2 inline-flex items-center gap-2"
        @click="filtersOpen = !filtersOpen">
        <span>Filtros</span>
        <span class="text-xs text-slate-300">
          @if(request('q') || request('status') || request('from') || request('to')) (activos) @endif
        </span>
      </button>

      <a href="{{ route('admin.leads.index') }}"
         class="btn-secondary rounded-xl px-4 py-2">
        Limpiar
      </a>
    </div>
  </div>

  {{-- KPIs / Status chips --}}
  <div class="mt-6 grid grid-cols-2 md:grid-cols-5 gap-3">
    @foreach($statuses as $st)
      @php
        $isActive = request('status') === $st;
        $label = $statusLabels[$st] ?? ucfirst($st);
        $color = $statusColors[$st] ?? 'border-white/10 bg-white/5 text-slate-200';
        $href = route('admin.leads.index', array_merge(request()->query(), ['status' => $isActive ? null : $st]));
      @endphp

      <a href="{{ $href }}"
         class="glass-card rounded-2xl px-4 py-3 border {{ $isActive ? 'border-[var(--color-primary)]/50' : 'border-white/10' }} hover:bg-white/5 transition">
        <div class="text-xs text-slate-400">{{ $label }}</div>
        <div class="mt-1 inline-flex items-center gap-2">
          <span class="inline-flex items-center rounded-full px-2 py-1 text-xs border {{ $color }}">
            {{ $st }}
          </span>
          <span class="text-xs text-slate-500">
            @if($isActive) mostrando @endif
          </span>
        </div>
      </a>
    @endforeach
  </div>

  {{-- Toast --}}
  @if(session('ok'))
    <div class="mt-6 rounded-2xl border border-green-500/30 bg-green-500/10 p-4 text-sm">
      {{ session('ok') }}
    </div>
  @endif

  {{-- Filters panel --}}
  <div class="mt-6 glass-card rounded-3xl p-4 md:p-6"
       x-show="filtersOpen"
       x-transition
       style="display:none;">
    <form class="grid gap-3 md:grid-cols-12" method="GET" action="{{ route('admin.leads.index') }}">
      <div class="md:col-span-5">
        <label class="text-xs text-slate-400">Buscar</label>
        <input name="q" value="{{ request('q') }}"
          class="form-input rounded-xl px-4 py-2 w-full"
          placeholder="Nombre, email o mensaje...">
      </div>

      <div class="md:col-span-3">
        <label class="text-xs text-slate-400">Estado</label>
        <select name="status" class="form-input rounded-xl px-4 py-2 w-full">
          <option value="">Todos</option>
          @foreach($statuses as $st)
            <option value="{{ $st }}" @selected(request('status')===$st)>{{ $st }}</option>
          @endforeach
        </select>
      </div>

      <div class="md:col-span-2">
        <label class="text-xs text-slate-400">Desde</label>
        <input name="from" type="date" value="{{ request('from') }}" class="form-input rounded-xl px-4 py-2 w-full">
      </div>

      <div class="md:col-span-2">
        <label class="text-xs text-slate-400">Hasta</label>
        <input name="to" type="date" value="{{ request('to') }}" class="form-input rounded-xl px-4 py-2 w-full">
      </div>

      <div class="md:col-span-12 flex gap-2 pt-2">
        <button class="btn-primary rounded-xl px-5 py-2 font-bold">Aplicar</button>
        <a href="{{ route('admin.leads.index') }}" class="btn-secondary rounded-xl px-5 py-2">Reset</a>
      </div>
    </form>
  </div>

  {{-- ===== Desktop: Table ===== --}}
  <div class="mt-6 glass-card rounded-3xl overflow-hidden hidden md:block">
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-white/5">
          <tr class="text-left">
            <th class="px-4 py-3">Lead</th>
            <th class="px-4 py-3">Estado</th>
            <th class="px-4 py-3">Origen</th>
            <th class="px-4 py-3">Fecha</th>
            <th class="px-4 py-3 text-right">Acciones</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-white/5">
          @forelse($leads as $lead)
            @php
              $badge = $statusColors[$lead->status] ?? 'border-white/10 bg-white/5 text-slate-200';
            @endphp

            <tr class="hover:bg-white/5 transition">
              <td class="px-4 py-3">
                <div class="flex items-start gap-3">
                  <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 grid place-items-center font-bold">
                    {{ mb_strtoupper(mb_substr($lead->name, 0, 1)) }}
                  </div>

                  <div class="min-w-0">
                    <div class="font-semibold truncate">{{ $lead->name }}</div>
                    <div class="text-slate-400 truncate">{{ $lead->email }}</div>
                    <div class="text-slate-400 line-clamp-1">{{ $lead->message }}</div>
                  </div>
                </div>
              </td>

              <td class="px-4 py-3">
                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs border {{ $badge }}">
                  {{ $lead->status }}
                </span>

                @if($lead->contacted_at)
                  <div class="text-xs text-slate-400 mt-1">
                    Contactado: {{ $lead->contacted_at->format('d/m/Y H:i') }}
                  </div>
                @endif
              </td>

              <td class="px-4 py-3 text-slate-300">
                {{ $lead->source ?? '-' }}
                @if($lead->utm_source)
                  <div class="text-xs text-slate-400">
                    utm: {{ $lead->utm_source }}{{ $lead->utm_medium ? ' / '.$lead->utm_medium : '' }}
                  </div>
                @endif
              </td>

              <td class="px-4 py-3 text-slate-300">
                {{ $lead->created_at->format('d/m/Y H:i') }}
              </td>

              <td class="px-4 py-3">
                <div class="flex items-center justify-end gap-2">
                  {{-- Copy --}}
                  <button type="button"
                    class="btn-secondary rounded-xl px-3 py-2"
                    onclick="navigator.clipboard?.writeText('{{ $lead->email }}')">
                    Copiar email
                  </button>

                  {{-- Quick mail --}}
                  <a class="btn-secondary rounded-xl px-3 py-2"
                     href="mailto:{{ $lead->email }}?subject={{ rawurlencode('Contacto desde Betancourt Dev') }}">
                    Email
                  </a>

                  {{-- Details --}}
                  <a href="{{ route('admin.leads.show', $lead) }}"
                     class="btn-primary rounded-xl px-4 py-2 inline-flex">
                    Ver
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-4 py-10 text-center text-slate-400">
                No hay leads todavía.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- ===== Mobile: Cards ===== --}}
  <div class="mt-6 grid gap-4 md:hidden">
    @forelse($leads as $lead)
      @php
        $badge = $statusColors[$lead->status] ?? 'border-white/10 bg-white/5 text-slate-200';
      @endphp

      <div class="glass-card rounded-3xl p-5 border border-white/10">
        <div class="flex items-start justify-between gap-3">
          <div class="min-w-0">
            <div class="font-bold truncate">{{ $lead->name }}</div>
            <div class="text-slate-400 text-sm truncate">{{ $lead->email }}</div>
          </div>

          <span class="inline-flex items-center rounded-full px-3 py-1 text-xs border {{ $badge }}">
            {{ $lead->status }}
          </span>
        </div>

        <div class="mt-3 text-slate-300 text-sm line-clamp-3">
          {{ $lead->message }}
        </div>

        <div class="mt-3 text-xs text-slate-400 flex flex-wrap gap-2">
          <span class="rounded-full border border-white/10 bg-white/5 px-2 py-1">
            {{ $lead->source ?? 'sin origen' }}
          </span>
          <span class="rounded-full border border-white/10 bg-white/5 px-2 py-1">
            {{ $lead->created_at->format('d/m/Y H:i') }}
          </span>
        </div>

        <div class="mt-4 flex gap-2">
          <a href="{{ route('admin.leads.show', $lead) }}" class="btn-primary rounded-xl px-4 py-2 w-full text-center">
            Ver detalle
          </a>

          <button type="button"
            class="btn-secondary rounded-xl px-4 py-2"
            onclick="navigator.clipboard?.writeText('{{ $lead->email }}')">
            Copiar
          </button>
        </div>
      </div>
    @empty
      <div class="glass-card rounded-3xl p-8 text-center text-slate-400">
        No hay leads todavía.
      </div>
    @endforelse
  </div>

  <div class="mt-6">
    {{ $leads->links() }}
  </div>
</div>
</x-app-layout>
