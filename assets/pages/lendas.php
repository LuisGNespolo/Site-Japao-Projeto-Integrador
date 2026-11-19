
<?php

require_once __DIR__ . '/../../database/conexao.php';

$dados = require __DIR__ . '/../templates/dados.php';

$lendasOriginais = array_values($dados['lendas'] ?? []);

$originaisPorId = [];

foreach ($lendasOriginais as $original) {
    $originaisPorId[$original['id']] = $original;
}

// Busca as imagens cadastradas no painel administrativo.

$imagensSite = [];

$resultadoImagens = $conn->query(
    "SELECT chave, caminho FROM imagens_site"
);

if ($resultadoImagens) {
    while ($imagem = $resultadoImagens->fetch_assoc()) {
        $imagensSite[$imagem['chave']] = $imagem['caminho'];
    }

    $resultadoImagens->free();
}

// Função para carregar as imagens.

if (!function_exists('imagemLenda')) {
    function imagemLenda(string $chave): string
    {
        global $imagensSite;

        $caminho = $imagensSite[$chave]
            ?? 'assets/img/lendas/banner-noite.png';

        return '../../' . ltrim($caminho, '/');
    }
}

// Busca somente as lendas ativas no banco.

$sql = "SELECT
            identificador,
            nome,
            nome_japones,
            romanizacao,
            resumo,
            texto_completo,
            imagem,
            ordem,
            ativo
        FROM lendas
        WHERE ativo = 1
        ORDER BY ordem ASC, id ASC";

$resultadoLendas = $conn->query($sql);

$lendas = [];

if ($resultadoLendas) {

    while ($registro = $resultadoLendas->fetch_assoc()) {

        $id = $registro['identificador'];

        // Recupera os dados originais para preservar
        // informações que não são editadas no painel.

        $lenda = $originaisPorId[$id] ?? [
            'id' => $id,
            'nome' => '',
            'nome_japones' => '',
            'subtitulo' => '',
            'significado' => '',
            'historia' => [],
            'como_age' => [],
            'curiosidade' => '',
            'imagem' => '',
            'banner' => ''
        ];

        // Atualiza as informações editáveis.

        $lenda['id'] = $id;
        $lenda['nome'] = $registro['nome'];
        $lenda['nome_japones'] = $registro['nome_japones'];
        $lenda['romanizacao'] = $registro['romanizacao'];
        $lenda['subtitulo'] = $registro['resumo'];

        // Recupera as seções da história salvas no banco.

        $texto = $registro['texto_completo'] ?? '';

        $secoes = [
            'significado' => 'SIGNIFICADO',
            'historia' => 'HISTÓRIA',
            'como_age' => 'COMO AGE',
            'curiosidade' => 'CURIOSIDADE'
        ];

        $titulos = implode('|', array_map(
            fn($titulo) => preg_quote($titulo, '/'),
            array_values($secoes)
        ));

        foreach ($secoes as $campo => $titulo) {

            $padrao = '/(?:^|\R)' . preg_quote($titulo, '/') .
                '\s*\R(.*?)(?=\R(?:' . $titulos . ')\s*\R|$)/is';

            if (preg_match($padrao, $texto, $matches)) {

                $conteudo = trim($matches[1]);

                if ($campo === 'historia' || $campo === 'como_age') {
                    $lenda[$campo] = preg_split(
                        '/\R{2,}/',
                        $conteudo,
                        -1,
                        PREG_SPLIT_NO_EMPTY
                    );
                } else {
                    $lenda[$campo] = $conteudo;
                }
            }
        }

        // Mantém as imagens originais caso não exista
        // uma imagem cadastrada para aquela lenda.

        $chaveImagem = "lenda_{$id}_imagem";
        $chaveBanner = "lenda_{$id}_banner";

        if (!empty($imagensSite[$chaveImagem])) {
            $lenda['imagem'] = '../../' .
                ltrim($imagensSite[$chaveImagem], '/');
        }

        if (!empty($imagensSite[$chaveBanner])) {
            $lenda['banner'] = '../../' .
                ltrim($imagensSite[$chaveBanner], '/');
        }

        $lendas[] = $lenda;
    }

    $resultadoLendas->free();
}

$total = count($lendas);

$destaques = array_slice($lendas, 0, 3);

if (!function_exists('e')) {
    function e(string $texto): string
    {
        return htmlspecialchars(
            $texto,
            ENT_QUOTES,
            'UTF-8'
        );
    }
}

include_once __DIR__ . '/../templates/header.php';

?>


<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500;1,600&family=Shippori+Mincho:wght@500;700;800&display=swap" rel="stylesheet">

<style>
    /* Chama de vela */
    .lg-flame {
        display: inline-block;
        width: 11px;
        height: 20px;
        border-radius: 50% 50% 50% 50% / 62%    62% 38% 38%;
        background: radial-gradient(circle at 50% 72%, #fff3c4 0, #ffb347 42%, #c72b30 100%);
        box-shadow: 0 0 16px 5px rgba(255, 150, 60, .5);
        transform-origin: 50% 100%;
        animation: lg-flicker 2.6s ease-in-out infinite;
        transition: opacity .9s, transform .9s;
    }
    .lg-flame-sm { width: 7px; height: 13px; box-shadow: 0 0 10px 3px rgba(255, 150, 60, .5); }
    @keyframes lg-flicker {
        0%, 100% { transform: scale(1, 1) rotate(-1deg); }
        25% { transform: scale(.92, 1.08) rotate(1.5deg); opacity: .9; }
        50% { transform: scale(1.05, .95) rotate(-1deg); }
        75% { transform: scale(.96, 1.05) rotate(1deg); opacity: .95; }
    }
    .apagada .lg-flame { animation: none; opacity: 0; transform: scale(.2); }
    .lg-vela.apagada .lg-cera { opacity: .3; }

    /* Lua e névoa */
    .lg-moon {
        background: radial-gradient(circle at 35% 35%, #fbf3dc 0, #eadfc0 55%, #c4b48c 100%);
        box-shadow: 0 0 90px 20px rgba(243, 234, 214, .16), 0 0 200px 60px rgba(199, 43, 48, .14);
        opacity: .9;
    }
    .lg-mist {
        background:
            radial-gradient(ellipse at 20% 100%, rgba(190, 200, 220, .16), transparent 60%),
            radial-gradient(ellipse at 80% 100%, rgba(190, 200, 220, .12), transparent 55%);
        animation: lg-drift 26s ease-in-out infinite alternate;
    }
    @keyframes lg-drift { from { transform: translateX(-4%); } to { transform: translateX(4%); } }

    /* Cartas: ritmo escalonado e estado "vela apagada" */
    .lg-relida { display: none; }
    .lg-card.apagada .lg-acender { display: none; }
    .lg-card.apagada .lg-relida { display: inline; }
    .lg-card { position: relative; }
    .lg-card::after {
        position: absolute;
        right: 1.2rem;
        top: 1.2rem;
        width: .55rem;
        height: .55rem;
        border: 1px solid rgba(255,179,71,.7);
        border-radius: 50%;
        box-shadow: 0 0 12px rgba(255,150,60,.35);
        content: '';
    }
    @media (min-width: 640px) and (max-width: 1023px) { .lg-card:nth-child(even) { margin-top: 3rem; } }
    @media (min-width: 1024px) { .lg-card:nth-child(3n+2) { margin-top: 4rem; } }

    @media (prefers-reduced-motion: reduce) { .lg-flame, .lg-mist { animation: none; } }
</style>

<main class="bg-[#0b0908] font-['Noto_Sans_JP'] text-[#efe6d2]">

    <!-- BANNER -->
    <section class="relative isolate overflow-hidden bg-[#0b0908]">

        <!-- Troque a foto salvando a nova imagem neste caminho -->
        <div class="absolute inset-0 -z-30 bg-cover bg-center" style="background-image: url('<?= e(imagemLenda('lendas_banner')) ?>');"></div>
        <div class="absolute inset-0 -z-20 bg-gradient-to-b from-[#0b0908]/70 via-[#0b0908]/55 to-[#0b0908]"></div>

        <div class="lg-moon absolute -right-16 top-10 -z-10 h-64 w-64 rounded-full md:right-[14%] md:h-80 md:w-80"></div>
        <div class="lg-mist absolute -left-[6%] -right-[6%] bottom-0 -z-10 h-1/2"></div>

        <!-- Torii em silhueta -->
        <svg class="absolute bottom-0 left-1/2 -z-10 w-[520px] max-w-none -translate-x-1/2 text-[#050404]/90" viewBox="0 0 120 100" fill="currentColor" aria-hidden="true">
            <path d="M2 16 Q60 4 118 16 L114 26 Q60 17 6 26 Z" />
            <rect x="14" y="32" width="92" height="6" />
            <rect x="24" y="24" width="9" height="76" />
            <rect x="87" y="24" width="9" height="76" />
        </svg>

        <span class="font-['Shippori_Mincho'] [writing-mode:vertical-rl] absolute left-3 top-28 hidden text-sm tracking-[0.6em] text-[#efe6d2]/35 lg:block">ç¥žè©± · å¦–æ€ª · 伝説</span>

        <div class="relative mx-auto grid min-h-[600px] max-w-7xl items-center gap-12 px-6 pb-32 pt-20 md:px-10 md:pt-28 lg:grid-cols-[1.1fr_1fr]">

            <div class="max-w-xl">

                <span class="inline-flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.35em] text-[#e15a5e]">
                    <span class="h-px w-10 bg-[#c72b30]"></span>
                    ç™¾ç‰©èªž · Hyakumonogatari
                </span>

                <h1 class="font-['Cormorant_Garamond'] mt-6 text-5xl font-semibold italic leading-[1.05] md:text-7xl">
                    Acenda uma vela.<br>
                    Ouça uma <span class="text-[#e15a5e]">lenda.</span>
                </h1>

                <p class="mt-6 max-w-md text-sm leading-8 text-[#efe6d2]/70 md:text-base">
                    Entre deuses, monstros e espíritos, o folclore japonês
                    ainda sussurra quando a noite cai. Cada história é uma
                    chama: ouça até o fim e ela se apaga.
                </p>

                <a href="#lendas"
                    class="group mt-10 inline-flex items-center gap-4 border border-[#c72b30] px-7 py-4 text-xs font-bold uppercase tracking-[0.25em] transition duration-300 hover:bg-[#c72b30]">
                    <span class="lg-flame lg-flame-sm"></span>
                    Começar a noite
                </a>

            </div>

            <!-- As lendas em evidência -->
            <div class="relative hidden h-[480px] lg:block">

                <?php $posicoes = ['left-0 top-16 h-72 w-40', 'left-[11.5rem] top-0 h-80 w-44', 'left-[23.5rem] top-24 h-72 w-40']; ?>

                <?php foreach ($destaques as $k => $d): ?>

                    <figure class="absolute <?= $posicoes[$k] ?> overflow-hidden rounded-t-full border border-[#efe6d2]/20 shadow-[0_0_60px_-15px_rgba(199,43,48,.6)]">
                        <img src="<?= e($d['imagem']) ?>" alt="<?= e($d['nome']) ?>" class="h-full w-full object-cover brightness-75 saturate-75">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0b0908]/80 to-transparent"></div>
                    </figure>

                <?php endforeach; ?>

            </div>

        </div>

    </section>


    <!-- A NOITE DAS CEM VELAS -->
    <section class="border-y border-[#efe6d2]/10 bg-[#0f0d0c] px-6 py-20 md:px-10 md:py-28">

        <div class="mx-auto grid max-w-6xl gap-10 md:grid-cols-[auto_1fr] md:gap-16">

            <div class="hidden items-start gap-5 md:flex">
                <span class="font-['Shippori_Mincho'] [writing-mode:vertical-rl] text-8xl font-extrabold leading-none text-[#c72b30]">ç™¾ç‰©èªž</span>
                <span class="w-px self-stretch bg-gradient-to-b from-[#c72b30] to-transparent"></span>
            </div>

            <div>

                <span class="text-xs font-bold uppercase tracking-[0.3em] text-[#e15a5e]">
                    Hyakumonogatari Kaidankai
                </span>

                <h2 class="font-['Cormorant_Garamond'] mt-4 text-4xl font-semibold italic leading-tight md:text-6xl">
                    A noite das cem velas
                </h2>

                <p class="mt-7 max-w-2xl text-sm leading-8 text-[#efe6d2]/65 md:text-base">
                    No período Edo, ficou famoso um jogo de contar histórias de
                    fantasmas. Cem velas eram acesas num quarto escuro e, a
                    cada história contada, uma delas era apagada. Dizia-se que,
                    quando a última chama se fosse, algo sobrenatural poderia
                    aparecer.
                </p>

                <p class="mt-4 max-w-2xl text-sm leading-8 text-[#efe6d2]/65 md:text-base">
                    Esta página segue o ritual: cada lenda é uma vela. Acenda
                    uma história e, ao fechá-la, sua chama se apaga.
                </p>

                <dl class="mt-10 grid max-w-2xl grid-cols-3 divide-x divide-[#efe6d2]/10 border-y border-[#efe6d2]/10">

                    <div class="px-4 py-6 text-center">
                        <dt class="font-['Shippori_Mincho'] text-3xl text-[#c72b30]">ç¥ž</dt>
                        <dd class="mt-2 text-[11px] uppercase tracking-[0.2em] text-[#efe6d2]/60">Kami<br>deuses</dd>
                    </div>

                    <div class="px-4 py-6 text-center">
                        <dt class="font-['Shippori_Mincho'] text-3xl text-[#c72b30]">å¦–æ€ª</dt>
                        <dd class="mt-2 text-[11px] uppercase tracking-[0.2em] text-[#efe6d2]/60">Yōkai<br>criaturas</dd>
                    </div>

                    <div class="px-4 py-6 text-center">
                        <dt class="font-['Shippori_Mincho'] text-3xl text-[#c72b30]">å¹½éœŠ</dt>
                        <dd class="mt-2 text-[11px] uppercase tracking-[0.2em] text-[#efe6d2]/60">Yūrei<br>fantasmas</dd>
                    </div>

                </dl>

            </div>

        </div>

    </section>


    <!-- AS HISTÃ“RIAS -->
    <section id="lendas" class="bg-[#0b0908] px-6 py-24 md:px-10 md:py-32">

        <div class="mx-auto max-w-7xl">

            <header class="mx-auto mb-20 max-w-2xl text-center">

                <span class="font-['Shippori_Mincho'] text-sm tracking-[0.6em] text-[#c72b30]">伝説</span>

                <h2 class="font-['Cormorant_Garamond'] mt-4 text-4xl font-semibold italic md:text-6xl">
                    As histórias da noite
                </h2>

                <p class="mt-5 text-sm leading-7 text-[#efe6d2]/60">
                    Toque numa vela para ouvir uma lenda. Quando a história
                    terminar, a chama se apaga.
                </p>

                <!-- Velas -->
                <ol class="mt-10 flex flex-wrap items-end justify-center gap-7">

                    <?php foreach ($lendas as $lenda): ?>

                        <li>
                            <button
                                type="button"
                                data-abrir-modal="modal-<?= e($lenda['id']) ?>"
                                data-vela="<?= e($lenda['id']) ?>"
                                aria-haspopup="dialog"
                                aria-label="Abrir a lenda <?= e($lenda['nome']) ?>"
                                class="lg-vela group flex flex-col items-center focus:outline-none focus-visible:ring-2 focus-visible:ring-[#c72b30]">

                                <span class="lg-flame"></span>
                                <span class="lg-cera mt-1 block h-9 w-3 rounded-sm bg-gradient-to-b from-[#efe6d2] to-[#b9ab8c] transition-opacity duration-700"></span>
                                <span class="mt-3 text-[10px] uppercase tracking-[0.2em] text-[#efe6d2]/40 transition group-hover:text-[#efe6d2]">
                                    <?= e($lenda['nome']) ?>
                                </span>

                            </button>
                        </li>

                    <?php endforeach; ?>

                </ol>

                <p class="mt-8 text-[11px] uppercase tracking-[0.3em] text-[#efe6d2]/45">
                    <span id="contador">0</span> de <?= $total ?> histórias contadas
                </p>

                <p id="ultima-vela" class="font-['Cormorant_Garamond'] mt-6 hidden text-2xl italic text-[#e15a5e]">
                    A última vela se apagouâ€¦ e algo, no escuro, começa a se aproximar.
                </p>

            </header>


            <ul class="grid grid-cols-1 gap-x-10 gap-y-20 sm:grid-cols-2 lg:grid-cols-3">

                <?php foreach ($lendas as $i => $lenda): ?>

                    <li class="lg-card" data-card="<?= e($lenda['id']) ?>">

                        <button
                            type="button"
                            data-abrir-modal="modal-<?= e($lenda['id']) ?>"
                            aria-haspopup="dialog"
                            class="group block w-full text-left focus:outline-none">

                            <!-- Arco com a imagem -->
                            <div class="relative overflow-hidden rounded-t-full border border-[#efe6d2]/15 bg-[#14110f] transition duration-700 group-hover:border-[#c72b30]/70 group-hover:shadow-[0_0_70px_-12px_rgba(199,43,48,.55)] group-focus-visible:border-[#c72b30]">

                                <img
                                    src="<?= e($lenda['imagem']) ?>"
                                    alt="<?= e($lenda['nome']) ?>"
                                    loading="lazy"
                                    class="aspect-[3/4] w-full object-cover brightness-[.55] grayscale-[.7] transition duration-700 group-hover:scale-105 group-hover:brightness-90 group-hover:grayscale-0">

                                <div class="absolute inset-0 bg-gradient-to-t from-[#0b0908] via-transparent to-[#0b0908]/50"></div>

                                <span class="absolute left-1/2 top-9 -translate-x-1/2">
                                    <span class="lg-flame block"></span>
                                </span>

                                <span class="font-['Shippori_Mincho'] [writing-mode:vertical-rl] absolute bottom-6 right-5 max-h-[45%] overflow-hidden text-lg text-[#efe6d2]/75">
                                    <?= e($lenda['nome_japones']) ?>
                                </span>

                            </div>

                            <div class="mt-6">

                                <span class="text-[11px] font-semibold tracking-[0.35em] text-[#c72b30]">
                                    Nº <?= sprintf('%02d', $i + 1) ?>
                                </span>

                                <h3 class="font-['Cormorant_Garamond'] mt-2 text-3xl font-semibold italic leading-tight">
                                    <?= e($lenda['nome']) ?>
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-[#efe6d2]/55">
                                    <?= e($lenda['subtitulo']) ?>
                                </p>

                                <span class="mt-5 inline-flex items-center gap-3 border-b border-[#c72b30]/60 pb-1 text-[11px] font-bold uppercase tracking-[0.25em] transition-all duration-300 group-hover:gap-5 group-hover:text-[#e15a5e]">
                                    <span class="lg-acender">Acender esta história</span>
                                    <span class="lg-relida">Vela apagada · ouvir de novo</span>
                                    â†’
                                </span>

                            </div>

                        </button>

                    </li>

                <?php endforeach; ?>

            </ul>

        </div>

    </section>


    <!-- MODAIS (pergaminho) -->
    <?php foreach ($lendas as $lenda): ?>

        <dialog
            id="modal-<?= e($lenda['id']) ?>"
            aria-labelledby="titulo-<?= e($lenda['id']) ?>"
            class="m-auto max-h-[90vh] w-[94%] max-w-3xl overflow-hidden rounded-sm border border-[#efe6d2]/15 bg-[#13100e] p-0 text-left text-[#efe6d2] shadow-2xl backdrop:bg-black/85 backdrop:backdrop-blur-sm">

            <div class="relative max-h-[90vh] overflow-y-auto">

                <!-- Rolo superior -->
                <div class="h-2 bg-gradient-to-b from-[#c72b30] to-[#8b2024]"></div>

                <button
                    type="button"
                    data-fechar-modal
                    aria-label="Fechar"
                    class="sticky top-3 z-20 -mb-[3.25rem] ml-auto mr-3 mt-3 flex h-10 w-10 items-center justify-center rounded-full border border-[#efe6d2]/25 bg-black/70 text-2xl text-white transition hover:border-[#c72b30] hover:bg-[#c72b30]">
                    &times;
                </button>


                <!-- CABEÃ‡ALHO -->
                <div class="relative min-h-[280px] overflow-hidden">

                    <img
                        src="<?= e($lenda['banner']) ?>"
                        alt="<?= e($lenda['nome']) ?>"
                        class="absolute inset-0 h-full w-full object-cover opacity-40 grayscale-[.4]">

                    <div class="absolute inset-0 bg-gradient-to-t from-[#13100e] via-[#13100e]/60 to-black/20"></div>

                    <span class="font-['Shippori_Mincho'] [writing-mode:vertical-rl] absolute right-8 top-20 max-h-40 overflow-hidden text-3xl text-[#c72b30]/80 md:text-4xl">
                        <?= e($lenda['nome_japones']) ?>
                    </span>

                    <div class="relative flex min-h-[280px] flex-col justify-end px-7 pb-8 pt-16 md:px-12">

                        <span class="mb-3 flex items-center gap-3 text-xs font-bold uppercase tracking-[0.3em] text-[#e15a5e]">
                            <span class="lg-flame lg-flame-sm"></span>
                            Folclore japonês
                        </span>

                        <h2 id="titulo-<?= e($lenda['id']) ?>" class="font-['Cormorant_Garamond'] text-4xl font-semibold italic md:text-6xl">
                            <?= e($lenda['nome']) ?>
                        </h2>

                        <p class="mt-3 text-sm text-[#efe6d2]/65">
                            <?= e($lenda['subtitulo']) ?>
                        </p>

                    </div>

                </div>


                <!-- CONTEÃšDO -->
                <div class="px-7 pb-10 md:px-12">

                    <div class="grid gap-5 border-y border-[#efe6d2]/10 py-7 sm:grid-cols-2">

                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c72b30]">Nome japonês</span>
                            <p class="font-['Shippori_Mincho'] mt-2 text-lg"><?= e($lenda['nome_japones']) ?></p>
                        </div>

                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c72b30]">Significado</span>
                            <p class="font-['Cormorant_Garamond'] mt-2 text-xl italic"><?= e($lenda['significado']) ?></p>
                        </div>

                    </div>


                    <div class="py-8">

                        <div class="mb-6 flex items-center gap-3">
                            <span class="h-px w-8 bg-[#c72b30]"></span>
                            <h3 class="font-['Cormorant_Garamond'] text-2xl font-semibold italic">A história</h3>
                        </div>

                        <div class="space-y-5 text-sm leading-8 text-[#efe6d2]/75 md:text-base">

                            <?php foreach ($lenda['historia'] as $paragrafo): ?>
                                <p><?= e($paragrafo) ?></p>
                            <?php endforeach; ?>

                        </div>

                    </div>


                    <?php if (!empty($lenda['como_age'])): ?>

                        <div class="mb-8 border-l-2 border-[#c72b30] bg-white/[0.03] p-6">

                            <h3 class="font-['Cormorant_Garamond'] mb-4 text-xl font-semibold italic text-[#e15a5e]">Como ela age</h3>

                            <div class="space-y-4 text-sm leading-7 text-[#efe6d2]/75">

                                <?php foreach ($lenda['como_age'] as $paragrafo): ?>
                                    <p><?= e($paragrafo) ?></p>
                                <?php endforeach; ?>

                            </div>

                        </div>

                    <?php endif; ?>


                    <?php if (!empty($lenda['curiosidade'])): ?>

                        <div class="rounded-sm border border-[#b18a60]/30 bg-[#b18a60]/5 p-6">

                            <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-[#d6ad7c]">Você sabia?</span>

                            <p class="font-['Cormorant_Garamond'] mt-3 text-lg leading-8 text-[#efe6d2]/80">
                                <?= e($lenda['curiosidade']) ?>
                            </p>

                        </div>

                    <?php endif; ?>


                    <div class="mt-10 border-t border-[#efe6d2]/10 pt-6 text-center">
                        <span class="font-['Cormorant_Garamond'] text-sm italic tracking-widest text-[#efe6d2]/40">
                            â€” A vela se apaga â€”
                        </span>
                    </div>

                </div>

                <!-- Rolo inferior -->
                <div class="h-2 bg-gradient-to-t from-[#c72b30] to-[#8b2024]"></div>

            </div>

        </dialog>

    <?php endforeach; ?>


    <!-- FIM DA NOITE -->
    <section class="border-t border-[#efe6d2]/10 bg-[#0f0d0c] px-6 py-20 text-center">

        <svg class="mx-auto h-12 w-14 text-[#c72b30]" viewBox="0 0 120 100" fill="currentColor" aria-hidden="true">
            <path d="M2 16 Q60 4 118 16 L114 26 Q60 17 6 26 Z" />
            <rect x="14" y="32" width="92" height="6" />
            <rect x="24" y="24" width="9" height="76" />
            <rect x="87" y="24" width="9" height="76" />
        </svg>

        <p class="font-['Cormorant_Garamond'] mx-auto mt-6 max-w-xl text-2xl italic leading-9 text-[#efe6d2]/70">
            O passado permanece vivo nas histórias que continuam sendo contadas.
        </p>

        <span class="font-['Shippori_Mincho'] mt-6 block text-xs tracking-[0.6em] text-[#efe6d2]/35">çµ‚</span>

    </section>

</main>


<!-- JAVASCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', () => {

    const totalVelas = document.querySelectorAll('[data-vela]').length;
    const contador = document.getElementById('contador');
    const ultimaVela = document.getElementById('ultima-vela');

    // Apaga a vela (e marca a carta) de uma lenda já contada
    function apagarVela(id) {

        document.querySelectorAll('[data-vela], [data-card]').forEach((el) => {
            if ((el.dataset.vela || el.dataset.card) === id) {
                el.classList.add('apagada');
            }
        });

        const apagadas = document.querySelectorAll('[data-vela].apagada').length;

        contador.textContent = apagadas;

        if (totalVelas > 0 && apagadas === totalVelas) {
            ultimaVela.classList.remove('hidden');
        }

    }

    // Abrir modal (cartas e velas)
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

        const botaoFechar = modal.querySelector('[data-fechar-modal]');

        // Fechar pelo botão X
        if (botaoFechar) {
            botaoFechar.addEventListener('click', () => {
                modal.close();
            });
        }

        // Fechar clicando fora
        modal.addEventListener('click', (evento) => {

            if (evento.target === modal) {
                modal.close();
            }

        });

        // Restaurar rolagem e apagar a vela
        modal.addEventListener('close', () => {

            if (!document.querySelector('dialog[open]')) {
                document.body.classList.remove('overflow-hidden');
            }

            apagarVela(modal.id.replace('modal-', ''));

        });

    });

});
</script>

<?php include_once '../templates/footer.php'; ?>
