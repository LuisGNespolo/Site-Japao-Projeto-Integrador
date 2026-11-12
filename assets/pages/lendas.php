
<?php
$dados = require '../templates/dados.php';
$lendas = $dados['lendas'];

include_once '../templates/header.php';

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}
?>

<main class="bg-[#11100f]">

    <!-- BANNER -->
    <section class="relative isolate flex min-h-[480px] items-center overflow-hidden bg-[#100d0c] md:min-h-[560px]">

        <div
            class="absolute inset-0 -z-20 bg-cover bg-center"
            style="background-image: url('../img/lendas/banner.png');"
        ></div>

        <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#100d0c] via-[#100d0c]/85 to-[#100d0c]/20"></div>

        <div class="mx-auto w-full max-w-7xl px-6 py-20 md:px-10">

            <div class="max-w-2xl">

                <span class="mb-6 inline-flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.35em] text-[#d64a4e]">
                    <span class="h-px w-10 bg-[#c72b30]"></span>
                    Folclore japonês
                </span>

                <h1 class="font-serif text-4xl font-bold italic leading-tight text-[#f8f5ef] md:text-6xl lg:text-7xl">
                    Entre deuses,<br>
                    monstros e <span class="text-[#c72b30]">lendas.</span>
                </h1>

                <p class="mt-6 max-w-lg text-sm leading-8 text-gray-300 md:text-base">
                    Conheça histórias ancestrais, criaturas sobrenaturais e
                    divindades que atravessaram gerações e moldaram o
                    imaginário japonês.
                </p>

                <a
                    href="#lendas"
                    class="mt-9 inline-flex items-center gap-3 border border-[#c72b30] bg-[#c72b30] px-7 py-4 text-xs font-bold uppercase tracking-[0.2em] text-white transition duration-300 hover:bg-transparent hover:text-[#e45a5e]"
                >
                    Explorar lendas
                    <span>↓</span>
                </a>

            </div>

        </div>

        <div class="absolute bottom-0 left-0 h-1 w-full bg-gradient-to-r from-[#c72b30] via-[#8b2024] to-transparent"></div>

    </section>


    <!-- INTRODUÇÃO -->
    <section class="border-b border-white/5 bg-[#171513] py-16 md:py-20">

        <div class="mx-auto grid max-w-7xl items-center gap-10 px-6 md:grid-cols-2 md:px-10">

            <div>

                <span class="text-xs font-bold uppercase tracking-[0.3em] text-[#c72b30]">
                    Tradição e mistério
                </span>

                <h2 class="mt-4 font-serif text-3xl font-bold leading-tight text-[#f8f5ef] md:text-4xl">
                    Um universo de histórias e criaturas extraordinárias
                </h2>

                <div class="mt-5 h-px w-16 bg-[#c72b30]"></div>

                <p class="mt-6 text-sm leading-8 text-gray-400 md:text-base">
                    O folclore japonês é formado por histórias transmitidas
                    de geração em geração. Nele encontramos deuses,
                    espíritos, monstros e criaturas misteriosas que fazem
                    parte da cultura e das tradições do Japão.
                </p>

                <p class="mt-4 text-sm leading-8 text-gray-400 md:text-base">
                    Cada lenda possui características próprias, trazendo
                    ensinamentos, mistérios e representações da relação
                    entre os seres humanos e o mundo sobrenatural.
                </p>

            </div>

            <div class="relative">

                <div class="absolute -inset-3 rounded-lg border border-[#c72b30]/30"></div>

                <img
                    src="../img/lendas/lendas.png"
                    alt="Universo das lendas japonesas"
                    class="relative aspect-[5/4] w-full rounded-lg object-cover shadow-2xl"
                    loading="lazy"
                >

                <div class="absolute bottom-0 left-0 right-0 rounded-b-lg bg-gradient-to-t from-black/80 to-transparent p-6">
                    <p class="font-serif text-lg italic text-white">
                        Histórias que nunca deixam de ser contadas.
                    </p>
                </div>

            </div>

        </div>

    </section>


    <!-- CARDS -->
    <section id="lendas" class="bg-[#11100f] py-20 md:py-28">

        <div class="mx-auto max-w-7xl px-6 md:px-10">

            <div class="mb-14 text-center">

                <span class="text-xs font-bold uppercase tracking-[0.35em] text-[#c72b30]">
                    Mitologia e folclore
                </span>

                <h2 class="mt-4 font-serif text-3xl font-bold text-[#f8f5ef] md:text-5xl">
                    Conheça as lendas
                </h2>

                <p class="mx-auto mt-4 max-w-xl text-sm leading-7 text-gray-400">
                    Cada história guarda mistérios, ensinamentos e criaturas
                    que fazem parte da rica tradição japonesa.
                </p>

                <div class="mx-auto mt-7 h-px w-20 bg-[#c72b30]"></div>

            </div>


            <ul class="grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-3">

                <?php foreach ($lendas as $lenda): ?>

                    <li>

                        <button
                            type="button"
                            data-abrir-modal="modal-<?= e($lenda['id']) ?>"
                            aria-haspopup="dialog"
                            class="group block w-full overflow-hidden rounded-lg border border-white/10 bg-[#1c1a18] text-left transition duration-500 hover:-translate-y-2 hover:border-[#c72b30]/70 hover:shadow-2xl focus:outline-none focus-visible:ring-2 focus-visible:ring-[#c72b30]"
                        >

                            <div class="relative overflow-hidden">

                                <img
                                    src="<?= e($lenda['imagem']) ?>"
                                    alt="<?= e($lenda['nome']) ?>"
                                    loading="lazy"
                                    class="aspect-[4/5] w-full object-cover transition duration-700 group-hover:scale-110"
                                >

                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/10 to-transparent"></div>

                                <span class="absolute left-5 top-5 border border-white/30 bg-black/40 px-3 py-2 text-[10px] font-semibold uppercase tracking-[0.2em] text-white backdrop-blur-sm">
                                    Lenda japonesa
                                </span>

                                <div class="absolute inset-x-0 bottom-0 p-6">

                                    <div class="mb-3 h-px w-10 bg-[#c72b30] transition-all duration-500 group-hover:w-20"></div>

                                    <h3 class="font-serif text-2xl font-bold text-white">
                                        <?= e($lenda['nome']) ?>
                                    </h3>

                                    <p class="mt-2 font-serif text-sm italic text-gray-300">
                                        <?= e($lenda['subtitulo']) ?>
                                    </p>

                                    <div class="mt-5 flex items-center justify-between border-t border-white/20 pt-4">

                                        <span class="text-[10px] uppercase tracking-[0.2em] text-gray-300">
                                            Descobrir história
                                        </span>

                                        <span class="flex h-8 w-8 items-center justify-center rounded-full border border-[#c72b30] text-[#e15a5e] transition group-hover:bg-[#c72b30] group-hover:text-white">
                                            →
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </button>

                    </li>

                <?php endforeach; ?>

            </ul>

        </div>

    </section>


    <!-- MODAIS -->
    <?php foreach ($lendas as $lenda): ?>

        <dialog
            id="modal-<?= e($lenda['id']) ?>"
            aria-labelledby="titulo-<?= e($lenda['id']) ?>"
            class="m-auto max-h-[90vh] w-[94%] max-w-3xl overflow-hidden rounded-xl border border-[#b18a60]/40 bg-[#171513] p-0 text-left text-[#f8f5ef] shadow-2xl backdrop:bg-black/80 backdrop:backdrop-blur-sm"
        >

            <div class="relative max-h-[90vh] overflow-y-auto">

                <button
                    type="button"
                    data-fechar-modal
                    aria-label="Fechar"
                    class="sticky right-4 top-4 z-20 float-right mr-4 mt-4 flex h-10 w-10 items-center justify-center rounded-full border border-white/20 bg-black/70 text-2xl text-white transition hover:border-[#c72b30] hover:bg-[#c72b30]"
                >
                    &times;
                </button>


                <!-- CABEÇALHO DO MODAL -->
                <div class="relative min-h-[260px] overflow-hidden">

                    <img
                        src="<?= e($lenda['imagem']) ?>"
                        alt="<?= e($lenda['nome']) ?>"
                        class="absolute inset-0 h-full w-full object-cover opacity-40"
                    >

                    <div class="absolute inset-0 bg-gradient-to-t from-[#171513] via-[#171513]/60 to-black/20"></div>

                    <div class="relative flex min-h-[260px] flex-col justify-end px-7 pb-8 pt-16 md:px-12">

                        <span class="mb-3 text-xs font-bold uppercase tracking-[0.3em] text-[#d64a4e]">
                            Folclore japonês
                        </span>

                        <h2
                            id="titulo-<?= e($lenda['id']) ?>"
                            class="font-serif text-3xl font-bold md:text-5xl"
                        >
                            <?= e($lenda['nome']) ?>
                        </h2>

                        <p class="mt-3 font-serif text-sm italic text-gray-300">
                            <?= e($lenda['subtitulo']) ?>
                        </p>

                    </div>

                </div>


                <!-- CONTEÚDO DO MODAL -->
                <div class="px-7 pb-10 md:px-12">

                    <!-- SIGNIFICADO -->
                    <div class="grid gap-5 border-y border-white/10 py-7 sm:grid-cols-2">

                        <div>

                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c72b30]">
                                Nome japonês
                            </span>

                            <p class="mt-2 font-serif text-lg text-[#f8f5ef]">
                                <?= e($lenda['nome_japones']) ?>
                            </p>

                        </div>

                        <div>

                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c72b30]">
                                Significado
                            </span>

                            <p class="mt-2 font-serif text-lg text-[#f8f5ef]">
                                <?= e($lenda['significado']) ?>
                            </p>

                        </div>

                    </div>


                    <!-- HISTÓRIA -->
                    <div class="py-8">

                        <div class="mb-6 flex items-center gap-3">

                            <span class="h-px w-8 bg-[#c72b30]"></span>

                            <h3 class="font-serif text-xl font-bold">
                                A história
                            </h3>

                        </div>

                        <div class="space-y-5 text-sm leading-8 text-gray-300 md:text-base">

                            <?php foreach ($lenda['historia'] as $paragrafo): ?>

                                <p><?= e($paragrafo) ?></p>

                            <?php endforeach; ?>

                        </div>

                    </div>


                    <!-- COMO AGE -->
                    <?php if (!empty($lenda['como_age'])): ?>

                        <div class="mb-8 border-l-2 border-[#c72b30] bg-white/[0.03] p-6">

                            <h3 class="mb-4 font-serif text-lg font-bold text-[#d64a4e]">
                                Como ela age
                            </h3>

                            <div class="space-y-4 text-sm leading-7 text-gray-300">

                                <?php foreach ($lenda['como_age'] as $paragrafo): ?>

                                    <p><?= e($paragrafo) ?></p>

                                <?php endforeach; ?>

                            </div>

                        </div>

                    <?php endif; ?>


                    <!-- CURIOSIDADE -->
                    <?php if (!empty($lenda['curiosidade'])): ?>

                        <div class="rounded-lg border border-[#b18a60]/30 bg-[#b18a60]/5 p-6">

                            <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-[#d6ad7c]">
                                Você sabia?
                            </span>

                            <p class="mt-3 font-serif text-sm leading-7 text-gray-300">
                                <?= e($lenda['curiosidade']) ?>
                            </p>

                        </div>

                    <?php endif; ?>


                    <!-- RODAPÉ DO MODAL -->
                    <div class="mt-10 border-t border-white/10 pt-6 text-center">

                        <span class="font-serif text-xs italic tracking-widest text-gray-500">
                            — Mistérios do folclore japonês —
                        </span>

                    </div>

                </div>

            </div>

        </dialog>

    <?php endforeach; ?>


    <!-- RODAPÉ DECORATIVO -->
    <section class="border-t border-white/5 bg-[#171513] px-6 py-12 text-center">

        <span class="text-xs uppercase tracking-[0.3em] text-[#c72b30]">
            Cultura japonesa
        </span>

        <p class="mx-auto mt-3 max-w-xl font-serif text-lg italic leading-8 text-gray-400">
            O passado permanece vivo nas histórias que continuam sendo contadas.
        </p>

        <div class="mx-auto mt-6 h-px w-16 bg-[#c72b30]"></div>

    </section>

</main>


<!-- JAVASCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', () => {

    // Abrir modal
    document.querySelectorAll('[data-abrir-modal]').forEach((botao) => {

        botao.addEventListener('click', () => {

            const modal = document.getElementById(botao.dataset.abrirModal);

            if (modal) {
                modal.showModal();
                document.body.classList.add('overflow-hidden');
            }

        });

    });


    // Configuração dos modais
    document.querySelectorAll('dialog').forEach((modal) => {

        const botaoFechar = modal.querySelector('[data-fechar-modal]');

        // Fechar pelo botão X
        if (botaoFechar) {
            botaoFechar.addEventListener('click', () => {
                modal.close();
            });
        }

        // Fechar clicando fora
        modal.addEventListener('click', (evento) => {

            if (evento.target === modal) {
                modal.close();
            }

        });

        // Restaurar rolagem
        modal.addEventListener('close', () => {

            if (!document.querySelector('dialog[open]')) {
                document.body.classList.remove('overflow-hidden');
            }

        });

    });

});
</script>

<?php include_once '../templates/footer.php'; ?>
