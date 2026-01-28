@extends('layouts.app')

@section('title', 'Leads | Admin')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-10">
  <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
      <h1 class="text-3xl font-extrabold">Leads</h1>
      <p class="text-slate-400">Gestión de contactos recibidos desde la web.</p>
    </div>

    <form class="flex flex-col gap-2 md:flex-row md:items-center" method="GET" action="{{ route('admin.leads.index') }}">
      <input name="q" value="{{ request('q') }}"
        class="form-input rounded-xl px-4 py-2 w-full md:w-72"
        placeholder="Buscar por nombre, email o mensaje...">

      <select name="status" class="form-input rounded-xl px-4 py-2">
        <option value="">Estado (todos)</option>
        @foreach($statuses as $st)
          <option value="{{ $st }}" @selected(request('status')===$st)>{{ $st }}</option>
        @endforeach
      </select>

      <input name="from" type="date" value="{{ request('from') }}" class="form-input rounded-xl px-4 py-2">
      <input name="to" type="date" value="{{ request('to') }}" class="form-input rounded-xl px-4 py-2">

      <button class="btn-primary rounded-xl px-5 py-2 font-bold">Filtrar</button>
    </form>
  </div>

  @if(session('ok'))
    <div class="mt-6 rounded-2xl border border-green-500/30 bg-green-500/10 p-4 text-sm">
      {{ session('ok') }}
    </div>
  @endif

  <div class="mt-8 glass-card rounded-3xl overflow-hidden">
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-white/5">
          <tr class="text-left">
            <th class="px-4 py-3">Lead</th>
            <th class="px-4 py-3">Estado</th>
            <th class="px-4 py-3">Origen</th>
            <th class="px-4 py-3">Fecha</th>
            <th class="px-4 py-3"></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
          @forelse($leads as $lead)
            <tr class="hover:bg-white/5">
              <td class="px-4 py-3">
                <div class="font-semibold">{{ $lead->name }}</div>
                <div class="text-slate-400">{{ $lead->email }}</div>
                <div class="text-slate-400 line-clamp-1">{{ $lead->message }}</div>
              </td>

              <td class="px-4 py-3">
                <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1">
                  {{ $lead->status }}
                </span>
                @if($lead->contacted_at)
                  <div class="text-xs text-slate-400 mt-1">Contactado: {{ $lead->contacted_at->format('d/m/Y H:i') }}</div>
                @endif
              </td>

              <td class="px-4 py-3 text-slate-300">
                {{ $lead->source ?? '-' }}
                @if($lead->utm_source)
                  <div class="text-xs text-slate-400">utm: {{ $lead->utm_source }}</div>
                @endif
              </td>

              <td class="px-4 py-3 text-slate-300">
                {{ $lead->created_at->format('d/m/Y H:i') }}
              </td>

              <td class="px-4 py-3 text-right">
                <a href="{{ route('admin.leads.show', $lead) }}"
                   class="btn-secondary rounded-xl px-4 py-2 inline-flex">
                  Ver
                </a>
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

  <div class="mt-6">
    {{ $leads->links() }}
  </div>
</div>
@endsection
