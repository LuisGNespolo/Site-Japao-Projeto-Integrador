<?php
// Página atual: usada para destacar o link ativo no menu
$paginaAtual = basename($_SERVER['SCRIPT_NAME']);

$menuLinks = [
    ['label' => 'Início',      'kanji' => 'ホーム',     'href' => '../../index.php',          'arquivo' => 'index.php'],
    ['label' => 'Futebol',     'kanji' => 'サッカー',   'href' => '../pages/futebol.php',     'arquivo' => 'futebol.php'],
    ['label' => 'Culinária',   'kanji' => '料理',       'href' => '../pages/culinaria.php',   'arquivo' => 'culinaria.php'],
    ['label' => 'Surf',        'kanji' => 'サーフィン', 'href' => '../pages/surf.php',        'arquivo' => 'surf.php'],
    ['label' => 'Patrimônios', 'kanji' => '遺産',       'href' => '../pages/patrimonios.php', 'arquivo' => 'patrimonios.php'],
    ['label' => 'Lendas',      'kanji' => '伝説',       'href' => '../pages/lendas.php',      'arquivo' => 'lendas.php'],
];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Japão | Cultura e Tradição</title>

    <link href="../../src/custom.css" rel="stylesheet">
    <link href="../../src/output.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Playfair+Display:wght@500;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-[#f8f5ef] text-[#171717] antialiased">

    <!-- HEADER INTERNO -->
    <header class="relative z-50 bg-[#071018] font-['Poppins'] text-white">

        <nav class="mx-auto flex h-20 max-w-7xl items-stretch justify-between px-6 md:h-24 md:px-10">

            <!-- LOGO (mesma da home) -->
            <a href="../../index.php"
                class="group flex shrink-0 items-center gap-4 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white">

                <span class="flex h-12 w-12 items-center justify-center rounded-full bg-[#c72b30] font-['Noto_Sans_JP'] text-2xl font-bold text-white shadow-lg ring-1 ring-white/30 transition duration-300 group-hover:bg-white group-hover:text-[#c72b30] md:h-14 md:w-14 md:text-3xl">
                    日
                </span>

                <span class="font-['Playfair_Display'] text-2xl font-semibold tracking-[0.06em] text-white drop-shadow-md md:text-3xl">
                    Japão
                </span>

            </a>


            <!-- BOTÃO MOBILE -->
            <button
                id="menuBtn"
                type="button"
                aria-label="Abrir menu"
                aria-expanded="false"
                aria-controls="menu"
                class="flex h-11 w-11 items-center justify-center self-center rounded-full border border-white/30 bg-black/20 text-xl text-white backdrop-blur-md transition hover:bg-[#c72b30] lg:hidden">
                <i class="bi bi-list"></i>
            </button>


            <!-- MENU: painel no mobile, abas em colunas no desktop -->
            <div
                id="menu"
                class="absolute left-0 top-full hidden w-full flex-col border-t border-white/10 bg-[#071018]/95 px-6 shadow-2xl backdrop-blur-xl lg:static lg:flex lg:w-auto lg:flex-row lg:border-0 lg:bg-transparent lg:px-0 lg:shadow-none lg:backdrop-blur-none">

                <?php foreach ($menuLinks as $link): ?>
                    <?php $ativo = ($paginaAtual === $link['arquivo']); ?>

                    <a href="<?= $link['href'] ?>"
                        <?= $ativo ? 'aria-current="page"' : '' ?>
                        class="group relative flex items-center justify-between border-b border-white/10 py-5 text-base font-medium transition-colors duration-300 last:border-b-0 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[-4px] focus-visible:outline-white lg:flex-col lg:items-start lg:justify-center lg:gap-1 lg:border-b-0 lg:border-l lg:border-white/10 lg:px-6 lg:py-0 lg:last:border-r <?= $ativo ? 'text-white lg:bg-white/[0.04]' : 'text-white/70 hover:text-white lg:hover:bg-white/[0.03]' ?>">

                        <!-- barra vermelha no topo da aba: página atual / hover (desktop) -->
                        <span class="absolute left-0 top-0 hidden h-[3px] w-full origin-left bg-[#c72b30] transition-transform duration-300 lg:block <?= $ativo ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' ?>"></span>

                        <!-- palavra em japonês: à direita no mobile, acima do nome no desktop -->
                        <span class="order-2 font-['Noto_Sans_JP'] text-xs font-normal text-white/40 lg:order-1 lg:text-[10px] lg:tracking-[0.2em]">
                            <?= $link['kanji'] ?>
                        </span>

                        <span class="order-1 lg:order-2 lg:text-sm">
                            <?= $link['label'] ?>
                        </span>

                    </a>

                <?php endforeach; ?>

            </div>

        </nav>

        <!-- FAIXA INFERIOR (mesma da home) -->
        <div class="h-[3px] bg-gradient-to-r from-[#c72b30] via-[#8b2024] to-transparent"></div>

    </header>   