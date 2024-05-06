-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/05/2024 às 16:26
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
  `dt_evento` date NOT NULL,
  `id_unidade` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `evento`
--

INSERT INTO `evento` (`id_evento`, `nm_evento`, `ds_evento`, `dt_evento`, `id_unidade`, `id_usuario`) VALUES
(1, 'Copa Tribuna de futsal escolar', 'Esporte de quadra', '2024-08-22', 2, 5),
(2, 'Copa de Futevôlei', 'Esporte na areia', '2023-06-13', 1, 5),
(3, 'Copa Tribuna de Basquete Escolar', 'Esporte de quadra', '2024-03-22', 1, 5),
(4, 'Copa Tribuna de Handball Escolar', 'Esporte de quadra', '2020-02-22', 1, 5),
(5, 'teste', 'teste', '2023-03-22', 1, 5),
(6, 'teste1', 'teste', '2019-06-06', 1, 5),
(7, 'Copa de Futsal', 'Futebol de salão', '2014-04-04', 1, 5),
(8, 'Copa de Vôlei', 'Esporte de quadra', '2016-07-07', 1, 5),
(9, 'Copa Tribuna de Vôlei Escolar', 'Esporte de quadra', '2023-05-08', 2, 5),
(10, 'Copa Tribuna de Tênis de mesa Escolar', 'Esporte de quadra', '2023-04-06', 2, 5),
(11, 'teste2', 'teste', '2024-06-06', 2, 5);

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
  `id_unidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `modalidade`
--

INSERT INTO `modalidade` (`id_modalidade`, `nm_modalidade`, `ds_modalidade`, `id_usuario`, `id_unidade`) VALUES
(1, 'Futsal', 'Futebol de salão', 5, NULL),
(2, 'Basquete', 'Esporte de quadra', 5, NULL),
(3, 'Tênis de quadra', 'Esporte de quadra com raquete', 5, NULL),
(4, 'Tênis de mesa', 'Esporte de mesa com raquete', 5, NULL),
(5, 'Futebol de areia', 'Futebol de areia', 5, NULL),
(6, 'Golf', 'Esporte de rico', 5, NULL),
(7, 'Vôlei', 'Esporte de quadra', 5, NULL),
(8, 'Handball', 'Esporte de quadra', 5, NULL),
(9, 'Natação', 'Esporte aquático', 4, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticia`
--

CREATE TABLE `noticia` (
  `id_noticia` int(11) NOT NULL,
  `nm_titulo` varchar(250) NOT NULL,
  `ds_conteudo` longtext NOT NULL,
  `im_capa` blob DEFAULT NULL,
  `dt_noticia` date NOT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `noticia`
--

INSERT INTO `noticia` (`id_noticia`, `nm_titulo`, `ds_conteudo`, `im_capa`, `dt_noticia`, `id_usuario`) VALUES
(1, 'teste editado 3', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><p>teste 3</p></div>', 0x696d6167656e732f47746f5668357a706269416949705874336a756761484f5675706f544d7a535951413950576b31362e6a7067, '2024-03-18', 5),
(2, 'Frieren e a Jornada para o Além', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><p><strong>Frieren e a Jornada para o Além&nbsp;</strong>(葬送のフリーレン&nbsp;Sōsō no Furīren)&nbsp;</p><p>É uma série de mangá japonesa escrita por <em>Kanehito Yamada</em> e ilustrada por <em>Tsukasa Abe</em>.</p><p>Está sendo publicada na revista&nbsp;Weekly Shōnen Sunday&nbsp;da&nbsp;Shogakukan&nbsp;desde abril de 2020, com seus capítulos compilados em 12 volumes de&nbsp;tankōbon&nbsp;até dezembro de 2023.Em <u>dezembro de 2023</u>, o mangá tinha mais de 17 milhões de cópias em circulação.</p><p>Em 2021, ganhou o 14º&nbsp;Manga Taishō&nbsp;e o Prêmio Novo Criador do 25º&nbsp;Prêmio Cultural Anual Tezuka Osamu.</p><table><tbody><tr><td data-row=\"1\"><strong style=\"color: black; background-color: rgb(250, 250, 250);\">Estúdio de animação</strong></td><td data-row=\"1\"><a href=\"https://pt.wikipedia.org/wiki/Madhouse\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(51, 102, 204);\">Madhouse</a></td></tr><tr><td data-row=\"2\"><strong style=\"color: black; background-color: rgb(250, 250, 250);\">Emissoras de televisão</strong></td><td data-row=\"2\"><a href=\"https://pt.wikipedia.org/wiki/Nippon_TV\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(51, 102, 204);\">Nippon TV</a></td></tr><tr><td data-row=\"3\"><strong style=\"color: black; background-color: rgb(250, 250, 250);\">Plataformas de&nbsp;<em>streaming</em></strong></td><td data-row=\"3\"><a href=\"https://pt.wikipedia.org/wiki/Crunchyroll\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(51, 102, 204);\">Crunchyroll</a><span style=\"color: black; background-color: rgb(250, 250, 250);\">&nbsp;(exceto&nbsp;</span><a href=\"https://pt.wikipedia.org/wiki/Sudeste_Asi%C3%A1tico\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(51, 102, 204);\">Sudeste Asiático</a><span style=\"color: black; background-color: rgb(250, 250, 250);\">)</span></td></tr></tbody></table><ol><li data-list=\"ordered\" class=\"ql-indent-1\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Frieren</li><li data-list=\"ordered\" class=\"ql-indent-1\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Himmel</li><li data-list=\"ordered\" class=\"ql-indent-1\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Deken</li><li data-list=\"ordered\" class=\"ql-indent-1\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Fern</li><li data-list=\"ordered\" class=\"ql-indent-1\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Stark</li><li data-list=\"ordered\" class=\"ql-indent-1\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Flamme</li><li data-list=\"ordered\" class=\"ql-indent-1\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Eisen</li><li data-list=\"ordered\" class=\"ql-indent-1\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Heiter</li></ol><p><br></p></div>', 0x696d6167656e732f5632495a554d364a6879414b776a513746614165676b4c7170337057724f426576307251655355722e6a7067, '2024-03-18', 5),
(3, 'teste 6', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><h1 class=\"ql-align-center\"><strong class=\"ql-font-verdana\" style=\"color: rgb(0, 102, 204); background-color: rgb(235, 214, 255);\"><em>What is Lorem Ipsum?</em></strong></h1><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify ql-indent-1\"><span class=\"ql-font-verdana\">Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><p class=\"ql-align-justify ql-indent-1\"><br></p><p class=\"ql-align-justify ql-indent-1\"><a href=\"https://br.freepik.com/fotos-gratis/pico-da-montanha-nevada-sob-a-majestade-generativa-da-galaxia-estrelada-ai_40968186.htm#query=wallpaper%20desktop&amp;position=5&amp;from_view=keyword&amp;track=ais&amp;uuid=35ab9ae7-645b-4c20-9529-37db8a860d7c\" rel=\"noopener noreferrer\" target=\"_blank\">image</a></p><p class=\"ql-align-justify ql-indent-1\"><img src=\"https://img.freepik.com/fotos-gratis/pico-da-montanha-nevada-sob-a-majestade-generativa-da-galaxia-estrelada-ai_188544-9650.jpg\"></p><p><br></p></div>', 0x696d6167656e732f657858615a4636536743347a69346867434172464942664b4436347664794e6738763952555034752e6a7067, '2024-03-18', 5),
(4, 'O que são e-sports e por que estão cada vez mais populares?', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><p class=\"ql-align-justify\"><span class=\"ql-font-verdana\">As competições de e-sports podem variar de acordo com o torneio ou o jogo disputado, mas apresentam características em comum na sua estrutura.</span></p><p class=\"ql-align-justify\"><span class=\"ql-font-verdana\">Nesse contexto, alguns elementos chave nos torneios incluem:</span></p><ol><li data-list=\"bullet\" class=\"ql-align-justify\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong class=\"ql-font-verdana\">jogadores:</strong><span class=\"ql-font-verdana\"> os gamers podem competir de forma individual ou como parte de uma equipe profissional;</span></li><li data-list=\"bullet\" class=\"ql-align-justify\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong class=\"ql-font-verdana\">organizações:</strong><span class=\"ql-font-verdana\"> esses jogadores podem fazer parte de uma organização, responsável por gerenciar e representar suas equipes nos torneios;</span></li><li data-list=\"bullet\" class=\"ql-align-justify\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong class=\"ql-font-verdana\">ligas das modalidades:</strong><span class=\"ql-font-verdana\"> as ligas são responsáveis por organizar, promover e criar regras para as competições de jogos eletrônicos. Normalmente, cada liga cuida de uma modalidade específica de games.</span></li></ol><p><br></p></div>', 0x696d6167656e732f45524555354757776d6c30727565683266667336596c376b757574746b586a675738375a5a5349612e6a7067, '2024-03-19', 5),
(5, 'Qual a origem dos e-sports?', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><p class=\"ql-align-justify\"><span class=\"ql-size-large\">O que são e-sports? E-sports é um termo que vem do inglês eletronic sports, ou esportes eletrônicos, utilizado para definir a modalidade competitiva de jogos virtuais. Nesses eventos, jogadores profissionais ou amadores se enfrentam em torneios oficiais de gêneros variados de games, desde esportes virtuais até jogos de estratégia em tempo real. Os jogos podem ser disputados individualmente ou em equipe e as principais competições normalmente contam com transmissão ao vivo.</span></p><p class=\"ql-align-justify\"><br></p><h1 class=\"ql-align-justify\"><strong>Principais tipos de jogos</strong></h1><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong class=\"ql-size-large\">Battle Royale</strong></p><p class=\"ql-align-justify\"><span class=\"ql-size-large\">O&nbsp;Battle Royale&nbsp;é o mais recente estilo de jogo do cenário competitivo. Popularizada com o lançamento de PlayerUnknown\'s Battlegrounds, em 2017, a modalidade consiste na coleta de recursos (lootear) e na sobrevivência, vencendo o último jogador a ficar vivo. Além do&nbsp;PUBG, o&nbsp;Fortnite, o&nbsp;Free Fire&nbsp;e, mais recentemente, o Call of Duty: Warzone também fazem sucesso entre os Battle Royales.</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong class=\"ql-size-large\">MOBA</strong></p><p class=\"ql-align-justify\"><span class=\"ql-size-large\">Os Multiplayer Online Battle Arena são um fenômeno entre os esportes eletrônicos. Nesse estilo de game, dois times se enfrentam em um mapa até um dos lados conseguir destruir a base da equipe oponente. Os jogos&nbsp;MOBA&nbsp;oferecem uma variedade de personagens que devem ser escolhidos pelos atletas e que possuem habilidades capazes de impactar a partida de maneiras diferentes. Seres que não são controlados pelos jogadores e torres de defesa da base também fazer parte do game. O&nbsp;League of Legends&nbsp;(LoL) e o Defense of the Ancients 2 (DotA 2), ambos jogados no PC, são os dois principais jogos entres os MOBAs.</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong class=\"ql-size-large\">FPS</strong></p><p class=\"ql-align-justify\"><span class=\"ql-size-large\">Os jogos&nbsp;FPS&nbsp;ou de tiro em primeira pessoa são os mais tradicionais do mundo dos esportes eletrônicos. Eles são jogados da perspectiva de um jogador que carrega uma arma e foca no combate com armas de fogo. Os principais jogos desse estilo são o Counter-Strike: Global Offensive (CS:GO), o Rainbow Six: Siege, o Overwatch, o CrossFire e, mais recentemente, o&nbsp;Valorant.</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong class=\"ql-size-large\">RTS</strong></p><p class=\"ql-align-justify\"><span class=\"ql-size-large\">Os jogos&nbsp;RTS&nbsp;ou Real Time Strategy (Estratégia em Tempo Real) geralmente envolvem conquistar o território inimigo por meio de estratégias de guerra, incluindo a construção de exércitos, o aquecimento da economia, a produção de recursos e a criação de defesas perfeitas. O StarCraft II e o seu precursor Warcraft III são os jogos mais conhecidos do gênero.</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong class=\"ql-size-large\">Jogos de luta</strong></p><p class=\"ql-align-justify\"><span class=\"ql-size-large\">Os jogos de luta são um clássico do cenário competitivo. Disputados entre duas pessoas (Jogador vs. Jogador ou PvP), esses games conquistem em causar dano no adversário até reduzir sua vida a zero. Street Fighter, Marvel vs. Capcom, Mortal Kombat e Dragon Ball são os principais títulos desse estilo.</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong class=\"ql-size-large\">Simuladores</strong></p><p class=\"ql-align-justify\"><span class=\"ql-size-large\">Os simuladores tentam reproduzir as características dos esportes da vida real, como futebol, basquete e automobilismo. O FIFA, da EA Sports, é a franquia de maior sucesso do gênero. O PES, da Konami, e o F1, da Codemasters, são outros dois exemplos de jogos populares desse estilo.</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong class=\"ql-size-large\">Card games</strong></p><p class=\"ql-align-justify\"><span class=\"ql-size-large\">Os jogos de carta promovem a disputa entre dois jogadores e misturam dois princípios importantes: a montagem do deck de cartas e a aplicação de estratégias. Os principais destaques desse gênero são Hearthstone, baseado no mundo de World of Warcraft – um MMORPG, combinação de MMOs e RPGs –, e GWENT, situado no universo de The Witcher.</span></p><p class=\"ql-align-justify\"><br></p></div>', 0x696d6167656e732f736a78343676335449646768424f444f7751324347386b6a733469736c52454b584b703978566b692e706e67, '2024-03-19', 5),
(6, 'Retorno de Willian Bigode acirra disputa no ataque do Santos', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><p>Na última segunda-feira (29), o atacante Willian Bigode treinou no gramado do CT Rei Pelé com o restante dos companheiros e está mais próximo de voltar a jogar. Ele não entra em campo desde o dia 25 de fevereiro devido a uma lesão muscular na coxa esquerda.</p><p><br></p><p>O Santos, na época, ganhou por 2 a 1 do São Bernardo pelo Paulistão, no Morumbis. Desde então, o Peixe disputou oito partidas, sendo seis pelo torneio estadual e duas pela Série B.</p><p><br></p><p>Apesar do período fora de Bigode, o cenário permanece o mesmo: sem a definição de um titular absoluto no ataque. O argentino Julio Furch deveria ocupar essa função, mas ainda não reúne condições para disputar os 90 minutos.</p><p><br></p><p>Morelos, por sua vez, segue sem engrenar, ao passo que o jovem Enzo Monteiro busca seu espaço no profissional. Willian Bigode, portanto, tem a possibilidade de brigar por posição e quem sabe se firmar como titular.</p><p><br></p><p>Em 2024, o atacante participou de dez jogos, com dois gols marcados. Com a possível volta do centroavante, o Santos volta a campo para enfrentar o Guarani pela terceira rodada da Série B.</p><p><br></p><p>A bola vai rolar às 21h (de Brasília) da próxima segunda-feira, na Vila Belmiro. Com seis pontos, o Peixe está na liderança da Segunda Divisão</p><p><br></p><p><strong class=\"ql-size-large\">Veja os comparativos dos centroavantes do Santos em 2024:</strong></p><p><br></p><ol><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Willian Bigode: dois gols em dez jogos</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Morelos: dois gols e uma assistência em 12 jogos</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Julio Furch: quatro gols em 17 jogos</li><li data-list=\"bullet\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Enzo Monteiro: um jogo e zero gol</li></ol></div>', 0x696d6167656e732f576130336d736d476941526c46326a37346b687066654e70686869774e64394b4f356158586247692e706e67, '2024-03-30', 5),
(8, 'Tomo-chan Is a Girl! Série de revista em quadrinhos', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><p class=\"ql-align-justify\"><strong style=\"background-color: rgb(255, 255, 255); color: rgb(58, 58, 58);\">Tomo-chan Is a Girl!</strong><span style=\"background-color: rgb(255, 255, 255); color: rgb(58, 58, 58);\">&nbsp;(トモちゃんは女の子！&nbsp;</span><em style=\"background-color: rgb(255, 255, 255); color: rgb(58, 58, 58);\">Tomo-chan wa Onnanoko!</em><span style=\"background-color: rgb(255, 255, 255); color: rgb(58, 58, 58);\">) é uma adaptação de anime de 12 episódios para uma série de televisão baseada no manga de comédia e romance de Fumita Yanagida. O anime é do estúdio Lay-duce, com Hitoshi Nanba como diretor. Ele estreou no Japão em 5 de Janeiro de 2023 e foi finalizado em 30 de Março do mesmo ano.</span></p></div>', 0x696d6167656e732f37786e784a31617a47596f70714e564735336b41563064446358544b726576336b49364c424b66522e706e67, '2024-04-11', 5),
(9, 'Cristiane brilha, e Santos toma sete do Flamengo pelo Brasileiro Feminino', '<div class=\"ql-editor\" contenteditable=\"true\" data-placeholder=\"Escrever o conteúdo da notícia...\"><p>Na tarde desta segunda-feira, o Santos perdeu do Flamengo por 7 a 0 pela sétima rodada do Campeonato Brasileiro Feminino, no Estádio Luso-Brasileiro. Ex-atacante do Peixe, Cristiane brilhou e marcou duas vezes na derrota santista.</p><p><br></p><p>Com o resultado, as Sereias da Vila estão na 11ª posição, com sete pontos. Já as Rubro-Negras ocupam a décima colocação, com oito</p><p><br></p><p>Na próxima rodada, o Santos duela contra o Fluminense às 19h (de Brasília) dessa quinta-feira, na Vila Belmiro. O Flamengo, por sua vez, encara o Botafogo na mesma data, às 11h, no Estádio Luso-Brasileiro.</p><p><br></p><p><strong class=\"ql-size-large\">Os gols do duelo</strong></p><p><br></p><p>Aos oito minutos, o Flamengo abriu o marcador, quando Cristiane cabeceou para o fundo do gol. Com o Rubro-Negro melhor, não demorou para a vantagem ser ampliada: a zagueira Camila Martins, aos 26, marcou contra o próprio patrimônio.</p><p><br></p><p>Ainda na primeira etapa, aos 32, a camisa 9 fez valer a lei do ex novamente e marcou o seu segundo no confronto. Aos 18 do segundo tempo, Glaucia fez bela jogada e transformou a vitória em goleada.</p><p><br></p><p>Já na reta final do jogo, aos 23 minutos, Naná fez o quinto gol do Flamengo. Aos 30, Laysa deixou o dela no confronto. Nos acréscimos, Isadora Freitas deu números finais ao confronto.</p></div>', 0x696d6167656e732f4534476b43335a76563744594734477157496f436376346378475477584445504d79347367624f592e706e67, '2024-04-29', 5);

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
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `unidade`
--

INSERT INTO `unidade` (`id_unidade`, `nm_unidade`, `ds_endereco`, `id_usuario`) VALUES
(1, 'Centro Esportivo e Recreativo Rebouças', 'Praça Eng. José Rebouças, s/n - Ponta da Praia, Santos', 5),
(2, 'Arena Santos', 'Avenida Rangel Pestana, 184 - Vila Matias, Santos', 5),
(3, 'Centro Esportivo M. Nascimento Jr', 'R. João Fraccaroli, s/n - Santa Maria, Santos', 5),
(4, 'Centro Esportivo e Recreativo da Zona Noroeste', 'R. Fausto Felício Bruzarosco, 8-120 - Castelo, Santos', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `unidade_modalidade`
--

CREATE TABLE `unidade_modalidade` (
  `id_unidade` int(11) NOT NULL,
  `id_modalidade` int(11) NOT NULL,
  `qt_modalidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD PRIMARY KEY (`id_modalidade`,`id_unidade`),
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
  MODIFY `id_modalidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `unidade`
--
ALTER TABLE `unidade`
  MODIFY `id_unidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
