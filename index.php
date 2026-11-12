
<?php
$dados = require './assets/templates/dados.php';
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-[#f8f5ef] text-[#171717] antialiased">

<!-- MENU -->
<header class="sticky top-0 z-50 border-b border-white/10 bg-[#071018]/95 text-white backdrop-blur-lg">

    <nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 md:px-10">

        <a href="#inicio" class="group flex items-center gap-3">

            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-white">
                <span class="h-5 w-5 rounded-full bg-[#c72b30]"></span>
            </span>

            <span class="font-serif text-xl font-bold tracking-[0.2em]">
                JAPÃO
            </span>

        </a>

        <button
            id="menuBtn"
            type="button"
            aria-label="Abrir menu"
            aria-expanded="false"
            class="rounded-md p-2 text-2xl hover:bg-white/10 md:hidden"
        >
            <i class="bi bi-list"></i>
        </button>

        <div id="menu" class="absolute left-0 top-full hidden w-full flex-col gap-6 border-t border-white/10 bg-[#071018] px-6 py-7 text-xs font-semibold tracking-widest md:static md:flex md:w-auto md:flex-row md:border-0 md:bg-transparent md:p-0">

            <a href="#inicio" class="transition hover:text-[#e45a5e]">INÍCIO</a>
            <a href="./assets/pages/futebol.php" class="transition hover:text-[#e45a5e]">FUTEBOL</a>
            <a href="./assets/pages/culinaria.php" class="transition hover:text-[#e45a5e]">CULINÁRIA</a>
            <a href="./assets/pages/surf.php" class="transition hover:text-[#e45a5e]">SURF</a>
            <a href="./assets/pages/patrimonios.php" class="transition hover:text-[#e45a5e]">PATRIMÔNIOS</a>
            <a href="./assets/pages/lendas.php" class="transition hover:text-[#e45a5e]">LENDAS</a>

        </div>

    </nav>

</header>

<main>

<!-- BANNER PRINCIPAL -->
<section id="inicio" class="relative isolate flex min-h-[600px] items-center overflow-hidden bg-[#071018] md:min-h-[700px]">

    <div
        class="absolute inset-0 -z-20 bg-cover bg-center"
        style="background-image: url('./assets/img/home/banner.png');"
    ></div>

    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#071018]/95 via-[#071018]/75 to-[#071018]/20"></div>

    <div class="mx-auto w-full max-w-7xl px-6 py-24 md:px-10">

        <div class="max-w-3xl">

            <span class="inline-flex items-center gap-3 text-xs font-bold uppercase tracking-[0.4em] text-[#e45a5e]">
                <span class="h-px w-12 bg-[#c72b30]"></span>
                日本 — Nippon
            </span>

            <h1 class="mt-7 font-serif text-5xl font-bold leading-tight text-[#f8f5ef] sm:text-6xl md:text-7xl lg:text-8xl">

                Japão:

                <span class="block italic text-[#d94b50]">
                    tradição e
                </span>

                modernidade.

            </h1>

            <p class="mt-7 max-w-xl text-sm leading-8 text-gray-300 md:text-lg">

                Descubra um país onde templos milenares encontram cidades
                futuristas, onde antigas tradições convivem com novas
                tecnologias e cada detalhe conta uma história.

            </p>

            <div class="mt-10 flex flex-wrap gap-4">

                <a href="#explorar" class="inline-flex items-center gap-3 rounded-sm bg-[#c72b30] px-7 py-4 text-xs font-bold uppercase tracking-widest text-white transition hover:-translate-y-1 hover:bg-[#a51e24]">

                    Explorar o Japão

                    <i class="bi bi-arrow-right"></i>

                </a>

                <a href="#sobre" class="inline-flex items-center gap-3 border border-white/40 px-7 py-4 text-xs font-bold uppercase tracking-widest text-white transition hover:border-[#c72b30] hover:bg-white/10">

                    Conheça o país

                    <i class="bi bi-chevron-down"></i>

                </a>

            </div>

        </div>

    </div>

    <div class="absolute bottom-0 left-0 h-1 w-full bg-gradient-to-r from-[#c72b30] via-[#8b2024] to-transparent"></div>

</section>

<!-- SOBRE O JAPÃO -->
<section id="sobre" class="bg-[#f8f5ef] px-6 py-20 md:px-10 md:py-28">

    <div class="mx-auto grid max-w-7xl items-center gap-14 lg:grid-cols-2">

        <div>

            <span class="inline-flex items-center gap-3 text-xs font-bold uppercase tracking-[0.3em] text-[#c72b30]">
                <span class="h-px w-10 bg-[#c72b30]"></span>
                Conheça o Japão
            </span>

            <h2 class="mt-6 font-serif text-4xl font-bold leading-tight md:text-5xl">
                Um país de contrastes e experiências únicas.
            </h2>

            <div class="mt-7 h-1 w-16 rounded-full bg-[#c72b30]"></div>

            <p class="mt-7 text-sm leading-8 text-[#45413d] md:text-base">
                Localizado no leste da Ásia, o Japão é conhecido por sua
                riqueza cultural, seus avanços tecnológicos e suas
                tradições preservadas ao longo dos séculos.
            </p>

            <p class="mt-5 text-sm leading-8 text-[#45413d] md:text-base">
                De templos históricos e festivais tradicionais a grandes
                centros urbanos, o país apresenta uma combinação
                fascinante entre passado e futuro.
            </p>

            <p class="mt-5 text-sm leading-8 text-[#45413d] md:text-base">
                Sua influência pode ser percebida na gastronomia,
                nos esportes, na arquitetura, nas artes e em diversas
                manifestações culturais espalhadas pelo mundo.
            </p>

            <a href="#explorar" class="mt-8 inline-flex items-center gap-3 border-b-2 border-[#c72b30] pb-2 text-xs font-bold uppercase tracking-widest transition hover:gap-5 hover:text-[#c72b30]">
                Descubra seus encantos
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>

        <!-- COMPOSIÇÃO VISUAL -->
        <div class="grid grid-cols-2 gap-4">

            <div class="space-y-4">

                <img
                    src="./assets/img/home/paisagem.png"
                    alt="Paisagem japonesa"
                    loading="lazy"
                    class="h-64 w-full rounded-sm object-cover shadow-lg md:h-80"
                >

                <div class="bg-[#071018] p-6 text-white">

                    <span class="font-serif text-3xl text-[#d9473e]">
                        伝統
                    </span>

                    <p class="mt-2 text-xs uppercase tracking-widest text-gray-300">
                        Tradição japonesa
                    </p>

                </div>

            </div>

            <div class="mt-12 space-y-4">

                <div class="bg-[#c72b30] p-6 text-white">

                    <span class="font-serif text-3xl">
                        日本
                    </span>

                    <p class="mt-2 text-xs uppercase tracking-widest">
                        Terra do sol nascente
                    </p>

                </div>

                <img
                    src="./assets/img/home/arquitetura.png"
                    alt="Arquitetura japonesa"
                    loading="lazy"
                    class="h-64 w-full rounded-sm object-cover shadow-lg md:h-80"
                >

            </div>

        </div>

    </div>

</section>


<!-- FRASE DE DESTAQUE -->

<!-- FRASE DE DESTAQUE -->
<section class="relative isolate overflow-hidden bg-cover bg-center bg-no-repeat px-6 py-24 text-center md:py-32"
    style="background-image: url('./assets/img/home/fundo.png');">

    <!-- Camada escura para melhorar a leitura -->
    <div class="absolute inset-0 -z-10 bg-[#071018]/75"></div>

    <div class="relative mx-auto max-w-4xl">

        <span class="text-5xl text-[#c72b30]">❝</span>

        <h2 class="mt-5 font-serif text-2xl italic leading-relaxed text-white md:text-4xl">

            Um lugar onde o passado inspira o futuro e a tradição
            faz parte da vida cotidiana.

        </h2>

        <div class="mx-auto mt-8 h-px w-16 bg-[#c72b30]"></div>

        <p class="mt-5 text-xs font-semibold uppercase tracking-[0.3em] text-gray-200">
            A essência do Japão
        </p>

    </div>

</section>


<!-- EXPLORE O JAPÃO -->
<section id="explorar" class="bg-white px-6 py-20 md:px-10 md:py-28">

    <div class="mx-auto max-w-7xl">

        <div class="mb-14 flex flex-col justify-between gap-6 md:flex-row md:items-end">

            <div>

                <span class="inline-flex items-center gap-3 text-xs font-bold uppercase tracking-[0.3em] text-[#c72b30]">
                    <span class="h-px w-10 bg-[#c72b30]"></span>
                    Explore cada detalhe
                </span>

                <h2 class="mt-5 font-serif text-4xl font-bold md:text-5xl">
                    Explore o Japão
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-[#77716a]">
                    Conheça diferentes aspectos da cultura japonesa
                    e descubra tudo o que torna esse país tão especial.
                </p>

            </div>

            <span class="hidden font-serif text-5xl text-[#c72b30]/20 md:block">
                日本
            </span>

        </div>

        <ul class="grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-5">

            <?php foreach ($cardsExplorar as $card): ?>

                <li>

                    <a
                        href="<?= e($card['link']) ?>"
                        class="group relative flex h-full flex-col overflow-hidden rounded-sm bg-[#f8f5ef] shadow-sm ring-1 ring-black/5 transition duration-500 hover:-translate-y-2 hover:shadow-2xl focus:outline-none focus-visible:ring-2 focus-visible:ring-[#c72b30]"
                    >

                        <div class="relative overflow-hidden">

                            <img
                                src="<?= e($card['imagem']) ?>"
                                alt="<?= e($card['titulo']) ?>"
                                loading="lazy"
                                class="aspect-[4/5] w-full object-cover transition duration-700 group-hover:scale-110"
                            >

                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-black/10"></div>

                            <span class="absolute left-4 top-4 rounded-sm bg-[#c72b30] px-3 py-2 text-[9px] font-bold uppercase tracking-widest text-white">
                                Descubra
                            </span>

                            <div class="absolute inset-x-0 bottom-0 p-5">

                                <div class="mb-3 h-px w-8 bg-[#e45a5e] transition-all duration-500 group-hover:w-16"></div>

                                <h3 class="font-serif text-xl font-bold uppercase tracking-wide text-white">
                                    <?= e($card['titulo']) ?>
                                </h3>

                                <div class="mt-4 flex items-center justify-between border-t border-white/30 pt-3">

                                    <span class="text-[9px] font-semibold uppercase tracking-widest text-gray-200">
                                        Explorar conteúdo
                                    </span>

                                    <span class="flex h-8 w-8 items-center justify-center rounded-full border border-white/60 text-white transition group-hover:border-[#c72b30] group-hover:bg-[#c72b30]">
                                        <i class="bi bi-arrow-up-right"></i>
                                    </span>

                                </div>

                            </div>

                        </div>

                    </a>

                </li>

            <?php endforeach; ?>

        </ul>

    </div>

</section>


<!-- CULTURA JAPONESA -->
<section class="bg-[#171513]">

    <div class="grid lg:grid-cols-2">

        <div class="relative min-h-[350px] overflow-hidden lg:min-h-[550px]">

            <img
                src="./assets//img/home/cultura.png"
                alt="Paisagem japonesa"
                loading="lazy"
                class="absolute inset-0 h-full w-full object-cover transition duration-700 hover:scale-105"
            >

            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

            <span class="absolute bottom-8 left-8 font-serif text-4xl font-bold italic text-white md:text-5xl">
                日本文化
            </span>

        </div>

        <div class="flex items-center px-7 py-16 md:px-14 lg:px-20">

            <div class="max-w-xl">

                <span class="text-xs font-bold uppercase tracking-[0.3em] text-[#d64a4e]">
                    Cultura e identidade
                </span>

                <h2 class="mt-5 font-serif text-3xl font-bold leading-tight text-[#f8f5ef] md:text-5xl">
                    Muito além de um destino. Uma cultura fascinante.
                </h2>

                <div class="mt-7 h-1 w-14 bg-[#c72b30]"></div>

                <p class="mt-7 text-sm leading-8 text-gray-400 md:text-base">
                    A cultura japonesa é marcada pelo respeito,
                    pela disciplina, pela valorização da natureza
                    e pela preservação de costumes tradicionais.
                </p>

                <p class="mt-5 text-sm leading-8 text-gray-400 md:text-base">
                    Sua gastronomia, suas manifestações artísticas,
                    seus esportes e suas histórias revelam diferentes
                    formas de compreender a sociedade japonesa.
                </p>

                <a href="./assets/pages/lendas.php" class="mt-9 inline-flex items-center gap-3 bg-[#c72b30] px-7 py-4 text-xs font-bold uppercase tracking-widest text-white transition hover:bg-[#a51e24]">
                    Conheça as lendas
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </div>

    </div>

</section>


<!-- CHAMADA FINAL -->
<section class="bg-[#f8f5ef] px-6 py-20 text-center md:py-28">

    <div class="mx-auto max-w-3xl">

        <span class="text-xs font-bold uppercase tracking-[0.35em] text-[#c72b30]">
            Sua jornada começa aqui
        </span>

        <h2 class="mt-5 font-serif text-4xl font-bold leading-tight md:text-6xl">
            Descubra a riqueza do Japão.
        </h2>

        <p class="mx-auto mt-6 max-w-xl text-sm leading-8 text-[#77716a] md:text-base">
            Da culinária aos esportes, dos patrimônios históricos
            às lendas ancestrais. Explore cada página e conheça
            um pouco mais desse universo fascinante.
        </p>

        <a href="#explorar" class="mt-9 inline-flex items-center gap-3 bg-[#c72b30] px-8 py-4 text-xs font-bold uppercase tracking-widest text-white shadow-lg transition hover:-translate-y-1 hover:bg-[#a51e24]">
            Começar a explorar
            <i class="bi bi-arrow-up"></i>
        </a>

        <div class="mt-12 flex justify-center gap-4 font-serif text-3xl text-[#c72b30]/30">
            <span>日</span>
            <span>本</span>
            <span>文</span>
            <span>化</span>
        </div>

    </div>

</section>

</main>


<!-- RODAPÉ -->
<footer class="border-t-4 border-[#c72b30] bg-[#071018] px-6 pb-6 pt-14 text-white md:px-12">

    <div class="mx-auto grid max-w-7xl gap-12 md:grid-cols-">

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

                <a href="#inicio" class="transition hover:text-[#e45a5e]">Início</a>

                <a href="./assets/pages/futebol.php" class="transition hover:text-[#e45a5e]">Futebol</a>

                <a href="./assets/pages/culinaria.php" class="transition hover:text-[#e45a5e]">Culinária</a>

                <a href="./assets/pages/surf.php" class="transition hover:text-[#e45a5e]">Surf</a>

                <a href="./assets/pages/patrimonios.php" class="transition hover:text-[#e45a5e]">Patrimônios</a>

                <a href="./assets/pages/lendas.php" class="transition hover:text-[#e45a5e]">Lendas</a>

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

    
        <div class="mt-8 text- text-sm text-gray-400">
            <a href="./assets/login.php" class="text-white hover:text-[#e45a5e]">Login</a>
        </div>


    <!-- DIREITOS -->
    <div class="mx-auto mt-12 max-w-7xl border-t border-white/10 pt-6 text-center">

        <p class="text-xs text-gray-500">
            © 2026 Japão — Cultura, história e tradição.
        </p>

    </div>

</footer>


<!-- JAVASCRIPT DO MENU -->
<script>

const menuBtn = document.getElementById('menuBtn');
const menu = document.getElementById('menu');

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

</script>

</body>
</html>
