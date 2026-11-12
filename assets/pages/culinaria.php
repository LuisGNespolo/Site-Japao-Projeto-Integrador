<?php
include_once("../templates/header.php");
?>

<main>

<!-- HERO -->
<section
    class="relative flex min-h-[420px] items-center overflow-hidden bg-cover bg-center text-white md:min-h-[520px]"
    style="background-image: url('../img/culinaria/banner.png');"
>

    <!-- SOBREPOSIÇÃO ESCURA -->
    <div class="absolute inset-0 bg-gradient-to-r from-[#071018]/95 via-[#071018]/75 to-[#071018]/25"></div>

    <!-- DETALHE DECORATIVO -->
    <div class="absolute right-10 top-8 hidden select-none font-serif text-[180px] font-bold text-white/[0.07] md:block">
        食
    </div>

    <div class="relative mx-auto w-full max-w-7xl px-6 py-20 md:px-10">

        <div class="max-w-2xl">

            <!-- IDENTIFICAÇÃO -->
            <div class="mb-6 flex items-center gap-3">
                <span class="h-px w-12 bg-[#c9272c]"></span>

                <p class="text-xs font-bold uppercase tracking-[0.35em] text-red-300">
                    Tradição · Sabor · Cultura
                </p>
            </div>

            <!-- TÍTULO -->
            <h1 class="font-['Playfair_Display'] text-4xl font-semibold leading-tight md:text-6xl">
                Do Japão para o
                <span class="text-[#e05257]">mundo.</span>
            </h1>

            <!-- DESCRIÇÃO -->
            <p class="mt-5 max-w-xl text-sm leading-8 text-gray-300 md:text-lg">
                A culinária japonesa é uma expressão de tradição, arte e identidade.
                Descubra sabores, ingredientes e costumes que conquistaram o mundo.
            </p>

            <!-- ESCRITA JAPONESA -->
            <div class="mt-7">
                <span class="font-['Noto_Sans_JP'] text-4xl text-[#e05257] md:text-5xl" lang="ja">
                    和食
                </span>

                <p class="mt-2 text-[10px] font-medium uppercase tracking-[0.3em] text-gray-400">
                    Washoku · Culinária japonesa
                </p>
            </div>

            <!-- BOTÃO -->
            <a
                href="#historia"
                class="mt-9 inline-flex items-center gap-4 border border-white/30 px-7 py-4 text-xs font-bold uppercase tracking-[0.2em] transition duration-300 hover:border-[#c9272c] hover:bg-[#c9272c]"
            >
                Descobrir sabores
                <i class="bi bi-arrow-down"></i>
            </a>

        </div>
    </div>

    <!-- DETALHE INFERIOR -->
    <div class="absolute bottom-0 left-0 h-1 w-1/3 bg-[#c9272c]"></div>

</section>

  <!-- CONTEÚDO -->
  <section class="bg-white py-14 md:py-20">
    <div class="mx-auto grid max-w-7xl gap-14 px-6 md:grid-cols-2 md:gap-0 md:px-10">

      <!-- Coluna: A culinária japonesa -->
      <article class="md:pr-12">
        <div class="mb-4 h-1 w-10 rounded-full bg-[#c72b30]"></div>

        <h2 class="titulo font-serif text-3xl font-bold text-[#171717]">A culinária japonesa</h2>
        <p class="mt-4 max-w-lg text-sm leading-7 text-[#45413d] md:text-base">
          Rica em sabores, frescor e equilíbrio, a culinária japonesa é um dos maiores símbolos do país.
          Seus pratos conquistaram o mundo e se tornaram referência de qualidade e saúde.
        </p>

        <ul class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-4">
          <li class="group overflow-hidden rounded-lg bg-[#f8f5ef] text-center shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="overflow-hidden">
              <img src="../img/culinaria/sushi.png" alt="Sushi"
                class="aspect-[3/4] w-full object-cover transition duration-500 group-hover:scale-105" />
            </div>
            <span class="block py-3 text-xs font-bold tracking-[0.2em]">SUSHI</span>
          </li>
          <li class="group overflow-hidden rounded-lg bg-[#f8f5ef] text-center shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="overflow-hidden">
              <img src="../img/culinaria/sashimi.png" alt="Sashimi"
                class="aspect-[3/4] w-full object-cover transition duration-500 group-hover:scale-105" />
            </div>
            <span class="block py-3 text-xs font-bold tracking-[0.2em]">SASHIMI</span>
          </li>
          <li class="group overflow-hidden rounded-lg bg-[#f8f5ef] text-center shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="overflow-hidden">
              <img src="../img/culinaria/ramen.png" alt="Ramen"
                class="aspect-[3/4] w-full object-cover transition duration-500 group-hover:scale-105" />
            </div>
            <span class="block py-3 text-xs font-bold tracking-[0.2em]">RAMEN</span>
          </li>
          <li class="group overflow-hidden rounded-lg bg-[#f8f5ef] text-center shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="overflow-hidden">
              <img src="../img/culinaria/yakisoba.png" alt="Yakisoba"
                class="aspect-[3/4] w-full object-cover transition duration-500 group-hover:scale-105" />
            </div>
            <span class="block py-3 text-xs font-bold tracking-[0.2em]">YAKISOBA</span>
          </li>
        </ul>
      </article>

      <!-- Coluna: Empreendedorismo (com divisória vertical) -->
      <article class="md:border-l md:border-[#c72b30]/30 md:pl-12">
        <div class="mb-4 h-1 w-10 rounded-full bg-[#c72b30]"></div>

        <h2 class="titulo font-serif text-3xl font-bold text-[#171717]">Empreendedorismo</h2>
        <p class="mt-4 max-w-lg text-sm leading-7 text-[#45413d] md:text-base">
          Muitos negócios familiares mantêm receitas tradicionais e, ao longo do tempo, a gastronomia
          japonesa se tornou uma importante atividade turística e econômica, gerando milhares de empregos.
        </p>

        <img src="../img/culinaria/japonesCozinhando.png" alt="Chef preparando pratos em um balcão de restaurante japonês"
          class="mt-10 aspect-[4/3] w-full max-w-lg rounded-lg object-cover shadow-md ring-1 ring-black/5" />
      </article>

    </div>
  </section>

</main>

<?php include '../../assets/templates/footer.php'; ?>