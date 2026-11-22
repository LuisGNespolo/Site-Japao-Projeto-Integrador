
<?php
session_start();

if (!isset($_SESSION["logado"]) || $_SESSION["logado"] !== true) {
    header("Location: ../login.php");
    exit;
}

require_once "../../database/conexao.php";

$conn->set_charset("utf8mb4");

$nomeAdmin = $_SESSION["admin_nome"] ?? "Administrador";
$mensagem = "";
$tipoMensagem = "sucesso";


function e($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
}

$raizProjeto = dirname(__DIR__, 2);
$pastaUpload = $raizProjeto . "/assets/img/gerenciadas/";

if (!is_dir($pastaUpload)) {
    mkdir($pastaUpload, 0755, true);
}

function escapar($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, "UTF-8");
}

/* CATEGORIAS DAS IMAGENS */
$categorias = [
    "home" => "Página inicial",
    "culinaria" => "Culinária",
    "futebol" => "Futebol",
    "lendas" => "Lendas japonesas",
    "patrimonios" => "Patrimônios",
    "surf" => "Surfe"
];

/* SUBSTITUIR IMAGEM */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["substituir"])) {

    $id = (int)($_POST["id"] ?? 0);

    if (
        !isset($_FILES["nova_imagem"]) ||
        $_FILES["nova_imagem"]["error"] !== UPLOAD_ERR_OK
    ) {
        $mensagem = "Selecione uma imagem válida.";
        $tipoMensagem = "erro";

    } else {

        $arquivo = $_FILES["nova_imagem"];
        $tamanhoMaximo = 5 * 1024 * 1024;

        $tiposPermitidos = [
            "image/jpeg" => "jpg",
            "image/png" => "png",
            "image/webp" => "webp",
            "image/gif" => "gif"
        ];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $tipoArquivo = $finfo->file($arquivo["tmp_name"]);

        if (!isset($tiposPermitidos[$tipoArquivo])) {

            $mensagem = "Formato inválido. Utilize JPG, PNG, WEBP ou GIF.";
            $tipoMensagem = "erro";

        } elseif ($arquivo["size"] > $tamanhoMaximo) {

            $mensagem = "A imagem deve ter no máximo 5 MB.";
            $tipoMensagem = "erro";

        } else {

            /* VERIFICAR SE A IMAGEM EXISTE NO BANCO */
            $consulta = $conn->prepare("
                SELECT id, caminho
                FROM imagens_site
                WHERE id = ?
            ");

            $consulta->bind_param("i", $id);
            $consulta->execute();

            $resultado = $consulta->get_result();
            $imagemAtual = $resultado->fetch_assoc();

            $consulta->close();

            if (!$imagemAtual) {

                $mensagem = "Imagem não encontrada no banco de dados.";
                $tipoMensagem = "erro";

            } else {

                /* CRIAR NOME ÚNICO */
                $extensao = $tiposPermitidos[$tipoArquivo];
                $nomeArquivo = bin2hex(random_bytes(16)) . "." . $extensao;

                $destino = $pastaUpload . $nomeArquivo;
                $novoCaminho = "assets/img/gerenciadas/" . $nomeArquivo;

                if (move_uploaded_file($arquivo["tmp_name"], $destino)) {

                    /* ATUALIZAR CAMINHO NO BANCO */
                    $atualizar = $conn->prepare("
                        UPDATE imagens_site
                        SET caminho = ?
                        WHERE id = ?
                    ");

                    $atualizar->bind_param(
                        "si",
                        $novoCaminho,
                        $id
                    );

                    if ($atualizar->execute()) {

                        $mensagem = "Imagem substituída com sucesso!";
                        $tipoMensagem = "sucesso";

                    } else {

                        $mensagem = "Não foi possível atualizar o banco de dados.";
                        $tipoMensagem = "erro";

                        // Remover o novo arquivo se a atualização falhar
                        if (file_exists($destino)) {
                            unlink($destino);
                        }
                    }

                    $atualizar->close();

                } else {

                    $mensagem = "Não foi possível salvar o arquivo.";
                    $tipoMensagem = "erro";
                }
            }
        }
    }
}

/* BUSCAR IMAGENS */
$resultado = $conn->query("
    SELECT *
    FROM imagens_site
    ORDER BY id ASC
");

$imagensPorCategoria = [];

foreach ($categorias as $chave => $nomeCategoria) {
    $imagensPorCategoria[$chave] = [];
}

if ($resultado) {

    while ($imagem = $resultado->fetch_assoc()) {

        $partes = explode("_", $imagem["chave"]);
        $categoria = $partes[0];

        if (isset($imagensPorCategoria[$categoria])) {
            $imagensPorCategoria[$categoria][] = $imagem;
        }
    }
}

$totalImagens = $resultado ? $resultado->num_rows : 0;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gerenciar Imagens | Japão</title>

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

        .botao-principal {
            background: #a52828;
            color: white;
            padding: 11px 17px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
        }

        .botao-principal:hover {
            background: #821d1d;
        }

        .imagem-card {
            transition: .3s;
        }

        .imagem-card:hover {
            transform: translateY(-3px);
        }

        .campo-arquivo {
            display: block;
            width: 100%;
            padding: 10px;
            border: 1px solid #dedbd3;
            border-radius: 9px;
            background: #faf9f6;
            font-size: 12px;
        }

        .previa {
            width: 100%;
            height: 190px;
            object-fit: cover;
            border-radius: 10px;
            background: #eeeae1;
        }

    </style>

</head>

<body class="min-h-screen">

    <!-- CABEÇALHO -->

    <header class="bg-[#172334] text-white shadow-md">

        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-5">

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#e45a5e]">
                    Japão
                </p>

                <h1 class="mt-1 text-2xl font-semibold">
                    Gerenciar imagens
                </h1>
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

            <p class="text-sm text-[#a52828] font-semibold uppercase tracking-widest">
                Personalização do site
            </p>

            <h2 class="text-4xl text-[#172334] mt-2">
                Gerenciar imagens
            </h2>

            <p class="text-gray-500 mt-2">
                Escolha quais imagens deseja modificar em cada página do site.
            </p>

        </div>


        <!-- INFORMAÇÕES -->

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-8">

            <div class="bg-white rounded-2xl p-6 border border-[#eeeae1]">

                <div class="flex justify-between items-center">

                    <div>
                        <p class="text-sm text-gray-500">
                            Imagens disponíveis
                        </p>

                        <h3 class="text-3xl text-[#172334] mt-2">
                            <?= escapar($totalImagens) ?>
                        </h3>
                    </div>

                    <i class="bi bi-images text-3xl text-[#a52828]"></i>

                </div>

            </div>


            <div class="bg-white rounded-2xl p-6 border border-[#eeeae1]">

                <div class="flex justify-between items-center">

                    <div>
                        <p class="text-sm text-gray-500">
                            Categorias
                        </p>

                        <h3 class="text-3xl text-[#172334] mt-2">
                            <?= count($categorias) ?>
                        </h3>
                    </div>

                    <i class="bi bi-grid text-3xl text-[#a52828]"></i>

                </div>

            </div>

        </div>


        <!-- MENSAGEM -->

        <?php if ($mensagem): ?>

            <div class="mb-6 p-4 rounded-xl
                <?= $tipoMensagem === "erro"
                    ? "bg-red-100 text-red-800"
                    : "bg-green-100 text-green-800" ?>">

                <?= escapar($mensagem) ?>

            </div>

        <?php endif; ?>


        <!-- CATEGORIAS E IMAGENS -->

        <?php foreach ($categorias as $chave => $nomeCategoria): ?>

            <?php if (!empty($imagensPorCategoria[$chave])): ?>

                <section class="bg-white rounded-2xl border border-[#eeeae1] shadow-sm p-6 md:p-8 mb-8">

                    <div class="flex items-center justify-between mb-6">

                        <div>

                            <p class="text-xs uppercase tracking-widest text-[#a52828] font-semibold">
                                Categoria
                            </p>

                            <h3 class="text-2xl text-[#172334] mt-1">
                                <?= escapar($nomeCategoria) ?>
                            </h3>

                        </div>

                        <i class="bi bi-images text-3xl text-[#a52828]"></i>

                    </div>


                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        <?php foreach ($imagensPorCategoria[$chave] as $imagem): ?>

                            <div class="imagem-card border border-[#eeeae1] rounded-xl p-4">

                                <!-- IMAGEM ATUAL -->

                                <div class="relative mb-4">

                                    <img
                                        src="../../<?= escapar($imagem["caminho"]) ?>"
                                        alt="<?= escapar($imagem["nome"]) ?>"
                                        class="previa"
                                    >

                                    <span class="absolute top-3 left-3 bg-white/90 text-[#172334] text-xs px-3 py-1 rounded-full">
                                        Atual
                                    </span>

                                </div>


                                <!-- INFORMAÇÕES -->

                                <h4 class="font-semibold text-[#172334]">
                                    <?= escapar($imagem["nome"]) ?>
                                </h4>

                                <p class="text-xs text-gray-500 mt-1 mb-4">
                                    <?= escapar($imagem["descricao"]) ?>
                                </p>


                                <!-- FORMULÁRIO -->

                                <form
                                    method="POST"
                                    enctype="multipart/form-data"
                                    class="space-y-3"
                                    onsubmit="return confirmarAlteracao(this)"
                                >

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= escapar($imagem["id"]) ?>"
                                    >

                                    <label class="block text-xs font-semibold text-gray-700">
                                        Escolher nova imagem
                                    </label>

                                    <input
                                        type="file"
                                        name="nova_imagem"
                                        class="campo-arquivo"
                                        accept="image/jpeg,image/png,image/webp,image/gif"
                                        onchange="mostrarPrevia(this)"
                                        required
                                    >

                                    <!-- PRÉVIA DA NOVA IMAGEM -->

                                    <div class="hidden area-previa">

                                        <p class="text-xs text-green-700 font-semibold mb-2">
                                            Pré-visualização
                                        </p>

                                        <img
                                            src=""
                                            alt="Pré-visualização da nova imagem"
                                            class="previa imagem-nova"
                                        >

                                    </div>


                                    <button
                                        type="submit"
                                        name="substituir"
                                        value="1"
                                        class="botao-principal w-full"
                                    >

                                        <i class="bi bi-arrow-repeat mr-2"></i>
                                        Substituir imagem

                                    </button>

                                </form>

                            </div>

                        <?php endforeach; ?>

                    </div>

                </section>

            <?php endif; ?>

        <?php endforeach; ?>


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


    <script>

        // MOSTRAR PRÉVIA DA IMAGEM ESCOLHIDA

        function mostrarPrevia(input) {

            const formulario = input.closest("form");
            const areaPrevia = formulario.querySelector(".area-previa");
            const imagemNova = formulario.querySelector(".imagem-nova");

            if (input.files && input.files[0]) {

                const arquivo = input.files[0];

                const tiposPermitidos = [
                    "image/jpeg",
                    "image/png",
                    "image/webp",
                    "image/gif"
                ];

                if (!tiposPermitidos.includes(arquivo.type)) {
                    alert("Escolha uma imagem JPG, PNG, WEBP ou GIF.");
                    input.value = "";
                    areaPrevia.classList.add("hidden");
                    return;
                }

                if (arquivo.size > 5 * 1024 * 1024) {
                    alert("A imagem deve ter no máximo 5 MB.");
                    input.value = "";
                    areaPrevia.classList.add("hidden");
                    return;
                }

                imagemNova.src = URL.createObjectURL(arquivo);
                areaPrevia.classList.remove("hidden");

            } else {

                areaPrevia.classList.add("hidden");

            }
        }


        // CONFIRMAR SUBSTITUIÇÃO

        function confirmarAlteracao(formulario) {

            const confirmar = confirm(
                "Deseja realmente substituir esta imagem?"
            );

            if (confirmar) {
                return true;
            }

            return false;
        }

    </script>

</body>
</html>
