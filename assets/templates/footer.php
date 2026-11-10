</main>

    <!-- RODAPÉ -->
    <footer class="relative overflow-hidden border-t-4 border-[#c72b30] bg-[#071018] px-6 pb-6 pt-12 text-white md:px-12">
        <div class="mx-auto grid max-w-7xl gap-10 md:grid-cols-3 md:gap-12">

            <div>
                <a href="#inicio" class="group flex items-center gap-3">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white transition group-hover:scale-110">
                        <span class="h-5 w-5 rounded-full bg-[#c9272c]"></span>
                    </span>
                    <span class="titulo text-xl font-semibold tracking-[0.2em]">JAPÃO</span>
                </a>

                <p class="mt-4 max-w-xs text-sm leading-6 text-gray-400">
                    Entre tradição, cultura e inovação.
                </p>
            </div>

            <nav class="flex flex-wrap content-start gap-x-6 gap-y-3 text-sm text-gray-300 md:justify-center">
                <a href="../../index.php" class="transition hover:text-red-400">Início</a>
                <a href="../pages/futebol.php" class="transition hover:text-red-400">Futebol</a>
                <a href="../pages/culinaria.php" class="transition hover:text-red-400">Culinária</a>
                <a href="../pages/surf.php" class="transition hover:text-red-400">Surf</a>
                <a href="../pages/patrimonios.php" class="transition hover:text-red-400">Patrimônios</a>
                <a href="../pages/lendas.php" class="transition hover:text-red-400">Lendas</a>
            </nav>

            <div class="text-sm leading-7 text-gray-400 md:justify-self-end">
                <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-white">Integrantes</p>
                <div class="grid grid-cols-2 gap-x-8">
                    <p>Alexandre Kawamura</p>
                    <p>Gabriel Rossi</p>
                    <p>Lara Cabral</p>
                    <p>Luis Nespolo</p>
                    <p>Rafaella Rossito</p>
                    <p>Sophia Turetta</p>
                </div>
            </div>
        </div>

        <div class="mx-auto mt-10 max-w-7xl border-t border-white/10 pt-5 text-center text-xs text-gray-500">
            © 2026 Japão — Cultura, história e tradição.
        </div>
    </footer>

    <script>
        const menuBtn = document.getElementById('menuBtn');
        const menu = document.getElementById('menu');

        menuBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            menu.classList.toggle('flex');
        });

        menu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    menu.classList.add('hidden');
                    menu.classList.remove('flex');
                }
            });
        });
    </script>

</body>
</html>