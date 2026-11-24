<?php

require_once __DIR__ . '/../../database/conexao.php';

if (!function_exists('e')) {
    function e(string $texto): string
    {
        return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    }
}

$imagensPadrao = [
    'surf_banner' => 'assets/img/surf/surfBanner.png',
    'surf_praia' => 'assets/img/surf/praia.png',
    'surf_shonan' => 'assets/img/surf/shonan.png',
    'surf_chiba' => 'assets/img/surf/chiba.png',
    'surf_kanoa' => 'assets/img/surf/kanoa.png'
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

function imagemSurf(string $chave): string
{
    global $imagensSite;

    return '../../' . ltrim($imagensSite[$chave] ?? '', '/');
}

// Picos em destaque (giro = direção para onde a praia está voltada, em graus: 90 = leste, 180 = sul)
$picos = [
    [
        'imagem' => 'surf_shonan',
        'alt' => 'Praia de Shonan, no Japão',
        'nome' => 'Shonan',
        'local' => 'Kanagawa · Baía de Sagami',
        'texto' => 'A cultura de praia mais próxima de Tóquio, onde o surf encontra a vida urbana.',
        'tipo' => 'Beach break',
        'voltada' => 'Sul',
        'giro' => 180,
        'epoca' => 'Fim do verão e outono',
        'lado' => 'right-0',
    ],
    [
        'imagem' => 'surf_chiba',
        'alt' => 'Litoral de Chiba, no Japão',
        'nome' => 'Tsurigasaki',
        'local' => 'Chiba · Ichinomiya',
        'texto' => 'Ondas abertas para o Pacífico e o palco da estreia olímpica do surf.',
        'tipo' => 'Beach break',
        'voltada' => 'Leste',
        'giro' => 90,
        'epoca' => 'Fim do verão e outono',
        'lado' => 'left-0',
    ],
];

include_once __DIR__ . '/../templates/header.php';
?>

<link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
    .sf-anton { font-family: 'Anton', 'Impact', sans-serif; text-transform: uppercase; }
    .sf-mono { font-family: 'DM Mono', ui-monospace, monospace; }

    /* Letras preenchidas por água que balança */
    .sf-water {
        color: transparent;
        -webkit-text-stroke: 2px rgba(255, 255, 255, .92);
        background:
            url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='220' height='28' viewBox='0 0 220 28'%3E%3Cpath d='M0 14C37 0 73 0 110 14S183 28 220 14V28H0Z' fill='%23c72b30'/%3E%3C/svg%3E") repeat-x 0 50% / 220px 28px,
            linear-gradient(to bottom, transparent calc(50% + 13px), #c72b30 calc(50% + 13px));
        -webkit-background-clip: text;
        background-clip: text;
        animation: sf-slosh 5s linear infinite;
    }
    .sf-water-ink { -webkit-text-stroke-color: #071018; }
    @keyframes sf-slosh { to { background-position: 220px 50%, 0 0; } }

    /* Controles do simulador */
    .sf-range {
        -webkit-appearance: none;
        appearance: none;
        height: 4px;
        border-radius: 4px;
        background: rgba(255, 255, 255, .22);
        outline-offset: 6px;
    }
    .sf-range::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 24px;
        height: 24px;
        border: 3px solid #f8f5ef;
        border-radius: 50%;
        background: #c72b30;
        cursor: grab;
    }
    .sf-range::-moz-range-thumb {
        width: 18px;
        height: 18px;
        border: 3px solid #f8f5ef;
        border-radius: 50%;
        background: #c72b30;
        cursor: grab;
    }

    @media (prefers-reduced-motion: reduce) { .sf-water { animation: none; } }
</style>

<main class="bg-[#f8f5ef] font-['Poppins'] text-[#171717]">

    <!-- ABERTURA -->
    <section id="inicio" class="relative isolate overflow-hidden bg-[#071018] text-white">

        <div class="absolute inset-0 -z-20 bg-cover bg-center" style="background-image: url('<?= e(imagemSurf('surf_banner')) ?>');"></div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-[#071018]/75 via-[#071018]/30 to-[#071018]/90"></div>

        <div class="mx-auto flex min-h-[700px] max-w-7xl flex-col justify-between px-6 pt-10 md:min-h-[780px] md:px-10">

            <!-- Boletim (exemplo) -->
            <div class="sf-mono flex flex-wrap items-start justify-between gap-6 text-[10px] uppercase tracking-[.2em] text-white/70">

                <p><span class="text-[#e45a5e]">●</span> Boletim de exemplo · Shonan</p>

                <dl class="grid grid-cols-3 gap-6 text-right">
                    <div><dt class="text-white/45">Onda</dt><dd class="mt-1 text-base text-white">1,2 m</dd></div>
                    <div><dt class="text-white/45">Período</dt><dd class="mt-1 text-base text-white">11 s</dd></div>
                    <div><dt class="text-white/45">Vento</dt><dd class="mt-1 text-base text-[#e45a5e]">Offshore</dd></div>
                </dl>

            </div>

            <div class="pb-32 pt-16">

                <p class="sf-mono text-xs uppercase tracking-[.3em] text-[#e45a5e]">波乗り · Naminori · サーフィン</p>

                <h1 class="sf-anton mt-5 leading-[.88]">
                    <span class="block text-5xl sm:text-7xl md:text-8xl">O Japão</span>
                    <span class="sf-water block text-[26vw] sm:text-[20vw] md:text-[15rem]">Surfa.</span>
                </h1>

                <p class="mt-8 max-w-xl text-sm leading-8 text-white/75 md:text-base">
                    Do Pacífico às praias de Chiba, o surf japonês é uma conversa
                    entre corpo, prancha e oceano. Entre na água e conheça essa
                    cultura costeira.
                </p>

                <a href="#mar" class="sf-mono mt-9 inline-flex items-center gap-3 bg-[#c72b30] px-7 py-4 text-xs font-medium uppercase tracking-[.2em] text-white transition hover:bg-[#a51e24]">
                    Ler o mar <i class="bi bi-arrow-down"></i>
                </a>

            </div>

        </div>

        <svg class="absolute bottom-[-1px] left-0 block h-16 w-full text-[#f8f5ef] md:h-24" viewBox="0 0 1440 90" preserveAspectRatio="none" fill="currentColor" aria-hidden="true">
            <path d="M0 52C150 96 300 8 480 44S800 100 980 48S1300 4 1440 52V90H0Z" />
        </svg>

    </section>


    <!-- LEIA O MAR -->
    <section id="mar" class="px-6 py-24 md:px-10 md:py-28">

        <div class="mx-auto grid max-w-7xl gap-14 lg:grid-cols-[.85fr_1.15fr] lg:items-center">

            <div>

                <p class="sf-mono text-xs uppercase tracking-[.3em] text-[#c72b30]">01 / Leia o mar</p>

                <h2 class="sf-anton mt-4 text-5xl leading-[.95] md:text-7xl">
                    Altura diz o tamanho.<br>
                    <span class="text-[#c72b30]">Período diz a força.</span>
                </h2>

                <p class="mt-7 max-w-md text-sm leading-8 text-[#57534e]">
                    Antes de entrar na água, o surfista lê dois números. A altura
                    mostra o tamanho da onda. O período, o tempo entre uma onda
                    e a seguinte, mostra quanta energia ela carrega: quanto
                    maior, mais força.
                </p>

                <p class="sf-mono mt-5 text-[11px] uppercase tracking-[.15em] text-[#57534e]/70">
                    Mexa nos controles. Valores ilustrativos, não são previsão real.
                </p>

            </div>

            <div class="rounded-sm bg-[#071018] p-6 text-white shadow-[0_40px_80px_-40px_rgba(7,16,24,.9)] md:p-8">

                <div class="sf-mono flex items-center justify-between text-[10px] uppercase tracking-[.2em] text-[#e45a5e]">
                    <span>Simulador de swell</span>
                    <span>● ao vivo</span>
                </div>

                <svg viewBox="0 0 600 220" preserveAspectRatio="none" class="mt-4 h-56 w-full overflow-hidden rounded-sm bg-[#171717]" aria-hidden="true">
                    <path id="sf-onda-3" fill="#8b2024" />
                    <path id="sf-onda-2" fill="#c72b30" />
                    <path id="sf-onda-1" fill="#e45a5e" fill-opacity=".92" />
                </svg>

                <div class="mt-7 grid gap-6 sm:grid-cols-2">

                    <div>
                        <label for="sf-altura" class="sf-mono flex justify-between text-[11px] uppercase tracking-[.18em] text-white/60">
                            Altura <output id="sf-altura-txt" class="text-[#e45a5e]">1,2 m</output>
                        </label>
                        <input id="sf-altura" type="range" min="0.3" max="4" step="0.1" value="1.2" class="sf-range mt-4 w-full">
                    </div>

                    <div>
                        <label for="sf-periodo" class="sf-mono flex justify-between text-[11px] uppercase tracking-[.18em] text-white/60">
                            Período <output id="sf-periodo-txt" class="text-[#e45a5e]">11 s</output>
                        </label>
                        <input id="sf-periodo" type="range" min="5" max="18" step="1" value="11" class="sf-range mt-4 w-full">
                    </div>

                </div>

                <p id="sf-veredito" aria-live="polite" class="mt-7 border-t border-white/15 pt-5 text-sm leading-7 text-white/80"></p>

            </div>

        </div>

    </section>


    <!-- BOLETIM DOS PICOS -->
    <section class="bg-[#071018] px-6 py-24 text-white md:px-10 md:py-28">

        <div class="mx-auto max-w-7xl">

            <div class="mb-14 max-w-2xl">
                <p class="sf-mono text-xs uppercase tracking-[.3em] text-[#e45a5e]">02 / Boletim dos picos</p>
                <h2 class="sf-anton mt-4 text-5xl leading-[.95] md:text-7xl">
                    Dois picos.<br><span class="text-[#e45a5e]">Um oceano.</span>
                </h2>
            </div>

            <div class="space-y-8">

                <?php foreach ($picos as $pico): ?>

                    <article class="relative min-h-[460px] overflow-hidden md:min-h-[520px]">

                        <img
                            src="<?= e(imagemSurf($pico['imagem'])) ?>"
                            alt="<?= e($pico['alt']) ?>"
                            loading="lazy"
                            class="absolute inset-0 h-full w-full object-cover">

                        <div class="absolute inset-0 bg-gradient-to-t from-[#071018]/70 via-transparent to-transparent"></div>

                        <div class="relative flex min-h-[460px] items-end p-4 md:absolute md:inset-y-0 md:min-h-0 md:items-center md:p-8 <?= e($pico['lado']) ?> md:w-[26rem]">

                            <div class="w-full border border-white/15 bg-[#071018]/85 p-6 backdrop-blur-md">

                                <div class="flex items-start justify-between gap-4">

                                    <div>
                                        <p class="sf-mono text-[10px] uppercase tracking-[.2em] text-[#e45a5e]"><?= e($pico['local']) ?></p>
                                        <h3 class="sf-anton mt-2 text-5xl leading-none"><?= e($pico['nome']) ?></h3>
                                    </div>

                                    <!-- Bússola: para onde a praia está voltada -->
                                    <svg viewBox="0 0 64 64" class="h-16 w-16 shrink-0 text-white" aria-label="Praia voltada para o <?= e($pico['voltada']) ?>" role="img">
                                        <circle cx="32" cy="32" r="30" fill="none" stroke="currentColor" stroke-opacity=".3" />
                                        <text x="32" y="11" text-anchor="middle" font-size="8" fill="currentColor" fill-opacity=".6" font-family="DM Mono, monospace">N</text>
                                        <g transform="rotate(<?= (int) $pico['giro'] ?> 32 32)">
                                            <path d="M32 14 L37 36 L32 31 L27 36 Z" fill="#c72b30" />
                                        </g>
                                    </svg>

                                </div>

                                <p class="mt-4 text-sm leading-7 text-white/70"><?= e($pico['texto']) ?></p>

                                <dl class="sf-mono mt-5 divide-y divide-white/10 border-y border-white/10 text-[11px] uppercase tracking-[.12em]">
                                    <div class="flex justify-between gap-4 py-2.5"><dt class="text-white/45">Tipo</dt><dd><?= e($pico['tipo']) ?></dd></div>
                                    <div class="flex justify-between gap-4 py-2.5"><dt class="text-white/45">Voltada para</dt><dd><?= e($pico['voltada']) ?></dd></div>
                                    <div class="flex justify-between gap-4 py-2.5"><dt class="text-white/45">Boa época</dt><dd class="text-right"><?= e($pico['epoca']) ?></dd></div>
                                </dl>

                            </div>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

            <p class="sf-mono mt-8 max-w-2xl text-[11px] uppercase leading-6 tracking-[.12em] text-white/45">
                No Japão, as maiores ondulações costumam chegar com os tufões
                (台風, taifū) do fim do verão e do outono.
            </p>

        </div>

    </section>


    <!-- ETIQUETA DO LINE-UP -->
    <section class="px-6 py-24 md:px-10 md:py-28">

        <div class="mx-auto grid max-w-7xl gap-14 lg:grid-cols-2 lg:items-center">

            <!-- Diagrama: vista de cima -->
            <figure class="border border-[#071018]/10 bg-white p-4 shadow-[0_30px_60px_-45px_rgba(7,16,24,.8)]">

                <svg viewBox="0 0 360 240" class="w-full" role="img" aria-label="Diagrama de uma onda quebrando da esquerda para a direita: o surfista mais perto do pico tem a prioridade">
                    <rect width="360" height="240" fill="#f2dedd" />
                    <path d="M0 200 Q180 184 360 200 V240 H0Z" fill="#e8dfd2" />
                    <path d="M70 150 C130 136 200 110 320 62" fill="none" stroke="#fff" stroke-width="6" stroke-linecap="round" stroke-dasharray="1 9" />
                    <path d="M70 150 C130 136 200 110 320 62" fill="none" stroke="#c72b30" stroke-width="3" />
                    <circle cx="70" cy="150" r="14" fill="none" stroke="#c72b30" stroke-dasharray="3 4" />
                    <path d="M98 142 C130 134 160 122 186 110" fill="none" stroke="#e45a5e" stroke-width="2.5" />
                    <path d="M190 108 l-11 -1 l5 10 z" fill="#e45a5e" />
                    <circle cx="86" cy="152" r="8" fill="#e45a5e" />
                    <circle cx="224" cy="98" r="8" fill="none" stroke="#071018" stroke-width="2" />
                    <g font-family="DM Mono, monospace" font-size="10" fill="#071018">
                        <text x="30" y="180">PICO</text>
                        <text x="96" y="178">1 · TEM A VEZ</text>
                        <text x="240" y="92">2 · ESPERA</text>
                        <text x="140" y="222" fill="#57534e">PRAIA</text>
                    </g>
                </svg>

                <figcaption class="sf-mono mt-3 text-[10px] uppercase tracking-[.2em] text-[#57534e]/70">Vista de cima · onda quebrando para a direita</figcaption>

            </figure>

            <div>

                <p class="sf-mono text-xs uppercase tracking-[.3em] text-[#c72b30]">03 / Etiqueta do line-up</p>

                <h2 class="sf-anton mt-4 text-5xl leading-[.95] md:text-7xl">
                    Na água,<br><span class="text-[#c72b30]">respeito primeiro.</span>
                </h2>

                <ol class="mt-9 divide-y divide-[#071018]/10 border-y border-[#071018]/10">

                    <li class="flex gap-5 py-5">
                        <span class="sf-anton text-4xl leading-none text-[#c72b30]">1</span>
                        <p class="text-sm leading-7 text-[#57534e]"><strong class="text-[#071018]">Quem está mais perto do pico tem a vez.</strong> A prioridade é de quem está no ponto onde a onda começa a quebrar.</p>
                    </li>

                    <li class="flex gap-5 py-5">
                        <span class="sf-anton text-4xl leading-none text-[#c72b30]">2</span>
                        <p class="text-sm leading-7 text-[#57534e]"><strong class="text-[#071018]">Nunca corte a onda de ninguém.</strong> Entrar numa onda que já tem dono é a maior falta do line-up.</p>
                    </li>

                    <li class="flex gap-5 py-5">
                        <span class="sf-anton text-4xl leading-none text-[#c72b30]">3</span>
                        <p class="text-sm leading-7 text-[#57534e]"><strong class="text-[#071018]">Reme por fora da zona de quebra.</strong> Contornar a onda evita atrapalhar quem está surfando.</p>
                    </li>

                    <li class="flex gap-5 py-5">
                        <span class="sf-anton text-4xl leading-none text-[#c72b30]">4</span>
                        <p class="text-sm leading-7 text-[#57534e]"><strong class="text-[#071018]">Cuide da praia como da sua casa.</strong> Cumprimente quem já estava lá e leve seu lixo embora.</p>
                    </li>

                </ol>

            </div>

        </div>

    </section>


    <!-- ESTREIA OLÍMPICA -->
    <section class="bg-[#071018] px-6 py-24 text-white md:px-10 md:py-28">

        <div class="mx-auto grid max-w-7xl gap-14 lg:grid-cols-[1.05fr_.95fr] lg:items-center">

            <div class="relative min-h-[480px] overflow-hidden">

                <img
                    src="<?= e(imagemSurf('surf_kanoa')) ?>"
                    alt="Surfista durante as Olimpíadas de Tóquio"
                    loading="lazy"
                    class="absolute inset-0 h-full w-full object-cover">

                <div class="absolute inset-0 bg-gradient-to-t from-[#071018]/80 via-transparent to-transparent"></div>

                <div class="sf-mono absolute bottom-0 left-0 flex items-center gap-4 bg-[#c72b30] px-5 py-3 text-[11px] font-medium uppercase tracking-[.2em] text-white">
                    <span>Final</span>
                    <span>Tóquio 2020</span>
                    <span>Tsurigasaki</span>
                </div>

            </div>

            <div>

                <p class="sf-mono text-xs uppercase tracking-[.3em] text-[#e45a5e]">04 / Estreia olímpica</p>

                <h2 class="sf-anton mt-4 text-5xl leading-[.95] md:text-7xl">
                    O mundo<br><span class="text-[#e45a5e]">entrou na água.</span>
                </h2>

                <p class="mt-7 text-sm leading-8 text-white/65">
                    Nos Jogos de Tóquio 2020, realizados em 2021, o surf
                    estreou nas Olimpíadas. A praia de Tsurigasaki, em Chiba,
                    transformou a costa japonesa em palco mundial.
                </p>

                <!-- Placar -->
                <div class="mt-9 border border-white/15 p-6">

                    <p class="sf-mono text-[10px] uppercase tracking-[.25em] text-white/50">Como se pontua</p>

                    <div class="sf-anton mt-4 flex flex-wrap items-end gap-x-5 text-6xl leading-none md:text-7xl">
                        <span>10,0</span><span class="text-[#e45a5e]">+</span><span>10,0</span><span class="text-[#e45a5e]">=</span><span class="text-[#e45a5e]">20</span>
                    </div>

                    <p class="mt-4 text-xs leading-6 text-white/55">
                        Cada onda recebe nota de 0 a 10 e valem as duas melhores.
                        O placar perfeito é 20.
                    </p>

                </div>

                <ul class="sf-mono mt-6 space-y-3 text-[11px] uppercase tracking-[.12em]">
                    <li class="flex items-center gap-3"><span class="h-3 w-3 rounded-full bg-[#c9d3d8]"></span>Prata · Kanoa Igarashi</li>
                    <li class="flex items-center gap-3"><span class="h-3 w-3 rounded-full bg-[#c98a54]"></span>Bronze · Amuro Tsuzuki</li>
                </ul>

                <p class="mt-5 text-xs leading-6 text-white/45">
                    O ouro masculino ficou com o brasileiro Ítalo Ferreira.
                </p>

            </div>

        </div>

    </section>


    <!-- ENCERRAMENTO -->
    <section class="bg-[#c72b30] px-6 py-16 text-white md:px-10">

        <div class="mx-auto flex max-w-7xl flex-wrap items-end justify-between gap-8">

            <p class="sf-anton text-6xl leading-[.9] md:text-8xl">A próxima<br>série já vem.</p>

            <a href="#inicio" class="sf-mono inline-flex items-center gap-3 border border-white px-6 py-3 text-[11px] font-medium uppercase tracking-[.2em] transition hover:bg-[#071018] hover:text-white">
                Voltar ao início <i class="bi bi-arrow-up"></i>
            </a>

        </div>

    </section>

</main>


<script>
document.addEventListener('DOMContentLoaded', () => {

    const altura = document.getElementById('sf-altura');
    const periodo = document.getElementById('sf-periodo');
    const alturaTxt = document.getElementById('sf-altura-txt');
    const periodoTxt = document.getElementById('sf-periodo-txt');
    const veredito = document.getElementById('sf-veredito');

    // Três camadas de onda: [elemento, linha base, escala, velocidade, deslocamento]
    const camadas = [
        { el: document.getElementById('sf-onda-3'), base: 92, k: .55, v: .6, off: 2.1 },
        { el: document.getElementById('sf-onda-2'), base: 112, k: .8, v: .8, off: 1.1 },
        { el: document.getElementById('sf-onda-1'), base: 134, k: 1, v: 1, off: 0 }
    ];

    const reduzirMovimento = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let fase = 0;
    let visivel = true;

    function nivel(h) {
        if (h < .6) return 'Mar quase flat';
        if (h < 1.2) return 'Ondas pequenas, ótimas para aprender';
        if (h < 2) return 'Ondas divertidas para a maioria';
        if (h < 3) return 'Sessão séria: só com experiência';
        return 'Ressaca: fique na areia e observe';
    }

    function forca(p) {
        if (p < 8) return 'mar mexido, formado pelo vento local.';
        if (p < 12) return 'swell de energia média.';
        return 'swell de longo período: ondas com mais força e linhas bem organizadas.';
    }

    function atualizarTextos() {
        const h = parseFloat(altura.value);
        const p = parseFloat(periodo.value);

        alturaTxt.textContent = h.toFixed(1).replace('.', ',') + ' m';
        periodoTxt.textContent = p + ' s';
        veredito.textContent = nivel(h) + ' · ' + forca(p);
    }

    function desenhar() {
        const h = parseFloat(altura.value);
        const p = parseFloat(periodo.value);
        const amplitude = 8 + h * 15;
        const comprimento = 60 + p * 16;

        camadas.forEach((c) => {
            let d = 'M0 220';

            for (let x = 0; x <= 600; x += 6) {
                const t = (x / comprimento) * 2 * Math.PI + fase * c.v + c.off;
                const y = c.base - c.k * amplitude * (Math.sin(t) + .28 * Math.sin(2 * t + 1));
                d += ' L' + x + ' ' + y.toFixed(1);
            }

            c.el.setAttribute('d', d + ' L600 220 Z');
        });
    }

    function ciclo() {
        if (visivel) {
            fase += .035;
            desenhar();
        }

        requestAnimationFrame(ciclo);
    }

    [altura, periodo].forEach((campo) => {
        campo.addEventListener('input', () => {
            atualizarTextos();
            desenhar();
        });
    });

    atualizarTextos();
    desenhar();

    if (!reduzirMovimento) {
        // Anima só enquanto o simulador está na tela
        new IntersectionObserver((entradas) => {
            visivel = entradas[0].isIntersecting;
        }).observe(document.getElementById('sf-onda-1').ownerSVGElement);

        requestAnimationFrame(ciclo);
    }

});
</script>

<?php include_once __DIR__ . '/../templates/footer.php'; ?>