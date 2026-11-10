<?php

/**
 * dados.php
 * Fonte de dados provisória de todo o site.
 *
 * Cada chave do array é uma SEÇÃO e funciona como uma futura TABELA do banco:
 *
 *   'cards_explorar'  -> tabela cards_explorar  (index: "Explore o Japão")
 *   'patrimonios'     -> tabela patrimonios     (página Patrimônios)
 *   'lendas'          -> tabela lendas          (página Lendas)
 *
 * Cada item dentro da seção é uma LINHA da tabela.
 * Quando o banco estiver pronto, este arquivo será substituído por consultas
 * que devolvam arrays com esta mesma estrutura, e as páginas não precisam mudar.
 *
 * Uso nas páginas:
 *   $dados = require __DIR__ . '/dados.php';
 *   $lendas = $dados['lendas'];
 */

return [

    /* ==========================================================
     * INDEX — cards "Explore o Japão"
     * Colunas: titulo, imagem, link
     * ========================================================== */
    'cards_explorar' => [
        [
            'titulo' => 'Futebol',
            'imagem' => './assets/img/home/futebol.png',
            'link'   => './assets/pages/futebol.php',
        ],
        [
            'titulo' => 'Culinária e Empreendedorismo',
            'imagem' => './assets/img/home/culinaria.png',
            'link'   => './assets/pages/culinaria.php',
        ],
        [
            'titulo' => 'Surf',
            'imagem' => './assets/img/home/surf.png',
            'link'   => './assets/pages/surf.php',
        ],
        [
            'titulo' => 'Patrimônios Culturais',
            'imagem' => './assets/img/home/patrimonios.png',
            'link'   => './assets/pages/patrimonios.php',
        ],
        [
            'titulo' => 'Lendas e Mitos',
            'imagem' => './assets/img/home/lendas.png',
            'link'   => './assets/pages/lendas.php',
        ],
    ],

    /* ==========================================================
     * PÁGINA PATRIMÔNIOS
     * Colunas: id, nome, resumo, imagem, localizacao, periodo,
     *          historia (lista de parágrafos), curiosidade
     * ========================================================== */
    'patrimonios' => [
        [
            'id'          => 'castelo-himeji',
            'nome'        => 'Castelo de Himeji',
            'resumo'      => 'Um dos castelos mais famosos do Japão, mantendo a força e tradição.',
            'imagem'      => '../img/patrimonios/castelo.png',
            'localizacao' => 'Himeji, província de Hyogo',
            'periodo'     => 'Torre principal concluída no início do século XVII',
            'historia'    => [
                'O Castelo de Himeji é considerado um dos mais belos e mais bem preservados castelos feudais do Japão. Por causa das paredes brancas e da silhueta elegante, é conhecido como o "Castelo da Garça Branca".',
                'Ao longo dos séculos, ele resistiu a guerras, incêndios e terremotos, e hoje é um dos grandes símbolos da arquitetura defensiva japonesa.',
            ],
            'curiosidade' => 'Foi um dos primeiros locais japoneses a receber o título de Patrimônio Mundial da UNESCO, em 1993.',
        ],
        [
            'id'          => 'monte-fuji',
            'nome'        => 'Monte Fuji',
            'resumo'      => 'Montanha sagrada e um dos símbolos mais importantes do país.',
            'imagem'      => '../img/patrimonios/monte.png',
            'localizacao' => 'Entre as províncias de Shizuoka e Yamanashi',
            'periodo'     => 'Patrimônio Mundial desde 2013',
            'historia'    => [
                'Com 3.776 metros, o Monte Fuji é a montanha mais alta do Japão. Seu formato de cone quase perfeito inspirou poetas, pintores e artistas durante séculos.',
                'Ele é considerado sagrado no xintoísmo e no budismo, e há séculos recebe peregrinos que fazem a subida até o cume.',
            ],
            'curiosidade' => 'Ele foi reconhecido pela UNESCO como uma paisagem cultural, e não apenas como um patrimônio natural.',
        ],
        [
            'id'          => 'santuario-itsukushima',
            'nome'        => 'Santuário Itsukushima',
            'resumo'      => 'Famoso pelo seu portal sobre o mar.',
            'imagem'      => '../img/patrimonios/santuario.png',
            'localizacao' => 'Ilha de Miyajima, província de Hiroshima',
            'periodo'     => 'Origens no século VI, reconstruído no século XII',
            'historia'    => [
                'O Santuário Itsukushima fica em uma ilha considerada sagrada, e suas construções foram erguidas sobre palafitas, de modo que parecem flutuar na maré alta.',
                'Seu portal torii vermelho, plantado dentro da água, é uma das imagens mais conhecidas do país.',
            ],
            'curiosidade' => 'Durante a maré baixa, é possível caminhar até a base do grande torii.',
        ],
        [
            'id'          => 'templo-kinkaku-ji',
            'nome'        => 'Templo Kinkaku-ji',
            'resumo'      => 'Conhecido como templo do Pavilhão Dourado.',
            'imagem'      => '../img/patrimonios/templo.png',
            'localizacao' => 'Kyoto',
            'periodo'     => 'Construído em 1397',
            'historia'    => [
                'O Kinkaku-ji, ou Pavilhão Dourado, foi construído no fim do século XIV como residência de um xogum e depois se tornou um templo zen budista.',
                'Seus andares superiores são cobertos de folhas de ouro e se refletem no lago em frente, criando uma das paisagens mais fotografadas de Kyoto.',
            ],
            'curiosidade' => 'O pavilhão foi destruído em um incêndio em 1950 e reconstruído poucos anos depois.',
        ],
        [
            'id'          => 'santuario-fushimi-inari',
            'nome'        => 'Santuário Fushimi Inari',
            'resumo'      => 'Famoso por suas milhares de portas de torás vermelhas.',
            'imagem'      => '../img/patrimonios/santuario2.png',
            'localizacao' => 'Kyoto',
            'periodo'     => 'Fundado no ano 711',
            'historia'    => [
                'O Fushimi Inari é dedicado a Inari, divindade ligada ao arroz, à prosperidade e aos negócios. Um caminho de milhares de portais torii vermelhos sobe pela montanha atrás do santuário.',
                'Muitos desses portais foram doados por empresas e pessoas em agradecimento ou como pedido de sucesso.',
            ],
            'curiosidade' => 'As estátuas de raposas que vigiam o santuário são vistas como mensageiras de Inari.',
        ],
    ],

    /* ==========================================================
     * PÁGINA LENDAS
     * Colunas: id, nome, subtitulo, imagem, nome_japones, significado,
     *          historia (lista), como_age (lista), curiosidade
     * ========================================================== */
    'lendas' => [
        [
            'id'           => 'kuchisake-onna',
            'nome'         => 'Kuchisake-onna',
            'subtitulo'    => 'A mulher da boca cortada',
            'imagem'       => '../img/lendas/lenda1.png',
            'nome_japones' => '口裂け女 (Kuchisake-onna)',
            'significado'  => 'Mulher da boca cortada',
            'historia'     => [
                'Kuchisake-onna é uma das lendas urbanas mais conhecidas do Japão. Ela é descrita como uma mulher misteriosa, de cabelos longos e escuros, que costuma usar uma máscara cirúrgica para esconder uma enorme cicatriz que se estende de um canto da boca ao outro.',
                'Segundo a versão mais popular da história, ela teria sido uma mulher muito bonita que sofreu uma mutilação no rosto. Em algumas versões, seu agressor seria seu próprio marido, que teria agido por ciúme. Depois disso, ela teria se transformado em um espírito vingativo que persegue pessoas pelas ruas.',
                'A lenda ganhou popularidade no Japão entre 1978 e 1979, quando rumores sobre uma mulher com a boca cortada começaram a se espalhar entre crianças e estudantes. A história ficou tão conhecida que provocou medo em várias comunidades e levou alguns pais a acompanharem seus filhos no caminho para a escola.',
            ],
            'como_age'     => [
                'Kuchisake-onna costuma abordar pessoas na rua e perguntar: "Eu sou bonita?". Se a vítima responder que sim, ela retira a máscara e revela sua boca deformada, perguntando novamente se continua bonita. Na maioria das versões, qualquer resposta pode resultar em um ataque.',
                'Algumas histórias afirmam que ela carrega uma tesoura ou uma faca e consegue correr em uma velocidade sobrenatural. Outras apresentam maneiras de escapar, como distraí-la com doces ou dar uma resposta que a confunda.',
            ],
            'curiosidade'  => 'Apesar de algumas versões tentarem relacioná-la a histórias antigas de fantasmas japoneses, a fama moderna da Kuchisake-onna está documentada principalmente a partir do final da década de 1970. Ela se tornou uma figura popular em filmes, mangás e jogos de terror.',
        ],
        [
            'id'           => 'aka-manto',
            'nome'         => 'Aka Manto',
            'subtitulo'    => 'O homem do manto vermelho',
            'imagem'       => '../img/lendas/lenda2.png',
            'nome_japones' => '赤マント (Aka Manto)',
            'significado'  => 'Manto vermelho',
            'historia'     => [
                'Aka Manto é uma lenda urbana japonesa que, segundo o relato mais comum, tem como cenário os banheiros das escolas. Ele aparece como uma figura coberta por um manto vermelho, com o rosto escondido.',
                'A história diz que, ao ficar sozinha em uma cabine, a pessoa ouve uma voz perguntando se ela prefere papel vermelho ou papel azul. A escolha da cor decide o destino da vítima, e nenhuma das respostas termina bem.',
            ],
            'como_age'     => [],
            'curiosidade'  => 'A lenda circula entre estudantes há várias décadas e ganhou muitas variações ao longo do tempo, passando de boca em boca nas escolas do país.',
        ],
        [
            'id'           => 'teke-teke',
            'nome'         => 'Teke Teke',
            'subtitulo'    => 'O espírito que se arrasta',
            'imagem'       => '../img/lendas/lenda3.png',
            'nome_japones' => 'テケテケ (Teke Teke)',
            'significado'  => 'Onomatopeia do som de arrastar',
            'historia'     => [
                'Teke Teke é o espírito de uma jovem que, segundo a lenda, teria sido atingida por um trem e partida ao meio. Desde então, ela vaga em busca de vingança, arrastando-se pelo chão com os braços.',
                'O nome vem do som que ela faz ao se mover, uma imitação do barulho de algo sendo arrastado. Quem ouve esse ruído se aproximando precisa fugir o mais rápido possível.',
            ],
            'como_age'     => [],
            'curiosidade'  => 'A história se espalhou principalmente a partir dos anos 1990 e hoje aparece em filmes, quadrinhos e jogos de terror.',
        ],
        [
            'id'           => 'amaterasu',
            'nome'         => 'Amaterasu',
            'subtitulo'    => 'A deusa do Sol',
            'imagem'       => '../img/lendas/lenda4.png',
            'nome_japones' => '天照大神 (Amaterasu Ōmikami)',
            'significado'  => 'A grande divindade que brilha no céu',
            'historia'     => [
                'Amaterasu é a deusa do Sol na mitologia japonesa e uma das divindades mais importantes do xintoísmo. Tradicionalmente, a família imperial japonesa é considerada descendente dela.',
                'Em um dos mitos mais conhecidos, Amaterasu se escondeu em uma caverna após um conflito com o irmão, Susanoo, e o mundo mergulhou na escuridão. Os outros deuses a convenceram a sair com uma festa e um espelho, e a luz voltou ao mundo.',
            ],
            'como_age'     => [],
            'curiosidade'  => 'O principal santuário dedicado a ela é o Santuário de Ise, um dos locais mais sagrados do Japão.',
        ],
        [
            'id'           => 'tsukuyomi',
            'nome'         => 'Tsukuyomi',
            'subtitulo'    => 'O deus da Lua',
            'imagem'       => '../img/lendas/lenda5.png',
            'nome_japones' => '月読命 (Tsukuyomi-no-Mikoto)',
            'significado'  => 'Aquele que conta as luas',
            'historia'     => [
                'Tsukuyomi é o deus da Lua na mitologia japonesa e irmão de Amaterasu e Susanoo. Ele aparece de forma discreta nos relatos mais antigos.',
                'Segundo uma das tradições, ele foi enviado para visitar a deusa Uke Mochi e, ofendido com a forma como ela preparava a comida, a matou. Irritada, Amaterasu se recusou a vê-lo novamente, e é por isso que o Sol e a Lua nunca se encontram no céu, dando origem ao dia e à noite.',
            ],
            'como_age'     => [],
            'curiosidade'  => 'O nome Tsukuyomi está ligado à contagem do tempo pelo calendário lunar.',
        ],
        [
            'id'           => 'susanoo',
            'nome'         => 'Susanoo',
            'subtitulo'    => 'O deus das tempestades',
            'imagem'       => '../img/lendas/lenda6.png',
            'nome_japones' => '須佐之男 (Susanoo-no-Mikoto)',
            'significado'  => 'O deus impetuoso',
            'historia'     => [
                'Susanoo é o deus das tempestades e do mar, conhecido por seu temperamento forte. Depois de causar problemas no céu, foi expulso e desceu à Terra.',
                'Lá, ele enfrentou a serpente de oito cabeças Yamata no Orochi, que ameaçava uma família. Susanoo derrotou o monstro e, dentro de seu corpo, encontrou a espada Kusanagi, que se tornou um dos tesouros sagrados do Japão.',
            ],
            'como_age'     => [],
            'curiosidade'  => 'A espada Kusanagi é um dos três tesouros sagrados que simbolizam a autoridade imperial japonesa.',
        ],
    ],

];
