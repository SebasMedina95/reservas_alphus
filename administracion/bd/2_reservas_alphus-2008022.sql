-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2022 a las 22:15:17
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reservas_alphus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `estado` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `banner`
--

INSERT INTO `banner` (`id`, `img`, `estado`, `fecha`) VALUES
(1, 'vistas/img/banner/banner01.jpg', '1', '2022-01-12 05:58:10'),
(2, 'vistas/img/banner/banner02.jpg', '1', '2022-01-12 05:58:19'),
(3, 'vistas/img/banner/banner03.jpg', '1', '2022-01-12 05:58:27'),
(4, 'vistas/img/banner/banner04.jpg', '1', '2022-01-12 05:58:35'),
(5, 'vistas/img/banner/banner05.jpg', '1', '2022-01-12 06:46:33'),
(6, 'vistas/img/banner/banner06.jpg', '1', '2022-01-12 06:46:33'),
(7, 'vistas/img/banner/banner07.jpg', '1', '2022-01-12 06:46:33'),
(8, 'vistas/img/banner/banner08.jpg', '1', '2022-01-12 06:46:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carta`
--

CREATE TABLE `carta` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL,
  `ruta` text NOT NULL,
  `img` text NOT NULL,
  `tipo` text NOT NULL,
  `precio` float NOT NULL,
  `estado` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carta`
--

INSERT INTO `carta` (`id`, `nombre`, `descripcion`, `ruta`, `img`, `tipo`, `precio`, `estado`, `fecha`) VALUES
(1, 'Filetes de Pescado Marinados', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry is standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'filetes-de-pescado-marinados', 'vistas/img/carta/1.jpg', 'M', 16900, '1', '2022-02-07 11:02:50'),
(2, 'Tacos a la Mexicana', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English.', 'tacos-a-la-mexicana', 'vistas/img/carta/2.jpg', 'M', 18500, '1', '2022-02-07 11:03:09'),
(3, 'Hamburguesa Retro', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'hamburguesa-retro', 'vistas/img/carta/3.jpg', 'M', 17900, '1', '2022-02-07 11:03:25'),
(4, 'Torre de Waffles Frutales', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words', 'torre-de-waffles-frutales', 'vistas/img/carta/4.jpg', 'D', 14000, '1', '2022-01-30 22:25:10'),
(5, 'Desayuno Napolitano', 'Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of de Finibus Bonorum et Malorum (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, Lorem ipsum dolor sit amet.., comes from a line in section 1.10.32.', 'desayuno-napolitano', 'vistas/img/carta/5.jpg', 'D', 15100, '1', '2022-02-07 11:03:54'),
(6, 'Cañonada Gourmet', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even slightly believable. ', 'cañonada-gourmet', 'vistas/img/carta/6.jpg', 'A', 19900, '1', '2022-02-07 11:04:19'),
(7, 'Pizza Calixto', 'If you are going to use a passage of Lorem Ipsum, you need to be sure there is not anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. ', 'pizza-calixto', 'vistas/img/carta/7.jpg', 'M', 21600, '1', '2022-02-07 11:04:33'),
(8, 'Costillas BBQ Caseras', 'It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'costillas-bbq-caseras', 'vistas/img/carta/8.jpg', 'M', 26700, '1', '2022-01-30 22:26:56'),
(9, 'Churrasco de la Casa', 'Ut tincidunt imperdiet vestibulum. Nulla neque nisl, aliquet vel vehicula at, tempor ut quam. Aenean interdum nulla quis risus commodo lobortis. Fusce facilisis ante arcu, at ornare ante consectetur vitae. Vivamus gravida orci diam. Nullam suscipit nulla vitae lectus ultricies ultrices. Pellentesque ornare felis id luctus tempor. Quisque semper augue mi, non consectetur risus laoreet eu.', 'churrasco-de-la-casa', 'vistas/img/carta/9.jpg', 'M', 24100, '1', '2022-01-30 22:27:15'),
(10, 'Huevillos Paladinos', 'Nunc ultricies mollis condimentum. In commodo mauris lacus, non lobortis risus venenatis sit amet. Sed porttitor massa leo, sed mollis lacus faucibus vitae. Suspendisse eget arcu sit amet sem euismod commodo. Nullam pharetra purus lacinia, hendrerit leo a, rhoncus diam. Quisque consectetur diam ac dolor molestie, sed sodales metus vulputate.', 'huevillos-paladinos', 'vistas/img/carta/10.jpg', 'D', 15000, '1', '2022-01-30 22:27:32'),
(11, 'Pinchos Rancheros', 'Vivamus mattis fermentum lorem, eu hendrerit est molestie id. Nullam urna mi, lacinia a finibus eu, ultricies ut purus. In iaculis magna nec libero hendrerit semper. Vestibulum volutpat hendrerit blandit.', 'pinchos-rancheros', 'vistas/img/carta/11.jpg', 'M', 23400, '1', '2022-01-30 22:28:20'),
(12, 'Mixto de Carnes', 'Sed erat ipsum, tincidunt vel varius ac, fermentum convallis dolor. Nunc mattis, nisi id volutpat ullamcorper, sapien ex hendrerit mauris, ac finibus lorem enim et est. Sed mollis dapibus magna, in euismod libero. Mauris facilisis, dui vel pulvinar egestas, libero mi dictum leo, sed tempus mauris leo ultricies lectus.', 'mixto-de-carnes', 'vistas/img/carta/12.jpg', 'M', 31400, '1', '2022-01-30 22:28:35'),
(13, 'Arroz con Pollo Baly', 'Phasellus vestibulum non mi maximus pharetra. Aenean cursus justo vitae felis dictum, ac placerat dolor molestie. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent maximus fermentum rhoncus.', 'arroz-con-pollo-baly', 'vistas/img/carta/13.jpg', 'A', 18500, '1', '2022-01-30 22:29:09'),
(14, 'Cerdillo Ahumado Baly', 'Fusce efficitur mi eget nunc cursus rhoncus. Vivamus gravida iaculis porta. Morbi eget fringilla turpis. Nulla luctus ut sapien molestie consequat. Sed pretium libero vitae orci elementum, id consequat ante auctor. Sed placerat pharetra sapien et auctor. ', 'cerdillo-ahumado-baly', 'vistas/img/carta/14.jpg', 'A', 19700, '1', '2022-01-30 22:29:27'),
(15, 'Nachos Balandy Obalados', 'Aliquam gravida ipsum sed ipsum hendrerit, sit amet egestas massa vestibulum. Integer nec aliquam mi, a euismod sapien. Donec vitae velit ac nisl gravida accumsan.', 'nachos-balandy-obalados', 'vistas/img/carta/15.jpg', 'M', 22100, '1', '2022-01-30 22:29:43'),
(16, 'Desayuno Baliza', 'Vivamus viverra tortor vel scelerisque faucibus. Integer porttitor turpis id ante suscipit porttitor sit amet quis dolor. Mauris elementum felis a lacus convallis, in aliquam nisl varius. Etiam aliquet rhoncus lectus placerat fringilla.', 'desayuno-baliza', 'vistas/img/carta/16.jpg', 'D', 13500, '1', '2022-01-30 22:30:27'),
(17, 'Plaguy de Carne Baly', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce augue arcu, finibus eget augue at, mattis faucibus nunc. Vestibulum vulputate euismod neque, sit amet placerat metus. Maecenas vulputate lorem turpis, ut consequat dolor ultricies sollicitudin. Proin vel magna pharetra', 'plaguy-de-carne-baly', 'vistas/img/carta/17.jpg', 'M', 25600, '1', '2022-01-30 22:30:43'),
(18, 'Milanesas de Pescado Baly', 'Vestibulum rutrum dolor risus, non posuere purus auctor a. Maecenas felis ante, fermentum vehicula imperdiet in, sollicitudin sed turpis. Phasellus turpis dui, placerat vitae consequat id, pulvinar ac metus. Phasellus sed pretium turpis, eu aliquet mauris. ', 'milanesas-de-pescado-baly', 'vistas/img/carta/18.jpg', 'M', 14700, '1', '2022-01-30 22:31:06'),
(19, 'Pastas de Carne Bary', 'Donec condimentum, ipsum sit amet tempus mattis, nisi dolor laoreet nisl, id sodales nulla dui et enim. Praesent commodo neque a enim vehicula, nec tempus odio convallis.', 'pastas-de-carne-bary', 'vistas/img/carta/19.jpg', 'A', 18000, '1', '2022-01-30 22:31:23'),
(20, 'Sandwichs Calibues', 'Aenean interdum nulla quis risus commodo lobortis. Fusce facilisis ante arcu, at ornare ante consectetur vitae. Vivamus gravida orci diam.', 'sandwichs-calibues', 'vistas/img/carta/20.jpg', 'M', 11700, '1', '2022-02-07 11:06:36'),
(21, 'Cazuela de Frioles Baly', 'Quisque aliquam sed arcu non vehicula. Quisque ac turpis quis urna commodo malesuada quis eu mi. Phasellus efficitur a dolor ac blandit. Phasellus quis dui ac nibh vestibulum auctor.', 'cazuela-de-frioles-baly', 'vistas/img/carta/21.jpg', 'A', 17900, '1', '2022-01-30 22:32:29'),
(22, 'Patacones con Hogao Baly', 'Nunc ex est, scelerisque eget maximus eu, tincidunt id massa. Integer ullamcorper rhoncus arcu a vehicula. Morbi dictum placerat dui. Etiam elit ipsum, imperdiet et nulla sed, sodales lobortis tellus. Praesent eu metus ornare, elementum velit vel, sagittis augue.', 'patacones-con-hogao-baly', 'vistas/img/carta/22.jpg', 'M', 21800, '1', '2022-01-30 22:32:57'),
(23, 'Sopa Pililla Alphus', 'Sed mollis dapibus magna, in euismod libero. Mauris facilisis, dui vel pulvinar egestas, libero mi dictum leo, sed tempus mauris leo ultricies lectus.', 'sopa-pililla-alphus', 'vistas/img/carta/23.jpg', 'A', 18500, '1', '2022-01-30 22:33:17'),
(24, 'Croquetas de Cerdo Baly', ' Vivamus consequat, risus quis consectetur aliquet, magna enim pulvinar nisl, in iaculis dui neque ac magna. Aenean maximus auctor lorem eu facilisis. Morbi faucibus vel massa et tristique. Nulla placerat lacinia porta. Ut justo felis, consequat eget dui a, tincidunt tempor nibh. Suspendisse potenti.', 'croquetas-de-cerdo-baly', 'vistas/img/carta/24.jpg', 'M', 22200, '1', '2022-01-30 22:33:35'),
(25, 'Pavo Ahumado Baly', 'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain', 'pavo-ahumado-baly', 'vistas/img/carta/25.jpg', 'M', 26900, '1', '2022-02-07 11:07:34'),
(26, 'Mariscos a la Naranja', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 'mariscos-a-la-naranja', 'vistas/img/carta/26.jpg', 'M', 32700, '1', '2022-02-04 07:36:53'),
(27, 'Festín de Res Baly', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae', 'festin-de-res-baly', 'vistas/img/carta/27.jpg', 'A', 35800, '1', '2022-02-07 11:07:58'),
(28, 'Nachería Caliqueso', 'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue', 'nacheria-caliqueso', 'vistas/img/carta/28.jpg', 'M', 22600, '1', '2022-02-04 07:36:53'),
(29, 'Lasagna Multi Baly', 'These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted', 'lasagna -multi-baly', 'vistas/img/carta/29.jpg', 'M', 27800, '1', '2022-02-04 07:36:53'),
(30, 'Gran Cazuela Marina', 'But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 'gran-cazuela-marina', 'vistas/img/carta/30.jpg', 'A', 32500, '1', '2022-02-04 08:33:08'),
(31, 'Dobladillos de Pollo', 'Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.', 'dobladillos-de-pollo', 'vistas/img/carta/31.jpg', 'A', 26700, '1', '2022-02-04 08:33:08'),
(32, 'Gran Cazuela BalyPock', 'Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? ', 'gran-cazuela-balypock', 'vistas/img/carta/32.jpg', 'A', 38800, '1', '2022-02-04 08:33:08'),
(33, 'Huevillo en Queso Baly', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure', 'huevillo-en-queso-baly', 'vistas/img/carta/33.jpg', 'D', 16100, '1', '2022-02-04 08:33:08'),
(34, 'Pisadilla de Carnes', 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'pisadilla-de-carnes', 'vistas/img/carta/34.jpg', 'A', 35700, '1', '2022-02-04 08:33:08'),
(35, 'Pinchitos', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'pinchitos', 'vistas/img/carta/35.jpg', 'M', 21100, '1', '2022-02-04 08:33:08'),
(36, 'Burguer Pez', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself.', 'burguer-pez', 'vistas/img/carta/36.jpg', 'A', 38700, '1', '2022-02-04 08:33:08'),
(37, 'Coquito de Chocolate', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio', 'coquito-de-chocolate', 'vistas/img/carta/37.jpg', 'H', 11200, '1', '2022-02-04 08:33:08'),
(38, 'Souflet Baly', 'But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 'souflet-baly', 'vistas/img/carta/38.jpg', 'H', 17700, '1', '2022-02-04 08:33:08'),
(39, 'Fiesta de Galleta', 'Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.', 'fiesta-de-galleta', 'vistas/img/carta/39.jpg', 'H', 15100, '1', '2022-02-04 08:33:08'),
(40, 'Balanilla Frutal', 'To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?', 'balanilla-frutal', 'vistas/img/carta/40.jpg', 'H', 19600, '1', '2022-02-04 08:33:08'),
(41, 'Albóndigas de Chocolate', 'Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of de Finibus Bonorum et Malorum (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance', 'albondigas-de-chocolate', 'vistas/img/carta/41.jpg', 'H', 12300, '1', '2022-02-07 11:10:09'),
(42, 'El Gran MagnyTop', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there is not anything embarrassing hidden in the middle of text.', 'el-gran-magnytop', 'vistas/img/carta/42.jpg', 'H', 36700, '1', '2022-02-07 11:10:25'),
(43, 'Pachalila de Helado', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur', 'pachalila-de-helado', 'vistas/img/carta/43.jpg', 'H', 27000, '1', '2022-02-04 08:52:19'),
(44, 'Cleppy Pastas de Carne', 'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which', 'cleppy-pastas-de-carne', 'vistas/img/carta/44.jpg', 'A', 17800, '1', '2022-02-09 09:18:11'),
(45, 'Pasta en Pollo Baly', 'Nulla dictum libero est, at venenatis nibh varius eget. Duis nunc eros, volutpat eget tempor tempus, mollis in nisi. Donec non tortor tincidunt massa lacinia hendrerit a quis mi. Etiam a ex interdum, convallis nisl vel, varius orci. Fusce lacus ex, feugiat in malesuada a, luctus non lorem.', 'pasta-en-pollo-baly', 'vistas/img/carta/45.jpg', 'M', 18100, '1', '2022-02-04 09:11:29'),
(46, 'Macarrones Baly', 'Proin efficitur fermentum sagittis. Phasellus euismod, mauris quis ultrices sollicitudin, nunc metus blandit lectus, quis malesuada turpis mi eu ligula. Vivamus tincidunt pharetra felis. Aliquam feugiat porta leo vitae porttitor.', 'macarrones-baly', 'vistas/img/carta/46.jpg', 'M', 14600, '1', '2022-02-04 09:11:29'),
(47, 'Derretido Gourmet Baly', 'Integer tincidunt felis sapien, a molestie lacus lobortis eu. Aliquam convallis ex diam, sed bibendum odio imperdiet eget. Maecenas a ex id purus faucibus luctus. Donec tincidunt augue in semper condimentum. Donec nulla metus, feugiat a justo ac, maximus ornare nulla.', 'derretido-gourmet-baly', 'vistas/img/carta/47.jpg', 'M', 29700, '1', '2022-02-04 09:11:29'),
(48, 'PockTank Marino', 'Quisque ac egestas lectus, nec suscipit augue. Fusce sodales finibus mauris vel accumsan. Vestibulum fermentum ultrices turpis at fermentum. Aenean magna diam, fermentum et metus et, sollicitudin congue mauris. Fusce vestibulum sodales odio vel interdum. Morbi vulputate', 'pocktank-marino', 'vistas/img/carta/48.jpg', 'M', 26800, '1', '2022-02-04 09:11:29'),
(49, 'Taleth de Pisos', 'Curabitur tempor rhoncus placerat. Proin ac blandit tellus, quis hendrerit purus. Phasellus cursus laoreet nunc, at sodales metus porttitor ut. Quisque molestie nibh a urna pulvinar, nec aliquam odio auctor. Cras eu diam nunc. Nulla quis tristique nisi, cursus egestas nulla.', 'taleth-de-pisos', 'vistas/img/carta/49.jpg', 'M', 21400, '1', '2022-02-04 09:11:29'),
(50, 'Gran Mancini Mixto', 'Maecenas a ex id purus faucibus luctus. Donec tincidunt augue in semper condimentum. Donec nulla metus, feugiat a justo ac, maximus ornare nulla. Donec vitae condimentum turpis. Etiam vulputate tortor ac lectus congue vehicula. Fusce eleifend orci sit amet urna placerat lacinia. Cras eget vestibulum purus.', 'gran-mancini-mixto', 'vistas/img/carta/50.jpg', 'M', 31400, '1', '2022-02-04 09:11:29'),
(51, 'Solomitos Baly', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin lorem tellus, rutrum non velit in, facilisis luctus diam. Nullam euismod dolor laoreet lorem auctor, a egestas ipsum elementum. Quisque ut felis augue. Vivamus gravida massa justo, vitae molestie justo viverra sit amet.', 'solomitos-baly', 'vistas/img/carta/51.jpg', 'M', 28600, '1', '2022-02-04 09:11:29'),
(52, 'Gran Fitech de Camarones', 'Phasellus a eros quis nulla malesuada tempor. Mauris hendrerit, neque et laoreet cursus, tellus nisi ultrices lectus, eu vehicula ante orci sed dolor. Proin egestas facilisis lacus, sed laoreet quam tristique ornare. Nam bibendum massa ac facilisis vestibulum. Donec hendrerit a nisl id sollicitudin.', 'gran-fitech-de-camarones', 'vistas/img/carta/52.jpg', 'M', 32100, '1', '2022-02-04 09:11:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `ruta` text NOT NULL,
  `color` text NOT NULL,
  `tipo` text NOT NULL,
  `img` text NOT NULL,
  `img_min` text NOT NULL,
  `descripcion` text NOT NULL,
  `incluye` text NOT NULL,
  `continental_alta` float NOT NULL,
  `continental_baja` float NOT NULL,
  `americano_alta` float NOT NULL,
  `americano_baja` float NOT NULL,
  `estado` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `ruta`, `color`, `tipo`, `img`, `img_min`, `descripcion`, `incluye`, `continental_alta`, `continental_baja`, `americano_alta`, `americano_baja`, `estado`, `fecha`) VALUES
(1, 'habitacion-tipo-suite', '#847059', 'Suite', 'vistas/img/suite/portada.png', 'vistas/img/suite/portada-min.png', 'Habitación Suite Lujos', '[{\"item\":\"Cama 2 x 2\",\"icono\":\"fas fa-bed\"},{\"item\":\"TV de 42 Pulg\",\"icono\":\"fas fa-tv\"},{\"item\":\"Agua Caliente\",\"icono\":\"fas fa-tint\"},{\"item\":\"Jacuzzi\",\"icono\":\"fas fa-water\"},{\"item\":\"Servicio Wifi\",\"icono\":\"fas fa-wifi\"},{\"item\":\"Cocina Privada\",\"icono\":\"fas fa-utensils\"},{\"item\":\"Bar Privado\",\"icono\":\"fas fa-cocktail\"},{\"item\":\"Piscina Privada\",\"icono\":\"fas fa-swimmer\"},{\"item\":\"Paseo en Helicoptero\",\"icono\":\"fas fa-helicopter\"},{\"item\":\"Equipo de Computo\",\"icono\":\"fas fa-laptop\"}]', 150000, 80000, 300000, 250000, '1', '2022-08-14 04:45:28'),
(2, 'habitacion-tipo-especial', '#197DB1', 'Especial', 'vistas/img/especial/portada.png', 'vistas/img/especial/portada-min.png', 'Habitación especializada', '[{\"item\":\"TV de 42 Pulg\",\"icono\":\"fas fa-tv\"},{\"item\":\"Agua Caliente\",\"icono\":\"fas fa-tint\"},{\"item\":\"Baño privado\",\"icono\":\"fas fa-toilet\"},{\"item\":\"Sofá\",\"icono\":\"fas fa-couch\"},{\"item\":\"Servicio Wifi\",\"icono\":\"fas fa-wifi\"},{\"item\":\"Cocina Privada\",\"icono\":\"fas fa-utensils\"},{\"item\":\"Bar Privado\",\"icono\":\"fas fa-cocktail\"}]', 160000, 100000, 230000, 200000, '1', '2022-08-14 04:45:44'),
(3, 'habitacion-tipo-standar', '#2F7D84', 'Standar', 'vistas/img/standar/589.jpg', 'vistas/img/standar/589-min.jpg', 'Habitación sencilla', '[{\"item\":\"TV de 42 Pulg\",\"icono\":\"fas fa-tv\"},{\"item\":\"Agua Caliente\",\"icono\":\"fas fa-tint\"},{\"item\":\"Baño privado\",\"icono\":\"fas fa-toilet\"},{\"item\":\"Sofá\",\"icono\":\"fas fa-couch\"},{\"item\":\"Servicio Wifi\",\"icono\":\"fas fa-wifi\"},{\"item\":\"Cocina Privada\",\"icono\":\"fas fa-utensils\"}]', 120000, 80000, 200000, 160000, '1', '2022-08-14 04:45:56'),
(4, 'habitacion-tipo-presidencial', '#edce53', 'Presidencial', 'vistas/img/presidencial/portada.png', 'vistas/img/presidencial/portada-min.png', 'Habitación Sute Presidencial', '[{\"item\":\"TV de 42 Pulg\",\"icono\":\"fas fa-tv\"},{\"item\":\"Agua Caliente\",\"icono\":\"fas fa-tint\"},{\"item\":\"Jacuzzi\",\"icono\":\"fas fa-water\"},{\"item\":\"Servicio Wifi\",\"icono\":\"fas fa-wifi\"},{\"item\":\"Cocina Privada\",\"icono\":\"fas fa-utensils\"},{\"item\":\"Bar Privado\",\"icono\":\"fas fa-cocktail\"},{\"item\":\"Piscina Privada\",\"icono\":\"fas fa-swimmer\"},{\"item\":\"Bañera\",\"icono\":\"fas fa-bath\"},{\"item\":\"Baño Turco\",\"icono\":\"fas fa-person-booth\"},{\"item\":\"Paseo en Barco\",\"icono\":\"fas fa-ship\"},{\"item\":\"Zona Ambiente\",\"icono\":\"fas fa-glass-cheers\"}]', 270000, 180000, 400000, 300000, '1', '2022-08-14 04:46:12'),
(5, 'habitacion-tipo-penthouse', '#fa75df', 'PentHouse', 'vistas/img/penthouse/portada.png', 'vistas/img/penthouse/portada-min.png', 'Habitación PentHouse', '[{\"item\":\"TV de 42 Pulg\",\"icono\":\"fas fa-tv\"},{\"item\":\"Agua Caliente\",\"icono\":\"fas fa-tint\"},{\"item\":\"Jacuzzi\",\"icono\":\"fas fa-water\"},{\"item\":\"Servicio Wifi\",\"icono\":\"fas fa-wifi\"},{\"item\":\"Cocina Privada\",\"icono\":\"fas fa-utensils\"},{\"item\":\"Bar Privado\",\"icono\":\"fas fa-cocktail\"},{\"item\":\"Piscina Privada\",\"icono\":\"fas fa-swimmer\"},{\"item\":\"Bañera\",\"icono\":\"fas fa-bath\"},{\"item\":\"Paseo en Barco\",\"icono\":\"fas fa-ship\"}]', 300000, 210000, 400000, 350000, '1', '2022-08-14 04:46:24'),
(6, 'habitacion-tipo-fullnoruega', '#04d416', 'Noruega', 'vistas/img/fullnoruega/portada.png', 'vistas/img/fullnoruega/portada-min.png', 'Habitación clásica de Noruega', '[{\"item\":\"TV de 42 Pulg\",\"icono\":\"fas fa-tv\"},{\"item\":\"Agua Caliente\",\"icono\":\"fas fa-tint\"},{\"item\":\"Baño privado\",\"icono\":\"fas fa-toilet\"},{\"item\":\"Sofá\",\"icono\":\"fas fa-couch\"},{\"item\":\"Servicio Wifi\",\"icono\":\"fas fa-wifi\"},{\"item\":\"Cocina Privada\",\"icono\":\"fas fa-utensils\"},{\"item\":\"Bar Privado\",\"icono\":\"fas fa-cocktail\"}]', 400000, 300000, 460000, 400000, '1', '2022-08-14 04:46:35'),
(8, 'habitacion-tipo-romance', '#f06e6e', 'Romance', 'vistas/img/romance/portada.jpg', 'vistas/img/romance/portada-min.jpg', 'Habitación Romántica', '[{\"item\":\"Cama 2 x 2\",\"icono\":\"fas fa-bed\"},{\"item\":\"TV de 42 Pulg\",\"icono\":\"fas fa-tv\"},{\"item\":\"Agua Caliente\",\"icono\":\"fas fa-tint\"},{\"item\":\"Jacuzzi\",\"icono\":\"fas fa-water\"},{\"item\":\"Baño privado\",\"icono\":\"fas fa-toilet\"},{\"item\":\"Sofá\",\"icono\":\"fas fa-couch\"},{\"item\":\"Servicio Wifi\",\"icono\":\"fas fa-wifi\"},{\"item\":\"Cocina Privada\",\"icono\":\"fas fa-utensils\"},{\"item\":\"Entretenimiento Digital\",\"icono\":\"fas fa-gamepad\"},{\"item\":\"Zona Ambiente\",\"icono\":\"fas fa-glass-cheers\"},{\"item\":\"Equipo de Computo\",\"icono\":\"fas fa-laptop\"},{\"item\":\"Tour Especial\",\"icono\":\"fas fa-tree\"},{\"item\":\"Chimenea\",\"icono\":\"fab fa-free-code-camp\"},{\"item\":\"Bañera\",\"icono\":\"fas fa-bath\"}]', 420000, 365000, 510000, 460000, '1', '2022-08-14 04:46:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id_h` int(11) NOT NULL,
  `tipo_h` int(11) NOT NULL,
  `estilo` text NOT NULL,
  `galeria` text NOT NULL,
  `video` text NOT NULL,
  `recorrido_virtual` text NOT NULL,
  `descripcion_h` text NOT NULL,
  `estado` text NOT NULL,
  `fecha_h` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_h`, `tipo_h`, `estilo`, `galeria`, `video`, `recorrido_virtual`, `descripcion_h`, `estado`, `fecha_h`) VALUES
(1, 1, 'Oriental', '[\"vistas/img/suite/oriental01.jpg\", \"vistas/img/suite/oriental02.jpg\", \"vistas/img/suite/oriental03.jpg\",\"vistas/img/suite/oriental04.jpg\"]', 'JTu790_yyRc', 'vistas/img/suite/oriental-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN SUITE DE ESTILO ORIENTAL.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2019-04-09 07:08:48'),
(2, 1, 'Moderna', '[\"vistas/img/suite/moderna01.jpg\", \"vistas/img/suite/moderna02.jpg\", \"vistas/img/suite/moderna03.jpg\",\"vistas/img/suite/moderna04.jpg\"]', 'JTu790_yyRc', 'vistas/img/suite/moderna-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN SUITE DE ESTILO MODERNA.</b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2019-04-09 07:08:52'),
(3, 1, 'Africana', '[\"vistas/img/suite/africana01.jpg\", \"vistas/img/suite/africana02.jpg\", \"vistas/img/suite/africana03.jpg\",\"vistas/img/suite/africana04.jpg\"]', 'JTu790_yyRc', 'vistas/img/suite/africana-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN SUITE DE ESTILO AFRICANA.</b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2019-04-09 07:08:56'),
(4, 1, 'Clásica', '[\"vistas/img/suite/clasica01.jpg\", \"vistas/img/suite/clasica02.jpg\", \"vistas/img/suite/clasica03.jpg\",\"vistas/img/suite/clasica04.jpg\"]', 'JTu790_yyRc', 'vistas/img/suite/clasica-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN SUITE DE ESTILO CLÁSICA.</b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2019-04-09 07:08:59'),
(5, 1, 'Retro', '[\"vistas/img/suite/retro442.jpg\",\"vistas/img/suite/retro432.jpg\",\"vistas/img/suite/retro317.jpg\",\"vistas/img/suite/retro02.jpg\"]', 'JTu790_yyRc', 'vistas/img/suite/retro-360.jpg', '<p><strong>HABITACIÓN SUITE RETRO ESPECIALIZADA.</strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.</p><h3>PLAN CONTINENTAL</h3><ul><li>(Precio x pareja 1 día 1 noche, incluye: desayuno) Temporada Baja: $300.000 COP Temporada Alta: $350.000 COP</li></ul><h3>PLAN AMERICANO</h3><ul><li>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo) Temporada Baja: $380.000 COP Temporada Alta: $420.000 COP</li></ul><p><br data-cke-filler=\"true\"></p>', '1', '2019-04-09 07:09:03'),
(6, 2, 'Oriental', '[\"vistas/img/especial/oriental01.jpg\", \"vistas/img/especial/oriental02.jpg\", \"vistas/img/especial/oriental03.jpg\",\"vistas/img/especial/oriental04.jpg\"]', 'JTu790_yyRc', 'vistas/img/especial/oriental-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN ESPECIAL DE ESTILO ORIENTAL.</b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2019-04-09 07:09:05'),
(7, 2, 'Moderna', '[\"vistas/img/especial/moderna01.jpg\", \"vistas/img/especial/moderna02.jpg\", \"vistas/img/especial/moderna03.jpg\",\"vistas/img/especial/moderna04.jpg\"]', 'JTu790_yyRc', 'vistas/img/especial/moderna-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN ESPECIAL DE ESTILO MODERNA.</b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2019-04-09 07:09:08'),
(8, 2, 'Africana', '[\"vistas/img/especial/africana01.jpg\", \"vistas/img/especial/africana02.jpg\", \"vistas/img/especial/africana03.jpg\",\"vistas/img/especial/africana04.jpg\"]', 'JTu790_yyRc', 'vistas/img/especial/africana-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN ESPECIAL DE ESTILO AFRICANA.</b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2019-04-09 07:09:11'),
(9, 2, 'Árabe', '[\"vistas/img/especial/arabe01.jpg\", \"vistas/img/especial/arabe02.jpg\", \"vistas/img/especial/arabe03.jpg\",\"vistas/img/especial/arabe04.jpg\"]', 'JTu790_yyRc', 'vistas/img/especial/arabe-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN ESPECIAL DE ESTILO ARABE.</b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2019-04-09 07:09:14'),
(10, 2, 'Romana', '[\"vistas/img/especial/romana01.jpg\", \"vistas/img/especial/romana02.jpg\", \"vistas/img/especial/romana03.jpg\",\"vistas/img/especial/romana04.jpg\"]', 'JTu790_yyRc', 'vistas/img/especial/romana-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN ESPECIAL DE ESTILO ROMANA.</b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2019-04-09 07:09:16'),
(11, 3, 'Caribeña', '[\"vistas/img/standar/caribena01.jpg\", \"vistas/img/standar/caribena02.jpg\", \"vistas/img/standar/caribena03.jpg\",\"vistas/img/standar/caribena04.jpg\"]', 'JTu790_yyRc', 'vistas/img/standar/caribena-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN STANDAR DE ESTILO CARIBEÑA.</b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2019-04-09 07:09:20'),
(12, 3, 'Colonial', '[\"vistas/img/standar/colonial01.jpg\", \"vistas/img/standar/colonial02.jpg\", \"vistas/img/standar/colonial03.jpg\",\"vistas/img/standar/colonial04.jpg\"]', 'JTu790_yyRc', 'vistas/img/standar/colonial-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN STANDAR DE ESTILO COLONIAL.</b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2019-04-09 07:09:26'),
(13, 3, 'Hindú', '[\"vistas/img/standar/hindu01.jpg\", \"vistas/img/standar/hindu02.jpg\", \"vistas/img/standar/hindu03.jpg\",\"vistas/img/standar/hindu04.jpg\"]', 'JTu790_yyRc', 'vistas/img/standar/hindu-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN STANDAR DE ESTILO HINDÚ.</b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2019-04-09 07:09:31'),
(14, 3, 'Marroquí', '[\"vistas/img/standar/marroqui01.jpg\", \"vistas/img/standar/marroqui02.jpg\", \"vistas/img/standar/marroqui03.jpg\",\"vistas/img/standar/marroqui04.jpg\"]', 'JTu790_yyRc', 'vistas/img/standar/marroqui-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN STANDAR DE ESTILO MARROQUÍ.</b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2019-04-09 07:09:34'),
(15, 3, 'Retro', '[\"vistas/img/standar/retro01.jpg\", \"vistas/img/standar/retro02.jpg\", \"vistas/img/standar/retro03.jpg\",\"vistas/img/standar/retro04.jpg\"]', 'JTu790_yyRc', 'vistas/img/standar/retro-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN STANDAR DE ESTILO RETRO.</b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2019-04-09 07:09:37'),
(16, 4, 'Africana', '[\"vistas/img/presidencial/africana01.jpg\", \"vistas/img/presidencial/africana02.jpg\", \"vistas/img/presidencial/africana03.jpg\",\"vistas/img/presidencial/africana04.jpg\"]', 'JTu790_yyRc', 'vistas/img/presidencial/africana-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN PRESIDENCIAL DE ESTILO AFRICANA.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 18:53:43'),
(17, 4, 'Campestre', '[\"vistas/img/presidencial/campestre01.jpg\", \"vistas/img/presidencial/campestre02.jpg\", \"vistas/img/presidencial/campestre03.jpg\",\"vistas/img/presidencial/campestre04.jpg\"]', 'JTu790_yyRc', 'vistas/img/presidencial/campestre-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN PRESIDENCIAL DE ESTILO CAMPESTRE.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 18:53:43'),
(18, 4, 'Moderna', '[\"vistas/img/presidencial/moderna01.jpg\", \"vistas/img/presidencial/moderna02.jpg\", \"vistas/img/presidencial/moderna03.jpg\",\"vistas/img/presidencial/moderna04.jpg\"]', 'JTu790_yyRc', 'vistas/img/presidencial/moderna-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN PRESIDENCIAL DE ESTILO MODERNO.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 18:53:43'),
(19, 4, 'Urbana', '[\"vistas/img/presidencial/urbana01.jpg\", \"vistas/img/presidencial/urbana02.jpg\", \"vistas/img/presidencial/urbana03.jpg\",\"vistas/img/presidencial/urbana04.jpg\"]', 'JTu790_yyRc', 'vistas/img/presidencial/urbana-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN PRESIDENCIAL DE ESTILO URBANA.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 18:53:43'),
(20, 4, 'Venecia', '[\"vistas/img/presidencial/venecia01.jpg\", \"vistas/img/presidencial/venecia02.jpg\", \"vistas/img/presidencial/venecia03.jpg\",\"vistas/img/presidencial/venecia04.jpg\"]', 'JTu790_yyRc', 'vistas/img/presidencial/venecia-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN PRESIDENCIAL DE ESTILO VENECIA.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 18:53:43'),
(21, 5, 'Hindú', '[\"vistas/img/penthouse/hindu01.jpg\", \"vistas/img/penthouse/hindu02.jpg\", \"vistas/img/penthouse/hindu03.jpg\",\"vistas/img/penthouse/hindu04.jpg\"]', 'JTu790_yyRc', 'vistas/img/penthouse/hindu-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN PENTHOUSE DE ESTILO HINDÚ.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 20:39:05'),
(22, 5, 'Moderna', '[\"vistas/img/penthouse/moderna01.jpg\", \"vistas/img/penthouse/moderna02.jpg\", \"vistas/img/penthouse/moderna03.jpg\",\"vistas/img/penthouse/moderna04.jpg\"]', 'JTu790_yyRc', 'vistas/img/penthouse/moderna-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN PENTHOUSE DE ESTILO MODERNO.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 20:39:05'),
(23, 5, 'Retro', '[\"vistas/img/penthouse/retro01.jpg\", \"vistas/img/penthouse/retro02.jpg\", \"vistas/img/penthouse/retro03.jpg\",\"vistas/img/penthouse/retro04.jpg\"]', 'JTu790_yyRc', 'vistas/img/penthouse/retro-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN PENTHOUSE DE ESTILO RETRO.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 20:39:05'),
(24, 5, 'Romana', '[\"vistas/img/penthouse/romana01.jpg\", \"vistas/img/penthouse/romana02.jpg\", \"vistas/img/penthouse/romana03.jpg\",\"vistas/img/penthouse/romana04.jpg\"]', 'JTu790_yyRc', 'vistas/img/penthouse/romana-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN PENTHOUSE DE ESTILO ROMANA.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 20:39:05'),
(25, 5, 'Vintage', '[\"vistas/img/penthouse/vintage01.jpg\", \"vistas/img/penthouse/vintage02.jpg\", \"vistas/img/penthouse/vintage03.jpg\",\"vistas/img/penthouse/vintage04.jpg\"]', 'JTu790_yyRc', 'vistas/img/penthouse/romana-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN PENTHOUSE DE ESTILO VINTAGE.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 20:39:05'),
(26, 6, 'Campestre', '[\"vistas/img/fullnoruega/campestre01.jpg\", \"vistas/img/fullnoruega/campestre02.jpg\", \"vistas/img/fullnoruega/campestre03.jpg\",\"vistas/img/fullnoruega/campestre04.jpg\"]', 'JTu790_yyRc', 'vistas/img/fullnoruega/campestre-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN FULL NORUEGA DE ESTILO CAMPESTRE.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 22:01:28'),
(27, 6, 'Caribeña', '[\"vistas/img/fullnoruega/caribeña01.jpg\", \"vistas/img/fullnoruega/caribeña02.jpg\", \"vistas/img/fullnoruega/caribeña03.jpg\",\"vistas/img/fullnoruega/caribeña04.jpg\"]', 'JTu790_yyRc', 'vistas/img/fullnoruega/caribeña-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN FULL NORUEGA DE ESTILO CARIBEÑA.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 22:01:28'),
(28, 6, 'Marroquí', '[\"vistas/img/fullnoruega/marroqui01.jpg\", \"vistas/img/fullnoruega/marroqui02.jpg\", \"vistas/img/fullnoruega/marroqui03.jpg\",\"vistas/img/fullnoruega/marroqui04.jpg\"]', 'JTu790_yyRc', 'vistas/img/fullnoruega/marroqui-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN FULL NORUEGA DE ESTILO MARROQUIN.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 22:01:28'),
(29, 6, 'Moderna', '[\"vistas/img/fullnoruega/moderna01.jpg\", \"vistas/img/fullnoruega/moderna02.jpg\", \"vistas/img/fullnoruega/moderna03.jpg\",\"vistas/img/fullnoruega/moderna04.jpg\"]', 'JTu790_yyRc', 'vistas/img/fullnoruega/moderna-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN FULL NORUEGA DE ESTILO MODERNA.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 22:01:28'),
(30, 6, 'Oriental', '[\"vistas/img/fullnoruega/oriental01.jpg\", \"vistas/img/fullnoruega/oriental02.jpg\", \"vistas/img/fullnoruega/oriental03.jpg\",\"vistas/img/fullnoruega/oriental04.jpg\"]', 'JTu790_yyRc', 'vistas/img/fullnoruega/oriental-360.jpg', '<p><b>ESTA ES LA DESCRIPCIÓN FALSA DE LA HABITACIÓN FULL NORUEGA DE ESTILO ORIENTAL.</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.					</p>					<br>					<h3>PLAN CONTINENTAL</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>					Temporada Baja: $300.000 COP<br>					Temporada Alta: $350.000 COP</p>						<br>					<h3>PLAN AMERICANO</h3>					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>					Temporada Baja: $380.000 COP<br>					Temporada Alta: $420.000 COP</p>										<br>					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '1', '2020-02-12 22:01:28');
INSERT INTO `habitaciones` (`id_h`, `tipo_h`, `estilo`, `galeria`, `video`, `recorrido_virtual`, `descripcion_h`, `estado`, `fecha_h`) VALUES
(31, 8, 'Elegancia', '[\"vistas/img/romance/elegancia1.jpg\",\"vistas/img/romance/elegancia2.jpg\",\"vistas/img/romance/elegancia3.jpg\",\"vistas/img/romance/elegancia4.jpg\"]', 'wEk5b1ZQNfA', 'vistas/img/romance/elegancia-360.jpg', '<p>Habitación de la categoría de Romance, habitación Elegancia.</p><h4>Plan Continental</h4><ul><li>Alimentación básica para todos los asistentes (desayuno, almuerzo y cena)</li><li>Servicios de atención al cuarto y micro compra</li></ul><h4>Plan Americano</h4><ul><li>Lujos incluidos.</li><li>Alimentación de lujo para todos los asistentes (desayuno, media mañana, almuerzo, algo y cena ademas de merienda)</li><li>Servicios de transporte.</li><li>Servicio al cuarto.</li></ul>', '1', '2020-03-01 04:48:57'),
(35, 8, 'Monokai', '[\"vistas/img/romance/monokai1.jpg\",\"vistas/img/romance/monokai2.jpg\",\"vistas/img/romance/monokai3.jpg\",\"vistas/img/romance/monokai4.jpg\"]', 'lU6US3eKPJo', 'vistas/img/romance/monokai-360.jpg', '<p>Habitación <i><strong>MONOKAI </strong></i>para la<strong> Categoría Romance.</strong></p><p>Esta habitación cuenta cuenta con lujos de categoría media mas y bien la comodidad y la eficiencia del servicio hacen de esta habitación una experiencia inolvidable. Esta habitación posee un estilo suave para todos los gustos del consumidor.</p><h4><strong>Plan Continental.</strong></h4><ul><li>Servicio de atención de aperitivos.</li><li>Vino Chardonay de 20 años añejo.</li><li>Servicio alimentario básico.</li><li>No tenemos mas, somos pobreza.</li></ul><h4><strong>Plan Americana&nbsp;</strong></h4><ul><li>Servicio de alta gama en alimentación.</li><li>Cócteles de servicio.</li><li>Alimentación fuera del hotel.</li><li>Transporte.</li><li>Servicio de atención al cuarto.</li></ul>', '1', '2020-03-01 22:44:12'),
(36, 8, 'Moderna', '[\"vistas/img/romance/moderna1.jpg\",\"vistas/img/romance/moderna2.jpg\",\"vistas/img/romance/moderna4.jpg\",\"vistas/img/romance/moderna5.jpg\"]', 'bon17FIrI_E', 'vistas/img/romance/moderna-360.jpg', '<p><strong>HABITACIÓN ROMANCE ESTILO MODERNA.</strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.</p><h3>PLAN CONTINENTAL</h3><ul><li>Almuerzo - Cena.</li><li>Tour especializado.</li></ul><h3>PLAN AMERICANO</h3><ul><li>Desayuno - Almuerzo - Cena.</li><li>Aperitivos entre comida.</li><li>Servicio al cuarto.</li></ul><p><br data-cke-filler=\"true\"></p>', '1', '2020-03-01 22:53:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id` int(11) NOT NULL,
  `tipo` text NOT NULL,
  `img` text NOT NULL,
  `descripcion` text NOT NULL,
  `precio_alta` float NOT NULL,
  `precio_baja` float NOT NULL,
  `estado` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `tipo`, `img`, `descripcion`, `precio_alta`, `precio_baja`, `estado`, `fecha`) VALUES
(1, 'Romántico', 'vistas/img/planes/plan-romantico1.png', 'Plan con todas las comodidades incluidas para la pareja de enamorados; incluye comodidad de habitación así como servicio al cuarto, duchas especiales y camas de múltiples estilos, incluye transporte, tour y paisajes íntimos de comodidad además de sala Jacuzzi con vistas en el cuarto.', 130000, 85000, '1', '2022-01-12 19:03:13'),
(2, 'Luna de Miel', 'vistas/img/planes/plan-luna-de-miel1.png', 'Plan exclusivo para los recién casados, incluye las cómodas camas ExpressSouck además de las comodidades del plan romántico; se incluye además servicios de tour y aventura además de servicio al cuarto y utensilios convenientes para el tema.', 260000, 200000, '1', '2022-01-12 19:03:16'),
(3, 'Aventura', 'vistas/img/planes/259.png', '<p>El plan perfecto para aquellos aventureros que vienen a disfrutar de las maravillas de Noruega, se incluye canope además de rutas de escalada, senderos de montaña y tour globalizado por toda la zona; se incluye habitaciones de cómodas camas de relajación y un servicio al cuarto de spa; el paracaidismo se encuentra incluido.</p>', 115000, 70000, '1', '2022-01-12 19:03:17'),
(4, 'Spa', 'vistas/img/planes/plan-spa1.png', 'Además de disfrutar de las maravillas de Noruega, somos especialistas en dar un descanso y maso terapia dignos de ser recordados, usando piedras volcánicas y los mejores utensilios de trabajo, se incluye tour por las ciudades además de un micro express en tren por las montañas.', 170000, 130000, '1', '2022-01-12 19:03:18'),
(5, 'Vacacional', 'vistas/img/planes/plan-vacaciones1.png', 'Un plan perfecto para la familia, contando con todos los servicios turísticos de nuestro hotel además de experiencias de canope y recorrido en barcas por los lagos mas preciosos Noruegos y servicios de spa, relajación, Jacuzzi y piscinas adaptadas para los climas; se incluyen camas estándares y de tipo unifamiliar.', 195000, 170000, '1', '2022-01-12 19:03:19'),
(6, 'Turismo', 'vistas/img/planes/304.jpg', '<p>El plan ideal para aquellos que desean ampliar su conocimiento del mundo en estas maravillosas tierras; se incluye turismo por todos los paisajes característicos de Noruega y una amplia gama de atracciones, así como servicios de spa y carrusel con todas las comodidades del hotel, un plan bastante completo. holii 2</p>', 220000, 195000, '1', '2022-01-12 19:03:20'),
(7, 'Crucero', 'vistas/img/planes/plan-crucero1.png', 'El super plan para aquellos que desean pasar en suite especiales que se encuentren en movimiento, el crucero Merily Tomso cuenta con todos los lujos además de in centro de entretenimiento y Jacuzzi para todos los gustos, cuenta con habitaciones pequeñas aunque cómodas y el servicio de restaurante-bar incorporado.', 310000, 275000, '1', '2022-01-12 19:03:21'),
(9, 'Paseo sobre Nieve', 'vistas/img/planes/139.jpg', '<p>Paseo sobre nieve!, una experiencia fenomenal para aquellos que aman las aventuras sobre hielo; se incluye instructor si eres apenas un novato en este aspecto.</p>', 400000, 380000, '0', '2022-01-12 20:15:49'),
(10, 'Sobre el Cielo', 'vistas/img/planes/655.jpg', '<p>Plan maravillosa para estar sobre las nubes!, este maravilloso plan te invita a navegar por los paisajes mas preciosos de Noruega a bordo de un hermoso Globo Aerostático.</p>', 10000000, 5000000, '1', '2022-01-12 19:03:23'),
(11, 'Fiesta', 'vistas/img/planes/431.jpg', '<p>Plan de fiesta con tus amigos, incluye paseo por la ciudad los días de rumba así como la zona de discoteca del hotel exclusiva para aquellos que gozan de un gran ambiente musical y de licor. Promociones de bombones y barra libre para todos los gustos.</p>', 300000, 210000, '1', '2022-01-12 20:40:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platillos`
--

CREATE TABLE `platillos` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `descripcion` text NOT NULL,
  `estado` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `platillos`
--

INSERT INTO `platillos` (`id`, `img`, `descripcion`, `estado`, `fecha`) VALUES
(1, 'vistas/img/platillos/plato01.png', 'Mollejas de Cerdo Gratinadas.', '1', '2022-01-14 03:55:05'),
(4, 'vistas/img/platillos/plato04.png', 'Tacos Rellenos Especiales', '1', '2022-01-14 03:55:06'),
(6, 'vistas/img/platillos/plato06.png', 'Flang Cremoso', '1', '2022-01-14 03:55:07'),
(7, 'vistas/img/platillos/plato07.png', 'Picada de Carne Platinada', '1', '2022-01-14 03:55:07'),
(8, 'vistas/img/platillos/329.jpg', 'Nuggets Maritimos  Pinzados', '1', '2022-01-14 03:55:08'),
(9, 'vistas/img/platillos/949.jpg', 'Nachos Especiales de Queso', '1', '2022-01-14 03:55:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorrido`
--

CREATE TABLE `recorrido` (
  `id` int(11) NOT NULL,
  `foto_peq` text NOT NULL,
  `foto_grande` text NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text NOT NULL,
  `estado` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recorrido`
--

INSERT INTO `recorrido` (`id`, `foto_peq`, `foto_grande`, `titulo`, `descripcion`, `estado`, `fecha`) VALUES
(1, 'vistas/img/recorrido/152.jpg', 'vistas/img/recorrido/176.jpg', 'Paseo en Globo', 'Paseo en globo aerostático supervisado por profesionales, un paseo espectacular como si estuviéramos en la mismísima capadocia. Una experiencia a lo estilo 3 metros sobre el cielo.', '1', '2022-01-13 04:22:28'),
(2, 'vistas/img/recorrido/327.jpg', 'vistas/img/recorrido/334.jpg', 'Buceo', 'Explorando las maravillas que esconde el terreno submarino costero del hotel, una experiencia de buceo increíble por el área marítima que no debes dejar pasar.', '1', '2022-01-13 04:23:36'),
(3, 'vistas/img/recorrido/949.jpg', 'vistas/img/recorrido/254.jpg', 'Pesca', 'Para los amantes de la pesca tenemos esta experiencia maravillosa! disfruta de nuestros diferentes lagos y variedad de peces que pueden ofrecerte un desafío digno de paciencia y dedicación!.', '1', '2022-01-13 04:24:49'),
(4, 'vistas/img/recorrido/265.jpg', 'vistas/img/recorrido/391.jpg', 'Fiestas en Playa', 'Una \"bailadita\" para aquellos amantes a la música y el baile, una fiesta tipo Tomorrowland en la playa del hotel, música de todo tipo acompañada de un acompañamiento agradable y bebidas perfectas para el clima.', '1', '2022-01-13 04:35:31'),
(6, 'vistas/img/recorrido/284.jpg', 'vistas/img/recorrido/399.jpg', 'Paseo en Bote', 'Para aquellos que les gusta un recorrido relax, tenemos nuestro paseo en lancha por toda la zona costera, un paseo acompañado de música, buen ambiente e historia.', '1', '2022-01-13 04:37:01'),
(8, 'vistas/img/recorrido/648.jpg', 'vistas/img/recorrido/754.jpg', 'Pradera Ensueño', 'Recorrido precioso para los enamorados que gustan de un paseo en el clima de invierno, la ciudad acogedora recibe en brazos abiertos a los invitados en sus cálidos recintos. ', '0', '2022-01-13 04:27:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `pago_reserva` float NOT NULL,
  `numero_transaccion` text NOT NULL,
  `orden_transaccion` text NOT NULL,
  `medio_transaccion` text NOT NULL,
  `codigo_reserva` text NOT NULL,
  `pasarela_pago` text NOT NULL,
  `descripcion_reserva` text NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `fecha_reserva` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado_pago` text NOT NULL,
  `dias` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_habitacion`, `id_usuario`, `pago_reserva`, `numero_transaccion`, `orden_transaccion`, `medio_transaccion`, `codigo_reserva`, `pasarela_pago`, `descripcion_reserva`, `fecha_ingreso`, `fecha_salida`, `fecha_reserva`, `estado_pago`, `dias`) VALUES
(4, 19, 19, 5900000, '1246972438', '4384916218', 'credit_card', 'RES-6PMNW372S8Y', 'Mercado Pago', 'Habitación Presidencial Urbana - Luna de Miel - 2 personas. La cantidad de días dispuestos para su reserva es de 6 contados desde la fecha de inicio de la reserva y entrada.', '2022-03-25', '2022-03-31', '2022-05-02 00:54:52', '1', '6'),
(5, 20, 19, 14852000, '1247120412', '4418634097', 'credit_card', 'RES-WZT44WABK4Q', 'Mercado Pago', 'Habitación Presidencial Venecia - Vacacional - 4 personas. La cantidad de días dispuestos para su reserva es de 9 contados desde la fecha de inicio de la reserva y entrada.', '2022-04-01', '2022-04-10', '2022-05-02 00:54:55', '1', '9'),
(6, 23, 19, 10464000, '4TH39621V8555921M', 'COMPLETED', 'API PayPal', 'RES-AM8XHW700T4', 'PayPal', 'Habitación PentHouse Retro - Spa - 3 personas. La cantidad de días dispuestos para su reserva es de 8 contados desde la fecha de inicio de la reserva y entrada.', '2022-05-07', '2022-05-15', '2022-05-02 00:54:57', '1', '8'),
(7, 26, 19, 16530000, '03L00715GN785405V', 'COMPLETED', 'API PayPal', 'RES-UG5TEQVQK35', 'PayPal', 'Habitación Noruega Campestre - Vacacional - 5 personas. La cantidad de días dispuestos para su reserva es de 7 contados desde la fecha de inicio de la reserva y entrada.', '2022-04-08', '2022-04-15', '2022-05-02 00:55:01', '1', '7'),
(8, 18, 19, 10791000, '1247203810', '4438714586', 'credit_card', 'RES-OWBN4CRBJW5', 'Mercado Pago', 'Habitación Presidencial Moderna - Turismo - 3 personas. La cantidad de días dispuestos para su reserva es de 8 contados desde la fecha de inicio de la reserva y entrada.', '2022-05-07', '2022-05-15', '2022-05-02 00:55:04', '1', '8'),
(10, 23, 19, 9460000, '8239935547608556149460000', '1403595826', 'VISA - CREDIT_CARD', 'RES-R6ZYA69XZ7E', 'PayU', 'Habitación PentHouse Retro - Luna de Miel - 2 personas. La cantidad de días dispuestos para su reserva es de 9 contados desde la fecha de inicio de la reserva y entrada.', '2022-05-20', '2022-05-29', '2022-05-02 00:55:07', '1', '9'),
(11, 13, 19, 5940000, '7868584620601204065940000', '1403598646', 'MASTERCARD - CREDIT_CARD', 'RES-1UI3Y6IE1MJ', 'PayU', 'Habitación Standar Hindú - Vacacional - 4 personas. La cantidad de días dispuestos para su reserva es de 5 contados desde la fecha de inicio de la reserva y entrada.', '2022-04-14', '2022-04-19', '2022-05-02 00:55:09', '1', '5'),
(13, 13, 19, 8184000, '40G2051483318741X', 'COMPLETED', 'API PayPal', 'RES-O70EYZENABU', 'PayPal', 'Habitación Standar Hindú - Vacacional - 4 personas. La cantidad de días dispuestos para su reserva es de 7 contados desde la fecha de inicio de la reserva y entrada.', '2022-04-24', '2022-05-01', '2022-05-02 00:55:12', '1', '7'),
(14, 4, 19, 10416000, '0FP682465K641854E', 'COMPLETED', 'API PayPal', 'RES-AG37B6N4KXA', 'PayPal', 'Habitación Suite Clásica - Vacacional - 4 personas. La cantidad de días dispuestos para su reserva es de 7 contados desde la fecha de inicio de la reserva y entrada.', '2022-05-07', '2022-05-14', '2022-05-02 00:55:15', '1', '7'),
(17, 28, 24, 10058000, '1247871521', '4657277799', 'credit_card', 'RES-7ETZGN915S1', 'Mercado Pago', 'Habitación Noruega Marroquí - Aventura - 4 personas. La cantidad de días dispuestos para su reserva es de 6 contados desde la fecha de inicio de la reserva y entrada.', '2022-05-12', '2022-05-18', '2022-05-02 02:57:49', '1', '6'),
(18, 35, 19, 9374000, '1248288152', '4846680005', 'credit_card', 'RES-9NPM9O75K4N', 'Mercado Pago', 'Habitación Romance Monokai - Romántico - 2 personas. La cantidad de días dispuestos para su reserva es de 9 contados desde la fecha de inicio de la reserva y entrada.', '2022-08-05', '2022-08-14', '2022-05-28 19:23:25', '1', '9'),
(19, 26, 29, 6042000, '25761675TL674120R', 'COMPLETED', 'API PayPal', 'RES-34CHOUVRVCA', 'PayPal', 'Habitación Noruega Campestre - Spa - 3 personas. La cantidad de días dispuestos para su reserva es de 4 contados desde la fecha de inicio de la reserva y entrada.', '2022-08-12', '2022-08-16', '2022-08-05 00:38:56', '1', '4'),
(20, 26, 19, 8460000, '7GS70121CM6389228', 'COMPLETED', 'API PayPal', 'RES-FYMWONYFE7I', 'PayPal', 'Habitación Noruega Campestre - Aventura - 4 personas. La cantidad de días dispuestos para su reserva es de 5 contados desde la fecha de inicio de la reserva y entrada.', '2022-08-23', '2022-08-28', '2022-08-16 03:05:01', '1', '5'),
(21, 26, 30, 18012000, '1306572988', '5400723079', 'credit_card', 'RES-YGF9I5DWBGF', 'Mercado Pago', 'Habitación Noruega Campestre - Vacacional - 4 personas. La cantidad de días dispuestos para su reserva es de 9 contados desde la fecha de inicio de la reserva y entrada.', '2022-09-09', '2022-09-18', '2022-08-05 02:38:18', '1', '9'),
(22, 23, 19, 7482000, '0T8355756V120625C', 'COMPLETED', 'API PayPal', 'RES-99J1YOD0A1W', 'PayPal', 'Habitación PentHouse Retro - Romántico - 2 personas. La cantidad de días dispuestos para su reserva es de 9 contados desde la fecha de inicio de la reserva y entrada.', '2022-10-06', '2022-10-15', '2022-08-16 03:05:06', '1', '9'),
(23, 26, 19, 19950000, '6W149403J0742450F', 'COMPLETED', 'API PayPal', 'RES-UJZS4EGVSPG', 'PayPal', 'Habitación Noruega Campestre - Vacacional - 4 personas. La cantidad de días dispuestos para su reserva es de 10 contados desde la fecha de inicio de la reserva y entrada.', '2022-10-05', '2022-10-15', '2022-08-09 05:28:09', '1', '10'),
(24, 23, 20, 7482000, '6UV32047DT1995502', 'COMPLETED', 'API PayPal', 'RES-ZRR30AMZP61', 'PayPal', 'Habitación PentHouse Retro - Romántico - 2 personas. La cantidad de días dispuestos para su reserva es de 9 contados desde la fecha de inicio de la reserva y entrada.', '2022-09-01', '2022-09-10', '2022-08-20 07:38:45', '1', '9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonios`
--

CREATE TABLE `testimonios` (
  `id_testimonio` int(11) NOT NULL,
  `id_reserva_t` int(11) NOT NULL,
  `id_usuario_t` int(11) NOT NULL,
  `id_habitacion_t` int(11) NOT NULL,
  `testimonio` text NOT NULL,
  `aprobado` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `testimonios`
--

INSERT INTO `testimonios` (`id_testimonio`, `id_reserva_t`, `id_usuario_t`, `id_habitacion_t`, `testimonio`, `aprobado`, `fecha`) VALUES
(1, 22, 30, 23, 'Estoy actualizando la testimonial a ver que sale, versión 2 del elemento', 1, '2022-08-20 07:28:32'),
(2, 21, 30, 26, 'Una experiencia inolvidable, excelente habitación, excelente servicio, todo muy aseado y dispuesto para quedar con ganas de volver', 1, '2022-08-06 02:57:29'),
(3, 20, 5, 26, 'Han sido las mejores vacaciones de mi vida, no se escatima en detalles preciosos y la atención ha sido de ensueño, muy pero muy recomendado', 1, '2022-08-06 02:57:29'),
(6, 19, 29, 26, 'La habitación es espaciosa y perfecta para toda la familia, me ha gustado mucho la atención recibida y lo aseado del lugar, los detalles de los planes se cumplen con excesos incluso, muchas gracias! volveré!', 1, '2022-08-06 03:01:28'),
(7, 7, 19, 26, 'Ha sido de ensueño estar en este lugar con mi pareja, muchas gracias por la atención y el buen servicio, volveremos muy pronto es seguro!', 1, '2022-08-06 03:01:28'),
(8, 18, 19, 35, 'Una experiencia genial, ha sido fascinante lo que he vivido con mi pareja, muy buen servicio', 1, '2022-08-09 05:15:00'),
(9, 17, 24, 28, 'Una experiencia extranjera, es sin duda un lujo sentir la cultura oriental en una habitación de occidente, muy bien atendidos.', 1, '2022-08-09 05:15:00'),
(10, 14, 19, 4, 'Esta fue una testimonial clasica, no hay mucho que afirmar, sencillamente simple pero agradable', 1, '2022-08-09 05:17:26'),
(11, 13, 19, 13, 'Una nota a lo mas bien, que buen servicio y que habitación tan acogedora', 0, '2022-08-09 05:17:26'),
(12, 11, 19, 13, 'No hay mucho que decir pero tenemos el registro jajaja', 0, '2022-08-09 05:19:11'),
(13, 10, 19, 23, 'Habitación con los estilos deseados para algo mas retro a mi gusto, lo he disfrutado mucho con mi familia', 1, '2022-08-09 05:19:11'),
(14, 8, 19, 18, 'Moderno, elegante, con todo lo que necesito para que no me olvide del excelente servicio, muchas gracias', 1, '2022-08-09 05:21:19'),
(15, 6, 19, 23, 'Habitación retro espectacular sin duda, que gran servicio y atencion por parte del hotel', 1, '2022-08-09 05:21:19'),
(16, 5, 19, 20, 'Me encanta la experiencia italiana, me recuerda a mis viajes por Italia, he quedado maravillado con la habitación y la atención', 1, '2022-08-09 05:23:09'),
(17, 4, 19, 19, 'Estilo elegante, adecuado, me encanta sin duda', 1, '2022-08-09 05:23:09'),
(18, 23, 19, 26, 'Me ha encantado la experiencia que he vivido, me ha gustado la atención y cada detalle de amor y respeto que le colocan a las cosas, sencillamente, FENOMENAL.', 1, '2022-08-20 06:24:46'),
(19, 24, 20, 23, 'He esperado mucho por esta maravillosa experiencia con mi pareja, realmente es maravilloso el lugar, la habitación, el servicio, ha sino fenomenal! gracias', 1, '2022-08-20 07:56:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_u` int(11) NOT NULL,
  `numero_documento` text NOT NULL,
  `nombre` text NOT NULL,
  `email` text NOT NULL,
  `celular` text NOT NULL,
  `password` text NOT NULL,
  `foto` text NOT NULL,
  `modo` text NOT NULL,
  `verificacion` int(11) NOT NULL,
  `email_encriptado` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_u`, `numero_documento`, `nombre`, `email`, `celular`, `password`, `foto`, `modo`, `verificacion`, `email_encriptado`, `fecha`) VALUES
(5, '68542301', 'Luz Nelly Toro Sanchez', 'luznellytoro123@gmail.com', '3105301566', '$2a$07$asxx54ahjppf45sd87a5auUhB721lzgIImunAkOaxo68cBpoYDr4u', 'vistas/img/usuarios/5/1314.jpg', 'directo', 1, '6f5e6c62043d4c2606a375256155f8bf', '2022-08-05 00:44:25'),
(6, '60123012', 'Heriberto Toro Naranjo', 'heribertonarantjo@live.com', '3102365400', '$2a$07$asxx54ahjppf45sd87a5aua6XL0NCpRWd7dysMA080N1iGsX1Gx5i', '', 'directo', 0, 'b3548f19bc0b1f4de30fdf66e56f9fe4', '2022-04-06 04:12:50'),
(8, '45863012', 'Helena Maria Davilo', 'helenadavilo321@hotmail.com', '3156320899', '$2a$07$asxx54ahjppf45sd87a5auVDIFTXOITke7ua78/qplSWKTpRq5P7u', '', 'directo', 1, 'b5553287a940b698b85e85933a2a8dde', '2022-04-09 05:48:16'),
(10, '61852002', 'Maria Paulina Nuñez Taborda', 'mariapaulina999@gmail.com', '3156970344', '$2a$07$asxx54ahjppf45sd87a5auJnyEWu2I/LGrsdLfMawEZGMwUWnuJ6a', '', 'directo', 1, '44bb753ae884d702c23e6c5f3a7dd3ac', '2022-04-09 05:29:34'),
(17, '1212121212', 'aaaaaaaaaaaa', 'luznellytoro123@gmail.com', '3123123111', '$2a$07$asxx54ahjppf45sd87a5auwnm8Ge8XfxTGkTRPAGhzMKh/9TujBbi', '', 'directo', 0, '6f5e6c62043d4c2606a375256155f8bf', '2022-04-06 04:41:11'),
(18, '69032223', 'Luz Nelly Toro Sanchez', 'luznellytoro123@gmail.com', '3124121111', '$2a$07$asxx54ahjppf45sd87a5auoIO4f04vcwU5tufbLqFzu3NG9nq/DtW', '', 'directo', 1, '6f5e6c62043d4c2606a375256155f8bf', '2022-08-05 00:43:20'),
(19, '1216717948', 'Juan Sebastian Medina Toro', 'sebastianmedina@gmail.com', '3102356630', '$2a$07$asxx54ahjppf45sd87a5auxzNM.rH23RQRe64u3C5YAmYeOllKxfW', 'vistas/img/usuarios/19/1070.jpg', 'directo', 1, '038a96f3639529b4452ae7b9b352d7d3', '2022-05-29 21:12:06'),
(20, '89420333', 'Melina Mendoza Zarro', 'melinamendozaz1@outlock.com', '3120104452', '$2a$07$asxx54ahjppf45sd87a5auT4WZH36522Mx4xBej24gxqwhhLIovYO', 'vistas/img/usuarios/20/1281.jpg', 'directo', 1, '9e6a09e1a4437d8694dad2881d8469fd', '2022-08-20 07:31:54'),
(22, 'null', 'Juan Sebastian Medina Toro', 'jsebastian19952011@gmail.com', 'null', 'null', 'https://lh3.googleusercontent.com/a-/AOh14GgA8BHhBShG3Ek-ahh_MSgpU9lrj7Obr_cApo7L9i8=s96-c', 'google', 1, 'null', '2022-04-18 02:03:40'),
(23, 'null', 'Fabio de Jesus Medina Henao', 'fabiomedinahenao@gmail.com', 'null', 'null', 'https://lh3.googleusercontent.com/a-/AOh14Gj_8sQSSzfDe8Nu-bc9-pWU9lxgqx6sppfyUwib=s96-c', 'google', 1, 'null', '2022-04-18 02:27:24'),
(24, '23541003', 'Jesucrito', 'misenorjesus@gmail.com', '3102654100', '$2a$07$asxx54ahjppf45sd87a5auwfiwafDOnQL4qIHucfFNVGXBONzt/Ge', '', 'directo', 1, '5f755644af6ec358a56aa160af7c0672', '2022-04-25 03:39:20'),
(25, '1904332891', 'Gabriel Ordoñez Casablanca', 'gabriuelcorreo@gmail.com', '3128910321', '$2a$07$asxx54ahjppf45sd87a5auCg6PwzW9yHEW2xM9Up/SmRhwfMiZ7LS', '', 'directo', 0, '8d461c828c4a16dd410a49fb505dbb83', '2022-05-29 20:54:47'),
(27, '48965091', 'Muriel Antonio Angostino', 'murielantonio123gostino@gmail.com', '3120912110', '$2a$07$asxx54ahjppf45sd87a5auvMu/D7pthgOm3WVAynQOCFRytWr0Mie', '', 'directo', 0, '4681ce7b4fefe229b597ee32a51a0a77', '2022-05-29 21:30:56'),
(29, '89650112', 'Clara Inés Díaz Maldonado', 'clarafiaz556@hotmail.com', '3126780900', '$2a$07$asxx54ahjppf45sd87a5auKv2ewYVxhp8dGGPBHOXiqIrcs8qVDPO', 'vistas/img/usuarios/29/902.jpg', 'directo', 1, 'ecb9e80c77f3fb6f4dbb480e5bebae84', '2022-05-29 23:43:28'),
(30, '1894330221', 'Amalia Medina Restrepo', 'amaliamed-2@gmail.com', '3120433321', '$2a$07$asxx54ahjppf45sd87a5auKN1DJwVAscGpFR8x8BYAYU/Wdmq800e', 'vistas/img/usuarios/30/1261.jpg', 'directo', 1, '5c2ba4922f4562b118003932a6aa2ef4', '2022-08-05 02:34:02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carta`
--
ALTER TABLE `carta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id_h`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `platillos`
--
ALTER TABLE `platillos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recorrido`
--
ALTER TABLE `recorrido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`);

--
-- Indices de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  ADD PRIMARY KEY (`id_testimonio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_u`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `carta`
--
ALTER TABLE `carta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id_h` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `platillos`
--
ALTER TABLE `platillos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `recorrido`
--
ALTER TABLE `recorrido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  MODIFY `id_testimonio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
