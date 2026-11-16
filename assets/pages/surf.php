<?php
include_once("../templates/header.php");
?>

<style>
    .surf-page {
        --surf-ink: #071b2a;
        --surf-deep: #062633;
        --surf-blue: #0e6070;
        --surf-sand: #f2eee5;
        --surf-coral: #e4645d;
        --surf-red: #c72b30;
        background: var(--surf-sand);
        color: var(--surf-ink);
        overflow: hidden;
    }

    .surf-page .surf-hero {
        background:
            linear-gradient(105deg, rgba(3, 18, 30, .96), rgba(3, 18, 30, .72) 45%, rgba(3, 18, 30, .1)),
            url('../img/surf/surfBanner.png') center / cover;
    }

    .surf-page .surf-wave-pattern {
        background-image: url("data:image/svg+xml,%3Csvg width='180' height='42' viewBox='0 0 180 42' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 27 C20 7 38 7 58 27 S98 47 118 27 S158 7 180 27' fill='none' stroke='%23e4645d' stroke-width='1.3' opacity='.55'/%3E%3C/svg%3E");
        background-repeat: repeat-x;
        background-position: center;
    }

    .surf-page .surf-paper {
        background-color: var(--surf-sand);
        background-image: linear-gradient(175deg, rgba(14,96,112,.07) 1px, transparent 1px);
        background-size: 100% 34px;
    }

    .surf-page .surf-photo {
        filter: saturate(.82);
        transition: filter .5s ease, transform .5s ease;
    }

    .surf-page .overflow-hidden:hover .surf-photo {
        filter: saturate(1.12);
        transform: translateY(-.35rem) scale(1.02);
    }

    .surf-page .surf-stamp {
        border-bottom: 1px solid rgba(228,100,93,.7);
        padding-bottom: .6rem;
        color: #f08b82;
        text-align: right;
    }

    .surf-page .surf-card {
        box-shadow: 0 24px 55px -38px rgba(7,27,42,.8);
    }

    .surf-page .surf-board {
        position: relative;
        min-height: 340px;
        background: linear-gradient(90deg, rgba(255,255,255,.12) 1px, transparent 1px),
            linear-gradient(rgba(255,255,255,.12) 1px, transparent 1px),
            #0d5261;
        background-size: 32px 32px;
    }

    .surf-page .surf-board::after {
        position: absolute;
        left: 50%;
        top: 50%;
        width: 7rem;
        height: 22rem;
        border: 1px solid rgba(255,255,255,.65);
        border-radius: 50% 50% 45% 45%;
        content: '';
        opacity: .8;
        transform: translate(-50%, -50%) rotate(18deg);
    }

    .surf-page .surf-tide-card {
        border-left: 4px solid var(--surf-coral);
        background: #fdfbf7;
        padding: 1.5rem;
    }

    .surf-page .surf-tide-line {
        position: relative;
        height: 3rem;
        overflow: hidden;
        border-bottom: 1px solid rgba(14,96,112,.25);
    }

    .surf-page .surf-tide-line::before {
        position: absolute;
        left: -5%;
        top: 1rem;
        width: 110%;
        height: 2rem;
        border-top: 2px solid var(--surf-blue);
        border-radius: 50%;
        content: '';
        transform: rotate(-3deg);
    }

    @media (prefers-reduced-motion: reduce) {
        .surf-page .surf-photo { transition: none; }
    }
</style>

<main class="surf-page font-['Poppins']">

    <!-- ABERTURA -->
    <section id="inicio" class="surf-hero relative isolate min-h-[740px] overflow-hidden text-white md:min-h-[820px]">
        <div class="relative mx-auto flex min-h-[740px] max-w-7xl flex-col justify-between px-6 pb-12 pt-28 md:min-h-[820px] md:px-10">
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <p class="tracking-[.2em] text-[10px] font-bold uppercase text-white/55">Japan surf journal</p>
                    <p class="mt-2 text-sm text-white/75">æ³¢ä¹—ã‚Š · Naminori</p>
                </div>
                <div class="surf-stamp hidden text-[10px] font-bold md:block">
                    <span class="block text-[9px] uppercase tracking-[.25em] text-white/45">TIDE REPORT</span>
                    <span class="mt-1 block text-xl leading-none">2.4m / offshore</span>
                </div>
            </div>

            <div class="relative z-10 max-w-3xl">
                <div class="mb-6 flex items-center gap-3">
                    <span class="h-px w-14 bg-[#e4645d]"></span>
                    <p class="tracking-[.2em] text-[10px] font-bold uppercase text-[#f08b82]">maré · litoral · liberdade</p>
                </div>
                <h1 class="font-['Playfair_Display'] tracking-[-.055em] text-6xl font-semibold leading-[.9] sm:text-7xl md:text-9xl">
                    O Japão<br><span class="text-[#e4645d]">surfa.</span>
                </h1>
                <p class="mt-8 max-w-xl text-sm leading-8 text-white/65 md:text-base">
                    Do Pacífico às praias de Chiba, o surf japonês é uma conversa
                    entre corpo, prancha e oceano. Entre na água e conheça essa
                    cultura costeira.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#maré" class="inline-flex items-center gap-3 bg-[#c72b30] px-7 py-4 text-[10px] font-bold uppercase tracking-[.2em] transition hover:-translate-y-1 hover:bg-[#a51f25]">
                        Ler a maré <i class="bi bi-arrow-down-right"></i>
                    </a>
                    <span class="inline-flex items-center gap-3 border border-white/25 px-5 py-4 text-[10px] font-bold uppercase tracking-[.2em] text-white/70">
                        <i class="bi bi-water text-[#e4645d]"></i> Oceano Pacífico
                    </span>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 h-1 w-full bg-gradient-to-r from-[#c72b30] via-[#e4645d] to-transparent"></div>
    </section>

    <!-- LEITURA DA MARÃ‰ -->
    <section id="maré" class="bg-[#071b2a] text-white">
        <div class="mx-auto grid max-w-7xl divide-y divide-white/10 px-6 md:grid-cols-4 md:divide-x md:divide-y-0 md:px-10">
            <div class="py-7 md:px-7 md:first:pl-0">
                <p class="tracking-[.2em] text-[9px] text-white/40">01 / OCEANO</p>
                <p class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-3xl">Pacífico</p>
                <p class="mt-2 text-xs text-white/50">Ondas que encontram o arquipélago.</p>
            </div>
            <div class="py-7 md:px-7">
                <p class="tracking-[.2em] text-[9px] text-white/40">02 / COSTA</p>
                <p class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-3xl">3.000 km</p>
                <p class="mt-2 text-xs text-white/50">Um litoral para descobrir.</p>
            </div>
            <div class="py-7 md:px-7">
                <p class="tracking-[.2em] text-[9px] text-white/40">03 / RITMO</p>
                <p class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-3xl">Naminori</p>
                <p class="mt-2 text-xs text-white/50">A arte de cavalgar a onda.</p>
            </div>
            <div class="py-7 md:px-7 md:last:pr-0">
                <p class="tracking-[.2em] text-[9px] text-white/40">04 / CASA</p>
                <p class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-3xl">Shonan</p>
                <p class="mt-2 text-xs text-white/50">A praia que vive o surf.</p>
            </div>
        </div>
    </section>

    <!-- A CULTURA DA ONDA -->
    <section class="surf-paper px-6 py-24 md:px-10 md:py-32">
        <div class="mx-auto grid max-w-7xl gap-14 lg:grid-cols-[.8fr_1.2fr] lg:items-end">
            <div>
                <p class="tracking-[.2em] text-[10px] font-bold text-[#c72b30]">01 / A CULTURA DA ONDA</p>
                <h2 class="font-['Playfair_Display'] tracking-[-.055em] mt-4 text-5xl font-semibold leading-none md:text-7xl">Mais que<br><span class="text-[#c72b30]">um esporte.</span></h2>
                <p class="mt-7 max-w-md text-sm leading-8 text-[#53636b]">
                    No Japão, entrar no mar é aprender a observar. A força da
                    onda encontra a disciplina do surfista e cria um estilo de
                    vida que respeita o tempo da natureza.
                </p>
                <div class="mt-9 flex gap-8 border-t border-[#c72b30]/25 pt-6">
                    <div><p class="font-['Playfair_Display'] tracking-[-.055em] text-4xl text-[#c72b30]">01</p><p class="tracking-[.2em] text-[9px] text-[#718078]">PRANCHA</p></div>
                    <div><p class="font-['Playfair_Display'] tracking-[-.055em] text-4xl text-[#c72b30]">01</p><p class="tracking-[.2em] text-[9px] text-[#718078]">ONDA</p></div>
                    <div><p class="font-['Playfair_Display'] tracking-[-.055em] text-4xl text-[#c72b30]">âˆž</p><p class="tracking-[.2em] text-[9px] text-[#718078]">POSSIBILIDADES</p></div>
                </div>
            </div>
            <div class="relative min-h-[430px]">
                <div class="overflow-hidden absolute inset-0">
                    <img src="../img/surf/praia.png" alt="Surfista em uma onda no litoral japonês" class="surf-photo h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#071b2a]/80 via-transparent to-transparent"></div>
                </div>
                <p class="[writing-mode:vertical-rl] tracking-[.28em] absolute right-5 top-6 text-xs text-white/70">海 · 風 · 波 · è‡ªç”±</p>
                <div class="absolute bottom-7 left-7">
                    <p class="tracking-[.2em] text-[9px] text-[#f08b82]">SURF JAPAN</p>
                    <p class="font-['Playfair_Display'] tracking-[-.055em] mt-2 text-3xl text-white">Respeitar é permanecer.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- GESTOS DO SURF -->
    <section class="bg-[#fdfbf7] px-6 py-24 md:px-10 md:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="mb-14 flex flex-wrap items-end justify-between gap-8">
                <div>
                    <p class="tracking-[.2em] text-[10px] font-bold text-[#c72b30]">02 / O RITUAL</p>
                    <h2 class="font-['Playfair_Display'] tracking-[-.055em] mt-4 text-5xl font-semibold leading-none md:text-7xl">Ler. Remar.<br><span class="text-[#c72b30]">Surfar.</span></h2>
                </div>
                <p class="max-w-sm text-sm leading-7 text-[#53636b]">O surf começa antes de tocar a água: na previsão, no preparo e no olhar para o horizonte.</p>
            </div>
            <div class="surf-wave-pattern mb-10 h-10"></div>
            <div class="grid gap-5 md:grid-cols-3">
                <article class="surf-card border-t-2 border-[#c72b30] bg-white p-7">
                    <i class="bi bi-eye text-3xl text-[#c72b30]"></i>
                    <p class="tracking-[.2em] mt-8 text-[9px] text-[#c72b30]">01 / OBSERVAR</p>
                    <h3 class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-3xl">Ler o mar</h3>
                    <p class="mt-3 text-sm leading-7 text-[#647078]">Vento, corrente e maré contam a história da próxima onda.</p>
                </article>
                <article class="surf-card border-t-2 border-[#0e6070] bg-white p-7">
                    <i class="bi bi-wind text-3xl text-[#0e6070]"></i>
                    <p class="tracking-[.2em] mt-8 text-[9px] text-[#0e6070]">02 / PREPARAR</p>
                    <h3 class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-3xl">Sentir o ritmo</h3>
                    <p class="mt-3 text-sm leading-7 text-[#647078]">O corpo acompanha o oceano sem tentar dominá-lo.</p>
                </article>
                <article class="surf-card border-t-2 border-[#71856a] bg-white p-7">
                    <i class="bi bi-arrow-up-right text-3xl text-[#71856a]"></i>
                    <p class="tracking-[.2em] mt-8 text-[9px] text-[#71856a]">03 / FLUIR</p>
                    <h3 class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-3xl">Entrar na onda</h3>
                    <p class="mt-3 text-sm leading-7 text-[#647078]">Equilíbrio, liberdade e presença em um único movimento.</p>
                </article>
            </div>
            <div class="surf-tide-card mt-8 grid gap-5 md:grid-cols-[auto_1fr_auto] md:items-center">
                <div><p class="tracking-[.2em] text-[9px] text-[#c72b30]">TIDE NOTE / CHIBA</p><p class="font-['Playfair_Display'] tracking-[-.055em] mt-1 text-2xl">Maré subindo</p></div>
                <div class="surf-tide-line"></div>
                <p class="tracking-[.2em] text-[9px] text-[#53636b]">2.4M · OFFSHORE</p>
            </div>
        </div>
    </section>

    <!-- DESTINOS -->
    <section class="bg-[#0d5261] px-6 py-24 text-white md:px-10 md:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="mb-14 max-w-2xl">
                <p class="tracking-[.2em] text-[10px] font-bold text-[#f08b82]">03 / MAPA DO LITORAL</p>
                <h2 class="font-['Playfair_Display'] tracking-[-.055em] mt-4 text-5xl font-semibold leading-none md:text-7xl">Onde o Japão<br><span class="text-[#f08b82]">encontra o mar.</span></h2>
            </div>
            <div class="grid gap-6 md:grid-cols-2">
                <article class="overflow-hidden group relative min-h-[420px]">
                    <img src="../img/surf/shonan.png" alt="Praia de Shonan, no Japão" class="surf-photo absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#071b2a]/95 via-[#071b2a]/20 to-transparent"></div>
                    <div class="absolute bottom-7 left-7">
                        <p class="tracking-[.2em] text-[9px] text-[#f08b82]">KANAGAWA · 35°N</p>
                        <h3 class="font-['Playfair_Display'] tracking-[-.055em] mt-2 text-4xl">Shonan</h3>
                        <p class="mt-3 max-w-sm text-sm leading-6 text-white/70">A cultura de praia mais próxima de Tóquio, onde o surf encontra a vida urbana.</p>
                    </div>
                </article>
                <article class="overflow-hidden group relative min-h-[420px]">
                    <img src="../img/surf/chiba.png" alt="Litoral de Chiba, no Japão" class="surf-photo absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#071b2a]/95 via-[#071b2a]/20 to-transparent"></div>
                    <div class="absolute bottom-7 left-7">
                        <p class="tracking-[.2em] text-[9px] text-[#f08b82]">CHIBA · 35°N</p>
                        <h3 class="font-['Playfair_Display'] tracking-[-.055em] mt-2 text-4xl">Tsurigasaki</h3>
                        <p class="mt-3 max-w-sm text-sm leading-6 text-white/70">Ondas abertas e o palco que recebeu a estreia olímpica do surf.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- OLIMPÍADAS -->
    <section class="surf-paper px-6 py-24 md:px-10 md:py-32">
        <div class="mx-auto grid max-w-7xl gap-14 lg:grid-cols-[1.05fr_.95fr] lg:items-center">
            <div class="overflow-hidden relative min-h-[450px]">
                <img src="../img/surf/kanoa.png" alt="Surfista durante as Olimpíadas de Tóquio" class="surf-photo absolute inset-0 h-full w-full object-cover">
                <div class="absolute left-6 top-6 bg-[#c72b30] px-4 py-3 text-white">
                    <p class="font-['Playfair_Display'] tracking-[-.055em] text-3xl">2020</p>
                    <p class="tracking-[.2em] text-[8px]">TOKYO OLYMPICS</p>
                </div>
            </div>
            <div>
                <p class="tracking-[.2em] text-[10px] font-bold text-[#c72b30]">04 / UM MOMENTO HISTÃ“RICO</p>
                <h2 class="font-['Playfair_Display'] tracking-[-.055em] mt-4 text-5xl font-semibold leading-none md:text-7xl">O mundo<br><span class="text-[#c72b30]">entrou na água.</span></h2>
                <p class="mt-7 text-sm leading-8 text-[#53636b]">
                    Nos Jogos de Tóquio, realizados em 2021, o surf estreou
                    oficialmente nas Olimpíadas. A praia de Tsurigasaki,
                    em Chiba, transformou a costa japonesa em palco mundial.
                </p>
                <div class="mt-8 flex items-center gap-4 border-l-2 border-[#c72b30] pl-5">
                    <i class="bi bi-trophy text-3xl text-[#c72b30]"></i>
                    <div><p class="text-sm font-bold uppercase tracking-wider">Estreia olímpica</p><p class="text-sm text-[#68736e]">Uma nova página para o esporte.</p></div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRANCHA E COMUNIDADE -->
    <section class="bg-[#071b2a] px-6 py-24 text-white md:px-10 md:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-14 lg:grid-cols-[1fr_1fr] lg:items-center">
                <div>
                    <p class="tracking-[.2em] text-[10px] font-bold text-[#f08b82]">05 / FORA DA ONDA</p>
                    <h2 class="font-['Playfair_Display'] tracking-[-.055em] mt-4 text-5xl font-semibold leading-none md:text-7xl">Uma praia,<br><span class="text-[#e4645d]">muitas histórias.</span></h2>
                    <p class="mt-7 max-w-lg text-sm leading-8 text-white/55">
                        Escolas, lojas, campeonatos e comunidades fazem do surf
                        japonês uma cultura viva. A prancha é só o começo da
                        conversa entre pessoas e território.
                    </p>
                    <div class="mt-9 grid gap-4 sm:grid-cols-3">
                        <div class="border border-white/10 p-5"><i class="bi bi-shop text-2xl text-[#e4645d]"></i><h3 class="mt-5 text-sm font-semibold">Comércio</h3><p class="mt-2 text-xs leading-5 text-white/45">A economia que nasce na areia.</p></div>
                        <div class="border border-white/10 p-5"><i class="bi bi-people text-2xl text-[#e4645d]"></i><h3 class="mt-5 text-sm font-semibold">Comunidade</h3><p class="mt-2 text-xs leading-5 text-white/45">A praia como ponto de encontro.</p></div>
                        <div class="border border-white/10 p-5"><i class="bi bi-tree text-2xl text-[#e4645d]"></i><h3 class="mt-5 text-sm font-semibold">Cuidado</h3><p class="mt-2 text-xs leading-5 text-white/45">Proteger o mar é parte do esporte.</p></div>
                    </div>
                </div>
                <div class="surf-board flex items-center justify-center">
                    <span class="[writing-mode:vertical-rl] tracking-[.28em] absolute right-5 top-5 text-xs text-white/60">波 · 海 · 風 · è‡ªç”±</span>
                    <p class="relative z-10 mt-72 tracking-[.2em] text-[9px] text-white/70">BOARD / OCEAN / COMMUNITY</p>
                </div>
            </div>
            <div class="surf-wave-pattern mt-20 h-10 opacity-70"></div>
            <div class="mt-8 flex flex-wrap items-end justify-between gap-6">
                <div><p class="tracking-[.2em] text-[10px] text-white/40">JAPAN SURF JOURNAL</p><p class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-4xl md:text-6xl">A próxima onda já vem.</p></div>
                <a href="#inicio" class="inline-flex items-center gap-3 text-[10px] font-bold uppercase tracking-[.2em] text-[#f08b82] transition hover:text-white">Voltar ao início <i class="bi bi-arrow-up-right"></i></a>
            </div>
        </div>
    </section>
</main>

<?php include '../../assets/templates/footer.php'; ?>
