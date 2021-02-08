-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2017 a las 16:46:50
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fuxion_logistic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` text NOT NULL,
  `ubicacion` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodegas`
--

CREATE TABLE `bodegas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `prefijo_facturacion` varchar(20) NOT NULL,
  `alias` varchar(150) NOT NULL,
  `ubicacion_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bodegas`
--

INSERT INTO `bodegas` (`id`, `nombre`, `prefijo_facturacion`, `alias`, `ubicacion_id`, `created_at`, `updated_at`) VALUES
(1, 'Bogota Fuxion', 'Bog01', 'S0021 - BOGOTA', 1, '2017-10-24 23:19:20', '2017-10-24 23:19:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `departamento_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `nombre`, `departamento_id`) VALUES
(1, 'EL ENCANTO', 1),
(2, 'LA CHORRERA', 1),
(3, 'LA PEDRERA', 1),
(4, 'LA VICTORIA', 1),
(5, 'LETICIA', 1),
(6, 'MIRITI', 1),
(7, 'PUERTO ALEGRIA', 1),
(8, 'PUERTO ARICA', 1),
(9, 'PUERTO NARIÑO', 1),
(10, 'PUERTO SANTANDER', 1),
(11, 'TURAPACA', 1),
(12, 'ABEJORRAL', 2),
(13, 'ABRIAQUI', 2),
(14, 'ALEJANDRIA', 2),
(15, 'AMAGA', 2),
(16, 'AMALFI', 2),
(17, 'ANDES', 2),
(18, 'ANGELOPOLIS', 2),
(19, 'ANGOSTURA', 2),
(20, 'ANORI', 2),
(21, 'ANTIOQUIA', 2),
(22, 'ANZA', 2),
(23, 'APARTADO', 2),
(24, 'ARBOLETES', 2),
(25, 'ARGELIA', 2),
(26, 'ARMENIA', 2),
(27, 'BARBOSA', 2),
(28, 'BELLO', 2),
(29, 'BELMIRA', 2),
(30, 'BETANIA', 2),
(31, 'BETULIA', 2),
(32, 'BOLIVAR', 2),
(33, 'BRICEÑO', 2),
(34, 'BURITICA', 2),
(35, 'CACERES', 2),
(36, 'CAICEDO', 2),
(37, 'CALDAS', 2),
(38, 'CAMPAMENTO', 2),
(39, 'CANASGORDAS', 2),
(40, 'CARACOLI', 2),
(41, 'CARAMANTA', 2),
(42, 'CAREPA', 2),
(43, 'CARMEN DE VIBORAL', 2),
(44, 'CAROLINA DEL PRINCIPE', 2),
(45, 'CAUCASIA', 2),
(46, 'CHIGORODO', 2),
(47, 'CISNEROS', 2),
(48, 'COCORNA', 2),
(49, 'CONCEPCION', 2),
(50, 'CONCORDIA', 2),
(51, 'COPACABANA', 2),
(52, 'DABEIBA', 2),
(53, 'DONMATIAS', 2),
(54, 'EBEJICO', 2),
(55, 'EL BAGRE', 2),
(56, 'EL PENOL', 2),
(57, 'EL RETIRO', 2),
(58, 'ENTRERRIOS', 2),
(59, 'ENVIGADO', 2),
(60, 'FREDONIA', 2),
(61, 'FRONTINO', 2),
(62, 'GIRALDO', 2),
(63, 'GIRARDOTA', 2),
(64, 'GOMEZ PLATA', 2),
(65, 'GRANADA', 2),
(66, 'GUADALUPE', 2),
(67, 'GUARNE', 2),
(68, 'GUATAQUE', 2),
(69, 'HELICONIA', 2),
(70, 'HISPANIA', 2),
(71, 'ITAGUI', 2),
(72, 'ITUANGO', 2),
(73, 'JARDIN', 2),
(74, 'JERICO', 2),
(75, 'LA CEJA', 2),
(76, 'LA ESTRELLA', 2),
(77, 'LA PINTADA', 2),
(78, 'LA UNION', 2),
(79, 'LIBORINA', 2),
(80, 'MACEO', 2),
(81, 'MARINILLA', 2),
(82, 'MEDELLIN', 2),
(83, 'MONTEBELLO', 2),
(84, 'MURINDO', 2),
(85, 'MUTATA', 2),
(86, 'NARINO', 2),
(87, 'NECHI', 2),
(88, 'NECOCLI', 2),
(89, 'OLAYA', 2),
(90, 'PEQUE', 2),
(91, 'PUEBLORRICO', 2),
(92, 'PUERTO BERRIO', 2),
(93, 'PUERTO NARE', 2),
(94, 'PUERTO TRIUNFO', 2),
(95, 'REMEDIOS', 2),
(96, 'RIONEGRO', 2),
(97, 'SABANALARGA', 2),
(98, 'SABANETA', 2),
(99, 'SALGAR', 2),
(100, 'SAN ANDRES DE CUERQUIA', 2),
(101, 'SAN CARLOS', 2),
(102, 'SAN FRANCISCO', 2),
(103, 'SAN JERONIMO', 2),
(104, 'SAN JOSE DE LA MONTAÑA', 2),
(105, 'SAN JUAN DE URABA', 2),
(106, 'SAN LUIS', 2),
(107, 'SAN PEDRO DE LOS MILAGROS', 2),
(108, 'SAN PEDRO DE URABA', 2),
(109, 'SAN RAFAEL', 2),
(110, 'SAN ROQUE', 2),
(111, 'SAN VICENTE', 2),
(112, 'SANTA BARBARA', 2),
(113, 'SANTA ROSA DE OSOS', 2),
(114, 'SANTO DOMINGO', 2),
(115, 'SANTUARIO', 2),
(116, 'SEGOVIA', 2),
(117, 'SONSON', 2),
(118, 'SOPETRAN', 2),
(119, 'TAMESIS', 2),
(120, 'TARAZA', 2),
(121, 'TARSO', 2),
(122, 'TITIRIBI', 2),
(123, 'TOLEDO', 2),
(124, 'TURBO', 2),
(125, 'URAMITA', 2),
(126, 'URRAO', 2),
(127, 'VALDIVIA', 2),
(128, 'VALPARAISO', 2),
(129, 'VEGACHI', 2),
(130, 'VENECIA', 2),
(131, 'VIGIA DEL FUERTE', 2),
(132, 'YALI', 2),
(133, 'YARUMAL', 2),
(134, 'YOLOMBO', 2),
(135, 'YONDO', 2),
(136, 'ZARAGOZA', 2),
(137, 'ARAUCA', 3),
(138, 'ARAUQUITA', 3),
(139, 'CRAVO NORTE', 3),
(140, 'FORTUL', 3),
(141, 'PUERTO RONDON', 3),
(142, 'SARAVENA', 3),
(143, 'TAME', 3),
(144, 'BARANOA', 4),
(145, 'BARRANQUILLA', 4),
(146, 'CAMPO DE LA CRUZ', 4),
(147, 'CANDELARIA', 4),
(148, 'GALAPA', 4),
(149, 'JUAN DE ACOSTA', 4),
(150, 'LURUACO', 4),
(151, 'MALAMBO', 4),
(152, 'MANATI', 4),
(153, 'PALMAR DE VARELA', 4),
(154, 'PIOJO', 4),
(155, 'POLO NUEVO', 4),
(156, 'PONEDERA', 4),
(157, 'PUERTO COLOMBIA', 4),
(158, 'REPELON', 4),
(159, 'SABANAGRANDE', 4),
(160, 'SABANALARGA', 4),
(161, 'SANTA LUCIA', 4),
(162, 'SANTO TOMAS', 4),
(163, 'SOLEDAD', 4),
(164, 'SUAN', 4),
(165, 'TUBARA', 4),
(166, 'USIACURI', 4),
(167, 'ACHI', 5),
(168, 'ALTOS DEL ROSARIO', 5),
(169, 'ARENAL', 5),
(170, 'ARJONA', 5),
(171, 'ARROYOHONDO', 5),
(172, 'BARRANCO DE LOBA', 5),
(173, 'BRAZUELO DE PAPAYAL', 5),
(174, 'CALAMAR', 5),
(175, 'CANTAGALLO', 5),
(176, 'CARTAGENA DE INDIAS', 5),
(177, 'CICUCO', 5),
(178, 'CLEMENCIA', 5),
(179, 'CORDOBA', 5),
(180, 'EL CARMEN DE BOLIVAR', 5),
(181, 'EL GUAMO', 5),
(182, 'EL PENION', 5),
(183, 'HATILLO DE LOBA', 5),
(184, 'MAGANGUE', 5),
(185, 'MAHATES', 5),
(186, 'MARGARITA', 5),
(187, 'MARIA LA BAJA', 5),
(188, 'MONTECRISTO', 5),
(189, 'MORALES', 5),
(190, 'MORALES', 5),
(191, 'NOROSI', 5),
(192, 'PINILLOS', 5),
(193, 'REGIDOR', 5),
(194, 'RIO VIEJO', 5),
(195, 'SAN CRISTOBAL', 5),
(196, 'SAN ESTANISLAO', 5),
(197, 'SAN FERNANDO', 5),
(198, 'SAN JACINTO', 5),
(199, 'SAN JACINTO DEL CAUCA', 5),
(200, 'SAN JUAN DE NEPOMUCENO', 5),
(201, 'SAN MARTIN DE LOBA', 5),
(202, 'SAN PABLO', 5),
(203, 'SAN PABLO NORTE', 5),
(204, 'SANTA CATALINA', 5),
(205, 'SANTA CRUZ DE MOMPOX', 5),
(206, 'SANTA ROSA', 5),
(207, 'SANTA ROSA DEL SUR', 5),
(208, 'SIMITI', 5),
(209, 'SOPLAVIENTO', 5),
(210, 'TALAIGUA NUEVO', 5),
(211, 'TUQUISIO', 5),
(212, 'TURBACO', 5),
(213, 'TURBANA', 5),
(214, 'VILLANUEVA', 5),
(215, 'ZAMBRANO', 5),
(216, 'AQUITANIA', 6),
(217, 'ARCABUCO', 6),
(218, 'BELÉN', 6),
(219, 'BERBEO', 6),
(220, 'BETÉITIVA', 6),
(221, 'BOAVITA', 6),
(222, 'BOYACÁ', 6),
(223, 'BRICEÑO', 6),
(224, 'BUENAVISTA', 6),
(225, 'BUSBANZÁ', 6),
(226, 'CALDAS', 6),
(227, 'CAMPO HERMOSO', 6),
(228, 'CERINZA', 6),
(229, 'CHINAVITA', 6),
(230, 'CHIQUINQUIRÁ', 6),
(231, 'CHÍQUIZA', 6),
(232, 'CHISCAS', 6),
(233, 'CHITA', 6),
(234, 'CHITARAQUE', 6),
(235, 'CHIVATÁ', 6),
(236, 'CIÉNEGA', 6),
(237, 'CÓMBITA', 6),
(238, 'COPER', 6),
(239, 'CORRALES', 6),
(240, 'COVARACHÍA', 6),
(241, 'CUBARA', 6),
(242, 'CUCAITA', 6),
(243, 'CUITIVA', 6),
(244, 'DUITAMA', 6),
(245, 'EL COCUY', 6),
(246, 'EL ESPINO', 6),
(247, 'FIRAVITOBA', 6),
(248, 'FLORESTA', 6),
(249, 'GACHANTIVÁ', 6),
(250, 'GÁMEZA', 6),
(251, 'GARAGOA', 6),
(252, 'GUACAMAYAS', 6),
(253, 'GÜICÁN', 6),
(254, 'IZA', 6),
(255, 'JENESANO', 6),
(256, 'JERICÓ', 6),
(257, 'LA UVITA', 6),
(258, 'LA VICTORIA', 6),
(259, 'LABRANZA GRANDE', 6),
(260, 'MACANAL', 6),
(261, 'MARIPÍ', 6),
(262, 'MIRAFLORES', 6),
(263, 'MONGUA', 6),
(264, 'MONGUÍ', 6),
(265, 'MONIQUIRÁ', 6),
(266, 'MOTAVITA', 6),
(267, 'MUZO', 6),
(268, 'NOBSA', 6),
(269, 'NUEVO COLÓN', 6),
(270, 'OICATÁ', 6),
(271, 'OTANCHE', 6),
(272, 'PACHAVITA', 6),
(273, 'PÁEZ', 6),
(274, 'PAIPA', 6),
(275, 'PAJARITO', 6),
(276, 'PANQUEBA', 6),
(277, 'PAUNA', 6),
(278, 'PAYA', 6),
(279, 'PAZ DE RÍO', 6),
(280, 'PESCA', 6),
(281, 'PISBA', 6),
(282, 'PUERTO BOYACA', 6),
(283, 'QUÍPAMA', 6),
(284, 'RAMIRIQUÍ', 6),
(285, 'RÁQUIRA', 6),
(286, 'RONDÓN', 6),
(287, 'SABOYÁ', 6),
(288, 'SÁCHICA', 6),
(289, 'SAMACÁ', 6),
(290, 'SAN EDUARDO', 6),
(291, 'SAN JOSÉ DE PARE', 6),
(292, 'SAN LUÍS DE GACENO', 6),
(293, 'SAN MATEO', 6),
(294, 'SAN MIGUEL DE SEMA', 6),
(295, 'SAN PABLO DE BORBUR', 6),
(296, 'SANTA MARÍA', 6),
(297, 'SANTA ROSA DE VITERBO', 6),
(298, 'SANTA SOFÍA', 6),
(299, 'SANTANA', 6),
(300, 'SATIVANORTE', 6),
(301, 'SATIVASUR', 6),
(302, 'SIACHOQUE', 6),
(303, 'SOATÁ', 6),
(304, 'SOCHA', 6),
(305, 'SOCOTÁ', 6),
(306, 'SOGAMOSO', 6),
(307, 'SORA', 6),
(308, 'SORACÁ', 6),
(309, 'SOTAQUIRÁ', 6),
(310, 'SUSACÓN', 6),
(311, 'SUTARMACHÁN', 6),
(312, 'TASCO', 6),
(313, 'TIBANÁ', 6),
(314, 'TIBASOSA', 6),
(315, 'TINJACÁ', 6),
(316, 'TIPACOQUE', 6),
(317, 'TOCA', 6),
(318, 'TOGÜÍ', 6),
(319, 'TÓPAGA', 6),
(320, 'TOTA', 6),
(321, 'TUNJA', 6),
(322, 'TUNUNGUÁ', 6),
(323, 'TURMEQUÉ', 6),
(324, 'TUTA', 6),
(325, 'TUTAZÁ', 6),
(326, 'UMBITA', 6),
(327, 'VENTA QUEMADA', 6),
(328, 'VILLA DE LEYVA', 6),
(329, 'VIRACACHÁ', 6),
(330, 'ZETAQUIRA', 6),
(331, 'AGUADAS', 7),
(332, 'ANSERMA', 7),
(333, 'ARANZAZU', 7),
(334, 'BELALCAZAR', 7),
(335, 'CHINCHINÁ', 7),
(336, 'FILADELFIA', 7),
(337, 'LA DORADA', 7),
(338, 'LA MERCED', 7),
(339, 'MANIZALES', 7),
(340, 'MANZANARES', 7),
(341, 'MARMATO', 7),
(342, 'MARQUETALIA', 7),
(343, 'MARULANDA', 7),
(344, 'NEIRA', 7),
(345, 'NORCASIA', 7),
(346, 'PACORA', 7),
(347, 'PALESTINA', 7),
(348, 'PENSILVANIA', 7),
(349, 'RIOSUCIO', 7),
(350, 'RISARALDA', 7),
(351, 'SALAMINA', 7),
(352, 'SAMANA', 7),
(353, 'SAN JOSE', 7),
(354, 'SUPÍA', 7),
(355, 'VICTORIA', 7),
(356, 'VILLAMARÍA', 7),
(357, 'VITERBO', 7),
(358, 'ALBANIA', 8),
(359, 'BELÉN ANDAQUIES', 8),
(360, 'CARTAGENA DEL CHAIRA', 8),
(361, 'CURILLO', 8),
(362, 'EL DONCELLO', 8),
(363, 'EL PAUJIL', 8),
(364, 'FLORENCIA', 8),
(365, 'LA MONTAÑITA', 8),
(366, 'MILÁN', 8),
(367, 'MORELIA', 8),
(368, 'PUERTO RICO', 8),
(369, 'SAN  VICENTE DEL CAGUAN', 8),
(370, 'SAN JOSÉ DE FRAGUA', 8),
(371, 'SOLANO', 8),
(372, 'SOLITA', 8),
(373, 'VALPARAÍSO', 8),
(374, 'AGUAZUL', 9),
(375, 'CHAMEZA', 9),
(376, 'HATO COROZAL', 9),
(377, 'LA SALINA', 9),
(378, 'MANÍ', 9),
(379, 'MONTERREY', 9),
(380, 'NUNCHIA', 9),
(381, 'OROCUE', 9),
(382, 'PAZ DE ARIPORO', 9),
(383, 'PORE', 9),
(384, 'RECETOR', 9),
(385, 'SABANA LARGA', 9),
(386, 'SACAMA', 9),
(387, 'SAN LUIS DE PALENQUE', 9),
(388, 'TAMARA', 9),
(389, 'TAURAMENA', 9),
(390, 'TRINIDAD', 9),
(391, 'VILLANUEVA', 9),
(392, 'YOPAL', 9),
(393, 'ALMAGUER', 10),
(394, 'ARGELIA', 10),
(395, 'BALBOA', 10),
(396, 'BOLÍVAR', 10),
(397, 'BUENOS AIRES', 10),
(398, 'CAJIBIO', 10),
(399, 'CALDONO', 10),
(400, 'CALOTO', 10),
(401, 'CORINTO', 10),
(402, 'EL TAMBO', 10),
(403, 'FLORENCIA', 10),
(404, 'GUAPI', 10),
(405, 'INZA', 10),
(406, 'JAMBALÓ', 10),
(407, 'LA SIERRA', 10),
(408, 'LA VEGA', 10),
(409, 'LÓPEZ', 10),
(410, 'MERCADERES', 10),
(411, 'MIRANDA', 10),
(412, 'MORALES', 10),
(413, 'PADILLA', 10),
(414, 'PÁEZ', 10),
(415, 'PATIA (EL BORDO)', 10),
(416, 'PIAMONTE', 10),
(417, 'PIENDAMO', 10),
(418, 'POPAYÁN', 10),
(419, 'PUERTO TEJADA', 10),
(420, 'PURACE', 10),
(421, 'ROSAS', 10),
(422, 'SAN SEBASTIÁN', 10),
(423, 'SANTA ROSA', 10),
(424, 'SANTANDER DE QUILICHAO', 10),
(425, 'SILVIA', 10),
(426, 'SOTARA', 10),
(427, 'SUÁREZ', 10),
(428, 'SUCRE', 10),
(429, 'TIMBÍO', 10),
(430, 'TIMBIQUÍ', 10),
(431, 'TORIBIO', 10),
(432, 'TOTORO', 10),
(433, 'VILLA RICA', 10),
(434, 'AGUACHICA', 11),
(435, 'AGUSTÍN CODAZZI', 11),
(436, 'ASTREA', 11),
(437, 'BECERRIL', 11),
(438, 'BOSCONIA', 11),
(439, 'CHIMICHAGUA', 11),
(440, 'CHIRIGUANÁ', 11),
(441, 'CURUMANÍ', 11),
(442, 'EL COPEY', 11),
(443, 'EL PASO', 11),
(444, 'GAMARRA', 11),
(445, 'GONZÁLEZ', 11),
(446, 'LA GLORIA', 11),
(447, 'LA JAGUA IBIRICO', 11),
(448, 'MANAURE BALCÓN DEL CESAR', 11),
(449, 'PAILITAS', 11),
(450, 'PELAYA', 11),
(451, 'PUEBLO BELLO', 11),
(452, 'RÍO DE ORO', 11),
(453, 'ROBLES (LA PAZ)', 11),
(454, 'SAN ALBERTO', 11),
(455, 'SAN DIEGO', 11),
(456, 'SAN MARTÍN', 11),
(457, 'TAMALAMEQUE', 11),
(458, 'VALLEDUPAR', 11),
(459, 'ACANDI', 12),
(460, 'ALTO BAUDO (PIE DE PATO)', 12),
(461, 'ATRATO', 12),
(462, 'BAGADO', 12),
(463, 'BAHIA SOLANO (MUTIS)', 12),
(464, 'BAJO BAUDO (PIZARRO)', 12),
(465, 'BOJAYA (BELLAVISTA)', 12),
(466, 'CANTON DE SAN PABLO', 12),
(467, 'CARMEN DEL DARIEN', 12),
(468, 'CERTEGUI', 12),
(469, 'CONDOTO', 12),
(470, 'EL CARMEN', 12),
(471, 'ISTMINA', 12),
(472, 'JURADO', 12),
(473, 'LITORAL DEL SAN JUAN', 12),
(474, 'LLORO', 12),
(475, 'MEDIO ATRATO', 12),
(476, 'MEDIO BAUDO (BOCA DE PEPE)', 12),
(477, 'MEDIO SAN JUAN', 12),
(478, 'NOVITA', 12),
(479, 'NUQUI', 12),
(480, 'QUIBDO', 12),
(481, 'RIO IRO', 12),
(482, 'RIO QUITO', 12),
(483, 'RIOSUCIO', 12),
(484, 'SAN JOSE DEL PALMAR', 12),
(485, 'SIPI', 12),
(486, 'TADO', 12),
(487, 'UNGUIA', 12),
(488, 'UNIÓN PANAMERICANA', 12),
(489, 'AYAPEL', 13),
(490, 'BUENAVISTA', 13),
(491, 'CANALETE', 13),
(492, 'CERETÉ', 13),
(493, 'CHIMA', 13),
(494, 'CHINÚ', 13),
(495, 'CIENAGA DE ORO', 13),
(496, 'COTORRA', 13),
(497, 'LA APARTADA', 13),
(498, 'LORICA', 13),
(499, 'LOS CÓRDOBAS', 13),
(500, 'MOMIL', 13),
(501, 'MONTELÍBANO', 13),
(502, 'MONTERÍA', 13),
(503, 'MOÑITOS', 13),
(504, 'PLANETA RICA', 13),
(505, 'PUEBLO NUEVO', 13),
(506, 'PUERTO ESCONDIDO', 13),
(507, 'PUERTO LIBERTADOR', 13),
(508, 'PURÍSIMA', 13),
(509, 'SAHAGÚN', 13),
(510, 'SAN ANDRÉS SOTAVENTO', 13),
(511, 'SAN ANTERO', 13),
(512, 'SAN BERNARDO VIENTO', 13),
(513, 'SAN CARLOS', 13),
(514, 'SAN PELAYO', 13),
(515, 'TIERRALTA', 13),
(516, 'VALENCIA', 13),
(517, 'AGUA DE DIOS', 14),
(518, 'ALBAN', 14),
(519, 'ANAPOIMA', 14),
(520, 'ANOLAIMA', 14),
(521, 'ARBELAEZ', 14),
(522, 'BELTRÁN', 14),
(523, 'BITUIMA', 14),
(524, 'BOGOTÁ DC', 14),
(525, 'BOJACÁ', 14),
(526, 'CABRERA', 14),
(527, 'CACHIPAY', 14),
(528, 'CAJICÁ', 14),
(529, 'CAPARRAPÍ', 14),
(530, 'CAQUEZA', 14),
(531, 'CARMEN DE CARUPA', 14),
(532, 'CHAGUANÍ', 14),
(533, 'CHIA', 14),
(534, 'CHIPAQUE', 14),
(535, 'CHOACHÍ', 14),
(536, 'CHOCONTÁ', 14),
(537, 'COGUA', 14),
(538, 'COTA', 14),
(539, 'CUCUNUBÁ', 14),
(540, 'EL COLEGIO', 14),
(541, 'EL PEÑÓN', 14),
(542, 'EL ROSAL1', 14),
(543, 'FACATATIVA', 14),
(544, 'FÓMEQUE', 14),
(545, 'FOSCA', 14),
(546, 'FUNZA', 14),
(547, 'FÚQUENE', 14),
(548, 'FUSAGASUGA', 14),
(549, 'GACHALÁ', 14),
(550, 'GACHANCIPÁ', 14),
(551, 'GACHETA', 14),
(552, 'GAMA', 14),
(553, 'GIRARDOT', 14),
(554, 'GRANADA2', 14),
(555, 'GUACHETÁ', 14),
(556, 'GUADUAS', 14),
(557, 'GUASCA', 14),
(558, 'GUATAQUÍ', 14),
(559, 'GUATAVITA', 14),
(560, 'GUAYABAL DE SIQUIMA', 14),
(561, 'GUAYABETAL', 14),
(562, 'GUTIÉRREZ', 14),
(563, 'JERUSALÉN', 14),
(564, 'JUNÍN', 14),
(565, 'LA CALERA', 14),
(566, 'LA MESA', 14),
(567, 'LA PALMA', 14),
(568, 'LA PEÑA', 14),
(569, 'LA VEGA', 14),
(570, 'LENGUAZAQUE', 14),
(571, 'MACHETÁ', 14),
(572, 'MADRID', 14),
(573, 'MANTA', 14),
(574, 'MEDINA', 14),
(575, 'MOSQUERA', 14),
(576, 'NARIÑO', 14),
(577, 'NEMOCÓN', 14),
(578, 'NILO', 14),
(579, 'NIMAIMA', 14),
(580, 'NOCAIMA', 14),
(581, 'OSPINA PÉREZ', 14),
(582, 'PACHO', 14),
(583, 'PAIME', 14),
(584, 'PANDI', 14),
(585, 'PARATEBUENO', 14),
(586, 'PASCA', 14),
(587, 'PUERTO SALGAR', 14),
(588, 'PULÍ', 14),
(589, 'QUEBRADANEGRA', 14),
(590, 'QUETAME', 14),
(591, 'QUIPILE', 14),
(592, 'RAFAEL REYES', 14),
(593, 'RICAURTE', 14),
(594, 'SAN  ANTONIO DEL  TEQUENDAMA', 14),
(595, 'SAN BERNARDO', 14),
(596, 'SAN CAYETANO', 14),
(597, 'SAN FRANCISCO', 14),
(598, 'SAN JUAN DE RIOSECO', 14),
(599, 'SASAIMA', 14),
(600, 'SESQUILÉ', 14),
(601, 'SIBATÉ', 14),
(602, 'SILVANIA', 14),
(603, 'SIMIJACA', 14),
(604, 'SOACHA', 14),
(605, 'SOPO', 14),
(606, 'SUBACHOQUE', 14),
(607, 'SUESCA', 14),
(608, 'SUPATÁ', 14),
(609, 'SUSA', 14),
(610, 'SUTATAUSA', 14),
(611, 'TABIO', 14),
(612, 'TAUSA', 14),
(613, 'TENA', 14),
(614, 'TENJO', 14),
(615, 'TIBACUY', 14),
(616, 'TIBIRITA', 14),
(617, 'TOCAIMA', 14),
(618, 'TOCANCIPÁ', 14),
(619, 'TOPAIPÍ', 14),
(620, 'UBALÁ', 14),
(621, 'UBAQUE', 14),
(622, 'UBATÉ', 14),
(623, 'UNE', 14),
(624, 'UTICA', 14),
(625, 'VERGARA', 14),
(626, 'VIANI', 14),
(627, 'VILLA GOMEZ', 14),
(628, 'VILLA PINZÓN', 14),
(629, 'VILLETA', 14),
(630, 'VIOTA', 14),
(631, 'YACOPÍ', 14),
(632, 'ZIPACÓN', 14),
(633, 'ZIPAQUIRÁ', 14),
(634, 'BARRANCO MINAS', 15),
(635, 'CACAHUAL', 15),
(636, 'INÍRIDA', 15),
(637, 'LA GUADALUPE', 15),
(638, 'MAPIRIPANA', 15),
(639, 'MORICHAL', 15),
(640, 'PANA PANA', 15),
(641, 'PUERTO COLOMBIA', 15),
(642, 'SAN FELIPE', 15),
(643, 'CALAMAR', 16),
(644, 'EL RETORNO', 16),
(645, 'MIRAFLOREZ', 16),
(646, 'SAN JOSÉ DEL GUAVIARE', 16),
(647, 'ACEVEDO', 17),
(648, 'AGRADO', 17),
(649, 'AIPE', 17),
(650, 'ALGECIRAS', 17),
(651, 'ALTAMIRA', 17),
(652, 'BARAYA', 17),
(653, 'CAMPO ALEGRE', 17),
(654, 'COLOMBIA', 17),
(655, 'ELIAS', 17),
(656, 'GARZÓN', 17),
(657, 'GIGANTE', 17),
(658, 'GUADALUPE', 17),
(659, 'HOBO', 17),
(660, 'IQUIRA', 17),
(661, 'ISNOS', 17),
(662, 'LA ARGENTINA', 17),
(663, 'LA PLATA', 17),
(664, 'NATAGA', 17),
(665, 'NEIVA', 17),
(666, 'OPORAPA', 17),
(667, 'PAICOL', 17),
(668, 'PALERMO', 17),
(669, 'PALESTINA', 17),
(670, 'PITAL', 17),
(671, 'PITALITO', 17),
(672, 'RIVERA', 17),
(673, 'SALADO BLANCO', 17),
(674, 'SAN AGUSTÍN', 17),
(675, 'SANTA MARIA', 17),
(676, 'SUAZA', 17),
(677, 'TARQUI', 17),
(678, 'TELLO', 17),
(679, 'TERUEL', 17),
(680, 'TESALIA', 17),
(681, 'TIMANA', 17),
(682, 'VILLAVIEJA', 17),
(683, 'YAGUARA', 17),
(684, 'ALBANIA', 18),
(685, 'BARRANCAS', 18),
(686, 'DIBULLA', 18),
(687, 'DISTRACCIÓN', 18),
(688, 'EL MOLINO', 18),
(689, 'FONSECA', 18),
(690, 'HATO NUEVO', 18),
(691, 'LA JAGUA DEL PILAR', 18),
(692, 'MAICAO', 18),
(693, 'MANAURE', 18),
(694, 'RIOHACHA', 18),
(695, 'SAN JUAN DEL CESAR', 18),
(696, 'URIBIA', 18),
(697, 'URUMITA', 18),
(698, 'VILLANUEVA', 18),
(699, 'ALGARROBO', 19),
(700, 'ARACATACA', 19),
(701, 'ARIGUANI', 19),
(702, 'CERRO SAN ANTONIO', 19),
(703, 'CHIVOLO', 19),
(704, 'CIENAGA', 19),
(705, 'CONCORDIA', 19),
(706, 'EL BANCO', 19),
(707, 'EL PIÑON', 19),
(708, 'EL RETEN', 19),
(709, 'FUNDACION', 19),
(710, 'GUAMAL', 19),
(711, 'NUEVA GRANADA', 19),
(712, 'PEDRAZA', 19),
(713, 'PIJIÑO DEL CARMEN', 19),
(714, 'PIVIJAY', 19),
(715, 'PLATO', 19),
(716, 'PUEBLO VIEJO', 19),
(717, 'REMOLINO', 19),
(718, 'SABANAS DE SAN ANGEL', 19),
(719, 'SALAMINA', 19),
(720, 'SAN SEBASTIAN DE BUENAVISTA', 19),
(721, 'SAN ZENON', 19),
(722, 'SANTA ANA', 19),
(723, 'SANTA BARBARA DE PINTO', 19),
(724, 'SANTA MARTA', 19),
(725, 'SITIONUEVO', 19),
(726, 'TENERIFE', 19),
(727, 'ZAPAYAN', 19),
(728, 'ZONA BANANERA', 19),
(729, 'ACACIAS', 20),
(730, 'BARRANCA DE UPIA', 20),
(731, 'CABUYARO', 20),
(732, 'CASTILLA LA NUEVA', 20),
(733, 'CUBARRAL', 20),
(734, 'CUMARAL', 20),
(735, 'EL CALVARIO', 20),
(736, 'EL CASTILLO', 20),
(737, 'EL DORADO', 20),
(738, 'FUENTE DE ORO', 20),
(739, 'GRANADA', 20),
(740, 'GUAMAL', 20),
(741, 'LA MACARENA', 20),
(742, 'LA URIBE', 20),
(743, 'LEJANÍAS', 20),
(744, 'MAPIRIPÁN', 20),
(745, 'MESETAS', 20),
(746, 'PUERTO CONCORDIA', 20),
(747, 'PUERTO GAITÁN', 20),
(748, 'PUERTO LLERAS', 20),
(749, 'PUERTO LÓPEZ', 20),
(750, 'PUERTO RICO', 20),
(751, 'RESTREPO', 20),
(752, 'SAN  JUAN DE ARAMA', 20),
(753, 'SAN CARLOS GUAROA', 20),
(754, 'SAN JUANITO', 20),
(755, 'SAN MARTÍN', 20),
(756, 'VILLAVICENCIO', 20),
(757, 'VISTA HERMOSA', 20),
(758, 'ALBAN', 21),
(759, 'ALDAÑA', 21),
(760, 'ANCUYA', 21),
(761, 'ARBOLEDA', 21),
(762, 'BARBACOAS', 21),
(763, 'BELEN', 21),
(764, 'BUESACO', 21),
(765, 'CHACHAGUI', 21),
(766, 'COLON (GENOVA)', 21),
(767, 'CONSACA', 21),
(768, 'CONTADERO', 21),
(769, 'CORDOBA', 21),
(770, 'CUASPUD', 21),
(771, 'CUMBAL', 21),
(772, 'CUMBITARA', 21),
(773, 'EL CHARCO', 21),
(774, 'EL PEÑOL', 21),
(775, 'EL ROSARIO', 21),
(776, 'EL TABLÓN', 21),
(777, 'EL TAMBO', 21),
(778, 'FUNES', 21),
(779, 'GUACHUCAL', 21),
(780, 'GUAITARILLA', 21),
(781, 'GUALMATAN', 21),
(782, 'ILES', 21),
(783, 'IMUES', 21),
(784, 'IPIALES', 21),
(785, 'LA CRUZ', 21),
(786, 'LA FLORIDA', 21),
(787, 'LA LLANADA', 21),
(788, 'LA TOLA', 21),
(789, 'LA UNION', 21),
(790, 'LEIVA', 21),
(791, 'LINARES', 21),
(792, 'LOS ANDES', 21),
(793, 'MAGUI', 21),
(794, 'MALLAMA', 21),
(795, 'MOSQUEZA', 21),
(796, 'NARIÑO', 21),
(797, 'OLAYA HERRERA', 21),
(798, 'OSPINA', 21),
(799, 'PASTO', 21),
(800, 'PIZARRO', 21),
(801, 'POLICARPA', 21),
(802, 'POTOSI', 21),
(803, 'PROVIDENCIA', 21),
(804, 'PUERRES', 21),
(805, 'PUPIALES', 21),
(806, 'RICAURTE', 21),
(807, 'ROBERTO PAYAN', 21),
(808, 'SAMANIEGO', 21),
(809, 'SAN BERNARDO', 21),
(810, 'SAN LORENZO', 21),
(811, 'SAN PABLO', 21),
(812, 'SAN PEDRO DE CARTAGO', 21),
(813, 'SANDONA', 21),
(814, 'SANTA BARBARA', 21),
(815, 'SANTACRUZ', 21),
(816, 'SAPUYES', 21),
(817, 'TAMINANGO', 21),
(818, 'TANGUA', 21),
(819, 'TUMACO', 21),
(820, 'TUQUERRES', 21),
(821, 'YACUANQUER', 21),
(822, 'ABREGO', 22),
(823, 'ARBOLEDAS', 22),
(824, 'BOCHALEMA', 22),
(825, 'BUCARASICA', 22),
(826, 'CÁCHIRA', 22),
(827, 'CÁCOTA', 22),
(828, 'CHINÁCOTA', 22),
(829, 'CHITAGÁ', 22),
(830, 'CONVENCIÓN', 22),
(831, 'CÚCUTA', 22),
(832, 'CUCUTILLA', 22),
(833, 'DURANIA', 22),
(834, 'EL CARMEN', 22),
(835, 'EL TARRA', 22),
(836, 'EL ZULIA', 22),
(837, 'GRAMALOTE', 22),
(838, 'HACARI', 22),
(839, 'HERRÁN', 22),
(840, 'LA ESPERANZA', 22),
(841, 'LA PLAYA', 22),
(842, 'LABATECA', 22),
(843, 'LOS PATIOS', 22),
(844, 'LOURDES', 22),
(845, 'MUTISCUA', 22),
(846, 'OCAÑA', 22),
(847, 'PAMPLONA', 22),
(848, 'PAMPLONITA', 22),
(849, 'PUERTO SANTANDER', 22),
(850, 'RAGONVALIA', 22),
(851, 'SALAZAR', 22),
(852, 'SAN CALIXTO', 22),
(853, 'SAN CAYETANO', 22),
(854, 'SANTIAGO', 22),
(855, 'SARDINATA', 22),
(856, 'SILOS', 22),
(857, 'TEORAMA', 22),
(858, 'TIBÚ', 22),
(859, 'TOLEDO', 22),
(860, 'VILLA CARO', 22),
(861, 'VILLA DEL ROSARIO', 22),
(862, 'COLÓN', 23),
(863, 'MOCOA', 23),
(864, 'ORITO', 23),
(865, 'PUERTO ASÍS', 23),
(866, 'PUERTO CAYCEDO', 23),
(867, 'PUERTO GUZMÁN', 23),
(868, 'PUERTO LEGUÍZAMO', 23),
(869, 'SAN FRANCISCO', 23),
(870, 'SAN MIGUEL', 23),
(871, 'SANTIAGO', 23),
(872, 'SIBUNDOY', 23),
(873, 'VALLE DEL GUAMUEZ', 23),
(874, 'VILLAGARZÓN', 23),
(875, 'ARMENIA', 24),
(876, 'BUENAVISTA', 24),
(877, 'CALARCÁ', 24),
(878, 'CIRCASIA', 24),
(879, 'CÓRDOBA', 24),
(880, 'FILANDIA', 24),
(881, 'GÉNOVA', 24),
(882, 'LA TEBAIDA', 24),
(883, 'MONTENEGRO', 24),
(884, 'PIJAO', 24),
(885, 'QUIMBAYA', 24),
(886, 'SALENTO', 24),
(887, 'APIA', 25),
(888, 'BALBOA', 25),
(889, 'BELÉN DE UMBRÍA', 25),
(890, 'DOS QUEBRADAS', 25),
(891, 'GUATICA', 25),
(892, 'LA CELIA', 25),
(893, 'LA VIRGINIA', 25),
(894, 'MARSELLA', 25),
(895, 'MISTRATO', 25),
(896, 'PEREIRA', 25),
(897, 'PUEBLO RICO', 25),
(898, 'QUINCHÍA', 25),
(899, 'SANTA ROSA DE CABAL', 25),
(900, 'SANTUARIO', 25),
(901, 'PROVIDENCIA', 26),
(902, 'SAN ANDRES', 26),
(903, 'SANTA CATALINA', 26),
(904, 'AGUADA', 27),
(905, 'ALBANIA', 27),
(906, 'ARATOCA', 27),
(907, 'BARBOSA', 27),
(908, 'BARICHARA', 27),
(909, 'BARRANCABERMEJA', 27),
(910, 'BETULIA', 27),
(911, 'BOLÍVAR', 27),
(912, 'BUCARAMANGA', 27),
(913, 'CABRERA', 27),
(914, 'CALIFORNIA', 27),
(915, 'CAPITANEJO', 27),
(916, 'CARCASI', 27),
(917, 'CEPITA', 27),
(918, 'CERRITO', 27),
(919, 'CHARALÁ', 27),
(920, 'CHARTA', 27),
(921, 'CHIMA', 27),
(922, 'CHIPATÁ', 27),
(923, 'CIMITARRA', 27),
(924, 'CONCEPCIÓN', 27),
(925, 'CONFINES', 27),
(926, 'CONTRATACIÓN', 27),
(927, 'COROMORO', 27),
(928, 'CURITÍ', 27),
(929, 'EL CARMEN', 27),
(930, 'EL GUACAMAYO', 27),
(931, 'EL PEÑÓN', 27),
(932, 'EL PLAYÓN', 27),
(933, 'ENCINO', 27),
(934, 'ENCISO', 27),
(935, 'FLORIÁN', 27),
(936, 'FLORIDABLANCA', 27),
(937, 'GALÁN', 27),
(938, 'GAMBITA', 27),
(939, 'GIRÓN', 27),
(940, 'GUACA', 27),
(941, 'GUADALUPE', 27),
(942, 'GUAPOTA', 27),
(943, 'GUAVATÁ', 27),
(944, 'GUEPSA', 27),
(945, 'HATO', 27),
(946, 'JESÚS MARIA', 27),
(947, 'JORDÁN', 27),
(948, 'LA BELLEZA', 27),
(949, 'LA PAZ', 27),
(950, 'LANDAZURI', 27),
(951, 'LEBRIJA', 27),
(952, 'LOS SANTOS', 27),
(953, 'MACARAVITA', 27),
(954, 'MÁLAGA', 27),
(955, 'MATANZA', 27),
(956, 'MOGOTES', 27),
(957, 'MOLAGAVITA', 27),
(958, 'OCAMONTE', 27),
(959, 'OIBA', 27),
(960, 'ONZAGA', 27),
(961, 'PALMAR', 27),
(962, 'PALMAS DEL SOCORRO', 27),
(963, 'PÁRAMO', 27),
(964, 'PIEDECUESTA', 27),
(965, 'PINCHOTE', 27),
(966, 'PUENTE NACIONAL', 27),
(967, 'PUERTO PARRA', 27),
(968, 'PUERTO WILCHES', 27),
(969, 'RIONEGRO', 27),
(970, 'SABANA DE TORRES', 27),
(971, 'SAN ANDRÉS', 27),
(972, 'SAN BENITO', 27),
(973, 'SAN GIL', 27),
(974, 'SAN JOAQUÍN', 27),
(975, 'SAN JOSÉ DE MIRANDA', 27),
(976, 'SAN MIGUEL', 27),
(977, 'SAN VICENTE DE CHUCURÍ', 27),
(978, 'SANTA BÁRBARA', 27),
(979, 'SANTA HELENA', 27),
(980, 'SIMACOTA', 27),
(981, 'SOCORRO', 27),
(982, 'SUAITA', 27),
(983, 'SUCRE', 27),
(984, 'SURATA', 27),
(985, 'TONA', 27),
(986, 'VALLE SAN JOSÉ', 27),
(987, 'VÉLEZ', 27),
(988, 'VETAS', 27),
(989, 'VILLANUEVA', 27),
(990, 'ZAPATOCA', 27),
(991, 'BUENAVISTA', 28),
(992, 'CAIMITO', 28),
(993, 'CHALÁN', 28),
(994, 'COLOSO', 28),
(995, 'COROZAL', 28),
(996, 'EL ROBLE', 28),
(997, 'GALERAS', 28),
(998, 'GUARANDA', 28),
(999, 'LA UNIÓN', 28),
(1000, 'LOS PALMITOS', 28),
(1001, 'MAJAGUAL', 28),
(1002, 'MORROA', 28),
(1003, 'OVEJAS', 28),
(1004, 'PALMITO', 28),
(1005, 'SAMPUES', 28),
(1006, 'SAN BENITO ABAD', 28),
(1007, 'SAN JUAN DE BETULIA', 28),
(1008, 'SAN MARCOS', 28),
(1009, 'SAN ONOFRE', 28),
(1010, 'SAN PEDRO', 28),
(1011, 'SINCÉ', 28),
(1012, 'SINCELEJO', 28),
(1013, 'SUCRE', 28),
(1014, 'TOLÚ', 28),
(1015, 'TOLUVIEJO', 28),
(1016, 'ALPUJARRA', 29),
(1017, 'ALVARADO', 29),
(1018, 'AMBALEMA', 29),
(1019, 'ANZOATEGUI', 29),
(1020, 'ARMERO (GUAYABAL)', 29),
(1021, 'ATACO', 29),
(1022, 'CAJAMARCA', 29),
(1023, 'CARMEN DE APICALÁ', 29),
(1024, 'CASABIANCA', 29),
(1025, 'CHAPARRAL', 29),
(1026, 'COELLO', 29),
(1027, 'COYAIMA', 29),
(1028, 'CUNDAY', 29),
(1029, 'DOLORES', 29),
(1030, 'ESPINAL', 29),
(1031, 'FALÁN', 29),
(1032, 'FLANDES', 29),
(1033, 'FRESNO', 29),
(1034, 'GUAMO', 29),
(1035, 'HERVEO', 29),
(1036, 'HONDA', 29),
(1037, 'IBAGUÉ', 29),
(1038, 'ICONONZO', 29),
(1039, 'LÉRIDA', 29),
(1040, 'LÍBANO', 29),
(1041, 'MARIQUITA', 29),
(1042, 'MELGAR', 29),
(1043, 'MURILLO', 29),
(1044, 'NATAGAIMA', 29),
(1045, 'ORTEGA', 29),
(1046, 'PALOCABILDO', 29),
(1047, 'PIEDRAS PLANADAS', 29),
(1048, 'PRADO', 29),
(1049, 'PURIFICACIÓN', 29),
(1050, 'RIOBLANCO', 29),
(1051, 'RONCESVALLES', 29),
(1052, 'ROVIRA', 29),
(1053, 'SALDAÑA', 29),
(1054, 'SAN ANTONIO', 29),
(1055, 'SAN LUIS', 29),
(1056, 'SANTA ISABEL', 29),
(1057, 'SUÁREZ', 29),
(1058, 'VALLE DE SAN JUAN', 29),
(1059, 'VENADILLO', 29),
(1060, 'VILLAHERMOSA', 29),
(1061, 'VILLARRICA', 29),
(1062, 'ALCALÁ', 30),
(1063, 'ANDALUCÍA', 30),
(1064, 'ANSERMA NUEVO', 30),
(1065, 'ARGELIA', 30),
(1066, 'BOLÍVAR', 30),
(1067, 'BUENAVENTURA', 30),
(1068, 'BUGA', 30),
(1069, 'BUGALAGRANDE', 30),
(1070, 'CAICEDONIA', 30),
(1071, 'CALI', 30),
(1072, 'CALIMA (DARIEN)', 30),
(1073, 'CANDELARIA', 30),
(1074, 'CARTAGO', 30),
(1075, 'DAGUA', 30),
(1076, 'EL AGUILA', 30),
(1077, 'EL CAIRO', 30),
(1078, 'EL CERRITO', 30),
(1079, 'EL DOVIO', 30),
(1080, 'FLORIDA', 30),
(1081, 'GINEBRA GUACARI', 30),
(1082, 'JAMUNDÍ', 30),
(1083, 'LA CUMBRE', 30),
(1084, 'LA UNIÓN', 30),
(1085, 'LA VICTORIA', 30),
(1086, 'OBANDO', 30),
(1087, 'PALMIRA', 30),
(1088, 'PRADERA', 30),
(1089, 'RESTREPO', 30),
(1090, 'RIO FRÍO', 30),
(1091, 'ROLDANILLO', 30),
(1092, 'SAN PEDRO', 30),
(1093, 'SEVILLA', 30),
(1094, 'TORO', 30),
(1095, 'TRUJILLO', 30),
(1096, 'TULÚA', 30),
(1097, 'ULLOA', 30),
(1098, 'VERSALLES', 30),
(1099, 'VIJES', 30),
(1100, 'YOTOCO', 30),
(1101, 'YUMBO', 30),
(1102, 'ZARZAL', 30),
(1103, 'CARURÚ', 31),
(1104, 'MITÚ', 31),
(1105, 'PACOA', 31),
(1106, 'PAPUNAUA', 31),
(1107, 'TARAIRA', 31),
(1108, 'YAVARATÉ', 31),
(1109, 'CUMARIBO', 32),
(1110, 'LA PRIMAVERA', 32),
(1111, 'PUERTO CARREÑO', 32),
(1112, 'SANTA ROSALIA', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correos`
--

CREATE TABLE `correos` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` enum('programado','prioritario') NOT NULL DEFAULT 'prioritario',
  `fecha_programada` date DEFAULT NULL,
  `estado` enum('pendiente','enviado','cancelado') NOT NULL DEFAULT 'pendiente',
  `titulo` varchar(150) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `boton` enum('si','no') NOT NULL DEFAULT 'no',
  `texto_boton` varchar(20) DEFAULT NULL,
  `url_boton` text,
  `correos_destinatarios` text,
  `plantilla_correo_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `correos`
--

INSERT INTO `correos` (`id`, `tipo`, `fecha_programada`, `estado`, `titulo`, `mensaje`, `boton`, `texto_boton`, `url_boton`, `correos_destinatarios`, `plantilla_correo_id`, `created_at`, `updated_at`) VALUES
(14, 'prioritario', NULL, 'enviado', '¡Hola FuXioner!', '<p class="text-center" style="line-height: 0;">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="line-height: 0;">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.18:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.18:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>4947236</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-07</strong></p></li>\r\n        <li><p>Factura <strong>723-17215</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.18:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">TERMO TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">TE GANOMAS COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">3</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">CAFE &amp; CAFE FIT CAPUCCINO X 28 FUXION CO</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-11-30 18:06:04', '2017-11-30 18:06:04'),
(15, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="line-height: 0;">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="line-height: 0;">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.18:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.18:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>4947236</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-07</strong></p></li>\r\n        <li><p>Factura <strong>723-17215</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.18:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">TERMO TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">TE GANOMAS COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">3</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">CAFE &amp; CAFE FIT CAPUCCINO X 28 FUXION CO</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-01 18:49:30', '2017-12-01 18:49:30'),
(16, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="line-height: 0;">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="line-height: 0;">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.18:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.18:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>4947636</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-07</strong></p></li>\r\n        <li><p>Factura <strong>723-172153</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.18:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">TERMO TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">TE GANOMAS COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">3</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">CAFE &amp; CAFE FIT CAPUCCINO X 28 FUXION CO</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-01 19:28:23', '2017-12-01 19:28:23'),
(17, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>61037</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000003</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 12:41:41', '2017-12-04 12:41:41'),
(18, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>62038</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000004</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 12:41:41', '2017-12-04 12:41:41'),
(19, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>62040</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000006</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 12:44:38', '2017-12-04 12:44:38'),
(20, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>62040</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000006</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 13:04:43', '2017-12-04 13:04:43'),
(21, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>62040</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000006</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 13:12:41', '2017-12-04 13:12:41'),
(22, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>62040</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000006</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 13:14:54', '2017-12-04 13:14:54'),
(23, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>62040</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000006</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 13:30:31', '2017-12-04 13:30:31'),
(24, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>62040</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000006</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 13:31:36', '2017-12-04 13:31:36'),
(25, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>597001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-29001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 13:52:49', '2017-12-04 13:52:49'),
(26, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>61039</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000005</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 14:34:26', '2017-12-04 14:34:26'),
(27, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>596001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-28001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 14:34:26', '2017-12-04 14:34:26'),
(28, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>61039</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000005</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 14:42:29', '2017-12-04 14:42:29'),
(29, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>62040</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000006</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 14:42:29', '2017-12-04 14:42:29');
INSERT INTO `correos` (`id`, `tipo`, `fecha_programada`, `estado`, `titulo`, `mensaje`, `boton`, `texto_boton`, `url_boton`, `correos_destinatarios`, `plantilla_correo_id`, `created_at`, `updated_at`) VALUES
(30, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26902</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 23:21:14', '2017-12-04 23:21:14'),
(31, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27002</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 23:21:14', '2017-12-04 23:21:14'),
(32, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600003</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27003</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 23:21:14', '2017-12-04 23:21:14'),
(33, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26902</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 23:23:30', '2017-12-04 23:23:30'),
(34, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27002</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 23:23:30', '2017-12-04 23:23:30'),
(35, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600003</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27003</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-04 23:23:30', '2017-12-04 23:23:30'),
(36, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26902</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 00:01:07', '2017-12-05 00:01:07'),
(37, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27002</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 00:01:07', '2017-12-05 00:01:07'),
(38, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600003</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27003</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 00:01:07', '2017-12-05 00:01:07'),
(39, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26902</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 00:04:12', '2017-12-05 00:04:12'),
(40, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27002</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 00:04:12', '2017-12-05 00:04:12'),
(41, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600003</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27003</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 00:04:12', '2017-12-05 00:04:12'),
(42, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26902</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 00:09:39', '2017-12-05 00:09:39');
INSERT INTO `correos` (`id`, `tipo`, `fecha_programada`, `estado`, `titulo`, `mensaje`, `boton`, `texto_boton`, `url_boton`, `correos_destinatarios`, `plantilla_correo_id`, `created_at`, `updated_at`) VALUES
(43, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26902</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:13:02', '2017-12-05 01:13:02'),
(44, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26901</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:13:02', '2017-12-05 01:13:02'),
(45, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26902</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:17:17', '2017-12-05 01:17:17'),
(46, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26901</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:17:17', '2017-12-05 01:17:17'),
(47, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27002</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:17:17', '2017-12-05 01:17:17'),
(48, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:17:17', '2017-12-05 01:17:17'),
(49, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600003</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27003</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:17:17', '2017-12-05 01:17:17'),
(50, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26902</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:28:44', '2017-12-05 01:28:44'),
(51, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595003</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26903</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:28:44', '2017-12-05 01:28:44'),
(52, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27002</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:28:44', '2017-12-05 01:28:44'),
(53, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600003</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27003</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:28:44', '2017-12-05 01:28:44'),
(54, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26902</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:35:03', '2017-12-05 01:35:03'),
(55, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595003</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26903</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:35:03', '2017-12-05 01:35:03'),
(56, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27002</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:35:03', '2017-12-05 01:35:03'),
(57, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600003</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27003</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:35:03', '2017-12-05 01:35:03');
INSERT INTO `correos` (`id`, `tipo`, `fecha_programada`, `estado`, `titulo`, `mensaje`, `boton`, `texto_boton`, `url_boton`, `correos_destinatarios`, `plantilla_correo_id`, `created_at`, `updated_at`) VALUES
(58, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26902</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:49:20', '2017-12-05 01:49:20'),
(59, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26901</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:49:20', '2017-12-05 01:49:20'),
(60, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>595003</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-26903</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:49:20', '2017-12-05 01:49:20'),
(61, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600002</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27002</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:49:21', '2017-12-05 01:49:21'),
(62, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:49:21', '2017-12-05 01:49:21'),
(63, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>600003</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-27003</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 01:49:21', '2017-12-05 01:49:21'),
(64, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>597001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-29001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 02:01:38', '2017-12-05 02:01:38'),
(65, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>61039</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000005</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 02:03:03', '2017-12-05 02:03:03'),
(66, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>596001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-28001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 02:03:03', '2017-12-05 02:03:03'),
(67, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>596001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-28001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 02:05:52', '2017-12-05 02:05:52'),
(68, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>61039</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000005</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 02:05:52', '2017-12-05 02:05:52'),
(69, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>597001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-29001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 02:05:52', '2017-12-05 02:05:52'),
(70, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>62040</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000006</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 02:05:52', '2017-12-05 02:05:52'),
(71, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>5960011</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-28001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 02:09:02', '2017-12-05 02:09:02');
INSERT INTO `correos` (`id`, `tipo`, `fecha_programada`, `estado`, `titulo`, `mensaje`, `boton`, `texto_boton`, `url_boton`, `correos_destinatarios`, `plantilla_correo_id`, `created_at`, `updated_at`) VALUES
(72, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>5970011</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-29001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 02:09:02', '2017-12-05 02:09:02'),
(73, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>61039</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000005</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 02:12:35', '2017-12-05 02:12:35'),
(74, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>62040</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000006</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 02:12:35', '2017-12-05 02:12:35'),
(75, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>61039</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000005</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 14:57:46', '2017-12-05 14:57:46'),
(76, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>62040</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000006</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 14:57:46', '2017-12-05 14:57:46'),
(77, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>596001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-28001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 15:04:16', '2017-12-05 15:04:16'),
(78, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <!--<img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">-->\r\n            <img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>597001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-29001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-05 15:04:16', '2017-12-05 15:04:16'),
(79, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">\r\n            <!--<img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">-->\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>596001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-28001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-06 21:01:37', '2017-12-06 21:01:37'),
(80, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">\r\n            <!--<img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">-->\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>596005</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-29001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-06 21:01:37', '2017-12-06 21:01:37'),
(81, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">\r\n            <!--<img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">-->\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>596001</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-28001</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-06 21:04:08', '2017-12-06 21:04:08'),
(82, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">\r\n            <!--<img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">-->\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>596005</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-28005</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">BERRY BALANCE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">FLX TE COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">RGX 1 COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">VITA ENERGIA CHICHA COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">2</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">ELIXIR HGH COLOMBIA</td>\r\n                    </tr>\r\n                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">-1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">Discount</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-06 21:04:08', '2017-12-06 21:04:08'),
(83, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">\r\n            <!--<img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">-->\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>61037</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000003</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-07 14:25:41', '2017-12-07 14:25:41'),
(84, 'prioritario', NULL, 'pendiente', '¡Hola FuXioner!', '<p class="text-center" style="">Este es el estado de tu pedido.</p>\r\n<p class="text-center" style="">Muy pronto estarás disfrutando de tus productos FuXion.</p>\r\n\r\n\r\n<div class="panel">\r\n    <div class="panel-content">\r\n        <p class="text-center"><strong><span>¡TU ORDEN ESTA EN DESPACHO!</span></strong></p>\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-timeline.png"/>\r\n        <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n            <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-house.png">\r\n            <!--<img style="max-width: 100%;" src="http://www.imagen.com.mx/assets/img/imagen_share.png">-->\r\n        </div>\r\n        <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n                            <div style="width: 100%;">\r\n    <ul>\r\n        <li><p>Tu orden N° <strong>62038</strong></p></li>\r\n        <li><p>Fecha <strong>2017-11-11</strong></p></li>\r\n        <li><p>Factura <strong>723-1000004</strong></p></li>\r\n        <li><p><span>ha ingresado en nuestro proceso de despacho.</span></p></li>\r\n    </ul>\r\n</div>                    </div>\r\n    </div>\r\n</div>\r\n\r\n<div>\r\n    <div style="display: inline-block; width: 33%;vertical-align: middle;">\r\n        <img style="max-width: 100%;" src="http://192.168.0.101:8000/archivo/app-public-mail-sachets.png">\r\n    </div>\r\n\r\n    <div style="display: inline-block; width: 63%;vertical-align: middle;">\r\n        <table class="table" style="margin: 0 auto;">\r\n            <tr>\r\n                <td colspan="2"><span>DETALLE DE TU PEDIDO</span></td>\r\n            </tr>\r\n            <tr>\r\n                <th width="35%">Cant.</th>\r\n                <th width="65%">Producto</th>\r\n            </tr>\r\n            <tbody>\r\n                                                    <tr>\r\n                        <td class="text-center" style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">1</td>\r\n                        <td style="font-size: 12px;padding: 0px 5px;border-bottom: 1px solid #c4c4c4;">KIT DE AFILIACION COLOMBIA</td>\r\n                    </tr>\r\n                            </tbody>\r\n        </table>\r\n    </div>\r\n</div>', 'no', NULL, NULL, NULL, 2, '2017-12-07 14:25:41', '2017-12-07 14:25:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cortes`
--

CREATE TABLE `cortes` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` int(10) UNSIGNED NOT NULL,
  `estado` enum('transmitido','procesado','enviado') NOT NULL DEFAULT 'transmitido',
  `guias_asignadas` enum('si','no') NOT NULL DEFAULT 'no',
  `fecha_procesamiento` timestamp NULL DEFAULT NULL,
  `correo_procesamiento_enviado` enum('si','no') DEFAULT 'no',
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `pais_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `pais_id`) VALUES
(1, 'AMAZONAS', 1),
(2, 'ANTIOQUIA', 1),
(3, 'ARAUCA', 1),
(4, 'ATLÁNTICO', 1),
(5, 'BOLÍVAR', 1),
(6, 'BOYACÁ', 1),
(7, 'CALDAS', 1),
(8, 'CAQUETÁ', 1),
(9, 'CASANARE', 1),
(10, 'CAUCA', 1),
(11, 'CESAR', 1),
(12, 'CHOCÓ', 1),
(13, 'CÓRDOBA', 1),
(14, 'CUNDINAMARCA', 1),
(15, 'GUAINÍA', 1),
(16, 'GUAVIARE', 1),
(17, 'HUILA', 1),
(18, 'LA GUAJIRA', 1),
(19, 'MAGDALENA', 1),
(20, 'META', 1),
(21, 'NARIÑO', 1),
(22, 'NORTE DE SANTANDER', 1),
(23, 'PUTUMAYO', 1),
(24, 'QUINDÍO', 1),
(25, 'RISARALDA', 1),
(26, 'SAN ANDRÉS Y ROVIDENCIA', 1),
(27, 'SANTANDER', 1),
(28, 'SUCRE', 1),
(29, 'TOLIMA', 1),
(30, 'VALLE DEL CAUCA', 1),
(31, 'VAUPÉS', 1),
(32, 'VICHADA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresarios`
--

CREATE TABLE `empresarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(150) DEFAULT NULL,
  `kit` enum('si','no') NOT NULL DEFAULT 'no',
  `direccion` varchar(250) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `empresario_id` int(10) UNSIGNED DEFAULT NULL,
  `enroler_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_guias_operadores_logisticos`
--

CREATE TABLE `estados_guias_operadores_logisticos` (
  `id` int(10) UNSIGNED NOT NULL,
  `estado` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `id_estado` varchar(255) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `quien_recibe` varchar(255) DEFAULT NULL,
  `novedad` varchar(255) DEFAULT NULL,
  `guia_id` int(10) UNSIGNED NOT NULL,
  `nombre_estado_operador_logistico_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_operadores_logisticos`
--

CREATE TABLE `estados_operadores_logisticos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `notificacion_push` enum('si','no') NOT NULL DEFAULT 'no',
  `notificacion_correo` enum('si','no') DEFAULT 'no',
  `correos_destinatarios` text,
  `cambio_estado_pedido_id` int(10) UNSIGNED DEFAULT NULL,
  `plantilla_correo_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados_operadores_logisticos`
--

INSERT INTO `estados_operadores_logisticos` (`id`, `nombre`, `alias`, `descripcion`, `notificacion_push`, `notificacion_correo`, `correos_destinatarios`, `cambio_estado_pedido_id`, `plantilla_correo_id`, `created_at`, `updated_at`) VALUES
(1, 'Pedido entregado', 'entregado', 'pedido entregado satisfactoriamente', 'si', 'no', NULL, NULL, NULL, '2017-11-28 17:09:41', '2017-11-28 17:09:41'),
(2, 'Novedad', 'Novedad', 'Pedido o guía con novedad registrada', 'no', 'no', NULL, 13, NULL, '2017-11-23 12:34:38', '2017-11-23 12:34:38'),
(3, 'Pedido en procesamiento', 'Procesamiento', 'Pedido en procesamiento', 'si', 'no', NULL, NULL, NULL, '2017-11-28 16:51:09', '2017-11-28 16:51:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_pedidos`
--

CREATE TABLE `estados_pedidos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `notificacion_push` enum('si','no') NOT NULL DEFAULT 'no',
  `notificacion_correo` enum('si','no') NOT NULL DEFAULT 'no',
  `correos_destinatarios` text,
  `no_asignacion_corte` enum('si','no') NOT NULL DEFAULT 'no',
  `asignacion_corte` enum('si','no') NOT NULL DEFAULT 'no',
  `pedido_entregado` enum('si','no') NOT NULL DEFAULT 'no',
  `plantilla_correo_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estados_pedidos`
--

INSERT INTO `estados_pedidos` (`id`, `nombre`, `descripcion`, `notificacion_push`, `notificacion_correo`, `correos_destinatarios`, `no_asignacion_corte`, `asignacion_corte`, `pedido_entregado`, `plantilla_correo_id`, `created_at`, `updated_at`) VALUES
(8, 'Pendiente', 'Pedido pendiente por kit o flete', 'si', 'no', NULL, 'si', 'no', 'no', NULL, '2017-11-23 15:37:05', '2017-11-23 15:37:05'),
(9, 'En cola', 'Pedido en cola con corte', 'si', 'no', NULL, 'no', 'si', 'no', NULL, '2017-10-24 20:16:06', '2017-10-24 20:16:06'),
(11, 'Enviado', 'Enviado', 'no', 'no', NULL, 'no', 'no', 'no', NULL, '2017-11-08 14:47:44', '2017-11-08 14:47:44'),
(12, 'Entregado', 'Pedido entregado satisfactoriamente', 'no', 'si', 'jlcapote@misena.edu.co;jcapotem@sena.edu.co', 'no', 'no', 'si', 4, '2017-11-23 15:35:34', '2017-11-23 15:35:34'),
(13, 'Novedad', 'Pedido o guía con novedad registrada', 'no', 'si', 'jlcapote@misena.edu.co', 'no', 'no', 'no', 3, '2017-11-23 15:36:36', '2017-11-23 15:36:36'),
(14, 'Anulado soporte', 'Anulado soporte', 'no', 'no', NULL, 'no', 'no', 'no', NULL, '2017-12-07 19:48:58', '2017-12-07 19:48:58'),
(15, 'Anulado', 'Anulado', 'no', 'no', NULL, 'no', 'no', 'no', NULL, '2017-12-07 21:01:11', '2017-12-07 21:01:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_fletes`
--

CREATE TABLE `facturas_fletes` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(150) NOT NULL,
  `pedido_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_kits`
--

CREATE TABLE `facturas_kits` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(150) NOT NULL,
  `empresario_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones`
--

CREATE TABLE `funciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `identificador` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `funciones`
--

INSERT INTO `funciones` (`id`, `nombre`, `identificador`, `created_at`, `updated_at`) VALUES
(3, 'Crear', 1, '2017-09-01 00:32:36', '2017-09-01 00:32:36'),
(4, 'Editar', 2, '2017-09-01 00:32:44', '2017-09-01 00:32:44'),
(5, 'Eliminar', 3, '2017-09-01 00:32:54', '2017-09-01 00:32:54'),
(6, 'Ver', 4, '2017-09-01 00:32:59', '2017-09-01 00:32:59'),
(7, 'Uploads', 5, '2017-09-11 20:32:03', '2017-09-11 20:32:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guias`
--

CREATE TABLE `guias` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` text,
  `estado` enum('registrada','enviada','entregada') NOT NULL DEFAULT 'registrada',
  `foto_1` int(10) UNSIGNED DEFAULT NULL,
  `foto_2` int(10) UNSIGNED DEFAULT NULL,
  `malla_cobertura_id` int(10) UNSIGNED NOT NULL,
  `operador_logistico_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guias_pedidos`
--

CREATE TABLE `guias_pedidos` (
  `id` int(10) UNSIGNED NOT NULL,
  `guia_id` int(10) UNSIGNED NOT NULL,
  `pedido_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_estados_pedidos`
--

CREATE TABLE `historial_estados_pedidos` (
  `id` int(10) UNSIGNED NOT NULL,
  `pedido_id` int(10) UNSIGNED NOT NULL,
  `estado_pedido_id` int(10) UNSIGNED NOT NULL,
  `razon_estado` enum('Pendiente por productos','Pendiente por devolucion','Pendiente por kit','Pendiente por flete','Pendiente por pedido','Pendiente por numero de guía','Ingresado a bodega','Carga a SAP') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kit_empresarios`
--

CREATE TABLE `kit_empresarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `inicio` int(10) UNSIGNED NOT NULL,
  `fin` int(10) UNSIGNED NOT NULL,
  `excepciones` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mallas_cobertura`
--

CREATE TABLE `mallas_cobertura` (
  `id` int(10) UNSIGNED NOT NULL,
  `origen` varchar(150) NOT NULL,
  `destino` varchar(150) NOT NULL,
  `tiempo_entrega` int(10) UNSIGNED NOT NULL,
  `operador_logistico_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mallas_cobertura`
--

INSERT INTO `mallas_cobertura` (`id`, `origen`, `destino`, `tiempo_entrega`, `operador_logistico_id`, `created_at`, `updated_at`) VALUES
(1, 'BOGOTA', 'DEFECTO', 5, 2, '2017-11-22 18:28:52', '2017-11-22 18:28:52'),
(2, 'BOGOTA', 'GIRARDOT', 3, 1, '2017-11-24 16:02:42', '2017-11-24 16:02:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_09_11_155458_create_sessions_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(6, '2016_06_01_000004_create_oauth_clients_table', 2),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `identificador` int(11) NOT NULL,
  `etiqueta` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `nombre`, `identificador`, `etiqueta`, `url`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Módulos y funciones', 1, 'Módulos y funciones', '/modulos-funciones', 'Activo', '2017-08-31 20:02:23', '2017-09-01 01:02:23'),
(2, 'Roles', 2, 'Roles', '/rol', 'Activo', '2017-09-01 01:04:57', '2017-09-01 01:04:57'),
(3, 'Usuarios', 3, 'Usuarios', '/usuario', 'Activo', '2017-09-01 01:05:19', '2017-09-01 01:05:19'),
(4, 'Cortes', 4, 'Cortes', '/corte', 'Activo', '2017-10-18 19:27:48', '2017-10-18 19:27:48'),
(5, 'Bodega', 5, 'Bodega', '/bodega', 'Activo', '2017-10-17 13:45:52', '2017-10-17 13:45:52'),
(6, 'Empresario', 6, 'Empresario', '/empresario', 'Activo', '2017-10-17 21:59:18', '2017-10-17 21:59:18'),
(7, 'Operadores logisticos', 7, 'Operadores logísticos', '/operador-logistico', 'Activo', '2017-10-20 14:13:26', '2017-10-20 14:13:26'),
(8, 'Malla cobertura', 8, 'Malla de cobertura', '/malla-cobertura', 'Activo', '2017-10-20 23:03:07', '2017-10-20 23:03:07'),
(9, 'Plantillas de correo', 9, 'Plantillas de correo', '/plantilla-correo', 'Activo', '2017-10-23 14:26:10', '2017-10-23 14:26:10'),
(10, 'Estados de pedidos', 10, 'Estados de pedidos', '/estado-pedido', 'Activo', '2017-10-23 18:01:19', '2017-10-23 18:01:19'),
(11, 'Estados de operadores logisticos', 11, 'Estados de operadores logísticos', '/estado-operador-logistico', 'Activo', '2017-10-23 20:12:31', '2017-10-23 20:12:31'),
(12, 'Soporte a empresario', 12, 'Soporte a empresario', '/soporte-empresario', 'Activo', '2017-11-03 15:30:56', '2017-11-03 15:30:56'),
(13, 'Cargue a sap', 13, 'Cargue a sap', '/cargue-sap', 'Activo', '2017-11-28 20:03:51', '2017-11-28 20:03:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos_funciones`
--

CREATE TABLE `modulos_funciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `modulo_id` int(10) UNSIGNED NOT NULL,
  `funcion_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulos_funciones`
--

INSERT INTO `modulos_funciones` (`id`, `modulo_id`, `funcion_id`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 1, 5),
(4, 1, 6),
(5, 2, 3),
(6, 2, 4),
(7, 2, 5),
(8, 2, 6),
(9, 3, 3),
(11, 3, 5),
(12, 3, 6),
(13, 4, 3),
(15, 4, 5),
(16, 4, 6),
(18, 3, 4),
(19, 4, 7),
(20, 5, 3),
(21, 5, 4),
(22, 5, 6),
(23, 6, 3),
(24, 6, 4),
(25, 6, 5),
(26, 6, 6),
(27, 6, 7),
(28, 7, 3),
(29, 7, 4),
(30, 7, 6),
(31, 7, 5),
(32, 8, 3),
(33, 8, 4),
(34, 8, 5),
(35, 8, 7),
(36, 8, 6),
(37, 9, 3),
(38, 9, 4),
(39, 9, 5),
(40, 9, 6),
(41, 10, 3),
(42, 10, 4),
(43, 10, 5),
(44, 10, 6),
(45, 11, 3),
(46, 11, 4),
(47, 11, 5),
(48, 11, 6),
(49, 4, 4),
(50, 12, 6),
(51, 12, 4),
(52, 13, 6),
(53, 13, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombres_estados_operadores_logisticos`
--

CREATE TABLE `nombres_estados_operadores_logisticos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `operador_logistico_id` int(10) UNSIGNED NOT NULL,
  `estado_operador_logistico_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nombres_estados_operadores_logisticos`
--

INSERT INTO `nombres_estados_operadores_logisticos` (`id`, `nombre`, `operador_logistico_id`, `estado_operador_logistico_id`) VALUES
(2, 'novedad', 1, 2),
(3, 'novedad', 2, 2),
(4, 'novedad', 3, 2),
(9, 'EN PROCESAMIENTO', 2, 3),
(10, 'ENTR', 1, 1),
(11, 'ENTREGADO', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(3, 11, 'Prueba api', 'ohGN3IuuyFa48zsP6SxKsECFEQhbi24eKNodtEa2', 'http://192.168.0.101', 0, 1, 1, '2017-10-07 22:02:51', '2017-10-07 22:35:15'),
(5, 11, 'Prueba', 'MbjVKDcYpaLZBg8r2lcoUJN7fvinr4N0uv58mgoP', 'http://192.168.0.18:8000', 0, 1, 0, '2017-10-13 17:56:26', '2017-10-13 17:56:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 3, '2017-10-07 18:58:07', '2017-10-07 18:58:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('026282e3d0787e22f060233c0fc408afa79cbdd6b8f2080bd4ea26f3a01e3f9f7541132859150870', '7e99b84147740dad2932b7fa2b6d956b926bb7bf5794f4fa648af347cd58169fa7d6579a6cc9cd37', 0, '2018-10-13 14:03:34'),
('0f23529bf459925b2b98f755bd62d7bd054f215d0793c508b64245c8b3755ece7398f04a80b96237', 'ef7793566350f8fc70623a3ea0528c31a9426c6a4bcff21f53d58979b946363be5e47898f7b21821', 0, '2018-10-07 17:34:02'),
('247dbe2d7a01755d9f59c5860af3c33d17c570a82490c5c7742a63df21f5268069824789b5397ff5', '561ee8f033b8f8ac2f6e7e89cdee93c37242592a7d3593de14556e1779895c8f5166f8a06e01b20e', 0, '2018-10-13 14:45:57'),
('2cd61b99327ed237ea9aa3187eb2d43e3a7e25738d67203972b4a2da06c638e83f11f30fbc932d52', '694d39991fa9d064336bc28c92fe5734bab4b89593eba91e8794239496cd17c138780366f22b1039', 0, '2018-10-13 14:09:09'),
('3b78c6cab0a1f56e21ab768495cf6503f440e61b7f14ce88001d1eb03e6561b5d77900c0f2eec4e9', '636cb849597dc0942957eb345f226feb5a5ba16ccdba24320e424ff8b29d8a02de761c2b8a6ffcb5', 0, '2018-10-13 14:17:27'),
('4207e9b58695eb6583bf3a94fbd08544f91ebc8ad696d1da296b99fd971936b227cc033adb3d94e6', 'e50df7a7981d0459d65973d8acbe991c9b561895ea161b58e89b0c4ed69b1d9112c042daa2c4b16d', 0, '2018-10-13 14:13:51'),
('4e73b03686d6e001fffb5b4b87cd10a30424ecb49ef875a3979d9662a90a66a8e86de2a193a5ccb3', 'eee57c5a454adf3593f9655fd40c35dfe80bb544413ad2a14eb108dcfa8a11839ec2bc7696887ba8', 0, '2018-10-13 14:02:53'),
('67cccf30a91a2018bba8a4c957c97cdcd8007b1f86453c637f1e288aac819c03b558d45fcf56e0c7', 'b437eef59f8df28dd602ebef74f0e98e78d8e9d3f47280fc45c3675aafafbd3bf7dd43ac55cf4260', 0, '2018-10-13 14:04:16'),
('82ce62970612f715813bc3864c9e4f8ffaabea1d3bc28c2359177e3f4ec9ffeec2b98d2ec9ad51e6', '86e2b6bda2da7520c965fb05b6eaf4a7f014371197c745572e17c74c1ec43ffafff0d5e0d979a2d2', 0, '2018-10-13 14:03:03'),
('89294cde069c1730b3932e3ea96cd7ed9915b1e13a935dbf81539b8914c854f00efc35d21201266e', '9f0f0f2ad2a46fed47db981033fb01da3a4251bac80141fb4ba55a6a1ebf1f029789173309b3d04f', 0, '2018-10-13 14:59:44'),
('931fe4e7dfff2fe1d034df2f40e93cbd5952c3e5d28e63a6f8a4d2b8284231ac691797eb59ce1364', '9fd518d5893db58924ba1669e832debebf5a07044cc7e913fb3298349bbf032974547af1e9f3b2b8', 0, '2018-10-13 14:14:00'),
('9615adaf1c37248be6b3d2cac771fae462bc9f256ead8a393b6e681e5ca830e86af5b54008094898', '01170dfd7055ef05bc4e96cfa188810d5b89fea814d2a41ba59d649c4a93baf1676940cc2750b854', 0, '2018-10-13 13:01:10'),
('9bd039e40744f79f6f587ea132f5bd4c8eb9266d1171109941a070e6c52aebcc6401017a76151242', '44bf8ee6d0c7e07e18f0c4b0456e6976bd22634ac2acf80602ec1c459ea5c13c997175f0afe94740', 0, '2018-10-13 13:45:10'),
('9d48072c1f471b9aa656c85bb968badc1add5f55bae1f7d78d5cc4c829b8bbb27a877c9a5e380c36', '998803fc979ac0b85188a65ffbfe1c84a800ac95ecdfe1abe9063ed31dd494715f14b5d58caaee7f', 0, '2018-10-07 17:22:29'),
('a294032efb6eaef10f086829c066e6b00fa189c4885f2fd18eedcc166982a18317480cfe84b93753', '72b132ca085e5088db7bd5b895fd7fa195174e54a26922b8340c4833d08fd85517d3a5c8ef9155c4', 0, '2018-10-13 13:00:17'),
('a561e8f359434b47d776f5fb9c6d9b079a6bc98b158cba40018277544d3d31355860f1bbfd61fa88', '9825c06d9349605def39ab1cb79afa83c56e819fc5e4e982ad431a1b2888bc0661b89f9e5fdf9608', 0, '2018-10-13 14:03:20'),
('ac5e6dbafb3302af5e1dd8c4267016535acae50dd0e797cdccdc867f22e08bc3aff660c9d47d1f7d', '62bd1c658a968b83e1a772892038b5fff430ee5aa260616f2b319e23b2196b2ed5037fb7eace54f6', 0, '2018-10-13 13:59:03'),
('c15f3c69e6330c548939b117e1747264649375688640f3df9159a774ced86c66ec1b9504eea9142d', '7ebb700a512f656e8a652b12cd62fb5900ef0d864dde8b917ec0d21f579e29e2374c8ef3d106278d', 0, '2018-10-13 14:03:42'),
('ca53f238823508cee736a86245d5f605c0aaf86ec802df0b78e11be0b398ad2da9d58c3e18fea842', '05e5c9831a15bacd6ff04653525aa0078f5883bbfccec50bb2b852e411028b9f669dea076680ce14', 0, '2018-10-13 14:56:28'),
('d1e8479bf1c11e8e9a4c13fd2ac3b1060ddc642654180376b0acb430112f9fa9b99aa9ff5648e7d4', '5dff0388b98a06077a23ab44b7bbde3d390226a1421b2b0eff4da6586efed51cdb0ae40a2ff030c5', 0, '2018-10-13 14:30:53'),
('df021050dce19301480d3015263b4421c4a3892a4ebd9631425263248f3fadae1daf0a0dfaf588dd', '7fae4eb338f4c0f17c26dfb60fa305fdcef240f6440154c7ed0c87377715e666be761e9ca8f254eb', 0, '2018-10-13 14:11:51'),
('f23a43caf04e039ba169def4b979c8ce5fe06f7ff8db127cef9ba02475822246e35c9814919deb0b', '2b04d2d21858c3d1ee0779f3dae218f277f60dd40ed419438d40db247ec4e7c82ae569c29e8dbc56', 0, '2018-10-13 14:11:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operadores_logisticos`
--

CREATE TABLE `operadores_logisticos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `prefijo` varchar(20) DEFAULT NULL,
  `contacto` varchar(150) DEFAULT NULL,
  `ws` enum('si','no') NOT NULL DEFAULT 'no',
  `ubicacion_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `operadores_logisticos`
--

INSERT INTO `operadores_logisticos` (`id`, `nombre`, `prefijo`, `contacto`, `ws`, `ubicacion_id`, `created_at`, `updated_at`) VALUES
(1, 'Deprisa', 'DP', 'deprisa@deprisa.com', 'si', 2, '2017-10-25 18:56:08', '2017-10-25 18:56:08'),
(2, 'Servientrega', 'Sv', 'servientrega@servientrega.co', 'si', 3, '2017-10-25 21:07:48', '2017-10-25 21:07:48'),
(3, 'Domina', 'Dm', 'domina@domina.co', 'no', 4, '2017-10-25 21:08:32', '2017-10-25 21:08:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `codigo` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `nombre`, `codigo`) VALUES
(1, 'Colombia\r\n', '57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('jlcapote@misena.edu.co', '$2y$10$BXVIxYXPMAFXaBo43yO8oeT83w7L4kjktEW2m2TbpUnLZJ6ZjkRiO', '2017-11-24 21:14:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha_orden` date DEFAULT NULL,
  `fecha_impresion` date DEFAULT NULL,
  `serie` int(11) DEFAULT NULL,
  `correlativo` int(11) DEFAULT NULL,
  `orden_id` int(11) DEFAULT NULL,
  `impreso_por` varchar(150) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `total_tax` double DEFAULT NULL,
  `costo_envio` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `descuento` double DEFAULT '0',
  `tipo_pago` varchar(150) DEFAULT NULL,
  `volumen_comisionable` double DEFAULT NULL,
  `novedad` varchar(255) DEFAULT NULL,
  `empresario_id` int(10) UNSIGNED NOT NULL,
  `corte_id` int(10) UNSIGNED DEFAULT NULL,
  `corte_importacion_id` int(10) UNSIGNED NOT NULL,
  `bodega_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `cantidad` double DEFAULT NULL,
  `precio_unitario` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `pedido_id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantillas_correos`
--

CREATE TABLE `plantillas_correos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `asunto` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `plantillas_correos`
--

INSERT INTO `plantillas_correos` (`id`, `nombre`, `asunto`, `created_at`, `updated_at`) VALUES
(1, 'Pedido pendiente', 'Estado de pedido pendiente', '2017-10-24 19:57:35', '2017-10-24 19:57:35'),
(2, 'Pedido en cola', 'Estado de pedido en cola', '2017-10-24 19:57:55', '2017-10-24 19:57:55'),
(3, 'Novedad en pedido', 'Novedad en pedido', '2017-11-23 12:32:54', '2017-11-23 12:32:54'),
(4, 'Pedido entregado', 'Pedido entregado', '2017-11-23 15:34:51', '2017-11-23 15:34:51'),
(5, 'Pedido en procesamiento', 'Pedido en procesamiento', '2017-11-23 15:38:35', '2017-11-23 15:38:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_enviados`
--

CREATE TABLE `productos_enviados` (
  `id` int(10) UNSIGNED NOT NULL,
  `cantidad` double DEFAULT '0',
  `producto_id` int(10) UNSIGNED NOT NULL,
  `guia_pedido_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `superadministrador` enum('si','no') NOT NULL DEFAULT 'no',
  `nombre` varchar(100) NOT NULL,
  `privilegios` text,
  `empresarios` enum('si','no') DEFAULT 'no',
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `superadministrador`, `nombre`, `privilegios`, `empresarios`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'si', 'Superadministrador', NULL, 'no', NULL, '2017-08-31 14:08:41', '2017-08-31 14:08:41'),
(7, 'no', 'Empresario', '(10,4)', 'si', 81, '2017-12-05 00:29:24', '2017-12-05 00:29:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('AVJdlYVJm7Jgtx9WZNMxKHdSTzwj7Bjo0wjWxMa1', 81, '192.168.0.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSGRVdU1PamxrSFdxU1o5VTZQaHg3SEpoQzBkWmhZNXg2UjlraFAzbCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODE7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xOTIuMTY4LjAuMTAxOjgwMDAvc29wb3J0ZS1lbXByZXNhcmlvIjt9czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1512665266),
('xKROzDiwEA0cD6CYQE6Qt44sFkvPkPWpZy5fXdvZ', 81, '192.168.0.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic0JtRXNNRzI2TnZSdUlQb2NMUXpiNTd2Q2Jaa3JhNzVjTFdsV0U2aiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODE7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xOTIuMTY4LjAuMTAxOjgwMDAvc29wb3J0ZS1lbXByZXNhcmlvIjt9czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1512680516);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `calle` varchar(20) DEFAULT NULL,
  `carrera` varchar(20) DEFAULT NULL,
  `numero` varchar(20) NOT NULL,
  `barrio` varchar(250) NOT NULL,
  `especificaciones` varchar(250) DEFAULT NULL,
  `ciudad_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id`, `calle`, `carrera`, `numero`, `barrio`, `especificaciones`, `ciudad_id`) VALUES
(1, 'Avenida 19', NULL, '123-86', 'Santa Barbara', NULL, 524),
(2, '5', NULL, '100-45', 'Deprisa', NULL, 418),
(3, '15', NULL, '19-45', 'Servientrega', NULL, 524),
(4, '15', NULL, '15-15', 'Domina', NULL, 799);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_identificacion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identificacion` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombres` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` enum('masculino','femenino') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `token_fcm` text COLLATE utf8mb4_unicode_ci,
  `movil_id` int(11) DEFAULT NULL,
  `sesion_web` enum('si','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `sesion_fuxion_track` enum('si','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `sesion_fuxion_trax` enum('si','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `archivo_id` int(10) UNSIGNED DEFAULT NULL,
  `rol_id` int(10) UNSIGNED NOT NULL,
  `bodega_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `tipo_identificacion`, `identificacion`, `nombres`, `apellidos`, `telefono`, `fecha_nacimiento`, `email`, `genero`, `password`, `remember_token`, `token`, `token_fcm`, `movil_id`, `sesion_web`, `sesion_fuxion_track`, `sesion_fuxion_trax`, `archivo_id`, `rol_id`, `bodega_id`, `user_id`, `created_at`, `updated_at`) VALUES
(81, 'C.C', '11111111', 'Administrador', 'Fireos', '3209179277', '1997-01-13', 'josmos@fireos.com.co', 'masculino', '$2y$10$1ekQkkS.D6eNLbdTuQf43OOZKf2D/CXeERqwOBymkp9ofWAIE81Yq', 'z7F41B3m0l6z9HA2VOIzuVo3hvMC4g64dEZlCyJllwqYfRem2P6PJorBOk3E', NULL, NULL, NULL, 'si', 'no', 'no', NULL, 1, 1, NULL, '2017-12-05 00:19:12', '2017-12-07 12:55:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_correos`
--

CREATE TABLE `users_correos` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `correo_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_exigo`
--

CREATE TABLE `usuarios_exigo` (
  `id` int(11) NOT NULL,
  `nombre_exigo` varchar(70) NOT NULL,
  `nombre_impreso` varchar(120) NOT NULL,
  `codigo_almacen` int(11) DEFAULT NULL,
  `almacen` varchar(100) DEFAULT NULL,
  `serie` int(11) NOT NULL,
  `resolucion` varchar(50) NOT NULL,
  `fecha_resolucion` varchar(70) NOT NULL,
  `direccion_factura` varchar(250) NOT NULL,
  `rango_desde` varchar(20) NOT NULL,
  `rango_hasta` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios_exigo`
--

INSERT INTO `usuarios_exigo` (`id`, `nombre_exigo`, `nombre_impreso`, `codigo_almacen`, `almacen`, `serie`, `resolucion`, `fecha_resolucion`, `direccion_factura`, `rango_desde`, `rango_hasta`, `created_at`, `updated_at`) VALUES
(1, 'co_porozco', 'admin', 1058, 'S0058 - PASTO NARIÑO', 746, '18762003657544', '14/06/2017', 'CARRERA 19 No. 123-86 - BOGOTÁ', '1', '50000', '2017-11-02 19:31:34', NULL),
(2, 'co_porozco', 'admin', 1021, 'S0021 - BOGOTA', 723, '18762001629294', '21/12/2016', 'CARRERA 19 No. 123-86 - BOGOTÁ', '8493', '50000', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_estados_pedidos`
--
CREATE TABLE `v_estados_pedidos` (
`pedido_id` int(10) unsigned
,`fecha_orden` date
,`fecha_impresion` date
,`serie` int(11)
,`correlativo` int(11)
,`orden_id` int(11)
,`impreso_por` varchar(150)
,`subtotal` double
,`total_tax` double
,`costo_envio` double
,`total` double
,`descuento` double
,`tipo_pago` varchar(150)
,`volumen_comisionable` double
,`empresario_id` int(10) unsigned
,`corte_id` int(10) unsigned
,`bodega_id` int(10) unsigned
,`estado_pedido_id` int(10) unsigned
,`nombre` varchar(100)
,`descripcion` varchar(250)
,`notificacion_push` enum('si','no')
,`notificacion_correo` enum('si','no')
,`no_asignacion_corte` enum('si','no')
,`asignacion_corte` enum('si','no')
,`plantilla_correo_id` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_guias_pedidos_corte`
--
CREATE TABLE `v_guias_pedidos_corte` (
`pedido_id` int(10) unsigned
,`fecha_orden` date
,`fecha_impresion` date
,`serie` int(11)
,`correlativo` int(11)
,`orden_id` int(11)
,`impreso_por` varchar(150)
,`subtotal` double
,`total_tax` double
,`costo_envio` double
,`total` double
,`descuento` double
,`tipo_pago` varchar(150)
,`volumen_comisionable` double
,`empresario_id` int(10) unsigned
,`corte_id` int(10) unsigned
,`bodega_id` int(10) unsigned
,`numero_corte` int(10) unsigned
,`estado_corte` enum('transmitido','procesado','enviado')
,`guias_asignadas` enum('si','no')
,`user_id` int(10) unsigned
,`guia_pedido_id` int(10) unsigned
,`guia_id` int(10) unsigned
,`numero_guia` text
,`estado_guia` enum('registrada','enviada','entregada')
,`foto_1` int(10) unsigned
,`foto_2` int(10) unsigned
,`malla_cobertura_id` int(10) unsigned
,`operador_logistico_id` int(10) unsigned
,`ol_nombre` varchar(150)
,`ol_prefijo` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_historial_estados_pedido`
--
CREATE TABLE `v_historial_estados_pedido` (
`fecha_orden` date
,`fecha_impresion` date
,`serie` int(11)
,`correlativo` int(11)
,`orden_id` int(11)
,`impreso_por` varchar(150)
,`subtotal` double
,`total_tax` double
,`costo_envio` double
,`total` double
,`descuento` double
,`tipo_pago` varchar(150)
,`volumen_comisionable` double
,`empresario_id` int(10) unsigned
,`corte_id` int(10) unsigned
,`bodega_id` int(10) unsigned
,`fecha_creacion_pedido` timestamp
,`estado_pedido_id` int(10) unsigned
,`nombre` varchar(100)
,`descripcion` varchar(250)
,`notificacion_push` enum('si','no')
,`notificacion_correo` enum('si','no')
,`no_asignacion_corte` enum('si','no')
,`asignacion_corte` enum('si','no')
,`plantilla_correo_id` int(10) unsigned
,`historial_estado_pedido_id` int(10) unsigned
,`pedido_id` int(10) unsigned
,`razon_estado` enum('Pendiente por productos','Pendiente por devolucion','Pendiente por kit','Pendiente por flete','Pendiente por pedido','Pendiente por numero de guía','Ingresado a bodega','Carga a SAP')
,`fecha_creacion_historial` timestamp
,`numero` int(10) unsigned
,`estado` enum('transmitido','procesado','enviado')
,`guias_asignadas` enum('si','no')
,`user_id` int(10) unsigned
,`fecha_creacion_corte` timestamp
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_pedidos_productos`
--
CREATE TABLE `v_pedidos_productos` (
`pedido_id` int(10) unsigned
,`fecha_orden` date
,`fecha_impresion` date
,`serie` int(11)
,`correlativo` int(11)
,`orden_id` int(11)
,`impreso_por` varchar(150)
,`subtotal` double
,`total_tax` double
,`costo_envio` double
,`total_pedidos` double
,`descuento` double
,`tipo_pago` varchar(150)
,`volumen_comisionable` double
,`empresario_id` int(10) unsigned
,`corte_id` int(10) unsigned
,`bodega_id` int(10) unsigned
,`producto_id` int(10) unsigned
,`codigo` varchar(50)
,`descripcion` varchar(250)
,`cantidad` double
,`precio_unitario` double
,`total_pedido_productos` double
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_productos_enviados`
--
CREATE TABLE `v_productos_enviados` (
`pedido_id` int(10) unsigned
,`fecha_orden` date
,`fecha_impresion` date
,`serie` int(11)
,`correlativo` int(11)
,`orden_id` int(11)
,`impreso_por` varchar(150)
,`subtotal` double
,`total_tax` double
,`costo_envio` double
,`total` double
,`descuento` double
,`tipo_pago` varchar(150)
,`volumen_comisionable` double
,`empresario_id` int(10) unsigned
,`corte_id` int(10) unsigned
,`bodega_id` int(10) unsigned
,`numero_guia` text
,`estado_guia` enum('registrada','enviada','entregada')
,`foto_1` int(10) unsigned
,`foto_2` int(10) unsigned
,`malla_cobertura_id` int(10) unsigned
,`operador_logistico_id` int(10) unsigned
,`cantidad` double
,`producto_id` int(10) unsigned
,`codigo` varchar(50)
,`descripcion` varchar(250)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_estados_pedidos`
--
DROP TABLE IF EXISTS `v_estados_pedidos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_estados_pedidos`  AS  select `p`.`id` AS `pedido_id`,`p`.`fecha_orden` AS `fecha_orden`,`p`.`fecha_impresion` AS `fecha_impresion`,`p`.`serie` AS `serie`,`p`.`correlativo` AS `correlativo`,`p`.`orden_id` AS `orden_id`,`p`.`impreso_por` AS `impreso_por`,`p`.`subtotal` AS `subtotal`,`p`.`total_tax` AS `total_tax`,`p`.`costo_envio` AS `costo_envio`,`p`.`total` AS `total`,`p`.`descuento` AS `descuento`,`p`.`tipo_pago` AS `tipo_pago`,`p`.`volumen_comisionable` AS `volumen_comisionable`,`p`.`empresario_id` AS `empresario_id`,`p`.`corte_id` AS `corte_id`,`p`.`bodega_id` AS `bodega_id`,`ep`.`id` AS `estado_pedido_id`,`ep`.`nombre` AS `nombre`,`ep`.`descripcion` AS `descripcion`,`ep`.`notificacion_push` AS `notificacion_push`,`ep`.`notificacion_correo` AS `notificacion_correo`,`ep`.`no_asignacion_corte` AS `no_asignacion_corte`,`ep`.`asignacion_corte` AS `asignacion_corte`,`ep`.`plantilla_correo_id` AS `plantilla_correo_id` from ((`pedidos` `p` join `historial_estados_pedidos` `he` on((`he`.`pedido_id` = `p`.`id`))) join `estados_pedidos` `ep` on((`he`.`estado_pedido_id` = `ep`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_guias_pedidos_corte`
--
DROP TABLE IF EXISTS `v_guias_pedidos_corte`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_guias_pedidos_corte`  AS  select `p`.`id` AS `pedido_id`,`p`.`fecha_orden` AS `fecha_orden`,`p`.`fecha_impresion` AS `fecha_impresion`,`p`.`serie` AS `serie`,`p`.`correlativo` AS `correlativo`,`p`.`orden_id` AS `orden_id`,`p`.`impreso_por` AS `impreso_por`,`p`.`subtotal` AS `subtotal`,`p`.`total_tax` AS `total_tax`,`p`.`costo_envio` AS `costo_envio`,`p`.`total` AS `total`,`p`.`descuento` AS `descuento`,`p`.`tipo_pago` AS `tipo_pago`,`p`.`volumen_comisionable` AS `volumen_comisionable`,`p`.`empresario_id` AS `empresario_id`,`p`.`corte_id` AS `corte_id`,`p`.`bodega_id` AS `bodega_id`,`c`.`numero` AS `numero_corte`,`c`.`estado` AS `estado_corte`,`c`.`guias_asignadas` AS `guias_asignadas`,`c`.`user_id` AS `user_id`,`gp`.`id` AS `guia_pedido_id`,`g`.`id` AS `guia_id`,`g`.`numero` AS `numero_guia`,`g`.`estado` AS `estado_guia`,`g`.`foto_1` AS `foto_1`,`g`.`foto_2` AS `foto_2`,`g`.`malla_cobertura_id` AS `malla_cobertura_id`,`g`.`operador_logistico_id` AS `operador_logistico_id`,`op`.`nombre` AS `ol_nombre`,`op`.`prefijo` AS `ol_prefijo` from ((((`pedidos` `p` join `guias_pedidos` `gp` on((`p`.`id` = `gp`.`pedido_id`))) join `guias` `g` on((`gp`.`guia_id` = `g`.`id`))) left join `operadores_logisticos` `op` on((`g`.`operador_logistico_id` = `op`.`id`))) left join `cortes` `c` on((`p`.`corte_id` = `c`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_historial_estados_pedido`
--
DROP TABLE IF EXISTS `v_historial_estados_pedido`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_historial_estados_pedido`  AS  select `p`.`fecha_orden` AS `fecha_orden`,`p`.`fecha_impresion` AS `fecha_impresion`,`p`.`serie` AS `serie`,`p`.`correlativo` AS `correlativo`,`p`.`orden_id` AS `orden_id`,`p`.`impreso_por` AS `impreso_por`,`p`.`subtotal` AS `subtotal`,`p`.`total_tax` AS `total_tax`,`p`.`costo_envio` AS `costo_envio`,`p`.`total` AS `total`,`p`.`descuento` AS `descuento`,`p`.`tipo_pago` AS `tipo_pago`,`p`.`volumen_comisionable` AS `volumen_comisionable`,`p`.`empresario_id` AS `empresario_id`,`p`.`corte_id` AS `corte_id`,`p`.`bodega_id` AS `bodega_id`,`p`.`created_at` AS `fecha_creacion_pedido`,`ep`.`id` AS `estado_pedido_id`,`ep`.`nombre` AS `nombre`,`ep`.`descripcion` AS `descripcion`,`ep`.`notificacion_push` AS `notificacion_push`,`ep`.`notificacion_correo` AS `notificacion_correo`,`ep`.`no_asignacion_corte` AS `no_asignacion_corte`,`ep`.`asignacion_corte` AS `asignacion_corte`,`ep`.`plantilla_correo_id` AS `plantilla_correo_id`,`hep`.`id` AS `historial_estado_pedido_id`,`hep`.`pedido_id` AS `pedido_id`,`hep`.`razon_estado` AS `razon_estado`,`hep`.`created_at` AS `fecha_creacion_historial`,`c`.`numero` AS `numero`,`c`.`estado` AS `estado`,`c`.`guias_asignadas` AS `guias_asignadas`,`c`.`user_id` AS `user_id`,`c`.`created_at` AS `fecha_creacion_corte` from (((`historial_estados_pedidos` `hep` join `estados_pedidos` `ep` on((`hep`.`estado_pedido_id` = `ep`.`id`))) join `pedidos` `p` on((`hep`.`pedido_id` = `p`.`id`))) left join `cortes` `c` on((`p`.`corte_id` = `c`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_pedidos_productos`
--
DROP TABLE IF EXISTS `v_pedidos_productos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pedidos_productos`  AS  select `p`.`id` AS `pedido_id`,`p`.`fecha_orden` AS `fecha_orden`,`p`.`fecha_impresion` AS `fecha_impresion`,`p`.`serie` AS `serie`,`p`.`correlativo` AS `correlativo`,`p`.`orden_id` AS `orden_id`,`p`.`impreso_por` AS `impreso_por`,`p`.`subtotal` AS `subtotal`,`p`.`total_tax` AS `total_tax`,`p`.`costo_envio` AS `costo_envio`,`p`.`total` AS `total_pedidos`,`p`.`descuento` AS `descuento`,`p`.`tipo_pago` AS `tipo_pago`,`p`.`volumen_comisionable` AS `volumen_comisionable`,`p`.`empresario_id` AS `empresario_id`,`p`.`corte_id` AS `corte_id`,`p`.`bodega_id` AS `bodega_id`,`pd`.`id` AS `producto_id`,`pd`.`codigo` AS `codigo`,`pd`.`descripcion` AS `descripcion`,`pp`.`cantidad` AS `cantidad`,`pp`.`precio_unitario` AS `precio_unitario`,`pp`.`total` AS `total_pedido_productos` from ((`pedidos` `p` join `pedidos_productos` `pp` on((`p`.`id` = `pp`.`pedido_id`))) join `productos` `pd` on((`pp`.`producto_id` = `pd`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_productos_enviados`
--
DROP TABLE IF EXISTS `v_productos_enviados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_productos_enviados`  AS  select `p`.`id` AS `pedido_id`,`p`.`fecha_orden` AS `fecha_orden`,`p`.`fecha_impresion` AS `fecha_impresion`,`p`.`serie` AS `serie`,`p`.`correlativo` AS `correlativo`,`p`.`orden_id` AS `orden_id`,`p`.`impreso_por` AS `impreso_por`,`p`.`subtotal` AS `subtotal`,`p`.`total_tax` AS `total_tax`,`p`.`costo_envio` AS `costo_envio`,`p`.`total` AS `total`,`p`.`descuento` AS `descuento`,`p`.`tipo_pago` AS `tipo_pago`,`p`.`volumen_comisionable` AS `volumen_comisionable`,`p`.`empresario_id` AS `empresario_id`,`p`.`corte_id` AS `corte_id`,`p`.`bodega_id` AS `bodega_id`,`g`.`numero` AS `numero_guia`,`g`.`estado` AS `estado_guia`,`g`.`foto_1` AS `foto_1`,`g`.`foto_2` AS `foto_2`,`g`.`malla_cobertura_id` AS `malla_cobertura_id`,`g`.`operador_logistico_id` AS `operador_logistico_id`,`pe`.`cantidad` AS `cantidad`,`pe`.`producto_id` AS `producto_id`,`pd`.`codigo` AS `codigo`,`pd`.`descripcion` AS `descripcion` from ((((`pedidos` `p` join `guias_pedidos` `gp` on((`p`.`id` = `gp`.`pedido_id`))) join `guias` `g` on((`gp`.`guia_id` = `g`.`id`))) join `productos_enviados` `pe` on((`gp`.`id` = `pe`.`guia_pedido_id`))) join `productos` `pd` on((`pe`.`producto_id` = `pd`.`id`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias_UNIQUE` (`alias`),
  ADD UNIQUE KEY `prefijo_facturacion_UNIQUE` (`prefijo_facturacion`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  ADD KEY `fk_bodegas_ubicaciones1_idx` (`ubicacion_id`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ciudades_departamentos1_idx` (`departamento_id`);

--
-- Indices de la tabla `correos`
--
ALTER TABLE `correos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_correos_plantillas_correos1_idx` (`plantilla_correo_id`);

--
-- Indices de la tabla `cortes`
--
ALTER TABLE `cortes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_importaciones_users1_idx` (`user_id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_departamentos_paises1_idx` (`pais_id`);

--
-- Indices de la tabla `empresarios`
--
ALTER TABLE `empresarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clientes_users1_idx` (`user_id`);

--
-- Indices de la tabla `estados_guias_operadores_logisticos`
--
ALTER TABLE `estados_guias_operadores_logisticos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estados_guias_operadores_logisticos_guias1_idx` (`guia_id`),
  ADD KEY `fk_estados_guias_operadores_logisticos_nombres_estados_oper_idx` (`nombre_estado_operador_logistico_id`);

--
-- Indices de la tabla `estados_operadores_logisticos`
--
ALTER TABLE `estados_operadores_logisticos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estados_operadores_logisticos_estados_pedidos1_idx` (`cambio_estado_pedido_id`),
  ADD KEY `fk_estados_operadores_logisticos_plantillas_correos1_idx` (`plantilla_correo_id`);

--
-- Indices de la tabla `estados_pedidos`
--
ALTER TABLE `estados_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  ADD KEY `fk_estados_pedidos_plantillas_correos1_idx` (`plantilla_correo_id`);

--
-- Indices de la tabla `facturas_fletes`
--
ALTER TABLE `facturas_fletes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_facturas_flete_pedidos1_idx` (`pedido_id`);

--
-- Indices de la tabla `facturas_kits`
--
ALTER TABLE `facturas_kits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_facturas_kits_empresarios1_idx` (`empresario_id`);

--
-- Indices de la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `guias`
--
ALTER TABLE `guias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_guias_mallas_cobertura1_idx` (`malla_cobertura_id`),
  ADD KEY `fk_guias_operadores_logisticos1_idx` (`operador_logistico_id`),
  ADD KEY `fk_guias_archivos1_idx` (`foto_1`),
  ADD KEY `fk_guias_archivos2_idx` (`foto_2`);

--
-- Indices de la tabla `guias_pedidos`
--
ALTER TABLE `guias_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_guias_has_pedidos_pedidos1_idx` (`pedido_id`),
  ADD KEY `fk_guias_has_pedidos_guias1_idx` (`guia_id`);

--
-- Indices de la tabla `historial_estados_pedidos`
--
ALTER TABLE `historial_estados_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estados_pedidos_has_pedidos_pedidos1_idx` (`pedido_id`),
  ADD KEY `fk_historial_estados_pedidos_estados_pedidos1_idx` (`estado_pedido_id`);

--
-- Indices de la tabla `kit_empresarios`
--
ALTER TABLE `kit_empresarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inicio_UNIQUE` (`inicio`),
  ADD UNIQUE KEY `fin_UNIQUE` (`fin`);

--
-- Indices de la tabla `mallas_cobertura`
--
ALTER TABLE `mallas_cobertura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mallas_cobertura_operadores_logisticos1_idx` (`operador_logistico_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos_funciones`
--
ALTER TABLE `modulos_funciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_modulos_has_funciones_funciones1_idx` (`funcion_id`),
  ADD KEY `fk_modulos_has_funciones_modulos1_idx` (`modulo_id`);

--
-- Indices de la tabla `nombres_estados_operadores_logisticos`
--
ALTER TABLE `nombres_estados_operadores_logisticos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_operadores_logisticos_has_estados_operadores_logisticos__idx` (`estado_operador_logistico_id`),
  ADD KEY `fk_operadores_logisticos_has_estados_operadores_logisticos__idx1` (`operador_logistico_id`);

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indices de la tabla `operadores_logisticos`
--
ALTER TABLE `operadores_logisticos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_operdores_logicos_ubicaciones1_idx` (`ubicacion_id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orden_id_UNIQUE` (`orden_id`),
  ADD KEY `fk_ordenes_clientes1_idx` (`empresario_id`),
  ADD KEY `fk_ordenes_importaciones1_idx` (`corte_id`),
  ADD KEY `fk_pedidos_bodegas1_idx` (`bodega_id`),
  ADD KEY `fk_pedidos_cortes1_idx` (`corte_importacion_id`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ordenes_has_items_items1_idx` (`producto_id`),
  ADD KEY `fk_ordenes_has_items_ordenes1_idx` (`pedido_id`);

--
-- Indices de la tabla `plantillas_correos`
--
ALTER TABLE `plantillas_correos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_enviados`
--
ALTER TABLE `productos_enviados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_envios_productos1_idx` (`producto_id`),
  ADD KEY `fk_envios_guias_pedidos1_idx` (`guia_pedido_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_roles_users1_idx` (`user_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ubicaciones_ciudades1_idx` (`ciudad_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_identificacion_unique` (`identificacion`),
  ADD KEY `fk_users_roles1_idx` (`rol_id`),
  ADD KEY `fk_users_users1_idx` (`user_id`),
  ADD KEY `fk_users_archivos1_idx` (`archivo_id`),
  ADD KEY `fk_users_bodegas1_idx` (`bodega_id`);

--
-- Indices de la tabla `users_correos`
--
ALTER TABLE `users_correos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_has_correos_correos1_idx` (`correo_id`),
  ADD KEY `fk_users_has_correos_users1_idx` (`user_id`);

--
-- Indices de la tabla `usuarios_exigo`
--
ALTER TABLE `usuarios_exigo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombre_exigo` (`nombre_exigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1113;
--
-- AUTO_INCREMENT de la tabla `correos`
--
ALTER TABLE `correos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT de la tabla `cortes`
--
ALTER TABLE `cortes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `empresarios`
--
ALTER TABLE `empresarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `estados_guias_operadores_logisticos`
--
ALTER TABLE `estados_guias_operadores_logisticos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estados_operadores_logisticos`
--
ALTER TABLE `estados_operadores_logisticos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `estados_pedidos`
--
ALTER TABLE `estados_pedidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `facturas_fletes`
--
ALTER TABLE `facturas_fletes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `facturas_kits`
--
ALTER TABLE `facturas_kits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `funciones`
--
ALTER TABLE `funciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `guias`
--
ALTER TABLE `guias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `guias_pedidos`
--
ALTER TABLE `guias_pedidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `historial_estados_pedidos`
--
ALTER TABLE `historial_estados_pedidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `kit_empresarios`
--
ALTER TABLE `kit_empresarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mallas_cobertura`
--
ALTER TABLE `mallas_cobertura`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `modulos_funciones`
--
ALTER TABLE `modulos_funciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT de la tabla `nombres_estados_operadores_logisticos`
--
ALTER TABLE `nombres_estados_operadores_logisticos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `operadores_logisticos`
--
ALTER TABLE `operadores_logisticos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT de la tabla `plantillas_correos`
--
ALTER TABLE `plantillas_correos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `productos_enviados`
--
ALTER TABLE `productos_enviados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT de la tabla `users_correos`
--
ALTER TABLE `users_correos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `usuarios_exigo`
--
ALTER TABLE `usuarios_exigo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bodegas`
--
ALTER TABLE `bodegas`
  ADD CONSTRAINT `fk_bodegas_ubicaciones1` FOREIGN KEY (`ubicacion_id`) REFERENCES `ubicaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `fk_ciudades_departamentos1` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `correos`
--
ALTER TABLE `correos`
  ADD CONSTRAINT `fk_correos_plantillas_correos1` FOREIGN KEY (`plantilla_correo_id`) REFERENCES `plantillas_correos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cortes`
--
ALTER TABLE `cortes`
  ADD CONSTRAINT `fk_importaciones_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `fk_departamentos_paises1` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empresarios`
--
ALTER TABLE `empresarios`
  ADD CONSTRAINT `fk_clientes_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estados_guias_operadores_logisticos`
--
ALTER TABLE `estados_guias_operadores_logisticos`
  ADD CONSTRAINT `fk_estados_guias_operadores_logisticos_guias1` FOREIGN KEY (`guia_id`) REFERENCES `guias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_estados_guias_operadores_logisticos_nombres_estados_operad1` FOREIGN KEY (`nombre_estado_operador_logistico_id`) REFERENCES `nombres_estados_operadores_logisticos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estados_operadores_logisticos`
--
ALTER TABLE `estados_operadores_logisticos`
  ADD CONSTRAINT `fk_estados_operadores_logisticos_estados_pedidos1` FOREIGN KEY (`cambio_estado_pedido_id`) REFERENCES `estados_pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_estados_operadores_logisticos_plantillas_correos1` FOREIGN KEY (`plantilla_correo_id`) REFERENCES `plantillas_correos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `estados_pedidos`
--
ALTER TABLE `estados_pedidos`
  ADD CONSTRAINT `fk_estados_pedidos_plantillas_correos1` FOREIGN KEY (`plantilla_correo_id`) REFERENCES `plantillas_correos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `facturas_fletes`
--
ALTER TABLE `facturas_fletes`
  ADD CONSTRAINT `fk_facturas_flete_pedidos1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas_kits`
--
ALTER TABLE `facturas_kits`
  ADD CONSTRAINT `fk_facturas_kits_empresarios1` FOREIGN KEY (`empresario_id`) REFERENCES `empresarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `guias`
--
ALTER TABLE `guias`
  ADD CONSTRAINT `fk_guias_archivos1` FOREIGN KEY (`foto_1`) REFERENCES `archivos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_guias_archivos2` FOREIGN KEY (`foto_2`) REFERENCES `archivos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_guias_mallas_cobertura1` FOREIGN KEY (`malla_cobertura_id`) REFERENCES `mallas_cobertura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_guias_operadores_logisticos1` FOREIGN KEY (`operador_logistico_id`) REFERENCES `operadores_logisticos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `guias_pedidos`
--
ALTER TABLE `guias_pedidos`
  ADD CONSTRAINT `fk_guias_has_pedidos_guias1` FOREIGN KEY (`guia_id`) REFERENCES `guias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_guias_has_pedidos_pedidos1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_estados_pedidos`
--
ALTER TABLE `historial_estados_pedidos`
  ADD CONSTRAINT `fk_estados_pedidos_has_pedidos_pedidos1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_historial_estados_pedidos_estados_pedidos1` FOREIGN KEY (`estado_pedido_id`) REFERENCES `estados_pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mallas_cobertura`
--
ALTER TABLE `mallas_cobertura`
  ADD CONSTRAINT `fk_mallas_cobertura_operadores_logisticos1` FOREIGN KEY (`operador_logistico_id`) REFERENCES `operadores_logisticos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `modulos_funciones`
--
ALTER TABLE `modulos_funciones`
  ADD CONSTRAINT `fk_modulos_has_funciones_funciones1` FOREIGN KEY (`funcion_id`) REFERENCES `funciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_modulos_has_funciones_modulos1` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nombres_estados_operadores_logisticos`
--
ALTER TABLE `nombres_estados_operadores_logisticos`
  ADD CONSTRAINT `fk_operadores_logisticos_has_estados_operadores_logisticos_es1` FOREIGN KEY (`estado_operador_logistico_id`) REFERENCES `estados_operadores_logisticos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_operadores_logisticos_has_estados_operadores_logisticos_op1` FOREIGN KEY (`operador_logistico_id`) REFERENCES `operadores_logisticos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `operadores_logisticos`
--
ALTER TABLE `operadores_logisticos`
  ADD CONSTRAINT `fk_operdores_logicos_ubicaciones1` FOREIGN KEY (`ubicacion_id`) REFERENCES `ubicaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_ordenes_clientes1` FOREIGN KEY (`empresario_id`) REFERENCES `empresarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ordenes_importaciones1` FOREIGN KEY (`corte_id`) REFERENCES `cortes` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_pedidos_bodegas1` FOREIGN KEY (`bodega_id`) REFERENCES `bodegas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pedidos_cortes1` FOREIGN KEY (`corte_importacion_id`) REFERENCES `cortes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD CONSTRAINT `fk_ordenes_has_items_items1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ordenes_has_items_ordenes1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos_enviados`
--
ALTER TABLE `productos_enviados`
  ADD CONSTRAINT `fk_envios_guias_pedidos1` FOREIGN KEY (`guia_pedido_id`) REFERENCES `guias_pedidos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_envios_productos1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `fk_roles_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD CONSTRAINT `fk_ubicaciones_ciudades1` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_archivos1` FOREIGN KEY (`archivo_id`) REFERENCES `archivos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_bodegas1` FOREIGN KEY (`bodega_id`) REFERENCES `bodegas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_roles1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_correos`
--
ALTER TABLE `users_correos`
  ADD CONSTRAINT `fk_users_has_correos_correos1` FOREIGN KEY (`correo_id`) REFERENCES `correos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_has_correos_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
