
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
$mensagem = "";
$tipoMensagem = "sucesso";

function e($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
}

// EXCLUIR SEÇÃO

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["excluir"])) {

    $id = (int) ($_POST["id"] ?? 0);

    try {
        $stmt = $conn->prepare("DELETE FROM secoes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        $mensagem = "Seção excluída com sucesso!";

    } catch (mysqli_sql_exception $erro) {

        $mensagem = "Não foi possível excluir. Verifique se existem cards vinculados a esta seção.";
        $tipoMensagem = "erro";
    }
}

// SALVAR SEÇÃO

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) {

    $id = (int) ($_POST["id"] ?? 0);
    $paginaId = (int) ($_POST["pagina_id"] ?? 0);

    $chave = trim($_POST["chave"] ?? "");
    $titulo = trim($_POST["titulo"] ?? "");
    $texto = trim($_POST["texto"] ?? "");
    $imagem = trim($_POST["imagem"] ?? "");
    $ordem = (int) ($_POST["ordem"] ?? 0);
    $ativo = isset($_POST["ativo"]) ? 1 : 0;

    if ($paginaId <= 0 || $chave === "" || $titulo === "") {

        $mensagem = "Preencha a página, a chave e o título da seção.";
        $tipoMensagem = "erro";

    } else {

        try {

            if ($id > 0) {

                $sql = "UPDATE secoes SET
                    pagina_id = ?,
                    chave = ?,
                    titulo = ?,
                    texto = ?,
                    imagem = ?,
                    ordem = ?,
                    ativo = ?
                    WHERE id = ?";

                $stmt = $conn->prepare($sql);

                $stmt->bind_param(
                    "issssiii",
                    $paginaId,
                    $chave,
                    $titulo,
                    $texto,
                    $imagem,
                    $ordem,
                    $ativo,
                    $id
                );

                $stmt->execute();
                $stmt->close();

                $mensagem = "Seção atualizada com sucesso!";

            } else {

                $sql = "INSERT INTO secoes (
                    pagina_id,
                    chave,
                    titulo,
                    texto,
                    imagem,
                    ordem,
                    ativo
                ) VALUES (?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);

                $stmt->bind_param(
                    "issssii",
                    $paginaId,
                    $chave,
                    $titulo,
                    $texto,
                    $imagem,
                    $ordem,
                    $ativo
                );

                $stmt->execute();
                $stmt->close();

                $mensagem = "Seção cadastrada com sucesso!";
            }

        } catch (mysqli_sql_exception $erro) {

            if ($erro->getCode() == 1062) {
                $mensagem = "Essa chave já está cadastrada. Escolha outra.";
            } else {
                $mensagem = "Ocorreu um erro ao salvar a seção. Confira os dados.";
            }

            $tipoMensagem = "erro";
        }
    }
}

// BUSCAR PÁGINA PARA EDIÇÃO

$secaoEdicao = null;

if (isset($_GET["editar"])) {

    $idEditar = (int) $_GET["editar"];

    $stmt = $conn->prepare("SELECT * FROM secoes WHERE id = ?");
    $stmt->bind_param("i", $idEditar);
    $stmt->execute();

    $resultadoEdicao = $stmt->get_result();
    $secaoEdicao = $resultadoEdicao->fetch_assoc();

    $stmt->close();
}

// LISTAR PÁGINAS PARA O SELECT

$resultadoPaginas = $conn->query("
    SELECT id, titulo
    FROM paginas
    ORDER BY titulo ASC
");

$paginas = $resultadoPaginas->fetch_all(MYSQLI_ASSOC);

// LISTAR SEÇÕES

$sqlSecoes = "
    SELECT
        secoes.*,
        paginas.titulo AS nome_pagina
    FROM secoes
    INNER JOIN paginas ON secoes.pagina_id = paginas.id
    ORDER BY paginas.titulo ASC, secoes.ordem ASC, secoes.id ASC
";

$resultadoSecoes = $conn->query($sqlSecoes);
$secoes = $resultadoSecoes->fetch_all(MYSQLI_ASSOC);

$editando = $secaoEdicao !== null;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Seções | Administração Japão</title>

    <link rel="stylesheet" href="../../src/output.css">

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

        .botao {
            transition: .25s ease;
        }

        .botao:hover {
            transform: translateY(-2px);
        }

        .campo {
            width: 100%;
            border: 1px solid #e8dfd2;
            background: #fff;
            padding: 12px 14px;
            outline: none;
            transition: .2s;
            font-size: 13px;
        }

        .campo:focus {
            border-color: #c9272c;
            box-shadow: 0 0 0 3px rgba(201, 39, 44, .08);
        }

        .campo-label {
            display: block;
            margin-bottom: 8px;
            font-size: 11px;
            font-weight: 700;
            color: #51483f;
        }
    </style>
</head>

<body class="min-h-screen bg-[#f8f5ef] text-[#171717]">

    <!-- CABEÇALHO -->

    <header class="bg-[#172334] text-white shadow-md">

        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-5">

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#e45a5e]">
                    Japão
                </p>

                <h1 class="mt-1 text-2xl font-semibold">
                    Gerenciar seções
                </h1>
            </div>

            <a href="index.php" class="inline-flex items-center gap-2 rounded-lg border border-white/20 px-4 py-2 text-sm transition hover:bg-white/10">

                <i class="bi bi-arrow-left"></i>
                Voltar ao painel

            </a>

        </div>

    </header>


    <main class="mx-auto max-w-7xl px-6 py-10 md:px-10">

        <!-- NAVEGAÇÃO -->

        <div class="mb-8 flex flex-wrap items-center gap-2 text-xs text-[#82766e]">

            <a href="index.php" class="transition hover:text-[#c9272c]">
                Painel administrativo
            </a>

            <i class="bi bi-chevron-right text-[9px]"></i>

            <span class="font-semibold text-[#c9272c]">
                Seções
            </span>

        </div>


        <!-- TÍTULO -->

        <section class="mb-10 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">

            <div>

                <p class="mb-3 text-[10px] font-bold uppercase tracking-[0.3em] text-[#c9272c]">
                    Gerenciamento de conteúdo
                </p>

                <h1 class="titulo text-4xl font-semibold">
                    Seções do site
                </h1>

                <p class="mt-3 max-w-xl text-sm leading-7 text-[#82766e]">
                    Organize os blocos de conteúdo, textos e imagens que compõem cada página.
                </p>

            </div>

            <a href="index.php" class="botao inline-flex items-center gap-2 border border-[#e8dfd2] bg-white px-5 py-3 text-xs font-bold uppercase tracking-wider hover:border-[#c9272c] hover:text-[#c9272c]">
                <i class="bi bi-arrow-left"></i>
                Voltar ao painel
            </a>

        </section>


        <!-- MENSAGEM -->

        <?php if ($mensagem !== ""): ?>

            <div class="mb-7 flex items-center gap-3 border px-5 py-4 text-sm
                <?= $tipoMensagem === "erro"
                    ? "border-red-200 bg-red-50 text-red-700"
                    : "border-green-200 bg-green-50 text-green-700" ?>">

                <i class="bi <?= $tipoMensagem === "erro" ? "bi-exclamation-circle" : "bi-check-circle" ?> text-lg"></i>

                <?= e($mensagem) ?>

            </div>

        <?php endif; ?>


        <div class="grid items-start gap-8 lg:grid-cols-[1fr_380px]">


            <!-- LISTA DE SEÇÕES -->

            <section>

                <div class="mb-5">

                    <h2 class="titulo text-2xl font-semibold">
                        Seções cadastradas
                    </h2>

                    <p class="mt-1 text-xs text-[#82766e]">
                        <?= count($secoes) ?> seções encontradas
                    </p>

                </div>


                <div class="overflow-hidden border border-[#e8dfd2] bg-white">

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[680px] text-left">

                            <thead class="border-b border-[#eee7df] bg-[#fbf9f5]">

                                <tr>

                                    <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-[#82766e]">
                                        Seção
                                    </th>

                                    <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-[#82766e]">
                                        Página
                                    </th>

                                    <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-[#82766e]">
                                        Ordem
                                    </th>

                                    <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-[#82766e]">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 text-right text-[10px] font-bold uppercase tracking-wider text-[#82766e]">
                                        Ações
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-[#eee7df]">

                                <?php if (count($secoes) > 0): ?>

                                    <?php foreach ($secoes as $secao): ?>

                                        <tr class="transition hover:bg-[#fbf9f5]">

                                            <td class="px-6 py-5">

                                                <p class="text-sm font-semibold">
                                                    <?= e($secao["titulo"]) ?>
                                                </p>

                                                <p class="mt-1 text-xs text-[#a69a90]">
                                                    <?= e($secao["chave"]) ?>
                                                </p>

                                            </td>


                                            <td class="px-6 py-5">

                                                <span class="bg-[#f8f5ef] px-3 py-1.5 text-xs text-[#82766e]">
                                                    <?= e($secao["nome_pagina"]) ?>
                                                </span>

                                            </td>


                                            <td class="px-6 py-5 text-sm text-[#82766e]">
                                                <?= (int) $secao["ordem"] ?>
                                            </td>


                                            <td class="px-6 py-5">

                                                <?php if ($secao["ativo"]): ?>

                                                    <span class="inline-flex items-center gap-2 text-xs font-semibold text-green-700">
                                                        <span class="h-2 w-2 rounded-full bg-green-600"></span>
                                                        Ativa
                                                    </span>

                                                <?php else: ?>

                                                    <span class="inline-flex items-center gap-2 text-xs font-semibold text-red-600">
                                                        <span class="h-2 w-2 rounded-full bg-red-500"></span>
                                                        Inativa
                                                    </span>

                                                <?php endif; ?>

                                            </td>


                                            <td class="px-6 py-5">

                                                <div class="flex justify-end gap-2">

                                                    <a
                                                        href="secoes.php?editar=<?= (int) $secao["id"] ?>#formulario"
                                                        title="Editar seção"
                                                        class="flex h-9 w-9 items-center justify-center border border-[#e8dfd2] text-[#82766e] transition hover:border-[#c9272c] hover:bg-[#c9272c] hover:text-white">

                                                        <i class="bi bi-pencil"></i>

                                                    </a>


                                                    <form method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta seção?');">

                                                        <input type="hidden" name="id" value="<?= (int) $secao["id"] ?>">

                                                        <button
                                                            type="submit"
                                                            name="excluir"
                                                            title="Excluir seção"
                                                            class="flex h-9 w-9 items-center justify-center border border-[#e8dfd2] text-[#82766e] transition hover:border-red-600 hover:bg-red-600 hover:text-white">

                                                            <i class="bi bi-trash"></i>

                                                        </button>

                                                    </form>

                                                </div>

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-sm text-[#82766e]">
                                            Nenhuma seção cadastrada.
                                        </td>
                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </section>


            <!-- FORMULÁRIO -->

            <aside id="formulario" class="border border-[#e8dfd2] bg-white">

                <div class="border-b border-[#eee7df] px-6 py-5">

                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c9272c]">
                        <?= $editando ? "Editar conteúdo" : "Novo conteúdo" ?>
                    </p>

                    <h2 class="titulo mt-1 text-2xl font-semibold">
                        <?= $editando ? "Editar seção" : "Adicionar seção" ?>
                    </h2>

                </div>


                <form method="POST" class="space-y-5 p-6">

                    <input
                        type="hidden"
                        name="id"
                        value="<?= $editando ? (int) $secaoEdicao["id"] : 0 ?>">


                    <!-- PÁGINA -->

                    <div>

                        <label class="campo-label">
                            Página relacionada *
                        </label>

                        <select name="pagina_id" class="campo" required>

                            <option value="">Selecione uma página</option>

                            <?php foreach ($paginas as $pagina): ?>

                                <option
                                    value="<?= (int) $pagina["id"] ?>"
                                    <?= $editando && $secaoEdicao["pagina_id"] == $pagina["id"] ? "selected" : "" ?>>

                                    <?= e($pagina["titulo"]) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- CHAVE -->

                    <div>

                        <label class="campo-label">
                            Chave da seção *
                        </label>

                        <input
                            type="text"
                            name="chave"
                            class="campo"
                            placeholder="Ex: cultura"
                            value="<?= $editando ? e($secaoEdicao["chave"]) : "" ?>"
                            required>

                        <p class="mt-2 text-[10px] text-[#a69a90]">
                            Identificador interno da seção. Evite espaços e caracteres especiais.
                        </p>

                    </div>


                    <!-- TÍTULO -->

                    <div>

                        <label class="campo-label">
                            Título *
                        </label>

                        <input
                            type="text"
                            name="titulo"
                            class="campo"
                            placeholder="Ex: Cultura japonesa"
                            value="<?= $editando ? e($secaoEdicao["titulo"]) : "" ?>"
                            required>

                    </div>


                    <!-- TEXTO -->

                    <div>

                        <label class="campo-label">
                            Texto da seção
                        </label>

                        <textarea
                            name="texto"
                            rows="5"
                            class="campo resize-y"
                            placeholder="Escreva o conteúdo desta seção..."><?= $editando ? e($secaoEdicao["texto"]) : "" ?></textarea>

                    </div>


                    <!-- IMAGEM -->

                    <div>

                        <label class="campo-label">
                            Caminho da imagem
                        </label>

                        <input
                            type="text"
                            name="imagem"
                            class="campo"
                            placeholder="Ex: img/cultura.jpg"
                            value="<?= $editando ? e($secaoEdicao["imagem"]) : "" ?>">

                        <p class="mt-2 text-[10px] text-[#a69a90]">
                            Informe o caminho da imagem dentro do projeto.
                        </p>

                    </div>


                    <!-- ORDEM -->

                    <div>

                        <label class="campo-label">
                            Ordem de exibição
                        </label>

                        <input
                            type="number"
                            name="ordem"
                            min="0"
                            class="campo"
                            placeholder="Ex: 1"
                            value="<?= $editando ? (int) $secaoEdicao["ordem"] : 0 ?>">

                    </div>


                    <!-- STATUS -->

                    <div class="border-t border-[#eee7df] pt-5">

                        <label class="flex cursor-pointer items-center gap-3">

                            <input
                                type="checkbox"
                                name="ativo"
                                value="1"
                                class="h-4 w-4 accent-[#c9272c]"
                                <?= !$editando || $secaoEdicao["ativo"] ? "checked" : "" ?>>

                            <span>

                                <span class="block text-xs font-bold">
                                    Seção ativa
                                </span>

                                <span class="mt-1 block text-[10px] text-[#a69a90]">
                                    Seções inativas não devem aparecer no site.
                                </span>

                            </span>

                        </label>

                    </div>


                    <!-- BOTÕES -->

                    <div class="space-y-3 border-t border-[#eee7df] pt-5">

                        <button
                            type="submit"
                            name="salvar"
                            class="botao flex w-full items-center justify-center gap-2 bg-[#c9272c] px-5 py-3.5 text-xs font-bold uppercase tracking-wider text-white hover:bg-[#a51e23]">

                            <i class="bi bi-check-lg"></i>

                            <?= $editando ? "Salvar alterações" : "Cadastrar seção" ?>

                        </button>


                        <?php if ($editando): ?>

                            <a
                                href="secoes.php"
                                class="flex w-full items-center justify-center border border-[#e8dfd2] px-5 py-3 text-xs font-bold uppercase tracking-wider text-[#82766e] transition hover:bg-[#f8f5ef]">

                                Cancelar edição

                            </a>

                        <?php endif; ?>

                    </div>

                </form>

            </aside>

        </div>


        <!-- RODAPÉ -->

        <footer class="mt-14 border-t border-[#e8dfd2] py-6">

            <div class="flex flex-col justify-between gap-3 text-xs text-[#a69a90] sm:flex-row">

                <p>Japão Integrador · Administração</p>

                <p class="tracking-[0.2em]">
                    日本 — CULTURA E TRADIÇÃO
                </p>

            </div>

        </footer>

    </main>

</body>
</html>
