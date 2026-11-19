-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/11/2026 às 15:13
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

CREATE DATABASE IF NOT EXISTS `japao_integrador` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `japao_integrador`;



SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `japao_integrador`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `administradores`
--

INSERT INTO `administradores` (`id`, `nome`, `email`, `senha_hash`, `ativo`, `criado_em`) VALUES
(1, 'Administrador', 'admin@japao.com', '$2a$12$i1hHDSzfRZd7e/pzBet/Re65eEgc.uK3RTmVrTabd/msJo437sO2i', 1, '2026-11-10 16:04:42');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `secao_id` int(11) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `icone` varchar(50) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `ordem` int(11) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cards`
--

INSERT INTO `cards` (`id`, `secao_id`, `titulo`, `descricao`, `imagem`, `icone`, `link`, `ordem`, `ativo`) VALUES
(1, 2, 'História', NULL, 'img/card-historia.jpg', NULL, 'historia.php', 1, 1),
(2, 2, 'Culinária', NULL, 'img/card-culinaria.jpg', NULL, 'culinaria.php', 2, 1),
(3, 2, 'Surfe', NULL, 'img/card-surfe.jpg', NULL, 'surfe.php', 3, 1),
(4, 2, 'Patrimônios', NULL, 'img/card-patrimonios.jpg', NULL, 'patrimonios.php', 4, 1),
(5, 2, 'Lendas', NULL, 'img/card-lendas.jpg', NULL, 'lendas.php', 5, 1),
(6, 6, 'Sushi', 'Descrição do prato.', 'img/sushi.jpg', NULL, NULL, 1, 1),
(7, 6, 'Sashimi', 'Descrição do prato.', 'img/sashimi.jpg', NULL, NULL, 2, 1),
(8, 6, 'Ramen', 'Descrição do prato.', 'img/ramen.jpg', NULL, NULL, 3, 1),
(9, 6, 'Takoyaki', 'Descrição do prato.', 'img/takoyaki.jpg', NULL, NULL, 4, 1),
(10, 10, 'Item de impacto 1', NULL, NULL, 'bi-check-circle', NULL, 1, 1),
(11, 10, 'Item de impacto 2', NULL, NULL, 'bi-check-circle', NULL, 2, 1),
(12, 10, 'Item de impacto 3', NULL, NULL, 'bi-check-circle', NULL, 3, 1),
(13, 10, 'Item de impacto 4', NULL, NULL, 'bi-check-circle', NULL, 4, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `chave` varchar(80) NOT NULL,
  `valor` text DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `configuracoes`
--

INSERT INTO `configuracoes` (`chave`, `valor`, `descricao`) VALUES
('logo_imagem', 'img/logo-japao.png', 'Logo exibida no topo e no rodapé'),
('logo_texto', 'Japão', 'Texto/logotipo caligráfico'),
('rodape_ornamento', 'img/sakura-rodape.png', 'Imagem de flores de cerejeira no rodapé'),
('rodape_texto', '© Japão - Todos os direitos reservados', 'Texto do rodapé'),
('site_nome', 'Japão', 'Nome do site');

-- --------------------------------------------------------

--
-- Estrutura para tabela `habitos_culturais`
--

CREATE TABLE `habitos_culturais` (
  `id` int(11) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `descricao` text DEFAULT NULL,
  `icone` varchar(50) DEFAULT NULL,
  `ordem` int(11) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `habitos_culturais`
--

INSERT INTO `habitos_culturais` (`id`, `titulo`, `descricao`, `icone`, `ordem`, `ativo`) VALUES
(1, 'Hábito 1', 'Descrição do hábito cultural.', 'bi-heart', 1, 1),
(2, 'Hábito 2', 'Descrição do hábito cultural.', 'bi-star', 2, 1),
(3, 'Hábito 3', 'Descrição do hábito cultural.', 'bi-gem', 3, 1),
(4, 'Hábito 4', 'Descrição do hábito cultural.', 'bi-people', 4, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens_site`
--

CREATE TABLE `imagens_site` (
  `id` int(11) NOT NULL,
  `chave` varchar(80) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `caminho` varchar(255) NOT NULL,
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imagens_site`
--

INSERT INTO `imagens_site` (`id`, `chave`, `nome`, `descricao`, `caminho`, `atualizado_em`) VALUES
(1, 'home_banner', 'Banner principal', 'Imagem de destaque da página inicial', 'assets/img/home/banner.png', '2026-11-17 13:57:34'),
(2, 'home_fundo', 'Fundo da página inicial', 'Imagem utilizada como fundo', 'assets/img/gerenciadas/3cfec765e9966951bab06dad35c49651.jpg', '2026-11-19 14:10:10'),
(3, 'home_cultura', 'Imagem de cultura', 'Imagem da seção de cultura da página inicial', 'assets/img/home/cultura.png', '2026-11-17 13:57:34'),
(4, 'home_arquitetura', 'Imagem de arquitetura', 'Imagem da seção de arquitetura da página inicial', 'assets/img/home/arquitetura.png', '2026-11-17 13:57:34'),
(5, 'home_paisagem', 'Imagem de paisagem', 'Imagem da seção de paisagens da página inicial', 'assets/img/home/paisagem.png', '2026-11-17 13:57:34'),
(6, 'culinaria_banner', 'Banner da culinária', 'Imagem principal da página de culinária', 'assets/img/culinaria/banner.png', '2026-11-17 13:57:34'),
(7, 'futebol_banner', 'Banner do futebol', 'Imagem principal da página de futebol', 'assets/img/futebol/banner.png', '2026-11-17 13:57:34'),
(8, 'lendas_banner', 'Banner das lendas', 'Imagem principal da página de lendas', 'assets/img/lendas/banner.png', '2026-11-17 13:57:34'),
(9, 'patrimonios_banner', 'Banner dos patrimônios', 'Imagem principal da página de patrimônios', 'assets/img/patrimonios/banner.png', '2026-11-17 13:57:34'),
(10, 'surf_banner', 'Banner do surfe', 'Imagem principal da página de surfe', 'assets/img/surf/surfBanner.png', '2026-11-17 13:57:34'),
(11, 'culinaria_sushi', 'Sushi', 'Imagem do sushi japonês', 'assets/img/culinaria/sushi.png', '2026-11-17 14:13:32'),
(12, 'culinaria_sashimi', 'Sashimi', 'Imagem do sashimi japonês', 'assets/img/culinaria/sashimi.png', '2026-11-17 14:13:32'),
(13, 'culinaria_ramen', 'Ramen', 'Imagem do ramen japonês', 'assets/img/culinaria/ramen.png', '2026-11-17 14:13:32'),
(14, 'culinaria_yakisoba', 'Yakisoba', 'Imagem do yakisoba japonês', 'assets/img/culinaria/yakisoba.png', '2026-11-17 14:13:32'),
(15, 'culinaria_chef', 'Chef japonês', 'Imagem do preparo da culinária japonesa', 'assets/img/culinaria/japonesCozinhando.png', '2026-11-17 14:13:32'),
(16, 'futebol_mulheres', 'Seleção feminina', 'Imagem da seleção feminina japonesa', 'assets/img/futebol/mulheres.png', '2026-11-17 14:29:21'),
(18, 'surf_praia', 'Praia do Surf', 'Imagem da cultura do surf no Japão', 'assets/img/surf/praia.png', '2026-11-17 14:32:02'),
(19, 'surf_shonan', 'Praia de Shonan', 'Imagem do litoral de Shonan', 'assets/img/surf/shonan.png', '2026-11-17 14:32:02'),
(20, 'surf_chiba', 'Litoral de Chiba', 'Imagem do litoral de Chiba', 'assets/img/surf/chiba.png', '2026-11-17 14:32:02'),
(21, 'surf_kanoa', 'Surfista Kanoa', 'Imagem da participação do Japão nas Olimpíadas', 'assets/img/surf/kanoa.png', '2026-11-17 14:32:02'),
(22, 'patrimonios_memoria', 'Arquitetura e memória', 'Imagem da arquitetura tradicional japonesa', 'assets/img/patrimonios/memoria.png', '2026-11-17 14:35:39'),
(23, 'patrimonios_monte', 'Monte Fuji', 'Imagem do Monte Fuji', 'assets/img/patrimonios/monte.png', '2026-11-17 14:35:39'),
(24, 'patrimonios_santuario', 'Santuário japonês', 'Imagem de um santuário japonês', 'assets/img/patrimonios/santuario.png', '2026-11-17 14:35:39'),
(25, 'patrimonios_castelo', 'Castelo japonês', 'Imagem de um castelo japonês', 'assets/img/patrimonios/castelo.png', '2026-11-17 14:35:39'),
(26, 'patrimonio_castelo-himeji', 'Castelo de Himeji', 'Imagem do Castelo de Himeji', 'assets/img/patrimonios/castelo.png', '2026-11-19 14:05:48'),
(27, 'patrimonio_monte-fuji', 'Monte Fuji', 'Imagem do Monte Fuji', 'assets/img/patrimonios/monte.png', '2026-11-19 14:05:48'),
(28, 'patrimonio_santuario-itsukushima', 'Santuário Itsukushima', 'Imagem do Santuário Itsukushima', 'assets/img/patrimonios/santuario.png', '2026-11-19 14:05:48'),
(29, 'patrimonio_templo-kinkaku-ji', 'Templo Kinkaku-ji', 'Imagem do Templo Kinkaku-ji', 'assets/img/patrimonios/templo.png', '2026-11-19 14:05:48'),
(30, 'patrimonio_santuario-fushimi-inari', 'Santuário Fushimi Inari', 'Imagem do Santuário Fushimi Inari', 'assets/img/patrimonios/santuario2.png', '2026-11-19 14:05:48'),
(31, 'lenda_kuchisake-onna_imagem', 'Kuchisake-onna - Imagem', 'Imagem principal da lenda Kuchisake-onna', 'assets/img/lendas/lenda1.png', '2026-11-19 14:05:48'),
(32, 'lenda_aka-manto_imagem', 'Aka Manto - Imagem', 'Imagem principal da lenda Aka Manto', 'assets/img/lendas/lenda2.png', '2026-11-19 14:05:48'),
(33, 'lenda_teke-teke_imagem', 'Teke Teke - Imagem', 'Imagem principal da lenda Teke Teke', 'assets/img/lendas/lenda3.png', '2026-11-19 14:05:48'),
(34, 'lenda_amaterasu_imagem', 'Amaterasu - Imagem', 'Imagem principal da lenda Amaterasu', 'assets/img/lendas/lenda4.png', '2026-11-19 14:05:48'),
(35, 'lenda_tsukuyomi_imagem', 'Tsukuyomi - Imagem', 'Imagem principal da lenda Tsukuyomi', 'assets/img/lendas/lenda5.png', '2026-11-19 14:05:48'),
(36, 'lenda_susanoo_imagem', 'Susanoo - Imagem', 'Imagem principal da lenda Susanoo', 'assets/img/lendas/lenda6.png', '2026-11-19 14:05:48'),
(37, 'lenda_kuchisake-onna_banner', 'Kuchisake-onna - Banner', 'Banner da lenda Kuchisake-onna', 'assets/img/lendas/bannerKuchisake.png', '2026-11-19 14:05:48'),
(38, 'lenda_aka-manto_banner', 'Aka Manto - Banner', 'Banner da lenda Aka Manto', 'assets/img/lendas/bannerAkamanto.png', '2026-11-19 14:05:48'),
(39, 'lenda_teke-teke_banner', 'Teke Teke - Banner', 'Banner da lenda Teke Teke', 'assets/img/lendas/bannerTeketeke.png', '2026-11-19 14:05:48'),
(40, 'lenda_amaterasu_banner', 'Amaterasu - Banner', 'Banner da lenda Amaterasu', 'assets/img/lendas/bannerAmaterasu.png', '2026-11-19 14:05:48'),
(41, 'lenda_tsukuyomi_banner', 'Tsukuyomi - Banner', 'Banner da lenda Tsukuyomi', 'assets/img/lendas/bannerTsukuyomi.png', '2026-11-19 14:05:48'),
(42, 'lenda_susanoo_banner', 'Susanoo - Banner', 'Banner da lenda Susanoo', 'assets/img/lendas/bannerSusanoo.png', '2026-11-19 14:05:48');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lendas`
--

CREATE TABLE `lendas` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `nome_japones` varchar(100) DEFAULT NULL,
  `romanizacao` varchar(100) DEFAULT NULL,
  `resumo` varchar(255) DEFAULT NULL,
  `texto_completo` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `ordem` int(11) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lendas`
--

INSERT INTO `lendas` (`id`, `nome`, `nome_japones`, `romanizacao`, `resumo`, `texto_completo`, `imagem`, `ordem`, `ativo`) VALUES
(1, 'Onibaba', '鬼婆', 'Onibaba', 'Mulher transformada em demônio.', 'Escreva aqui a história completa da lenda.', 'img/lenda-1.jpg', 1, 1),
(2, 'Lenda 2', NULL, NULL, 'Resumo da lenda.', 'Escreva aqui a história completa da lenda.', 'img/lenda-2.jpg', 2, 1),
(3, 'Lenda 3', NULL, NULL, 'Resumo da lenda.', 'Escreva aqui a história completa da lenda.', 'img/lenda-3.jpg', 3, 1),
(4, 'Lenda 4', NULL, NULL, 'Resumo da lenda.', 'Escreva aqui a história completa da lenda.', 'img/lenda-4.jpg', 4, 1),
(5, 'Lenda 5', NULL, NULL, 'Resumo da lenda.', 'Escreva aqui a história completa da lenda.', 'img/lenda-5.jpg', 5, 1),
(6, 'Lenda 6', NULL, NULL, 'Resumo da lenda.', 'Escreva aqui a história completa da lenda.', 'img/lenda-6.jpg', 6, 1),
(7, 'Lenda 7', NULL, NULL, 'Resumo da lenda.', 'Escreva aqui a história completa da lenda.', 'img/lenda-7.jpg', 7, 1),
(8, 'Lenda 8', NULL, NULL, 'Resumo da lenda.', 'Escreva aqui a história completa da lenda.', 'img/lenda-8.jpg', 8, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `linha_tempo`
--

CREATE TABLE `linha_tempo` (
  `id` int(11) NOT NULL,
  `ano` varchar(20) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `ordem` int(11) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `linha_tempo`
--

INSERT INTO `linha_tempo` (`id`, `ano`, `titulo`, `descricao`, `ordem`, `ativo`) VALUES
(1, 'Ano 1', 'Marco histórico 1', 'Descrição do marco.', 1, 1),
(2, 'Ano 2', 'Marco histórico 2', 'Descrição do marco.', 2, 1),
(3, 'Ano 3', 'Marco histórico 3', 'Descrição do marco.', 3, 1),
(4, 'Ano 4', 'Marco histórico 4', 'Descrição do marco.', 4, 1),
(5, 'Ano 5', 'Marco histórico 5', 'Descrição do marco.', 5, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `menu_itens`
--

CREATE TABLE `menu_itens` (
  `id` int(11) NOT NULL,
  `rotulo` varchar(60) NOT NULL,
  `url` varchar(150) NOT NULL,
  `ordem` int(11) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `menu_itens`
--

INSERT INTO `menu_itens` (`id`, `rotulo`, `url`, `ordem`, `ativo`) VALUES
(1, 'Início', 'index.php', 1, 1),
(2, 'História', 'historia.php', 2, 1),
(3, 'Culinária', 'culinaria.php', 3, 1),
(4, 'Surfe', 'surfe.php', 4, 1),
(5, 'Patrimônios', 'patrimonios.php', 5, 1),
(6, 'Lendas', 'lendas.php', 6, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `paginas`
--

CREATE TABLE `paginas` (
  `id` int(11) NOT NULL,
  `slug` varchar(60) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `hero_imagem` varchar(255) DEFAULT NULL,
  `hero_titulo` varchar(200) DEFAULT NULL,
  `hero_subtitulo` text DEFAULT NULL,
  `hero_kanji` varchar(20) DEFAULT NULL,
  `meta_descricao` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `atualizado_em` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `paginas`
--

INSERT INTO `paginas` (`id`, `slug`, `titulo`, `hero_imagem`, `hero_titulo`, `hero_subtitulo`, `hero_kanji`, `meta_descricao`, `ativo`, `atualizado_em`) VALUES
(1, 'inicio', 'Início', 'img/hero-fuji-pagoda.jpg', 'Japão', 'Uma viagem pela cultura, história e tradições do país do sol nascente.', '日本', NULL, 1, '2026-11-10 16:04:42'),
(2, 'historia', 'História', 'img/hero-futebol.jpg', 'História', 'Do período feudal à era moderna: os marcos que formaram o Japão.', '足球', NULL, 1, '2026-11-10 16:04:42'),
(3, 'culinaria', 'Culinária', 'img/hero-sushi.jpg', 'Culinária', 'Sabores, técnicas e a arte de preparar a comida japonesa.', '食物', NULL, 1, '2026-11-10 16:04:42'),
(4, 'surfe', 'Surfe', 'img/hero-surfe.jpg', 'O surfe no Japão', 'Ondas, cultura e a chegada do surfe às Olimpíadas.', NULL, NULL, 1, '2026-11-10 16:04:42'),
(5, 'patrimonios', 'Patrimônios', 'img/hero-fuji-pagoda.jpg', 'Patrimônios que contam histórias', 'Lugares que preservam a memória do povo japonês.', NULL, NULL, 1, '2026-11-10 16:04:42'),
(6, 'lendas', 'Lendas', 'img/hero-lendas.jpg', 'Entre deuses, monstros e lendas', 'Criaturas e histórias do folclore japonês.', NULL, NULL, 1, '2026-11-10 16:04:42');

-- --------------------------------------------------------

--
-- Estrutura para tabela `patrimonios`
--

CREATE TABLE `patrimonios` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `localizacao` varchar(150) DEFAULT NULL,
  `ordem` int(11) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `patrimonios`
--

INSERT INTO `patrimonios` (`id`, `nome`, `descricao`, `imagem`, `localizacao`, `ordem`, `ativo`) VALUES
(1, 'Castelo', 'Descrição do patrimônio.', 'img/patrimonio-1.jpg', 'Japão', 1, 1),
(2, 'Monte Fuji', 'Descrição do patrimônio.', 'img/patrimonio-2.jpg', 'Japão', 2, 1),
(3, 'Portal Torii', 'Descrição do patrimônio.', 'img/patrimonio-3.jpg', 'Japão', 3, 1),
(4, 'Pagode', 'Descrição do patrimônio.', 'img/patrimonio-4.jpg', 'Japão', 4, 1),
(5, 'Templo', 'Descrição do patrimônio.', 'img/patrimonio-5.jpg', 'Japão', 5, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `redes_sociais`
--

CREATE TABLE `redes_sociais` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `icone` varchar(50) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `ordem` int(11) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `redes_sociais`
--

INSERT INTO `redes_sociais` (`id`, `nome`, `icone`, `url`, `ordem`, `ativo`) VALUES
(1, 'Instagram', 'bi-instagram', '#', 1, 1),
(2, 'Facebook', 'bi-facebook', '#', 2, 1),
(3, 'Twitter', 'bi-twitter', '#', 3, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `secoes`
--

CREATE TABLE `secoes` (
  `id` int(11) NOT NULL,
  `pagina_id` int(11) NOT NULL,
  `chave` varchar(60) NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `texto` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `ordem` int(11) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `secoes`
--

INSERT INTO `secoes` (`id`, `pagina_id`, `chave`, `titulo`, `texto`, `imagem`, `ordem`, `ativo`) VALUES
(1, 1, 'sobre', 'O Japão', 'Escreva aqui o texto de apresentação do Japão.', 'img/monte-fuji-arte.png', 1, 1),
(2, 1, 'explore', 'Explore o Japão', NULL, NULL, 2, 1),
(3, 2, 'texto-historia', 'História', 'Escreva aqui o texto sobre a história do Japão.', 'img/monte-fuji-arte.png', 1, 1),
(4, 2, 'linha-tempo', 'O Japão nos anos', NULL, NULL, 2, 1),
(5, 2, 'habitos', 'Hábitos Culturais', NULL, NULL, 3, 1),
(6, 3, 'culinaria', 'A culinária japonesa', 'Escreva aqui o texto sobre a culinária japonesa.', NULL, 1, 1),
(7, 3, 'empreendedorismo', 'Empreendedorismo', 'Escreva aqui o texto sobre empreendedorismo na culinária.', 'img/empreendedorismo.jpg', 2, 1),
(8, 4, 'surfe-japao', 'O surf no Japão', 'Escreva aqui o texto sobre o surfe no Japão.', 'img/surfe-japao.jpg', 1, 1),
(9, 4, 'surfe-olimpiadas', 'Surfe Olimpíadas', 'Escreva aqui o texto sobre o surfe nas Olimpíadas.', 'img/surfe-olimpiadas.jpg', 2, 1),
(10, 4, 'impacto', 'Impacto', 'Escreva aqui o texto sobre o impacto do surfe.', 'img/surfe-impacto.jpg', 3, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `secao_id` (`secao_id`);

--
-- Índices de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`chave`);

--
-- Índices de tabela `habitos_culturais`
--
ALTER TABLE `habitos_culturais`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `imagens_site`
--
ALTER TABLE `imagens_site`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chave` (`chave`);

--
-- Índices de tabela `lendas`
--
ALTER TABLE `lendas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `linha_tempo`
--
ALTER TABLE `linha_tempo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `menu_itens`
--
ALTER TABLE `menu_itens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Índices de tabela `patrimonios`
--
ALTER TABLE `patrimonios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `redes_sociais`
--
ALTER TABLE `redes_sociais`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `secoes`
--
ALTER TABLE `secoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_pagina_chave` (`pagina_id`,`chave`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `habitos_culturais`
--
ALTER TABLE `habitos_culturais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `imagens_site`
--
ALTER TABLE `imagens_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `lendas`
--
ALTER TABLE `lendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `linha_tempo`
--
ALTER TABLE `linha_tempo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `menu_itens`
--
ALTER TABLE `menu_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `paginas`
--
ALTER TABLE `paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `patrimonios`
--
ALTER TABLE `patrimonios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `redes_sociais`
--
ALTER TABLE `redes_sociais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `secoes`
--
ALTER TABLE `secoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`secao_id`) REFERENCES `secoes` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `secoes`
--
ALTER TABLE `secoes`
  ADD CONSTRAINT `secoes_ibfk_1` FOREIGN KEY (`pagina_id`) REFERENCES `paginas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
