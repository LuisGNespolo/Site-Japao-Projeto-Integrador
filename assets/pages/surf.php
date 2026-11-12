<?php
include_once("../templates/header.php");
?>

<main class="bg-[#f8f5ef] font-['Noto_Sans_JP'] text-[#171717] antialiased">

    <!-- HERO -->
    <section
        class="relative flex min-h-[480px] items-center overflow-hidden bg-cover bg-center md:min-h-[620px]"
        style="background-image: url('../img/surf/surfBanner.png');"
    >

        <!-- SOBREPOSIÇÃO -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#071018]/95 via-[#071018]/70 to-[#071018]/20"></div>

        <!-- ELEMENTO DECORATIVO -->
        <div class="pointer-events-none absolute right-10 top-8 hidden select-none font-['Playfair_Display'] text-[180px] font-bold text-white/[0.06] md:block">
            波
        </div>

        <div class="relative mx-auto w-full max-w-7xl px-6 py-24 md:px-10">

            <div class="max-w-3xl">

                <div class="mb-6 flex items-center gap-3">
                    <span class="h-px w-12 bg-[#c9272c]"></span>

                    <p class="text-xs font-bold uppercase tracking-[0.35em] text-red-300">
                        Natureza · Esporte · Liberdade
                    </p>
                </div>

                <h1 class="font-['Playfair_Display'] text-5xl font-semibold leading-tight text-white md:text-7xl">
                    Surf no <span class="text-[#e05257]">Japão.</span>
                </h1>

                <p class="mt-6 max-w-2xl text-sm leading-8 text-gray-300 md:text-lg">
                    Entre ondas, tradição e modernidade, o Japão construiu uma
                    forte relação com o surf. Conheça suas praias, sua cultura
                    esportiva e sua presença no cenário internacional.
                </p>

                <div class="mt-8">
                    <p class="font-['Noto_Sans_JP'] text-5xl text-[#e05257]">
                        波乗り
                    </p>

                    <p class="mt-2 text-xs uppercase tracking-[0.3em] text-gray-400">
                        Naminori · A arte de surfar
                    </p>
                </div>

                <a
                    href="#historia"
                    class="mt-10 inline-flex items-center gap-4 border border-white/30 px-7 py-4 text-xs font-bold uppercase tracking-[0.2em] text-white transition duration-300 hover:border-[#c9272c] hover:bg-[#c9272c]"
                >
                    Explorar o surf
                    <i class="bi bi-arrow-down"></i>
                </a>

            </div>
        </div>

        <div class="absolute bottom-0 left-0 h-1 w-1/3 bg-[#c9272c]"></div>

    </section>


    <!-- INTRODUÇÃO -->
    <section id="historia" class="scroll-mt-20 bg-[#f8f5ef] px-6 py-24 md:px-10">

        <div class="mx-auto grid max-w-7xl items-center gap-16 md:grid-cols-2">

            <div>

                <div class="mb-5 flex items-center gap-3">
                    <span class="h-px w-10 bg-[#c9272c]"></span>

                    <p class="text-xs font-bold uppercase tracking-[0.3em] text-[#c9272c]">
                        A cultura das ondas
                    </p>
                </div>

                <h2 class="mb-8 font-['Playfair_Display'] text-4xl font-semibold leading-tight md:text-5xl">
                    O surf e sua conexão com o Japão
                </h2>

                <p class="mb-5 text-sm leading-8 text-[#555] md:text-base">
                    O Japão possui um extenso litoral e diversas regiões
                    favoráveis à prática do surf. Praias como Shonan e Chiba
                    são conhecidas por receber surfistas e amantes dos esportes
                    aquáticos.
                </p>

                <p class="mb-5 text-sm leading-8 text-[#555] md:text-base">
                    Ao longo dos anos, o esporte ganhou espaço na cultura
                    japonesa, principalmente entre os jovens e nas comunidades
                    litorâneas. Escolas de surf, lojas especializadas e eventos
                    esportivos ajudaram a fortalecer essa presença.
                </p>

                <p class="text-sm leading-8 text-[#555] md:text-base">
                    Mais do que uma atividade esportiva, o surf representa
                    uma relação com a natureza, o mar e o estilo de vida
                    das cidades costeiras.
                </p>

                <div class="mt-9 flex items-center gap-4 border-l-2 border-[#c9272c] pl-5">

                    <i class="bi bi-water text-3xl text-[#c9272c]"></i>

                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider">
                            Cultura e natureza
                        </p>

                        <p class="text-sm text-gray-500">
                            Uma conexão que vai além das ondas.
                        </p>
                    </div>

                </div>

            </div>


            <div class="relative">

                <img
                    src="../img/surf/praia.png"
                    alt="Surfista em uma onda no litoral japonês"
                    class="h-[350px] w-full object-cover shadow-xl md:h-[500px]"
                >

                <div class="absolute -bottom-7 -left-5 bg-[#071018] px-8 py-6 text-white shadow-xl md:-left-8">

                    <p class="font-['Playfair_Display'] text-3xl font-semibold text-[#e05257]">
                        SURF JAPAN
                    </p>

                    <p class="mt-2 text-xs uppercase tracking-[0.2em] text-gray-300">
                        A cultura do oceano
                    </p>

                </div>

                <div class="absolute -right-3 -top-3 h-24 w-24 border-r-2 border-t-2 border-[#c9272c]"></div>

            </div>

        </div>
    </section>


    <!-- DESTAQUES -->
    <section class="bg-[#071018] px-6 py-24 text-white md:px-10">

        <div class="mx-auto max-w-7xl">

            <div class="mb-16 max-w-3xl">

                <div class="mb-5 flex items-center gap-3">
                    <span class="h-px w-10 bg-[#c9272c]"></span>

                    <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-300">
                        O universo do surf
                    </p>
                </div>

                <h2 class="mb-6 font-['Playfair_Display'] text-4xl font-semibold md:text-5xl">
                    Muito além das ondas
                </h2>

                <p class="leading-8 text-gray-400">
                    O surf japonês está relacionado ao esporte, ao turismo,
                    à cultura local e à valorização das paisagens naturais.
                </p>

            </div>


            <div class="grid gap-7 md:grid-cols-3">


                <!-- CARD 1 -->
                <article class="group overflow-hidden border border-white/10 bg-white/[0.03] transition duration-300 hover:-translate-y-2 hover:border-[#c9272c]">

                    <div class="overflow-hidden">
                        <img
                            src="../img/surf/onda.png"
                            alt="Surfista aproveitando uma onda"
                            class="h-64 w-full object-cover transition duration-500 group-hover:scale-105"
                        >
                    </div>

                    <div class="p-8">

                        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-full bg-[#c9272c]/15 text-2xl text-[#e05257]">
                            <i class="bi bi-water"></i>
                        </div>

                        <h3 class="mb-4 font-['Playfair_Display'] text-2xl font-semibold">
                            Praias e ondas
                        </h3>

                        <p class="text-sm leading-7 text-gray-400">
                            O litoral japonês oferece diferentes condições
                            para a prática do surf, atraindo iniciantes
                            e surfistas experientes.
                        </p>

                        <div class="mt-6 h-px w-12 bg-[#c9272c] transition-all duration-300 group-hover:w-24"></div>

                    </div>

                </article>


                <!-- CARD 2 -->
                <article class="group overflow-hidden border border-white/10 bg-white/[0.03] transition duration-300 hover:-translate-y-2 hover:border-[#c9272c]">

                    <div class="overflow-hidden">
                        <img
                            src="../img/surf/olimpiadas.png"
                            alt="Referência às Olimpíadas"
                            class="h-64 w-full object-cover transition duration-500 group-hover:scale-105"
                        >
                    </div>

                    <div class="p-8">

                        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-full bg-[#c9272c]/15 text-2xl text-[#e05257]">
                            <i class="bi bi-trophy"></i>
                        </div>

                        <h3 class="mb-4 font-['Playfair_Display'] text-2xl font-semibold">
                            Surf nas Olimpíadas
                        </h3>

                        <p class="text-sm leading-7 text-gray-400">
                            A estreia olímpica do surf aconteceu nos Jogos
                            de Tóquio 2020, realizados em 2021, marcando
                            um momento importante para o esporte.
                        </p>

                        <div class="mt-6 h-px w-12 bg-[#c9272c] transition-all duration-300 group-hover:w-24"></div>

                    </div>

                </article>


                <!-- CARD 3 -->
                <article class="group overflow-hidden border border-white/10 bg-white/[0.03] transition duration-300 hover:-translate-y-2 hover:border-[#c9272c]">

                    <div class="overflow-hidden">
                        <img
                            src="../img/surf/casa.png"
                            alt="Arquitetura tradicional japonesa"
                            class="h-64 w-full object-cover transition duration-500 group-hover:scale-105"
                        >
                    </div>

                    <div class="p-8">

                        <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-full bg-[#c9272c]/15 text-2xl text-[#e05257]">
                            <i class="bi bi-globe-asia-australia"></i>
                        </div>

                        <h3 class="mb-4 font-['Playfair_Display'] text-2xl font-semibold">
                            Turismo e cultura
                        </h3>

                        <p class="text-sm leading-7 text-gray-400">
                            O surf movimenta o turismo, fortalece os
                            estabelecimentos locais e aproxima visitantes
                            das comunidades costeiras.
                        </p>

                        <div class="mt-6 h-px w-12 bg-[#c9272c] transition-all duration-300 group-hover:w-24"></div>

                    </div>

                </article>

            </div>

        </div>
    </section>


    <!-- OLIMPÍADAS -->
    <section id="olimpiadas" class="scroll-mt-20 bg-[#f8f5ef] px-6 py-24 md:px-10">

        <div class="mx-auto grid max-w-7xl items-center gap-16 md:grid-cols-2">

            <div class="relative order-2 md:order-1">

                <img
                    src="../img/surf/kanoa.png"
                    alt="Surf nas Olimpíadas de Tóquio"
                    class="h-[330px] w-full object-cover shadow-xl md:h-[480px]"
                >

                <div class="absolute -bottom-6 -right-5 bg-[#c9272c] px-8 py-6 text-white shadow-xl">

                    <p class="font-['Playfair_Display'] text-4xl font-bold">
                        2020
                    </p>

                    <p class="mt-1 text-xs uppercase tracking-[0.2em]">
                        Estreia olímpica
                    </p>

                </div>

            </div>


            <div class="order-1 md:order-2">

                <div class="mb-5 flex items-center gap-3">
                    <span class="h-px w-10 bg-[#c9272c]"></span>

                    <p class="text-xs font-bold uppercase tracking-[0.3em] text-[#c9272c]">
                        Um momento histórico
                    </p>
                </div>

                <h2 class="mb-8 font-['Playfair_Display'] text-4xl font-semibold leading-tight md:text-5xl">
                    O surf chegou às Olimpíadas
                </h2>

                <p class="mb-5 text-sm leading-8 text-gray-600 md:text-base">
                    O surf fez sua estreia nos Jogos Olímpicos de Tóquio 2020,
                    realizados em 2021. A inclusão do esporte representou
                    uma conquista importante para os surfistas e para a
                    comunidade internacional do surf.
                </p>

                <p class="mb-5 text-sm leading-8 text-gray-600 md:text-base">
                    As disputas aconteceram na praia de Tsurigasaki, localizada
                    em Chiba, uma região conhecida por suas condições favoráveis
                    à prática do esporte.
                </p>

                <p class="text-sm leading-8 text-gray-600 md:text-base">
                    A competição aproximou ainda mais o surf do público mundial
                    e destacou o potencial do Japão como palco de grandes
                    eventos esportivos.
                </p>

                <div class="mt-8 flex items-center gap-4 border-l-2 border-[#c9272c] pl-5">

                    <i class="bi bi-award text-3xl text-[#c9272c]"></i>

                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider">
                            Tóquio 2020
                        </p>

                        <p class="text-sm text-gray-500">
                            Uma nova página na história olímpica do surf.
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- PRAIAS DO JAPÃO -->
    <section class="bg-[#071018] px-6 py-24 text-white md:px-10">

        <div class="mx-auto max-w-7xl">

            <div class="mb-16 text-center">

                <div class="mb-5 flex items-center justify-center gap-3">
                    <span class="h-px w-10 bg-[#c9272c]"></span>

                    <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-300">
                        Destinos do litoral
                    </p>

                    <span class="h-px w-10 bg-[#c9272c]"></span>
                </div>

                <h2 class="mb-6 font-['Playfair_Display'] text-4xl font-semibold md:text-5xl">
                    Lugares conhecidos pelo surf
                </h2>

                <p class="mx-auto max-w-2xl text-sm leading-8 text-gray-400 md:text-base">
                    Algumas regiões japonesas se destacam pela relação
                    com o mar e pela presença de comunidades de surfistas.
                </p>

            </div>


            <div class="grid gap-8 md:grid-cols-2">

                <!-- SHONAN -->
                <article class="group relative min-h-[350px] overflow-hidden">

                    <img
                        src="../img/surf/shonan.png"
                        alt="Paisagem de praia e ondas"
                        class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105"
                    >

                    <div class="absolute inset-0 bg-gradient-to-t from-[#071018]/95 via-[#071018]/30 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 p-8 md:p-10">

                        <p class="mb-3 text-xs font-bold uppercase tracking-[0.3em] text-red-300">
                            Kanagawa
                        </p>

                        <h3 class="mb-4 font-['Playfair_Display'] text-3xl font-semibold md:text-4xl">
                            Shonan
                        </h3>

                        <p class="max-w-md text-sm leading-7 text-gray-300">
                            Uma das regiões costeiras mais conhecidas do Japão,
                            com praias frequentadas por surfistas e uma forte
                            cultura ligada ao mar.
                        </p>

                    </div>

                </article>


                <!-- CHIBA -->
                <article class="group relative min-h-[350px] overflow-hidden">

                    <img
                        src="../img/surf/chiba.png"
                        alt="Praia japonesa com ondas"
                        class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105"
                    >

                    <div class="absolute inset-0 bg-gradient-to-t from-[#071018]/95 via-[#071018]/30 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 p-8 md:p-10">

                        <p class="mb-3 text-xs font-bold uppercase tracking-[0.3em] text-red-300">
                            Região de Kanto
                        </p>

                        <h3 class="mb-4 font-['Playfair_Display'] text-3xl font-semibold md:text-4xl">
                            Chiba
                        </h3>

                        <p class="max-w-md text-sm leading-7 text-gray-300">
                            Conhecida por suas praias e condições para a prática
                            do surf, Chiba também recebeu as competições
                            olímpicas da modalidade em Tóquio 2020.
                        </p>

                    </div>

                </article>

            </div>

        </div>
    </section>


    <!-- IMPACTO DO SURF -->
    <section id="impacto" class="scroll-mt-20 bg-[#f8f5ef] px-6 py-24 md:px-10">

        <div class="mx-auto max-w-7xl">

            <div class="mb-16 max-w-3xl">

                <div class="mb-5 flex items-center gap-3">
                    <span class="h-px w-10 bg-[#c9272c]"></span>

                    <p class="text-xs font-bold uppercase tracking-[0.3em] text-[#c9272c]">
                        Esporte e desenvolvimento
                    </p>
                </div>

                <h2 class="mb-6 font-['Playfair_Display'] text-4xl font-semibold md:text-5xl">
                    O impacto do surf no Japão
                </h2>

                <p class="leading-8 text-gray-600">
                    A prática do surf também influencia a economia e a vida
                    das cidades litorâneas, criando oportunidades e
                    fortalecendo a relação das pessoas com o oceano.
                </p>

            </div>


            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">


                <!-- TURISMO -->
                <article class="group border border-[#e5ded2] bg-white p-7 transition duration-300 hover:-translate-y-2 hover:border-[#c9272c] hover:shadow-lg">

                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-[#fbe9e8] text-2xl text-[#c9272c] transition group-hover:bg-[#c9272c] group-hover:text-white">
                        <i class="bi bi-geo-alt"></i>
                    </div>

                    <h3 class="mb-3 font-['Playfair_Display'] text-xl font-semibold">
                        Turismo
                    </h3>

                    <p class="text-sm leading-7 text-gray-600">
                        Praias e eventos atraem visitantes interessados
                        em conhecer o litoral japonês.
                    </p>

                </article>


                <!-- COMÉRCIO -->
                <article class="group border border-[#e5ded2] bg-white p-7 transition duration-300 hover:-translate-y-2 hover:border-[#c9272c] hover:shadow-lg">

                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-[#fbe9e8] text-2xl text-[#c9272c] transition group-hover:bg-[#c9272c] group-hover:text-white">
                        <i class="bi bi-shop"></i>
                    </div>

                    <h3 class="mb-3 font-['Playfair_Display'] text-xl font-semibold">
                        Comércio local
                    </h3>

                    <p class="text-sm leading-7 text-gray-600">
                        Lojas, escolas de surf e estabelecimentos
                        acompanham o crescimento do esporte.
                    </p>

                </article>


                <!-- EVENTOS -->
                <article class="group border border-[#e5ded2] bg-white p-7 transition duration-300 hover:-translate-y-2 hover:border-[#c9272c] hover:shadow-lg">

                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-[#fbe9e8] text-2xl text-[#c9272c] transition group-hover:bg-[#c9272c] group-hover:text-white">
                        <i class="bi bi-trophy"></i>
                    </div>

                    <h3 class="mb-3 font-['Playfair_Display'] text-xl font-semibold">
                        Eventos esportivos
                    </h3>

                    <p class="text-sm leading-7 text-gray-600">
                        Competições e campeonatos ajudam a divulgar
                        o surf e incentivar novos atletas.
                    </p>

                </article>


                <!-- NATUREZA -->
                <article class="group border border-[#e5ded2] bg-white p-7 transition duration-300 hover:-translate-y-2 hover:border-[#c9272c] hover:shadow-lg">

                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-[#fbe9e8] text-2xl text-[#c9272c] transition group-hover:bg-[#c9272c] group-hover:text-white">
                        <i class="bi bi-tree"></i>
                    </div>

                    <h3 class="mb-3 font-['Playfair_Display'] text-xl font-semibold">
                        Natureza
                    </h3>

                    <p class="text-sm leading-7 text-gray-600">
                        O contato com o oceano também incentiva
                        a valorização e o cuidado com o litoral.
                    </p>

                </article>

            </div>


            <!-- DESTAQUE FINAL -->
            <div class="relative mt-16 overflow-hidden border border-[#e5ded2] md:flex">

                <img
                    src="../img/surf/moments.png"
                    alt="Paisagem da arquitetura japonesa"
                    class="h-64 w-full object-cover md:h-auto md:w-1/2"
                >

                <div class="relative flex flex-col justify-center bg-[#071018] p-9 text-white md:w-1/2 md:p-14">

                    <div class="pointer-events-none absolute right-5 top-0 select-none font-['Playfair_Display'] text-8xl font-bold text-white/[0.04]">
                        波
                    </div>

                    <div class="mb-5 flex items-center gap-3">
                        <span class="h-px w-10 bg-[#c9272c]"></span>

                        <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-300">
                            Espírito do oceano
                        </p>
                    </div>

                    <h3 class="mb-6 font-['Playfair_Display'] text-3xl font-semibold leading-tight md:text-4xl">
                        Uma paixão que acompanha as ondas
                    </h3>

                    <p class="leading-8 text-gray-400">
                        O surf representa uma conexão especial entre esporte,
                        natureza e cultura. No Japão, essa relação continua
                        inspirando pessoas e fortalecendo a identidade
                        das comunidades litorâneas.
                    </p>

                    <a
                        href="#historia"
                        class="mt-8 inline-flex w-fit items-center gap-3 text-xs font-bold uppercase tracking-[0.2em] text-red-300 transition hover:text-white"
                    >
                        Voltar ao início
                        <i class="bi bi-arrow-up"></i>
                    </a>

                </div>

            </div>

        </div>
    </section>

</main>

<?php include '../../assets/templates/footer.php'; ?>