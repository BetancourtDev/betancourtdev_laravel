@extends('layouts.app')

@section('title', 'Betancourt Dev | Kim Betancourt - Desarrollo web y sistemas a medida')
@section('meta_description', 'Soy Kim Betancourt (Betancourt Dev). Desarrollo sitios web y sistemas a medida con Laravel. Te ayudo a vender y ordenar tu negocio con tecnología real.')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">


@endpush

@section('content')
@php
    $phone = config('brand.whatsapp_phone');
  $waTextNav = rawurlencode(config('brand.whatsapp_default_text'));

  $waText = rawurlencode('Hola Kim! Vi tu web y quiero contarte mi idea. Mi proyecto es: _____. ¿Me orientás con tiempos y presupuesto?');
  $waTextBrief = rawurlencode('Hola Kim! Quiero cotizar. Mi rubro: _____. Necesito: _____. Fecha ideal: _____.');

  $values = [
    ['t' => 'Cero humo', 'd' => 'Te digo lo que conviene (y lo que no) según tu objetivo.', 'icon' => '🎯'],
    ['t' => 'Código mantenible', 'd' => 'Laravel con buenas prácticas: escalable, limpio y seguro.', 'icon' => '⚡'],
    ['t' => 'Velocidad + SEO', 'd' => 'No solo "lindo": rápido, indexable y con estructura real.', 'icon' => '🚀'],
  ];

  $services = [
    ['t' => 'Sitios web empresariales', 'd' => 'Presentación clara, profesional y optimizada para Google.', 'b' => ['Home + servicios + contacto', 'SEO on-page', 'Performance'], 'icon' => '🌐'],
    ['t' => 'Landing pages', 'd' => 'Para captar leads y vender (WhatsApp + formulario anti-spam).', 'b' => ['CTA claros', 'Copy orientado a conversión', 'Métricas (opcional)'], 'icon' => '📊'],
    ['t' => 'Sistemas web a medida', 'd' => 'Panel admin, roles, reportes, pagos, automatizaciones.', 'b' => ['Laravel', 'Seguridad', 'Escalable'], 'icon' => '⚙️'],
  ];

  $process = [
    ['t'=>'Te escucho', 'd'=>'Entiendo tu negocio, tu objetivo y tu público.', 'n'=>'01'],
    ['t'=>'Te propongo', 'd'=>'Te paso alcance, tiempos y una propuesta clara.', 'n'=>'02'],
    ['t'=>'Construyo', 'd'=>'Desarrollo por etapas, con avances y revisiones.', 'n'=>'03'],
    ['t'=>'Lanzamos', 'd'=>'Optimización final + soporte post-lanzamiento.', 'n'=>'04'],
  ];

  $faqs = [
    ['q'=>'¿Trabajás sola?', 'a'=>'Sí, pero si el proyecto lo requiere, sumo colaboradores (diseño, contenido, etc.). Siempre con dirección y calidad controlada.'],
    ['q'=>'¿En qué tecnologías desarrollás?', 'a'=>'Principalmente Laravel (backend) + frontend moderno. Priorizo performance, SEO y seguridad.'],
    ['q'=>'¿Cómo arrancamos?', 'a'=>'Me escribís por WhatsApp con tu idea. Si encaja, coordinamos una llamada corta y te paso propuesta.'],
    ['q'=>'¿Hacés mantenimiento?', 'a'=>'Sí. Puedo encargarme de mejoras, soporte, actualizaciones, backups y monitoreo.'],
  ];

  $stack = [
  [
    't' => 'Backend',
    'icon' => '🧠',
    'items' => ['Laravel 12', 'PHP 8.x', 'REST APIs', 'Auth (Sanctum/JWT)', 'Queues & Jobs', 'Mail (Mailpit/SMTP)'],
  ],
  [
    't' => 'Frontend',
    'icon' => '🎨',
    'items' => ['Blade + Tailwind', 'Alpine (opcional)', 'Vite', 'Componentes reutilizables', 'UI responsive'],
  ],
  [
    't' => 'Datos',
    'icon' => '🗄️',
    'items' => ['MySQL', 'Migrations/Seeders', 'Eloquent', 'Índices y performance', 'Backups'],
  ],
  [
    't' => 'Calidad & Seguridad',
    'icon' => '🛡️',
    'items' => ['reCAPTCHA', 'Rate limiting', 'Validación (FormRequest)', 'OWASP basics', 'Logs/Monitoreo'],
  ],
];

@endphp

{{-- Animated gradient background --}}
<div class="gradient-bg"></div>

{{-- HERO SECTION --}}
<section class="mx-auto max-w-7xl px-4 pt-20 pb-16 md:pt-32 md:pb-24 relative overflow-hidden">
  <div class="grid lg:grid-cols-2 gap-16 items-center">
    <div class="space-y-8 fade-in-up">
      <div class="space-y-4">
        <div class="inline-block">
          <span class="tag">👋 Hola, soy Kim Betancourt</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight leading-[1.1]">
          Desarrollo web
          <span class="block mt-2 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-accent)] bg-clip-text text-transparent">
            que impulsa negocios
          </span>
        </h1>
        
        <p class="text-xl md:text-2xl text-[var(--color-text-muted)] leading-relaxed max-w-xl">
          Creo sitios web y sistemas a medida para emprendedores y pymes que quieren diferenciarse con tecnología real.
        </p>
      </div>

      <div class="flex flex-col sm:flex-row gap-4">
        <a href="https://wa.me/{{ $phone }}?text={{ $waText }}"
           target="_blank" rel="noopener"
           class="btn-primary inline-flex items-center justify-center rounded-2xl px-8 py-4 text-lg">
          Cotizar proyecto
          <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </a>
        
        <a href="#servicios"
           class="btn-secondary inline-flex items-center justify-center rounded-2xl px-8 py-4 text-lg">
          Ver servicios
        </a>
      </div>

      <div class="flex flex-wrap gap-4 pt-4">
        <span class="tag">Laravel</span>
        <span class="tag">SEO técnico</span>
        <span class="tag">Performance</span>
        <span class="tag">Soporte post-lanzamiento</span>
      </div>
    </div>

    {{-- Profile card with stats --}}
    <div class="glass-card rounded-3xl p-8 space-y-8 fade-in-up delay-2 float">
      <div class="flex items-start gap-6">
        <div class="relative">
          <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-accent)] rounded-3xl blur-xl opacity-50"></div>
          <img src="{{ asset('img/kim_betancourt.avif') }}" 
               alt="Kim Betancourt" 
               class="relative h-24 w-24 rounded-3xl object-cover border-2 border-[var(--color-primary)]">
        </div>
        
        <div class="flex-1">
          <h3 class="text-2xl font-bold">Betancourt Dev</h3>
          <p class="text-[var(--color-text-muted)] mt-1">Desarrollo web / sistemas a medida</p>
          <div class="flex items-center gap-2 mt-3">
            <div class="w-2 h-2 bg-[var(--color-primary)] rounded-full animate-pulse"></div>
            <span class="text-sm text-[var(--color-text-muted)]">Disponible para nuevos proyectos</span>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-3 gap-4">
        <div class="stat-card glass-card rounded-2xl p-4 text-center">
          <div class="text-3xl font-bold bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-accent)] bg-clip-text text-transparent">+30</div>
          <div class="text-sm text-[var(--color-text-muted)] mt-1">Proyectos</div>
        </div>
        <div class="stat-card glass-card rounded-2xl p-4 text-center">
          <div class="text-3xl font-bold bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-accent)] bg-clip-text text-transparent">5+</div>
          <div class="text-sm text-[var(--color-text-muted)] mt-1">Años exp</div>
        </div>
        <div class="stat-card glass-card rounded-2xl p-4 text-center">
          <div class="text-3xl font-bold bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-accent)] bg-clip-text text-transparent">100%</div>
          <div class="text-sm text-[var(--color-text-muted)] mt-1">Laravel</div>
        </div>
      </div>

      <a class="block text-center rounded-2xl px-6 py-3 font-semibold border-2 border-[var(--color-primary)] text-[var(--color-primary)] hover:bg-[var(--color-primary)] hover:text-[var(--color-bg)] transition-all"
         href="#contacto">
        Prefiero formulario
      </a>
    </div>
  </div>
</section>



{{-- VALORES / CÓMO TRABAJO --}}
<section id="sobre-mi" class="mx-auto max-w-7xl px-4 py-20 md:py-32">
  <div class="grid lg:grid-cols-2 gap-16 items-center">
    <div class="space-y-6 reveal">
      <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-[var(--color-primary)]/10 to-[var(--color-accent)]/10 border border-[var(--color-primary)]/20">
        <span class="text-sm font-semibold text-[var(--color-primary)]">Sobre mí</span>
      </div>
      
      <h2 class="text-4xl md:text-5xl font-extrabold leading-tight">
        Tecnología real para
        <span class="block mt-2 text-[var(--color-primary)]">negocios reales</span>
      </h2>

      <div class="space-y-4 text-lg text-[var(--color-text-muted)] leading-relaxed">
        <p>
          Me especializo en crear soluciones que no se quedan solo en "lo visual": construyo proyectos que funcionan, cargan rápido y pueden crecer con tu negocio.
        </p>

        <p>
          Si necesitás una web para presentarte profesionalmente, captar clientes o un sistema para ordenar procesos, puedo ayudarte a hacerlo bien desde el inicio.
        </p>
      </div>

      <div class="flex gap-4 pt-4">
        <a href="https://wa.me/{{ $phone }}?text={{ $waTextBrief }}"
           target="_blank" rel="noopener"
           class="btn-primary inline-flex items-center justify-center rounded-2xl px-8 py-4">
           Hablar conmigo
        </a>
        <a href="#servicios"
           class="btn-secondary inline-flex items-center justify-center rounded-2xl px-8 py-4">
          Ver servicios
        </a>
      </div>
    </div>

    <div class="space-y-4 reveal">
      @foreach($values as $v)
        <div class="glass-card rounded-2xl p-6 group">
          <div class="flex items-start gap-4">
            <div class="text-4xl">{{ $v['icon'] }}</div>
            <div class="flex-1">
              <h3 class="text-xl font-bold mb-2 group-hover:text-[var(--color-primary)] transition-colors">{{ $v['t'] }}</h3>
              <p class="text-[var(--color-text-muted)]">{{ $v['d'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- STACK (Recruiters / Tech) --}}
<section id="stack" class="mx-auto max-w-7xl px-4 py-20 md:py-32">
  <div class="text-center max-w-3xl mx-auto mb-16 reveal">
    <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-[var(--color-primary)]/10 to-[var(--color-accent)]/10 border border-[var(--color-primary)]/20 mb-6">
      <span class="text-sm font-semibold text-[var(--color-primary)]">Stack</span>
    </div>

    <h2 class="text-4xl md:text-5xl font-extrabold mb-6">
      Tecnologías y prácticas
    </h2>

    <p class="text-xl text-[var(--color-text-muted)]">
      Para clientes: resultados. Para recruiters: un stack claro, mantenible y productivo.
    </p>

    <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
      <a href="{{ config('brand.linkedin_url', '#') }}"
         class="btn-secondary inline-flex items-center justify-center rounded-2xl px-6 py-3 font-semibold"
         target="_blank" rel="noopener">
        LinkedIn
      </a>

      <a href="{{ config('brand.github_url', '#') }}"
         class="btn-secondary inline-flex items-center justify-center rounded-2xl px-6 py-3 font-semibold"
         target="_blank" rel="noopener">
        GitHub
      </a>

      <a href="{{ asset('docs/CV-Kim-Betancourt.pdf') }}"
         class="btn-primary inline-flex items-center justify-center rounded-2xl px-6 py-3 font-bold"
         target="_blank" rel="noopener">
        Descargar CV
      </a>
    </div>
  </div>

  <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($stack as $i => $b)
      <div class="glass-card rounded-2xl p-6 reveal" style="animation-delay: {{ $i * 0.08 }}s">
        <div class="text-4xl mb-4">{{ $b['icon'] }}</div>
        <h3 class="text-xl font-bold mb-4">{{ $b['t'] }}</h3>

        <ul class="space-y-3 text-sm text-[var(--color-text-muted)]">
          @foreach($b['items'] as $it)
            <li class="flex items-start gap-2">
              <span class="mt-1 text-[var(--color-primary)]">•</span>
              <span>{{ $it }}</span>
            </li>
          @endforeach
        </ul>
      </div>
    @endforeach
  </div>

  <div class="mt-10 text-center reveal">
    <p class="text-sm text-[var(--color-text-muted)]">
      Actualmente: <span class="text-slate-100 font-semibold">Buenos Aires, Argentina</span> ·
      <span class="text-slate-100 font-semibold">Disponibilidad</span> para proyectos y oportunidades remotas.
    </p>
  </div>
</section>


{{-- SERVICIOS --}}
<section id="servicios" class="mx-auto max-w-7xl px-4 py-20 md:py-32">
  <div class="text-center max-w-3xl mx-auto mb-16 reveal">
    <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-[var(--color-primary)]/10 to-[var(--color-accent)]/10 border border-[var(--color-primary)]/20 mb-6">
      <span class="text-sm font-semibold text-[var(--color-primary)]">Servicios</span>
    </div>
    
    <h2 class="text-4xl md:text-5xl font-extrabold mb-6">
      ¿Qué hago?
    </h2>
    <p class="text-xl text-[var(--color-text-muted)]">
      Elijo la solución según tu objetivo, no al revés.
    </p>
  </div>

  <div class="grid md:grid-cols-3 gap-6">
    @foreach($services as $i => $s)
      <div class="service-card reveal" style="animation-delay: {{ $i * 0.1 }}s">
        <div class="text-5xl mb-6">{{ $s['icon'] }}</div>
        
        <h3 class="text-2xl font-bold mb-3">{{ $s['t'] }}</h3>
        <p class="text-[var(--color-text-muted)] mb-6">{{ $s['d'] }}</p>

        <ul class="space-y-3 mb-8">
          @foreach($s['b'] as $b)
            <li class="flex items-center gap-3 text-sm">
              <svg class="w-5 h-5 text-[var(--color-primary)] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <span>{{ $b }}</span>
            </li>
          @endforeach
        </ul>

        <a href="https://wa.me/{{ $phone }}?text={{ rawurlencode('Hola Kim! Me interesa: '.$s['t'].'. Mi idea es: _____.') }}"
           target="_blank" rel="noopener"
           class="btn-secondary inline-flex w-full items-center justify-center rounded-xl px-6 py-3 group">
          Consultar
          <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </a>
      </div>
    @endforeach
  </div>
</section>

{{-- PROCESO --}}
<section id="proceso" class="mx-auto max-w-7xl px-4 py-20 md:py-32">
  <div class="text-center max-w-3xl mx-auto mb-16 reveal">
    <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-[var(--color-primary)]/10 to-[var(--color-accent)]/10 border border-[var(--color-primary)]/20 mb-6">
      <span class="text-sm font-semibold text-[var(--color-primary)]">Proceso</span>
    </div>
    
    <h2 class="text-4xl md:text-5xl font-extrabold mb-6">
      Cómo trabajo
    </h2>
    <p class="text-xl text-[var(--color-text-muted)]">
      Pasos simples, claros y medibles para que no haya incertidumbre.
    </p>
  </div>

  <div class="relative process-line">
    <div class="grid md:grid-cols-4 gap-6">
      @foreach($process as $i => $p)
        <div class="reveal" style="animation-delay: {{ $i * 0.1 }}s">
          <div class="glass-card rounded-2xl p-8 h-full">
            <div class="text-6xl font-extrabold text-[var(--color-primary)]/20 mb-4">{{ $p['n'] }}</div>
            <h3 class="text-2xl font-bold mb-3">{{ $p['t'] }}</h3>
            <p class="text-[var(--color-text-muted)]">{{ $p['d'] }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- TESTIMONIOS --}}
<section id="testimonios" class="mx-auto max-w-7xl px-4 py-20 md:py-32">
  <div class="text-center max-w-3xl mx-auto mb-16 reveal">
    <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-[var(--color-primary)]/10 to-[var(--color-accent)]/10 border border-[var(--color-primary)]/20 mb-6">
      <span class="text-sm font-semibold text-[var(--color-primary)]">Testimonios</span>
    </div>
    
    <h2 class="text-4xl md:text-5xl font-extrabold mb-6">
      Lo que dicen mis clientes
    </h2>
  </div>

  <div class="grid md:grid-cols-3 gap-6">
    @foreach([1,2,3] as $i)
      <div class="testimonial-card rounded-2xl p-8 reveal" style="animation-delay: {{ $i * 0.1 }}s">
        <div class="flex gap-1 mb-4">
          @for($j = 0; $j < 5; $j++)
            <svg class="w-5 h-5 text-[var(--color-accent)]" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          @endfor
        </div>
        
        <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">
          "Kim entendió lo que necesitábamos y lo bajó a algo funcional. Muy buena comunicación y entrega en tiempo."
        </p>
        
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-accent)] flex items-center justify-center text-white font-bold">
            NC
          </div>
          <div>
            <div class="font-bold">Nombre Cliente</div>
            <div class="text-sm text-[var(--color-text-muted)]">Rubro / Empresa</div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>

{{-- FAQ --}}
<section id="faq" class="mx-auto max-w-4xl px-4 py-20 md:py-32">
  <div class="text-center mb-16 reveal">
    <div class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-[var(--color-primary)]/10 to-[var(--color-accent)]/10 border border-[var(--color-primary)]/20 mb-6">
      <span class="text-sm font-semibold text-[var(--color-primary)]">FAQ</span>
    </div>
    
    <h2 class="text-4xl md:text-5xl font-extrabold mb-6">
      Preguntas frecuentes
    </h2>
  </div>

  <div class="space-y-4">
    @foreach($faqs as $i => $f)
      <div class="faq-item rounded-2xl p-8 reveal" style="animation-delay: {{ $i * 0.1 }}s">
        <h3 class="text-xl font-bold mb-3 flex items-start gap-3">
          <span class="text-[var(--color-primary)] mt-1">→</span>
          {{ $f['q'] }}
        </h3>
        <p class="text-[var(--color-text-muted)] leading-relaxed pl-7">{{ $f['a'] }}</p>
      </div>
    @endforeach
  </div>
</section>

{{-- CONTACTO --}}
<section id="contacto" class="mx-auto max-w-7xl px-4 py-20 md:py-32 mb-20">
  <div class="glass-card rounded-3xl p-8 md:p-16">
    <div class="grid lg:grid-cols-2 gap-16 items-center">
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

        <a href="https://wa.me/{{ $phone }}?text={{ $waText }}"
           target="_blank" rel="noopener"
           class="btn-primary inline-flex items-center justify-center rounded-2xl px-8 py-4 text-lg">
          <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
          </svg>
          Escribir por WhatsApp
        </a>
      </div>

      <div class="reveal">
        @if(session('ok'))
          <div class="mb-6 rounded-2xl border-2 border-[var(--color-primary)] bg-[var(--color-primary)]/10 p-4 text-center">
            <svg class="w-12 h-12 text-[var(--color-primary)] mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="font-semibold">{{ session('ok') }}</p>
          </div>
        @endif

        {{-- Mensaje OK --}}
@if(session('ok'))
  <div class="mb-6 rounded-2xl border border-green-500/30 bg-green-500/10 p-4 text-sm">
    {{ session('ok') }}
  </div>
@endif

{{-- Error general --}}
@if(session('error'))
  <div class="mb-6 rounded-2xl border border-red-500/30 bg-red-500/10 p-4 text-sm">
    {{ session('error') }}
  </div>
@endif

{{-- Errores de validación --}}
@if ($errors->any())
  <div class="mb-6 rounded-2xl border border-red-500/30 bg-red-500/10 p-4 text-sm">
    <ul class="space-y-1">
      @foreach ($errors->all() as $error)
        <li>• {{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


        <form method="POST" action="{{ route('contact.send') }}" class="space-y-6">
          <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
          @csrf
          <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

          <div>
         <label for="name" class="block text-sm font-semibold mb-2">Nombre</label>

            <input id="name" name="name" required value="{{ old('name') }}"
                   class="form-input w-full rounded-xl px-4 py-3">
          </div>

          <div>
            <label for="email"  class="block text-sm font-semibold mb-2">Email</label>
            <input id="email" name="email" type="email" required value="{{ old('email') }}"
                   class="form-input w-full rounded-xl px-4 py-3">
          </div>

          <div>
            <label for="message" class="block text-sm font-semibold mb-2">¿Qué necesitás?</label>
            <textarea id="message" name="message" rows="5" required
                      class="form-input w-full rounded-xl px-4 py-3 resize-none">{{ old('message') }}</textarea>
          </div>

         <button
  class="btn-primary w-full rounded-2xl px-8 py-4 font-bold text-lg"
  onclick="this.disabled=true;this.form.submit();"
>
  Enviar mensaje
</button>
        </form>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  // Scroll reveal animation
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('active');
      }
    });
  }, observerOptions);

  document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
</script>

<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
<script>
(() => {
  const form = document.querySelector('form[action="{{ route('contact.send') }}"]');
  if (!form) return;

  const input = document.getElementById('g-recaptcha-response');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    if (!window.grecaptcha || !input) {
      form.submit();
      return;
    }

    try {
      const token = await grecaptcha.execute("{{ config('services.recaptcha.site_key') }}", { action: 'contact' });
      input.value = token;
      form.submit();
    } catch (err) {
      // fallback: no enviar si falla recaptcha
      alert('No pudimos validar el formulario. Probá de nuevo.');
    }
  });
})();
</script>
@endpush
@endsection