<?php

require_once __DIR__ . '/../../database/conexao.php';

include_once __DIR__ . '/../templates/header.php';

$imagensPadrao = [
    'futebol_banner' => 'assets/img/futebol/banner.png',
    'futebol_mulheres' => 'assets/img/futebol/mulheres.png'
];

$imagensSite = $imagensPadrao;

if (isset($conn) && $conn instanceof mysqli) {
    $resultado = $conn->query(
        "SELECT chave, caminho FROM imagens_site"
    );

    if ($resultado) {
        while ($imagem = $resultado->fetch_assoc()) {
            $chave = $imagem['chave'];
            $caminho = trim($imagem['caminho']);

            if (isset($imagensPadrao[$chave]) && $caminho !== '') {
                $imagensSite[$chave] = $caminho;
            }
        }

        $resultado->free();
    }
}

function imagemFutebol(string $chave): string
{
    global $imagensSite;

    return '../../' . ltrim(
        $imagensSite[$chave] ?? '',
        '/'
    );
}

?>


<style>
    .jfa-page {
        --jfa-blue: #071a2b;
        --jfa-blue-2: #0d304b;
        --jfa-red: #c72b30;
        --jfa-red-light: #ee6b6e;
        --jfa-cream: #f5f2eb;
        background: var(--jfa-cream);
        color: var(--jfa-blue);
        overflow: hidden;
    }

    .jfa-page .jfa-hero {
        background:
            linear-gradient(110deg, rgba(3, 13, 23, .98) 0%, rgba(3, 13, 23, .84) 43%, rgba(3, 13, 23, .15) 100%),
            url('<?= htmlspecialchars(imagemFutebol('futebol_banner')) ?>') center / cover;
    }

    .jfa-page .jfa-red-line {
        background: linear-gradient(90deg, var(--jfa-red), var(--jfa-red-light), transparent);
    }

    .jfa-page .jfa-glass {
        background: rgba(5, 20, 34, .72);
        border: 1px solid rgba(255,255,255,.13);
        box-shadow: 0 25px 70px -35px rgba(0,0,0,.8);
        backdrop-filter: blur(14px);
    }

    .jfa-page .jfa-paper-grid {
        background-color: var(--jfa-cream);
        background-image: linear-gradient(90deg, rgba(7,26,43,.07) 1px, transparent 1px);
        background-size: 72px 100%;
    }

    .jfa-page .jfa-field {
        position: relative;
        background:
            linear-gradient(90deg, transparent 49.8%, rgba(255,255,255,.24) 50%, transparent 50.2%),
            radial-gradient(circle at center, transparent 0 4.2rem, rgba(255,255,255,.24) 4.25rem 4.35rem, transparent 4.4rem),
            repeating-linear-gradient(90deg, #123f42 0, #123f42 10%, #154748 10%, #154748 20%);
        box-shadow: inset 0 0 0 1px rgba(255,255,255,.2), 0 25px 65px -35px rgba(0,0,0,.7);
    }

    .jfa-page .jfa-field::before,
    .jfa-page .jfa-field::after {
        position: absolute;
        top: 12%;
        bottom: 12%;
        width: 20%;
        border: 1px solid rgba(255,255,255,.22);
        content: '';
    }

    .jfa-page .jfa-field::before { left: -1px; }
    .jfa-page .jfa-field::after { right: -1px; }

    .jfa-page .jfa-photo {
        filter: saturate(.8);
        transition: filter .5s ease;
    }

    .jfa-page .overflow-hidden:hover .jfa-photo {
        filter: saturate(1.1) contrast(1.08);
    }

    .jfa-page .jfa-stamp {
        border-left: 3px solid var(--jfa-red-light);
        padding-left: .8rem;
        color: var(--jfa-red-light);
        text-align: left;
    }

    .jfa-page .jfa-match-row {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        gap: 1rem;
        border-bottom: 1px solid rgba(255,255,255,.12);
        padding: 1rem 0;
    }

    .jfa-page .jfa-match-row:last-child {
        border-bottom: 0;
    }

    @media (prefers-reduced-motion: reduce) {
        .jfa-page .jfa-photo { transition: none; }
    }
</style>

<main class="jfa-page font-['Poppins']">

    <!-- ABERTURA / MATCHDAY -->
    <section id="inicio" class="jfa-hero relative isolate min-h-[720px] overflow-hidden text-white md:min-h-[810px]">
        <div class="relative mx-auto flex min-h-[720px] max-w-7xl flex-col justify-between px-6 pb-10 pt-28 md:min-h-[810px] md:px-10 md:pb-14">
            <div class="relative z-10 flex items-start justify-between gap-6">
                <div>
                    <p class="tabular-nums tracking-[.12em] text-[10px] font-bold uppercase text-white/55">Japan Football Association</p>
                    <p class="mt-2 text-sm text-white/80">日本サッカー · 夢を力に</p>
                </div>
                <div class="jfa-stamp hidden text-[10px] font-bold uppercase tracking-[.2em] md:block">
                    <span class="block text-white/45">LIVE / 90:00</span>
                    <span class="mt-1 block text-2xl leading-none">JFA 01</span>
                </div>
            </div>

            <div class="relative z-10 grid items-end gap-12 lg:grid-cols-[1fr_auto]">
                <div class="max-w-3xl">
                    <div class="mb-6 flex items-center gap-3">
                        <span class="h-px w-14 bg-[#c72b30]"></span>
                        <p class="tabular-nums tracking-[.12em] text-[10px] font-bold uppercase text-[#ee6b6e]">Matchday · Tokyo to the world</p>
                    </div>
                    <h1 class="font-['Playfair_Display'] tracking-[-.055em] text-6xl font-semibold leading-[.9] sm:text-7xl md:text-9xl">
                        O jogo<br>
                        <span class="text-[#ee6b6e]">começa aqui.</span>
                    </h1>
                    <p class="mt-8 max-w-xl text-sm leading-8 text-white/65 md:text-base">
                        Uma viagem pela força, pela técnica e pelo espírito que
                        fazem o futebol japonês jogar de igual para igual com o mundo.
                    </p>
                    <div class="mt-9 flex flex-wrap gap-3">
                        <a href="#samurai-blue" class="inline-flex items-center gap-3 bg-[#c72b30] px-6 py-4 text-[10px] font-bold uppercase tracking-[.2em] transition hover:-translate-y-1 hover:bg-[#a51f25]">
                            Entrar em campo <i class="bi bi-arrow-down-right"></i>
                        </a>
                        <a href="#jfa-map" class="inline-flex items-center gap-3 border border-white/30 px-6 py-4 text-[10px] font-bold uppercase tracking-[.2em] transition hover:border-white hover:bg-white/10">
                            Ver a jornada <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="jfa-glass relative z-10 hidden w-72 p-5 lg:block">
                    <div class="mb-6 flex items-center justify-between border-b border-white/15 pb-4">
                        <span class="tabular-nums tracking-[.12em] text-[9px] font-bold text-white/50">NEXT FIXTURE</span>
                        <span class="h-2 w-2 rounded-full bg-[#ee6b6e] shadow-[0_0_14px_#ee6b6e]"></span>
                    </div>
                    <p class="tabular-nums tracking-[.12em] text-xs text-white/50">MATCH REPORT / 2022</p>
                    <p class="font-['Playfair_Display'] tracking-[-.055em] mt-2 text-3xl">A noite das viradas</p>
                    <div class="mt-5">
                        <div class="jfa-match-row"><span>JAPÃO</span><strong class="text-[#ee6b6e]">2</strong><span class="text-right text-white/45">ALEMANHA</span></div>
                        <div class="jfa-match-row"><span>JAPÃO</span><strong class="text-[#ee6b6e]">2</strong><span class="text-right text-white/45">ESPANHA</span></div>
                    </div>
                    <p class="tabular-nums tracking-[.12em] mt-5 text-[9px] text-white/45">DISCIPLINA · VELOCIDADE · UNIÃO</p>
                </div>
            </div>
        </div>
        <div class="jfa-red-line absolute bottom-0 left-0 h-1 w-full"></div>
    </section>

    <!-- PLACAR DA IDENTIDADE -->
    <section class="bg-[#071a2b] text-white">
        <div class="mx-auto grid max-w-7xl divide-y divide-white/10 px-6 md:grid-cols-4 md:divide-x md:divide-y-0 md:px-10">
            <div class="flex items-center gap-4 py-6 md:px-7 md:first:pl-0">
                <span class="text-3xl text-[#ee6b6e]"><i class="bi bi-calendar3"></i></span>
                <div><p class="font-['Playfair_Display'] tracking-[-.055em] text-3xl">1993</p><p class="tabular-nums tracking-[.12em] text-[9px] text-white/45">J.LEAGUE</p></div>
            </div>
            <div class="flex items-center gap-4 py-6 md:px-7">
                <span class="text-3xl text-[#ee6b6e]"><i class="bi bi-trophy"></i></span>
                <div><p class="font-['Playfair_Display'] tracking-[-.055em] text-3xl">2011</p><p class="tabular-nums tracking-[.12em] text-[9px] text-white/45">WORLD CHAMPIONS</p></div>
            </div>
            <div class="flex items-center gap-4 py-6 md:px-7">
                <span class="text-3xl text-[#ee6b6e]"><i class="bi bi-globe2"></i></span>
                <div><p class="font-['Playfair_Display'] tracking-[-.055em] text-3xl">Asia</p><p class="tabular-nums tracking-[.12em] text-[9px] text-white/45">A CASA DO JOGO</p></div>
            </div>
            <div class="flex items-center gap-4 py-6 md:px-7 md:last:pr-0">
                <span class="text-3xl text-[#ee6b6e]"><i class="bi bi-people"></i></span>
                <div><p class="font-['Playfair_Display'] tracking-[-.055em] text-3xl">∞</p><p class="tabular-nums tracking-[.12em] text-[9px] text-white/45">NOVAS GERAÇÕES</p></div>
            </div>
        </div>
    </section>

    <!-- SAMURAI BLUE -->
    <section id="samurai-blue" class="jfa-paper-grid px-6 py-24 md:px-10 md:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="mb-14 flex flex-wrap items-end justify-between gap-8">
                <div class="max-w-2xl">
                    <p class="tabular-nums tracking-[.12em] text-[10px] font-bold text-[#c72b30]">01 / SELEÇÃO MASCULINA</p>
                    <h2 class="font-['Playfair_Display'] tracking-[-.055em] mt-4 text-5xl font-semibold leading-none md:text-7xl">Samurai<br><span class="text-[#c72b30]">Blue.</span></h2>
                </div>
                <p class="max-w-sm text-sm leading-7 text-[#52606c]">
                    O azul da camisa, a precisão da técnica e a coragem de
                    enfrentar qualquer adversário. Uma seleção em constante evolução.
                </p>
            </div>

            <div class="grid gap-8 lg:grid-cols-[1.15fr_.85fr]">
                <div class="overflow-hidden relative min-h-[430px] bg-[#0d304b]">
                    <img src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=1400&q=85" alt="Jogadores disputando uma partida de futebol" class="jfa-photo absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#071a2b] via-transparent to-transparent"></div>
                    <div class="absolute bottom-7 left-7 right-7 flex items-end justify-between text-white">
                        <div>
                            <p class="tabular-nums tracking-[.12em] text-[9px] text-white/55">THE BLUE LOCKER ROOM</p>
                            <p class="font-['Playfair_Display'] tracking-[-.055em] mt-2 text-3xl">Jogar juntos.</p>
                        </div>
                        <i class="bi bi-arrow-up-right text-2xl text-[#ee6b6e]"></i>
                    </div>
                </div>

                <div class="flex flex-col justify-between bg-[#071a2b] p-8 text-white md:p-10">
                    <div>
                        <p class="tabular-nums tracking-[.12em] text-[10px] text-[#ee6b6e]">A EVOLUÇÃO EM QUATRO TEMPOS</p>
                        <div class="mt-8 space-y-7">
                            <div class="flex gap-5">
                                <span class="font-['Playfair_Display'] tracking-[-.055em] text-3xl text-[#ee6b6e]">98</span>
                                <div><h3 class="font-semibold">A primeira presença</h3><p class="mt-1 text-sm leading-6 text-white/50">O Japão estreia na Copa e começa a escrever sua história.</p></div>
                            </div>
                            <div class="flex gap-5">
                                <span class="font-['Playfair_Display'] tracking-[-.055em] text-3xl text-[#ee6b6e]">02</span>
                                <div><h3 class="font-semibold">O jogo em casa</h3><p class="mt-1 text-sm leading-6 text-white/50">Oitavas de final e uma torcida que descobre sua voz.</p></div>
                            </div>
                            <div class="flex gap-5">
                                <span class="font-['Playfair_Display'] tracking-[-.055em] text-3xl text-[#ee6b6e]">22</span>
                                <div><h3 class="font-semibold">Vitórias gigantes</h3><p class="mt-1 text-sm leading-6 text-white/50">Alemanha e Espanha ficam pelo caminho no Catar.</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 border-t border-white/10 pt-5">
                        <span class="tabular-nums tracking-[.12em] text-[9px] text-white/40">BLUE SAMURAI · サムライブルー</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JOGO EM CAMPO -->
    <section id="jfa-map" class="bg-[#0d304b] px-6 py-24 text-white md:px-10 md:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-14 lg:grid-cols-[.8fr_1.2fr] lg:items-center">
                <div>
                    <p class="tabular-nums tracking-[.12em] text-[10px] font-bold text-[#ee6b6e]">02 / O DNA DO JOGO</p>
                    <h2 class="font-['Playfair_Display'] tracking-[-.055em] mt-4 text-5xl font-semibold leading-none md:text-7xl">Tática com<br><span class="text-[#ee6b6e]">propósito.</span></h2>
                    <p class="mt-7 max-w-md text-sm leading-8 text-white/55">
                        O futebol japonês une preparação minuciosa e liberdade
                        criativa. Cada passe tem uma intenção; cada movimento,
                        uma responsabilidade com o coletivo.
                    </p>
                    <div class="mt-9 flex gap-8 border-t border-white/15 pt-6">
                        <div><p class="font-['Playfair_Display'] tracking-[-.055em] text-4xl text-[#ee6b6e]">3</p><p class="tabular-nums tracking-[.12em] text-[9px] text-white/45">PILARES</p></div>
                        <div><p class="font-['Playfair_Display'] tracking-[-.055em] text-4xl text-[#ee6b6e]">11</p><p class="tabular-nums tracking-[.12em] text-[9px] text-white/45">EM CAMPO</p></div>
                        <div><p class="font-['Playfair_Display'] tracking-[-.055em] text-4xl text-[#ee6b6e]">1</p><p class="tabular-nums tracking-[.12em] text-[9px] text-white/45">PROPÓSITO</p></div>
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="jfa-field min-h-[300px] p-5 sm:col-span-2">
                        <div class="absolute left-[22%] top-1/2 -translate-y-1/2 text-4xl text-[#ee6b6e]"><i class="bi bi-circle-fill"></i></div>
                        <div class="absolute right-[20%] top-1/3 text-3xl text-white"><i class="bi bi-circle-fill"></i></div>
                        <span class="absolute bottom-4 left-5 tabular-nums tracking-[.12em] text-[9px] text-white/60">CAMPO · 105 × 68</span>
                    </div>
                    <article class="border border-white/10 bg-white/5 p-6">
                        <i class="bi bi-diagram-3 text-2xl text-[#ee6b6e]"></i>
                        <h3 class="mt-5 font-semibold">Leitura coletiva</h3>
                        <p class="mt-2 text-sm leading-6 text-white/50">O espaço é ocupado com inteligência e confiança.</p>
                    </article>
                    <article class="border border-white/10 bg-white/5 p-6">
                        <i class="bi bi-lightning-charge text-2xl text-[#ee6b6e]"></i>
                        <h3 class="mt-5 font-semibold">Transição veloz</h3>
                        <p class="mt-2 text-sm leading-6 text-white/50">Recuperar, acelerar, surpreender.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <!-- NADESHIKO -->
    <section class="jfa-paper-grid px-6 py-24 md:px-10 md:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-12 lg:grid-cols-[.9fr_1.1fr] lg:items-center">
                <div class="order-2 lg:order-1">
                    <p class="tabular-nums tracking-[.12em] text-[10px] font-bold text-[#c72b30]">03 / SELEÇÃO FEMININA</p>
                    <h2 class="font-['Playfair_Display'] tracking-[-.055em] mt-4 text-5xl font-semibold leading-none md:text-7xl">Nadeshiko<br><span class="text-[#c72b30]">Japan.</span></h2>
                    <p class="mt-7 max-w-lg text-sm leading-8 text-[#52606c]">
                        Flores de cravo, futebol de posse e uma conquista que
                        mudou a história: em 2011, o Japão se tornou campeão
                        mundial feminino pela primeira vez.
                    </p>
                    <div class="mt-9 flex items-center gap-5">
                        <span class="flex h-16 w-16 items-center justify-center rounded-full bg-[#c72b30] text-2xl text-white"><i class="bi bi-trophy-fill"></i></span>
                        <div><p class="font-['Playfair_Display'] tracking-[-.055em] text-3xl">2011</p><p class="tabular-nums tracking-[.12em] text-[9px] text-[#c72b30]">CAMPEÃS DO MUNDO</p></div>
                    </div>
                </div>
                <div class="overflow-hidden order-1 relative h-[430px] bg-[#d8cfc3] lg:order-2">
<img src="<?= htmlspecialchars(imagemFutebol('futebol_mulheres')) ?>" alt="Jogadoras japonesas em uma partida de futebol" class="jfa-photo h-full w-full object-cover">                    <div class="absolute left-5 top-5 bg-[#f5f2eb] px-4 py-3 text-[#071a2b] shadow-lg">
                        <p class="tabular-nums tracking-[.12em] text-[9px] font-bold">NADESHIKO</p>
                        <p class="text-xs text-[#52606c]">撫子 · força delicada</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CULTURA DE ARQUIBANCADA -->
    <section class="bg-[#071a2b] px-6 py-24 text-white md:px-10 md:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-12 lg:grid-cols-[.75fr_1.25fr]">
                <div>
                    <p class="tabular-nums tracking-[.12em] text-[10px] font-bold text-[#ee6b6e]">04 / FORA DAS QUATRO LINHAS</p>
                    <h2 class="font-['Playfair_Display'] tracking-[-.055em] mt-4 text-5xl font-semibold leading-none md:text-7xl">O jogo<br><span class="text-[#ee6b6e]">é de todos.</span></h2>
                    <p class="mt-7 max-w-sm text-sm leading-8 text-white/55">No Japão, a partida continua depois do apito final. Respeito, comunidade e paixão fazem parte do espetáculo.</p>
                </div>
                <div class="grid gap-4 sm:grid-cols-3">
                    <article class="border border-white/10 p-6 transition hover:border-[#ee6b6e] hover:bg-white/5">
                        <i class="bi bi-stars text-2xl text-[#ee6b6e]"></i>
                        <h3 class="mt-10 font-semibold">Respeito</h3>
                        <p class="mt-3 text-sm leading-6 text-white/45">Torcida e jogadores cuidam do espaço que compartilham.</p>
                    </article>
                    <article class="border border-white/10 p-6 transition hover:border-[#ee6b6e] hover:bg-white/5">
                        <i class="bi bi-people text-2xl text-[#ee6b6e]"></i>
                        <h3 class="mt-10 font-semibold">Comunidade</h3>
                        <p class="mt-3 text-sm leading-6 text-white/45">Clubes conectam bairros, cidades e gerações.</p>
                    </article>
                    <article class="border border-white/10 p-6 transition hover:border-[#ee6b6e] hover:bg-white/5">
                        <i class="bi bi-heart text-2xl text-[#ee6b6e]"></i>
                        <h3 class="mt-10 font-semibold">Paixão</h3>
                        <p class="mt-3 text-sm leading-6 text-white/45">Cada camisa carrega uma história para cantar.</p>
                    </article>
                </div>
            </div>

            <div class="mt-20 border-t border-white/10 pt-8 md:flex md:items-end md:justify-between">
                <div>
                    <p class="tabular-nums tracking-[.12em] text-[10px] text-white/40">A PRÓXIMA GERAÇÃO JÁ ESTÁ EM CAMPO</p>
                    <p class="font-['Playfair_Display'] tracking-[-.055em] mt-3 max-w-2xl text-4xl md:text-6xl">Do Japão para o mundo.</p>
                </div>
                <a href="#inicio" class="mt-7 inline-flex items-center gap-3 text-[10px] font-bold uppercase tracking-[.2em] text-[#ee6b6e] transition hover:text-white md:mt-0">
                    Voltar ao topo <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>
        </div>
    </section>
</main>

<?php include '../../assets/templates/footer.php'; ?>