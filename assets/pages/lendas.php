<?php
// Carrega as lendas. Futuramente, troque por uma consulta ao banco
// que devolva um array com a mesma estrutura.
$dados = require_once '../templates/dados.php';
$lendas = $dados['lendas'];

include_once '../templates/header.php';

// Atalho para escapar texto com segurança
function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}
?>
<main>

  <!-- HERO -->
  <section
    class="relative flex min-h-[340px] items-center bg-cover bg-center text-white md:min-h-[460px]"
    style="background-image: url('../img/lendas/banner.png');"
  >
    <div class="absolute inset-0 bg-gradient-to-r from-[#071018]/85 via-[#071018]/45 to-black/10"></div>

    <div class="relative mx-auto w-full max-w-7xl px-6 py-16 md:px-10">
      <div class="mb-4 h-1 w-10 rounded-full bg-[#c72b30]"></div>
      <h1 class="font-serif text-3xl font-semibold italic tracking-wide md:text-5xl">
        Entre deuses, monstros e lendas
      </h1>
      <p class="mt-3 max-w-xs text-sm leading-relaxed text-gray-200 md:max-w-md md:text-lg">
        Histórias que atravessam gerações e fazem parte do imaginário japonês.
      </p>
    </div>
  </section>

  <!-- CARDS (repetidos com foreach) -->
  <section class="bg-white py-14 md:py-20">
    <ul class="mx-auto grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-6 sm:grid-cols-2 md:px-10 lg:grid-cols-3">

      <?php foreach ($lendas as $lenda): ?>
        <li>
          <button
            type="button"
            data-abrir-modal="modal-<?= e($lenda['id']) ?>"
            class="group block w-full overflow-hidden rounded-lg bg-[#f8f5ef] text-center shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-[#c72b30]"
          >
            <div class="overflow-hidden">
              <img
                src="<?= e($lenda['imagem']) ?>"
                alt="<?= e($lenda['nome']) ?>"
                class="aspect-[4/5] w-full object-cover transition duration-500 group-hover:scale-105"
              />
            </div>
            <span class="block px-3 py-4">
              <span class="block font-serif text-base font-semibold text-[#171717] transition group-hover:text-[#c72b30]"><?= e($lenda['nome']) ?></span>
              <span class="mt-1 block font-serif text-xs text-[#45413d]">— <?= e($lenda['subtitulo']) ?></span>
            </span>
          </button>
        </li>
      <?php endforeach; ?>

    </ul>
  </section>

  <!-- MODAIS (um por lenda) -->
  <?php foreach ($lendas as $lenda): ?>
    <dialog
      id="modal-<?= e($lenda['id']) ?>"
      class="m-auto w-[92%] max-w-2xl overflow-hidden rounded-lg border-t-4 border-[#c72b30] bg-[#f8f5ef] p-0 text-center shadow-2xl backdrop:bg-[#071018]/70"
    >
      <div class="relative max-h-[85vh] overflow-y-auto px-6 pb-10 pt-8 md:px-10">

        <button
          type="button"
          data-fechar-modal
          aria-label="Fechar"
          class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full text-xl text-gray-700 transition hover:bg-[#c72b30]/10 hover:text-[#c72b30]"
        >&times;</button>

        <img
          src="<?= e($lenda['imagem']) ?>"
          alt="<?= e($lenda['nome']) ?>"
          class="mx-auto w-44 rounded-lg shadow-md ring-1 ring-black/5 md:w-56"
        />

        <h2 class="mt-6 font-serif text-sm font-bold uppercase leading-relaxed tracking-[0.1em] text-[#c72b30]">
          Nome em japonês: <?= e($lenda['nome_japones']) ?>.<br />
          Significado: <?= e($lenda['significado']) ?>.
        </h2>

        <div class="mx-auto mt-6 max-w-xl space-y-3 font-serif text-sm leading-7 text-[#45413d]">
          <?php foreach ($lenda['historia'] as $paragrafo): ?>
            <p><?= e($paragrafo) ?></p>
          <?php endforeach; ?>

          <?php if (!empty($lenda['como_age'])): ?>
            <p class="pt-3 font-bold uppercase tracking-[0.1em] text-[#171717]">Como ela age:</p>
            <?php foreach ($lenda['como_age'] as $paragrafo): ?>
              <p><?= e($paragrafo) ?></p>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if (!empty($lenda['curiosidade'])): ?>
            <p><span class="font-bold text-[#171717]">Curiosidade:</span> <?= e($lenda['curiosidade']) ?></p>
          <?php endif; ?>
        </div>

      </div>
    </dialog>
  <?php endforeach; ?>

</main>

<script>
  // Abre o modal do card clicado
  document.querySelectorAll('[data-abrir-modal]').forEach((botao) => {
    botao.addEventListener('click', () => {
      document.getElementById(botao.dataset.abrirModal).showModal();
    });
  });

  document.querySelectorAll('dialog').forEach((modal) => {
    // Botão de fechar (X)
    modal.querySelector('[data-fechar-modal]').addEventListener('click', () => modal.close());

    // Clique fora do conteúdo (no fundo escuro) também fecha
    modal.addEventListener('click', (evento) => {
      if (evento.target === modal) modal.close();
    });
  });
</script>
<?php include_once '../templates/footer.php'; ?>