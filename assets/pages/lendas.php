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
    class="relative flex min-h-[320px] items-start bg-cover bg-center text-white md:min-h-[420px]"
    style="background-image: url('img/lendas-hero.jpg');"
  >
    <div class="relative mx-auto w-full max-w-6xl px-6 pt-24 md:px-10 md:pt-40">
      <h1 class="font-serif text-2xl italic tracking-wide md:text-3xl">
        Entre deuses, monstros e lendas
      </h1>
      <p class="mt-1 text-xs md:text-sm">
        Histórias que atravessam gerações e fazem parte do imaginário japonês.
      </p>
    </div>
  </section>

  <!-- CARDS (repetidos com foreach) -->
  <section class="bg-white py-12 md:py-16">
    <ul class="mx-auto grid max-w-5xl grid-cols-1 gap-x-10 gap-y-12 px-6 sm:grid-cols-2 md:px-10 lg:grid-cols-3">

      <?php foreach ($lendas as $lenda): ?>
        <li>
          <button
            type="button"
            data-abrir-modal="modal-<?= e($lenda['id']) ?>"
            class="group block w-full overflow-hidden rounded-md bg-[#e2dedd] text-center shadow-md transition hover:-translate-y-1 hover:shadow-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-[#b0584a]"
          >
            <img
              src="<?= e($lenda['imagem']) ?>"
              alt="<?= e($lenda['nome']) ?>"
              class="aspect-[4/5] w-full object-cover"
            />
            <span class="block px-3 py-3">
              <span class="block font-serif text-sm text-black"><?= e($lenda['nome']) ?></span>
              <span class="block font-serif text-xs text-gray-700">— <?= e($lenda['subtitulo']) ?></span>
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
      class="m-auto w-[92%] max-w-2xl rounded-md bg-[#f1efee] p-0 text-center shadow-2xl backdrop:bg-black/60"
    >
      <div class="relative max-h-[85vh] overflow-y-auto px-6 pb-10 pt-8 md:px-10">

        <button
          type="button"
          data-fechar-modal
          aria-label="Fechar"
          class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full text-xl text-gray-700 hover:bg-black/10"
        >&times;</button>

        <img
          src="<?= e($lenda['imagem']) ?>"
          alt="<?= e($lenda['nome']) ?>"
          class="mx-auto w-44 shadow-md md:w-56"
        />

        <h2 class="mt-6 font-serif text-sm font-bold uppercase leading-relaxed text-black">
          Nome em japonês: <?= e($lenda['nome_japones']) ?>.<br />
          Significado: <?= e($lenda['significado']) ?>.
        </h2>

        <div class="mt-6 space-y-3 font-serif text-sm leading-relaxed text-gray-800">
          <?php foreach ($lenda['historia'] as $paragrafo): ?>
            <p><?= e($paragrafo) ?></p>
          <?php endforeach; ?>

          <?php if (!empty($lenda['como_age'])): ?>
            <p class="pt-3 font-bold uppercase">Como ela age:</p>
            <?php foreach ($lenda['como_age'] as $paragrafo): ?>
              <p><?= e($paragrafo) ?></p>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if (!empty($lenda['curiosidade'])): ?>
            <p><span class="font-bold">Curiosidade:</span> <?= e($lenda['curiosidade']) ?></p>
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