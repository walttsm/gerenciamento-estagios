<nav id="sidebar"
    class=" group fixed left-0 h-screen w-[3%] min-w-[50px] hover:w-[250px] bg-orange-500 text-white smooth-transition overflow-y-auto over">
    <div class="flex flex-col">
        <div class="mr-1 text-right">
            <button class="w-10 align-bottom" id="toggle-nav" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <desc>Download more icon variants from https://tabler-icons.io/i/menu-2</desc>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="4" y1="6" x2="20" y2="6"></line>
                    <line x1="4" y1="12" x2="20" y2="12"></line>
                    <line x1="4" y1="18" x2="20" y2="18"></line>
                </svg>
            </button>
        </div>
        <ul class="my-2">

            @if (Auth::user()->permissao = 2)
                <hr class="hidden group-hover:block border-y-[1px] border-y-gray">

                <li>
                    <x-nav-link class="hidden group-hover:flex" :href="route('avisos')" :active="request()->routeIs('avisos')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home mr-2"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/home</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <polyline points="5 12 3 12 12 3 21 12 19 12"></polyline>
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                        </svg>
                        {{ __('Avisos') }}

                    </x-nav-link>
                </li>

                <hr class="hidden group-hover:block border-y-[1px] border-y-gray">

                <li>
                    <x-nav-link class="hidden group-hover:flex" :href="route('orientadores.index')" :active="request()->routeIs('orientadores.index')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-school mr-2"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/school</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6"></path>
                            <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4"></path>
                        </svg>
                        {{ __('Orientadores') }}

                    </x-nav-link>
                </li>

                <hr class="hidden group-hover:block border-y-[1px] border-y-gray">

                <li>
                    <x-nav-link class="hidden group-hover:flex" :href="route('alunos.index')" :active="request()->routeIs('alunos.index')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users mr-2"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/users</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                        </svg>
                        {{ __('Alunos') }}

                    </x-nav-link>
                </li>

                <hr class="hidden group-hover:block border-y-[1px] border-y-gray">

                <li>
                    <x-nav-link class="hidden group-hover:flex" :href="route('declaracoes')" :active="request()->routeIs('declaracoes')">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-file-description mr-2" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/file-description</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                            <path d="M9 17h6"></path>
                            <path d="M9 13h6"></path>
                        </svg>
                        {{ __('Declarações') }}

                    </x-nav-link>
                </li>

                <hr class="hidden group-hover:block border-y-[1px] border-y-gray">

                <br>
            @endif

            @if (Auth::user()->permissao > 1)
                <hr class="hidden group-hover:block border-y-[1px] border-y-gray">

                <li>
                    <x-nav-link class="hidden group-hover:flex" :href="route('orientador_rpods')" :active="request()->routeIs('orientador_rpods')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-archive mr-2"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/archive</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <rect x="3" y="4" width="18" height="4" rx="2">
                            </rect>
                            <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10"></path>
                            <line x1="10" y1="12" x2="14" y2="12"></line>
                        </svg>
                        {{ __('Registros') }}

                    </x-nav-link>
                </li>

                <hr class="hidden group-hover:block border-y-[1px] border-y-gray">

                <li>
                    <x-nav-link class="hidden group-hover:flex" :href="route('orientador_orientandos')" :active="request()->routeIs('orientador_orientandos')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id mr-2"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/id</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <rect x="3" y="4" width="18" height="16" rx="3">
                            </rect>
                            <circle cx="9" cy="10" r="2"></circle>
                            <line x1="15" y1="8" x2="17" y2="8"></line>
                            <line x1="15" y1="12" x2="17" y2="12"></line>
                            <line x1="7" y1="16" x2="17" y2="16"></line>
                        </svg>
                        {{ __('Orientandos') }}

                    </x-nav-link>
                </li>

                <hr class="hidden group-hover:block border-y-[1px] border-y-gray">

                <li>
                    <x-nav-link class="hidden group-hover:flex" :href="route('orientador_orientacoes')" :active="request()->routeIs('orientador_orientacoes')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock mr-2"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <desc>Download more icon variants from https://tabler-icons.io/i/clock</desc>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="12" r="9"></circle>
                            <polyline points="12 7 12 12 15 15"></polyline>
                        </svg>
                        {{ __('Orientações') }}

                    </x-nav-link>
                </li>

            <br>

            <hr class="hidden group-hover:block border-y-[1px] border-y-gray">

            <li>
                <x-nav-link class="hidden group-hover:flex" :href="route('aluno_rpodpage')" :active="request()->routeIs('aluno_rpodpage')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <desc>Download more icon variants from https://tabler-icons.io/i/clipboard-check</desc>
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                        <rect x="9" y="3" width="6" height="4" rx="2"></rect>
                        <path d="M9 14l2 2l4 -4"></path>
                     </svg>
                    {{ __('RPOD') }}

                </x-nav-link>
            </li>

            <hr class="hidden group-hover:block border-y-[1px] border-y-gray">

            <br>

            <hr class="hidden group-hover:block border-y-[1px] border-y-gray">

            <li>
                <x-nav-link class="hidden group-hover:flex" :href="route('aluno_atividades')" :active="request()->routeIs('aluno_atividades')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                        <path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z"></path>
                     </svg>
                    {{ __('Atividades') }}

                </x-nav-link>
            </li>

            <hr class="hidden group-hover:block border-y-[1px] border-y-gray">

                <hr class="hidden group-hover:block border-y-[1px] border-y-gray">
            @endif
        </ul>

        <hr class="hidden group-hover:block border-y-[1px] border-y-gray">
        <div>
            <x-nav-link class="hidden group-hover:flex" :href="route('logout')" :active="request()->routeIs('logout')">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout mr-2"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <desc>Download more icon variants from https://tabler-icons.io/i/logout</desc>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                    <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                </svg>
                {{ __('Sair') }}

            </x-nav-link>
        </div>
        <hr class="hidden group-hover:block border-y-[1px] border-y-gray">
    </div>
</nav>
