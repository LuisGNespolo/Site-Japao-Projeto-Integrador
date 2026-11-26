</main>
<!-- RODAPÉ -->
<footer class="border-t-4 border-[#c72b30] bg-[#071018] px-6 pb-6 pt-14 text-white md:px-12">
 
    <div class="mx-auto grid max-w-7xl gap-12 md:grid-cols-3">
 
        <!-- LOGO -->
        <div>
 
            <a href="#inicio" class="group flex items-center gap-3">
 
                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-white">
                    <span class="h-5 w-5 rounded-full bg-[#c9272c]"></span>
                </span>
 
                <span class="font-serif text-xl font-bold tracking-[0.2em]">
                    JAPÃO
                </span>
 
            </a>
 
            <p class="mt-5 max-w-xs text-sm leading-7 text-gray-400">
                Uma jornada pela cultura, história, tradição e diversidade do Japão.
            </p>
 
        </div>
 
 
        <!-- NAVEGAÇÃO -->
        <div>
 
            <h3 class="mb-5 text-xs font-bold uppercase tracking-widest text-[#e45a5e]">
                Navegação
            </h3>
 
            <nav class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm text-gray-300">
 
                <a href="../../index.php" class="transition hover:text-[#e45a5e]">Início</a>
 
                <a href="../pages/futebol.php" class="transition hover:text-[#e45a5e]">Futebol</a>
 
                <a href="../pages/culinaria.php" class="transition hover:text-[#e45a5e]">Culinária</a>
 
                <a href="../pages/surf.php" class="transition hover:text-[#e45a5e]">Surf</a>
 
                <a href="../pages/patrimonios.php" class="transition hover:text-[#e45a5e]">Patrimônios</a>
 
                <a href="../pages/lendas.php" class="transition hover:text-[#e45a5e]">Lendas</a>

                <a href="../login.php" class="transition hover:text-[#e45a5e]">Administração</a>
 
            </nav>
 
        </div>
 
 
        <!-- INTEGRANTES -->
        <div>
 
            <h3 class="mb-5 text-xs font-bold uppercase tracking-widest text-[#e45a5e]">
                Integrantes
            </h3>
 
            <div class="grid grid-cols-2 gap-x-5 gap-y-3 text-sm text-gray-400">
 
                <p>Alexandre Kawamura</p>
                <p>Gabriel Rossi</p>
                <p>Lara Cabral</p>
                <p>Luis Nespolo</p>
                <p>Rafaella Rossito</p>
                <p>Sophia Turetta</p>
 
            </div>
 
        </div>
 
    </div>
 
 
    <!-- DIREITOS -->
    <div class="mx-auto mt-12 max-w-7xl border-t border-white/10 pt-6 text-center">
 
        <p class="text-xs text-gray-500">
            © 2026 Japão — Cultura, história e tradição.
        </p>
 
    </div>
 
</footer>
 
    <script>
 
const menuBtn = document.getElementById('menuBtn');
const menu = document.getElementById('menu');
 
if (menuBtn && menu) {
 
    menuBtn.addEventListener('click', () => {
 
        const fechado = menu.classList.toggle('hidden');
 
        menuBtn.setAttribute('aria-expanded', String(!fechado));
 
        menuBtn.innerHTML = fechado
            ? '<i class="bi bi-list"></i>'
            : '<i class="bi bi-x-lg"></i>';
 
    });
 
    menu.querySelectorAll('a').forEach((link) => {
 
        link.addEventListener('click', () => {
 
            if (window.innerWidth < 768) {
 
                menu.classList.add('hidden');
 
                menuBtn.setAttribute('aria-expanded', 'false');
 
                menuBtn.innerHTML = '<i class="bi bi-list"></i>';
 
            }
 
        });
 
    });
 
}
 
 
    </script>
 
</body>
</html>