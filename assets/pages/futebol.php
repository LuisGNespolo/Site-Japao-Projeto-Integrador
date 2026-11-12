<?php
include_once("../templates/header.php");
?>

<main class="bg-[#f8f5ef] text-[#171717] antialiased font-['Noto_Sans_JP']">

    <!-- HERO -->
    <section
        class="relative flex min-h-[600px] items-center overflow-hidden bg-cover bg-center md:min-h-[700px]"
        style="background-image: url('../img/futebol/banner.png');"
    >
        <div class="mx-auto w-full max-w-7xl px-6 py-28 md:px-10">
            <div class="max-w-3xl text-white">

                <div class="mb-7 flex items-center gap-3">
                    <span class="h-px w-12 bg-[#c9272c]"></span>

                    <p class="text-xs font-bold uppercase tracking-[0.35em] text-red-300">
                        Esporte · Cultura · União
                    </p>
                </div>

                <h1 class="mb-7 font-['Playfair_Display'] text-5xl font-semibold leading-tight md:text-7xl">
                    Futebol no <span class="text-[#e05257]">Japão.</span>
                </h1>

                <p class="max-w-2xl text-base leading-8 text-gray-300 md:text-lg">
                    Muito além das quatro linhas, o futebol japonês representa
                    dedicação, disciplina e união. Conheça a trajetória das
                    seleções masculina e feminina nos maiores campeonatos do mundo.
                </p>

                <div class="mt-8">
                    <p class="font-['Playfair_Display'] text-5xl text-red-300">
                        サッカー
                    </p>

                    <p class="mt-2 text-xs uppercase tracking-[0.3em] text-gray-400">
                        A paixão japonesa pelo futebol
                    </p>
                </div>

                <a
                    href="#historia"
                    class="mt-10 inline-flex items-center gap-4 border border-white/30 px-7 py-4 text-xs font-bold uppercase tracking-[0.2em] transition duration-300 hover:border-[#c9272c] hover:bg-[#c9272c]"
                >
                    Explorar história
                    <i class="bi bi-arrow-down"></i>
                </a>

            </div>
        </div>

        <div class="absolute bottom-0 right-0 hidden select-none opacity-10 md:block">
            <span class="font-['Playfair_Display'] text-[180px] font-bold text-white">
                日本
            </span>
        </div>
    </section>


    <!-- HISTÓRIA -->
    <section id="historia" class="scroll-mt-20 bg-[#f8f5ef] px-6 py-24 md:px-10">

        <div class="mx-auto grid max-w-7xl items-center gap-16 md:grid-cols-2">

            <div>

                <div class="mb-5 flex items-center gap-3">
                    <span class="h-px w-10 bg-[#c9272c]"></span>

                    <p class="text-xs font-bold uppercase tracking-[0.3em] text-[#c9272c]">
                        A trajetória do esporte
                    </p>
                </div>

                <h2 class="mb-8 font-['Playfair_Display'] text-4xl font-semibold leading-tight md:text-5xl">
                    História do futebol japonês
                </h2>

                <p class="mb-5 text-base leading-8 text-[#555]">
                    O futebol começou a ganhar espaço no Japão durante o final
                    do século XIX e se desenvolveu ao longo do século XX. Com o
                    passar dos anos, o país investiu na formação de atletas,
                    na organização dos clubes e na estrutura das competições.
                </p>

                <p class="mb-5 text-base leading-8 text-[#555]">
                    A criação da liga profissional japonesa, a J.League, em 1993,
                    ajudou a aumentar a popularidade do esporte e a melhorar o
                    nível competitivo dos jogadores.
                </p>

                <p class="text-base leading-8 text-[#555]">
                    Atualmente, o Japão é uma das principais forças do futebol
                    asiático, com seleções competitivas e atletas que também
                    atuam em grandes clubes internacionais.
                </p>

                <div class="mt-9 flex items-center gap-4 border-l-2 border-[#c9272c] pl-5">

                    <span class="font-['Playfair_Display'] text-4xl font-bold text-[#c9272c]">
                        1993
                    </span>

                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider">
                            Um novo capítulo
                        </p>

                        <p class="text-sm text-gray-500">
                            Fundação da J.League profissional
                        </p>
                    </div>

                </div>

            </div>


            <div class="relative">

                <img
                    src="https://images.unsplash.com/photo-1522778119026-d647f0596c20?auto=format&fit=crop&w=1200&q=85"
                    alt="Campo de futebol em um estádio"
                    class="h-[350px] w-full object-cover shadow-xl md:h-[500px]"
                >

                <div class="absolute -bottom-7 -left-5 bg-[#071018] px-8 py-6 text-white shadow-xl md:-left-8">

                    <p class="font-['Playfair_Display'] text-4xl font-bold text-[#e05257]">
                        J.LEAGUE
                    </p>

                    <p class="mt-2 text-xs uppercase tracking-[0.2em] text-gray-300">
                        Futebol profissional japonês
                    </p>

                </div>

                <div class="absolute -right-3 -top-3 h-24 w-24 border-r-2 border-t-2 border-[#c9272c]"></div>

            </div>

        </div>
    </section>


    <!-- SELEÇÃO MASCULINA -->
    <section id="copa-masculina" class="scroll-mt-20 bg-[#071018] px-6 py-24 text-white md:px-10">

        <div class="mx-auto max-w-7xl">

            <div class="mb-16 max-w-3xl">

                <div class="mb-5 flex items-center gap-3">
                    <span class="h-px w-10 bg-[#c9272c]"></span>

                    <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-300">
                        Seleção masculina
                    </p>
                </div>

                <h2 class="mb-7 font-['Playfair_Display'] text-4xl font-semibold leading-tight md:text-5xl">
                    O Japão nas Copas do Mundo
                </h2>

                <p class="leading-8 text-gray-400">
                    A seleção masculina japonesa participou pela primeira vez
                    de uma Copa do Mundo em 1998. Desde então, construiu uma
                    trajetória marcada por evolução, organização e resultados
                    importantes diante de seleções tradicionais.
                </p>

            </div>


            <div class="grid items-start gap-16 md:grid-cols-2">

                <!-- LINHA DO TEMPO -->

                <div class="relative pl-10">

                    <div class="absolute bottom-0 left-[5px] top-2 w-px bg-white/20"></div>


                    <article class="relative mb-12">

                        <div class="absolute -left-[40px] top-1 h-3 w-3 rounded-full border-2 border-[#c9272c] bg-[#071018]"></div>

                        <p class="mb-2 font-['Playfair_Display'] text-3xl font-semibold text-[#e05257]">
                            1998
                        </p>

                        <h3 class="mb-3 text-xl font-semibold">
                            A primeira participação
                        </h3>

                        <p class="leading-7 text-gray-400">
                            Na Copa da França, o Japão estreou no torneio
                            mundial masculino, iniciando uma presença frequente
                            nas edições seguintes.
                        </p>

                    </article>


                    <article class="relative mb-12">

                        <div class="absolute -left-[40px] top-1 h-3 w-3 rounded-full border-2 border-[#c9272c] bg-[#071018]"></div>

                        <p class="mb-2 font-['Playfair_Display'] text-3xl font-semibold text-[#e05257]">
                            2002
                        </p>

                        <h3 class="mb-3 text-xl font-semibold">
                            Oitavas de final em casa
                        </h3>

                        <p class="leading-7 text-gray-400">
                            Como um dos países-sede, o Japão chegou às oitavas
                            de final pela primeira vez, aumentando o interesse
                            nacional pelo esporte.
                        </p>

                    </article>


                    <article class="relative mb-12">

                        <div class="absolute -left-[40px] top-1 h-3 w-3 rounded-full border-2 border-[#c9272c] bg-[#071018]"></div>

                        <p class="mb-2 font-['Playfair_Display'] text-3xl font-semibold text-[#e05257]">
                            2010 · 2018
                        </p>

                        <h3 class="mb-3 text-xl font-semibold">
                            Campanhas competitivas
                        </h3>

                        <p class="leading-7 text-gray-400">
                            A seleção voltou às oitavas em 2010 e 2018,
                            mostrando sua capacidade de competir em alto nível.
                        </p>

                    </article>


                    <article class="relative">

                        <div class="absolute -left-[40px] top-1 h-3 w-3 rounded-full border-2 border-[#c9272c] bg-[#071018]"></div>

                        <p class="mb-2 font-['Playfair_Display'] text-3xl font-semibold text-[#e05257]">
                            2022
                        </p>

                        <h3 class="mb-3 text-xl font-semibold">
                            Vitórias históricas
                        </h3>

                        <p class="leading-7 text-gray-400">
                            No Catar, o Japão venceu Alemanha e Espanha na fase
                            de grupos e chegou novamente às oitavas de final.
                        </p>

                    </article>

                </div>


                <!-- IMAGEM E DESTAQUE -->

                <div>

                    <img
                        src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=1200&q=85"
                        alt="Jogadores disputando uma partida de futebol"
                        class="h-[300px] w-full object-cover shadow-2xl md:h-[420px]"
                    >

                    <div class="mt-7 border border-white/10 bg-white/[0.03] p-8">

                        <i class="bi bi-trophy mb-5 block text-3xl text-[#e05257]"></i>

                        <h3 class="mb-4 font-['Playfair_Display'] text-2xl font-semibold">
                            Uma seleção em crescimento
                        </h3>

                        <p class="leading-8 text-gray-400">
                            A seleção japonesa é conhecida pela organização
                            tática, pela velocidade de jogo e pela disciplina
                            coletiva. Esses fatores ajudam o país a enfrentar
                            adversários de diferentes estilos.
                        </p>

                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- SELEÇÃO FEMININA -->
    <section id="copa-feminina" class="scroll-mt-20 bg-[#f8f5ef] px-6 py-24 md:px-10">

        <div class="mx-auto max-w-7xl">

            <div class="mb-16 max-w-3xl">

                <div class="mb-5 flex items-center gap-3">
                    <span class="h-px w-10 bg-[#c9272c]"></span>

                    <p class="text-xs font-bold uppercase tracking-[0.3em] text-[#c9272c]">
                        Seleção feminina · Nadeshiko Japan
                    </p>
                </div>

                <h2 class="mb-7 font-['Playfair_Display'] text-4xl font-semibold leading-tight md:text-5xl">
                    O Japão na Copa do Mundo Feminina
                </h2>

                <p class="leading-8 text-[#555]">
                    A seleção feminina japonesa conquistou reconhecimento
                    internacional com seu estilo de jogo coletivo e técnico.
                    O maior momento de sua história aconteceu em 2011, quando
                    o Japão conquistou o título mundial pela primeira vez.
                </p>

            </div>


            <div class="grid items-center gap-16 md:grid-cols-2">

                <!-- IMAGEM E CONQUISTA -->

                <div>

                    <div class="relative">

                        <img
                            src="../img/futebol/mulheres.png"
                            alt="Partida de futebol feminino"
                            class="h-[320px] w-full object-cover shadow-xl md:h-[440px]"
                        >

                        <div class="absolute bottom-5 left-5 bg-[#c9272c] px-6 py-4 text-white">

                            <p class="font-['Playfair_Display'] text-3xl font-bold">
                                2011
                            </p>

                            <p class="text-xs font-bold uppercase tracking-widest">
                                Campeãs mundiais
                            </p>

                        </div>

                    </div>


                    <div class="mt-7 border border-[#e5ded2] bg-white p-7 shadow-sm">

                        <div class="flex items-center gap-4">

                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-[#fbe9e8] text-2xl text-[#c9272c]">
                                <i class="bi bi-trophy-fill"></i>
                            </div>

                            <div>

                                <p class="text-xs font-bold uppercase tracking-widest text-[#c9272c]">
                                    Conquista histórica
                                </p>

                                <h3 class="font-['Playfair_Display'] text-2xl font-semibold">
                                    Campeãs em 2011
                                </h3>

                            </div>

                        </div>

                        <p class="mt-5 leading-8 text-gray-600">
                            Na Alemanha, o Japão venceu os Estados Unidos na
                            decisão por pênaltis e conquistou seu primeiro
                            título da Copa do Mundo Feminina.
                        </p>

                    </div>

                </div>


                <!-- LINHA DO TEMPO FEMININA -->

                <div class="relative pl-10">

                    <div class="absolute bottom-0 left-[5px] top-2 w-px bg-[#d8cfc3]"></div>


                    <article class="relative mb-12">

                        <div class="absolute -left-[40px] top-1 h-3 w-3 rounded-full border-2 border-[#c9272c] bg-[#f8f5ef]"></div>

                        <p class="mb-2 font-['Playfair_Display'] text-3xl font-semibold text-[#c9272c]">
                            1991
                        </p>

                        <h3 class="mb-3 text-xl font-semibold">
                            Primeira Copa
                        </h3>

                        <p class="leading-7 text-gray-600">
                            O Japão participou da primeira edição da Copa do
                            Mundo Feminina, realizada na China.
                        </p>

                    </article>


                    <article class="relative mb-12">

                        <div class="absolute -left-[40px] top-1 h-3 w-3 rounded-full border-2 border-[#c9272c] bg-[#f8f5ef]"></div>

                        <p class="mb-2 font-['Playfair_Display'] text-3xl font-semibold text-[#c9272c]">
                            2011
                        </p>

                        <h3 class="mb-3 text-xl font-semibold">
                            O título mundial
                        </h3>

                        <p class="leading-7 text-gray-600">
                            A seleção conquistou o campeonato após superar
                            os Estados Unidos na disputa de pênaltis.
                        </p>

                    </article>


                    <article class="relative mb-12">

                        <div class="absolute -left-[40px] top-1 h-3 w-3 rounded-full border-2 border-[#c9272c] bg-[#f8f5ef]"></div>

                        <p class="mb-2 font-['Playfair_Display'] text-3xl font-semibold text-[#c9272c]">
                            2015
                        </p>

                        <h3 class="mb-3 text-xl font-semibold">
                            Vice-campeonato
                        </h3>

                        <p class="leading-7 text-gray-600">
                            O Japão chegou novamente à final, mas terminou
                            a competição como vice-campeão diante dos Estados Unidos.
                        </p>

                    </article>


                    <article class="relative">

                        <div class="absolute -left-[40px] top-1 h-3 w-3 rounded-full border-2 border-[#c9272c] bg-[#f8f5ef]"></div>

                        <p class="mb-2 font-['Playfair_Display'] text-3xl font-semibold text-[#c9272c]">
                            2023
                        </p>

                        <h3 class="mb-3 text-xl font-semibold">
                            Uma campanha marcante
                        </h3>

                        <p class="leading-7 text-gray-600">
                            A equipe chegou às quartas de final e chamou
                            atenção pelo futebol organizado e ofensivo.
                        </p>

                    </article>

                </div>

            </div>

        </div>
    </section>


    <!-- CULTURA JAPONESA -->
    <section id="cultura" class="scroll-mt-20 bg-[#071018] px-6 py-24 text-white md:px-10">

        <div class="mx-auto max-w-7xl">

            <div class="mb-16 text-center">

                <div class="mb-5 flex items-center justify-center gap-3">

                    <span class="h-px w-10 bg-[#c9272c]"></span>

                    <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-300">
                        Muito além do jogo
                    </p>

                    <span class="h-px w-10 bg-[#c9272c]"></span>

                </div>

                <h2 class="mb-6 font-['Playfair_Display'] text-4xl font-semibold md:text-5xl">
                    Futebol e cultura japonesa
                </h2>

                <p class="mx-auto max-w-2xl leading-8 text-gray-400">
                    O futebol no Japão também é uma forma de demonstrar respeito,
                    disciplina e união entre jogadores e torcedores.
                </p>

            </div>


            <!-- CARDS DE CULTURA -->

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">


                <!-- CARD 1 -->

                <article class="group border border-white/10 bg-white/[0.03] p-8 transition duration-300 hover:-translate-y-2 hover:border-[#c9272c] hover:bg-white/[0.06]">

                    <div class="mb-7 flex h-14 w-14 items-center justify-center rounded-full bg-[#c9272c]/15 text-2xl text-[#e05257] transition group-hover:bg-[#c9272c] group-hover:text-white">

                        <i class="bi bi-people-fill"></i>

                    </div>

                    <h3 class="mb-4 font-['Playfair_Display'] text-xl font-semibold">
                        Trabalho em equipe
                    </h3>

                    <p class="text-sm leading-7 text-gray-400">
                        A cooperação e a organização coletiva são valorizadas
                        dentro e fora de campo.
                    </p>

                </article>


                <!-- CARD 2 -->

                <article class="group border border-white/10 bg-white/[0.03] p-8 transition duration-300 hover:-translate-y-2 hover:border-[#c9272c] hover:bg-white/[0.06]">

                    <div class="mb-7 flex h-14 w-14 items-center justify-center rounded-full bg-[#c9272c]/15 text-2xl text-[#e05257] transition group-hover:bg-[#c9272c] group-hover:text-white">

                        <i class="bi bi-heart-fill"></i>

                    </div>

                    <h3 class="mb-4 font-['Playfair_Display'] text-xl font-semibold">
                        Respeito
                    </h3>

                    <p class="text-sm leading-7 text-gray-400">
                        O respeito aos adversários, aos árbitros e aos torcedores
                        faz parte da cultura esportiva.
                    </p>

                </article>


                <!-- CARD 3 -->

                <article class="group border border-white/10 bg-white/[0.03] p-8 transition duration-300 hover:-translate-y-2 hover:border-[#c9272c] hover:bg-white/[0.06]">

                    <div class="mb-7 flex h-14 w-14 items-center justify-center rounded-full bg-[#c9272c]/15 text-2xl text-[#e05257] transition group-hover:bg-[#c9272c] group-hover:text-white">

                        <i class="bi bi-stars"></i>

                    </div>

                    <h3 class="mb-4 font-['Playfair_Display'] text-xl font-semibold">
                        Disciplina
                    </h3>

                    <p class="text-sm leading-7 text-gray-400">
                        Treinamento, dedicação e preparação são importantes
                        para o desenvolvimento dos atletas.
                    </p>

                </article>


                <!-- CARD 4 -->

                <article class="group border border-white/10 bg-white/[0.03] p-8 transition duration-300 hover:-translate-y-2 hover:border-[#c9272c] hover:bg-white/[0.06]">

                    <div class="mb-7 flex h-14 w-14 items-center justify-center rounded-full bg-[#c9272c]/15 text-2xl text-[#e05257] transition group-hover:bg-[#c9272c] group-hover:text-white">

                        <i class="bi bi-flag-fill"></i>

                    </div>

                    <h3 class="mb-4 font-['Playfair_Display'] text-xl font-semibold">
                        Paixão nacional
                    </h3>

                    <p class="text-sm leading-7 text-gray-400">
                        As seleções reúnem torcedores e representam o país
                        nas competições internacionais.
                    </p>

                </article>

            </div>


            <!-- DESTAQUE FINAL -->

            <div class="relative mt-16 overflow-hidden border border-white/10 md:flex">

                <img
                    src="https://images.unsplash.com/photo-1522778119026-d647f0596c20?auto=format&fit=crop&w=1200&q=85"
                    alt="Estádio preparado para uma partida"
                    class="h-64 w-full object-cover md:h-auto md:w-1/2"
                >

                <div class="relative flex flex-col justify-center bg-[#0d1d2b] p-9 md:w-1/2 md:p-14">

                    <div class="pointer-events-none absolute right-5 top-0 select-none font-['Playfair_Display'] text-8xl font-bold text-white/[0.03]">
                        日
                    </div>

                    <div class="mb-5 flex items-center gap-3">

                        <span class="h-px w-10 bg-[#c9272c]"></span>

                        <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-300">
                            Espírito esportivo
                        </p>

                    </div>

                    <h3 class="mb-6 font-['Playfair_Display'] text-3xl font-semibold leading-tight md:text-4xl">
                        Uma paixão que conecta pessoas
                    </h3>

                    <p class="leading-8 text-gray-400">
                        Seja no futebol masculino ou feminino, o Japão continua
                        ampliando sua presença no cenário internacional e
                        inspirando novas gerações de atletas.
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