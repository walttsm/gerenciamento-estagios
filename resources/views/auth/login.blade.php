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

        <form method="POST" action="{{ route('login') }}" id="login_form">
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

            {{-- <div class="flex items-center justify-center mt-4">
                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div> --}}
        </form>

        <div class="flex items-center justify-center mt-4">
            <button type="submit" form="login_form"
                class="default-button flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Entrar
            </button>
        </div>

        <div class="flex items-center justify-center mt-4">
            <a href="{{ Route('google_login') }}">
                <button
                    class="default-button flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-google"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M17.788 5.108a9 9 0 1 0 3.212 6.892h-8"></path>
                    </svg>
                    <span class="ml-4">
                        Login com google
                    </span>
                </button>
            </a>
        </div>

        <div class="flex items-center justify-center mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-700 hover:text-orange-900" href="{{ route('password.request') }}">
                    {{ __('Esqueci minha senha') }}
                </a>
            @endif
        </div>
    </x-auth-card>
</x-guest-layout>
