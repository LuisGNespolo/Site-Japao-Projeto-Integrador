<?php
// Cards da seção "Explore o Japão" (index).
// Cole/inclua este arquivo dentro do <main> do index, no lugar da seção de cards.
$dados = require_once './assets/templates/dados.php';
$cardsExplorar = $dados['cards_explorar'];
 
if (!function_exists('e')) {
    function e(string $texto): string
    {
        return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Japão | Cultura e Tradição</title>

    <link href="src/output.css" rel="stylesheet">
    <link href="src/custom.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-[#f8f5ef] text-[#171717] antialiased">

    <!-- MENU -->
    <header class="sticky top-0 z-50 border-b border-white/10 bg-[#071018]/95 text-white backdrop-blur">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-3 md:px-10">

            <a href="#inicio" class="group flex items-center gap-3">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white transition group-hover:scale-110">
                    <span class="h-5 w-5 rounded-full bg-[#c9272c]"></span>
                </span>

                <span class="titulo text-xl font-semibold tracking-[0.2em]">JAPÃO</span>
            </a>

            <button id="menuBtn" class="rounded-md p-1 text-2xl transition hover:bg-white/10 md:hidden" aria-label="Abrir menu">
                <i class="bi bi-list"></i>
            </button>

            <div id="menu" class="absolute left-0 top-full z-50 hidden w-full flex-col gap-5 border-t border-white/10 bg-[#071018] px-6 py-6 text-xs font-medium tracking-[0.15em] md:static md:flex md:w-auto md:flex-row md:items-center md:gap-8 md:border-0 md:bg-transparent md:p-0">
                <a href="#inicio" class="relative transition hover:text-red-400 after:absolute after:-bottom-1.5 after:left-0 after:h-px after:w-0 after:bg-[#c72b30] after:transition-all hover:after:w-full">INÍCIO</a>
                <a href="./assets/pages/futebol.php" class="relative transition hover:text-red-400 after:absolute after:-bottom-1.5 after:left-0 after:h-px after:w-0 after:bg-[#c72b30] after:transition-all hover:after:w-full">FUTEBOL</a>
                <a href="./assets/pages/culinaria.php" class="relative transition hover:text-red-400 after:absolute after:-bottom-1.5 after:left-0 after:h-px after:w-0 after:bg-[#c72b30] after:transition-all hover:after:w-full">CULINÁRIA</a>
                <a href="./assets/pages/surf.php" class="relative transition hover:text-red-400 after:absolute after:-bottom-1.5 after:left-0 after:h-px after:w-0 after:bg-[#c72b30] after:transition-all hover:after:w-full">SURF</a>
                <a href="./assets/pages/patrimonios.php" class="relative transition hover:text-red-400 after:absolute after:-bottom-1.5 after:left-0 after:h-px after:w-0 after:bg-[#c72b30] after:transition-all hover:after:w-full">PATRIMÔNIOS</a>
                <a href="./assets/pages/lendas.php" class="relative transition hover:text-red-400 after:absolute after:-bottom-1.5 after:left-0 after:h-px after:w-0 after:bg-[#c72b30] after:transition-all hover:after:w-full">LENDAS</a>
                <a href="" class="transition hover:text-red-400" aria-label="Explorar">
                    <i class="bi bi-search text-lg"></i>
                </a>
            </div>
        </nav>
    </header>

    <main>

        <!-- DESTAQUE PRINCIPAL -->
        <section id="inicio" class="hero relative flex min-h-[380px] items-center md:min-h-[510px]">
            <div class="mx-auto w-full max-w-7xl px-6 py-16 md:px-10">

                <div class="max-w-2xl text-white">
                    <p class="mb-1 text-3xl leading-tight text-[#e0585d] md:text-4xl">日</p>
                    <p class="text-3xl leading-tight text-[#e0585d] md:text-4xl">本</p>

                    <h1 class="titulo mt-2 text-6xl font-semibold tracking-wide md:text-8xl">
                        JAPÃO
                    </h1>

                    <p class="mt-4 text-base text-gray-200 md:text-xl">
                        Entre tradição, cultura e inovação
                    </p>

                    <a href="#explorar"
                        class="mt-8 inline-flex items-center gap-3 rounded-md bg-[#c72b30] px-6 py-3 text-sm font-bold tracking-wider text-white shadow-lg shadow-black/30 transition hover:-translate-y-0.5 hover:bg-[#a51e24]">
                        EXPLORAR A CULTURA JAPONESA
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- SOBRE O JAPÃO -->
        <section class="textura relative overflow-hidden px-6 py-14 md:px-10 md:py-16">
            <div class="mx-auto max-w-7xl">

                <div class="relative z-10 max-w-2xl">
                    <div class="mb-4 h-1 w-10 rounded-full bg-[#c72b30]"></div>

                    <h2 class="titulo text-3xl font-bold">O Japão</h2>

                    <p class="mt-4 text-sm leading-7 text-[#45413d] md:text-base">
                        O Japão é um país localizado no continente asiático, conhecido
                        pela combinação entre tradição e tecnologia. Sua cultura influencia
                        o mundo por meio da culinária, esportes, lendas, patrimônios
                        históricos e costumes únicos.
                    </p>
                </div>

                <!-- Ilustração decorativa -->
                <div class="pointer-events-none absolute -right-3 bottom-0 hidden opacity-90 md:block">
                    <div class="relative flex h-48 w-56 items-end justify-center">
                        <div class="absolute right-12 top-2 h-24 w-24 rounded-full bg-[#d9473e]"></div>

                        <svg viewBox="0 0 180 180" class="relative z-10 h-40 w-44" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M90 58 V155 M61 155 H119 M70 140 H110 M76 125 H104" stroke="#b82228" stroke-width="7" />
                            <path d="M35 74 Q90 44 145 74 L135 85 H45 Z" fill="#c72b30" />
                            <path d="M44 75 Q90 53 136 75" stroke="#791b20" stroke-width="4" />
                            <path d="M50 83 H130 V94 H50 Z" fill="#c72b30" />
                            <path d="M55 95 V140 M125 95 V140" stroke="#b82228" stroke-width="5" />
                            <path d="M28 143 Q90 127 152 143" stroke="#b82228" stroke-width="6" />
                            <path d="M35 150 Q90 136 145 150" stroke="#b82228" stroke-width="4" />
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white px-6 py-14 md:px-10 md:py-20">
            <div class="mx-auto max-w-7xl">

                <div class="mb-4 h-1 w-10 rounded-full bg-[#c72b30]"></div>
                <h2 class="titulo mb-8 text-3xl font-bold text-[#171717]">Explore o Japão</h2>

                <ul class="grid grid-cols-2 gap-5 sm:grid-cols-3 md:gap-6 lg:grid-cols-5">

                    <?php foreach ($cardsExplorar as $card): ?>
                        <li>
                            <a
                                href="<?= e($card['link']) ?>"
                                class="group flex h-full flex-col overflow-hidden rounded-lg bg-[#f8f5ef] text-center shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-[#c72b30]">
                                <!-- Imagem + bolinha da bandeira sobreposta -->
                                <div class="relative">
                                    <div class="overflow-hidden">
                                        <img
                                            src="<?= e($card['imagem']) ?>"
                                            alt="<?= e($card['titulo']) ?>"
                                            class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105" />
                                    </div>
                                    <span class="absolute -bottom-4 left-1/2 flex h-9 w-9 -translate-x-1/2 items-center justify-center rounded-full bg-white shadow-md ring-1 ring-black/5">
                                        <span class="h-4 w-4 rounded-full bg-[#c72b30]"></span>
                                    </span>
                                </div>

                                <!-- Título -->
                                <span class="flex flex-1 items-center justify-center px-3 pb-5 pt-9 font-serif text-sm font-semibold uppercase leading-tight tracking-[0.15em] text-[#171717] transition group-hover:text-[#c72b30]">
                                    <?= e($card['titulo']) ?>
                                </span>
                            </a>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </div>
        </section>

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
                <a href="#inicio" class="transition hover:text-red-400">Início</a>
                <a href="./assets/pages/futebol.php" class="transition hover:text-red-400">Futebol</a>
                <a href="./assets/pages/culinaria.php" class="transition hover:text-red-400">Culinária</a>
                <a href="./assets/pages/surf.php" class="transition hover:text-red-400">Surf</a>
                <a href="./assets/pages/patrimonios.php" class="transition hover:text-red-400">Patrimônios</a>
                <a href="./assets/pages/lendas.php" class="transition hover:text-red-400">Lendas</a>
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