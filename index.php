
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Japão | Cultura e Tradição</title>

    <link href ="src/output.css" rel="stylesheet">
    <link href="src/custom.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-[#f8f5ef] text-[#171717]">

    <!-- MENU -->
    <header class="bg-[#071018] text-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-3 md:px-10">

            <a href="#" class="flex items-center gap-3">
                <span class="flex h-7 w-7 items-center justify-center rounded-full bg-white">
                    <span class="h-5 w-5 rounded-full bg-[#c9272c]"></span>
                </span>

                <span class="titulo text-xl tracking-wide">JAPÃO</span>
            </a>

            <button id="menuBtn" class="text-2xl md:hidden" aria-label="Abrir menu">
                <i class="bi bi-list"></i>
            </button>

            <div id="menu" class="absolute left-0 top-[58px] z-50 hidden w-full flex-col gap-5 bg-[#071018] px-6 py-6 text-sm md:static md:flex md:w-auto md:flex-row md:items-center md:gap-7 md:bg-transparent md:p-0">
                <a href="#inicio" class="hover:text-red-400">INÍCIO</a>
                <a href="./assets/pages/futebol.php" class="hover:text-red-400">FUTEBOL</a>
                <a href="#culinaria" class="hover:text-red-400">CULINÁRIA</a>
                <a href="#surf" class="hover:text-red-400">SURF</a>
                <a href="#patrimonios" class="hover:text-red-400">PATRIMÔNIOS</a>
                <a href="#lendas" class="hover:text-red-400">LENDAS</a>
                <a href="#explorar" aria-label="Explorar">
                    <i class="bi bi-search text-lg"></i>
                </a>
            </div>
        </nav>
    </header>

    <main>

        <!-- DESTAQUE PRINCIPAL -->
        <section id="inicio" class="hero relative flex min-h-[380px] items-center md:min-h-[510px]">
            <div class="mx-auto w-full max-w-7xl px-6 py-16 md:px-12">

                <div class="max-w-2xl text-white">
                    <p class="mb-1 text-3xl leading-tight md:text-4xl">日</p>
                    <p class="text-3xl leading-tight md:text-4xl">本</p>

                    <h1 class="titulo mt-1 text-6xl font-semibold tracking-wide md:text-8xl">
                        JAPÃO
                    </h1>

                    <p class="mt-3 text-base md:text-xl">
                        Entre tradição, cultura e inovação
                    </p>

                    <a href="#explorar"
                       class="mt-7 inline-flex items-center gap-3 rounded-md bg-[#c72b30] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#a51e24]">
                        EXPLORAR A CULTURA JAPONESA
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- SOBRE O JAPÃO -->
        <section class="textura relative overflow-hidden px-6 py-10 md:px-12 md:py-12">
            <div class="mx-auto max-w-7xl">

                <div class="relative z-10 max-w-2xl">
                    <div class="mb-2 h-1 w-8 bg-[#c72b30]"></div>

                    <h2 class="titulo text-3xl font-bold">O Japão</h2>

                    <p class="mt-3 text-sm leading-6 text-[#45413d] md:text-base">
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
                            <path d="M90 58 V155 M61 155 H119 M70 140 H110 M76 125 H104" stroke="#b82228" stroke-width="7"/>
                            <path d="M35 74 Q90 44 145 74 L135 85 H45 Z" fill="#c72b30"/>
                            <path d="M44 75 Q90 53 136 75" stroke="#791b20" stroke-width="4"/>
                            <path d="M50 83 H130 V94 H50 Z" fill="#c72b30"/>
                            <path d="M55 95 V140 M125 95 V140" stroke="#b82228" stroke-width="5"/>
                            <path d="M28 143 Q90 127 152 143" stroke="#b82228" stroke-width="6"/>
                            <path d="M35 150 Q90 136 145 150" stroke="#b82228" stroke-width="4"/>
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <!-- CATEGORIAS -->
        <section id="explorar" class="textura px-6 pb-12 pt-3 md:px-12 md:pb-16">
            <div class="mx-auto max-w-7xl">

                <h2 class="mb-6 text-2xl font-bold md:text-3xl">
                    Explore o Japão
                </h2>

                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">

                    <!-- FUTEBOL -->
                    <a id="futebol" href="./assets/pages/futebol.php"
                       class="categoria overflow-hidden rounded-lg border border-[#e1d9ce] bg-white shadow-sm">
                        <img
                            src="https://images.unsplash.com/photo-1522778119026-d647f0596c20?auto=format&fit=crop&w=600&q=85"
                            alt="Estádio de futebol"
                            class="h-32 w-full object-cover md:h-40">

                        <div class="flex min-h-20 flex-col items-center justify-center bg-gradient-to-b from-white to-[#e9e5de] px-2 pb-3 text-center">
                            <span class="-mt-6 mb-2 flex h-9 w-9 items-center justify-center rounded-full border-2 border-white bg-[#b9272c] text-sm text-white">
                                <i class="bi bi-dribbble"></i>
                            </span>
                            <h3 class="text-sm font-bold">Futebol</h3>
                        </div>
                    </a>

                    <!-- CULINÁRIA -->
                    <a id="culinaria" href="#culinaria"
                       class="categoria overflow-hidden rounded-lg border border-[#e1d9ce] bg-white shadow-sm">
                        <img
                            src="https://images.unsplash.com/photo-1579871494447-9811cf80d66c?auto=format&fit=crop&w=600&q=85"
                            alt="Sushi da culinária japonesa"
                            class="h-32 w-full object-cover md:h-40">

                        <div class="flex min-h-20 flex-col items-center justify-center bg-gradient-to-b from-white to-[#e9e5de] px-2 pb-3 text-center">
                            <span class="-mt-6 mb-2 flex h-9 w-9 items-center justify-center rounded-full border-2 border-white bg-[#b9272c] text-sm text-white">
                                食
                            </span>
                            <h3 class="text-sm font-bold">Culinária &amp; Empreendedorismo</h3>
                        </div>
                    </a>

                    <!-- SURF -->
                    <a id="surf" href="#surf"
                       class="categoria overflow-hidden rounded-lg border border-[#e1d9ce] bg-white shadow-sm">
                        <img
                            src="https://images.unsplash.com/photo-1502680390469-be75c86b636f?auto=format&fit=crop&w=600&q=85"
                            alt="Surfista no mar"
                            class="h-32 w-full object-cover md:h-40">

                        <div class="flex min-h-20 flex-col items-center justify-center bg-gradient-to-b from-white to-[#e9e5de] px-2 pb-3 text-center">
                            <span class="-mt-6 mb-2 flex h-9 w-9 items-center justify-center rounded-full border-2 border-white bg-[#b9272c] text-sm text-white">
                                波
                            </span>
                            <h3 class="text-sm font-bold">Surf</h3>
                        </div>
                    </a>

                    <!-- PATRIMÔNIOS -->
                    <a id="patrimonios" href="#patrimonios"
                       class="categoria overflow-hidden rounded-lg border border-[#e1d9ce] bg-white shadow-sm">
                        <img
                            src="https://images.unsplash.com/photo-1545569341-9eb8b30979d9?auto=format&fit=crop&w=600&q=85"
                            alt="Arquitetura tradicional japonesa"
                            class="h-32 w-full object-cover md:h-40">

                        <div class="flex min-h-20 flex-col items-center justify-center bg-gradient-to-b from-white to-[#e9e5de] px-2 pb-3 text-center">
                            <span class="-mt-6 mb-2 flex h-9 w-9 items-center justify-center rounded-full border-2 border-white bg-[#b9272c] text-sm text-white">
                                <i class="bi bi-bank"></i>
                            </span>
                            <h3 class="text-sm font-bold">Patrimônios Culturais</h3>
                        </div>
                    </a>

                    <!-- LENDAS -->
                    <a id="lendas" href="#lendas"
                       class="categoria overflow-hidden rounded-lg border border-[#e1d9ce] bg-white shadow-sm">
                        <img
                            src="https://images.unsplash.com/photo-1578632767115-351597cf2477?auto=format&fit=crop&w=600&q=85"
                            alt="Arte inspirada na cultura japonesa"
                            class="h-32 w-full object-cover md:h-40">

                        <div class="flex min-h-20 flex-col items-center justify-center bg-gradient-to-b from-white to-[#e9e5de] px-2 pb-3 text-center">
                            <span class="-mt-6 mb-2 flex h-9 w-9 items-center justify-center rounded-full border-2 border-white bg-[#b9272c] text-sm text-white">
                                狐
                            </span>
                            <h3 class="text-sm font-bold">Lendas &amp; Mitos</h3>
                        </div>
                    </a>

                </div>
            </div>
        </section>

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
                <a href="#inicio" class="hover:text-red-400">Início</a>
                <a href="futebol.html" class="hover:text-red-400">Futebol</a>
                <a href="#culinaria" class="hover:text-red-400">Culinária</a>
                <a href="#surf" class="hover:text-red-400">Surf</a>
                <a href="#patrimonios" class="hover:text-red-400">Patrimônios</a>
                <a href="#lendas" class="hover:text-red-400">Lendas</a>
            </nav>

            <div class="text-sm leading-6 text-gray-400">
                <p>Integrantes:</p>
                <p>Seu nome aqui</p>
                <p>Turma / Curso</p>
                <p>Ano</p>
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
    </>

</body>
</html>
