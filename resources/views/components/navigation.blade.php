<nav id="sidebar"
    class="fixed left-0 h-screen w-[3%] hover:w-1/6 bg-blue-700 text-white smooth-transition">
    <div class="flex flex-col">
        <button class="w-10" id="toggle-nav" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <desc>Download more icon variants from https://tabler-icons.io/i/menu-2</desc>
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <line x1="4" y1="6" x2="20" y2="6"></line>
                <line x1="4" y1="12" x2="20" y2="12"></line>
                <line x1="4" y1="18" x2="20" y2="18"></line>
             </svg>
        </button>
        <a href="#" hidden class="" id="inicio">Início</a>
        <a href="#" hidden>Orientadores</a>
        <a href="#" hidden>Alunos</a>
        <a href="#" hidden>Declarações</a>
        <br>
        <a href="#" hidden>Registros</a>
        <a href="#" hidden>Alunos orientandos</a>
        <a href="#" hidden>Orientações</a>
    </div>
</nav>

<script>
    document.getElementById('toggle-nav').addEventListener("click", update_width());

    function update_width() {
        if (document.getElementById('sidebar').style.width > 50px) {
            document.getElementById('sidebar').style.width = 50px;
        } else {
            document.getElementById('sidebar').style.width == 300px;
        }
    }
</script>
