
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

function escapar($valor) {
    return htmlspecialchars((string)($valor ?? ""), ENT_QUOTES, "UTF-8");
}

/* CADASTRAR OU EDITAR CARD */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["salvar"])) {
    $id = (int)($_POST["id"] ?? 0);
    $secaoId = (int)($_POST["secao_id"] ?? 0);
    $titulo = trim($_POST["titulo"] ?? "");
    $descricao = trim($_POST["descricao"] ?? "");
    $imagem = trim($_POST["imagem"] ?? "");
    $icone = trim($_POST["icone"] ?? "");
    $link = trim($_POST["link"] ?? "");
    $ordem = (int)($_POST["ordem"] ?? 0);
    $ativo = isset($_POST["ativo"]) ? 1 : 0;

    if ($secaoId <= 0 || $titulo === "") {
        $mensagem = "Selecione uma seção e informe o título do card.";
        $tipoMensagem = "error";
    } else {
        if ($id > 0) {
            $stmt = $conn->prepare("
                UPDATE cards
                SET secao_id = ?, titulo = ?, descricao = ?, imagem = ?,
                    icone = ?, link = ?, ordem = ?, ativo = ?
                WHERE id = ?
            ");

            $stmt->bind_param(
                "isssssiii",
                $secaoId,
                $titulo,
                $descricao,
                $imagem,
                $icone,
                $link,
                $ordem,
                $ativo,
                $id
            );
        } else {
            $stmt = $conn->prepare("
                INSERT INTO cards
                (secao_id, titulo, descricao, imagem, icone, link, ordem, ativo)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $stmt->bind_param(
                "isssssii",
                $secaoId,
                $titulo,
                $descricao,
                $imagem,
                $icone,
                $link,
                $ordem,
                $ativo
            );
        }

        if ($stmt->execute()) {
            header("Location: cards.php?sucesso=1");
            exit;
        } else {
            $mensagem = "Não foi possível salvar o card: " . $stmt->error;
            $tipoMensagem = "error";
        }

        $stmt->close();
    }
}

/* EXCLUIR CARD */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["excluir"])) {
    $idExcluir = (int)$_POST["excluir"];

    $stmt = $conn->prepare("DELETE FROM cards WHERE id = ?");
    $stmt->bind_param("i", $idExcluir);

    if ($stmt->execute()) {
        header("Location: cards.php?excluido=1");
        exit;
    } else {
        $mensagem = "Não foi possível excluir este card.";
        $tipoMensagem = "error";
    }

    $stmt->close();
}

/* MENSAGENS */
if (isset($_GET["sucesso"])) {
    $mensagem = "Card salvo com sucesso!";
}

if (isset($_GET["excluido"])) {
    $mensagem = "Card excluído com sucesso!";
}

/* BUSCAR SEÇÕES */
$secoes = $conn->query("
    SELECT secoes.id, secoes.titulo, secoes.chave, paginas.titulo AS pagina
    FROM secoes
    INNER JOIN paginas ON paginas.id = secoes.pagina_id
    ORDER BY paginas.titulo ASC, secoes.ordem ASC
");

/* BUSCAR CARD PARA EDIÇÃO */
$dadosEdicao = null;

if (isset($_GET["editar"])) {
    $idEditar = (int)$_GET["editar"];

    $stmt = $conn->prepare("SELECT * FROM cards WHERE id = ?");
    $stmt->bind_param("i", $idEditar);
    $stmt->execute();

    $resultadoEdicao = $stmt->get_result();
    $dadosEdicao = $resultadoEdicao->fetch_assoc();

    $stmt->close();
}

/* LISTAR CARDS */
$cards = $conn->query("
    SELECT
        cards.*,
        secoes.titulo AS nome_secao,
        secoes.chave AS chave_secao,
        paginas.titulo AS nome_pagina
    FROM cards
    INNER JOIN secoes ON secoes.id = cards.secao_id
    INNER JOIN paginas ON paginas.id = secoes.pagina_id
    ORDER BY paginas.titulo ASC, secoes.ordem ASC, cards.ordem ASC
");

/* CONTADORES */
$totalCards = $conn->query("SELECT COUNT(*) AS total FROM cards")->fetch_assoc()["total"];
$totalAtivos = $conn->query("SELECT COUNT(*) AS total FROM cards WHERE ativo = 1")->fetch_assoc()["total"];
$totalInativos = $conn->query("SELECT COUNT(*) AS total FROM cards WHERE ativo = 0")->fetch_assoc()["total"];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cards e Conteúdos | Painel Administrativo</title>

    <link rel="stylesheet" href="../../src/output.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Noto Sans JP', sans-serif;
            background: #f7f4ed;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }

        .campo {
            width: 100%;
            border: 1px solid #dedbd3;
            border-radius: 10px;
            padding: 12px 14px;
            background: #fff;
            outline: none;
            transition: .2s;
        }

        .campo:focus {
            border-color: #a52828;
            box-shadow: 0 0 0 3px rgba(165, 40, 40, .10);
        }

        .botao-principal {
            background: #a52828;
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: .2s;
        }

        .botao-principal:hover {
            background: #821d1d;
        }

        .botao-secundario {
            background: #eeeae1;
            color: #333;
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: 600;
        }

        .tabela th {
            color: #777;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .06em;
            padding: 14px;
            text-align: left;
        }

        .tabela td {
            padding: 15px 14px;
            border-top: 1px solid #eeeae1;
            vertical-align: middle;
        }

        .status-ativo {
            background: #e2f3e8;
            color: #237344;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-inativo {
            background: #f5e5e3;
            color: #a52828;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
</head>

<body class="min-h-screen">

    <!-- CABEÇALHO -->
    <header class="bg-[#172334] text-white shadow-md">

        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-5">

            <div>
                <h1 class="mt-1 text-2xl font-bold tracking-[0.3em] text-[#e45a5e]">
                    Japão
                </h1>

                <p class="mb-3 text-[10px] font-bold uppercase tracking-[0.3em] text-[#c9272c]">
                    Gerenciamento de site
                </p>
            </div>

            <a href="index.php" class="inline-flex items-center gap-2 rounded-lg border border-white/20 px-4 py-2 text-sm transition hover:bg-white/10">

                <i class="bi bi-arrow-left"></i>
                Voltar ao painel

            </a>

        </div>

    </header>


    <main class="max-w-7xl mx-auto px-5 py-10">

        <!-- TÍTULO -->
        <div class="mb-8">
            

            <h2 class="text-4xl text-[#172334] mt-2">
                Cards e conteúdos
            </h2>

            <p class="text-gray-500 mt-2">
                Gerencie os cards exibidos nas diferentes seções das páginas.
            </p>
        </div>

        <!-- CONTADORES -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#eeeae1]">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total de cards</p>
                        <h3 class="text-3xl text-[#172334] mt-2">
                            <?= escapar($totalCards) ?>
                        </h3>
                    </div>

                    <i class="bi bi-grid text-3xl text-[#a52828]"></i>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#eeeae1]">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Cards ativos</p>
                        <h3 class="text-3xl text-green-700 mt-2">
                            <?= escapar($totalAtivos) ?>
                        </h3>
                    </div>

                    <i class="bi bi-check-circle text-3xl text-green-700"></i>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#eeeae1]">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Cards inativos</p>
                        <h3 class="text-3xl text-red-700 mt-2">
                            <?= escapar($totalInativos) ?>
                        </h3>
                    </div>

                    <i class="bi bi-eye-slash text-3xl text-red-700"></i>
                </div>
            </div>

        </div>

        <!-- MENSAGEM -->
        <?php if ($mensagem): ?>
            <div class="mb-6 p-4 rounded-xl <?= $tipoMensagem === "error" ? "bg-red-100 text-red-800" : "bg-green-100 text-green-800" ?>">
                <?= escapar($mensagem) ?>
            </div>
        <?php endif; ?>

        <!-- FORMULÁRIO -->
        <section class="bg-white rounded-2xl shadow-sm border border-[#eeeae1] p-6 md:p-8 mb-8">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-2xl text-[#172334]">
                        <?= $dadosEdicao ? "Editar card" : "Adicionar novo card" ?>
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Preencha as informações do conteúdo.
                    </p>
                </div>

                <i class="bi bi-card-image text-3xl text-[#a52828]"></i>
            </div>

            <form method="POST" action="cards.php" class="space-y-5">

                <input type="hidden" name="id" value="<?= escapar($dadosEdicao["id"] ?? "") ?>">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Seção do card *
                    </label>

                    <select name="secao_id" class="campo" required>
                        <option value="">Selecione uma seção</option>

                        <?php if ($secoes && $secoes->num_rows > 0): ?>
                            <?php while ($secao = $secoes->fetch_assoc()): ?>
                                <option
                                    value="<?= escapar($secao["id"]) ?>"
                                    <?= (isset($dadosEdicao["secao_id"]) && $dadosEdicao["secao_id"] == $secao["id"]) ? "selected" : "" ?>
                                >
                                    <?= escapar($secao["pagina"]) ?> — <?= escapar($secao["titulo"] ?: $secao["chave"]) ?>
                                </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Título *
                        </label>

                        <input
                            type="text"
                            name="titulo"
                            class="campo"
                            maxlength="120"
                            placeholder="Ex: Culinária japonesa"
                            value="<?= escapar($dadosEdicao["titulo"] ?? "") ?>"
                            required
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Caminho da imagem
                        </label>

                        <input
                            type="text"
                            name="imagem"
                            class="campo"
                            placeholder="Ex: img/sushi.jpg"
                            value="<?= escapar($dadosEdicao["imagem"] ?? "") ?>"
                        >
                    </div>

                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Descrição
                    </label>

                    <textarea
                        name="descricao"
                        rows="4"
                        class="campo"
                        placeholder="Escreva uma descrição para o card..."
                    ><?= escapar($dadosEdicao["descricao"] ?? "") ?></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Ícone
                        </label>

                        <input
                            type="text"
                            name="icone"
                            class="campo"
                            placeholder="Ex: bi-heart"
                            value="<?= escapar($dadosEdicao["icone"] ?? "") ?>"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Link
                        </label>

                        <input
                            type="text"
                            name="link"
                            class="campo"
                            placeholder="Ex: historia.php"
                            value="<?= escapar($dadosEdicao["link"] ?? "") ?>"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Ordem de exibição
                        </label>

                        <input
                            type="number"
                            name="ordem"
                            class="campo"
                            value="<?= escapar($dadosEdicao["ordem"] ?? 0) ?>"
                        >
                    </div>

                </div>

                <div class="flex items-center gap-3">
                    <input
                        type="checkbox"
                        name="ativo"
                        id="ativo"
                        class="w-4 h-4 accent-[#a52828]"
                        <?= (!isset($dadosEdicao) || !$dadosEdicao || $dadosEdicao["ativo"] == 1) ? "checked" : "" ?>
                    >

                    <label for="ativo" class="text-sm text-gray-700">
                        Exibir este card no site
                    </label>
                </div>

                <div class="flex flex-wrap gap-3 pt-3">

                    <button type="submit" name="salvar" class="botao-principal">
                        <i class="bi bi-check-lg mr-2"></i>
                        <?= $dadosEdicao ? "Salvar alterações" : "Cadastrar card" ?>
                    </button>

                    <?php if ($dadosEdicao): ?>
                        <a href="cards.php" class="botao-secundario">
                            Cancelar edição
                        </a>
                    <?php endif; ?>

                </div>

            </form>
        </section>

        <!-- LISTAGEM -->
        <section class="bg-white rounded-2xl shadow-sm border border-[#eeeae1] overflow-hidden">

            <div class="p-6 border-b border-[#eeeae1]">
                <h3 class="text-2xl text-[#172334]">Cards cadastrados</h3>
                <p class="text-sm text-gray-500 mt-1">
                    Todos os cards organizados por página e seção.
                </p>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full tabela">

                    <thead class="bg-[#faf9f6]">
                        <tr>
                            <th>Card</th>
                            <th>Página</th>
                            <th>Seção</th>
                            <th>Ordem</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if ($cards && $cards->num_rows > 0): ?>

                            <?php while ($card = $cards->fetch_assoc()): ?>

                                <tr>

                                    <td>
                                        <div class="flex items-center gap-3">

                                            <?php if (!empty($card["imagem"])): ?>
                                                <div class="w-12 h-12 rounded-lg bg-[#f1eee7] overflow-hidden flex-shrink-0">
                                                    <img
                                                        src="../../<?= escapar($card["imagem"]) ?>"
                                                        alt="<?= escapar($card["titulo"]) ?>"
                                                        class="w-full h-full object-cover"
                                                        onerror="this.style.display='none'"
                                                    >
                                                </div>
                                            <?php else: ?>
                                                <div class="w-12 h-12 rounded-lg bg-[#f1eee7] flex items-center justify-center">
                                                    <i class="bi bi-card-image text-xl text-gray-400"></i>
                                                </div>
                                            <?php endif; ?>

                                            <div>
                                                <p class="font-semibold text-[#172334]">
                                                    <?= escapar($card["titulo"]) ?>
                                                </p>

                                                <?php if (!empty($card["icone"])): ?>
                                                    <p class="text-xs text-gray-400">
                                                        <?= escapar($card["icone"]) ?>
                                                    </p>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </td>

                                    <td class="text-sm text-gray-600">
                                        <?= escapar($card["nome_pagina"]) ?>
                                    </td>

                                    <td class="text-sm text-gray-600">
                                        <?= escapar($card["nome_secao"] ?: $card["chave_secao"]) ?>
                                    </td>

                                    <td class="text-sm text-gray-600">
                                        <?= escapar($card["ordem"]) ?>
                                    </td>

                                    <td>
                                        <?php if ($card["ativo"] == 1): ?>
                                            <span class="status-ativo">Ativo</span>
                                        <?php else: ?>
                                            <span class="status-inativo">Inativo</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <div class="flex items-center gap-3">

                                            <a
                                                href="cards.php?editar=<?= escapar($card["id"]) ?>"
                                                class="text-blue-700 hover:text-blue-900"
                                                title="Editar"
                                            >
                                                <i class="bi bi-pencil-square text-lg"></i>
                                            </a>

                                            <form
                                                method="POST"
                                                action="cards.php"
                                                onsubmit="return confirm('Tem certeza que deseja excluir este card?');"
                                            >
                                                <button
                                                    type="submit"
                                                    name="excluir"
                                                    value="<?= escapar($card["id"]) ?>"
                                                    class="text-red-700 hover:text-red-900"
                                                    title="Excluir"
                                                >
                                                    <i class="bi bi-trash text-lg"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            <?php endwhile; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="6" class="text-center text-gray-500 py-10">
                                    Nenhum card cadastrado.
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>
        </section>

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
