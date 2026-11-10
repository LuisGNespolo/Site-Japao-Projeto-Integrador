<?php
include_once("../templates/header.php");
?>


<main>

  <!-- HERO -->
  <section
    class="relative flex min-h-[380px] items-center bg-cover bg-center text-white md:min-h-[460px]"
    style="background-image: url('../img/surfBanner.png');">
    <div class="absolute inset-0 bg-gradient-to-r from-[#071018]/80 via-[#071018]/40 to-black/10"></div>

    <div class="relative mx-auto w-full max-w-7xl px-6 py-16 md:px-10">
      <div class="mb-4 h-1 w-10 rounded-full bg-[#c72b30]"></div>
      <h1 class="font-serif text-3xl font-semibold italic tracking-wide md:text-5xl">
        Surf no Japão
      </h1>
    </div>
  </section>

  <!-- CONTEÚDO -->
  <section class="bg-white py-14 md:py-20">
    <div class="mx-auto grid max-w-7xl gap-14 px-6 md:grid-cols-3 md:gap-0 md:px-10">

      <!-- Coluna 1: O surf no Japão -->
      <article class="md:pr-10">
        <div class="mb-4 h-1 w-10 rounded-full bg-[#c72b30]"></div>

        <h2 class="titulo font-serif text-3xl font-bold text-[#171717]">O surf no Japão</h2>
        <p class="mt-4 max-w-sm text-sm leading-7 text-[#45413d] md:text-base">
          O Japão possui praias famosas para a prática do surf, como Shonan e Chiba.
          O esporte tem ganhado cada vez mais espaço entre os jovens e nas cidades litorâneas.
        </p>

        <img src="../img/onda.png" alt="Surfista em uma onda no litoral japonês"
          class="mt-10 aspect-[4/3] w-full max-w-sm rounded-lg object-cover shadow-md ring-1 ring-black/5" />
      </article>

      <!-- Coluna 2: Surf e Olimpíadas -->
      <article class="md:border-l md:border-[#c72b30]/30 md:px-10">
        <div class="mb-4 h-1 w-10 rounded-full bg-[#c72b30]"></div>

        <h2 class="titulo font-serif text-3xl font-bold text-[#171717]">Surf e Olimpíadas</h2>
        <p class="mt-4 max-w-sm text-sm leading-7 text-[#45413d] md:text-base">
          O surf entrou para o programa olímpico nas Olimpíadas de Tóquio 2020, marcando um
          momento histórico para o esporte no país.
        </p>

        <img src="../img/olimpiadas.png" alt="Fogos de artifício e anéis olímpicos"
          class="mt-10 aspect-[4/3] w-full max-w-sm rounded-lg object-cover shadow-md ring-1 ring-black/5" />
      </article>

      <!-- Coluna 3: Impacto -->
      <article class="md:border-l md:border-[#c72b30]/30 md:pl-10">
        <div class="mb-4 h-1 w-10 rounded-full bg-[#c72b30]"></div>

        <h2 class="titulo font-serif text-3xl font-bold text-[#171717]">Impacto</h2>
        <p class="mt-4 max-w-sm text-sm leading-7 text-[#45413d] md:text-base">
          O surf movimenta o turismo, o comércio e a economia local, além de influenciar a cultura
          das cidades litorâneas e atrair visitantes do mundo todo.
        </p>

        <div class="mt-10 flex items-start gap-5">
          <ul class="space-y-3 text-xs font-bold tracking-wider text-[#171717]">
            <li class="flex items-center gap-3 rounded-lg bg-[#f8f5ef] px-4 py-3 ring-1 ring-black/5">
              <svg class="h-6 w-6 shrink-0 text-[#c72b30]" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M6 2h12a1 1 0 0 1 1 1v19l-7-4-7 4V3a1 1 0 0 1 1-1Zm6 4-1.2 2.6-2.8.3 2.1 1.9-.6 2.8 2.5-1.4 2.5 1.4-.6-2.8 2.1-1.9-2.8-.3L12 6Z" />
              </svg>
              O turismo local
            </li>
            <li class="flex items-center gap-3 rounded-lg bg-[#f8f5ef] px-4 py-3 ring-1 ring-black/5">
              <svg class="h-6 w-6 shrink-0 text-[#c72b30]" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M8.5 3 6 9H2v2h1l1.5 9h15L21 11h1V9h-4l-2.5-6-1.8.8L16 9H8l2.3-5.2L8.5 3ZM9 13h2v5H9v-5Zm4 0h2v5h-2v-5Z" />
              </svg>
              O comércio local
            </li>
            <li class="flex items-center gap-3 rounded-lg bg-[#f8f5ef] px-4 py-3 ring-1 ring-black/5">
              <svg class="h-6 w-6 shrink-0 text-[#c72b30]" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M12 2 2 7v2h20V7L12 2ZM4 10v8h3v-8H4Zm6.5 0v8h3v-8h-3ZM17 10v8h3v-8h-3ZM2 19v3h20v-3H2Z" />
              </svg>
              Eventos esportivos
            </li>
            <li class="flex items-center gap-3 rounded-lg bg-[#f8f5ef] px-4 py-3 ring-1 ring-black/5">
              <svg class="h-6 w-6 shrink-0 text-[#c72b30]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <rect x="3" y="4" width="18" height="14" rx="2" />
                <circle cx="14" cy="14" r="4" fill="white" />
                <path d="M14 12v4M12.5 13h2.5a.8.8 0 0 1 0 1.6h-1.5a.8.8 0 0 0 0 1.6H16" stroke-linecap="round" />
              </svg>
              A economia local
            </li>
          </ul>

          <img src="../img/casa.png" alt="Templo japonês com pagode"
            class="hidden aspect-[3/4] w-28 rounded-lg object-cover shadow-md ring-1 ring-black/5 lg:block" />
        </div>
      </article>

    </div>
  </section>

</main>


<?php include '../../assets/templates/footer.php'; ?>