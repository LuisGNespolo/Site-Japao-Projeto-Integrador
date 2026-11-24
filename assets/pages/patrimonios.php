<?php

require_once __DIR__ . '/../../database/conexao.php';

$dados = require __DIR__ . '/../templates/dados.php';
$patrimoniosDetalhes = $dados['patrimonios'] ?? [];
$patrimonios = $dados['patrimonios'];

if (!function_exists('e')) {
    function e($texto): string
    {
        return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
    }
}

// Mantém os detalhes históricos já existentes no site.
$detalhesPorNome = [];

foreach ($patrimoniosDetalhes as $detalhe) {
    $detalhesPorNome[$detalhe['nome']] = $detalhe;
}

// Busca os patrimônios cadastrados no administrador.
$patrimonios = [];

$stmt = $conn->prepare("
    SELECT id, nome, descricao, imagem, localizacao, ordem
    FROM patrimonios
    WHERE ativo = 1
    ORDER BY ordem ASC, id ASC
");

if ($stmt && $stmt->execute()) {
    $resultado = $stmt->get_result();

    while ($linha = $resultado->fetch_assoc()) {
        $detalhe = $detalhesPorNome[$linha['nome']] ?? [];

        $patrimonios[] = [
            'id' => $linha['id'],
            'nome' => $linha['nome'],
            'resumo' => $linha['descricao'] ?: ($detalhe['resumo'] ?? ''),
            'imagem' => $linha['imagem'],
            'localizacao' => $linha['localizacao'],
            'periodo' => $detalhe['periodo'] ?? '',
            'historia' => $detalhe['historia'] ?? [],
            'curiosidade' => $detalhe['curiosidade'] ?? ''
        ];
    }

    $stmt->close();
}

// Imagens complementares da página.
$imagensPadrao = [
    'patrimonios_banner' => 'assets/img/patrimonios/banner.png',
    'patrimonios_memoria' => 'assets/img/patrimonios/memoria.png',
    'patrimonios_monte' => 'assets/img/patrimonios/monte.png',
    'patrimonios_santuario' => 'assets/img/patrimonios/santuario.png',
    'patrimonios_castelo' => 'assets/img/patrimonios/castelo.png'
];

// Uma única consulta ao banco (com checagem da conexão)
$imagensBanco = [];

$resultadoImagens = $conn->query("
    SELECT chave, caminho
    FROM imagens_site
");

if ($resultadoImagens) {
    while ($imagem = $resultadoImagens->fetch_assoc()) {
        $chave = $imagem['chave'];
        $caminho = trim($imagem['caminho']);

        if (isset($imagensPadrao[$chave]) && $caminho !== '') {
            $imagensSite[$chave] = $caminho;
    if ($resultado) {
        while ($imagem = $resultado->fetch_assoc()) {
            $imagensBanco[$imagem['chave']] = trim($imagem['caminho']);
        }
    }

    $resultadoImagens->free();
}

$imagensSite = $imagensPadrao;

foreach ($imagensPadrao as $chave => $caminho) {
    if (!empty($imagensBanco[$chave])) {
        $imagensSite[$chave] = $imagensBanco[$chave];
    }
}

function imagemPatrimonio(string $chave): string
{
    global $imagensSite;

    return '../../' . ltrim($imagensSite[$chave] ?? '', '/');
}

// Corrige os caminhos das imagens dos patrimônios.
// Corrige os caminhos das imagens dos patrimônios.
foreach ($patrimonios as &$patrimonio) {
    $caminho = trim((string) $patrimonio['imagem']);

    if ($caminho !== '') {
        $nomeArquivo = basename($caminho);
// Imagem de cada patrimônio (chave "patrimonio_{id}")
foreach ($patrimonios as &$patrimonio) {
    $chave = 'patrimonio_' . $patrimonio['id'];

        $patrimonio['imagem'] = '../img/patrimonios/' . $nomeArquivo;
    }
}

unset($patrimonio);

include_once __DIR__ . '/../templates/header.php';

?>

$total = count($patrimonios);
$numeros = [1 => 'Uma', 2 => 'Duas', 3 => 'Três', 4 => 'Quatro', 5 => 'Cinco', 6 => 'Seis', 7 => 'Sete', 8 => 'Oito', 9 => 'Nove'];
$porExtenso = $numeros[$total] ?? (string) $total;

include_once __DIR__ . '/../templates/header.php';
?>

<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@500;700;800&family=Playfair+Display:ital,wght@1,500;1,600&display=swap" rel="stylesheet">

<style>
    .hp-mincho { font-family: 'Shippori Mincho', 'Noto Sans JP', serif; }

    /* Papel de caderno pontilhado */
    .hp-paper {
        background-color: #f3eee3;
        background-image: radial-gradient(rgba(183, 150, 91, .3) 1px, transparent 1.2px);
        background-size: 24px 24px;
    }

    /* Fita washi */
    .hp-tape {
        position: absolute;
        z-index: 10;
        height: 1.5rem;
        width: 6rem;
        background: rgba(217, 174, 114, .6);
        box-shadow: 0 1px 2px rgba(0, 0, 0, .1);
        transform: rotate(-4deg);
    }

    /* Rota no banner: pontos ligados por tracejado */
    .hp-stop:not(:last-child)::after {
        content: '';
        flex: 1 1 auto;
        min-width: 1.75rem;
        margin: 0 1rem;
        border-top: 1px dashed rgba(217, 174, 114, .55);
    }
    @media (min-width: 768px) {
        .hp-stop { flex: 1 1 0; }
        .hp-stop:last-child { flex: none; }
    }
    .hp-stop.carimbado .hp-dot { background: #b83a36; border-color: #b83a36; color: #fff; }

    /* Carimbo (goshuin) */
    .hp-stamp {
        position: absolute;
        bottom: -1.5rem;
        z-index: 10;
        display: flex;
        height: 88px;
        width: 88px;
        align-items: center;
        justify-content: center;
        border: 1px dashed rgba(23, 43, 43, .35);
        border-radius: 50%;
        background: rgba(251, 248, 241, .92);
        transform: rotate(-12deg);
    }
    .hp-stamp-in {
        display: flex;
        height: 100%;
        width: 100%;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 3px double #b83a36;
        border-radius: 50%;
        color: #b83a36;
        opacity: 0;
        transform: scale(1.7);
        transition: opacity .35s ease, transform .35s cubic-bezier(.2, 1.4, .4, 1);
    }
    .carimbado .hp-stamp { border-color: transparent; background: transparent; }
    .carimbado .hp-stamp-in { opacity: .92; transform: scale(1); }

    @media (prefers-reduced-motion: reduce) { .hp-stamp-in { transition: none; } }
</style>

<main class="font-['Poppins'] text-[#172b2b]">

    <!-- ABERTURA -->
    <section id="inicio" class="relative isolate overflow-hidden bg-[#0a1e1e] text-white">

        <div class="absolute inset-0 -z-20 bg-cover bg-center" style="background-image: url('<?= e(imagemPatrimonio('patrimonios_banner')) ?>');"></div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#0a1e1e]/95 via-[#0a1e1e]/70 to-[#0a1e1e]/15"></div>

        <span class="hp-mincho pointer-events-none absolute -bottom-10 right-2 -z-10 hidden select-none text-[22rem] font-extrabold leading-none text-white/[0.06] md:block" aria-hidden="true">旅</span>

        <div class="mx-auto flex min-h-[680px] max-w-7xl flex-col justify-between gap-16 px-6 pb-10 pt-14 md:min-h-[760px] md:px-10">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-[10px] font-bold uppercase tracking-[.25em] text-white/55">Japan slow travel</p>
                    <p class="mt-2 text-sm text-white/75"><span class="hp-mincho">日本の旅</span> · A viagem pelo Japão</p>
                </div>

                <div class="hidden border border-[#d9ae72]/50 px-5 py-3 text-right md:block">
                    <span class="block text-[9px] uppercase tracking-[.25em] text-white/45">Travel note</span>
                    <span class="mt-1 block text-lg font-semibold leading-none text-[#d9ae72]">KYOTO / 08:40</span>
                </div>

            </div>

            <div class="max-w-3xl">

                <div class="mb-6 flex items-center gap-3">
                    <span class="h-px w-14 bg-[#b7965b]"></span>
                    <p class="text-[10px] font-bold uppercase tracking-[.25em] text-[#d9ae72]">lugares · memória · presença</p>
                </div>

                <h1 class="font-['Playfair_Display'] text-6xl font-semibold leading-[.92] tracking-[-.04em] sm:text-7xl md:text-8xl lg:text-9xl">
                    Viajar é<br><span class="italic text-[#d9ae72]">permanecer.</span>
                </h1>

                <p class="mt-8 max-w-xl text-sm leading-8 text-white/70 md:text-base">
                    Um roteiro pelos lugares onde o Japão antigo continua vivo:
                    montanhas sagradas, santuários, castelos e jardins que
                    transformam turismo em experiência.
                </p>

                <a href="#roteiro" class="mt-9 inline-flex items-center gap-3 bg-[#b83a36] px-7 py-4 text-[10px] font-bold uppercase tracking-[.2em] transition hover:-translate-y-1 hover:bg-[#962d2b]">
                    Começar a viagem <i class="bi bi-arrow-down-right"></i>
                </a>

            </div>

            <!-- Rota: as paradas em evidência -->
            <nav aria-label="Paradas do roteiro" class="border-t border-white/15 pt-6">

                <p class="mb-5 text-[10px] font-bold uppercase tracking-[.25em] text-white/45">Paradas do roteiro</p>

                <ol class="flex items-center overflow-x-auto pb-2 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">

                    <?php foreach ($patrimonios as $i => $item): ?>

                        <li class="hp-stop flex shrink-0 items-center" data-stop="<?= e($item['id']) ?>">

                            <button type="button" data-abrir-modal="modal-<?= e($item['id']) ?>" aria-haspopup="dialog"
                                class="group flex items-center gap-3 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-[#d9ae72]">

                                <span class="hp-dot flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-[#d9ae72]/70 text-xs font-bold text-[#d9ae72] transition group-hover:bg-[#d9ae72] group-hover:text-[#0a1e1e]">
                                    <?= sprintf('%02d', $i + 1) ?>
                                </span>

                                <span>
                                    <span class="block whitespace-nowrap text-sm font-semibold"><?= e($item['nome']) ?></span>
                                    <span class="block whitespace-nowrap text-[10px] uppercase tracking-[.18em] text-white/45"><?= e($item['localizacao']) ?></span>
                                </span>

                            </button>

                        </li>

                    <?php endforeach; ?>

                </ol>

            </nav>

        </div>

        <div class="h-1 w-full bg-gradient-to-r from-[#b83a36] via-[#d9ae72] to-transparent"></div>

    </section>


    <!-- O OLHAR DO VIAJANTE -->
    <section class="hp-paper px-6 py-24 md:px-10 md:py-32">

        <div class="mx-auto max-w-7xl">

            <div class="grid gap-16 lg:grid-cols-[.9fr_1.1fr] lg:items-center">

                <div>

                    <p class="text-[10px] font-bold uppercase tracking-[.25em] text-[#b83a36]">01 / O olhar do viajante</p>

                    <h2 class="mt-4 font-['Playfair_Display'] text-5xl font-semibold leading-none tracking-[-.04em] md:text-7xl">
                        O destino<br><span class="italic text-[#b83a36]">é o caminho.</span>
                    </h2>

                    <p class="mt-8 max-w-md text-sm leading-8 text-[#59635e]">
                        Viajar pelo Japão tradicional é desacelerar. É ouvir o
                        silêncio de um jardim, acompanhar a fumaça de um incenso
                        e perceber que cada detalhe guarda uma história.
                    </p>

                    <p class="mt-4 max-w-md text-sm leading-8 text-[#59635e]">
                        Por lá, viajantes colecionam carimbos em templos,
                        santuários e castelos, pequenas provas de que passaram
                        por ali. Neste roteiro, cada parada que você visitar
                        ganha o seu.
                    </p>

                </div>

                <figure class="relative mx-auto w-full max-w-xl">

                    <span class="hp-tape -top-3 left-10"></span>

                    <div class="bg-white p-3 shadow-[0_30px_60px_-40px_rgba(16,44,43,.9)]">
                        <img
                            src="<?= e(imagemPatrimonio('patrimonios_memoria')) ?>"
                            alt="Arquitetura tradicional japonesa"
                            loading="lazy"
                            class="aspect-[4/3] w-full object-cover saturate-[.85]">
                    </div>

                    <figcaption class="mt-4 flex items-baseline justify-between gap-4 px-1">
                        <span class="font-['Playfair_Display'] text-2xl italic">O tempo mora aqui.</span>
                        <span class="text-[10px] font-bold uppercase tracking-[.25em] text-[#8b7654]">Nota 001</span>
                    </figcaption>

                </figure>

            </div>


            <!-- Quatro gestos -->
            <div class="mt-24 grid gap-10 border-t border-[#b7965b]/40 pt-12 sm:grid-cols-2 lg:grid-cols-4">

                <div>
                    <span class="hp-mincho text-6xl font-bold leading-none text-[#b83a36]">静</span>
                    <p class="mt-5 text-[10px] font-bold uppercase tracking-[.25em] text-[#8b7654]">Sei · Quietude</p>
                    <p class="mt-3 text-sm leading-7 text-[#59635e]">Ouvir o silêncio de um jardim e deixar o tempo desacelerar.</p>
                </div>

                <div>
                    <span class="hp-mincho text-6xl font-bold leading-none text-[#b83a36]">美</span>
                    <p class="mt-5 text-[10px] font-bold uppercase tracking-[.25em] text-[#8b7654]">Bi · Beleza</p>
                    <p class="mt-3 text-sm leading-7 text-[#59635e]">Madeira, pedra e proporção pensadas para durar gerações.</p>
                </div>

                <div>
                    <span class="hp-mincho text-6xl font-bold leading-none text-[#b83a36]">伝</span>
                    <p class="mt-5 text-[10px] font-bold uppercase tracking-[.25em] text-[#8b7654]">Den · Tradição</p>
                    <p class="mt-3 text-sm leading-7 text-[#59635e]">Rituais e ofícios passados de mão em mão.</p>
                </div>

                <div>
                    <span class="hp-mincho text-6xl font-bold leading-none text-[#b83a36]">絆</span>
                    <p class="mt-5 text-[10px] font-bold uppercase tracking-[.25em] text-[#8b7654]">Kizuna · Laços</p>
                    <p class="mt-3 text-sm leading-7 text-[#59635e]">Histórias que unem moradores, peregrinos e viajantes.</p>
                </div>

            </div>

        </div>

    </section>


    <!-- ROTEIRO -->
    <section id="roteiro" class="bg-[#fbf8f1] px-6 py-24 md:px-10 md:py-32">

        <div class="mx-auto max-w-6xl">

            <header class="mx-auto mb-20 max-w-2xl text-center">

                <p class="text-[10px] font-bold uppercase tracking-[.25em] text-[#b83a36]">02 / Roteiro de memória</p>

                <h2 class="mt-4 font-['Playfair_Display'] text-5xl font-semibold leading-none tracking-[-.04em] md:text-7xl">
                    <?= e($porExtenso) ?> paradas,<br><span class="italic text-[#b83a36]">um Japão inteiro.</span>
                </h2>

                <p class="mt-6 text-sm leading-7 text-[#59635e]">
                    Abra cada parada para ler a história e levar o carimbo
                    para o seu caderno de viagem.
                </p>

                <p class="mt-8 text-[11px] font-bold uppercase tracking-[.3em] text-[#8b7654]">
                    <span id="contador">0</span> de <?= $total ?> paradas carimbadas
                </p>

                <p id="viagem-completa" class="mt-5 hidden font-['Playfair_Display'] text-2xl italic text-[#b83a36]">
                    Caderno completo. Que a próxima viagem comece logo.
                </p>

            </header>


            <div class="relative">

                <div class="absolute bottom-4 left-5 top-4 border-l border-dashed border-[#b7965b]/70 md:left-1/2" aria-hidden="true"></div>

                <?php foreach ($patrimonios as $i => $item): ?>
                    <?php $inverte = ($i % 2 === 1); ?>

                    <article data-parada="<?= e($item['id']) ?>" class="relative mb-20 grid gap-8 pl-16 last:mb-0 md:grid-cols-2 md:items-center md:gap-24 md:pl-0">

                        <span class="absolute left-0 top-1 flex h-10 w-10 items-center justify-center rounded-full border border-[#b83a36] bg-[#fbf8f1] text-sm font-bold text-[#b83a36] md:left-1/2 md:-translate-x-1/2">
                            <?= sprintf('%02d', $i + 1) ?>
                        </span>

                        <!-- Foto + carimbo -->
                        <div class="relative <?= $inverte ? 'md:order-2' : '' ?>">

                            <span class="hp-tape -top-3 left-8"></span>

                            <button type="button" data-abrir-modal="modal-<?= e($item['id']) ?>" aria-hidden="true" tabindex="-1"
                                class="group block w-full bg-white p-2 shadow-[0_22px_50px_-35px_rgba(16,44,43,.8)]">
                                <span class="block overflow-hidden">
                                    <img
                                        src="<?= e($item['imagem']) ?>"
                                        alt="<?= e($item['nome']) ?>"
                                        loading="lazy"
                                        class="aspect-[4/3] w-full object-cover saturate-[.8] transition duration-700 group-hover:scale-105 group-hover:saturate-100">
                                </span>
                            </button>

                            <span class="hp-stamp <?= $inverte ? '-left-3 md:-left-5' : '-right-2 md:-right-5' ?>" aria-hidden="true">
                                <span class="hp-stamp-in">
                                    <b class="hp-mincho text-3xl font-extrabold leading-none">旅</b>
                                    <small class="mt-1 text-[9px] font-bold tracking-[.2em]">Nº <?= sprintf('%02d', $i + 1) ?></small>
                                </span>
                            </span>

                        </div>

                        <!-- Texto -->
                        <div class="<?= $inverte ? 'md:order-1 md:text-right' : '' ?>">

                            <p class="text-[10px] font-bold uppercase tracking-[.22em] text-[#b83a36]"><?= e($item['localizacao']) ?></p>

                            <h3 class="mt-3 font-['Playfair_Display'] text-4xl font-semibold leading-tight tracking-[-.03em]"><?= e($item['nome']) ?></h3>

                            <p class="mt-3 text-xs font-semibold uppercase tracking-[.15em] text-[#8b7654]"><?= e($item['periodo']) ?></p>

                            <p class="mt-5 text-sm leading-8 text-[#59635e]"><?= e($item['resumo']) ?></p>

                            <button type="button" data-abrir-modal="modal-<?= e($item['id']) ?>" aria-haspopup="dialog"
                                class="group mt-7 inline-flex items-center gap-3 border-b border-[#b83a36]/60 pb-1 text-[10px] font-bold uppercase tracking-[.22em] text-[#b83a36] transition-all hover:gap-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#b83a36]">
                                Abrir nota de viagem <i class="bi bi-arrow-up-right"></i>
                            </button>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

        </div>

    </section>


    <!-- HORIZONTES -->
    <section class="bg-[#102c2b] px-6 py-24 text-white md:px-10 md:py-32">

        <div class="mx-auto max-w-7xl">

            <div class="mb-14">

                <p class="text-[10px] font-bold uppercase tracking-[.25em] text-[#d9ae72]">03 / Horizontes</p>

                <h2 class="mt-4 font-['Playfair_Display'] text-5xl font-semibold leading-none tracking-[-.04em] md:text-7xl">
                    Da montanha<br><span class="italic text-[#d9ae72]">ao santuário.</span>
                </h2>

            </div>

            <div class="grid gap-5 md:grid-cols-[1.25fr_.75fr]">

                <div class="group relative min-h-[430px] overflow-hidden">
                    <img src="<?= e(imagemPatrimonio('patrimonios_monte')) ?>" alt="Monte Fuji" loading="lazy" class="absolute inset-0 h-full w-full object-cover saturate-[.8] transition duration-700 group-hover:scale-105 group-hover:saturate-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a1e1e]/85 via-transparent to-transparent"></div>
                    <span class="pointer-events-none absolute inset-3 border border-[#d9ae72]/35"></span>
                    <div class="absolute bottom-8 left-8">
                        <p class="text-[9px] font-bold uppercase tracking-[.25em] text-[#d9ae72]">Paisagem cultural</p>
                        <p class="mt-2 font-['Playfair_Display'] text-4xl tracking-[-.03em]">Monte Fuji</p>
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-1">

                    <div class="group relative min-h-[205px] overflow-hidden">
                        <img src="<?= e(imagemPatrimonio('patrimonios_santuario')) ?>" alt="Santuário japonês" loading="lazy" class="absolute inset-0 h-full w-full object-cover saturate-[.8] transition duration-700 group-hover:scale-105 group-hover:saturate-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a1e1e]/85 to-transparent"></div>
                        <span class="pointer-events-none absolute inset-3 border border-[#d9ae72]/35"></span>
                        <p class="absolute bottom-6 left-6 font-['Playfair_Display'] text-2xl tracking-[-.02em]">Espiritualidade</p>
                    </div>

                    <div class="group relative min-h-[205px] overflow-hidden">
                        <img src="<?= e(imagemPatrimonio('patrimonios_castelo')) ?>" alt="Castelo japonês" loading="lazy" class="absolute inset-0 h-full w-full object-cover saturate-[.8] transition duration-700 group-hover:scale-105 group-hover:saturate-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a1e1e]/85 to-transparent"></div>
                        <span class="pointer-events-none absolute inset-3 border border-[#d9ae72]/35"></span>
                        <p class="absolute bottom-6 left-6 font-['Playfair_Display'] text-2xl tracking-[-.02em]">Fortaleza</p>
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- MODAIS (notas de viagem) -->
    <?php foreach ($patrimonios as $item): ?>

        <dialog
            id="modal-<?= e($item['id']) ?>"
            aria-labelledby="titulo-modal-<?= e($item['id']) ?>"
            class="m-auto w-[92%] max-w-3xl overflow-hidden border-t-4 border-[#b83a36] bg-[#f3eee3] p-0 text-left text-[#172b2b] shadow-2xl backdrop:bg-[#0a1e1e]/80 backdrop:backdrop-blur-sm">

            <div class="hp-paper relative max-h-[88vh] overflow-y-auto px-6 pb-10 pt-8 md:px-10">

                <button type="button" data-fechar-modal aria-label="Fechar"
                    class="sticky top-2 z-20 -mb-10 ml-auto flex h-10 w-10 items-center justify-center rounded-full border border-[#172b2b]/15 bg-[#fbf8f1] text-2xl text-[#102c2b] transition hover:border-[#b83a36] hover:bg-[#b83a36] hover:text-white">
                    &times;
                </button>

                <div class="grid gap-8 md:grid-cols-[220px_1fr] md:items-start">

                    <div class="relative">
                        <span class="hp-tape -top-3 left-6"></span>
                        <img src="<?= e($item['imagem']) ?>" alt="<?= e($item['nome']) ?>" class="h-56 w-full bg-white object-cover p-1.5 shadow-md md:h-64">
                    </div>

                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-[.22em] text-[#b83a36]"><?= e($item['localizacao']) ?></p>
                        <h2 id="titulo-modal-<?= e($item['id']) ?>" class="mt-3 font-['Playfair_Display'] text-4xl font-semibold leading-tight tracking-[-.03em]"><?= e($item['nome']) ?></h2>
                        <p class="mt-4 text-xs font-semibold uppercase leading-relaxed tracking-[.15em] text-[#8b7654]"><?= e($item['periodo']) ?></p>
                    </div>

                </div>

                <div class="mt-8 space-y-4 text-sm leading-8 text-[#4f5953]">

                    <?php foreach ($item['historia'] as $paragrafo): ?>
                        <p><?= e($paragrafo) ?></p>
                    <?php endforeach; ?>

                </div>

                <?php if (!empty($item['curiosidade'])): ?>

                    <div class="mt-8 border-l-2 border-[#b7965b] bg-[#fbf8f1] p-5">
                        <p class="text-[10px] font-bold uppercase tracking-[.25em] text-[#8b7654]">Nota de viagem</p>
                        <p class="mt-2 font-['Playfair_Display'] text-lg italic leading-8"><?= e($item['curiosidade']) ?></p>
                    </div>

                <?php endif; ?>

                <button type="button" data-fechar-modal
                    class="mt-9 inline-flex items-center gap-3 bg-[#102c2b] px-7 py-3 text-xs font-bold uppercase tracking-widest text-white transition hover:bg-[#b83a36]">
                    Carimbar no caderno <i class="bi bi-patch-check"></i>
                </button>

            </div>

        </dialog>

    <?php endforeach; ?>


    <!-- ENCERRAMENTO -->
    <section class="bg-[#b83a36] px-6 py-16 text-white md:px-10">

        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-7">

            <div>
                <p class="text-[10px] font-bold uppercase tracking-[.25em] text-white/65"><span class="hp-mincho">旅</span> · Travel slowly</p>
                <p class="mt-3 font-['Playfair_Display'] text-4xl tracking-[-.03em] md:text-5xl">Leve uma história com você.</p>
            </div>

            <a href="#inicio" class="inline-flex items-center gap-3 border border-white/50 px-6 py-3 text-[10px] font-bold uppercase tracking-[.2em] transition hover:bg-white hover:text-[#b83a36]">
                Voltar ao início <i class="bi bi-arrow-up"></i>
            </a>

        </div>

    </section>

</main>


<script>
document.addEventListener('DOMContentLoaded', () => {

    const totalParadas = document.querySelectorAll('article[data-parada]').length;
    const contador = document.getElementById('contador');
    const viagemCompleta = document.getElementById('viagem-completa');

    // Carimba a parada (no roteiro e na rota do banner)
    function carimbar(id) {

        document.querySelectorAll('[data-parada], [data-stop]').forEach((el) => {
            if ((el.dataset.parada || el.dataset.stop) === id) {
                el.classList.add('carimbado');
            }
        });

        const carimbadas = document.querySelectorAll('article[data-parada].carimbado').length;

        contador.textContent = carimbadas;

        if (totalParadas > 0 && carimbadas === totalParadas) {
            viagemCompleta.classList.remove('hidden');
        }

    }

    // Abrir modal
    document.querySelectorAll('[data-abrir-modal]').forEach((botao) => {

        botao.addEventListener('click', () => {

            const modal = document.getElementById(botao.dataset.abrirModal);

            if (modal) {
                modal.showModal();
                document.body.classList.add('overflow-hidden');
            }

        });

    });

    // Configuração dos modais
    document.querySelectorAll('dialog').forEach((modal) => {

        modal.querySelectorAll('[data-fechar-modal]').forEach((botao) => {
            botao.addEventListener('click', () => modal.close());
        });

        modal.addEventListener('click', (evento) => {
            if (evento.target === modal) {
                modal.close();
            }
        });

        modal.addEventListener('close', () => {

            if (!document.querySelector('dialog[open]')) {
                document.body.classList.remove('overflow-hidden');
            }

            carimbar(modal.id.replace('modal-', ''));

        });

    });

});
</script>

<?php include_once __DIR__ . '/../templates/footer.php'; ?>