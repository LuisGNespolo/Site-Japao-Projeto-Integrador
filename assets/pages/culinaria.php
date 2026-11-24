<?php

require_once __DIR__ . '/../../database/conexao.php';

if (!function_exists('e')) {
    function e(string $texto): string
    {
        return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    }
}

$imagensPadrao = [
    'culinaria_banner' => 'assets/img/culinaria/banner.png',
    'culinaria_sushi' => 'assets/img/culinaria/sushi.png',
    'culinaria_sashimi' => 'assets/img/culinaria/sashimi.png',
    'culinaria_ramen' => 'assets/img/culinaria/ramen.png',
    'culinaria_yakisoba' => 'assets/img/culinaria/yakisoba.png',
    'culinaria_chef' => 'assets/img/culinaria/japonesCozinhando.png'
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

function imagemCulinaria(string $chave): string
{
    global $imagensSite;

    return '../../' . ltrim($imagensSite[$chave] ?? '', '/');
}

// As cinco cores do washoku (goshiki)
$cores = [
    ['kanji' => '白', 'leitura' => 'Shiro', 'nome' => 'Branco',   'itens' => 'Arroz, tofu e daikon',           'bg' => '#faf6ee', 'fg' => '#1c1511'],
    ['kanji' => '黒', 'leitura' => 'Kuro',  'nome' => 'Preto',    'itens' => 'Nori, gergelim preto e shiitake', 'bg' => '#1c1511', 'fg' => '#faf6ee'],
    ['kanji' => '赤', 'leitura' => 'Aka',   'nome' => 'Vermelho', 'itens' => 'Atum, umeboshi e pimenta',        'bg' => '#a3201f', 'fg' => '#faf6ee'],
    ['kanji' => '黄', 'leitura' => 'Ki',    'nome' => 'Amarelo',  'itens' => 'Tamago (ovo), takuan e yuzu',     'bg' => '#f0b33c', 'fg' => '#1c1511'],
    ['kanji' => '青', 'leitura' => 'Ao',    'nome' => 'Verde',    'itens' => 'Cebolinha, wasabi e edamame',     'bg' => '#5f7d3a', 'fg' => '#faf6ee'],
];

// Compartimentos da marmita (bento)
$pratos = [
    ['img' => 'culinaria_sushi', 'alt' => 'Sushi japonês', 'kanji' => '寿司', 'nome' => 'Sushi', 'texto' => 'Arroz temperado com vinagre e ingredientes do mar. A precisão está no corte e no ponto do arroz.', 'classe' => 'md:col-span-2', 'vapor' => false],
    ['img' => 'culinaria_sashimi', 'alt' => 'Sashimi japonês', 'kanji' => '刺身', 'nome' => 'Sashimi', 'texto' => 'Fatias de peixe cru, sem arroz. Aqui, o frescor e o corte são os protagonistas.', 'classe' => 'md:col-start-3 md:row-start-1 md:row-span-2', 'vapor' => false],
    ['img' => 'culinaria_ramen', 'alt' => 'Ramen japonês', 'kanji' => 'ラーメン', 'nome' => 'Ramen', 'texto' => 'Macarrão em caldo de shoyu, miso, shio ou tonkotsu. Veio de fora e virou símbolo do Japão.', 'classe' => '', 'vapor' => true],
    ['img' => 'culinaria_yakisoba', 'alt' => 'Yakisoba japonês', 'kanji' => '焼きそば', 'nome' => 'Yakisoba', 'texto' => 'Macarrão frito na chapa com legumes e molho, clássico das barracas de festival.', 'classe' => '', 'vapor' => false],
];

include_once __DIR__ . '/../templates/header.php';
?>

<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,800;1,9..144,600&family=Zen+Maru+Gothic:wght@400;500;700&display=swap" rel="stylesheet">

<style>
    .cu-serif { font-family: 'Fraunces', Georgia, serif; }
    .cu-sans { font-family: 'Zen Maru Gothic', 'Noto Sans JP', sans-serif; }

    /* Toalha xadrez (ichimatsu) */
    .cu-toalha { background: repeating-conic-gradient(#f4ede0 0% 25%, #faf6ee 0% 50%) 0 0 / 56px 56px; }

    /* Noren: cortina de entrada dos restaurantes */
    .cu-noren { position: absolute; top: 0; right: 7%; display: flex; gap: 6px; padding: 16px 8px 0; }
    .cu-noren::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 16px;
        border-radius: 8px;
        background: linear-gradient(#7a5535, #3b2716);
    }
    .cu-noren span {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 64px;
        height: 190px;
        border-bottom: 10px solid #a3201f;
        background: #1d2a4a;
        color: #faf6ee;
        font-family: 'Zen Maru Gothic', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        transform-origin: top center;
        animation: cu-sway 5s ease-in-out infinite alternate;
    }
    .cu-noren span:nth-child(2) { height: 174px; animation-delay: -1.2s; }
    .cu-noren span:nth-child(3) { height: 196px; animation-delay: -2.4s; }
    .cu-noren span:nth-child(4) { height: 180px; animation-delay: -3.3s; }
    @keyframes cu-sway { from { transform: rotate(-1.8deg); } to { transform: rotate(1.8deg); } }

    /* Paleta das cinco cores: faixa que se expande */
    .cu-cor { flex: 1 1 0; transition: flex .6s cubic-bezier(.2, .8, .2, 1); }
    .cu-itens { max-height: 0; opacity: 0; overflow: hidden; transition: opacity .4s, max-height .6s; }
    @media (min-width: 768px) {
        .cu-cor:hover, .cu-cor:focus { flex: 2.8 1 0; }
        .cu-cor:hover .cu-itens, .cu-cor:focus .cu-itens { max-height: 6rem; opacity: .85; }
    }
    @media (max-width: 767px) { .cu-itens { max-height: none; opacity: .85; } }
    .cu-cor:focus-visible { outline: 3px solid #f0b33c; outline-offset: -6px; }

    /* Vapor do ramen */
    .cu-vapor { position: absolute; top: 1rem; right: 1.25rem; display: flex; gap: .45rem; }
    .cu-vapor i {
        display: block;
        width: 6px;
        height: 34px;
        border-left: 2px solid rgba(255, 255, 255, .75);
        border-radius: 50%;
        animation: cu-sobe 2.8s ease-in infinite;
    }
    .cu-vapor i:nth-child(2) { height: 44px; animation-delay: -.9s; }
    .cu-vapor i:nth-child(3) { animation-delay: -1.8s; }
    @keyframes cu-sobe {
        0% { opacity: 0; transform: translateY(10px) rotate(8deg); }
        40% { opacity: .85; }
        100% { opacity: 0; transform: translateY(-22px) rotate(-8deg); }
    }

    /* Hashi apoiados na marmita */
    .cu-hashi { position: absolute; right: -1.5rem; bottom: -1.4rem; display: none; height: 1.6rem; width: 15rem; pointer-events: none; }
    @media (min-width: 1024px) { .cu-hashi { display: block; } }
    .cu-hashi::before, .cu-hashi::after {
        content: '';
        position: absolute;
        left: 0;
        width: 100%;
        height: 5px;
        border-radius: 3px;
        background: linear-gradient(90deg, #2a1b10, #c99a5b 70%, #e6c58f);
        transform-origin: right center;
    }
    .cu-hashi::before { top: 0; transform: rotate(-3deg); }
    .cu-hashi::after { top: 13px; transform: rotate(1.5deg); }

    /* Laboratório de dashi */
    .cu-item { opacity: 0; transform: scale(.6); transform-box: fill-box; transform-origin: center; transition: opacity .5s, transform .5s; }
    .cu-item.on { opacity: 1; transform: scale(1); }
    .cu-chip {
        border: 1px solid rgba(250, 246, 238, .25);
        border-radius: 999px;
        padding: .6rem 1.1rem;
        font-size: .8rem;
        font-weight: 500;
        color: #faf6ee;
        transition: background .3s, color .3s, border-color .3s;
    }
    .cu-chip:hover { border-color: #f0b33c; }
    .cu-chip[aria-pressed="true"] { border-color: #f0b33c; background: #f0b33c; color: #1c1511; }

    @media (prefers-reduced-motion: reduce) {
        .cu-noren span, .cu-vapor i { animation: none; }
        .cu-cor, .cu-itens, .cu-item { transition: none; }
    }
</style>

<main class="cu-sans bg-[#faf6ee] text-[#1c1511]">

    <!-- ABERTURA -->
    <section id="inicio" class="relative isolate overflow-hidden border-b-[10px] border-[#a3201f] bg-[#14100d] text-white">

        <div class="absolute inset-0 -z-20 bg-cover bg-center" style="background-image: url('<?= e(imagemCulinaria('culinaria_banner')) ?>');"></div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#14100d]/95 via-[#14100d]/70 to-[#14100d]/20"></div>

        <!-- Noren: おいしい (oishii, "delicioso") -->
        <div class="cu-noren hidden md:flex" aria-hidden="true">
            <span>お</span><span>い</span><span>し</span><span>い</span>
        </div>

        <div class="mx-auto flex min-h-[680px] max-w-7xl flex-col justify-end px-6 pb-20 pt-24 md:min-h-[760px] md:px-10">

            <p class="flex items-center gap-3 text-xs font-bold uppercase tracking-[.3em] text-[#f0b33c]">
                <span class="h-px w-12 bg-[#f0b33c]"></span>
                和食 · Washoku
            </p>

            <h1 class="cu-serif mt-6 text-6xl font-extrabold leading-[.95] tracking-[-.02em] sm:text-7xl md:text-8xl">
                Comer é<br><span class="font-semibold italic text-[#f0b33c]">contemplar.</span>
            </h1>

            <p class="mt-8 max-w-xl text-sm leading-8 text-white/75 md:text-base">
                Na culinária japonesa, cada prato nasce do encontro entre
                natureza, técnica e tempo. Um universo de sabores onde o
                oceano, os campos e as estações chegam à mesa.
            </p>

            <div class="mt-9 flex flex-wrap items-center gap-5">

                <a href="#principio" class="inline-flex items-center gap-3 bg-[#a3201f] px-7 py-4 text-xs font-bold uppercase tracking-[.2em] transition hover:-translate-y-1 hover:bg-[#c72b30]">
                    Sentar à mesa <i class="bi bi-arrow-down-right"></i>
                </a>

                <span class="border border-white/25 px-5 py-3 text-xs text-white/70">
                    <span class="text-base text-[#f0b33c]">一汁三菜</span> · uma sopa, três pratos
                </span>

            </div>

        </div>

    </section>


    <!-- O PRINCÍPIO -->
    <section id="principio" class="cu-toalha px-6 py-24 md:px-10 md:py-32">

        <div class="mx-auto max-w-7xl">

            <div class="grid gap-14 lg:grid-cols-2 lg:items-end">

                <div>

                    <p class="text-xs font-bold uppercase tracking-[.3em] text-[#a3201f]">01 / O princípio</p>

                    <h2 class="cu-serif mt-4 text-5xl font-extrabold leading-[1] tracking-[-.02em] md:text-7xl">
                        A natureza<br><span class="font-semibold italic text-[#a3201f]">servida.</span>
                    </h2>

                    <p class="mt-7 max-w-md text-sm leading-8 text-[#5a4a40]">
                        O washoku busca equilíbrio em tudo: cinco cores, cinco
                        sabores e cinco formas de preparo. O resultado é uma
                        cozinha sazonal, ligada ao território e feita para
                        agradar aos olhos antes da boca.
                    </p>

                </div>

                <!-- Cinco formas de preparo (gohō) -->
                <div>

                    <p class="mb-4 text-[11px] font-bold uppercase tracking-[.25em] text-[#5a4a40]/80">Cinco formas de preparo</p>

                    <ul class="grid grid-cols-5 border border-[#1c1511]/15 bg-[#faf6ee]/80">
                        <li class="border-r border-[#1c1511]/15 px-2 py-5 text-center"><span class="block text-3xl font-bold text-[#a3201f]">生</span><span class="mt-2 block text-[10px] uppercase tracking-[.12em]">Cru</span></li>
                        <li class="border-r border-[#1c1511]/15 px-2 py-5 text-center"><span class="block text-3xl font-bold text-[#a3201f]">煮</span><span class="mt-2 block text-[10px] uppercase tracking-[.12em]">Cozido</span></li>
                        <li class="border-r border-[#1c1511]/15 px-2 py-5 text-center"><span class="block text-3xl font-bold text-[#a3201f]">焼</span><span class="mt-2 block text-[10px] uppercase tracking-[.12em]">Grelhado</span></li>
                        <li class="border-r border-[#1c1511]/15 px-2 py-5 text-center"><span class="block text-3xl font-bold text-[#a3201f]">揚</span><span class="mt-2 block text-[10px] uppercase tracking-[.12em]">Frito</span></li>
                        <li class="px-2 py-5 text-center"><span class="block text-3xl font-bold text-[#a3201f]">蒸</span><span class="mt-2 block text-[10px] uppercase tracking-[.12em]">Vapor</span></li>
                    </ul>

                </div>

            </div>


            <!-- Cinco cores (goshiki) -->
            <div class="mt-20">

                <p class="mb-4 text-[11px] font-bold uppercase tracking-[.25em] text-[#5a4a40]/80">
                    Cinco cores · 五色 <span class="hidden md:inline">(passe o mouse ou use o teclado)</span>
                </p>

                <div class="flex flex-col overflow-hidden rounded-sm shadow-[0_30px_60px_-45px_rgba(28,21,17,.9)] md:h-[380px] md:flex-row">

                    <?php foreach ($cores as $cor): ?>

                        <div tabindex="0"
                            class="cu-cor flex flex-row items-center gap-5 p-6 md:flex-col md:items-stretch md:justify-between"
                            style="background: <?= e($cor['bg']) ?>; color: <?= e($cor['fg']) ?>;">

                            <span class="hidden text-[10px] font-bold uppercase tracking-[.25em] opacity-70 md:block"><?= e($cor['leitura']) ?></span>

                            <span class="cu-sans text-6xl font-bold leading-none md:text-8xl"><?= e($cor['kanji']) ?></span>

                            <div>
                                <p class="cu-serif text-2xl font-semibold"><?= e($cor['nome']) ?></p>
                                <p class="cu-itens mt-2 text-sm leading-6"><?= e($cor['itens']) ?></p>
                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>

    </section>


    <!-- A MARMITA (BENTO) -->
    <section class="bg-[#f4ede0] px-6 py-24 md:px-10 md:py-32">

        <div class="mx-auto max-w-6xl">

            <div class="mb-14 max-w-2xl">
                <p class="text-xs font-bold uppercase tracking-[.3em] text-[#a3201f]">02 / A marmita</p>
                <h2 class="cu-serif mt-4 text-5xl font-extrabold leading-[1] tracking-[-.02em] md:text-7xl">
                    Quatro pratos,<br><span class="font-semibold italic text-[#a3201f]">uma bandeja.</span>
                </h2>
            </div>

            <div class="relative">

                <div class="rounded-[1.75rem] bg-[#1c1511] p-3 shadow-[0_40px_80px_-40px_rgba(28,21,17,.9)] md:p-4">

                    <div class="grid gap-3 rounded-[1.25rem] bg-gradient-to-br from-[#a3201f] to-[#6e1413] p-3 md:grid-cols-3 md:grid-rows-[300px_260px] md:gap-4 md:p-4">

                        <?php foreach ($pratos as $prato): ?>

                            <article class="group relative min-h-[280px] overflow-hidden rounded-xl bg-[#1c1511] <?= e($prato['classe']) ?>">

                                <img
                                    src="<?= e(imagemCulinaria($prato['img'])) ?>"
                                    alt="<?= e($prato['alt']) ?>"
                                    loading="lazy"
                                    class="absolute inset-0 h-full w-full object-cover saturate-[.9] transition duration-700 group-hover:scale-105 group-hover:saturate-110">

                                <div class="absolute inset-0 bg-gradient-to-t from-[#1c1511]/90 via-[#1c1511]/10 to-transparent"></div>

                                <span class="absolute left-4 top-4 rounded-sm bg-[#faf6ee] px-3 py-1.5 text-xs font-bold text-[#1c1511]"><?= e($prato['kanji']) ?></span>

                                <?php if ($prato['vapor']): ?>
                                    <div class="cu-vapor" aria-hidden="true"><i></i><i></i><i></i></div>
                                <?php endif; ?>

                                <div class="absolute inset-x-0 bottom-0 p-5 text-white">
                                    <h3 class="cu-serif text-3xl font-semibold"><?= e($prato['nome']) ?></h3>
                                    <p class="mt-2 max-w-xs text-xs leading-6 text-white/75"><?= e($prato['texto']) ?></p>
                                </div>

                            </article>

                        <?php endforeach; ?>

                    </div>

                </div>

                <div class="cu-hashi" aria-hidden="true"></div>

            </div>

        </div>

    </section>


    <!-- LABORATÓRIO DE DASHI -->
    <section class="bg-[#1c1511] px-6 py-24 text-white md:px-10 md:py-32">

        <div class="mx-auto max-w-7xl">

            <div class="mb-14 grid gap-8 lg:grid-cols-2 lg:items-end">

                <div>
                    <p class="text-xs font-bold uppercase tracking-[.3em] text-[#f0b33c]">03 / O caldo</p>
                    <h2 class="cu-serif mt-4 text-5xl font-extrabold leading-[1] tracking-[-.02em] md:text-7xl">
                        A base de tudo:<br><span class="font-semibold italic text-[#f0b33c]">dashi.</span>
                    </h2>
                </div>

                <p class="max-w-md text-sm leading-8 text-white/60">
                    Em 1908, o químico Kikunae Ikeda isolou o glutamato do caldo
                    de kombu e deu nome ao quinto sabor: umami (旨味). Monte o seu
                    dashi e veja o que cada ingrediente faz.
                </p>

            </div>

            <div class="grid gap-8 lg:grid-cols-[.9fr_1.1fr]">

                <figure class="relative min-h-[420px] overflow-hidden">

                    <img
                        src="<?= e(imagemCulinaria('culinaria_chef')) ?>"
                        alt="Chef japonês preparando alimentos"
                        loading="lazy"
                        class="absolute inset-0 h-full w-full object-cover saturate-[.9]">

                    <div class="absolute inset-0 bg-gradient-to-t from-[#1c1511] via-transparent to-transparent"></div>

                    <figcaption class="absolute bottom-6 left-6">
                        <p class="text-[10px] font-bold uppercase tracking-[.25em] text-[#f0b33c]">Do território à mesa</p>
                        <p class="cu-serif mt-2 text-3xl font-semibold italic">Respeitar é cozinhar.</p>
                    </figcaption>

                </figure>

                <div class="border border-white/10 bg-[#241a15] p-6 md:p-8">

                    <p class="text-[11px] font-bold uppercase tracking-[.25em] text-white/50">Laboratório de dashi</p>

                    <!-- Tigela vista de cima -->
                    <svg viewBox="0 0 240 240" class="mx-auto mt-4 h-60 w-60" role="img" aria-label="Tigela de caldo vista de cima">
                        <circle cx="120" cy="120" r="112" fill="#a3201f" />
                        <circle cx="120" cy="120" r="104" fill="#1c1511" />
                        <circle id="cu-caldo" cx="120" cy="120" r="94" fill="#d8e8e4" style="transition: fill .6s;" />

                        <g class="cu-item" data-item="k">
                            <rect x="66" y="104" width="96" height="26" rx="4" fill="#2f4a2a" transform="rotate(-18 114 117)" />
                            <path d="M78 112 L150 92 M76 122 L148 102" stroke="#4f7a45" stroke-width="1.5" fill="none" />
                        </g>

                        <g class="cu-item" data-item="b" fill="#d49a7a">
                            <path d="M138 150 q8 -11 17 0 q-8 11 -17 0z" />
                            <path d="M158 138 q8 -11 17 0 q-8 11 -17 0z" />
                            <path d="M120 160 q8 -11 17 0 q-8 11 -17 0z" />
                            <path d="M150 168 q8 -11 17 0 q-8 11 -17 0z" />
                            <path d="M104 150 q8 -11 17 0 q-8 11 -17 0z" />
                        </g>

                        <g class="cu-item" data-item="s">
                            <circle cx="150" cy="88" r="21" fill="#6b4630" />
                            <path d="M137 82 l26 12 M163 82 l-26 12" stroke="#e9d3b4" stroke-width="2" />
                        </g>
                    </svg>

                    <!-- Medidor -->
                    <div class="mt-6">

                        <div class="flex items-center justify-between text-[11px] uppercase tracking-[.2em] text-white/55">
                            <span>Umami <strong class="text-[#f0b33c]">旨味</strong></span>
                            <output id="cu-pct">0%</output>
                        </div>

                        <div class="mt-2 h-2 overflow-hidden rounded-full bg-white/10">
                            <div id="cu-barra" class="h-full w-0 rounded-full bg-gradient-to-r from-[#f0b33c] to-[#c72b30] transition-all duration-700"></div>
                        </div>

                    </div>

                    <!-- Ingredientes -->
                    <div class="mt-6 flex flex-wrap gap-3">
                        <button type="button" class="cu-chip" data-ing="k" aria-pressed="false">昆布 Kombu · alga</button>
                        <button type="button" class="cu-chip" data-ing="b" aria-pressed="false">鰹節 Katsuobushi · bonito seco</button>
                        <button type="button" class="cu-chip" data-ing="s" aria-pressed="false">干し椎茸 Shiitake seco</button>
                    </div>

                    <p id="cu-msg" aria-live="polite" class="mt-6 border-t border-white/10 pt-5 text-sm leading-7 text-white/80"></p>

                </div>

            </div>

        </div>

    </section>


    <!-- FECHAMENTO -->
    <section class="bg-[#a3201f] px-6 py-20 text-white md:px-10">

        <div class="mx-auto max-w-7xl">

            <div class="grid gap-12 md:grid-cols-2">

                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[.25em] text-white/65">Antes de comer</p>
                    <p class="cu-sans mt-3 text-5xl font-bold md:text-6xl">いただきます</p>
                    <p class="mt-3 text-sm text-white/75">Itadakimasu · “recebo com gratidão”</p>
                </div>

                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[.25em] text-white/65">Ao terminar</p>
                    <p class="cu-sans mt-3 text-5xl font-bold md:text-6xl">ごちそうさま</p>
                    <p class="mt-3 text-sm text-white/75">Gochisōsama · “obrigado pelo banquete”</p>
                </div>

            </div>

            <div class="mt-14 flex flex-wrap items-center justify-between gap-6 border-t border-white/25 pt-8">

                <p class="max-w-lg text-xs leading-6 text-white/70">
                    À mesa, nunca finque os hashi no arroz: o gesto lembra
                    rituais fúnebres. Apoie-os sempre ao lado do prato.
                </p>

                <a href="#inicio" class="inline-flex items-center gap-3 border border-white/50 px-6 py-3 text-[11px] font-bold uppercase tracking-[.2em] transition hover:bg-white hover:text-[#a3201f]">
                    Voltar ao topo <i class="bi bi-arrow-up"></i>
                </a>

            </div>

        </div>

    </section>

</main>


<script>
document.addEventListener('DOMContentLoaded', () => {

    const caldo = document.getElementById('cu-caldo');
    const barra = document.getElementById('cu-barra');
    const pct = document.getElementById('cu-pct');
    const msg = document.getElementById('cu-msg');
    const chips = document.querySelectorAll('[data-ing]');
    const itens = document.querySelectorAll('[data-item]');

    const cores = {
        '': '#d8e8e4', k: '#d6e0b4', b: '#e8c476', s: '#c9a070',
        kb: '#e6c46a', ks: '#cdb070', bs: '#d9a85f', kbs: '#dcae55'
    };

    const textos = {
        '': 'Água pura. Escolha um ingrediente para começar o caldo.',
        k: 'Só kombu: caldo limpo e suave, rico em glutamato.',
        b: 'Só katsuobushi: aroma defumado e profundo, rico em inosinato.',
        s: 'Só shiitake seco: sabor terroso, rico em guanilato.',
        kb: 'Ichiban dashi, o clássico: glutamato e inosinato se potencializam e o umami dispara.',
        ks: 'Kombu com shiitake: um caldo vegetal e profundo, base da cozinha budista (shōjin).',
        bs: 'Katsuobushi e shiitake: muito sabor, mas falta o glutamato do kombu para multiplicar o efeito.',
        kbs: 'Os três juntos: umami no máximo e muita profundidade.'
    };

    function atualizar() {

        const ativos = { k: false, b: false, s: false };

        chips.forEach((chip) => {
            ativos[chip.dataset.ing] = chip.getAttribute('aria-pressed') === 'true';
        });

        itens.forEach((item) => {
            item.classList.toggle('on', ativos[item.dataset.item]);
        });

        const chave = (ativos.k ? 'k' : '') + (ativos.b ? 'b' : '') + (ativos.s ? 's' : '');

        // Cada ingrediente soma; o kombu multiplica o efeito dos outros dois
        let valor = (ativos.k ? 22 : 0) + (ativos.b ? 22 : 0) + (ativos.s ? 18 : 0);

        if (ativos.k && ativos.b) valor += 40;
        if (ativos.k && ativos.s) valor += 30;

        valor = Math.min(valor, 100);

        caldo.setAttribute('fill', cores[chave]);
        barra.style.width = valor + '%';
        pct.textContent = valor + '%';
        msg.textContent = textos[chave];

    }

    chips.forEach((chip) => {

        chip.addEventListener('click', () => {

            const ligado = chip.getAttribute('aria-pressed') === 'true';

            chip.setAttribute('aria-pressed', String(!ligado));

            atualizar();

        });

    });

    atualizar();

});
</script>

<?php include_once __DIR__ . '/../templates/footer.php'; ?>