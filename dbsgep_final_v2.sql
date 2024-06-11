-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/06/2024 às 04:11
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbsgep`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento`
--

CREATE TABLE `evento` (
  `id_evento` int(11) NOT NULL,
  `nm_evento` varchar(50) NOT NULL,
  `ds_evento` varchar(100) NOT NULL,
  `dt_evento_inicio` date NOT NULL,
  `dt_evento_fim` date DEFAULT NULL,
  `id_unidade` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `evento`
--

INSERT INTO `evento` (`id_evento`, `nm_evento`, `ds_evento`, `dt_evento_inicio`, `dt_evento_fim`, `id_unidade`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 'Copa Tribuna de futsal escolar', 'Esporte de quadra', '2024-08-22', '2024-08-23', 2, 5, '2024-05-18 11:26:36', NULL),
(2, 'Copa de Futevôlei', 'Esporte na areia', '2023-06-13', '2023-06-15', 1, 5, '2024-05-19 11:26:36', NULL),
(3, 'Copa Tribuna de Basquete Escolar', 'Esporte de quadra', '2024-03-22', '2024-03-22', 1, 5, '2024-05-20 11:26:36', NULL),
(4, 'Copa Tribuna de Handball Escolar', 'Esporte de quadra', '2024-02-22', '2024-02-23', 1, 5, '2024-05-21 11:26:36', NULL),
(5, 'Copa sub 20 de Futsal', 'Futebol de salão', '2024-03-22', '2024-03-25', 1, 5, '2024-05-22 11:26:36', '2024-06-07 00:16:33'),
(6, 'Copa de Basquete', 'Esporte de quadra', '2024-06-06', '2024-06-09', 1, 5, '2024-05-23 11:26:36', '2024-06-07 00:17:24'),
(7, 'Copa de Futsal', 'Futebol de salão', '2024-04-04', '2024-04-06', 1, 5, '2024-05-24 11:26:36', NULL),
(8, 'Copa de Vôlei', 'Esporte de quadra', '2024-07-07', '2024-07-08', 1, 5, '2024-05-25 11:26:36', NULL),
(9, 'Copa Tribuna de Vôlei Escolar', 'Esporte de quadra', '2024-05-08', '2024-05-08', 2, 5, '2024-05-26 11:26:36', NULL),
(10, 'Copa Tribuna de Tênis de mesa Escolar', 'Esporte de quadra', '2024-09-06', '2024-09-07', 2, 5, '2024-05-27 11:26:36', NULL),
(11, 'teste2', 'teste', '2024-06-06', '2024-06-06', 2, 5, '2024-05-28 11:26:36', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento_modalidade`
--

CREATE TABLE `evento_modalidade` (
  `id_evento` int(11) NOT NULL,
  `id_modalidade` int(11) NOT NULL,
  `qt_modalidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `modalidade`
--

CREATE TABLE `modalidade` (
  `id_modalidade` int(11) NOT NULL,
  `nm_modalidade` varchar(50) NOT NULL,
  `ds_modalidade` varchar(100) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_unidade` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `modalidade`
--

INSERT INTO `modalidade` (`id_modalidade`, `nm_modalidade`, `ds_modalidade`, `id_usuario`, `id_unidade`, `created_at`, `updated_at`) VALUES
(1, 'Futsal', 'Futebol de salão', 5, 1, '2024-05-18 11:25:14', NULL),
(2, 'Basquete', 'Esporte de quadra', 5, 2, '2024-05-19 11:25:14', NULL),
(3, 'Tênis de quadra', 'Esporte de quadra com raquete', 5, 1, '2024-05-20 11:25:14', NULL),
(4, 'Tênis de mesa', 'Esporte de mesa com raquete', 5, 1, '2024-05-21 11:25:14', NULL),
(5, 'Futebol de areia', 'Futebol de areia', 5, 1, '2024-05-22 11:25:14', NULL),
(6, 'Golf', 'Esporte de rico', 5, 2, '2024-05-23 11:25:14', NULL),
(7, 'Vôlei', 'Esporte de quadra', 5, 2, '2024-05-24 11:25:14', NULL),
(8, 'Handball', 'Esporte de quadra', 5, 2, '2024-05-25 11:25:14', NULL),
(9, 'Natação', 'Esporte aquático', 4, 1, '2024-05-26 11:25:14', NULL),
(10, 'Baseball', 'Esporte de bastão com bola', 6, NULL, '2024-05-27 11:25:14', NULL),
(11, 'Karate', 'Arte marcial', 6, NULL, '2024-05-28 11:25:14', NULL),
(12, 'Baseball', 'Esporte de quadra', 5, NULL, '2024-05-28 11:26:14', NULL),
(13, 'Beach Soccer', 'Esporte na areia', 5, NULL, '2024-05-28 01:38:44', NULL),
(14, 'Surf', 'Esporte na praia', 5, NULL, '2024-05-28 01:39:05', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticia`
--

CREATE TABLE `noticia` (
  `id_noticia` int(11) NOT NULL,
  `nm_titulo` varchar(250) NOT NULL,
  `ds_conteudo` longtext NOT NULL,
  `nm_autor` varchar(255) DEFAULT NULL,
  `im_capa` blob DEFAULT NULL,
  `ds_legenda` varchar(255) DEFAULT NULL,
  `dt_noticia` date NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `noticia`
--

INSERT INTO `noticia` (`id_noticia`, `nm_titulo`, `ds_conteudo`, `nm_autor`, `im_capa`, `ds_legenda`, `dt_noticia`, `id_usuario`, `created_at`, `updated_at`) VALUES
(2, 'Carille sofre decisão no Santos após derrota para o Botafogo-SP na Série B', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><p><span style=\"color: rgb(0, 0, 0);\">A última derrota foi para a equipe que estava na lanterna da competição, o&nbsp;</span><strong style=\"color: rgb(216, 18, 47); background-color: transparent;\"><a href=\"https://br.bolavip.com/santos/santos-perde-para-botafogo-sp-em-londrina-e-cai-para-3o-na-tabela-da-serie-b-veja-atuacoes\" rel=\"noopener noreferrer\" target=\"_blank\">Botafogo-SP&nbsp;</a></strong><span style=\"color: rgb(0, 0, 0);\">que ocorreu na última segunda-feira (3), no Estádio do Café, em Londrina, mesmo com o mando de campo sendo da equipe paulista.</span></p><p><span style=\"color: rgb(0, 0, 0);\">Essa decisão da diretoria, inclusive, causou desconforto nos jogadores. Após o fim da partida, durante entrevista, o volante&nbsp;</span><strong style=\"color: rgb(216, 18, 47); background-color: transparent;\"><a href=\"https://br.bolavip.com/santos/diego-pituca-diz-que-santos-perdeu-para-botafogo-sp-por-nao-concluir-em-gol\" rel=\"noopener noreferrer\" target=\"_blank\">Diego Pituca&nbsp;</a></strong><span style=\"color: rgb(0, 0, 0);\">destacou a importância de jogar em casa com o apoio de sua torcida para buscar o resultado em campo.</span></p><p><br></p><h2><span style=\"color: rgb(0, 0, 0);\">A torcida não perdoou</span></h2><p><span style=\"color: rgb(0, 0, 0);\">Carille vinha realizando um trabalho muito contundente sob o comando da equipe, que resultou inclusive, no vice do Campeonato Paulista, mesmo tendo um elenco mais modesto que os rivais.</span></p><p><span style=\"color: rgb(0, 0, 0);\">Já que o Alvinegro Praiano precisou realizar uma reformulação, onde tinha como objetivo reduzir os gastos com a folha salarial do clube. Isso porque, o time vinha de uma situação financeira delicada, que acabou sendo agravada com o rebaixamento.</span></p><p><br></p><p><br></p></div>', 'Maya Rodriguez', 0x696d6167656e732f714456706971675067325451527461507a58684d4256514b66467a716e6675783430484c584a675a2e706e67, 'fonte: frieren e seu compareiros', '2024-06-07', 5, '2024-05-20 14:24:07', '2024-06-07 00:25:12'),
(4, 'O que são e-sports e por que estão cada vez mais populares?', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><p class=\"ql-align-justify\"><span class=\"ql-font-verdana\">As competições de e-sports podem variar de acordo com o torneio ou o jogo disputado, mas apresentam características em comum na sua estrutura.</span></p><p class=\"ql-align-justify\"><span class=\"ql-font-verdana\">Nesse contexto, alguns elementos chave nos torneios incluem:</span></p><p class=\"ql-align-justify\"><br></p><ol><li data-list=\"bullet\" class=\"ql-align-justify\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong class=\"ql-font-verdana\">jogadores:</strong><span class=\"ql-font-verdana\"> os gamers podem competir de forma individual ou como parte de uma equipe profissional;</span></li><li data-list=\"bullet\" class=\"ql-align-justify\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong class=\"ql-font-verdana\">organizações:</strong><span class=\"ql-font-verdana\"> esses jogadores podem fazer parte de uma organização, responsável por gerenciar e representar suas equipes nos torneios;</span></li><li data-list=\"bullet\" class=\"ql-align-justify\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong class=\"ql-font-verdana\">ligas das modalidades:</strong><span class=\"ql-font-verdana\"> as ligas são responsáveis por organizar, promover e criar regras para as competições de jogos eletrônicos. Normalmente, cada liga cuida de uma modalidade específica de games.</span></li></ol><p><br></p></div>', 'Rafael Machado da Silva', 0x696d6167656e732f4d56346e5165397837354f445a3041654f714f3749536274437a72776578315449737a5732316d392e706e67, 'Fonte: Riot Games', '2024-06-07', 5, '2024-05-22 14:24:07', '2024-06-07 01:10:34'),
(5, 'Qual a origem dos e-sports?', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><p class=\"ql-align-justify\"><span class=\"ql-size-large\">O que são e-sports? E-sports é um termo que vem do inglês eletronic sports, ou esportes eletrônicos, utilizado para definir a modalidade competitiva de jogos virtuais. Nesses eventos, jogadores profissionais ou amadores se enfrentam em torneios oficiais de gêneros variados de games, desde esportes virtuais até jogos de estratégia em tempo real. Os jogos podem ser disputados individualmente ou em equipe e as principais competições normalmente contam com transmissão ao vivo.</span></p><p class=\"ql-align-justify\"><br></p><h1 class=\"ql-align-justify\"><strong>Principais tipos de jogos</strong></h1><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong class=\"ql-size-large\">Battle Royale</strong></p><p class=\"ql-align-justify\"><span class=\"ql-size-large\">O&nbsp;Battle Royale&nbsp;é o mais recente estilo de jogo do cenário competitivo. Popularizada com o lançamento de PlayerUnknown\'s Battlegrounds, em 2017, a modalidade consiste na coleta de recursos (lootear) e na sobrevivência, vencendo o último jogador a ficar vivo. Além do&nbsp;PUBG, o&nbsp;Fortnite, o&nbsp;Free Fire&nbsp;e, mais recentemente, o Call of Duty: Warzone também fazem sucesso entre os Battle Royales.</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong class=\"ql-size-large\">MOBA</strong></p><p class=\"ql-align-justify\"><span class=\"ql-size-large\">Os Multiplayer Online Battle Arena são um fenômeno entre os esportes eletrônicos. Nesse estilo de game, dois times se enfrentam em um mapa até um dos lados conseguir destruir a base da equipe oponente. Os jogos&nbsp;MOBA&nbsp;oferecem uma variedade de personagens que devem ser escolhidos pelos atletas e que possuem habilidades capazes de impactar a partida de maneiras diferentes. Seres que não são controlados pelos jogadores e torres de defesa da base também fazer parte do game. O&nbsp;League of Legends&nbsp;(LoL) e o Defense of the Ancients 2 (DotA 2), ambos jogados no PC, são os dois principais jogos entres os MOBAs.</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong class=\"ql-size-large\">FPS</strong></p><p class=\"ql-align-justify\"><span class=\"ql-size-large\">Os jogos&nbsp;FPS&nbsp;ou de tiro em primeira pessoa são os mais tradicionais do mundo dos esportes eletrônicos. Eles são jogados da perspectiva de um jogador que carrega uma arma e foca no combate com armas de fogo. Os principais jogos desse estilo são o Counter-Strike: Global Offensive (CS:GO), o Rainbow Six: Siege, o Overwatch, o CrossFire e, mais recentemente, o&nbsp;Valorant.</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong class=\"ql-size-large\">RTS</strong></p><p class=\"ql-align-justify\"><span class=\"ql-size-large\">Os jogos&nbsp;RTS&nbsp;ou Real Time Strategy (Estratégia em Tempo Real) geralmente envolvem conquistar o território inimigo por meio de estratégias de guerra, incluindo a construção de exércitos, o aquecimento da economia, a produção de recursos e a criação de defesas perfeitas. O StarCraft II e o seu precursor Warcraft III são os jogos mais conhecidos do gênero.</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong class=\"ql-size-large\">Jogos de luta</strong></p><p class=\"ql-align-justify\"><span class=\"ql-size-large\">Os jogos de luta são um clássico do cenário competitivo. Disputados entre duas pessoas (Jogador vs. Jogador ou PvP), esses games conquistem em causar dano no adversário até reduzir sua vida a zero. Street Fighter, Marvel vs. Capcom, Mortal Kombat e Dragon Ball são os principais títulos desse estilo.</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong class=\"ql-size-large\">Simuladores</strong></p><p class=\"ql-align-justify\"><span class=\"ql-size-large\">Os simuladores tentam reproduzir as características dos esportes da vida real, como futebol, basquete e automobilismo. O FIFA, da EA Sports, é a franquia de maior sucesso do gênero. O PES, da Konami, e o F1, da Codemasters, são outros dois exemplos de jogos populares desse estilo.</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong class=\"ql-size-large\">Card games</strong></p><p class=\"ql-align-justify\"><span class=\"ql-size-large\">Os jogos de carta promovem a disputa entre dois jogadores e misturam dois princípios importantes: a montagem do deck de cartas e a aplicação de estratégias. Os principais destaques desse gênero são Hearthstone, baseado no mundo de World of Warcraft – um MMORPG, combinação de MMOs e RPGs –, e GWENT, situado no universo de The Witcher.</span></p><p class=\"ql-align-justify\"><br></p></div>', 'Kyle Vargas', 0x696d6167656e732f736a78343676335449646768424f444f7751324347386b6a733469736c52454b584b703978566b692e706e67, 'fonte: google', '2024-03-19', 5, '2024-05-23 14:24:07', NULL),
(6, 'Retorno de Willian Bigode acirra disputa no ataque do Santos', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><p>Na última segunda-feira (29), o atacante Willian Bigode treinou no gramado do CT Rei Pelé com o restante dos companheiros e está mais próximo de voltar a jogar. Ele não entra em campo desde o dia 25 de fevereiro devido a uma lesão muscular na coxa esquerda.</p><p><br></p><p>O Santos, na época, ganhou por 2 a 1 do São Bernardo pelo Paulistão, no Morumbis. Desde então, o Peixe disputou oito partidas, sendo seis pelo torneio estadual e duas pela Série B.</p><p><br></p><p>Apesar do período fora de Bigode, o cenário permanece o mesmo: sem a definição de um titular absoluto no ataque. O argentino Julio Furch deveria ocupar essa função, mas ainda não reúne condições para disputar os 90 minutos.</p><p><br></p><p>Morelos, por sua vez, segue sem engrenar, ao passo que o jovem Enzo Monteiro busca seu espaço no profissional. Willian Bigode, portanto, tem a possibilidade de brigar por posição e quem sabe se firmar como titular.</p><p><br></p><p>Em 2024, o atacante participou de dez jogos, com dois gols marcados. Com a possível volta do centroavante, o Santos volta a campo para enfrentar o Guarani pela terceira rodada da Série B.</p><p><br></p><p>A bola vai rolar às 21h (de Brasília) da próxima segunda-feira, na Vila Belmiro. Com seis pontos, o Peixe está na liderança da Segunda Divisão</p><p><br></p><p><strong class=\"ql-size-large\">Veja os comparativos dos centroavantes do Santos em 2024:</strong></p><p><br></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Willian Bigode: dois gols em dez jogos</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Morelos: dois gols e uma assistência em 12 jogos</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Julio Furch: quatro gols em 17 jogos</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Enzo Monteiro: um jogo e zero gol</li></ol></div>', 'Rodrigo Sartori', 0x696d6167656e732f576130336d736d476941526c46326a37346b687066654e70686869774e64394b4f356158586247692e706e67, 'fonte: Globo Esporte', '2024-03-30', 5, '2024-05-24 14:24:07', NULL),
(8, 'Prefeitura de Santos, SP, divulga lista de atividades culturais e esportivas disponíveis nos postos da orla', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">A Prefeitura de&nbsp;</span><span style=\"background-color: rgb(255, 255, 255);\">Santos</span><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">, no litoral de São Paulo, divulgou uma lista de atividades de cultura e esporte disponíveis nos Postos da orla da praia. Segundo o município, os espaços disponibilizam diferentes opções de cultura e esportes ligados ao mar para a população&nbsp;</span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\"><em>(confira os serviços abaixo).</em></strong></p><p><br></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">De acordo com a historiadora Karime Mousalli, os \'postos de salvação\' foram criados pelo Governo do Estado de São Paulo em 1924, sendo instalados em um período de 4 anos. Segundo a Lei Ordinária 2.052, as bases devem ficar sob administração e imediata fiscalização da Delegacia de Polícia Marítima de Santos.</span></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">O Posto 1, na Avenida Presidente Wilson, próximo ao Novo Quebra-Mar, no bairro José Menino, é o único dos sete postos que não oferece um serviço direto para os moradores, servindo como apoio para o Corpo de Bombeiros na orla.</span></p><p><br></p><h2><span style=\"color: var(--glb-theme-clr-title); background-color: rgb(255, 255, 255);\">Confira os serviços oferecidos em cada posto:</span></h2><p><br></p><p><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Posto 2 - Escola Radical de Surfe</strong></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">A primeira escola pública de surfe do Brasil forma atletas nas categorias masculina e feminina. As aulas são coordenadas pelo professor Cisco Aranã e contam com aproximadamente 400 inscritos, de todas as idades, com o uso de equipamentos específicos para o público acima de 50 anos.</span></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Em atividade há 32 anos, a escola treina os alunos na Praia da Pompeia.</span></p><p><br></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Local:&nbsp;</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Avenida Presidente Wilson, próximo à Rua Olavo Bilac, Pompeia</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Telefone:</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">&nbsp;(13) 3251-9838</span></li></ol><p><br></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(238, 238, 238);\"><img src=\"https://s2-g1.glbimg.com/HNrD87ynhsu5ho8MDaHvXHF4gXQ=/0x0:1024x682/984x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2023/T/6/6tghGuTtadNVTdAld2og/raimundo-rosa-6680.jpg\" alt=\"Confira as atividades de cultura e esporte disponíveis nos Postos da Orla de Santos, SP — Foto: Prefeitura de Santos\"></span></p><p><span style=\"color: var(--glb-theme-clr-text-aux); background-color: rgb(255, 255, 255);\">Confira as atividades de cultura e esporte disponíveis nos Postos da Orla de Santos, SP — Foto: Prefeitura de Santos</span></p><p><br></p><p><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Posto 3 - Escola de Surfe Adaptado</strong></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">O objetivo da escola, conforme divulgado pela prefeitura, é propiciar a inclusão e o bem-estar de pessoas com deficiência, seja física ou mental, por meio do esporte.</span></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">A escola utiliza pranchas adaptadas e, por motivos de segurança, os treinos começam dentro do posto, antes dos alunos encararem as ondas.</span></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Segundo o terapeuta ocupacional da instituição, Antônio Vasconcelos, são usadas captações de imagens dos alunos durante as aulas, tanto para que os professores percebam a evolução de cada atleta, como também para que os surfistas, em contato com os vídeos, melhorem a própria sensação de segurança, aumentando assim a autoestima.</span></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Atualmente o Posto 3 atende mais de 170 alunos, com deficiência permanente ou temporária.</span></p><p><br></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Local:</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">&nbsp;Avenida Presidente Wilson, próximo à Rua Marcílio Dias, Gonzaga</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Telefone:</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">&nbsp;(13) 3235-8081</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">WhatsApp:</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">&nbsp;(13) 98852-4352 - somente à tarde</span></li></ol><p><br></p><p><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Posto 4 - Cine Arte</strong></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Segundo a prefeitura, este espaço conta com 41 lugares, incluindo os com acessibilidade, e prioriza filmes não comerciais, recheando a programação com títulos de festivais nacionais e internacionais.</span></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">O ingresso custa R$ 3,00, com meia-entrada de R$ 1,50 para estudantes, maiores de 60 anos e também professores da rede estadual de ensino. A bilheteria é aberta às 15h.</span></p><p><br></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Local:</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">&nbsp;Avenida Vicente de Carvalho, próximo à Avenida Washington Luiz (Canal 3), Gonzaga</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Sessões:&nbsp;</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">16h, 18h30 e 21h</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Telefone:</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">&nbsp;(13) 3288-4009</span></li></ol><p><br></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(238, 238, 238);\"><img src=\"https://s2-g1.glbimg.com/HAm_4ZmOqtJNStFkNXYi53Ja3II=/0x0:1200x800/984x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2023/J/i/u2QrBERSCXmgQJYVU9mw/whatsapp-image-2019-06-02-at-16.47.13.jpeg\" alt=\"Confira as atividades de cultura e esporte disponíveis nos Postos da Orla de Santos, SP — Foto: Prefeitura de Santos\"></span></p><p><span style=\"color: var(--glb-theme-clr-text-aux); background-color: rgb(255, 255, 255);\">Confira as atividades de cultura e esporte disponíveis nos Postos da Orla de Santos, SP — Foto: Prefeitura de Santos</span></p><p><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Posto 5 - Gibiteca Marcel Rodrigues Paes</strong></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">A Gibiteca Municipal oferece mais de 40 mil títulos no acervo, entre fanzines, mangás, obras infantis, títulos de autores independentes e revistas que fizeram história, como \'MAD\' e \'Chiclete com Banana\'.</span></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">O espaço climatizado realiza exposições, lançamentos, debates, bate-papos e sessões em grupo de RPG durante o ano todo. Segundo a curadora da iniciativa, Narayana Mamede, no penúltimo sábado de cada mês são realizados workshops com artista para interação com o público.</span></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Todo o acervo só pode ser lido no local, porém, é permitido uma troca de exemplares. Os interessados em doar gibis podem levar os materiais até o local ou então agendar a retirada em casa pelo telefone. O conteúdo repetido é encaminhado para escolas e entidades.</span></p><p><br></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Local:</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">&nbsp;Avenida Bartolomeu de Gusmão, próximo à Avenida Siqueira Campos, Aparecida</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Horários:</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">&nbsp;de segunda a sábado, das 9h às 19h; domingos, das 9h às 13h</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Telefone:</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">&nbsp;(13) 3288-1300</span></li></ol><p><br></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(238, 238, 238);\"><img src=\"https://s2-g1.glbimg.com/QIdwieOapgjgrGN-qIIynRqbw1M=/0x0:1200x800/984x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2023/A/Z/KLwBRIT3Wuy19iJYeGWQ/7a8ee6a6-4294-4ad3-b366-394a2f41f9a0.jpeg\" alt=\"Confira as atividades de cultura e esporte disponíveis nos Postos da Orla de Santos, SP — Foto: Prefeitura de Santos\"></span></p><p><span style=\"color: var(--glb-theme-clr-text-aux); background-color: rgb(255, 255, 255);\">Confira as atividades de cultura e esporte disponíveis nos Postos da Orla de Santos, SP — Foto: Prefeitura de Santos</span></p><p><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Posto 6 - Biblioteca Mário Faria</strong></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">A Biblioteca Municipal conta com mais de 25 mil títulos. Inaugurado em 1993, o espaço foi totalmente revitalizado pela prefeitura em agosto deste ano.</span></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">De acordo com o município, ao fazer um rápido cadastro, apresentando documento e comprovante de residência, o interessado pode levar para casa uma obra pelo prazo de 14 dias para a leitura. Caso não tenha concluído a tarefa, a renovação do prazo pode ser feita por telefone.</span></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Entre o acervo, há títulos em múltiplas línguas e uma farta coleção de obras para o público infanto-juvenil, além de dicionários e enciclopédias. A biblioteca também recebe exposição de quadros, sendo a atual idealizada por alunos da Vila Criativa.</span></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Segundo a bibliotecária Sueli Lopes, a maior parte da procura é por romances, autoajuda e ficção, com uma média de empréstimos que varia entre 20 e 30 títulos por dia.</span></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Os interessados em doar livros podem levá-los até o local ou agendar a retirada em casa pelo telefone.</span></p><p><br></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Local:</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">&nbsp;Avenida Bartolomeu de Gusmão, próximo à Rua Alexandre Martins, Aparecida</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Horários:</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">&nbsp;de segunda a sexta, das 9h às 19h; sábados e domingos, das 9h às 13h</span></li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Telefone:&nbsp;</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">(13) 3231-8713</span></li></ol><p><br></p><p><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Posto 7 - Escola de Esportes Náuticos</strong></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Oferece cursos gratuitos de caiaque, canoa havaiana e stand up paddle para pessoas acima de 12 anos. As aulas reúnem mais de 260 alunos. Segundo a prefeitura, saber nadar é um dos pré-requisitos.</span></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">As aulas de caiaque e stand up são realizadas de terça a sexta-feira, das 7h às 11h, e das 14h às 16h. As inscrições podem ser realizadas no segundo dia útil de cada mês, caso haja desistência ou negligência por parte de algum aluno. A matrícula é automaticamente cancelada após três faltas não justificadas.</span></p><p><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Já as aulas de canoa havaiana acontecem de terça a sexta-feira, das 8h30 às 11h30. O candidato receberá uma autorização com a lista de documentos necessários para a inscrição. Ambos os cursos são por tempo indeterminado.</span></p><p><br></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Local:&nbsp;</strong><span style=\"color: rgb(31, 33, 35); background-color: rgb(255, 255, 255);\">Avenida Bartolomeu de Gusmão, próximo à Avenida Cel. Joaquim Montenegro (Canal 6), Ponta da Praia.</span></li></ol><p class=\"ql-align-justify\"><br></p></div>', 'Mykiel Gregório Santos', 0x696d6167656e732f37766a4643783051534773647853515248394e6134697373714d73473938526172594d7a693656742e706e67, 'fonte: Fandom', '2024-06-07', 5, '2024-05-25 14:24:07', '2024-06-07 00:27:38'),
(9, 'Cristiane brilha, e Santos toma sete do Flamengo pelo Brasileiro Feminino', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><p>Na tarde desta segunda-feira, o Santos perdeu do Flamengo por 7 a 0 pela sétima rodada do Campeonato Brasileiro Feminino, no Estádio Luso-Brasileiro. Ex-atacante do Peixe, Cristiane brilhou e marcou duas vezes na derrota santista.</p><p><br></p><p>Com o resultado, as Sereias da Vila estão na 11ª posição, com sete pontos. Já as Rubro-Negras ocupam a décima colocação, com oito</p><p><br></p><p>Na próxima rodada, o Santos duela contra o Fluminense às 19h (de Brasília) dessa quinta-feira, na Vila Belmiro. O Flamengo, por sua vez, encara o Botafogo na mesma data, às 11h, no Estádio Luso-Brasileiro.</p><p><br></p><p><strong class=\"ql-size-large\">Os gols do duelo</strong></p><p><br></p><p>Aos oito minutos, o Flamengo abriu o marcador, quando Cristiane cabeceou para o fundo do gol. Com o Rubro-Negro melhor, não demorou para a vantagem ser ampliada: a zagueira Camila Martins, aos 26, marcou contra o próprio patrimônio.</p><p><br></p><p>Ainda na primeira etapa, aos 32, a camisa 9 fez valer a lei do ex novamente e marcou o seu segundo no confronto. Aos 18 do segundo tempo, Glaucia fez bela jogada e transformou a vitória em goleada.</p><p><br></p><p>Já na reta final do jogo, aos 23 minutos, Naná fez o quinto gol do Flamengo. Aos 30, Laysa deixou o dela no confronto. Nos acréscimos, Isadora Freitas deu números finais ao confronto.</p></div>', 'Paulino Roberto de Nascimento Júnior', 0x696d6167656e732f4534476b43335a76563744594734477157496f436376346378475477584445504d79347367624f592e706e67, 'Fonte: Uol', '2024-04-29', 5, '2024-05-26 14:24:07', NULL),
(10, 'Rede de escolas de futebol do Santos passa por reestruturação e ganha nova identidade visual', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><p>Fundada em 2003, a rede de escolas de futebol licenciada pelo foi relançada recentemente, como Meninos da Vila Santos Academy. Agora, o projeto, que possui 55 unidades, recebeu uma nova identidade visual e um plano para reposicionamento de marca.</p><p><br></p><p>A rede de escolas anunciou um site próprio e redes sociais com conteúdo planejado, com informações sobre todas as unidades. Além disso, as escolas contarão com uma assessoria de imprensa e mídias próprias.</p><p><br></p><p>O logotipo também foi atualizado e já está em uso em todas as escolas, que receberam um kit com a nova identidade visual.</p></div>', 'João Gomes Perez', 0x696d6167656e732f697832646734335a4264496b63646a3254354f3371737557664c4972306b6f4b5a356a78666b63492e706e67, 'Reprodução / Instagram (@meninosdavila)', '2024-06-07', 5, '2024-06-07 04:04:19', '2024-06-07 01:15:17');

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticia_modalidade`
--

CREATE TABLE `noticia_modalidade` (
  `id_modalidade` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `qt_modalidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `unidade`
--

CREATE TABLE `unidade` (
  `id_unidade` int(11) NOT NULL,
  `nm_unidade` varchar(50) NOT NULL,
  `ds_endereco` varchar(100) NOT NULL,
  `ds_contato` varchar(50) NOT NULL,
  `ds_secretaria` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `unidade`
--

INSERT INTO `unidade` (`id_unidade`, `nm_unidade`, `ds_endereco`, `ds_contato`, `ds_secretaria`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 'Centro Esportivo e Recreativo Rebouças', 'Praça Eng. José Rebouças, s/n - Ponta da Praia, Santos', '9398-5427', NULL, 5, '2024-05-25 11:22:00', NULL),
(2, 'Arena Santos', 'Avenida Rangel Pestana, 184 - Vila Matias, Santos', '4556-8978', NULL, 5, '2024-05-17 11:22:13', '2024-05-28 14:00:43'),
(3, 'Centro Esportivo M. Nascimento Jr', 'R. João Fraccaroli, s/n - Santa Maria, Santos', '3391-0741', NULL, 5, '2024-05-18 11:22:18', '2024-05-30 14:31:17'),
(4, 'Centro Esportivo e Recreativo da Zona Noroeste', 'R. Fausto Felício Bruzarosco, 8-120 - Castelo, Santos', '9898-9898', NULL, 5, '2024-05-19 11:22:29', NULL),
(12, 'Centro Esportivo Rei Pelé', 'Av. Rangel Pestana, 186, Vila Mathias', '4087-8733', NULL, 5, '2024-05-28 02:19:13', NULL),
(13, 'Ginásio Pepe', 'Rua das Vitórias, 100, Santos - SP', '4679-7889', 'Segunda à Sexta dás 9:00 - 12:00 e dás 14:00 - 16:00', 5, '2024-06-06 23:48:35', '2024-06-07 01:25:44');

-- --------------------------------------------------------

--
-- Estrutura para tabela `unidade_modalidade`
--

CREATE TABLE `unidade_modalidade` (
  `id_unidade` int(11) NOT NULL,
  `id_modalidade` int(11) NOT NULL,
  `ds_horario` varchar(150) NOT NULL,
  `ds_dia_semana` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `unidade_modalidade`
--

INSERT INTO `unidade_modalidade` (`id_unidade`, `id_modalidade`, `ds_horario`, `ds_dia_semana`) VALUES
(1, 1, '13:00-14:00', 'Quarta-feira'),
(1, 1, '13:00-14:00', 'Segunda-feira'),
(1, 2, '13:00-14:00', 'Quinta-feira'),
(1, 2, '13:00-14:00', 'Terça-feira'),
(2, 1, '13:00-14:00', 'Quarta-feira'),
(2, 1, '13:00-14:00', 'Segunda-feira'),
(2, 2, '13:00-14:00', 'Quinta-feira'),
(2, 2, '13:00-14:00', 'Terça-feira'),
(2, 8, '15:00-16:00', 'Quarta-feira'),
(2, 8, '15:00-16:00', 'Segunda-feira'),
(3, 6, '15:00-17:00', 'Sábado'),
(4, 7, '13:00-14:00', 'Quarta-feira'),
(4, 7, '13:00-14:00', 'Segunda-feira'),
(4, 8, '13:00-14:00', 'Quinta-feira'),
(4, 8, '13:00-14:00', 'Terça-feira'),
(12, 1, '16:00-17:00', 'Segunda-feira'),
(12, 1, '16:00-17:00', 'Sexta-feira'),
(12, 7, '16:00-17:00', 'Quinta-feira'),
(12, 7, '16:00-17:00', 'Terça-feira'),
(13, 1, '13:00-14:00', 'Segunda-feira'),
(13, 4, '12:00 - 13:00', 'Quinta-feira'),
(13, 4, '16:00 - 18:00', 'Segunda-feira'),
(13, 4, '12:00 - 13:00', 'Terça-feira');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `ds_email` varchar(50) NOT NULL,
  `nm_usuario` varchar(50) NOT NULL,
  `ds_senha` varchar(255) NOT NULL,
  `cd_usuario` char(8) NOT NULL,
  `sg_tipo` char(5) DEFAULT 'USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `ds_email`, `nm_usuario`, `ds_senha`, `cd_usuario`, `sg_tipo`) VALUES
(1, 'admin@admin.com', 'Admin', '123', 'SP', 'ADMIN'),
(3, 'indianapolis@gov.us', 'Indianapólis', '$2y$12$ywV1YAp/cX2ngEZ.cuXvWuKFlQ4NAUExQR9eh4dm6yDJRIwRh6L3S', 'IND-001', 'USER'),
(4, 'saopaulo@gov.br', 'São Paulo', '$2y$12$msm3jTMFAWV0mL8Bgd.vRumuTTzJH6RCLTkxM6hHfZe9xJHwooD/W', 'SP-001', 'USER'),
(5, 'santos@gov.br', 'Santos', '$2y$12$REvmrfaJB2x8RTrTk0nKUONLCJ0mBLOBI/4GRDTqL7FMMw07LGixa', 'SA-001', 'USER'),
(6, 'kyoto@gmail.com', 'Kyoto', '$2y$12$gqO0Hybq6rU3wrIeO3Gym.xr4ExAi.szsPwSBrXJcqCe5HJ4R6Rq2', 'KY-001', 'USER'),
(7, 'montevideo@hotmail.com', 'Montevidéu', '$2y$12$4ijAKdn9nOEPaynt/VOPEeyf5dbSzdexQNpDX0LbdCTc3KHyMViVC', 'MO-001', 'USER'),
(8, 'berlim@yahoo.com', 'Berlim', '123', 'Teste-00', 'USER'),
(9, 'roma@gmail.com', 'Roma', '123', 'Teste-00', 'USER'),
(10, 'londres@hotmail.com', 'Londres', '123', 'Teste-00', 'USER'),
(11, 'sidney@yahoo.com', 'Sidney', '123', 'Teste-00', 'USER'),
(12, 'paris@gmail.com', 'Paris', '123', 'Teste-00', 'USER'),
(13, 'praga@hotmail.com', 'Praga', '123', 'Teste-00', 'USER'),
(14, 'amsterdam@yahoo.com', 'Amsterdã', '123', 'Teste-00', 'USER'),
(15, 'barcelona@gmail.com', 'Barcelona', '123', 'Teste-01', 'USER');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `evento_unidade_fk` (`id_unidade`);

--
-- Índices de tabela `evento_modalidade`
--
ALTER TABLE `evento_modalidade`
  ADD PRIMARY KEY (`id_modalidade`,`id_evento`),
  ADD KEY `evento_modalidade_fk` (`id_evento`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `modalidade`
--
ALTER TABLE `modalidade`
  ADD PRIMARY KEY (`id_modalidade`);

--
-- Índices de tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id_noticia`);

--
-- Índices de tabela `noticia_modalidade`
--
ALTER TABLE `noticia_modalidade`
  ADD PRIMARY KEY (`id_modalidade`,`id_noticia`),
  ADD KEY `noticia_modalidade_fk` (`id_noticia`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `unidade`
--
ALTER TABLE `unidade`
  ADD PRIMARY KEY (`id_unidade`);

--
-- Índices de tabela `unidade_modalidade`
--
ALTER TABLE `unidade_modalidade`
  ADD UNIQUE KEY `unique_index` (`id_unidade`,`id_modalidade`,`ds_dia_semana`,`ds_horario`),
  ADD KEY `unidade_modalidade_fk` (`id_unidade`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `modalidade`
--
ALTER TABLE `modalidade`
  MODIFY `id_modalidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `unidade`
--
ALTER TABLE `unidade`
  MODIFY `id_unidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_unidade_fk` FOREIGN KEY (`id_unidade`) REFERENCES `unidade` (`id_unidade`);

--
-- Restrições para tabelas `evento_modalidade`
--
ALTER TABLE `evento_modalidade`
  ADD CONSTRAINT `evento_modalidade_fk` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id_evento`),
  ADD CONSTRAINT `modalidade_evento_fk` FOREIGN KEY (`id_modalidade`) REFERENCES `modalidade` (`id_modalidade`);

--
-- Restrições para tabelas `noticia_modalidade`
--
ALTER TABLE `noticia_modalidade`
  ADD CONSTRAINT `modalidade_noticia_fk` FOREIGN KEY (`id_modalidade`) REFERENCES `modalidade` (`id_modalidade`),
  ADD CONSTRAINT `noticia_modalidade_fk` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id_noticia`);

--
-- Restrições para tabelas `unidade_modalidade`
--
ALTER TABLE `unidade_modalidade`
  ADD CONSTRAINT `modalidade_unidade_fk` FOREIGN KEY (`id_modalidade`) REFERENCES `modalidade` (`id_modalidade`),
  ADD CONSTRAINT `unidade_modalidade_fk` FOREIGN KEY (`id_unidade`) REFERENCES `unidade` (`id_unidade`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
