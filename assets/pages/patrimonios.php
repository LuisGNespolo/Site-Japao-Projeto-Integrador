
<?php
// Carrega os patrimônios
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

<main class="bg-[#f8f5ef] text-[#171717]">

  <!-- ====================================== -->
  <!-- HERO -->
  <!-- ====================================== -->

  <section
    class="relative flex min-h-[460px] items-center overflow-hidden bg-cover bg-center text-white md:min-h-[570px]"
    style="background-image: url('../img/patrimonios/banner.png');"
  >

    <div class="absolute inset-0 bg-gradient-to-r from-[#071018]/95 via-[#071018]/70 to-[#071018]/20"></div>

    <div class="pointer-events-none absolute right-10 top-8 hidden select-none font-['Noto_Sans_JP'] text-[170px] font-bold text-white/[0.07] md:block">
      日本
    </div>

    <div class="relative mx-auto w-full max-w-7xl px-6 py-20 md:px-10">

      <div class="max-w-3xl">

        <div class="mb-6 flex items-center gap-3">
          <span class="h-px w-12 bg-[#c9272c]"></span>

          <p class="text-xs font-bold uppercase tracking-[0.35em] text-red-300">
            História · Cultura · Tradição
          </p>
        </div>

        <h1 class="font-['Playfair_Display'] text-4xl font-semibold leading-tight md:text-6xl">
          Patrimônios que
          <span class="text-[#e05257]">contam histórias.</span>
        </h1>

        <p class="mt-6 max-w-xl text-sm leading-8 text-gray-300 md:text-lg">
          Entre templos antigos, castelos históricos e santuários,
          descubra lugares que preservam a memória, a espiritualidade
          e a riqueza cultural do Japão.
        </p>

        <div class="mt-7">
          <span class="font-['Noto_Sans_JP'] text-4xl text-[#e05257]">
            日本の遺産
          </span>

          <p class="mt-2 text-[10px] font-medium uppercase tracking-[0.3em] text-gray-400">
            Patrimônio japonês
          </p>
        </div>

        <a
          href="#patrimonios"
          class="mt-9 inline-flex items-center gap-4 border border-white/30 px-7 py-4 text-xs font-bold uppercase tracking-[0.2em] transition duration-300 hover:border-[#c9272c] hover:bg-[#c9272c]"
        >
          Explorar patrimônios
          <i class="bi bi-arrow-down"></i>
        </a>

      </div>
    </div>

    <div class="absolute bottom-0 left-0 h-1 w-1/3 bg-[#c9272c]"></div>

  </section>


  <!-- ====================================== -->
  <!-- INTRODUÇÃO HISTÓRICA -->
  <!-- ====================================== -->

  <section class="bg-[#f8f5ef] px-6 py-16 md:px-10 md:py-24">

    <div class="mx-auto grid max-w-7xl items-center gap-12 md:grid-cols-2">

      <div>

        <div class="mb-5 h-1 w-12 rounded-full bg-[#c72b30]"></div>

        <p class="mb-3 text-xs font-bold uppercase tracking-[0.3em] text-[#c72b30]">
          Memória e identidade
        </p>

        <h2 class="font-['Playfair_Display'] text-3xl font-semibold leading-tight text-[#171717] md:text-5xl">
          O passado que continua presente no Japão
        </h2>

        <p class="mt-6 text-sm leading-8 text-[#45413d] md:text-base">
          Os patrimônios japoneses representam séculos de história,
          tradições e transformações culturais. Templos, castelos e
          santuários preservam conhecimentos e costumes que continuam
          fazendo parte da identidade do país.
        </p>

        <p class="mt-4 text-sm leading-8 text-[#45413d] md:text-base">
          Além de sua importância histórica, esses lugares atraem
          visitantes de diferentes partes do mundo e ajudam a manter
          viva a conexão entre as antigas gerações e a sociedade atual.
        </p>

        <div class="mt-8 flex items-center gap-4 border-l-2 border-[#c72b30] pl-5">

          <span class="font-['Noto_Sans_JP'] text-3xl text-[#c72b30]">
            伝統
          </span>

          <p class="text-xs font-medium uppercase tracking-widest text-[#45413d]">
            Tradição que atravessa gerações
          </p>

        </div>

      </div>

      <div class="relative">

        <img
          src="../img/patrimonios/memoria.png"
          alt="Arquitetura tradicional japonesa"
          class="h-[350px] w-full rounded-lg object-cover shadow-xl md:h-[470px]"
        />

        <div class="absolute -bottom-5 -left-3 bg-[#071018] px-7 py-5 text-white shadow-xl md:-left-6">

          <p class="font-['Playfair_Display'] text-2xl">
            日本
          </p>

          <p class="mt-1 text-[10px] uppercase tracking-[0.2em] text-gray-300">
            História e cultura
          </p>

        </div>

      </div>

    </div>

  </section>


  <!-- ====================================== -->
  <!-- CARACTERÍSTICAS DOS PATRIMÔNIOS -->
  <!-- ====================================== -->

  <section class="bg-white px-6 py-16 md:px-10 md:py-20">

    <div class="mx-auto max-w-7xl">

      <div class="mb-12 max-w-2xl">

        <div class="mb-4 h-1 w-10 rounded-full bg-[#c72b30]"></div>

        <p class="mb-3 text-xs font-bold uppercase tracking-[0.3em] text-[#c72b30]">
          Riqueza cultural
        </p>

        <h2 class="font-['Playfair_Display'] text-3xl font-semibold text-[#171717] md:text-4xl">
          Muito além da arquitetura
        </h2>

        <p class="mt-4 text-sm leading-7 text-[#66615b] md:text-base">
          Cada patrimônio guarda elementos que ajudam a compreender
          a história, os valores e as tradições da sociedade japonesa.
        </p>

      </div>

      <div class="grid gap-6 md:grid-cols-3">

        <!-- CARD 1 -->

        <article class="group border-t-2 border-[#c72b30] bg-[#f8f5ef] p-8 transition duration-300 hover:-translate-y-1 hover:shadow-lg">

          <i class="bi bi-bank2 text-3xl text-[#c72b30]"></i>

          <h3 class="mt-6 font-['Playfair_Display'] text-xl font-bold text-[#171717]">
            Arquitetura histórica
          </h3>

          <p class="mt-3 text-sm leading-7 text-[#5b5650]">
            Construções tradicionais revelam técnicas, materiais
            e estilos arquitetônicos desenvolvidos ao longo dos séculos.
          </p>

        </article>

        <!-- CARD 2 -->

        <article class="group border-t-2 border-[#c72b30] bg-[#f8f5ef] p-8 transition duration-300 hover:-translate-y-1 hover:shadow-lg">

          <i class="bi bi-flower1 text-3xl text-[#c72b30]"></i>

          <h3 class="mt-6 font-['Playfair_Display'] text-xl font-bold text-[#171717]">
            Espiritualidade
          </h3>

          <p class="mt-3 text-sm leading-7 text-[#5b5650]">
            Templos budistas e santuários xintoístas representam
            práticas religiosas e tradições espirituais japonesas.
          </p>

        </article>

        <!-- CARD 3 -->

        <article class="group border-t-2 border-[#c72b30] bg-[#f8f5ef] p-8 transition duration-300 hover:-translate-y-1 hover:shadow-lg">

          <i class="bi bi-book-half text-3xl text-[#c72b30]"></i>

          <h3 class="mt-6 font-['Playfair_Display'] text-xl font-bold text-[#171717]">
            Preservação cultural
          </h3>

          <p class="mt-3 text-sm leading-7 text-[#5b5650]">
            A conservação desses espaços permite que novas gerações
            conheçam e valorizem a herança cultural do Japão.
          </p>

        </article>

      </div>

    </div>

  </section>


  <!-- ====================================== -->
  <!-- GALERIA DE PATRIMÔNIOS -->
  <!-- ====================================== -->

  <section
    id="patrimonios"
    class="scroll-mt-24 bg-[#f8f5ef] px-6 py-16 md:px-10 md:py-24"
  >

    <div class="mx-auto max-w-7xl">

      <div class="mb-12 max-w-2xl">

        <div class="mb-4 h-1 w-10 rounded-full bg-[#c72b30]"></div>

        <p class="mb-3 text-xs font-bold uppercase tracking-[0.3em] text-[#c72b30]">
          Conheça os lugares
        </p>

        <h2 class="font-['Playfair_Display'] text-3xl font-semibold text-[#171717] md:text-5xl">
          Tesouros históricos do Japão
        </h2>

        <p class="mt-4 text-sm leading-7 text-[#625d56] md:text-base">
          Explore alguns dos patrimônios mais marcantes do país.
          Clique em cada lugar para conhecer sua história e curiosidades.
        </p>

      </div>


      <!-- CARDS DINÂMICOS -->

      <ul class="grid grid-cols-2 gap-5 sm:grid-cols-3 md:grid-cols-4 md:gap-7 lg:grid-cols-5">

        <?php foreach ($patrimonios as $item): ?>

          <li>

            <button
              type="button"
              data-abrir-modal="modal-<?= e($item['id']) ?>"
              class="group flex h-full w-full flex-col overflow-hidden rounded-lg bg-white text-center shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-[#c72b30]"
            >

              <div class="overflow-hidden">

                <img
                  src="<?= e($item['imagem']) ?>"
                  alt="<?= e($item['nome']) ?>"
                  loading="lazy"
                  class="aspect-[3/4] w-full object-cover transition duration-500 group-hover:scale-105"
                />

              </div>

              <span class="flex flex-1 flex-col gap-2 px-3 py-5">

                <span class="font-['Playfair_Display'] text-sm font-semibold text-[#171717] transition group-hover:text-[#c72b30] md:text-base">
                  <?= e($item['nome']) ?>
                </span>

                <span class="text-[10px] uppercase leading-snug tracking-wider text-[#625d56]">
                  <?= e($item['resumo']) ?>
                </span>

                <span class="mt-2 inline-flex items-center justify-center gap-2 text-[10px] font-bold uppercase tracking-widest text-[#c72b30]">
                  Conhecer
                  <i class="bi bi-arrow-right"></i>
                </span>

              </span>

            </button>

          </li>

        <?php endforeach; ?>

      </ul>

    </div>

  </section>


  <!-- ====================================== -->
  <!-- MODAIS DOS PATRIMÔNIOS -->
  <!-- ====================================== -->

  <?php foreach ($patrimonios as $item): ?>

    <dialog
      id="modal-<?= e($item['id']) ?>"
      aria-labelledby="titulo-modal-<?= e($item['id']) ?>"
      class="m-auto w-[92%] max-w-2xl overflow-hidden rounded-lg border-t-4 border-[#c72b30] bg-[#f8f5ef] p-0 text-center shadow-2xl backdrop:bg-[#071018]/70"
    >

      <div class="relative max-h-[85vh] overflow-y-auto px-6 pb-10 pt-8 md:px-10">

        <!-- FECHAR -->

        <button
          type="button"
          data-fechar-modal
          aria-label="Fechar"
          class="absolute right-3 top-3 flex h-8 w-8 items-center justify-center rounded-full text-xl text-gray-700 transition hover:bg-[#c72b30]/10 hover:text-[#c72b30]"
        >
          &times;
        </button>


        <!-- IMAGEM -->

        <img
          src="<?= e($item['imagem']) ?>"
          alt="<?= e($item['nome']) ?>"
          class="mx-auto w-44 rounded-lg shadow-md ring-1 ring-black/5 md:w-56"
        />


        <!-- NOME -->

        <h2
          id="titulo-modal-<?= e($item['id']) ?>"
          class="mt-6 font-['Playfair_Display'] text-2xl font-bold text-[#171717]"
        >
          <?= e($item['nome']) ?>
        </h2>


        <!-- INFORMAÇÕES -->

        <p class="mt-3 text-xs font-bold uppercase leading-relaxed tracking-[0.15em] text-[#c72b30]">

          Localização: <?= e($item['localizacao']) ?>

          <br />

          Período: <?= e($item['periodo']) ?>

        </p>


        <!-- HISTÓRIA -->

        <div class="mx-auto mt-6 max-w-xl space-y-3 text-sm leading-7 text-[#45413d]">

          <?php foreach ($item['historia'] as $paragrafo): ?>

            <p>
              <?= e($paragrafo) ?>
            </p>

          <?php endforeach; ?>


          <!-- CURIOSIDADE -->

          <?php if (!empty($item['curiosidade'])): ?>

            <p>
              <span class="font-bold text-[#171717]">
                Curiosidade:
              </span>

              <?= e($item['curiosidade']) ?>
            </p>

          <?php endif; ?>

        </div>

        <button
          type="button"
          data-fechar-modal
          class="mt-8 inline-flex items-center gap-2 bg-[#071018] px-7 py-3 text-xs font-bold uppercase tracking-widest text-white transition hover:bg-[#c72b30]"
        >
          Fechar
          <i class="bi bi-x-lg"></i>
        </button>

      </div>

    </dialog>

  <?php endforeach; ?>


  <!-- ====================================== -->
  <!-- ENCERRAMENTO -->
  <!-- ====================================== -->

  <section class="relative overflow-hidden bg-[#071018] px-6 py-20 text-white md:px-10 md:py-28">

    <div class="pointer-events-none absolute -right-10 -top-16 select-none font-['Noto_Sans_JP'] text-[220px] font-bold text-white/[0.04]">
      日本
    </div>

    <div class="relative mx-auto max-w-7xl text-center">

      <div class="mx-auto mb-6 h-1 w-12 rounded-full bg-[#c72b30]"></div>

      <p class="mb-4 text-xs font-bold uppercase tracking-[0.35em] text-red-300">
        Herança japonesa
      </p>

      <h2 class="mx-auto max-w-3xl font-['Playfair_Display'] text-3xl font-semibold leading-tight md:text-5xl">
        Preservar o passado é manter viva a identidade de um povo.
      </h2>

      <p class="mx-auto mt-6 max-w-2xl text-sm leading-8 text-gray-300 md:text-base">
        Os patrimônios japoneses são testemunhos de uma história
        construída ao longo de gerações. Conhecê-los é uma forma
        de valorizar a cultura e compreender a riqueza do Japão.
      </p>

      <span class="mt-8 block font-['Noto_Sans_JP'] text-3xl text-[#e05257]">
        文化と歴史
      </span>

      <p class="mt-2 text-[10px] uppercase tracking-[0.3em] text-gray-400">
        Cultura e história
      </p>

    </div>

  </section>

</main>


<!-- ====================================== -->
<!-- JAVASCRIPT DOS MODAIS -->
<!-- ====================================== -->

<script>
  // Abre o modal do card clicado
  document.querySelectorAll('[data-abrir-modal]').forEach((botao) => {

    botao.addEventListener('click', () => {

      const modal = document.getElementById(botao.dataset.abrirModal);

      if (modal) {
        modal.showModal();
      }

    });

  });


  // Fecha os modais
  document.querySelectorAll('dialog').forEach((modal) => {

    modal.querySelectorAll('[data-fechar-modal]').forEach((botao) => {

      botao.addEventListener('click', () => {
        modal.close();
      });

    });


    // Fecha ao clicar no fundo escuro
    modal.addEventListener('click', (evento) => {

      if (evento.target === modal) {
        modal.close();
      }

    });

  });
</script>


<?php include '../../assets/templates/footer.php'; ?>