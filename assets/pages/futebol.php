<?php

require_once __DIR__ . '/../../database/conexao.php';

if (!function_exists('e')) {
    function e(string $texto): string
    {
        return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    }
}

$imagensPadrao = [
    'futebol_banner' => 'assets/img/futebol/banner.png',
    'futebol_mulheres' => 'assets/img/futebol/mulheres.png'
];

$imagensSite = $imagensPadrao;

if (isset($conn) && $conn instanceof mysqli) {
    $resultado = $conn->query("SELECT chave, caminho FROM imagens_site");

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

    return '../../' . ltrim($imagensSite[$chave] ?? '', '/');
}

// Placares que marcaram a história
$placares = [
    ['comp' => 'Copa do Mundo 2022 · Grupo E', 'casa' => 'JPN', 'a' => '2', 'fora' => 'GER', 'b' => '1', 'extra' => '', 'gols' => 'Dōan 75′ · Asano 83′', 'nota' => 'Virada sobre a Alemanha, depois de sair atrás.'],
    ['comp' => 'Copa do Mundo 2022 · Grupo E', 'casa' => 'JPN', 'a' => '2', 'fora' => 'ESP', 'b' => '1', 'extra' => '', 'gols' => 'Dōan 48′ · Tanaka 51′', 'nota' => 'Outra virada. O Japão terminou o grupo em primeiro.'],
    ['comp' => 'Copa Feminina 2011 · Final', 'casa' => 'JPN', 'a' => '2', 'fora' => 'USA', 'b' => '2', 'extra' => 'PEN 3 : 1', 'gols' => 'Miyama 81′ · Sawa 117′', 'nota' => 'Título nos pênaltis: o primeiro mundial do Japão.'],
];

// Campanhas da Nadeshiko Japan em Copas do Mundo
$campanhas = [
    ['1991', 'China', 'Estreia em Copas', false],
    ['2011', 'Alemanha', 'Campeãs do mundo', true],
    ['2015', 'Canadá', 'Vice-campeãs', false],
    ['2019', 'França', 'Oitavas de final', false],
    ['2023', 'Austrália e N. Zelândia', 'Quartas de final', false],
];

include_once __DIR__ . '/../templates/header.php';
?>

<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,600;0,800;1,800&family=Barlow:wght@400;500;600&family=DotGothic16&display=swap" rel="stylesheet">

<style>
    .fb-body { font-family: 'Barlow', system-ui, sans-serif; }
    .fb-disp { font-family: 'Barlow Condensed', 'Arial Narrow', sans-serif; font-style: italic; font-weight: 800; text-transform: uppercase; line-height: .9; }
    .fb-cut { clip-path: polygon(0 0, 100% 0, calc(100% - 14px) 100%, 0 100%); }
    .fb-gramado { background: repeating-linear-gradient(90deg, #0f5a35 0 64px, #127040 64px 128px); }
    .fb-camisa text { font-family: 'Barlow Condensed', sans-serif; font-style: italic; font-weight: 800; fill: #fff; }

    /* Painel LED dos estádios */
    .fb-led {
        position: relative;
        font-family: 'DotGothic16', 'Noto Sans JP', monospace;
        color: #ffb020;
        text-shadow: 0 0 14px rgba(255, 176, 32, .55);
    }
    .fb-led::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle, transparent 0 .9px, rgba(12, 16, 23, .9) 1.3px) 0 0 / 4px 4px;
        pointer-events: none;
    }

    /* Prancheta */
    .fb-chip {
        border: 2px solid #0b2f9f;
        background: #fff;
        padding: .5rem 1.15rem;
        color: #0b2f9f;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 1.2rem;
        font-style: italic;
        font-weight: 800;
        letter-spacing: .04em;
        text-transform: uppercase;
        clip-path: polygon(0 0, 100% 0, calc(100% - 10px) 100%, 0 100%);
        transition: background .25s, color .25s;
    }
    .fb-chip[aria-pressed="true"] { background: #0b2f9f; color: #fff; }
    .fb-chip:focus-visible { box-shadow: inset 0 0 0 3px #c72b30; outline: none; }

    .fb-ima { transition: transform .8s cubic-bezier(.3, .9, .3, 1); filter: drop-shadow(0 3px 2px rgba(0, 0, 0, .3)); }
    .fb-ima text { font-family: 'Barlow Condensed', sans-serif; font-style: italic; font-weight: 800; }
    .sem-trans .fb-ima { transition: none; }
    .fb-seta { stroke: #c72b30; stroke-width: 2.5; stroke-dasharray: 6 5; animation: fb-some 1.6s forwards; }
    @keyframes fb-some { 0%, 55% { opacity: .95; } 100% { opacity: 0; } }

    @media (prefers-reduced-motion: reduce) { .fb-ima, .fb-chip { transition: none; } }
</style>

<main class="fb-body bg-[#f2f4ef] text-[#071a52]">

    <!-- ABERTURA -->
    <section id="inicio" class="relative isolate overflow-hidden text-white">

        <div class="absolute inset-0 -z-20 bg-cover bg-center" style="background-image: url('<?= e(imagemFutebol('futebol_banner')) ?>');"></div>
        <div class="absolute inset-0 -z-10" style="background: linear-gradient(105deg, rgba(5,15,51,.96), rgba(5,15,51,.72) 52%, rgba(5,15,51,.25));"></div>

        <div class="mx-auto grid min-h-[700px] max-w-7xl items-center gap-10 px-6 pb-28 pt-12 md:min-h-[780px] md:px-10 lg:grid-cols-[1.25fr_.75fr]">

            <div>

                <!-- Selo da transmissão -->
                <div class="inline-flex items-stretch text-xs font-semibold uppercase tracking-[.2em]">
                    <span class="bg-[#c72b30] px-3 py-2">Ao vivo</span>
                    <span class="bg-black/70 px-4 py-2">JFA · <span id="fb-relogio" class="tabular-nums">0′</span></span>
                </div>

                <h1 class="fb-disp mt-8 text-7xl sm:text-8xl md:text-[9.5rem]">
                    <span class="block">O jogo</span>
                    <span class="mt-2 inline-block -skew-x-6 bg-[#c72b30] px-5 py-2">
                        <span class="inline-block skew-x-6">começa aqui.</span>
                    </span>
                </h1>

                <p class="mt-9 max-w-xl text-base leading-8 text-white/75">
                    Uma viagem pela força, pela técnica e pelo espírito que
                    fazem o futebol japonês jogar de igual para igual com o mundo.
                </p>

                <div class="mt-9 flex flex-wrap gap-3">
                    <a href="#prancheta" class="fb-cut inline-flex items-center gap-3 bg-[#c72b30] py-4 pl-7 pr-10 text-sm font-semibold uppercase tracking-[.18em] transition hover:bg-white hover:text-[#c72b30]">
                        Entrar em campo <i class="bi bi-arrow-down-right"></i>
                    </a>
                    <a href="#placares" class="fb-cut inline-flex items-center gap-3 border border-white/30 py-4 pl-7 pr-10 text-sm font-semibold uppercase tracking-[.18em] transition hover:bg-white/10">
                        Ver os placares
                    </a>
                </div>

            </div>

            <!-- Camisa -->
            <div class="hidden justify-center lg:flex">
                <svg viewBox="0 0 240 270" class="fb-camisa w-80 -rotate-6 drop-shadow-2xl" aria-hidden="true">
                    <path d="M82 12 L52 26 L8 66 L38 100 L58 84 L58 262 L182 262 L182 84 L202 100 L232 66 L188 26 L158 12 Q120 44 82 12Z" fill="#0b2f9f" />
                    <path d="M82 12 Q120 44 158 12" fill="none" stroke="#c72b30" stroke-width="7" />
                    <path d="M8 66 L38 100 M232 66 L202 100" stroke="#c72b30" stroke-width="7" />
                    <text x="120" y="82" text-anchor="middle" font-size="22" letter-spacing="4">NIPPON</text>
                    <text x="120" y="192" text-anchor="middle" font-size="120">11</text>
                    <circle cx="120" cy="230" r="7" fill="#c72b30" />
                </svg>
            </div>

        </div>

        <!-- Gramado -->
        <div class="fb-gramado absolute inset-x-0 bottom-0 h-14 border-t-4 border-white/80"></div>

    </section>


    <!-- PRANCHETA -->
    <section id="prancheta" class="bg-[#e9efe7] px-6 py-24 md:px-10 md:py-28">

        <div class="mx-auto grid max-w-7xl gap-14 lg:grid-cols-[1fr_.9fr] lg:items-center">

            <div>

                <p class="text-xs font-semibold uppercase tracking-[.3em] text-[#c72b30]">01 / Prancheta</p>

                <h2 class="fb-disp mt-4 text-6xl md:text-8xl">
                    Monte o time.<br><span class="text-[#c72b30]">Mude o jogo.</span>
                </h2>

                <p class="mt-7 max-w-lg text-base leading-8 text-[#071a52]/70">
                    O técnico pensa o jogo em linhas. Troque o desenho tático e a
                    fase da partida e veja os onze jogadores se reorganizarem em
                    campo. As setas vermelhas mostram quem se mexeu.
                </p>

                <p class="mt-8 text-xs font-semibold uppercase tracking-[.25em] text-[#071a52]/55">Desenho tático</p>
                <div id="fb-formacoes" role="group" aria-label="Desenho tático" class="mt-3 flex flex-wrap gap-3">
                    <button type="button" class="fb-chip" data-formacao="4-2-3-1" aria-pressed="true">4-2-3-1</button>
                    <button type="button" class="fb-chip" data-formacao="4-3-3" aria-pressed="false">4-3-3</button>
                    <button type="button" class="fb-chip" data-formacao="3-4-2-1" aria-pressed="false">3-4-2-1</button>
                    <button type="button" class="fb-chip" data-formacao="4-4-2" aria-pressed="false">4-4-2</button>
                </div>

                <p class="mt-6 text-xs font-semibold uppercase tracking-[.25em] text-[#071a52]/55">Fase do jogo</p>
                <div id="fb-fases" role="group" aria-label="Fase do jogo" class="mt-3 flex flex-wrap gap-3">
                    <button type="button" class="fb-chip" data-fase="defender" aria-pressed="false">Defender</button>
                    <button type="button" class="fb-chip" data-fase="construir" aria-pressed="true">Construir</button>
                    <button type="button" class="fb-chip" data-fase="atacar" aria-pressed="false">Atacar</button>
                </div>

                <div class="mt-9 border-l-4 border-[#c72b30] bg-white p-6" aria-live="polite">
                    <div class="flex items-end justify-between gap-4">
                        <p id="fb-nome" class="fb-disp text-6xl text-[#0b2f9f]">4-2-3-1</p>
                        <p class="text-right text-xs font-semibold uppercase tracking-[.2em] text-[#071a52]/55">
                            Bloco<br><span id="fb-bloco" class="fb-disp text-3xl text-[#c72b30]">0 m</span>
                        </p>
                    </div>
                    <p id="fb-desc" class="mt-4 text-sm leading-7 text-[#071a52]/75"></p>
                    <p id="fb-fase-txt" class="mt-2 text-sm font-semibold leading-7"></p>
                </div>

                <p class="mt-4 text-xs leading-6 text-[#071a52]/50">
                    Posições ilustrativas, não são uma escalação real. O bloco é a
                    distância entre a linha mais recuada e a mais avançada: quanto
                    menor, mais compacto o time.
                </p>

            </div>

            <!-- Quadro branco -->
            <div class="mx-auto w-full max-w-[26rem]">

                <div class="rounded-md bg-gradient-to-b from-[#dfe3e6] to-[#9aa1a6] p-3 shadow-[0_40px_70px_-35px_rgba(5,15,51,.8)]">

                    <div class="relative overflow-hidden rounded-sm bg-[#fbfcfa]">

                        <svg id="fb-campo" viewBox="0 0 360 545" class="block w-full" role="img" aria-label="Campo de futebol com os onze jogadores posicionados">
                            <defs>
                                <marker id="fb-ponta" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="5" markerHeight="5" orient="auto">
                                    <path d="M0 0 L10 5 L0 10z" fill="#c72b30" />
                                </marker>
                            </defs>

                            <g fill="none" stroke="#2b3a55" stroke-width="2.5" stroke-linecap="round">
                                <rect x="10" y="10" width="340" height="525" />
                                <line x1="10" y1="272.5" x2="350" y2="272.5" />
                                <circle cx="180" cy="272.5" r="45.75" />
                                <rect x="79" y="10" width="202" height="82.5" />
                                <rect x="134" y="10" width="92" height="27.5" />
                                <rect x="79" y="452.5" width="202" height="82.5" />
                                <rect x="134" y="507.5" width="92" height="27.5" />
                                <path d="M143.4 92.5 A45.75 45.75 0 0 0 216.6 92.5" />
                                <path d="M143.4 452.5 A45.75 45.75 0 0 1 216.6 452.5" />
                                <rect x="155" y="2" width="50" height="8" />
                                <rect x="155" y="535" width="50" height="8" />
                            </g>

                            <g fill="#2b3a55">
                                <circle cx="180" cy="272.5" r="3" />
                                <circle cx="180" cy="65" r="3" />
                                <circle cx="180" cy="480" r="3" />
                            </g>

                            <g id="fb-setas" fill="none"></g>
                            <g id="fb-time"></g>
                        </svg>

                        <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(120deg,transparent_38%,rgba(255,255,255,.65)_50%,transparent_62%)]"></div>

                    </div>

                </div>

                <!-- Bandeja com marcadores -->
                <div class="mx-auto flex h-3 w-[78%] items-start justify-center gap-3 rounded-b bg-gradient-to-b from-[#aab0b5] to-[#7f868b]" aria-hidden="true">
                    <span class="-mt-2 block h-2 w-10 rounded-sm bg-[#0b2f9f]"></span>
                    <span class="-mt-2 block h-2 w-10 rounded-sm bg-[#c72b30]"></span>
                    <span class="-mt-2 block h-2 w-10 rounded-sm bg-[#1b2a4a]"></span>
                </div>

            </div>

        </div>

    </section>


    <!-- PLACARES -->
    <section id="placares" class="bg-[#06080c] px-6 py-24 text-white md:px-10 md:py-28">

        <div class="mx-auto max-w-7xl">

            <div class="mb-14 max-w-2xl">
                <p class="text-xs font-semibold uppercase tracking-[.3em] text-[#ffb020]">02 / Placares que ficaram</p>
                <h2 class="fb-disp mt-4 text-6xl md:text-8xl">Três jogos,<br><span class="text-[#ffb020]">mil histórias.</span></h2>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">

                <?php foreach ($placares as $p): ?>

                    <article class="border border-white/10 bg-[#0c1017] p-6">

                        <p class="text-[11px] font-semibold uppercase tracking-[.2em] text-white/45"><?= e($p['comp']) ?></p>

                        <div class="fb-led mt-6 flex items-end justify-between gap-2 text-4xl sm:text-5xl">
                            <span><?= e($p['casa']) ?></span>
                            <span><?= e($p['a']) ?> : <?= e($p['b']) ?></span>
                            <span><?= e($p['fora']) ?></span>
                        </div>

                        <?php if ($p['extra'] !== ''): ?>
                            <p class="fb-led mt-3 text-2xl"><?= e($p['extra']) ?></p>
                        <?php endif; ?>

                        <p class="mt-6 border-t border-white/10 pt-4 text-sm font-semibold text-white/80">Gols do Japão: <?= e($p['gols']) ?></p>
                        <p class="mt-2 text-sm leading-6 text-white/50"><?= e($p['nota']) ?></p>

                    </article>

                <?php endforeach; ?>

            </div>

        </div>

    </section>


    <!-- NADESHIKO -->
    <section class="px-6 py-24 md:px-10 md:py-28">

        <div class="mx-auto grid max-w-7xl gap-14 lg:grid-cols-2 lg:items-center">

            <div class="relative">

                <div class="relative h-[480px] overflow-hidden bg-[#0b2f9f]" style="clip-path: polygon(0 0, 100% 0, calc(100% - 34px) 100%, 0 100%);">
                    <img
                        src="<?= e(imagemFutebol('futebol_mulheres')) ?>"
                        alt="Jogadoras japonesas em uma partida de futebol"
                        loading="lazy"
                        class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#071a52]/70 via-transparent to-transparent"></div>
                </div>

                <div class="absolute bottom-6 left-0 bg-[#c72b30] px-5 py-3 text-white">
                    <p class="fb-disp text-3xl">撫子</p>
                    <p class="mt-1 text-[11px] font-semibold uppercase tracking-[.2em]">Nadeshiko · força delicada</p>
                </div>

            </div>

            <div>

                <p class="text-xs font-semibold uppercase tracking-[.3em] text-[#c72b30]">03 / Nadeshiko Japan</p>

                <h2 class="fb-disp mt-4 text-6xl md:text-8xl">
                    Força<br><span class="text-[#c72b30]">delicada.</span>
                </h2>

                <p class="mt-7 max-w-lg text-base leading-8 text-[#071a52]/70">
                    O nome vem do nadeshiko, o cravo-silvestre que simboliza a
                    mulher japonesa ideal. Em campo, virou futebol de posse,
                    toque rápido e uma coragem que mudou a história.
                </p>

                <table class="mt-8 w-full text-left text-sm">
                    <thead>
                        <tr class="bg-[#0b2f9f] text-xs uppercase tracking-[.2em] text-white">
                            <th class="px-4 py-3 font-semibold">Copa</th>
                            <th class="px-4 py-3 font-semibold">Sede</th>
                            <th class="px-4 py-3 font-semibold">Campanha</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#071a52]/10 bg-white">
                        <?php foreach ($campanhas as $c): ?>
                            <tr class="<?= $c[3] ? 'bg-[#c72b30]/10 font-bold text-[#c72b30]' : '' ?>">
                                <td class="fb-disp px-4 py-3 text-2xl"><?= e($c[0]) ?></td>
                                <td class="px-4 py-3"><?= e($c[1]) ?></td>
                                <td class="px-4 py-3"><?= e($c[2]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <p class="mt-5 text-sm leading-7 text-[#071a52]/60">
                    Em 2011, Homare Sawa foi artilheira, com cinco gols, e eleita
                    a melhor jogadora do torneio.
                </p>

            </div>

        </div>

    </section>


    <!-- FORA DAS QUATRO LINHAS -->
    <section class="fb-gramado relative isolate text-white">

        <div class="absolute inset-0 -z-10 bg-[#04200f]/45"></div>

        <div class="mx-auto max-w-7xl px-6 py-24 md:px-10 md:py-28">

            <p class="text-xs font-semibold uppercase tracking-[.3em] text-white/70">04 / Fora das quatro linhas</p>

            <h2 class="fb-disp mt-4 text-6xl md:text-8xl">
                Depois do apito,<br>a arquibancada<br><span class="text-[#ffb020]">fica limpa.</span>
            </h2>

            <p class="mt-8 max-w-xl text-base leading-8 text-white/85">
                Nas Copas de 2018 e 2022, torcedores japoneses ficaram para
                recolher o lixo das arquibancadas. Em 2018, a seleção ainda deixou
                o vestiário impecável, com um bilhete de agradecimento. No Japão,
                o respeito também faz parte do espetáculo.
            </p>

            <dl class="mt-14 grid gap-px border border-white/25 bg-white/25 sm:grid-cols-2 lg:grid-cols-4">

                <div class="bg-[#0f5a35]/80 p-6">
                    <dt class="fb-disp text-5xl">1993</dt>
                    <dd class="mt-3 text-sm leading-6 text-white/80">Dez clubes fundadores dão o pontapé inicial da J.League.</dd>
                </div>

                <div class="bg-[#0f5a35]/80 p-6">
                    <dt class="fb-disp text-5xl">1998</dt>
                    <dd class="mt-3 text-sm leading-6 text-white/80">Estreia em Copas do Mundo, e o Japão está em todas desde então.</dd>
                </div>

                <div class="bg-[#0f5a35]/80 p-6">
                    <dt class="fb-disp text-5xl">4</dt>
                    <dd class="mt-3 text-sm leading-6 text-white/80">Títulos da Copa da Ásia: 1992, 2000, 2004 e 2011.</dd>
                </div>

                <div class="bg-[#0f5a35]/80 p-6">
                    <dt class="fb-disp text-5xl">2011</dt>
                    <dd class="mt-3 text-sm leading-6 text-white/80">As Nadeshiko se tornam campeãs do mundo.</dd>
                </div>

            </dl>

            <div class="mt-12 flex flex-wrap items-end justify-between gap-6">
                <p class="fb-disp text-5xl md:text-7xl">Do Japão para o mundo.</p>
                <a href="#inicio" class="fb-cut inline-flex items-center gap-3 bg-white py-3 pl-6 pr-9 text-sm font-semibold uppercase tracking-[.18em] text-[#0f5a35] transition hover:bg-[#ffb020]">
                    Voltar ao topo <i class="bi bi-arrow-up"></i>
                </a>
            </div>

        </div>

    </section>

</main>


<script>
document.addEventListener('DOMContentLoaded', () => {

    const NS = 'http://www.w3.org/2000/svg';
    const reduzir = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Relógio da transmissão: um segundo por minuto de jogo
    const relogio = document.getElementById('fb-relogio');

    if (relogio) {
        if (reduzir) {
            relogio.textContent = '90′';
        } else {
            let minuto = 0;

            setInterval(() => {
                minuto = (minuto + 1) % 94;
                relogio.textContent = (minuto <= 90 ? minuto : '90+' + (minuto - 90)) + '′';
            }, 700);
        }
    }

    // [papel, x%, y%, linha] — o ataque é para cima; y = 0 é o gol rival
    const FORMACOES = {
        '4-2-3-1': {
            desc: 'Dois volantes protegem a defesa e o meia central liga a bola ao atacante. Um desenho clássico e equilibrado.',
            jog: [['GOL', 50, 93, 'g'], ['LE', 14, 74, 'd'], ['ZAG', 36, 78, 'd'], ['ZAG', 64, 78, 'd'], ['LD', 86, 74, 'd'], ['VOL', 38, 60, 'm'], ['VOL', 62, 60, 'm'], ['PE', 16, 40, 'm'], ['MEI', 50, 42, 'm'], ['PD', 84, 40, 'm'], ['ATA', 50, 20, 'f']]
        },
        '4-3-3': {
            desc: 'Os pontas abertos esticam a defesa rival e três meio-campistas controlam o ritmo da partida.',
            jog: [['GOL', 50, 93, 'g'], ['LE', 14, 74, 'd'], ['ZAG', 36, 78, 'd'], ['ZAG', 64, 78, 'd'], ['LD', 86, 74, 'd'], ['MC', 30, 56, 'm'], ['VOL', 50, 63, 'm'], ['MC', 70, 56, 'm'], ['PE', 18, 28, 'f'], ['ATA', 50, 20, 'f'], ['PD', 82, 28, 'f']]
        },
        '3-4-2-1': {
            desc: 'Três zagueiros e alas que apoiam o ataque. Um sistema que o Japão usou em jogos decisivos em 2022.',
            jog: [['GOL', 50, 93, 'g'], ['ZAG', 28, 78, 'd'], ['ZAG', 50, 81, 'd'], ['ZAG', 72, 78, 'd'], ['ALA', 10, 54, 'm'], ['VOL', 38, 58, 'm'], ['VOL', 62, 58, 'm'], ['ALA', 90, 54, 'm'], ['MEI', 34, 36, 'm'], ['MEI', 66, 36, 'm'], ['ATA', 50, 18, 'f']]
        },
        '4-4-2': {
            desc: 'Duas linhas de quatro, compactas e fáceis de entender, com dois atacantes dividindo a referência.',
            jog: [['GOL', 50, 93, 'g'], ['LE', 14, 74, 'd'], ['ZAG', 36, 78, 'd'], ['ZAG', 64, 78, 'd'], ['LD', 86, 74, 'd'], ['ME', 14, 52, 'm'], ['MC', 38, 56, 'm'], ['MC', 62, 56, 'm'], ['MD', 86, 52, 'm'], ['ATA', 38, 24, 'f'], ['ATA', 62, 24, 'f']]
        }
    };

    // Deslocamento vertical de cada linha em cada fase (positivo = recua)
    const FASES = {
        defender: { g: 0, d: 6, m: 14, f: 20 },
        construir: { g: 0, d: 0, m: 0, f: 0 },
        atacar: { g: -4, d: -14, m: -16, f: -8 }
    };

    const TEXTO_FASE = {
        defender: 'Bloco baixo: as linhas recuam e fecham os espaços.',
        construir: 'Posse organizada: linhas equilibradas para circular a bola.',
        atacar: 'Bloco alto: o time inteiro sobe e pressiona a saída do rival.'
    };

    const time = document.getElementById('fb-time');
    const setas = document.getElementById('fb-setas');

    let formacao = '4-2-3-1';
    let fase = 'construir';
    let atual = [];
    let temporizador;

    // Os onze ímãs
    const imas = Array.from({ length: 11 }, (_, i) => {

        const g = document.createElementNS(NS, 'g');

        g.setAttribute('class', 'fb-ima');
        g.innerHTML =
            '<circle r="16" fill="' + (i === 0 ? '#c72b30' : '#0b2f9f') + '" stroke="#fff" stroke-width="2.5"></circle>' +
            '<text y="6" text-anchor="middle" font-size="17" fill="#fff">' + (i + 1) + '</text>' +
            '<text class="papel" y="32" text-anchor="middle" font-size="11" fill="#1b2a4a"></text>';

        time.appendChild(g);

        return g;

    });

    function posicoes() {

        const deslocamento = FASES[fase];

        return FORMACOES[formacao].jog.map(([papel, x, y, linha]) => {

            const yy = Math.min(95, Math.max(5, y + deslocamento[linha]));

            return { papel, linha, yy, x: 10 + x * 3.4, y: 10 + yy * 5.25 };

        });

    }

    function media(lista, linha) {

        const grupo = lista.filter((j) => j.linha === linha);

        return grupo.reduce((soma, j) => soma + j.yy, 0) / grupo.length;

    }

    function aplicar(comSetas) {

        const novas = posicoes();

        if (comSetas && atual.length) {

            setas.replaceChildren();

            novas.forEach((n, i) => {

                const a = atual[i];

                if (Math.hypot(n.x - a.x, n.y - a.y) > 22) {

                    const linha = document.createElementNS(NS, 'line');

                    linha.setAttribute('x1', a.x);
                    linha.setAttribute('y1', a.y);
                    linha.setAttribute('x2', n.x);
                    linha.setAttribute('y2', n.y);
                    linha.setAttribute('class', 'fb-seta');
                    linha.setAttribute('marker-end', 'url(#fb-ponta)');
                    setas.appendChild(linha);

                }

            });

            clearTimeout(temporizador);
            temporizador = setTimeout(() => setas.replaceChildren(), 1700);

        }

        novas.forEach((n, i) => {
            imas[i].style.transform = 'translate(' + n.x + 'px,' + n.y + 'px)';
            imas[i].querySelector('.papel').textContent = n.papel;
        });

        atual = novas;

        document.getElementById('fb-nome').textContent = formacao;
        document.getElementById('fb-desc').textContent = FORMACOES[formacao].desc;
        document.getElementById('fb-fase-txt').textContent = TEXTO_FASE[fase];
        document.getElementById('fb-bloco').textContent = Math.round((media(novas, 'd') - media(novas, 'f')) * 1.05) + ' m';

        document.querySelectorAll('[data-formacao]').forEach((b) => {
            b.setAttribute('aria-pressed', String(b.dataset.formacao === formacao));
        });

        document.querySelectorAll('[data-fase]').forEach((b) => {
            b.setAttribute('aria-pressed', String(b.dataset.fase === fase));
        });

    }

    document.querySelectorAll('[data-formacao]').forEach((botao) => {
        botao.addEventListener('click', () => {
            formacao = botao.dataset.formacao;
            aplicar(true);
        });
    });

    document.querySelectorAll('[data-fase]').forEach((botao) => {
        botao.addEventListener('click', () => {
            fase = botao.dataset.fase;
            aplicar(true);
        });
    });

    // Primeira montagem sem animação
    time.classList.add('sem-trans');
    aplicar(false);
    requestAnimationFrame(() => requestAnimationFrame(() => time.classList.remove('sem-trans')));

});
</script>

<?php include_once __DIR__ . '/../templates/footer.php'; ?>