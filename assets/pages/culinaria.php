
<?php

require_once __DIR__ . '/../../database/conexao.php';

include_once __DIR__ . '/../templates/header.php';

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

function imagemCulinaria(string $chave): string
{
    global $imagensSite;

    return '../../' . ltrim(
        $imagensSite[$chave] ?? '',
        '/'
    );
}

?>


<style>
    .washoku-page {
        --washoku-ink: #132b2c;
        --washoku-deep: #0b2528;
        --washoku-red: #c72b30;
        --washoku-coral: #e56761;
        --washoku-sand: #f5f0e7;
        --washoku-moss: #71856a;
        background: var(--washoku-sand);
        color: var(--washoku-ink);
        overflow: hidden;
    }

    .washoku-page .washoku-hero {
        background:
            linear-gradient(90deg, rgba(6, 25, 27, .94), rgba(6, 25, 27, .67) 48%, rgba(6, 25, 27, .13)),
            url('<?= htmlspecialchars(imagemCulinaria('culinaria_banner')) ?>')center / cover;
    }

    .washoku-page .washoku-paper {
        background-color: var(--washoku-sand);
        background-image: linear-gradient(115deg, rgba(199,43,48,.045) 1px, transparent 1px);
        background-size: 28px 28px;
    }

    .washoku-page .washoku-photo {
        filter: saturate(.86);
        transition: filter .5s ease;
    }

    .washoku-page .overflow-hidden:hover .washoku-photo {
        filter: saturate(1.1);
    }

    .washoku-page .washoku-wave {
        background-image: url("data:image/svg+xml,%3Csvg width='180' height='38' viewBox='0 0 180 38' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 25 C22 5 38 5 60 25 S98 45 120 25 S158 5 180 25' fill='none' stroke='%23c72b30' stroke-width='1.3' opacity='.45'/%3E%3C/svg%3E");
        background-repeat: repeat-x;
        background-position: center;
    }

    .washoku-page .washoku-card {
        position: relative;
        box-shadow: 0 22px 50px -35px rgba(11,37,40,.75);
    }

    .washoku-page .washoku-ingredient {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        color: rgba(255,255,255,.55);
        font-size: .6rem;
        font-weight: 600;
        letter-spacing: .18em;
        text-transform: uppercase;
    }

    .washoku-page .washoku-ingredient::before {
        width: .3rem;
        height: .3rem;
        border-radius: 999px;
        background: var(--washoku-coral);
        content: '';
    }

    .washoku-page .washoku-steam {
        position: absolute;
        bottom: 1.2rem;
        left: 1.2rem;
        display: flex;
        gap: .3rem;
        opacity: .65;
    }

    .washoku-page .washoku-steam span {
        display: block;
        width: .25rem;
        height: 1.8rem;
        border-left: 1px solid rgba(255,255,255,.75);
        border-radius: 50%;
        transform: rotate(12deg);
    }

    .washoku-page .washoku-steam span:nth-child(2) {
        height: 1.25rem;
        transform: translateY(.3rem) rotate(-8deg);
    }

    .washoku-page .washoku-chopsticks {
        position: relative;
        height: 1rem;
    }

    .washoku-page .washoku-chopsticks::before,
    .washoku-page .washoku-chopsticks::after {
        position: absolute;
        top: .4rem;
        right: 0;
        width: 5rem;
        height: 1px;
        background: var(--washoku-red);
        content: '';
        transform: rotate(-8deg);
        transform-origin: right;
    }

    .washoku-page .washoku-chopsticks::after {
        top: .7rem;
        width: 4.2rem;
        opacity: .45;
        transform: rotate(-11deg);
    }

    .washoku-page .washoku-stamp {
        width: 11rem;
        border-bottom: 1px solid rgba(255,255,255,.35);
        border-top: 1px solid rgba(255,255,255,.35);
        padding: .8rem 0;
        text-align: left;
    }

    .washoku-page .washoku-menu-item {
        position: relative;
        border-bottom: 1px solid rgba(19,43,44,.16);
        padding: 1.25rem 1rem 1.25rem 0;
    }

    .washoku-page .washoku-menu-item::after {
        position: absolute;
        right: 0;
        top: 1.6rem;
        width: .55rem;
        height: .55rem;
        border: 1px solid var(--washoku-red);
        border-radius: 50%;
        content: '';
    }

    .washoku-page .washoku-plate {
        border: 1px solid rgba(199,43,48,.35);
        border-radius: 50%;
        box-shadow: inset 0 0 0 7px var(--washoku-sand), inset 0 0 0 8px rgba(199,43,48,.18);
    }

    @media (prefers-reduced-motion: reduce) {
        .washoku-page .washoku-photo { transition: none; }
    }
</style>

<main class="washoku-page font-['Poppins']">

    <!-- ABERTURA -->
    <section id="inicio" class="washoku-hero relative isolate min-h-[720px] overflow-hidden text-white md:min-h-[800px]">
        <div class="relative mx-auto flex min-h-[720px] max-w-7xl flex-col justify-between px-6 pb-12 pt-28 md:min-h-[800px] md:px-10">
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <p class="tracking-[.22em] text-[10px] font-bold uppercase text-white/55">A mesa como paisagem</p>
                    <p class="mt-2 text-sm text-white/75">å’Œé£Ÿ · Washoku</p>
                </div>
                <div class="washoku-stamp hidden text-[10px] font-bold text-[#f08b82] md:block">
                    <span class="block text-[9px] uppercase tracking-[.25em] text-white/50">MENU DU JOUR</span>
                    <span class="mt-1 block font-['Noto_Sans_JP'] text-xl leading-none">ä¸€æ±ä¸‰èœ</span>
                </div>
            </div>

            <div class="relative z-10 max-w-3xl">
                <div class="mb-6 flex items-center gap-3">
                    <span class="h-px w-14 bg-[#c72b30]"></span>
                    <p class="tracking-[.22em] text-[10px] font-bold uppercase text-[#f08b82]">Mar · floresta · estação</p>
                </div>
                <div class="mb-5 flex flex-wrap gap-x-5 gap-y-2">
                    <span class="washoku-ingredient">arroz</span>
                    <span class="washoku-ingredient">maré</span>
                    <span class="washoku-ingredient">tempo</span>
                </div>
                <h1 class="font-['Playfair_Display'] tracking-[-.05em] text-6xl font-semibold leading-[.9] sm:text-7xl md:text-9xl">
                    Comer é<br><span class="text-[#e56761]">contemplar.</span>
                </h1>
                <p class="mt-8 max-w-xl text-sm leading-8 text-white/65 md:text-base">
                    Na culinária japonesa, cada prato nasce do encontro entre
                    natureza, técnica e tempo. Um universo de sabores onde o
                    oceano, os campos e a fauna também chegam à mesa.
                </p>
                <a href="#sabores" class="mt-9 inline-flex items-center gap-3 bg-[#c72b30] px-7 py-4 text-[10px] font-bold uppercase tracking-[.2em] transition hover:-translate-y-1 hover:bg-[#a51f25]">
                    Explorar o washoku <i class="bi bi-arrow-down-right"></i>
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 h-1 w-full bg-gradient-to-r from-[#c72b30] via-[#e56761] to-transparent"></div>
    </section>

    <!-- IDEIA CENTRAL -->
    <section id="historia" class="washoku-paper px-6 py-24 md:px-10 md:py-32">
        <div class="mx-auto grid max-w-7xl gap-14 lg:grid-cols-[.8fr_1.2fr] lg:items-end">
            <div>
                <p class="tracking-[.22em] text-[10px] font-bold text-[#c72b30]">01 / O PRINCÍPIO</p>
                <h2 class="font-['Playfair_Display'] tracking-[-.05em] mt-4 text-5xl font-semibold leading-none md:text-7xl">A natureza<br><span class="text-[#c72b30]">servida.</span></h2>
                <p class="mt-7 max-w-md text-sm leading-8 text-[#53615d]">
                    O washoku valoriza cinco cores, cinco sabores e cinco
                    sentidos. O resultado é uma cozinha equilibrada, sazonal
                    e profundamente ligada ao território japonês.
                </p>
                <div class="mt-9 flex gap-8 border-t border-[#c72b30]/25 pt-6">
                    <div><p class="font-['Playfair_Display'] tracking-[-.05em] text-4xl text-[#c72b30]">5</p><p class="tracking-[.22em] text-[9px] text-[#718078]">SABORES</p></div>
                    <div><p class="font-['Playfair_Display'] tracking-[-.05em] text-4xl text-[#c72b30]">4</p><p class="tracking-[.22em] text-[9px] text-[#718078]">ESTAÃ‡Ã•ES</p></div>
                    <div><p class="font-['Playfair_Display'] tracking-[-.05em] text-4xl text-[#c72b30]">âˆž</p><p class="tracking-[.22em] text-[9px] text-[#718078]">MEMÃ“RIAS</p></div>
                </div>
            </div>

            <div class="relative grid gap-5 sm:grid-cols-2">
                <article class="washoku-card bg-[#0b2528] p-7 text-white sm:translate-y-8">
                    <i class="bi bi-water text-3xl text-[#e56761]"></i>
                    <h3 class="font-['Playfair_Display'] tracking-[-.05em] mt-12 text-3xl">Do oceano</h3>
                    <p class="mt-3 text-sm leading-7 text-white/55">Peixes, algas e marés revelam a relação do Japão com suas águas.</p>
                    <span class="mt-8 block font-['Noto_Sans_JP'] text-5xl text-white/10">海</span>
                </article>
                <article class="washoku-card bg-[#71856a] p-7 text-white">
                    <i class="bi bi-flower1 text-3xl text-white/80"></i>
                    <h3 class="font-['Playfair_Display'] tracking-[-.05em] mt-12 text-3xl">Da estação</h3>
                    <p class="mt-3 text-sm leading-7 text-white/70">A primavera, o outono e cada ingrediente têm sua hora certa.</p>
                    <span class="mt-8 block font-['Noto_Sans_JP'] text-5xl text-white/20">季</span>
                </article>
            </div>
        </div>
    </section>

    <!-- GALERIA DE SABORES -->
    <section id="sabores" class="bg-[#fdfbf7] px-6 py-24 md:px-10 md:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="mb-14 flex flex-wrap items-end justify-between gap-8">
                <div>
                    <p class="tracking-[.22em] text-[10px] font-bold text-[#c72b30]">02 / UM MAPA DE SABORES</p>
                    <h2 class="font-['Playfair_Display'] tracking-[-.05em] mt-4 text-5xl font-semibold leading-none md:text-7xl">Quatro gestos,<br><span class="text-[#c72b30]">uma cultura.</span></h2>
                </div>
                <p class="max-w-sm text-sm leading-7 text-[#53615d]">Texturas, aromas e temperaturas criam uma experiência que começa antes da primeira mordida.</p>
            </div>
            <div class="washoku-chopsticks mb-3 hidden sm:block"></div>

            <div class="grid gap-8 lg:grid-cols-[1fr_.9fr]">
                <div class="divide-y divide-[#132b2c]/10">
                <article class="group washoku-card overflow-hidden bg-white">
                    <div class="washoku-menu-item flex items-center gap-5 bg-white px-5">
                        <div class="washoku-plate h-20 w-20 shrink-0 overflow-hidden p-2"><img 	src="<?= htmlspecialchars(imagemCulinaria('culinaria_sushi')) ?>" alt="Sushi japonês" class="washoku-photo h-full w-full rounded-full object-cover"></div>
                        <div><p class="tracking-[.22em] text-[9px] font-bold text-[#c72b30]">01 / MAR</p><h3 class="font-['Playfair_Display'] tracking-[-.05em] mt-1 text-3xl">Sushi</h3><p class="mt-1 text-xs text-[#68736e]">Precisão, frescor e simplicidade.</p></div>
                    </div>
                </article>
                <article class="group washoku-card overflow-hidden bg-white sm:translate-y-7">
                    <div class="washoku-menu-item flex items-center gap-5 bg-white px-5">
                        <div class="washoku-plate h-20 w-20 shrink-0 overflow-hidden p-2"><img src="<?= htmlspecialchars(imagemCulinaria('culinaria_sashimi')) ?>" alt="Sashimi japonês" class="washoku-photo h-full w-full rounded-full object-cover"></div>
                        <div><p class="tracking-[.22em] text-[9px] font-bold text-[#c72b30]">02 / OCEANO</p><h3 class="font-['Playfair_Display'] tracking-[-.05em] mt-1 text-3xl">Sashimi</h3><p class="mt-1 text-xs text-[#68736e]">A fauna marinha no seu estado mais puro.</p></div>
                    </div>
                </article>
                </div>
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-1">
                <article class="group washoku-card overflow-hidden bg-white">
                    <div class="overflow-hidden relative h-52"><img ssrc="<?= htmlspecialchars(imagemCulinaria('culinaria_ramen')) ?>"rc="../img/culinaria/ramen.png" alt="Ramen japonês" class="washoku-photo h-full w-full object-cover"></div>
                    <div class="washoku-steam" aria-hidden="true"><span></span><span></span></div>
                    <div class="p-5"><p class="tracking-[.22em] text-[9px] font-bold text-[#c72b30]">03 / CALOR</p><h3 class="font-['Playfair_Display'] tracking-[-.05em] mt-2 text-3xl">Ramen</h3><p class="mt-2 text-xs leading-6 text-[#68736e]">Caldo, vapor e conforto em uma tigela.</p></div>
                </article>
                <article class="group washoku-card overflow-hidden bg-white sm:translate-y-7">
                    <div class="overflow-hidden relative h-52"><img src="<?= htmlspecialchars(imagemCulinaria('culinaria_yakisoba')) ?>" alt="Yakisoba japonês" class="washoku-photo h-full w-full object-cover"></div>
                    <div class="p-5"><p class="tracking-[.22em] text-[9px] font-bold text-[#c72b30]">04 / RUA</p><h3 class="font-['Playfair_Display'] tracking-[-.05em] mt-2 text-3xl">Yakisoba</h3><p class="mt-2 text-xs leading-6 text-[#68736e]">O encontro vibrante entre cidade e tradição.</p></div>
                </article>
                </div>
            </div>
        </div>
    </section>

    <!-- FAUNA E TERRITÃ“RIO -->
    <section class="bg-[#0b2528] px-6 py-24 text-white md:px-10 md:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-14 lg:grid-cols-[1fr_1.1fr] lg:items-center">
                <div class="relative min-h-[410px] overflow-hidden">
                    <img src="<?= htmlspecialchars(imagemCulinaria('culinaria_chef')) ?>" alt="Chef japonês preparando alimentos" class="washoku-photo absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0b2528] via-transparent to-transparent"></div>
                    <p class="[writing-mode:vertical-rl] tracking-[.3em] absolute right-5 top-6 text-xs text-white/60">山 · 川 · 海 · 森</p>
                    <div class="absolute bottom-6 left-6">
                        <p class="tracking-[.22em] text-[9px] text-[#e56761]">DO TERRITÃ“RIO Ã€ MESA</p>
                        <p class="font-['Playfair_Display'] tracking-[-.05em] mt-2 text-3xl">Respeitar é cozinhar.</p>
                    </div>
                </div>
                <div>
                    <p class="tracking-[.22em] text-[10px] font-bold text-[#e56761]">03 / FAUNA E PAISAGEM</p>
                    <h2 class="font-['Playfair_Display'] tracking-[-.05em] mt-4 text-5xl font-semibold leading-none md:text-7xl">O Japão<br><span class="text-[#e56761]">vivo.</span></h2>
                    <p class="mt-7 max-w-lg text-sm leading-8 text-white/60">
                        Da carpa koi que atravessa os jardins às garças que
                        acompanham os arrozais, a fauna japonesa inspira
                        símbolos, ingredientes e formas de servir.
                    </p>
                    <div class="mt-9 grid gap-4 sm:grid-cols-3">
                        <div class="border border-white/10 p-5"><span class="text-2xl text-[#e56761]">é¯‰</span><h3 class="mt-5 text-sm font-semibold">Koi</h3><p class="mt-2 text-xs leading-5 text-white/45">Persistência e beleza.</p></div>
                        <div class="border border-white/10 p-5"><span class="text-2xl text-[#e56761]">鶴</span><h3 class="mt-5 text-sm font-semibold">Tsuru</h3><p class="mt-2 text-xs leading-5 text-white/45">Elegância e longevidade.</p></div>
                        <div class="border border-white/10 p-5"><span class="text-2xl text-[#e56761]">é­š</span><h3 class="mt-5 text-sm font-semibold">Sakana</h3><p class="mt-2 text-xs leading-5 text-white/45">O oceano à mesa.</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- RITUAL -->
    <section class="washoku-paper px-6 py-24 md:px-10 md:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="text-center">
                <p class="tracking-[.22em] text-[10px] font-bold text-[#c72b30]">04 / O RITUAL</p>
                <h2 class="font-['Playfair_Display'] tracking-[-.05em] mt-4 text-5xl font-semibold md:text-7xl">Antes do sabor,<br><span class="text-[#c72b30]">vem o cuidado.</span></h2>
                <p class="mx-auto mt-7 max-w-xl text-sm leading-8 text-[#53615d]">A mesa japonesa é uma pausa. Um gesto de gratidão aos ingredientes, às pessoas e à natureza que tornou tudo possível.</p>
            </div>
            <div class="washoku-wave mt-16 h-10"></div>
            <div class="mt-10 grid gap-5 md:grid-cols-3">
                <article class="border-t-2 border-[#c72b30] pt-5"><p class="font-['Playfair_Display'] tracking-[-.05em] text-4xl">01</p><h3 class="mt-4 font-semibold">Itadakimasu</h3><p class="mt-2 text-sm leading-7 text-[#68736e]">Agradecer antes de comer.</p></article>
                <article class="border-t-2 border-[#71856a] pt-5"><p class="font-['Playfair_Display'] tracking-[-.05em] text-4xl">02</p><h3 class="mt-4 font-semibold">Ichiju sansai</h3><p class="mt-2 text-sm leading-7 text-[#68736e]">Uma sopa, três acompanhamentos e equilíbrio.</p></article>
                <article class="border-t-2 border-[#0b2528] pt-5"><p class="font-['Playfair_Display'] tracking-[-.05em] text-4xl">03</p><h3 class="mt-4 font-semibold">Gochisousama</h3><p class="mt-2 text-sm leading-7 text-[#68736e]">Reconhecer o trabalho por trás da refeição.</p></article>
            </div>
        </div>
    </section>

    <section class="bg-[#c72b30] px-6 py-16 text-white md:px-10">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-7">
            <div><p class="tracking-[.22em] text-[10px] font-bold text-white/65">WASHOKU · å’Œé£Ÿ</p><p class="font-['Playfair_Display'] tracking-[-.05em] mt-3 text-4xl md:text-5xl">Uma paisagem que se come.</p></div>
            <a href="#inicio" class="inline-flex items-center gap-3 border border-white/50 px-6 py-3 text-[10px] font-bold uppercase tracking-[.2em] transition hover:bg-white hover:text-[#c72b30]">Voltar ao topo <i class="bi bi-arrow-up"></i></a>
        </div>
    </section>
</main>

<?php include '../../assets/templates/footer.php'; ?>
