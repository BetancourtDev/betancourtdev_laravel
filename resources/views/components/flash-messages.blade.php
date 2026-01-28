@if(session('ok'))
  <div class="mb-6 rounded-2xl border border-green-500/30 bg-green-500/10 p-4 text-sm">
    {{ session('ok') }}
  </div>
@endif

@if(session('error'))
  <div class="mb-6 rounded-2xl border border-red-500/30 bg-red-500/10 p-4 text-sm">
    {{ session('error') }}
  </div>
@endif

@if ($errors->any())
  <div class="mb-6 rounded-2xl border border-red-500/30 bg-red-500/10 p-4 text-sm">
    <ul class="space-y-1">
      @foreach ($errors->all() as $error)
        <li>• {{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
