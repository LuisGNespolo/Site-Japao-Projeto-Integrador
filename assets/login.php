
<?php

session_start();

require_once "../database/conexao.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";

    if ($email === "" || $senha === "") {

        $erro = "Preencha o e-mail e a senha.";

    } else {

        $sql = "
            SELECT id, nome, email, senha_hash, ativo
            FROM administradores
            WHERE email = :email
            AND ativo = 1
            LIMIT 1
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ":email" => $email
        ]);

        $administrador = $stmt->fetch(PDO::FETCH_ASSOC);

        if (
            !$administrador ||
            !password_verify($senha, $administrador["senha_hash"])
        ) {

            $erro = "E-mail ou senha incorretos.";

        } else {

            session_regenerate_id(true);

            $_SESSION["admin_id"] = $administrador["id"];
            $_SESSION["admin_nome"] = $administrador["nome"];
            $_SESSION["admin_email"] = $administrador["email"];
            $_SESSION["logado"] = true;

            header("Location: admin/index.php");
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Área Administrativa | Japão Integrador</title>

    <link rel="stylesheet" href="../src/output.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .imagem-japao {
            background-image:
                linear-gradient(
                    to bottom,
                    rgba(25, 20, 25, 0.15),
                    rgba(25, 20, 25, 0.75)
                ),
                url('https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=1400&q=85');

            background-size: cover;
            background-position: center;
        }

        .decoracao {
            color: rgba(148, 31, 50, 0.12);
            user-select: none;
        }

        input:focus {
            outline: none;
            border-color: #941F32;
            box-shadow: 0 0 0 3px rgba(148, 31, 50, 0.10);
        }
    </style>

</head>

<body class="min-h-screen bg-[#F5F0E8]">

    <main class="grid min-h-screen lg:grid-cols-2">

        <!-- LADO DA IMAGEM -->

        <section class="imagem-japao relative flex min-h-[300px] flex-col justify-between overflow-hidden px-8 py-8 text-white sm:px-12 sm:py-12 lg:min-h-screen lg:px-16 lg:py-14">

            <div class="relative z-10">

                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-white/80">
                    Cultura e tradição
                </p>

                <h1 class="mt-3 text-3xl font-bold tracking-wide sm:text-4xl">
                    JAPÃO
                    <span class="font-normal text-[#E9B9BE]">.</span>
                </h1>

            </div>

            <div class="relative z-10 max-w-lg py-10">

                <p class="mb-4 text-sm font-semibold uppercase tracking-[0.25em] text-[#E9B9BE]">
                    Japão Integrador
                </p>

                <h2 class="text-4xl font-bold leading-tight sm:text-5xl lg:text-6xl">
                    Uma cultura,
                    <br>
                    infinitas histórias.
                </h2>

                <p class="mt-6 max-w-md text-base leading-relaxed text-white/80">
                    Explore a riqueza cultural, as tradições e os encantos do Japão através do nosso projeto.
                </p>

                <div class="mt-8 h-1 w-20 rounded-full bg-[#941F32]"></div>

            </div>

            <div class="relative z-10 flex items-center justify-between border-t border-white/30 pt-6">

                <p class="text-xs tracking-wider text-white/70">
                    PROJETO INTEGRADOR
                </p>

                <p class="text-2xl text-[#E9B9BE]">
                    日本
                </p>

            </div>

            <!-- Detalhe decorativo -->

            <span class="decoracao absolute -bottom-20 -right-5 text-[280px] font-bold">
                桜
            </span>

        </section>


        <!-- LADO DO LOGIN -->

        <section class="relative flex min-h-[600px] items-center justify-center overflow-hidden px-6 py-12 sm:px-12 lg:min-h-screen">

            <!-- Decoração -->

            <span class="decoracao pointer-events-none absolute -right-8 top-0 text-[180px] font-bold">
                桜
            </span>

            <span class="decoracao pointer-events-none absolute -bottom-16 -left-8 text-[180px] font-bold">
                花
            </span>


            <!-- FORMULÁRIO -->

            <div class="relative z-10 w-full max-w-md rounded-2xl border border-[#E8DDD0] bg-white px-7 py-10 shadow-[0_15px_50px_rgba(60,40,30,0.08)] sm:px-10 sm:py-12">

                <!-- Cabeçalho -->

                <div class="mb-9 text-center">

                    <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-[#F8EDEF]">

                        <span class="text-3xl text-[#941F32]">
                            日
                        </span>

                    </div>

                    <p class="mb-2 text-xs font-bold uppercase tracking-[0.25em] text-[#941F32]">
                        Área restrita
                    </p>

                    <h2 class="text-3xl font-bold text-[#292524]">
                        Bem-vindo!
                    </h2>

                    <p class="mt-3 text-sm leading-relaxed text-[#82766E]">
                        Acesse o painel administrativo do Japão Integrador.
                    </p>

                </div>


                <!-- Mensagem de erro -->

                <?php if ($erro !== ""): ?>

                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-center text-sm font-medium text-red-700">

                        <?= htmlspecialchars($erro) ?>

                    </div>

                <?php endif; ?>


                <!-- Formulário -->

                <form action="login.php" method="POST" class="space-y-6">

                    <div>

                        <label for="email" class="mb-2 block text-sm font-semibold text-[#443B36]">
                            E-mail
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            autocomplete="username"
                            value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"
                            placeholder="Digite seu e-mail"
                            class="w-full rounded-lg border border-[#DED5CC] bg-[#FCFAF7] px-4 py-3.5 text-sm text-[#292524] transition placeholder:text-[#A69A90]">

                    </div>


                    <div>

                        <label for="senha" class="mb-2 block text-sm font-semibold text-[#443B36]">
                            Senha
                        </label>

                        <input
                            type="password"
                            id="senha"
                            name="senha"
                            required
                            autocomplete="current-password"
                            placeholder="Digite sua senha"
                            class="w-full rounded-lg border border-[#DED5CC] bg-[#FCFAF7] px-4 py-3.5 text-sm text-[#292524] transition placeholder:text-[#A69A90]">

                    </div>


                    <!-- Botão -->

                    <button
                        type="submit"
                        class="w-full rounded-lg bg-[#941F32] px-5 py-4 text-sm font-bold tracking-wide text-white shadow-md transition duration-300 hover:-translate-y-0.5 hover:bg-[#781827] hover:shadow-lg">

                        Entrar no painel

                    </button>

                </form>


                <!-- Voltar -->

                <div class="mt-8 border-t border-[#EEE7DF] pt-6 text-center">

                    <a
                        href="../index.php"
                        class="text-sm font-medium text-[#82766E] transition hover:text-[#941F32]">

                        ← Voltar para o site

                    </a>

                </div>


                <p class="mt-8 text-center text-[10px] font-semibold uppercase tracking-[0.2em] text-[#B5A99E]">
                    Japão Integrador · 2026
                </p>

            </div>

        </section>

    </main>

</body>
</html>
