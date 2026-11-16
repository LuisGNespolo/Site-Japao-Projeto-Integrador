<?php
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

<style>
    .heritage-page {
        --heritage-ink: #172b2b;
        --heritage-deep: #102c2b;
        --heritage-red: #b83a36;
        --heritage-gold: #b7965b;
        --heritage-paper: #f3eee3;
        background: var(--heritage-paper);
        color: var(--heritage-ink);
        overflow: hidden;
    }

    .heritage-page .heritage-hero {
        background:
            linear-gradient(105deg, rgba(10, 30, 30, .95), rgba(10, 30, 30, .68) 48%, rgba(10, 30, 30, .12)),
            url('../img/patrimonios/banner.png') center / cover;
    }

    .heritage-page .heritage-paper {
        background-color: var(--heritage-paper);
        background-image: linear-gradient(90deg, rgba(183,150,91,.12) 1px, transparent 1px);
        background-size: 54px 100%;
    }

    .heritage-page .heritage-stamp {
        border-bottom: 1px solid rgba(217,174,114,.7);
        padding-bottom: .6rem;
        text-align: right;
    }

    .heritage-page .heritage-photo {
        filter: saturate(.78);
        transition: filter .5s ease, transform .5s ease, clip-path .5s ease;
    }

    .heritage-page .overflow-hidden:hover .heritage-photo {
        filter: saturate(1.05);
        clip-path: inset(.35rem);
    }

    .heritage-page .heritage-card {
        box-shadow: 0 22px 50px -38px rgba(16,44,43,.75);
    }

    .heritage-page .heritage-route {
        background-image: repeating-linear-gradient(90deg, var(--heritage-gold) 0 6px, transparent 6px 13px);
        background-position: center;
        background-repeat: no-repeat;
        background-size: 100% 1px;
    }

    .heritage-page .heritage-ticket {
        position: relative;
        border: 1px solid rgba(183,150,91,.45);
        background: #fffdf8;
    }

    .heritage-page .heritage-ticket::after {
        position: absolute;
        right: -.35rem;
        top: 0;
        bottom: 0;
        border-right: 1px dashed rgba(183,150,91,.7);
        content: '';
    }

    .heritage-page .heritage-seal {
        border: 1px solid rgba(183,150,91,.65);
        color: var(--heritage-gold);
    }

    @media (prefers-reduced-motion: reduce) {
        .heritage-page .heritage-photo { transition: none; }
    }
</style>

<main class="heritage-page font-['Poppins']">

    <!-- ABERTURA -->
    <section id="inicio" class="heritage-hero relative isolate min-h-[740px] overflow-hidden text-white md:min-h-[820px]">
        <div class="relative mx-auto flex min-h-[740px] max-w-7xl flex-col justify-between px-6 pb-12 pt-28 md:min-h-[820px] md:px-10">
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <p class="tracking-[.2em] text-[10px] font-bold uppercase text-white/55">Japan slow travel</p>
                    <p class="mt-2 text-sm text-white/75">æ—¥æœ¬ã®æ—… · A viagem pelo Japão</p>
                </div>
                <div class="heritage-stamp hidden text-[10px] font-bold text-[#d9ae72] md:block">
                    <span class="block text-[9px] uppercase tracking-[.25em] text-white/45">TRAVEL NOTE</span>
                    <span class="mt-1 block text-xl leading-none">KYOTO / 08:40</span>
                </div>
            </div>

            <div class="relative z-10 max-w-3xl">
                <div class="mb-6 flex items-center gap-3">
                    <span class="h-px w-14 bg-[#b7965b]"></span>
                    <p class="tracking-[.2em] text-[10px] font-bold uppercase text-[#d9ae72]">lugares · memória · presença</p>
                </div>
                <h1 class="font-['Playfair_Display'] tracking-[-.055em] text-6xl font-semibold leading-[.9] sm:text-7xl md:text-9xl">
                    Viajar é<br><span class="text-[#d9ae72]">permanecer.</span>
                </h1>
                <p class="mt-8 max-w-xl text-sm leading-8 text-white/65 md:text-base">
                    Um roteiro pelos lugares onde o Japão antigo continua vivo:
                    montanhas sagradas, santuários, castelos e jardins que
                    transformam turismo em experiência.
                </p>
                <a href="#roteiro" class="mt-9 inline-flex items-center gap-3 bg-[#b83a36] px-7 py-4 text-[10px] font-bold uppercase tracking-[.2em] transition hover:-translate-y-1 hover:bg-[#962d2b]">
                    Começar a viagem <i class="bi bi-arrow-down-right"></i>
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 h-1 w-full bg-gradient-to-r from-[#b83a36] via-[#d9ae72] to-transparent"></div>
    </section>

    <!-- PASSAPORTE -->
    <section class="bg-[#102c2b] text-white">
        <div class="mx-auto grid max-w-7xl divide-y divide-white/10 px-6 md:grid-cols-4 md:divide-x md:divide-y-0 md:px-10">
            <div class="py-7 md:px-7 md:first:pl-0"><p class="tracking-[.2em] text-[9px] text-white/40">01 / ALTITUDE</p><p class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-3xl">Fuji</p><p class="mt-2 text-xs text-white/50">A montanha como símbolo.</p></div>
            <div class="py-7 md:px-7"><p class="tracking-[.2em] text-[9px] text-white/40">02 / MEMÃ“RIA</p><p class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-3xl">Himeji</p><p class="mt-2 text-xs text-white/50">Pedras que atravessam séculos.</p></div>
            <div class="py-7 md:px-7"><p class="tracking-[.2em] text-[9px] text-white/40">03 / ESPÍRITO</p><p class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-3xl">Kyoto</p><p class="mt-2 text-xs text-white/50">Rituais em cada caminho.</p></div>
            <div class="py-7 md:px-7 md:last:pr-0"><p class="tracking-[.2em] text-[9px] text-white/40">04 / ROTA</p><p class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-3xl">âˆž</p><p class="mt-2 text-xs text-white/50">Sempre há outro templo.</p></div>
        </div>
    </section>

    <!-- MANIFESTO -->
    <section class="heritage-paper px-6 py-24 md:px-10 md:py-32">
        <div class="mx-auto grid max-w-7xl gap-14 lg:grid-cols-[.8fr_1.2fr] lg:items-end">
            <div>
                <p class="tracking-[.2em] text-[10px] font-bold text-[#b83a36]">01 / O OLHAR DO VIAJANTE</p>
                <h2 class="font-['Playfair_Display'] tracking-[-.055em] mt-4 text-5xl font-semibold leading-none md:text-7xl">O destino<br><span class="text-[#b83a36]">é o caminho.</span></h2>
                <p class="mt-7 max-w-md text-sm leading-8 text-[#59635e]">
                    Viajar pelo Japão tradicional é desacelerar. Ã‰ ouvir o
                    silêncio de um jardim, acompanhar a fumaça de um incenso
                    e perceber que cada detalhe guarda uma história.
                </p>
                <div class="mt-9 flex gap-8 border-t border-[#b83a36]/25 pt-6">
                    <div><p class="font-['Playfair_Display'] tracking-[-.055em] text-4xl text-[#b83a36]">01</p><p class="tracking-[.2em] text-[9px] text-[#747b72]">OLHAR</p></div>
                    <div><p class="font-['Playfair_Display'] tracking-[-.055em] text-4xl text-[#b83a36]">02</p><p class="tracking-[.2em] text-[9px] text-[#747b72]">ESCUTA</p></div>
                    <div><p class="font-['Playfair_Display'] tracking-[-.055em] text-4xl text-[#b83a36]">âˆž</p><p class="tracking-[.2em] text-[9px] text-[#747b72]">MEMÃ“RIAS</p></div>
                </div>
            </div>
            <div class="relative min-h-[430px]">
                <div class="overflow-hidden absolute inset-0">
                    <img src="../img/patrimonios/memoria.png" alt="Arquitetura tradicional japonesa" class="heritage-photo h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#102c2b]/80 via-transparent to-transparent"></div>
                </div>
                <p class="border-l border-[#d9ae72]/60 pl-2 tracking-[.18em] absolute right-5 top-6 text-xs text-white/70">é™ · ç¾Ž · 伝 · çµ†</p>
                <div class="absolute bottom-7 left-7"><p class="tracking-[.2em] text-[9px] text-[#d9ae72]">TRAVEL NOTE / 001</p><p class="font-['Playfair_Display'] tracking-[-.055em] mt-2 text-3xl text-white">O tempo mora aqui.</p></div>
            </div>
        </div>
    </section>

    <!-- ROTEIRO -->
    <section id="roteiro" class="bg-[#fdfbf7] px-6 py-24 md:px-10 md:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="mb-14 flex flex-wrap items-end justify-between gap-8">
                <div>
                    <p class="tracking-[.2em] text-[10px] font-bold text-[#b83a36]">02 / ROTEIRO DE MEMÃ“RIA</p>
                    <h2 class="font-['Playfair_Display'] tracking-[-.055em] mt-4 text-5xl font-semibold leading-none md:text-7xl">Cinco paradas,<br><span class="text-[#b83a36]">um Japão inteiro.</span></h2>
                </div>
                <p class="max-w-sm text-sm leading-7 text-[#59635e]">Abra cada parada e descubra as histórias, localizações e curiosidades que esperam pelo viajante.</p>
            </div>

            <div class="heritage-route mb-10 hidden h-4 md:block"></div>
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-5">
                <?php foreach ($patrimonios as $indice => $item): ?>
                    <article class="heritage-card heritage-ticket group relative overflow-hidden">
                        <button type="button" data-abrir-modal="modal-<?= e($item['id']) ?>" class="flex h-full w-full flex-col text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-[#b83a36]">
                            <div class="overflow-hidden relative aspect-[4/5]">
                                <img src="<?= e($item['imagem']) ?>" alt="<?= e($item['nome']) ?>" loading="lazy" class="heritage-photo h-full w-full object-cover">
                                <span class="absolute left-4 top-4 flex h-8 w-8 items-center justify-center rounded-sm bg-[#b83a36] text-xs font-bold text-white"><?= str_pad((string) ($indice + 1), 2, '0', STR_PAD_LEFT) ?></span>
                            </div>
                            <div class="flex flex-1 flex-col p-5">
                                <p class="tracking-[.2em] text-[8px] font-bold text-[#b83a36]"><?= e($item['localizacao']) ?></p>
                                <h3 class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-2xl"><?= e($item['nome']) ?></h3>
                                <p class="mt-3 text-xs leading-6 text-[#68736e]"><?= e($item['resumo']) ?></p>
                                <span class="mt-auto inline-flex items-center gap-2 pt-6 text-[9px] font-bold uppercase tracking-[.18em] text-[#b83a36]">Abrir nota <i class="bi bi-arrow-up-right"></i></span>
                            </div>
                        </button>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CAMADAS DA PAISAGEM -->
    <section class="bg-[#102c2b] px-6 py-24 text-white md:px-10 md:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-14 lg:grid-cols-[.8fr_1.2fr] lg:items-center">
                <div>
                    <p class="tracking-[.2em] text-[10px] font-bold text-[#d9ae72]">03 / CAMADAS DA PAISAGEM</p>
                    <h2 class="font-['Playfair_Display'] tracking-[-.055em] mt-4 text-5xl font-semibold leading-none md:text-7xl">O Japão<br><span class="text-[#d9ae72]">em quatro gestos.</span></h2>
                    <p class="mt-7 max-w-md text-sm leading-8 text-white/55">O patrimônio não é apenas aquilo que se visita. Ã‰ a forma como a paisagem, a fé e a arquitetura continuam fazendo parte do cotidiano.</p>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <article class="heritage-card border border-white/10 bg-white/5 p-7"><i class="bi bi-bank2 text-2xl text-[#d9ae72]"></i><h3 class="font-['Playfair_Display'] tracking-[-.055em] mt-10 text-3xl">Arquitetura</h3><p class="mt-3 text-sm leading-7 text-white/45">Madeira, pedra, telhados e proporções que atravessam gerações.</p></article>
                    <article class="heritage-card border border-white/10 bg-white/5 p-7"><i class="bi bi-flower1 text-2xl text-[#d9ae72]"></i><h3 class="font-['Playfair_Display'] tracking-[-.055em] mt-10 text-3xl">Espírito</h3><p class="mt-3 text-sm leading-7 text-white/45">Santuários e templos como espaços de pausa e presença.</p></article>
                    <article class="heritage-card border border-white/10 bg-white/5 p-7"><i class="bi bi-tree text-2xl text-[#d9ae72]"></i><h3 class="font-['Playfair_Display'] tracking-[-.055em] mt-10 text-3xl">Paisagem</h3><p class="mt-3 text-sm leading-7 text-white/45">Montanhas, jardins e água formando uma mesma composição.</p></article>
                    <article class="heritage-card border border-white/10 bg-white/5 p-7"><i class="bi bi-people text-2xl text-[#d9ae72]"></i><h3 class="font-['Playfair_Display'] tracking-[-.055em] mt-10 text-3xl">Memória</h3><p class="mt-3 text-sm leading-7 text-white/45">Histórias compartilhadas entre moradores e visitantes.</p></article>
                </div>
            </div>
        </div>
    </section>

    <!-- DESTINOS ICÃ”NICOS -->
    <section class="heritage-paper px-6 py-24 md:px-10 md:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="mb-14">
                <p class="tracking-[.2em] text-[10px] font-bold text-[#b83a36]">04 / HORIZONTES</p>
                <h2 class="font-['Playfair_Display'] tracking-[-.055em] mt-4 text-5xl font-semibold leading-none md:text-7xl">Da montanha<br><span class="text-[#b83a36]">ao santuário.</span></h2>
            </div>
            <div class="grid gap-5 md:grid-cols-[1.25fr_.75fr]">
                <div class="overflow-hidden relative min-h-[430px]"><img src="../img/patrimonios/monte.png" alt="Monte Fuji" class="heritage-photo absolute inset-0 h-full w-full object-cover"><div class="absolute inset-0 bg-gradient-to-t from-[#102c2b]/85 via-transparent to-transparent"></div><div class="absolute bottom-7 left-7 text-white"><p class="tracking-[.2em] text-[9px] text-[#d9ae72]">PAISAGEM CULTURAL</p><p class="font-['Playfair_Display'] tracking-[-.055em] mt-2 text-4xl">Monte Fuji</p></div></div>
                <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-1">
                    <div class="overflow-hidden relative min-h-[205px]"><img src="../img/patrimonios/santuario.png" alt="Santuário japonês" class="heritage-photo absolute inset-0 h-full w-full object-cover"><div class="absolute inset-0 bg-gradient-to-t from-[#102c2b]/85 to-transparent"></div><p class="absolute bottom-5 left-5 font-['Playfair_Display'] tracking-[-.055em] text-2xl text-white">Espiritualidade</p></div>
                    <div class="overflow-hidden relative min-h-[205px]"><img src="../img/patrimonios/castelo.png" alt="Castelo japonês" class="heritage-photo absolute inset-0 h-full w-full object-cover"><div class="absolute inset-0 bg-gradient-to-t from-[#102c2b]/85 to-transparent"></div><p class="absolute bottom-5 left-5 font-['Playfair_Display'] tracking-[-.055em] text-2xl text-white">Fortaleza</p></div>
                </div>
            </div>
        </div>
    </section>

    <!-- MODAIS -->
    <?php foreach ($patrimonios as $item): ?>
        <dialog id="modal-<?= e($item['id']) ?>" aria-labelledby="titulo-modal-<?= e($item['id']) ?>" class="m-auto w-[92%] max-w-2xl overflow-hidden border-t-4 border-[#b83a36] bg-[#f3eee3] p-0 text-left shadow-2xl backdrop:bg-[#102c2b]/75">
            <div class="relative max-h-[85vh] overflow-y-auto px-6 pb-10 pt-8 md:px-10">
                <button type="button" data-fechar-modal aria-label="Fechar" class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full text-xl text-[#102c2b] transition hover:bg-[#b83a36]/10 hover:text-[#b83a36]">&times;</button>
                <div class="grid gap-7 md:grid-cols-[180px_1fr] md:items-start">
                    <img src="<?= e($item['imagem']) ?>" alt="<?= e($item['nome']) ?>" class="h-52 w-full object-cover shadow-md md:h-60">
                    <div>
                        <p class="tracking-[.2em] text-[9px] font-bold text-[#b83a36]"><?= e($item['localizacao']) ?></p>
                        <h2 id="titulo-modal-<?= e($item['id']) ?>" class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-4xl"><?= e($item['nome']) ?></h2>
                        <p class="mt-4 text-xs font-semibold uppercase leading-relaxed tracking-[.12em] text-[#8b7654]"><?= e($item['periodo']) ?></p>
                    </div>
                </div>
                <div class="mt-8 space-y-3 text-sm leading-7 text-[#4f5953]">
                    <?php foreach ($item['historia'] as $paragrafo): ?><p><?= e($paragrafo) ?></p><?php endforeach; ?>
                    <?php if (!empty($item['curiosidade'])): ?><p><strong class="text-[#102c2b]">Nota de viagem:</strong> <?= e($item['curiosidade']) ?></p><?php endif; ?>
                </div>
                <button type="button" data-fechar-modal class="mt-8 inline-flex items-center gap-2 bg-[#102c2b] px-7 py-3 text-xs font-bold uppercase tracking-widest text-white transition hover:bg-[#b83a36]">Fechar nota <i class="bi bi-x-lg"></i></button>
            </div>
        </dialog>
    <?php endforeach; ?>

    <!-- ENCERRAMENTO -->
    <section class="bg-[#b83a36] px-6 py-16 text-white md:px-10">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-7">
            <div><p class="tracking-[.2em] text-[10px] font-bold text-white/60">æ—… · TRAVEL SLOWLY</p><p class="font-['Playfair_Display'] tracking-[-.055em] mt-3 text-4xl md:text-5xl">Leve uma história com você.</p></div>
            <a href="#inicio" class="inline-flex items-center gap-3 border border-white/50 px-6 py-3 text-[10px] font-bold uppercase tracking-[.2em] transition hover:bg-white hover:text-[#b83a36]">Voltar ao início <i class="bi bi-arrow-up"></i></a>
        </div>
    </section>
</main>

<script>
    document.querySelectorAll('[data-abrir-modal]').forEach((botao) => {
        botao.addEventListener('click', () => {
            const modal = document.getElementById(botao.dataset.abrirModal);
            if (modal) modal.showModal();
        });
    });

    document.querySelectorAll('dialog').forEach((modal) => {
        modal.querySelectorAll('[data-fechar-modal]').forEach((botao) => {
            botao.addEventListener('click', () => modal.close());
        });
        modal.addEventListener('click', (evento) => {
            if (evento.target === modal) modal.close();
        });
    });
</script>

<?php include '../../assets/templates/footer.php'; ?>
