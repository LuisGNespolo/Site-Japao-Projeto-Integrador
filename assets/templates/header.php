<?php ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Japão | Cultura e Tradição</title>

    <link href="../../src/output.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-[#f8f5ef] text-[#171717]">

    <!-- MENU -->
    <header class="bg-[#071018] text-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-3 md:px-10">

            <a href="../../index.php" class="flex items-center gap-3">
                <span class="flex h-7 w-7 items-center justify-center rounded-full bg-white">
                    <span class="h-5 w-5 rounded-full bg-[#c9272c]"></span>
                </span>

                <span class="titulo text-xl tracking-wide">JAPÃO</span>
            </a>

            <button id="menuBtn" class="text-2xl md:hidden" aria-label="Abrir menu">
                <i class="bi bi-list"></i>
            </button>

            <div id="menu" class="absolute left-0 top-[58px] z-50 hidden w-full flex-col gap-5 bg-[#071018] px-6 py-6 text-sm md:static md:flex md:w-auto md:flex-row md:items-center md:gap-7 md:bg-transparent md:p-0">
                <a href="../../index.php" class="hover:text-red-400">INÍCIO</a>
                <a href="../pages/futebol.php" class="hover:text-red-400">FUTEBOL</a>
                <a href="../pages/culinaria.php" class="hover:text-red-400">CULINÁRIA</a>
                <a href="../pages/surf.php" class="hover:text-red-400">SURF</a>
                <a href="../pages/patrimonios.php" class="hover:text-red-400">PATRIMÔNIOS</a>
                <a href="../pages/lendas.php" class="hover:text-red-400">LENDAS</a>
                <a href="../pages/explorar.php" class="hover:text-red-400" aria-label="Explorar">
                    <i class="bi bi-search text-lg"></i>
                </a>
            </div>
        </nav>
    </header>

<?php ?>