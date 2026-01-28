@extends('layouts.app')

@section('title', 'Lead | Admin')

@section('content')
<div class="mx-auto max-w-5xl px-4 py-10">
  <div class="flex items-start justify-between gap-6">
    <div>
      <a href="{{ route('admin.leads.index') }}" class="text-slate-400 hover:text-slate-100">← Volver</a>
      <h1 class="mt-3 text-3xl font-extrabold">{{ $lead->name }}</h1>
      <p class="text-slate-400">{{ $lead->email }}</p>
    </div>

    <div class="flex flex-col gap-2">
      <form method="POST" action="{{ route('admin.leads.contacted', $lead) }}">
        @csrf @method('PATCH')
        <button class="btn-primary rounded-2xl px-5 py-3 font-bold">
          Marcar contactado
        </button>
      </form>

      <form method="POST" action="{{ route('admin.leads.status', $lead) }}" class="flex gap-2">
        @csrf @method('PATCH')
        <select name="status" class="form-input rounded-xl px-4 py-2">
          @foreach($statuses as $st)
            <option value="{{ $st }}" @selected($lead->status===$st)>{{ $st }}</option>
          @endforeach
        </select>
        <button class="btn-secondary rounded-xl px-4 py-2">Guardar</button>
      </form>
    </div>
  </div>

  @if(session('ok'))
    <div class="mt-6 rounded-2xl border border-green-500/30 bg-green-500/10 p-4 text-sm">
      {{ session('ok') }}
    </div>
  @endif

  <div class="mt-8 grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2 glass-card rounded-3xl p-6">
      <h2 class="text-xl font-bold mb-3">Mensaje</h2>
      <p class="text-slate-200 leading-relaxed whitespace-pre-line">{{ $lead->message }}</p>
    </div>

    <div class="glass-card rounded-3xl p-6 space-y-4">
      <div>
        <div class="text-xs text-slate-400">Estado</div>
        <div class="font-semibold">{{ $lead->status }}</div>
      </div>

      <div>
        <div class="text-xs text-slate-400">Origen</div>
        <div class="font-semibold">{{ $lead->source ?? '-' }}</div>
      </div>

      <div>
        <div class="text-xs text-slate-400">UTM</div>
        <div class="text-sm text-slate-200">
          {{ $lead->utm_source ?? '-' }} / {{ $lead->utm_medium ?? '-' }} / {{ $lead->utm_campaign ?? '-' }}
        </div>
      </div>

      <div>
        <div class="text-xs text-slate-400">IP</div>
        <div class="text-sm text-slate-200">{{ $lead->ip ?? '-' }}</div>
      </div>

      <div>
        <div class="text-xs text-slate-400">User Agent</div>
        <div class="text-xs text-slate-400 break-words">{{ $lead->user_agent ?? '-' }}</div>
      </div>

      <div>
        <div class="text-xs text-slate-400">Creado</div>
        <div class="text-sm text-slate-200">{{ $lead->created_at->format('d/m/Y H:i') }}</div>
      </div>

      <div>
        <div class="text-xs text-slate-400">Contactado</div>
        <div class="text-sm text-slate-200">
          {{ $lead->contacted_at ? $lead->contacted_at->format('d/m/Y H:i') : '-' }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
