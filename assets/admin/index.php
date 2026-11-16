
<?php

session_start();

if (
    !isset($_SESSION["admin_id"]) ||
    !isset($_SESSION["logado"]) ||
    $_SESSION["logado"] !== true
) {
    header("Location: ../login.php");
    exit;
}

require_once __DIR__ . "/../../database/conexao.php";

$nomeAdmin = $_SESSION["admin_nome"] ?? "Administrador";

function contarRegistros($conn, $tabela)
{
    $permitidas = [
        "paginas",
        "secoes",
        "cards",
        "lendas",
        "linha_tempo",
        "patrimonios",
        "habitos_culturais",
        "menu_itens",
        "redes_sociais"
    ];

    if (!in_array($tabela, $permitidas)) {
        return 0;
    }

    $resultado = $conn->query("SELECT COUNT(*) AS total FROM `$tabela`");

    return $resultado ? (int) $resultado->fetch_assoc()["total"] : 0;
}



$totalPaginas = contarRegistros($conn, "paginas");
$totalSecoes = contarRegistros($conn, "secoes");
$totalCards = contarRegistros($conn, "cards");
$totalLendas = contarRegistros($conn, "lendas");
$totalPatrimonios = contarRegistros($conn, "patrimonios");
$totalEventos = contarRegistros($conn, "linha_tempo");


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administração | Japão Integrador</title>

    <link href="../../src/custom.css" rel="stylesheet">
    <link href="../../src/output.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Noto Sans JP', sans-serif;
        }

        .titulo {
            font-family: 'Playfair Display', serif;
        }

        .item-admin {
            transition: .3s ease;
        }

        .item-admin:hover {
            transform: translateY(-5px);
            border-color: #c9272c;
            box-shadow: 0 12px 25px rgba(0, 0, 0, .08);
        }

        .item-admin:hover .icone-admin {
            background: #c9272c;
            color: white;
        }

        .icone-admin {
            transition: .3s ease;
        }
    </style>
</head>

<body class="bg-[#f8f5ef] text-[#171717] antialiased">

    <!-- CABEÇALHO -->

    <header class="sticky top-0 z-50 border-b border-white/10 bg-[#071018]/95 text-white backdrop-blur">

        <nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 md:px-10">

            <a href="../../index.php" class="flex items-center gap-3">

                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white">
                    <span class="h-5 w-5 rounded-full bg-[#c9272c]"></span>
                </span>

                <span class="titulo text-xl font-semibold tracking-[0.2em]">
                    JAPÃO
                </span>

            </a>

            <div class="flex items-center gap-5">

                <span class="hidden text-xs text-white/60 sm:block">
                    Olá, <?= htmlspecialchars($nomeAdmin) ?>
                </span>

                
                <a href="javascript:void(0)" onclick="confirmarSaida()"
                class="bg-red-700 hover:bg-red-800 text-white px-5 py-2 rounded-lg">
                    <i class="bi bi-box-arrow-right mr-2"></i>
                    Sair
                </a>


            </div>

        </nav>

    </header>


    <main>

        <!-- APRESENTAÇÃO -->

        <section class="relative overflow-hidden bg-[#071018] text-white">

            <div class="absolute right-8 top-0 hidden select-none font-serif text-[230px] font-bold leading-none text-white/[0.05] md:block">
                管
            </div>

            <div class="relative mx-auto max-w-7xl px-6 py-16 md:px-10 md:py-20">

                <div class="mb-5 flex items-center gap-3">

                    <span class="h-px w-10 bg-[#c9272c]"></span>

                    <p class="text-xs font-bold uppercase tracking-[0.35em] text-red-300">
                        Área administrativa
                    </p>

                </div>

                <h1 class="titulo max-w-2xl text-4xl font-semibold leading-tight md:text-6xl">
                    Gerencie seu site
                    <span class="text-[#e05257]">com facilidade.</span>
                </h1>

                <p class="mt-6 max-w-xl text-sm leading-8 text-gray-300 md:text-base">
                    Bem-vindo ao painel de administração do Japão Integrador.
                    Escolha o conteúdo que deseja atualizar e mantenha seu site sempre organizado.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-4">

                    <a href="#gerenciar"
                        class="inline-flex items-center gap-3 bg-[#c9272c] px-6 py-4 text-xs font-bold uppercase tracking-[0.15em] transition hover:bg-[#a51e23]">
                        Começar a editar
                        <i class="bi bi-arrow-down"></i>
                    </a>

                    <a href="../../index.php" target="_blank"
                        class="inline-flex items-center gap-3 border border-white/30 px-6 py-4 text-xs font-bold uppercase tracking-[0.15em] transition hover:border-white hover:bg-white hover:text-[#071018]">
                        Visualizar site
                        <i class="bi bi-box-arrow-up-right"></i>
                    </a>

                </div>

            </div>

            <div class="absolute bottom-0 left-0 h-1 w-1/3 bg-[#c9272c]"></div>

        </section>


        <!-- CONTEÚDO -->

        <div class="mx-auto max-w-7xl px-6 py-14 md:px-10 md:py-16">


            <!-- RESUMO -->

            <section class="mb-16">

                <div class="mb-7">

                    <div class="mb-3 h-1 w-10 rounded-full bg-[#c9272c]"></div>

                    <h2 class="titulo text-3xl font-bold">
                        Resumo do site
                    </h2>

                    <p class="mt-2 text-sm text-[#82766e]">
                        Confira os conteúdos cadastrados no sistema.
                    </p>

                </div>


                <div class="grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-6">

                    <div class="border border-[#e8dfd2] bg-white p-5">
                        <i class="bi bi-file-earmark-text text-xl text-[#c9272c]"></i>
                        <p class="mt-5 text-3xl font-bold"><?= $totalPaginas ?></p>
                        <p class="mt-1 text-xs text-[#82766e]">Páginas</p>
                    </div>

                    <div class="border border-[#e8dfd2] bg-white p-5">
                        <i class="bi bi-layout-text-window text-xl text-[#c9272c]"></i>
                        <p class="mt-5 text-3xl font-bold"><?= $totalSecoes ?></p>
                        <p class="mt-1 text-xs text-[#82766e]">Seções</p>
                    </div>

                    <div class="border border-[#e8dfd2] bg-white p-5">
                        <i class="bi bi-grid text-xl text-[#c9272c]"></i>
                        <p class="mt-5 text-3xl font-bold"><?= $totalCards ?></p>
                        <p class="mt-1 text-xs text-[#82766e]">Cards</p>
                    </div>

                    <div class="border border-[#e8dfd2] bg-white p-5">
                        <i class="bi bi-book text-xl text-[#c9272c]"></i>
                        <p class="mt-5 text-3xl font-bold"><?= $totalLendas ?></p>
                        <p class="mt-1 text-xs text-[#82766e]">Lendas</p>
                    </div>

                    <div class="border border-[#e8dfd2] bg-white p-5">
                        <i class="bi bi-building text-xl text-[#c9272c]"></i>
                        <p class="mt-5 text-3xl font-bold"><?= $totalPatrimonios ?></p>
                        <p class="mt-1 text-xs text-[#82766e]">Patrimônios</p>
                    </div>

                    <div class="border border-[#e8dfd2] bg-white p-5">
                        <i class="bi bi-clock-history text-xl text-[#c9272c]"></i>
                        <p class="mt-5 text-3xl font-bold"><?= $totalEventos ?></p>
                        <p class="mt-1 text-xs text-[#82766e]">Eventos históricos</p>
                    </div>

                </div>

            </section>


            <!-- GERENCIAMENTO -->

            <section id="gerenciar">

                <div class="mb-8">

                    <div class="mb-3 h-1 w-10 rounded-full bg-[#c9272c]"></div>

                    <h2 class="titulo text-3xl font-bold">
                        Gerenciar conteúdos
                    </h2>

                    <p class="mt-2 text-sm text-[#82766e]">
                        Selecione uma das categorias para realizar alterações.
                    </p>

                </div>


                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">


                    <!-- PÁGINAS -->

                    <a href="paginas.php" class="item-admin group border border-[#e8dfd2] bg-white p-7">

                        <div class="icone-admin flex h-12 w-12 items-center justify-center rounded-full bg-[#f8e9e9] text-xl text-[#c9272c]">
                            <i class="bi bi-file-earmark-richtext"></i>
                        </div>

                        <h3 class="mt-6 text-lg font-bold">
                            Páginas do site
                        </h3>

                        <p class="mt-2 text-sm leading-7 text-[#82766e]">
                            Edite os títulos, textos e informações principais de cada página.
                        </p>

                        <div class="mt-6 flex items-center justify-between border-t border-[#eee7df] pt-4">

                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c9272c]">
                                Editar páginas
                            </span>

                            <i class="bi bi-arrow-right text-[#c9272c]"></i>

                        </div>

                    </a>


                    <!-- SEÇÕES -->

                    <a href="secoes.php" class="item-admin group border border-[#e8dfd2] bg-white p-7">

                        <div class="icone-admin flex h-12 w-12 items-center justify-center rounded-full bg-[#f8e9e9] text-xl text-[#c9272c]">
                            <i class="bi bi-layout-text-window"></i>
                        </div>

                        <h3 class="mt-6 text-lg font-bold">
                            Seções
                        </h3>

                        <p class="mt-2 text-sm leading-7 text-[#82766e]">
                            Organize e atualize os blocos de conteúdo presentes nas páginas.
                        </p>

                        <div class="mt-6 flex items-center justify-between border-t border-[#eee7df] pt-4">

                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c9272c]">
                                Editar seções
                            </span>

                            <i class="bi bi-arrow-right text-[#c9272c]"></i>

                        </div>

                    </a>


                    <!-- CARDS -->

                    <a href="cards.php" class="item-admin group border border-[#e8dfd2] bg-white p-7">

                        <div class="icone-admin flex h-12 w-12 items-center justify-center rounded-full bg-[#f8e9e9] text-xl text-[#c9272c]">
                            <i class="bi bi-grid"></i>
                        </div>

                        <h3 class="mt-6 text-lg font-bold">
                            Cards e informações
                        </h3>

                        <p class="mt-2 text-sm leading-7 text-[#82766e]">
                            Altere os cartões, suas descrições, imagens e links.
                        </p>

                        <div class="mt-6 flex items-center justify-between border-t border-[#eee7df] pt-4">

                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c9272c]">
                                Editar cards
                            </span>

                            <i class="bi bi-arrow-right text-[#c9272c]"></i>

                        </div>

                    </a>


                    <!-- IMAGENS -->

                    <a href="imagens.php" class="item-admin group border border-[#e8dfd2] bg-white p-7">

                        <div class="icone-admin flex h-12 w-12 items-center justify-center rounded-full bg-[#f8e9e9] text-xl text-[#c9272c]">
                            <i class="bi bi-images"></i>
                        </div>

                        <h3 class="mt-6 text-lg font-bold">
                            Imagens do site
                        </h3>

                        <p class="mt-2 text-sm leading-7 text-[#82766e]">
                            Atualize as fotografias, banners e imagens utilizadas nas páginas.
                        </p>

                        <div class="mt-6 flex items-center justify-between border-t border-[#eee7df] pt-4">

                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c9272c]">
                                Editar imagens
                            </span>

                            <i class="bi bi-arrow-right text-[#c9272c]"></i>

                        </div>

                    </a>


                    <!-- LENDAS -->

                    <a href="lendas.php" class="item-admin group border border-[#e8dfd2] bg-white p-7">

                        <div class="icone-admin flex h-12 w-12 items-center justify-center rounded-full bg-[#f8e9e9] text-xl text-[#c9272c]">
                            <i class="bi bi-book"></i>
                        </div>

                        <h3 class="mt-6 text-lg font-bold">
                            Lendas japonesas
                        </h3>

                        <p class="mt-2 text-sm leading-7 text-[#82766e]">
                            Gerencie as histórias, descrições e imagens das lendas.
                        </p>

                        <div class="mt-6 flex items-center justify-between border-t border-[#eee7df] pt-4">

                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c9272c]">
                                Editar lendas
                            </span>

                            <i class="bi bi-arrow-right text-[#c9272c]"></i>

                        </div>

                    </a>


                    <!-- PATRIMÔNIOS -->

                    <a href="patrimonios.php" class="item-admin group border border-[#e8dfd2] bg-white p-7">

                        <div class="icone-admin flex h-12 w-12 items-center justify-center rounded-full bg-[#f8e9e9] text-xl text-[#c9272c]">
                            <i class="bi bi-building"></i>
                        </div>

                        <h3 class="mt-6 text-lg font-bold">
                            Patrimônios
                        </h3>

                        <p class="mt-2 text-sm leading-7 text-[#82766e]">
                            Atualize os patrimônios, suas informações e fotografias.
                        </p>

                        <div class="mt-6 flex items-center justify-between border-t border-[#eee7df] pt-4">

                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c9272c]">
                                Editar patrimônios
                            </span>

                            <i class="bi bi-arrow-right text-[#c9272c]"></i>

                        </div>

                    </a>


                    <!-- OUTROS CONTEÚDOS -->

                    <a href="outros-conteudos.php" class="item-admin group border border-[#e8dfd2] bg-white p-7">

                        <div class="icone-admin flex h-12 w-12 items-center justify-center rounded-full bg-[#f8e9e9] text-xl text-[#c9272c]">
                            <i class="bi bi-collection"></i>
                        </div>

                        <h3 class="mt-6 text-lg font-bold">
                            Outros conteúdos
                        </h3>

                        <p class="mt-2 text-sm leading-7 text-[#82766e]">
                            Gerencie hábitos culturais, linha do tempo e outros registros.
                        </p>

                        <div class="mt-6 flex items-center justify-between border-t border-[#eee7df] pt-4">

                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c9272c]">
                                Gerenciar
                            </span>

                            <i class="bi bi-arrow-right text-[#c9272c]"></i>

                        </div>

                    </a>


                    <!-- CONFIGURAÇÕES -->

                    <a href="configuracoes.php" class="item-admin group border border-[#e8dfd2] bg-white p-7">

                        <div class="icone-admin flex h-12 w-12 items-center justify-center rounded-full bg-[#f8e9e9] text-xl text-[#c9272c]">
                            <i class="bi bi-gear"></i>
                        </div>

                        <h3 class="mt-6 text-lg font-bold">
                            Configurações
                        </h3>

                        <p class="mt-2 text-sm leading-7 text-[#82766e]">
                            Altere as configurações gerais e informações do projeto.
                        </p>

                        <div class="mt-6 flex items-center justify-between border-t border-[#eee7df] pt-4">

                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c9272c]">
                                Configurar
                            </span>

                            <i class="bi bi-arrow-right text-[#c9272c]"></i>

                        </div>

                    </a>

                </div>

            </section>


            <!-- RODAPÉ -->

            <footer class="mt-16 border-t border-[#e8dfd2] py-7">

                <div class="flex flex-col items-center justify-between gap-3 text-xs text-[#82766e] sm:flex-row">

                    <p>
                        Japão Integrador · Painel Administrativo
                    </p>

                    <p class="tracking-[0.2em]">
                        日本 — CULTURA E TRADIÇÃO
                    </p>

                </div>

            </footer>

        </div>

    </main>

    
<script>
function confirmarSaida() {

    // Pergunta se o administrador deseja sair
    let confirmar = confirm("Tem certeza que deseja sair?");

    // IF: verifica se a pessoa confirmou
    if (confirmar) {

        // Mostra a mensagem de saída
        alert("Você está sendo deslogado...");

        // Leva para o arquivo que encerra a sessão
        window.location.href = "../logout.php";

    } else {

        // Caso a pessoa cancele
        alert("Saída cancelada!");

    }

}
</script>


</body>
</html>
