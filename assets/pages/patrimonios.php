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
    class="relative flex min-h-[380px] items-center bg-cover bg-center text-white md:min-h-[460px]"
    style="background-image: url('../img/patrimoniosBanner.png');"
  >
    <div class="absolute inset-0 bg-gradient-to-r from-[#071018]/85 via-[#071018]/45 to-black/10"></div>

    <div class="relative mx-auto w-full max-w-7xl px-6 py-16 md:px-10">
      <div class="mb-4 h-1 w-10 rounded-full bg-[#c72b30]"></div>
      <h1 class="max-w-xs font-serif text-3xl font-semibold italic leading-tight tracking-wide md:max-w-lg md:text-5xl">
        Patrimônios que contam histórias
      </h1>
      <p class="mt-3 max-w-xs text-sm leading-relaxed text-gray-200 md:max-w-md md:text-lg">
        Locais que preservam a tradição, a fé e a beleza do Japão.
      </p>
    </div>
  </section>

  <!-- CARDS (repetidos com foreach) -->
  <section class="bg-white py-14 md:py-20">
    <ul class="mx-auto grid max-w-7xl grid-cols-2 gap-5 px-6 sm:grid-cols-3 md:gap-6 md:px-10 lg:grid-cols-5">

      <?php foreach ($patrimonios as $item): ?>
        <li>
          <button
            type="button"
            data-abrir-modal="modal-<?= e($item['id']) ?>"
            class="group flex h-full w-full flex-col overflow-hidden rounded-lg bg-[#f8f5ef] text-center shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-[#c72b30]"
          >
            <div class="overflow-hidden">
              <img
                src="<?= e($item['imagem']) ?>"
                alt="<?= e($item['nome']) ?>"
                class="aspect-[3/4] w-full object-cover transition duration-500 group-hover:scale-105"
              />
            </div>
            <span class="flex flex-1 flex-col gap-2 px-3 py-4">
              <span class="font-serif text-sm font-semibold text-[#171717] transition group-hover:text-[#c72b30]"><?= e($item['nome']) ?></span>
              <span class="text-[10px] uppercase leading-snug tracking-wider text-[#45413d]"><?= e($item['resumo']) ?></span>
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
          src="<?= e($item['imagem']) ?>"
          alt="<?= e($item['nome']) ?>"
          class="mx-auto w-44 rounded-lg shadow-md ring-1 ring-black/5 md:w-56"
        />

        <h2 class="titulo mt-6 font-serif text-2xl font-bold text-[#171717]"><?= e($item['nome']) ?></h2>

        <p class="mt-3 font-serif text-xs font-bold uppercase leading-relaxed tracking-[0.15em] text-[#c72b30]">
          Localização: <?= e($item['localizacao']) ?><br />
          Período: <?= e($item['periodo']) ?>
        </p>

        <div class="mx-auto mt-6 max-w-xl space-y-3 font-serif text-sm leading-7 text-[#45413d]">
          <?php foreach ($item['historia'] as $paragrafo): ?>
            <p><?= e($paragrafo) ?></p>
          <?php endforeach; ?>

          <?php if (!empty($item['curiosidade'])): ?>
            <p><span class="font-bold text-[#171717]">Curiosidade:</span> <?= e($item['curiosidade']) ?></p>
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