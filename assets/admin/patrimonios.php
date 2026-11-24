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

function e($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
}


function caminhoImagem($caminho)
{
    $caminho = trim((string) $caminho);

    if ($caminho === "") {
        return "";
    }

    // Imagens externas
    if (preg_match('/^https?:\/\//i', $caminho)) {
        return $caminho;
    }

    $caminho = ltrim($caminho, "/");

    // Caminhos começando com assets/
    if (str_starts_with($caminho, "assets/")) {
        return "../../" . $caminho;
    }

    // Caminhos começando com img/
    if (str_starts_with($caminho, "img/")) {
        return "../img/patrimonios/" . basename($caminho);
    }

    // Apenas o nome do arquivo
    return "../img/patrimonios/" . basename($caminho);
}


$mensagem = "";
$tipoMensagem = "success";

$diretorioImagens = __DIR__ . "/../img/patrimonios/";

if (!is_dir($diretorioImagens)) {
    mkdir($diretorioImagens, 0755, true);
}

// EXCLUIR PATRIMÔNIO
if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["acao"] ?? "") === "excluir") {

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if ($id) {
        $stmt = $conn->prepare("DELETE FROM patrimonios WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $mensagem = "Patrimônio excluído com sucesso!";
        } else {
            $mensagem = "Não foi possível excluir o patrimônio.";
            $tipoMensagem = "error";
        }

        $stmt->close();
    }
}

// ATIVAR OU DESATIVAR
if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["acao"] ?? "") === "status") {

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $ativo = filter_input(INPUT_POST, "ativo", FILTER_VALIDATE_INT);

    if ($id && ($ativo === 0 || $ativo === 1)) {

        $stmt = $conn->prepare("UPDATE patrimonios SET ativo = ? WHERE id = ?");
        $stmt->bind_param("ii", $ativo, $id);

        if ($stmt->execute()) {
            $mensagem = "Status atualizado com sucesso!";
        }

        $stmt->close();
    }
}

// CADASTRAR OU EDITAR
if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["acao"] ?? "") === "salvar") {

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT) ?: 0;

    $nome = trim($_POST["nome"] ?? "");
    $descricao = trim($_POST["descricao"] ?? "");
    $localizacao = trim($_POST["localizacao"] ?? "");
    $ordem = filter_input(INPUT_POST, "ordem", FILTER_VALIDATE_INT);

    $ativo = isset($_POST["ativo"]) ? 1 : 0;

    $imagem = trim($_POST["imagem_atual"] ?? "");

    if ($nome === "") {

        $mensagem = "Informe o nome do patrimônio.";
        $tipoMensagem = "error";

    } else {

        // UPLOAD DA IMAGEM
        if (
            isset($_FILES["imagem"]) &&
            $_FILES["imagem"]["error"] !== UPLOAD_ERR_NO_FILE
        ) {

            if ($_FILES["imagem"]["error"] !== UPLOAD_ERR_OK) {

                $mensagem = "Erro ao enviar a imagem.";
                $tipoMensagem = "error";

            } elseif ($_FILES["imagem"]["size"] > 5 * 1024 * 1024) {

                $mensagem = "A imagem deve ter no máximo 5 MB.";
                $tipoMensagem = "error";

            } else {

                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime = $finfo->file($_FILES["imagem"]["tmp_name"]);

                $tiposPermitidos = [
                    "image/jpeg" => "jpg",
                    "image/png" => "png",
                    "image/webp" => "webp",
                    "image/gif" => "gif"
                ];

                if (!isset($tiposPermitidos[$mime])) {

                    $mensagem = "Formato de imagem não permitido.";
                    $tipoMensagem = "error";

                } else {

                    $extensao = $tiposPermitidos[$mime];
                    $nomeArquivo = bin2hex(random_bytes(16)) . "." . $extensao;

                    $destino = $diretorioImagens . $nomeArquivo;

                    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $destino)) {

                        $imagem = "assets/img/patrimonios/" . $nomeArquivo;

                    } else {

                        $mensagem = "Não foi possível salvar a imagem.";
                        $tipoMensagem = "error";
                    }
                }
            }
        }

        // SALVAR NO BANCO
        if ($mensagem === "") {

            $ordem = $ordem !== false && $ordem !== null ? $ordem : 0;

            if ($id > 0) {

                $stmt = $conn->prepare("
                    UPDATE patrimonios
                    SET nome = ?,
                        descricao = ?,
                        imagem = ?,
                        localizacao = ?,
                        ordem = ?,
                        ativo = ?
                    WHERE id = ?
                ");

                $stmt->bind_param(
                    "ssssiii",
                    $nome,
                    $descricao,
                    $imagem,
                    $localizacao,
                    $ordem,
                    $ativo,
                    $id
                );

            } else {

                $stmt = $conn->prepare("
                    INSERT INTO patrimonios
                    (nome, descricao, imagem, localizacao, ordem, ativo)
                    VALUES (?, ?, ?, ?, ?, ?)
                ");

                $stmt->bind_param(
                    "ssssii",
                    $nome,
                    $descricao,
                    $imagem,
                    $localizacao,
                    $ordem,
                    $ativo
                );
            }

            if ($stmt->execute()) {
                $mensagem = $id > 0
                    ? "Patrimônio atualizado com sucesso!"
                    : "Patrimônio cadastrado com sucesso!";
            } else {
                $mensagem = "Erro ao salvar patrimônio: " . $stmt->error;
                $tipoMensagem = "error";
            }

            $stmt->close();
        }
    }
}

// BUSCAR PATRIMÔNIO PARA EDIÇÃO
$editando = null;

if (isset($_GET["editar"])) {

    $idEditar = filter_input(INPUT_GET, "editar", FILTER_VALIDATE_INT);

    if ($idEditar) {

        $stmt = $conn->prepare("SELECT * FROM patrimonios WHERE id = ?");
        $stmt->bind_param("i", $idEditar);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $editando = $resultado->fetch_assoc();

        $stmt->close();
    }
}

// LISTAR PATRIMÔNIOS
$patrimonios = [];

$resultado = $conn->query("
    SELECT *
    FROM patrimonios
    ORDER BY ordem ASC, id DESC
");

if ($resultado) {
    while ($linha = $resultado->fetch_assoc()) {
        $patrimonios[] = $linha;
    }
}

$total = count($patrimonios);

$totalAtivos = 0;

foreach ($patrimonios as $patrimonio) {
    if ((int) $patrimonio["ativo"] === 1) {
        $totalAtivos++;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Patrimônios | Administração</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="min-h-screen bg-[#f5f2ec] text-[#252525]">

    <div class="flex min-h-screen">

        <!-- CONTEÚDO -->
        <main class="w-full p-6 md:p-10">

            <!-- CABEÇALHO -->
            <header class="mb-10 flex flex-col justify-between gap-5 md:flex-row md:items-center">

                <div>

                    <a href="index.php"
                        class="mb-4 inline-flex items-center gap-2 text-sm text-gray-500 transition hover:text-[#c72b30]">

                        <i class="bi bi-arrow-left"></i>
                        Voltar ao painel

                    </a>

                    <span class="block text-xs font-bold uppercase tracking-[0.3em] text-[#c72b30]">
                        Gerenciamento de conteúdo
                    </span>

                    <h1 class="mt-2 font-serif text-3xl font-bold md:text-4xl">
                        Patrimônios
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Gerencie os patrimônios históricos e culturais do Japão.
                    </p>

                </div>

                <a href="?novo=1"
                    class="inline-flex items-center justify-center gap-2 rounded-sm bg-[#c72b30] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#a51e24]">

                    <i class="bi bi-plus-lg"></i>
                    Novo patrimônio

                </a>

            </header>

            <!-- MENSAGEM -->
            <?php if ($mensagem !== ""): ?>

                <div class="mb-7 rounded-lg border p-4
                    <?= $tipoMensagem === "success"
                        ? "border-green-200 bg-green-50 text-green-800"
                        : "border-red-200 bg-red-50 text-red-800" ?>">

                    <?= e($mensagem) ?>

                </div>

            <?php endif; ?>

            <!-- INDICADORES -->
            <section class="mb-8 grid gap-5 sm:grid-cols-2">

                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500">Total de patrimônios</p>

                            <h2 class="mt-2 text-3xl font-bold">
                                <?= $total ?>
                            </h2>
                        </div>

                        <span class="flex h-12 w-12 items-center justify-center rounded-full bg-red-50 text-xl text-[#c72b30]">
                            <i class="bi bi-bank"></i>
                        </span>

                    </div>

                </div>

                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500">Patrimônios ativos</p>

                            <h2 class="mt-2 text-3xl font-bold">
                                <?= $totalAtivos ?>
                            </h2>
                        </div>

                        <span class="flex h-12 w-12 items-center justify-center rounded-full bg-green-50 text-xl text-green-700">
                            <i class="bi bi-check-circle"></i>
                        </span>

                    </div>

                </div>

            </section>

            <!-- FORMULÁRIO -->
            <?php if (isset($_GET["novo"]) || $editando): ?>

                <section class="mb-10 rounded-xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">

                    <div class="mb-7">

                        <h2 class="font-serif text-2xl font-bold">
                            <?= $editando ? "Editar patrimônio" : "Cadastrar patrimônio" ?>
                        </h2>

                        <p class="mt-2 text-sm text-gray-500">
                            Preencha as informações do patrimônio histórico.
                        </p>

                    </div>

                    <form method="POST" enctype="multipart/form-data" class="space-y-6">

                        <input type="hidden" name="acao" value="salvar">

                        <input type="hidden" name="id"
                            value="<?= e($editando["id"] ?? 0) ?>">

                        <input type="hidden" name="imagem_atual"
                            value="<?= e($editando["imagem"] ?? "") ?>">

                        <div class="grid gap-6 md:grid-cols-2">

                            <div class="md:col-span-2">

                                <label class="mb-2 block text-sm font-semibold">
                                    Nome do patrimônio *
                                </label>

                                <input type="text"
                                    name="nome"
                                    required
                                    maxlength="150"
                                    value="<?= e($editando["nome"] ?? "") ?>"
                                    placeholder="Ex.: Monte Fuji"
                                    class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none transition focus:border-[#c72b30]">

                            </div>

                            <div class="md:col-span-2">

                                <label class="mb-2 block text-sm font-semibold">
                                    Descrição
                                </label>

                                <textarea
                                    name="descricao"
                                    rows="5"
                                    placeholder="Escreva sobre a história e importância desse patrimônio..."
                                    class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none transition focus:border-[#c72b30]"><?= e($editando["descricao"] ?? "") ?></textarea>

                            </div>

                            <div>

                                <label class="mb-2 block text-sm font-semibold">
                                    Localização
                                </label>

                                <input type="text"
                                    name="localizacao"
                                    maxlength="150"
                                    value="<?= e($editando["localizacao"] ?? "") ?>"
                                    placeholder="Ex.: Quioto, Japão"
                                    class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none transition focus:border-[#c72b30]">

                            </div>

                            <div>

                                <label class="mb-2 block text-sm font-semibold">
                                    Ordem de exibição
                                </label>

                                <input type="number"
                                    name="ordem"
                                    min="0"
                                    value="<?= e($editando["ordem"] ?? 0) ?>"
                                    class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none transition focus:border-[#c72b30]">

                            </div>

                            <div class="md:col-span-2">

                                <label class="mb-2 block text-sm font-semibold">
                                    Fotografia do patrimônio
                                </label>

                                <input type="file"
                                    name="imagem"
                                    accept="image/jpeg,image/png,image/webp,image/gif"
                                    class="w-full rounded-lg border border-gray-200 bg-white p-3 text-sm">

                                <p class="mt-2 text-xs text-gray-500">
                                    Formatos JPG, PNG, WEBP ou GIF. Tamanho máximo: 5 MB.
                                    Deixe vazio para manter a imagem atual.
                                </p>

                                <?php if (!empty($editando["imagem"])): ?>

                                    <div class="mt-4">

                                        <p class="mb-2 text-xs font-semibold text-gray-500">
                                            IMAGEM ATUAL
                                        </p>

                                        <img
                                            src="<?= e(caminhoImagem($editando["imagem"])) ?>"
                                            alt="Imagem atual"
                                            class="h-40 w-56 rounded-lg border object-cover">

                                    </div>

                                <?php endif; ?>

                            </div>

                            <div class="md:col-span-2">

                                <label class="flex items-center gap-3">

                                    <input type="checkbox"
                                        name="ativo"
                                        value="1"
                                        <?= !isset($editando["ativo"]) || (int) $editando["ativo"] === 1 ? "checked" : "" ?>
                                        class="h-4 w-4 accent-[#c72b30]">

                                    <span class="text-sm font-medium">
                                        Patrimônio ativo no site
                                    </span>

                                </label>

                            </div>

                        </div>

                        <div class="flex flex-wrap gap-3 border-t border-gray-100 pt-6">

                            <button type="submit"
                                class="rounded-sm bg-[#c72b30] px-7 py-3 text-sm font-semibold text-white transition hover:bg-[#a51e24]">

                                <i class="bi bi-check-lg mr-2"></i>

                                <?= $editando ? "Salvar alterações" : "Cadastrar patrimônio" ?>

                            </button>

                            <a href="patrimonios.php"
                                class="rounded-sm border border-gray-200 px-7 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100">

                                Cancelar

                            </a>

                        </div>

                    </form>

                </section>

            <?php endif; ?>

            <!-- LISTAGEM -->
            <section class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">

                <div class="border-b border-gray-100 p-6">

                    <h2 class="font-serif text-xl font-bold">
                        Patrimônios cadastrados
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Gerencie os registros existentes no sistema.
                    </p>

                </div>

                <?php if (empty($patrimonios)): ?>

                    <div class="p-12 text-center">

                        <i class="bi bi-bank text-4xl text-gray-300"></i>

                        <p class="mt-4 font-semibold text-gray-600">
                            Nenhum patrimônio cadastrado.
                        </p>

                        <p class="mt-2 text-sm text-gray-400">
                            Clique em Novo patrimônio para começar.
                        </p>

                    </div>

                <?php else: ?>

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[750px] text-left">

                            <thead class="bg-[#f8f5ef] text-xs uppercase tracking-wider text-gray-500">

                                <tr>
                                    <th class="px-6 py-4">Patrimônio</th>
                                    <th class="px-6 py-4">Localização</th>
                                    <th class="px-6 py-4">Ordem</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Ações</th>
                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-100">

                                <?php foreach ($patrimonios as $patrimonio): ?>

                                    <tr class="transition hover:bg-gray-50">

                                        <td class="px-6 py-4">

                                            <div class="flex items-center gap-4">

                                                <?php if (!empty($patrimonio["imagem"])): ?>

                                                    <img
                                                        src="<?= e(caminhoImagem($patrimonio["imagem"])) ?>"
                                                        alt="<?= e($patrimonio["nome"]) ?>"
                                                        class="h-14 w-16 rounded-lg object-cover">

                                                <?php else: ?>

                                                    <div class="flex h-14 w-16 items-center justify-center rounded-lg bg-gray-100 text-xl text-gray-400">
                                                        <i class="bi bi-image"></i>
                                                    </div>

                                                <?php endif; ?>

                                                <div>
                                                    <p class="font-semibold">
                                                        <?= e($patrimonio["nome"]) ?>
                                                    </p>

                                                    <p class="mt-1 text-xs text-gray-400">
                                                        ID: <?= e($patrimonio["id"]) ?>
                                                    </p>
                                                </div>

                                            </div>

                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <?= e($patrimonio["localizacao"] ?: "Não informada") ?>
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <?= e($patrimonio["ordem"]) ?>
                                        </td>

                                        <td class="px-6 py-4">

                                            <?php if ((int) $patrimonio["ativo"] === 1): ?>

                                                <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                                                    Ativo
                                                </span>

                                            <?php else: ?>

                                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-500">
                                                    Inativo
                                                </span>

                                            <?php endif; ?>

                                        </td>

                                        <td class="px-6 py-4">

                                            <div class="flex justify-end gap-2">

                                                <a href="?editar=<?= e($patrimonio["id"]) ?>"
                                                    title="Editar"
                                                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-700 transition hover:bg-blue-100">

                                                    <i class="bi bi-pencil"></i>

                                                </a>

                                                <form method="POST">

                                                    <input type="hidden" name="acao" value="status">

                                                    <input type="hidden" name="id"
                                                        value="<?= e($patrimonio["id"]) ?>">

                                                    <input type="hidden" name="ativo"
                                                        value="<?= (int) $patrimonio["ativo"] === 1 ? 0 : 1 ?>">

                                                    <button type="submit"
                                                        title="Alterar status"
                                                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-700 transition hover:bg-amber-100">

                                                        <i class="bi bi-power"></i>

                                                    </button>

                                                </form>

                                                <form method="POST"
                                                    onsubmit="return confirm('Tem certeza que deseja excluir este patrimônio?')">

                                                    <input type="hidden" name="acao" value="excluir">

                                                    <input type="hidden" name="id"
                                                        value="<?= e($patrimonio["id"]) ?>">

                                                    <button type="submit"
                                                        title="Excluir"
                                                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-700 transition hover:bg-red-100">

                                                        <i class="bi bi-trash"></i>

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                <?php endif; ?>

            </section>

            <footer class="mt-8 text-center text-xs text-gray-400">
                Japão — Painel Administrativo
            </footer>

        </main>

    </div>

</body>

</html>
