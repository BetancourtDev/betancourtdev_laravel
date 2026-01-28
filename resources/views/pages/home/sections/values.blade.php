<section id="sobre-mi" class="max-w-7xl mx-auto px-4 py-24">
  <div class="grid lg:grid-cols-2 gap-16 items-center">
    
    <div>
      <h2 class="text-4xl font-extrabold mb-6">
        Tecnología real para negocios reales
      </h2>
    </div>

    <div class="space-y-4">
      @foreach($values as $value)
        <x-ui.glass-card>
          <div class="flex gap-4">
            <div class="text-4xl">{{ $value['icon'] }}</div>
            <div>
              <h3 class="font-bold text-xl">{{ $value['title'] }}</h3>
              <p class="text-muted">{{ $value['description'] }}</p>
            </div>
          </div>
        </x-ui.glass-card>
      @endforeach
    </div>

  </div>
</section>
