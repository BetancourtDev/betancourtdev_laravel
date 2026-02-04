<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel   ') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
    </head>
    <body class="font-sans antialiased bg-[#0f172a] text-slate-200">
        <div class="relative min-h-screen flex flex-col sm:justify-center items-center overflow-hidden">
            
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0">
                <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-blue-900/20 blur-[120px]"></div>
                <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-900/20 blur-[120px]"></div>
            </div>

            <div class="z-10 w-full flex flex-col items-center">
                <div class="transition-transform duration-500 hover:scale-110">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-blue-500 drop-shadow-[0_0_15px_rgba(59,130,246,0.5)]" />
                    </a>
                </div>

                <div class="w-full sm:max-w-md mt-8 px-8 py-10 bg-slate-900/50 backdrop-blur-xl border border-slate-800 shadow-2xl overflow-hidden sm:rounded-2xl">
                    <div class="mb-6 text-center">
                        <h1 class="text-2xl font-bold tracking-tight text-white">Welcome Back</h1>
                        <p class="text-sm text-slate-400 mt-1">Accede a la plataforma de Betancourt dev</p>
                    </div>

                    {{ $slot }}
                </div>

                <footer class="mt-8 text-slate-500 text-xs tracking-widest uppercase">
                    &copy; {{ date('Y') }} Kim Betancourt • Software Excellence
                </footer>
            </div>
        </div>
    </body>
</html>