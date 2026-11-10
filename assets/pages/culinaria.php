<?php
include_once("../templates/header.php");
?>

<main>

  <!-- HERO -->
  <section
    class="relative flex min-h-[380px] items-center bg-cover bg-center text-white md:min-h-[460px]"
    style="background-image: url('img/hero-sushi.jpg');"
  >
    <!-- escurece a imagem para dar leitura ao texto -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/20 to-black/50"></div>

    <div class="relative mx-auto w-full max-w-6xl px-6 pt-24 md:px-10">
      <h1 class="font-serif text-2xl italic tracking-wide md:text-4xl">
        Do Japão para o mundo
      </h1>
      <p class="mt-2 max-w-xs text-sm leading-snug md:max-w-sm md:text-base">
        A culinária japonesa é tradição, cultura e também uma grande força econômica.
      </p>
      <span class="mt-2 block text-3xl md:text-4xl" lang="ja">食物</span>
    </div>
  </section>

  <!-- CONTEÚDO -->
  <section class="bg-white py-14 md:py-20">
    <div class="mx-auto grid max-w-6xl gap-12 px-6 md:grid-cols-2 md:gap-0 md:px-10">

      <!-- Coluna: A culinária japonesa -->
      <article class="md:pr-10">
        <div class="mb-6 h-[3px] w-28 bg-[#b0584a]"></div>

        <h2 class="font-serif text-xl text-black">A culinária japonesa</h2>
        <p class="mt-3 max-w-md font-serif text-sm leading-relaxed text-gray-800">
          Rica em sabores, frescor e equilíbrio, a culinária japonesa é um dos maiores símbolos do país.
          Seus pratos conquistaram o mundo e se tornaram referência de qualidade e saúde.
        </p>

        <ul class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-4">
          <li class="text-center">
            <img src="img/sushi.jpg" alt="Sushi"
                 class="aspect-[3/5] w-full rounded-md object-cover" />
            <span class="mt-2 block text-sm tracking-wide">SUSHI</span>
          </li>
          <li class="text-center">
            <img src="img/sashimi.jpg" alt="Sashimi"
                 class="aspect-[3/5] w-full rounded-md object-cover" />
            <span class="mt-2 block text-sm tracking-wide">SASHIMI</span>
          </li>
          <li class="text-center">
            <img src="img/ramen.jpg" alt="Ramen"
                 class="aspect-[3/5] w-full rounded-md object-cover" />
            <span class="mt-2 block text-sm tracking-wide">RAMEN</span>
          </li>
          <li class="text-center">
            <img src="img/yakisoba.jpg" alt="Yakisoba"
                 class="aspect-[3/5] w-full rounded-md object-cover" />
            <span class="mt-2 block text-sm tracking-wide">YAKISOBA</span>
          </li>
        </ul>
      </article>

      <!-- Coluna: Empreendedorismo (com divisória vertical) -->
      <article class="md:border-l-2 md:border-[#b0584a] md:pl-10">
        <h2 class="font-serif text-xl text-black md:mt-[1.65rem]">Empreendedorismo</h2>
        <p class="mt-3 max-w-md font-serif text-sm leading-relaxed text-gray-800">
          Muitos negócios familiares mantêm receitas tradicionais e, ao longo do tempo, a gastronomia
          japonesa se tornou uma importante atividade turística e econômica, gerando milhares de empregos.
        </p>

        <img src="img/restaurante.jpg" alt="Chef preparando pratos em um balcão de restaurante japonês"
             class="mt-10 w-full max-w-md object-cover md:mt-[7.5rem]" />
      </article>

    </div>
  </section>

</main>

<?php include '../../assets/templates/footer.php'; ?>