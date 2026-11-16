
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

// EXCLUIR PÁGINA

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["excluir"])) {

    $id = (int) $_POST["id"];

    try {
        $stmt = $conn->prepare("DELETE FROM paginas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        $mensagem = "Página excluída com sucesso!";
    } catch (mysqli_sql_exception $erro) {
        $mensagem = "Não foi possível excluir. Verifique se existem seções vinculadas a essa página.";
        $tipoMensagem = "erro";
    }
}

// SALVAR PÁGINA

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) {

    $id = (int) ($_POST["id"] ?? 0);

    $slug = trim($_POST["slug"] ?? "");
    $titulo = trim($_POST["titulo"] ?? "");
    $heroImagem = trim($_POST["hero_imagem"] ?? "");
    $heroTitulo = trim($_POST["hero_titulo"] ?? "");
    $heroSubtitulo = trim($_POST["hero_subtitulo"] ?? "");
    $heroKanji = trim($_POST["hero_kanji"] ?? "");
    $metaDescricao = trim($_POST["meta_descricao"] ?? "");
    $ativo = isset($_POST["ativo"]) ? 1 : 0;

    if ($slug === "" || $titulo === "") {

        $mensagem = "Preencha o endereço e o título da página.";
        $tipoMensagem = "erro";

    } else {

        try {

            if ($id > 0) {

                $sql = "UPDATE paginas SET
                    slug = ?,
                    titulo = ?,
                    hero_imagem = ?,
                    hero_titulo = ?,
                    hero_subtitulo = ?,
                    hero_kanji = ?,
                    meta_descricao = ?,
                    ativo = ?
                    WHERE id = ?";

                $stmt = $conn->prepare($sql);

                $stmt->bind_param(
                    "sssssssii",
                    $slug,
                    $titulo,
                    $heroImagem,
                    $heroTitulo,
                    $heroSubtitulo,
                    $heroKanji,
                    $metaDescricao,
                    $ativo,
                    $id
                );

                $stmt->execute();
                $stmt->close();

                $mensagem = "Página atualizada com sucesso!";

            } else {

                $sql = "INSERT INTO paginas (
                    slug,
                    titulo,
                    hero_imagem,
                    hero_titulo,
                    hero_subtitulo,
                    hero_kanji,
                    meta_descricao,
                    ativo
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);

                $stmt->bind_param(
                    "sssssssi",
                    $slug,
                    $titulo,
                    $heroImagem,
                    $heroTitulo,
                    $heroSubtitulo,
                    $heroKanji,
                    $metaDescricao,
                    $ativo
                );

                $stmt->execute();
                $stmt->close();

                $mensagem = "Página cadastrada com sucesso!";
            }

        } catch (mysqli_sql_exception $erro) {

            if ($erro->getCode() == 1062) {
                $mensagem = "Esse endereço já está sendo utilizado por outra página.";
            } else {
                $mensagem = "Ocorreu um erro ao salvar a página.";
            }

            $tipoMensagem = "erro";
        }
    }
}

// BUSCAR PÁGINA PARA EDIÇÃO

$paginaEdicao = null;

if (isset($_GET["editar"])) {

    $idEditar = (int) $_GET["editar"];

    $stmt = $conn->prepare("SELECT * FROM paginas WHERE id = ?");
    $stmt->bind_param("i", $idEditar);
    $stmt->execute();

    $resultadoEdicao = $stmt->get_result();
    $paginaEdicao = $resultadoEdicao->fetch_assoc();

    $stmt->close();
}

// LISTAR PÁGINAS

$resultado = $conn->query("
    SELECT *
    FROM paginas
    ORDER BY id ASC
");

$paginas = $resultado->fetch_all(MYSQLI_ASSOC);

$editando = $paginaEdicao !== null;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Páginas | Administração Japão</title>

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

    <header class="bg-[#071018] text-white">

        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 md:px-10">

            <a href="index.php" class="flex items-center gap-3">

                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white">
                    <span class="h-5 w-5 rounded-full bg-[#c9272c]"></span>
                </span>

                <span class="titulo text-xl tracking-[0.2em]">
                    JAPÃO
                </span>

            </a>

            <div class="flex items-center gap-5">

                <span class="hidden text-xs text-white/60 sm:block">
                    <?= e($nomeAdmin) ?>
                </span>

                <a href="../admin/index.php" class="text-xs text-white/70 transition hover:text-white">
                    <i class="bi bi-box-arrow-right mr-1"></i>
                    Voltar
                </a>

            </div>

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
                Páginas do site
            </span>

        </div>


        <!-- TÍTULO -->

        <section class="mb-10 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">

            <div>

                <p class="mb-3 text-[10px] font-bold uppercase tracking-[0.3em] text-[#c9272c]">
                    Gerenciamento de conteúdo
                </p>

                <h1 class="titulo text-4xl font-semibold">
                    Páginas do site
                </h1>

                <p class="mt-3 max-w-xl text-sm leading-7 text-[#82766e]">
                    Gerencie as páginas do projeto, atualize informações e personalize os conteúdos principais.
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


            <!-- LISTA DE PÁGINAS -->

            <section>

                <div class="mb-5 flex items-center justify-between">

                    <div>
                        <h2 class="titulo text-2xl font-semibold">
                            Páginas cadastradas
                        </h2>

                        <p class="mt-1 text-xs text-[#82766e]">
                            <?= count($paginas) ?> páginas encontradas
                        </p>
                    </div>

                </div>


                <div class="overflow-hidden border border-[#e8dfd2] bg-white">

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[650px] text-left">

                            <thead class="border-b border-[#eee7df] bg-[#fbf9f5]">

                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-[#82766e]">
                                        Página
                                    </th>

                                    <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-[#82766e]">
                                        Endereço
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

                                <?php if (count($paginas) > 0): ?>

                                    <?php foreach ($paginas as $pagina): ?>

                                        <tr class="transition hover:bg-[#fbf9f5]">

                                            <td class="px-6 py-5">

                                                <p class="text-sm font-semibold">
                                                    <?= e($pagina["titulo"]) ?>
                                                </p>

                                                <p class="mt-1 text-xs text-[#a69a90]">
                                                    ID: <?= (int) $pagina["id"] ?>
                                                </p>

                                            </td>

                                            <td class="px-6 py-5">

                                                <span class="bg-[#f8f5ef] px-3 py-1.5 text-xs text-[#82766e]">
                                                    /<?= e($pagina["slug"]) ?>
                                                </span>

                                            </td>

                                            <td class="px-6 py-5">

                                                <?php if ($pagina["ativo"]): ?>

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

                                                    <a href="paginas.php?editar=<?= (int) $pagina["id"] ?>"
                                                        title="Editar página"
                                                        class="flex h-9 w-9 items-center justify-center border border-[#e8dfd2] text-[#82766e] transition hover:border-[#c9272c] hover:bg-[#c9272c] hover:text-white">

                                                        <i class="bi bi-pencil"></i>

                                                    </a>

                                                    <form method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta página?');">

                                                        <input type="hidden" name="id" value="<?= (int) $pagina["id"] ?>">

                                                        <button type="submit" name="excluir"
                                                            title="Excluir página"
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
                                        <td colspan="4" class="px-6 py-12 text-center text-sm text-[#82766e]">
                                            Nenhuma página cadastrada.
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
                        <?= $editando ? "Editar página" : "Adicionar página" ?>
                    </h2>

                </div>


                <form method="POST" class="space-y-5 p-6">

                    <input type="hidden" name="id" value="<?= $editando ? (int) $paginaEdicao["id"] : 0 ?>">

                    <!-- TÍTULO -->

                    <div>
                        <label class="campo-label">
                            Nome da página *
                        </label>

                        <input
                            type="text"
                            name="titulo"
                            class="campo"
                            placeholder="Ex: História"
                            value="<?= $editando ? e($paginaEdicao["titulo"]) : "" ?>"
                            required>
                    </div>


                    <!-- SLUG -->

                    <div>
                        <label class="campo-label">
                            Endereço da página *
                        </label>

                        <input
                            type="text"
                            name="slug"
                            class="campo"
                            placeholder="Ex: historia"
                            value="<?= $editando ? e($paginaEdicao["slug"]) : "" ?>"
                            required>

                        <p class="mt-2 text-[10px] text-[#a69a90]">
                            Utilize letras minúsculas e sem espaços.
                        </p>
                    </div>


                    <!-- IMAGEM -->

                    <div>
                        <label class="campo-label">
                            Imagem principal
                        </label>

                        <input
                            type="text"
                            name="hero_imagem"
                            class="campo"
                            placeholder="Ex: img/hero-historia.jpg"
                            value="<?= $editando ? e($paginaEdicao["hero_imagem"]) : "" ?>">

                        <p class="mt-2 text-[10px] text-[#a69a90]">
                            Informe o caminho da imagem dentro do projeto.
                        </p>
                    </div>


                    <!-- TÍTULO HERO -->

                    <div>
                        <label class="campo-label">
                            Título de destaque
                        </label>

                        <input
                            type="text"
                            name="hero_titulo"
                            class="campo"
                            placeholder="Título exibido no banner"
                            value="<?= $editando ? e($paginaEdicao["hero_titulo"]) : "" ?>">
                    </div>


                    <!-- SUBTÍTULO -->

                    <div>
                        <label class="campo-label">
                            Texto de destaque
                        </label>

                        <textarea
                            name="hero_subtitulo"
                            rows="3"
                            class="campo resize-y"
                            placeholder="Escreva uma breve apresentação..."><?= $editando ? e($paginaEdicao["hero_subtitulo"]) : "" ?></textarea>
                    </div>


                    <!-- KANJI -->

                    <div>
                        <label class="campo-label">
                            Kanji / Caracter japonês
                        </label>

                        <input
                            type="text"
                            name="hero_kanji"
                            class="campo"
                            placeholder="Ex: 日本"
                            value="<?= $editando ? e($paginaEdicao["hero_kanji"]) : "" ?>">
                    </div>


                    <!-- META DESCRIÇÃO -->

                    <div>
                        <label class="campo-label">
                            Descrição da página
                        </label>

                        <textarea
                            name="meta_descricao"
                            rows="3"
                            class="campo resize-y"
                            placeholder="Descrição para mecanismos de busca..."><?= $editando ? e($paginaEdicao["meta_descricao"]) : "" ?></textarea>
                    </div>


                    <!-- STATUS -->

                    <div class="border-t border-[#eee7df] pt-5">

                        <label class="flex cursor-pointer items-center gap-3">

                            <input
                                type="checkbox"
                                name="ativo"
                                value="1"
                                class="h-4 w-4 accent-[#c9272c]"
                                <?= !$editando || $paginaEdicao["ativo"] ? "checked" : "" ?>>

                            <span>
                                <span class="block text-xs font-bold">
                                    Página ativa
                                </span>

                                <span class="mt-1 block text-[10px] text-[#a69a90]">
                                    Páginas inativas não devem aparecer no site.
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

                            <?= $editando ? "Salvar alterações" : "Cadastrar página" ?>

                        </button>

                        <?php if ($editando): ?>

                            <a href="paginas.php" class="flex w-full items-center justify-center border border-[#e8dfd2] px-5 py-3 text-xs font-bold uppercase tracking-wider text-[#82766e] transition hover:bg-[#f8f5ef]">
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
