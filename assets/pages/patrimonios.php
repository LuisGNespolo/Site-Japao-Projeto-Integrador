<?php
// Carrega os patrimônios. Futuramente, troque por uma consulta ao banco
// que devolva um array com a mesma estrutura.
$dados = require_once '../templates/dados.php';
$patrimonios = $dados['patrimonios'];

include_once '../templates/header.php';

if (!function_exists('e')) {
    function e(string $texto): string
    {
        return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    }
}
?>
<main>

  <!-- HERO -->
  <section
    class="relative flex min-h-[380px] items-start bg-cover bg-center text-white md:min-h-[480px]"
    style="background-image: url('img/patrimonios-hero.jpg');"
  >
    <div class="relative mx-auto w-full max-w-6xl px-6 pt-24 md:px-10">
      <h1 class="max-w-xs font-serif text-2xl italic leading-relaxed tracking-wide md:max-w-md md:text-3xl">
        Patrimônios que contam histórias
      </h1>
      <p class="mt-1 text-xs md:text-sm">
        Locais que preservam a tradição, a fé e a beleza do Japão.
      </p>
    </div>
  </section>

  <!-- CARDS (repetidos com foreach) -->
  <section class="bg-white py-12 md:py-16">
    <ul class="mx-auto grid max-w-6xl grid-cols-2 gap-6 px-6 sm:grid-cols-3 md:px-10 lg:grid-cols-5">

      <?php foreach ($patrimonios as $item): ?>
        <li>
          <button
            type="button"
            data-abrir-modal="modal-<?= e($item['id']) ?>"
            class="flex h-full w-full flex-col overflow-hidden rounded-md bg-[#e2dedd] text-center shadow-md transition hover:-translate-y-1 hover:shadow-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-[#b0584a]"
          >
            <img
              src="<?= e($item['imagem']) ?>"
              alt="<?= e($item['nome']) ?>"
              class="aspect-[3/4] w-full object-cover"
            />
            <span class="flex flex-1 flex-col gap-2 px-3 py-3">
              <span class="font-serif text-sm text-black"><?= e($item['nome']) ?></span>
              <span class="text-[10px] uppercase leading-snug text-gray-700"><?= e($item['resumo']) ?></span>
            </span>
          </button>
        </li>
      <?php endforeach; ?>

    </ul>
  </section>

  <!-- MODAIS (um por patrimônio) -->
  <?php foreach ($patrimonios as $item): ?>
    <dialog
      id="modal-<?= e($item['id']) ?>"
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
          src="<?= e($item['imagem']) ?>"
          alt="<?= e($item['nome']) ?>"
          class="mx-auto w-44 shadow-md md:w-56"
        />

        <h2 class="mt-6 font-serif text-lg text-black"><?= e($item['nome']) ?></h2>

        <p class="mt-2 font-serif text-xs font-bold uppercase leading-relaxed text-black">
          Localização: <?= e($item['localizacao']) ?><br />
          Período: <?= e($item['periodo']) ?>
        </p>

        <div class="mt-6 space-y-3 font-serif text-sm leading-relaxed text-gray-800">
          <?php foreach ($item['historia'] as $paragrafo): ?>
            <p><?= e($paragrafo) ?></p>
          <?php endforeach; ?>

          <?php if (!empty($item['curiosidade'])): ?>
            <p><span class="font-bold">Curiosidade:</span> <?= e($item['curiosidade']) ?></p>
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

    // Clique no fundo escuro também fecha
    modal.addEventListener('click', (evento) => {
      if (evento.target === modal) modal.close();
    });
  });
</script>
<?php include '../../assets/templates/footer.php'; ?>