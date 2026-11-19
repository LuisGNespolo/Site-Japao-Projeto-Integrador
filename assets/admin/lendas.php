
<?php

session_start();

if (
    !isset($_SESSION["admin_id"]) ||
    ($_SESSION["logado"] ?? false) !== true
) {
    header("Location: ../login.php");
    exit;
}

require_once __DIR__ . '/../../database/conexao.php';

if (empty($_SESSION['csrf_lendas'])) {
    $_SESSION['csrf_lendas'] = bin2hex(random_bytes(32));
}

function eLendas($valor): string
{
    return htmlspecialchars((string) ($valor ?? ''), ENT_QUOTES, 'UTF-8');
}

$mensagem = '';
$tipoMensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $token = $_POST['csrf_token'] ?? '';

    if (!hash_equals($_SESSION['csrf_lendas'], $token)) {
        die('Solicitação inválida. Atualize a página e tente novamente.');
    }

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nome = trim($_POST['nome'] ?? '');
    $nomeJapones = trim($_POST['nome_japones'] ?? '');
    $romanizacao = trim($_POST['romanizacao'] ?? '');
    $resumo = trim($_POST['resumo'] ?? '');
    $textoCompleto = trim($_POST['texto_completo'] ?? '');
    $ativo = isset($_POST['ativo']) && $_POST['ativo'] === '1' ? 1 : 0;

    if (!$id || $nome === '') {

        $mensagem = 'Informe um nome válido para a lenda.';
        $tipoMensagem = 'erro';

    } else {

        $sql = "UPDATE lendas
                SET nome = ?,
                    nome_japones = ?,
                    romanizacao = ?,
                    resumo = ?,
                    texto_completo = ?,
                    ativo = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "sssssii",
            $nome,
            $nomeJapones,
            $romanizacao,
            $resumo,
            $textoCompleto,
            $ativo,
            $id
        );

        if ($stmt->execute() && $stmt->affected_rows >= 0) {
            header("Location: lendas.php?sucesso=1");
            exit;
        } else {
            $mensagem = 'Não foi possível salvar as alterações.';
            $tipoMensagem = 'erro';
        }

        $stmt->close();
    }
}

if (isset($_GET['sucesso'])) {
    $mensagem = 'Lenda atualizada com sucesso!';
    $tipoMensagem = 'sucesso';
}

$lendaEditando = null;

if (isset($_GET['editar'])) {

    $idEditar = filter_input(INPUT_GET, 'editar', FILTER_VALIDATE_INT);

    if ($idEditar) {

        $stmt = $conn->prepare(
            "SELECT * FROM lendas WHERE id = ? LIMIT 1"
        );

        $stmt->bind_param("i", $idEditar);
        $stmt->execute();

        $resultadoEdicao = $stmt->get_result();
        $lendaEditando = $resultadoEdicao->fetch_assoc();

        $stmt->close();
    }
}

$resultado = $conn->query(
    "SELECT * FROM lendas ORDER BY ordem ASC, id ASC"
);

$lendas = [];

if ($resultado) {
    while ($linha = $resultado->fetch_assoc()) {
        $lendas[] = $linha;
    }

    $resultado->free();
}

$totalLendas = count($lendas);
$totalAtivas = 0;

foreach ($lendas as $item) {
    if ((int) $item['ativo'] === 1) {
        $totalAtivas++;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gerenciar Lendas | Japão</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Noto Sans JP', sans-serif;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body class="min-h-screen bg-[#f7f4ed] text-[#292521]">

    <!-- CABEÇALHO -->

    <header class="bg-[#172334] text-white shadow-md">

        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-5">

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#e45a5e]">
                    Japão
                </p>

                <h1 class="mt-1 text-2xl font-semibold">
                    Gerenciar lendas
                </h1>
            </div>

            <a href="index.php"
               class="inline-flex items-center gap-2 rounded-lg border border-white/20 px-4 py-2 text-sm transition hover:bg-white/10">

                <i class="bi bi-arrow-left"></i>
                Voltar ao painel

            </a>

        </div>

    </header>


    <main class="mx-auto max-w-7xl px-5 py-10">

        <!-- INTRODUÇÃO -->

        <div class="mb-8">

            <p class="text-xs font-bold uppercase tracking-[0.25em] text-[#a52828]">
                Conteúdos do site
            </p>

            <h2 class="mt-2 text-3xl font-bold text-[#172334]">
                Lendas japonesas
            </h2>

            <p class="mt-3 max-w-2xl text-sm leading-7 text-gray-600">
                Gerencie as informações das lendas apresentadas no site.
                Selecione uma lenda para editar seu conteúdo.
            </p>

        </div>


        <!-- MENSAGENS -->

        <?php if ($mensagem): ?>

            <div class="mb-6 rounded-xl border px-5 py-4 text-sm
                <?= $tipoMensagem === 'sucesso'
                    ? 'border-green-200 bg-green-50 text-green-800'
                    : 'border-red-200 bg-red-50 text-red-800' ?>">

                <?= eLendas($mensagem) ?>

            </div>

        <?php endif; ?>


        <!-- INDICADORES -->

        <div class="mb-8 grid gap-5 sm:grid-cols-2">

            <div class="rounded-2xl border border-[#eeeae1] bg-white p-6 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Total de lendas
                        </p>

                        <p class="mt-2 text-3xl font-bold text-[#172334]">
                            <?= $totalLendas ?>
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#f7e9e7] text-xl text-[#a52828]">
                        <i class="bi bi-journal-text"></i>
                    </div>

                </div>

            </div>


            <div class="rounded-2xl border border-[#eeeae1] bg-white p-6 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Lendas ativas
                        </p>

                        <p class="mt-2 text-3xl font-bold text-[#172334]">
                            <?= $totalAtivas ?>
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-50 text-xl text-green-700">
                        <i class="bi bi-check-circle"></i>
                    </div>

                </div>

            </div>

        </div>


        <div class="grid items-start gap-8 lg:grid-cols-[1fr_1.2fr]">

            <!-- LISTAGEM -->

            <section class="rounded-2xl border border-[#eeeae1] bg-white p-6 shadow-sm">

                <div class="mb-6 flex items-center justify-between gap-3">

                    <div>
                        <h3 class="text-xl font-bold text-[#172334]">
                            Lendas cadastradas
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            Selecione uma para editar
                        </p>
                    </div>

                    <i class="bi bi-book text-2xl text-[#a52828]"></i>

                </div>


                <div class="space-y-3">

                    <?php foreach ($lendas as $lenda): ?>

                        <div class="flex items-center justify-between gap-3 rounded-xl border border-[#eeeae1] p-4 transition hover:border-[#a52828]/40 hover:bg-[#faf8f4]">

                            <div class="min-w-0">

                                <h4 class="truncate font-semibold text-[#172334]">
                                    <?= eLendas($lenda['nome']) ?>
                                </h4>

                                <p class="mt-1 text-xs text-gray-500">
                                    <?= eLendas($lenda['nome_japones']) ?>
                                </p>

                                <span class="mt-2 inline-flex rounded-full px-3 py-1 text-[10px] font-bold uppercase tracking-wider
                                    <?= (int) $lenda['ativo'] === 1
                                        ? 'bg-green-50 text-green-700'
                                        : 'bg-gray-100 text-gray-500' ?>">

                                    <?= (int) $lenda['ativo'] === 1 ? 'Ativa' : 'Inativa' ?>

                                </span>

                            </div>

                            <a href="lendas.php?editar=<?= (int) $lenda['id'] ?>"
                               class="flex shrink-0 items-center gap-2 rounded-lg bg-[#a52828] px-3 py-2 text-xs font-semibold text-white transition hover:bg-[#821d1d]">

                                <i class="bi bi-pencil-square"></i>
                                Editar

                            </a>

                        </div>

                    <?php endforeach; ?>

                    <?php if (empty($lendas)): ?>

                        <p class="rounded-xl bg-gray-50 p-5 text-sm text-gray-500">
                            Nenhuma lenda cadastrada.
                        </p>

                    <?php endif; ?>

                </div>

            </section>


            <!-- FORMULÁRIO -->

            <section class="rounded-2xl border border-[#eeeae1] bg-white p-6 shadow-sm">

                <?php if ($lendaEditando): ?>

                    <div class="mb-6 border-b border-[#eeeae1] pb-5">

                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#a52828]">
                            Edição de conteúdo
                        </p>

                        <h3 class="mt-2 text-2xl font-bold text-[#172334]">
                            <?= eLendas($lendaEditando['nome']) ?>
                        </h3>

                        <p class="mt-2 text-xs text-gray-500">
                            Altere as informações e salve as modificações.
                        </p>

                    </div>


                    <form method="POST" action="lendas.php" class="space-y-5">

                        <input type="hidden" name="csrf_token"
                               value="<?= eLendas($_SESSION['csrf_lendas']) ?>">

                        <input type="hidden" name="id"
                               value="<?= (int) $lendaEditando['id'] ?>">


                        <div>
                            <label class="mb-2 block text-sm font-semibold text-[#172334]">
                                Nome da lenda
                            </label>

                            <input
                                type="text"
                                name="nome"
                                required
                                maxlength="150"
                                value="<?= eLendas($lendaEditando['nome']) ?>"
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-[#a52828] focus:ring-2 focus:ring-[#a52828]/10"
                            >
                        </div>


                        <div class="grid gap-5 sm:grid-cols-2">

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-[#172334]">
                                    Nome japonês
                                </label>

                                <input
                                    type="text"
                                    name="nome_japones"
                                    maxlength="100"
                                    value="<?= eLendas($lendaEditando['nome_japones']) ?>"
                                    class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-[#a52828] focus:ring-2 focus:ring-[#a52828]/10"
                                >
                            </div>


                            <div>
                                <label class="mb-2 block text-sm font-semibold text-[#172334]">
                                    Romanização
                                </label>

                                <input
                                    type="text"
                                    name="romanizacao"
                                    maxlength="100"
                                    value="<?= eLendas($lendaEditando['romanizacao']) ?>"
                                    class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-[#a52828] focus:ring-2 focus:ring-[#a52828]/10"
                                >
                            </div>

                        </div>


                        <div>
                            <label class="mb-2 block text-sm font-semibold text-[#172334]">
                                Resumo
                            </label>

                            <textarea
                                name="resumo"
                                rows="3"
                                maxlength="255"
                                class="w-full resize-y rounded-xl border border-gray-200 px-4 py-3 text-sm leading-6 outline-none transition focus:border-[#a52828] focus:ring-2 focus:ring-[#a52828]/10"
                            ><?= eLendas($lendaEditando['resumo']) ?></textarea>
                        </div>


                        <div>
                            <label class="mb-2 block text-sm font-semibold text-[#172334]">
                                História completa
                            </label>

                            <textarea
                                name="texto_completo"
                                rows="10"
                                class="w-full resize-y rounded-xl border border-gray-200 px-4 py-3 text-sm leading-7 outline-none transition focus:border-[#a52828] focus:ring-2 focus:ring-[#a52828]/10"
                            ><?= eLendas($lendaEditando['texto_completo']) ?></textarea>

                            <p class="mt-2 text-xs text-gray-400">
                                Você pode utilizar quebras de linha para organizar os parágrafos.
                            </p>
                        </div>


                        <div>
                            <label class="mb-2 block text-sm font-semibold text-[#172334]">
                                Situação da lenda
                            </label>

                            <select
                                name="ativo"
                                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-[#a52828]">

                                <option value="1"
                                    <?= (int) $lendaEditando['ativo'] === 1 ? 'selected' : '' ?>>
                                    Ativa
                                </option>

                                <option value="0"
                                    <?= (int) $lendaEditando['ativo'] === 0 ? 'selected' : '' ?>>
                                    Inativa
                                </option>

                            </select>
                        </div>


                        <div class="flex flex-wrap gap-3 border-t border-[#eeeae1] pt-5">

                            <button
                                type="submit"
                                class="inline-flex items-center gap-2 rounded-xl bg-[#a52828] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#821d1d]">

                                <i class="bi bi-check-lg"></i>
                                Salvar alterações

                            </button>

                            <a
                                href="lendas.php"
                                class="inline-flex items-center gap-2 rounded-xl border border-gray-200 px-6 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">

                                Cancelar

                            </a>

                        </div>

                    </form>

                <?php else: ?>

                    <div class="flex min-h-[350px] flex-col items-center justify-center text-center">

                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-[#f7e9e7] text-3xl text-[#a52828]">
                            <i class="bi bi-pencil-square"></i>
                        </div>

                        <h3 class="mt-5 text-xl font-bold text-[#172334]">
                            Editar uma lenda
                        </h3>

                        <p class="mt-3 max-w-xs text-sm leading-7 text-gray-500">
                            Escolha uma das lendas na lista ao lado para visualizar e editar suas informações.
                        </p>

                    </div>

                <?php endif; ?>

            </section>

        </div>

    </main>

</body>
</html>
