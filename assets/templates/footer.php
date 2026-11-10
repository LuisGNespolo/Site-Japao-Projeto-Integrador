    </main>

    <!-- RODAPÉ -->
    <footer class="relative overflow-hidden bg-[#071018] px-6 py-8 text-white md:px-12">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-7 md:flex-row md:items-center">

            <div>
                <a href="#inicio" class="flex items-center gap-3">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-white">
                        <span class="h-5 w-5 rounded-full bg-[#c9272c]"></span>
                    </span>
                    <span class="titulo text-xl tracking-wide">JAPÃO</span>
                </a>

                <p class="mt-3 text-sm text-gray-300">
                    Entre tradição, cultura e inovação.
                </p>
            </div>

            <nav class="flex flex-wrap gap-x-6 gap-y-3 text-sm text-gray-300">
                <a href="../../index.php" class="hover:text-red-400">Início</a>
                <a href="../pages/futebol.php" class="hover:text-red-400">Futebol</a>
                <a href="../pages/culinaria.php" class="hover:text-red-400">Culinária</a>
                <a href="../pages/surf.php" class="hover:text-red-400">Surf</a>
                <a href="../pages/patrimonios.php" class="hover:text-red-400">Patrimônios</a>
                <a href="../pages/lendas.php" class="hover:text-red-400">Lendas</a>
            </nav>

            <div class="text-sm leading-6 text-gray-400">
                <p>Integrantes:</p>
                <p>Alexandre Kawamura</p>
                <p>Gabriel Rossi</p>
                <p>Lara Cabral</p>
                <p>Luis Nespolo</p>
                <p>Rafaella Rossito</p>
                <p>Sophia Turetta</p>
            </div>
        </div>

        <div class="mx-auto mt-7 max-w-7xl border-t border-white/10 pt-4 text-center text-xs text-gray-500">
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