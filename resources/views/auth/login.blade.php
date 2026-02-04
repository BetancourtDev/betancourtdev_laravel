<x-guest-layout>
    <x-auth-session-status class="mb-4 p-3 bg-green-500/10 border border-green-500/50 text-green-400 rounded-lg text-center" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-300 font-medium ml-1" />
            <x-text-input id="email" 
                class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-blue-500 focus:ring-blue-500 rounded-xl transition-all duration-200 placeholder:text-slate-500" 
                type="email" 
                name="email" 
                :value="old('email')" 
                placeholder="nombre@kimtech.com"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-400 text-xs" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-slate-300 font-medium ml-1" />
            <x-text-input id="password" 
                class="block mt-1 w-full bg-slate-800/50 border-slate-700 text-white focus:border-blue-500 focus:ring-blue-500 rounded-xl transition-all duration-200" 
                type="password"
                name="password"
                placeholder="••••••••"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-400 text-xs" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded border-slate-700 bg-slate-800 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-offset-slate-900" name="remember">
                <span class="ms-2 text-sm text-slate-400 group-hover:text-slate-200 transition-colors">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-400 hover:text-blue-300 transition-colors font-medium" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="flex flex-col space-y-4 mt-6">
            <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-500 active:bg-blue-700 text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-[1.02] shadow-[0_0_20px_rgba(37,99,235,0.3)]">
                {{ __('Entrar al Sistema') }}
            </x-primary-button>
            
            <p class="text-center text-xs text-slate-500">
                Acceso restringido a personal de Betancourt dev.
            </p>
        </div>
    </form>
</x-guest-layout>