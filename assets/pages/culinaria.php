<?php
include_once("../templates/header.php");
?>

<main>

  <!-- HERO -->
  <section
    class="relative flex min-h-[380px] items-center bg-cover bg-center text-white md:min-h-[460px]"
    style="background-image: url('./../img/culinariaBanner.png');">
    <!-- escurece a imagem para dar leitura ao texto -->
    <div class="absolute inset-0 bg-gradient-to-r from-[#071018]/90 via-[#071018]/50 to-black/20"></div>

    <div cla  ss="relative mx-auto w-full max-w-7xl px-6 py-16 md:px-10">
      <div class="mb-4 h-1 w-10 rounded-full bg-[#c72b30]"></div>
      <h1 class="font-serif text-3xl font-semibold italic tracking-wide md:text-5xl">
        Do Japão para o mundo
      </h1>
      <p class="mt-3 max-w-xs text-sm leading-relaxed text-gray-200 md:max-w-md md:text-lg">
        A culinária japonesa é tradição, cultura e também uma grande força econômica.
      </p>
      <span class="mt-4 block text-3xl text-[#e0585d] md:text-4xl" lang="ja">食物</span>
    </div>
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
              <img src="../img/sushi.png" alt="Sushi"
                class="aspect-[3/4] w-full object-cover transition duration-500 group-hover:scale-105" />
            </div>
            <span class="block py-3 text-xs font-bold tracking-[0.2em]">SUSHI</span>
          </li>
          <li class="group overflow-hidden rounded-lg bg-[#f8f5ef] text-center shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="overflow-hidden">
              <img src="../img/sashimi.png" alt="Sashimi"
                class="aspect-[3/4] w-full object-cover transition duration-500 group-hover:scale-105" />
            </div>
            <span class="block py-3 text-xs font-bold tracking-[0.2em]">SASHIMI</span>
          </li>
          <li class="group overflow-hidden rounded-lg bg-[#f8f5ef] text-center shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="overflow-hidden">
              <img src="../img/ramen.png" alt="Ramen"
                class="aspect-[3/4] w-full object-cover transition duration-500 group-hover:scale-105" />
            </div>
            <span class="block py-3 text-xs font-bold tracking-[0.2em]">RAMEN</span>
          </li>
          <li class="group overflow-hidden rounded-lg bg-[#f8f5ef] text-center shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="overflow-hidden">
              <img src="../img/yakisoba.png" alt="Yakisoba"
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

        <img src="../img/japonesCozinhando.png" alt="Chef preparando pratos em um balcão de restaurante japonês"
          class="mt-10 aspect-[4/3] w-full max-w-lg rounded-lg object-cover shadow-md ring-1 ring-black/5" />
      </article>

    </div>
  </section>

</main>

<?php include '../../assets/templates/footer.php'; ?>