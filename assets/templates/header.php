<?php ?>

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

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-[#f8f5ef] text-[#171717] antialiased">

    <!-- MENU -->
    <header class="sticky top-0 z-50 border-b border-white/10 bg-[#071018]/95 text-white backdrop-blur">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-3 md:px-10">

            <a href="../../index.php" class="group flex items-center gap-3">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white transition group-hover:scale-110">
                    <span class="h-5 w-5 rounded-full bg-[#c9272c]"></span>
                </span>

                <span class="titulo text-xl font-semibold tracking-[0.2em]">JAPÃO</span>
            </a>

            <button id="menuBtn" class="rounded-md p-1 text-2xl transition hover:bg-white/10 md:hidden" aria-label="Abrir menu">
                <i class="bi bi-list"></i>
            </button>

            <div id="menu" class="absolute left-0 top-full z-50 hidden w-full flex-col gap-5 border-t border-white/10 bg-[#071018] px-6 py-6 text-xs font-medium tracking-[0.15em] md:static md:flex md:w-auto md:flex-row md:items-center md:gap-8 md:border-0 md:bg-transparent md:p-0">
                <a href="../../index.php" class="relative transition hover:text-red-400 after:absolute after:-bottom-1.5 after:left-0 after:h-px after:w-0 after:bg-[#c72b30] after:transition-all hover:after:w-full">INÍCIO</a>
                <a href="../pages/futebol.php" class="relative transition hover:text-red-400 after:absolute after:-bottom-1.5 after:left-0 after:h-px after:w-0 after:bg-[#c72b30] after:transition-all hover:after:w-full">FUTEBOL</a>
                <a href="../pages/culinaria.php" class="relative transition hover:text-red-400 after:absolute after:-bottom-1.5 after:left-0 after:h-px after:w-0 after:bg-[#c72b30] after:transition-all hover:after:w-full">CULINÁRIA</a>
                <a href="../pages/surf.php" class="relative transition hover:text-red-400 after:absolute after:-bottom-1.5 after:left-0 after:h-px after:w-0 after:bg-[#c72b30] after:transition-all hover:after:w-full">SURF</a>
                <a href="../pages/patrimonios.php" class="relative transition hover:text-red-400 after:absolute after:-bottom-1.5 after:left-0 after:h-px after:w-0 after:bg-[#c72b30] after:transition-all hover:after:w-full">PATRIMÔNIOS</a>
                <a href="../pages/lendas.php" class="relative transition hover:text-red-400 after:absolute after:-bottom-1.5 after:left-0 after:h-px after:w-0 after:bg-[#c72b30] after:transition-all hover:after:w-full">LENDAS</a>
                <a href="../pages/explorar.php" class="transition hover:text-red-400" aria-label="Explorar">
                    <i class="bi bi-search text-lg"></i>
                </a>
            </div>
        </nav>
    </header>

<?php ?>