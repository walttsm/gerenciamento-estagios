<x-guest-layout>
    <x-auth-card>

        <div id="Logo">
            <img src="https://unifil.br/assets/uploads/2019/10/logo.svg" alt="Logo UNIFIL" class="w-1/2 mx-auto">
        </div>

        <div class="w-full font-bold text-lg text-center my-4">
            <h1>Olá</h1>
            <p>Você está no sistema de estágios</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input placeholder="Email" id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input placeholder="Senha" id="password" class="block mt-1 w-full" type="password" name="password"
                    required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-orange-600 shadow-sm focus:border-orange-600 focus:ring focus:ring-orange-700 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-700">{{ __('Lembrar-me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>

            <div class="flex items-center justify-center mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-700 hover:text-orange-900"
                        href="{{ route('password.request') }}">
                        {{ __('Esqueci minha senha') }}
                    </a>
                @endif
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
