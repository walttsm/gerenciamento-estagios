<div class="flex justify-end">
    <div x-data="{ modelOpen: false }">
        <li>
            <a href=""
                class="flex p-2 font-medium
            text-gray-600 rounded-md
            hover:bg-gray-100 hover:text-black">
                Deletar
            </a>
        </li>

        <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                    x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

                <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                    <div class="flex items-center space-x-4">
                        <svg class="flex h-8 w-8 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 10.5v3.75m-9.303 3.376C1.83 19.126 2.914 21 4.645 21h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 4.88c-.866-1.501-3.032-1.501-3.898 0L2.697 17.626zM12 17.25h.007v.008H12v-.008z" />
                        </svg>

                        <h1 class="text-xl font-medium text-gray-800 ">Deseja realmente apagar a Atividade ?</h1>

                    </div>

                    <div class="flex justify-end mt-6">
                        <button @click="modelOpen = false"
                            class="justify-center mr-2 text-center px-6 py-2.5
                                bg-gray-600 text-white font-medium text-xs leading-tight mt-4
                                uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg
                                focus:bg-gray-700 focus:shadow-lg
                                focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg
                                transition duration-150 ease-in-out">
                            Voltar
                        </button>
                        <a class="justify-items-center flex flex-col "
                            href="{{ route('atividades.delete', $atv->id) }}">

                            <button
                                class="justify-center text-center px-6 py-2.5
                                                         bg-red-600 text-white font-medium text-xs leading-tight mt-4
                                                         uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg
                                                         focus:bg-red-700 focus:shadow-lg
                                                         focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg
                                                         transition duration-150 ease-in-out">
                                Confirmar
                            </button>


                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
