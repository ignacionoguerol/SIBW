-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-05-2017 a las 19:53:24
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Periodico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id-noticia` int(11) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `texto` text NOT NULL,
  `fecha` datetime NOT NULL,
  `ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id-noticia`, `usuario`, `correo`, `texto`, `fecha`, `ip`) VALUES
(1, 'carlos2', 'carlitos@gmail.com', 'No me gusta la noticia :( .', '2017-04-11 06:18:39', '192.168.0.1'),
(1, 'pepe1', 'pepe@gmail.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '2017-02-22 09:00:41', '127.168.0.1'),
(2, 'pepe1', 'pepe@gmail.com', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-04-04 00:43:00', '127.168.0.1'),
(3, 'pepe1', 'pepe@gmail.com', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-04-04 00:43:00', '127.168.0.1'),
(4, 'carlos2', 'pepe@gmail.com', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-04-28 00:00:00', '127.168.0.1'),
(5, 'pepe1', 'pepe@gmail.com', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-04-04 00:43:00', '127.168.0.1'),
(6, 'pepe1', 'pepe@gmail.com', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-04-04 00:43:00', '127.168.0.1'),
(7, 'pepe1', 'pepe@gmail.com', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-04-04 00:43:00', '127.168.0.1'),
(8, 'pepe1', 'pepe@gmail.com', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-04-04 00:43:00', '127.168.0.1'),
(9, 'pepe1', 'pepe@gmail.com', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-04-04 00:43:00', '127.168.0.1'),
(10, 'pepe1', 'pepe@gmail.com', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-04-04 00:43:00', '127.168.0.1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editor`
--

CREATE TABLE `editor` (
  `editor` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Editor-jefe` int(11) NOT NULL DEFAULT '0',
  `email` varchar(30) NOT NULL,
  `contraseña` varchar(30) NOT NULL,
  `nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `editor`
--

INSERT INTO `editor` (`editor`, `Editor-jefe`, `email`, `contraseña`, `nombre`) VALUES
('editor1', 0, 'editor1@editor.es', 'editor1', 'Editor Numero 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editor-noticia`
--

CREATE TABLE `editor-noticia` (
  `id-noticia` int(11) NOT NULL,
  `editor` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `editor-noticia`
--

INSERT INTO `editor-noticia` (`id-noticia`, `editor`) VALUES
(1, 'editor1'),
(2, 'editor1'),
(3, 'editor1'),
(4, 'editor1'),
(5, 'editor1'),
(6, 'editor1'),
(7, 'editor1'),
(8, 'editor1'),
(9, 'editor1'),
(10, 'editor1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filtro`
--

CREATE TABLE `filtro` (
  `palabra` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `filtro`
--

INSERT INTO `filtro` (`palabra`) VALUES
('cabron'),
('estupido'),
('mierda'),
('puta'),
('tonto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id-imagen` int(11) NOT NULL,
  `id-noticia` int(11) NOT NULL,
  `url` text NOT NULL,
  `texto` varchar(60) NOT NULL,
  `autor` varchar(60) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id-imagen`, `id-noticia`, `url`, `texto`, `autor`, `fecha`) VALUES
(1, 1, 'images/noticia1-1.jpg', 'Descripción', 'Carlos Pérez', '2016-12-07 13:16:39'),
(1, 2, 'images/noticia2-1.jpg', 'Descripción', 'Carlos Pérez', '2016-12-07 13:16:39'),
(1, 3, 'images/noticia3-1.jpg', 'Descripción', 'Carlos Pérez', '2016-12-07 13:16:39'),
(1, 4, 'images/noticia4-1.jpg', 'Descripción', 'Carlos Pérez', '2016-12-07 13:16:39'),
(1, 5, 'images/noticia5-1.jpg', 'Descripción', 'Carlos Pérez', '2016-12-07 13:16:39'),
(1, 6, 'images/noticia6-1.jpg', 'Descripción', 'Carlos Pérez', '2016-12-07 13:16:39'),
(1, 7, 'images/noticia7-1.jpg', 'Descripción', 'Carlos Pérez', '2016-12-07 13:16:39'),
(1, 8, 'images/noticia8-1.jpg', 'Descripción', 'Carlos Pérez', '2016-12-07 13:16:39'),
(1, 9, 'images/noticia9-1.jpg\n', 'Descripción', 'Carlos Pérez', '2016-12-07 13:16:39'),
(1, 10, 'images/noticia10-1.jpg', 'Descripción', 'Carlos Pérez', '2016-12-07 13:16:39'),
(2, 1, 'images/noticia1-2.jpg', 'Descripción', 'Raúl López', '2017-04-19 03:12:27'),
(2, 2, 'images/noticia2-2.jpg', 'Descripción', 'Raúl López', '2017-04-19 03:12:27'),
(2, 5, 'images/noticia5-2.jpg', 'Descripción', 'Raúl López', '2017-04-19 03:12:27'),
(2, 7, 'images/noticia7-2.jpg', 'Descripción', 'Raúl López', '2017-04-19 03:12:27'),
(2, 9, 'images/noticia9-2.jpg', 'Descripción', 'Raúl López', '2017-04-19 03:12:27'),
(2, 10, 'images/noticia10-2.jpg', 'Descripción', 'Raúl López', '2017-04-19 03:12:27'),
(3, 1, 'images/noticia1-3.jpg', 'Descripción', 'Raúl López', '2017-04-19 03:12:27'),
(3, 2, 'images/noticia2-3.jpg', 'Descripción', 'Raúl López', '2017-04-19 03:12:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id-noticia` int(11) NOT NULL,
  `titular` varchar(120) NOT NULL,
  `resumen` text NOT NULL,
  `texto` text NOT NULL,
  `autor` varchar(60) NOT NULL,
  `publicacion` datetime NOT NULL,
  `ultima-modificacion` datetime DEFAULT NULL,
  `visitas` int(11) NOT NULL,
  `video` text CHARACTER SET utf8 NOT NULL,
  `Estado` int(11) NOT NULL DEFAULT '1',
  `Orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id-noticia`, `titular`, `resumen`, `texto`, `autor`, `publicacion`, `ultima-modificacion`, `visitas`, `video`, `Estado`, `Orden`) VALUES
(1, 'Robots con sustancia gris', 'El equipo de neurorobótica de Eduardo Ros avanza en la gran investigación europea sobre el cerebro humano con máquinas cada vez mejor inspiradas en la naturaleza y en la biología.', 'Un robot actual, construido como modelo del cerebro humano y su sistema nervioso, puede estar inventado entre un 60 y un 70%, pues se basa sólo en hipótesis del funcionamiento biológico. No es de extrañar, por tanto, que el camino a recorrer para obtener máquinas capaces de interactuar con los humanos sea aún largo. Un equipo de investigadores de la Universidad de Granada lleva algunos años trabajando en el gran proyecto europeo para descubrir los entresijos del cerebro humano mediante la creación de robots biológicamente inspirados. El equipo del catedrático Eduardo Ros (Departamento de Arquitectura y Tecnología de Computadores) ha dado un salto importante con la incorporación reciente de una bioquímica. Milagros Marín tiene una función prometedora en este grupo de expertos en computación, que es conseguir que los modelos robóticos sean \"más plausibles desde el punto de vista biológico\", según explicó Ros, que lleva gran parte de su prestigiosa carrera como investigador tratando de hacer máquinas que tengan un comportamiento similar al humano. \"Antes copiábamos el funcionamiento del cerebro en los libros, luego accedimos a colaboraciones internacionales y ahora hemos dado un paso más, que es la incorporación al equipo de gente de otras disciplinas\", explicó el responsable del Laboratorio de Neurorobótica de la UGR.\n\nLa aportación de esta nueva investigadora permitirá al grupo saber mejor cómo resuelve la biología las cosas que ellos programan. La incorporación en el mismo grupo de trabajo es fundamental para hacer una investigación más interdisciplinar y fluida. No obstante, hasta ahora el equipo ha colaborado con muchos especialistas de diferentes lugares del mundo. \"Para mí es igual de fácil, o incluso más, colaborar con un investigador de Cambridge que con otro que está en el PTS (Parque Tecnológico de Ciencias de la Salud), yo busco al que más sabe\", explicó Ros, que tiene más colaboradores en el extranjero que en su entorno más cercano. Pero todo esto les sirve para conocer cosas muy concretas sobre temas muy especializados que controlan algunos de los mejores estudiosos de una materia. La incorporación de personas de otras disciplinas próximas a la biología en el mismo equipo aporta una visión más amplia de conjunto sobre el funcionamiento real de un cerebro. Esos trabajos interdisciplinares son actualmente el modelo a seguir en investigación, pero los especialistas lamentan que, en España, el sistema implantado no solo no lo fomenta, si no que incluso penaliza a los investigadores por tener en su curriculum varias afinidades. \"Dicen que hay que hacer investigación interdisciplinar pero en la práctica es complicado porque no siempre el sistema puede encajar a esos profesionales\", explicó Ros, quien también reconoce que en cada disciplina hay un lenguaje propio y unas particularidades que a veces dificultan el intercambio de información.\n\nEsta experiencia del grupo de Eduardo Ros es un ejemplo en ciernes (pues esperan un desarrollo mayor con más colaboraciones) de ese trabajo en común. \"Biología y robótica son campos diferentes y nosotros estamos tratando de unir puentes\", agregó el investigador. La Comisión Europea financia con mil millones de euros una gran investigación sobre el cerebro humano, el HBP (Human Brain Project). Es una de sus apuestas más ambiciosas, porque a diferencia de un proyecto estándar de 3 o 4 años, la idea es mantener los trabajos durante una década e implicar a más de un centenar de grupos de investigación de toda Europa. La clave es la conexión entre todos ellos para que los conocimientos adquiridos se vayan sumando y no desperdigando. Entre las áreas en las que se dividió este gran proyecto está la neurorobótica, que es donde se incluye el trabajo del equipo de la Universidad de Granada. Ellos trabajaban hace años con mecanismos propios. Su primera herramienta fue un brazo creado con los elementos de una fotocopiadora, luego crearon el Frankebot, que era un robot con piezas de reciclaje, como una antena o un paraguas... Pero el trabajo con este tipo de instrumentos no podía llevarles muy lejos, según Ros, \"porque nadie podía repetir nuestros experimentos en otro lugar del mundo\". Por eso comenzaron a trabajar con los actuales robots, que son modelos estandarizados. O son máquinas compradas para trabajar en su programación o se usa a distancia la robótica ubicada en Munich como plataforma común para todos los miembros de este proyecto de investigación.Esta experiencia del grupo de Eduardo Ros es un ejemplo en ciernes (pues esperan un desarrollo mayor con más colaboraciones) de ese trabajo en común. \"Biología y robótica son campos diferentes y nosotros estamos tratando de unir puentes\", agregó el investigador. La Comisión Europea financia con mil millones de euros una gran investigación sobre el cerebro humano, el HBP (Human Brain Project). Es una de sus apuestas más ambiciosas, porque a diferencia de un proyecto estándar de 3 o 4 años, la idea es mantener los trabajos durante una década e implicar a más de un centenar de grupos de investigación de toda Europa. La clave es la conexión entre todos ellos para que los conocimientos adquiridos se vayan sumando y no desperdigando. Entre las áreas en las que se dividió este gran proyecto está la neurorobótica, que es donde se incluye el trabajo del equipo de la Universidad de Granada. Ellos trabajaban hace años con mecanismos propios. Su primera herramienta fue un brazo creado con los elementos de una fotocopiadora, luego crearon el Frankebot, que era un robot con piezas de reciclaje, como una antena o un paraguas... Pero el trabajo con este tipo de instrumentos no podía llevarles muy lejos, según Ros, \"porque nadie podía repetir nuestros experimentos en otro lugar del mundo\". Por eso comenzaron a trabajar con los actuales robots, que son modelos estandarizados. O son máquinas compradas para trabajar en su programación o se usa a distancia la robótica ubicada en Munich como plataforma común para todos los miembros de este proyecto de investigación.', 'Manuel Rodríguez Álvares', '2017-04-04 08:21:23', '2017-04-04 08:21:23', 0, 'https://www.youtube.com/embed/6nES8epVcSs', 1, 0),
(2, 'El 5G y la Robótica son los nuevos \'inquilinos\' de la Mobile World Congress', 'Como siempre, el sector de la telefonía móvil saca de su armario sus mejores trajes de galas para lucir ante el resto del mundo las nuevas innovaciones que aparecerán progresivamente en el mercado. La Robótica y el 5G serán los grandes atractivos del congreso.', 'La tecnología se afinca en Barcelona entre el 27 de febrero y 2 de marzo. El llamado Internet de las Cosas o el ‘Big Data’ es una realidad y las grandes empresas vuelcan sus esfuerzos en convertir el mundo que nos rodea en uno conectado. Por eso, coches que se conducen solos, realidad virtual o inteligencia artificial, además de mucho teléfono móvil, serán los protagonistas del Mobile World Congress. Más de 2.000 empresas aterrizan en la Ciudad Condal para presentar sus novedades. Pero también habrá numerosas caras conocidas. Marck Zuckerberg será el invitado estrella, y otros protagonistas que han irrumpido con fuerza en el 2016 también pisarán la moqueta. El consejero delegado de Netflix, Reed Hastings o John Hanke, fundador de la empresa creadora de Pokemon Go, acudirán a la cita mundial.\n\nLa edición de este año del Mobile World Congress (MWC), que se celebrará entre este lunes y el jueves en Barcelona, batirá un nuevo récord de asistencia, con 95.000 congresistas, que se calcula que generarán un impacto económico en la ciudad de 380 millones de euros y contribuirán a crear 7.220 empleos temporales.\nLos hoteles de la capital catalana colgarán el cartel de completo durante la celebración del congreso, ya que solo la GSMA -la asociación de la industria móvil impulsora del evento- ha reservado 25.000 de las 36.000 habitaciones de la ciudad, a un precio medio de 230 euros. Sin embargo, el Gremio de Hoteles estima que las reservas de las 11.000 habitaciones restantes serán las que harán aumentar el precio medio global, ya que la organización cuenta con precios pactados.\n\nComo avanzábamos antes, las nuevas tecnologías se hacen un hueco en este ‘monstruo’. Atrás queda el protagonismo de las operadoras de telecomunicaciones. La Robótica inundará los stands de la feria catalana con la inteligencia artificial y la realidad virtual por bandera.\nEl 5G será otro de los actores principales. Aun que aún queda mucha carretera por conducir, el sector de la telefonía y tecnología se prepara poco a poco para ofrecer al usuario una banda tremendamente rápida y con unas prestaciones sensacionales. Sin ir más lejos, el pasado viernes se aprobaba en el Consejo de Ministros el nuevo espectro radioeléctrico para la implantación progresiva del 5G. Los teléfonos serán, como siempre, un acierto asegurado y las pantallas más grandes se podrán ver en todos los stands.La tecnología se afinca en Barcelona entre el 27 de febrero y 2 de marzo. El llamado Internet de las Cosas o el ‘Big Data’ es una realidad y las grandes empresas vuelcan sus esfuerzos en convertir el mundo que nos rodea en uno conectado. Por eso, coches que se conducen solos, realidad virtual o inteligencia artificial, además de mucho teléfono móvil, serán los protagonistas del Mobile World Congress. Más de 2.000 empresas aterrizan en la Ciudad Condal para presentar sus novedades. Pero también habrá numerosas caras conocidas. Marck Zuckerberg será el invitado estrella, y otros protagonistas que han irrumpido con fuerza en el 2016 también pisarán la moqueta. El consejero delegado de Netflix, Reed Hastings o John Hanke, fundador de la empresa creadora de Pokemon Go, acudirán a la cita mundial.\n\nLa edición de este año del Mobile World Congress (MWC), que se celebrará entre este lunes y el jueves en Barcelona, batirá un nuevo récord de asistencia, con 95.000 congresistas, que se calcula que generarán un impacto económico en la ciudad de 380 millones de euros y contribuirán a crear 7.220 empleos temporales.\nLos hoteles de la capital catalana colgarán el cartel de completo durante la celebración del congreso, ya que solo la GSMA -la asociación de la industria móvil impulsora del evento- ha reservado 25.000 de las 36.000 habitaciones de la ciudad, a un precio medio de 230 euros. Sin embargo, el Gremio de Hoteles estima que las reservas de las 11.000 habitaciones restantes serán las que harán aumentar el precio medio global, ya que la organización cuenta con precios pactados.\n\nComo avanzábamos antes, las nuevas tecnologías se hacen un hueco en este ‘monstruo’. Atrás queda el protagonismo de las operadoras de telecomunicaciones. La Robótica inundará los stands de la feria catalana con la inteligencia artificial y la realidad virtual por bandera.\nEl 5G será otro de los actores principales. Aun que aún queda mucha carretera por conducir, el sector de la telefonía y tecnología se prepara poco a poco para ofrecer al usuario una banda tremendamente rápida y con unas prestaciones sensacionales. Sin ir más lejos, el pasado viernes se aprobaba en el Consejo de Ministros el nuevo espectro radioeléctrico para la implantación progresiva del 5G. Los teléfonos serán, como siempre, un acierto asegurado y las pantallas más grandes se podrán ver en todos los stands.', 'Carlos Rodríguez Cozar', '2017-04-04 08:24:24', '2017-04-04 08:24:24', 10, '', 1, 0),
(3, '\'Handle\', el sorprendente robot de Boston Dynamics que salta y mantiene el equilibrio con sólo dos ruedas', 'Ya se había filtrado a inicios de este mes de febrero, pero no ha sido hasta hoy que Boston Dynamics está saliendo a anunciar el que se está posicionando como el robot más impresionante que han desarrollado hasta la fecha.', 'Ya se había filtrado a inicios de este mes de febrero, pero no ha sido hasta hoy que Boston Dynamics está saliendo a anunciar el que se está posicionando como el robot más impresionante que han desarrollado hasta la fecha. Nos referimos a \'Handle\', un robot que usa ruedas en las patas, salta y además mantiene el equilibrio.\nEn aquella presentación filtrada, Handle formaba parte de un vídeo junto al resto de los desarrollos de la compañía, donde el objetivo era mostrar el portafolio de productos a un grupo de inversores. Es así como sólo conocimos el aspecto de Handle y parte de lo que sabe hacer, pero nada más. Hoy Boston Dynamics nos lo muestra en un vídeo con mejor calidad y nos explica algunos detalles de este impresionante robot.\n\nA diferencia del resto de sus robots con dos o cuatro extremidades, Handle se destaca por traer un nuevo diseño de donde se destacan un par de ruedas en las patas, con las que es capaz de girar en su propio eje o de forma cerrada, bajar escaleras o colinas, incluso si éstas están nevadas. Pero lo más impresionante es su capacidad de equilibrio, ya que cuenta con su propio estabilizador que hace que cada rueda funcione de forma independiente sin importar las condiciones del terreno.\nTodas estas características le permiten saltar mientras está en movimiento, superar los obstáculos y seguir su camino sin problemas. Tiene un tamaño de 1,98 metros y es capaz de saltar hasta 1,22 metros. Lo mejor es verlo en acción en el siguiente vídeo.\n\nHandle es completamente eléctrico y con una carga completa es capaz de recorrer hasta 25 kilómetros. Su velocidad máxima es de 14,5 km/h y su diseño recoge lo mejor de los principios de dinámica y equilibrio de sus hermanos bípedos y cuadrúpedos. Está equipado con actuadores hidráulicos y eléctricos, pero a diferencia de los otros robots que ha creado Boston Dynamics, Handle sólo posee con 10 juntas que dan todo el movimiento a sus extremidades.\nSegún Boston Dynamics, Handle es el robot más fácil de construir que han desarrollado, esto permite que su coste esté muy por debajo del resto de sus robots, pero sus tareas y operación lo hacen incluso más eficiente para ciertos entornos. Sin embargo, aún no hay planes de comercialización o una producción a gran escala, ya que Handle, como el resto de sus hermanos, son hasta el momento robots con fines de investigación y desarrollo.Ya se había filtrado a inicios de este mes de febrero, pero no ha sido hasta hoy que Boston Dynamics está saliendo a anunciar el que se está posicionando como el robot más impresionante que han desarrollado hasta la fecha. Nos referimos a \'Handle\', un robot que usa ruedas en las patas, salta y además mantiene el equilibrio.\nEn aquella presentación filtrada, Handle formaba parte de un vídeo junto al resto de los desarrollos de la compañía, donde el objetivo era mostrar el portafolio de productos a un grupo de inversores. Es así como sólo conocimos el aspecto de Handle y parte de lo que sabe hacer, pero nada más. Hoy Boston Dynamics nos lo muestra en un vídeo con mejor calidad y nos explica algunos detalles de este impresionante robot.\n\nA diferencia del resto de sus robots con dos o cuatro extremidades, Handle se destaca por traer un nuevo diseño de donde se destacan un par de ruedas en las patas, con las que es capaz de girar en su propio eje o de forma cerrada, bajar escaleras o colinas, incluso si éstas están nevadas. Pero lo más impresionante es su capacidad de equilibrio, ya que cuenta con su propio estabilizador que hace que cada rueda funcione de forma independiente sin importar las condiciones del terreno.\nTodas estas características le permiten saltar mientras está en movimiento, superar los obstáculos y seguir su camino sin problemas. Tiene un tamaño de 1,98 metros y es capaz de saltar hasta 1,22 metros. Lo mejor es verlo en acción en el siguiente vídeo.\n\nHandle es completamente eléctrico y con una carga completa es capaz de recorrer hasta 25 kilómetros. Su velocidad máxima es de 14,5 km/h y su diseño recoge lo mejor de los principios de dinámica y equilibrio de sus hermanos bípedos y cuadrúpedos. Está equipado con actuadores hidráulicos y eléctricos, pero a diferencia de los otros robots que ha creado Boston Dynamics, Handle sólo posee con 10 juntas que dan todo el movimiento a sus extremidades.\nSegún Boston Dynamics, Handle es el robot más fácil de construir que han desarrollado, esto permite que su coste esté muy por debajo del resto de sus robots, pero sus tareas y operación lo hacen incluso más eficiente para ciertos entornos. Sin embargo, aún no hay planes de comercialización o una producción a gran escala, ya que Handle, como el resto de sus hermanos, son hasta el momento robots con fines de investigación y desarrollo.', 'Raúl Álvarez', '2017-04-13 04:23:48', '2017-04-13 04:23:48', 20, '', 1, 0),
(4, '\"La robótica excederá al campo tecnológico\"', 'Francisco Javier Rodríguez es el director de la Escuela Superior de Ingeniería Informática del campus de Ourense. Se trata de un centro que cumple 25 años y que, más allá de su función docente, ha sido capaz de apadrinar interesantes proyectos empresariales con un amplio recorrido.', 'Un cuarto de siglo después, ¿se puede decir que la Facultad creció pese a las desconfianzas iniciales?\r\n\r\nYo, personalmente, desconocía que hubiese desconfianzas iniciales. Evidentemente, la respuesta es afirmativa, la Escuela ha crecido y somos referencia en el ámbito de las tecnologías de la información y la comunicación en Galicia (TIC).\r\n\r\n¿Está siendo una factoría de talento?\r\n\r\nSi, por supuesto. Sobre todo, yo recalcaría el punto de vista de que nuestras titulaciones representan conocimientos y competencias en Ingeniería Informática, que como toda ingeniería, necesita de talento para proponer soluciones inteligentes y creativas a problemas de toda índole puesto que podemos encontrar software en todos los ámbitos de la vida. Se cifra en más de un 90% la colocación laboral de los graduados.\r\n\r\n¿Es común a todas las facultades o hay un plus en Ourense?\r\n\r\nLos últimos informes aún dan valores de inserción laboral mayores que esas cifras que me comentas. Es una cifra común a todas las Escuelas de Ingeniería en Informática de España dada las necesidades del mercado de las tecnologías de la información y la comunicación.\r\n\r\n¿Absorben las empresas gallegas los titulados o muchos de ellos se van fuera? \r\n\r\nLa mayoría de nuestras tituladas y titulados comienzan a trabajar en empresas gallegas del sector. También existe vocación de búsqueda de salidas profesionales en entornos más dinámicos económicamente como pueden ser Madrid, Barcelona, Suiza, Dublín o Londres donde los sueldos son mayores dada la escasez de perfiles TIC.\r\n\r\n¿Está bien conectada la facultad con los centros tecnológicos?\r\n\r\nSí. Además de trabajar con el centro de investigación propio del Campus de Ourense, el CITI, muchos de nuestros docentes colaboran en proyectos de investigación con centros de investigación como el CINBIO, Centro de investigación Biomédica, el Centro Tecnológico Aeroespacial, el de la automoción CTAG o el de Supercomputación de Galicia CESGA, entre otros.\r\n\r\n¿Estamos ante graduados con iniciativa empresarial o solo pensando en trabajar por cuenta ajena?\r\n\r\nPorcentualmente el mercado va a absorber más trabajadores por cuenta ajena. Sin embargo, dadas las nuevas iniciativas de emprendimiento y startups que nos rodean se nota un incremento de las consultas en ese sentido y de proyectos propios en el ámbito empresarial de base tecnológica.\r\n\r\n¿Ha apadrinado la facultad muchos proyectos empresariales que nacieron de sus alumnos?\r\n\r\nNo sabría decirte si son muchos o pocos, pero sí que sé que existen y son empresas de referencia en lo suyo. Tenemos ejemplos muy conocidos en nuestro entorno que han contado con nuestros titulados como socios iniciales. Se me ocurren directamente nombres como Redegal, Ideit, Origami, Pintega, Openhost, Alia, MeigaLabs, Servipay entre otras muchas.\r\n\r\n¿Qué opina de las investigacionestecnológicas en el campo de la robótica? ¿Cómo nos condicionarán?\r\n\r\nEs un campo apasionante en el que ya contamos en nuestro centro con grupos\r\nde investigación trabajando en cuestiones como Lenguaje Natural, Inteligencia Artificial o Aprendizaje Máquina (Machine Learning). Como sociedad tendremos que adaptarnos a los nuevos entornos de colaboración y cooperación con robots tanto físicos como de software. Evidentemente se prevé una revolución que excederá el propio campo de la tecnología\r\ny nos adentrará en otros aspectos como la renta básica o la ética en las máquinas.\r\n\r\n¿Tiene que competir el centro con otros que imparten la misma titulación?\r\n\r\nEn el ámbito universitario gallego existe una preferencia del alumno que es de marcado carácter geográfico y que se ha agravado con la crisis dado que para las familias el esfuerzo\r\nde que estudien sus hijos fuera de casa es mucho mayor. Respondiéndote más en concreto,\r\na la vista del número de solicitudes iniciales tras selectividad nuestro centro excede con creces el número de plazas disponibles lo que lleva a pensar que en ese aspecto no tenemos competencia.', 'ANTONIO NESPEREIRA', '2017-04-21 17:44:45', '2017-04-21 17:44:45', 40, 'https://www.youtube.com/embed/ceI9hFl04MM', 1, 0),
(5, 'Entrevista a Luis Mollinedo sobre el presente y el futuro de la robótica.', 'Luis Mollinedo Herrera, ingeniero de proyecto en GMV Aeroespace and Defense. Este ingeniero especializado en Robótica y Aviónica es uno de los responsables del desarrollo del robot FOXIRIS, un robot autónomo destinado a trabajar en plataformas petrolíferas y de gas repartidas por el mundo.', 'Luis Mollinedo Herrera, ingeniero de proyecto en GMV Aeroespace and Defense. Este ingeniero especializado en Robótica y Aviónica es uno de los responsables del desarrollo del robot FOXIRIS, un robot autónomo destinado a trabajar en plataformas petrolíferas y de gas repartidas por el mundo. Ha participado además en importantes proyectos tanto a nivel nacional como internacional, y en numerosos artículos sobre la robótica y automática. Luis Mollinedo Herrera es sin lugar a dudas uno de los nombres propios del sector robótico en España.\r\n\r\n foxiris– ¿Cuáles son los principales proyectos en los que has participado?\r\n\r\nHe tenido la suerte de participar en importantes proyectos a lo largo de mi carrera profesional.\r\n\r\nSin duda uno de los más importantes y que recuerdo con especial cariño es el proyecto platform-art© (Advanced Robotic Testbed for Orbital and Planetary Systems and Operations Testing). Este fue el primer proyecto en el que participé en GMV como becario en 2007. Este proyecto, debido a la proyección que se le quiere dar y a la gran repercusión mediática que suscita, es sin duda uno de los más importantes.\r\n\r\nOtra gran proyecto en el que he tenido la suerte de participar es el proyecto RAT (Rover Autonomy Test-Bed) de la ESA. RAT nos permitió llegar a un punto de mayor madurez ya que tuvimos la oportunidad de aprender y mejorar en muchas disciplinas.\r\n\r\nPero sin duda, para mí personalmente el proyecto más importante ha sido FOXIRIS: Este proyecto desde el principio fue una apuesta personal. Y es que desde un primer  momento consideré que en GMV teníamos las capacidades tanto técnicas como personales para desarrollar este tipo de proyectos.\r\n\r\nFOXIRIS es un proyecto en el que he tenido la oportunidad de participar junto a un gran equipo de compañeros, al que estoy muy agradecido por su dedicación. Pero aún con todo el esfuerzo que nos está costando, la experiencia que se está consiguiendo y todas las nuevas vías de trabajo que está abriendo demuestra que vale la pena. FOXIRIS, a día de hoy, nos permite aprender tecnologías y técnicas que no podríamos aplicar si no estuviéramos participando en este tipo de proyectos.\r\n\r\nAdemás, en el proyecto FOXIRIS he tenido la oportunidad de ser el líder técnico, algo de lo que me siento especialmente satisfecho; una posición que espero poder mantener en los siguientes proyectos que se basen en la tecnología desarrollada en FOXIRIS.', 'Guillermo Maruenda Vilchez', '2017-02-13 10:25:27', '2017-02-13 10:25:27', 15, '', 1, 0),
(6, 'Estudiantes de Cedar Hill ganan concurso con un bastón robótico', '¿Qué se supone que hacen los ingenieros? Resolver problemas.\r\nEso es lo que el profesor Edward Lie de la escuela secundaria Bessie Coleman les dice a sus alumnos, y luego les pide escoger un problema que una persona tenga todos los días y hacer algo para solucionarlo.', 'Cuatro integrantes del club de robótica de esta escuela de Cedar Hill aceptaron el reto e inventaron un bastón robot para las personas invidentes que vibra y hace ruido cuando se aproxima a un obstáculo.\r\n\r\n“Estuvimos discutiendo ideas entre todos y nos decidimos por esta”, dijo la capitán del equipo Carah Allen, de séptimo grado.\r\n\r\nEl Panopticane (o bastón panóptico le dio al equipo Gotta Blast! el primer lugar en la competencia regional de robótica celebrado en Richardson en enero. “Panóptico” significa “que ofrece una vista panorámica”, según el diccionario.\r\n\r\nSu victoria les aseguró el boleto a la competencia estatal esta primavera.\r\n\r\nHecho con un kit de robótica Lego, el bastón tiene un motor y un sensor capaz de detectar objetos desde una distancia de 50 pulgadas, una pantalla táctil y una batería recargable.\r\n\r\n“Su primera idea fue un perro robot que todo lo ve”, dijo Lie, profesor de computación de tercer grado en Bessie Coleman.\r\n\r\n“Entre más se sumergieron en el proyecto, se percataron de que la idea era muy complicada; pero pensaron que aun así podían trabajar en el concepto”.\r\n\r\nEl club de robótica de la escuela tiene apenas dos años, y Carah y su compañera de clases Ayzlin Sikes empezaron desde abajo.\r\n\r\nCon su invento del año pasado, el Nag-Bot 2.0 —un bote de basura que emite un ruido chillante cuando se llena de más—, ganaron el segundo lugar en el regional y su primer viaje al concurso estatal.\r\n\r\n“El estatal fue muy estimulante porque no pensábamos que fuéramos a llegar hasta ahí”, dijo Ayzlin. “En el regional estábamos en shock”.\r\n\r\nAl equipo no le fue tan bien en el estatal el año pasado, “pero eso no me importó mucho porque se trataba de dos niñas que prácticamente no habían tocado un kit de robótica antes de entrar al club”, dijo Lie.\r\n\r\nSe apuntan otros dos\r\n\r\nAhora Carah y Ayzlin —inseparables, como dice Lie— han incorporado al equipo a Brandon Blanco, de octavo, y Kevin Sulco, de sexto.\r\n\r\nEste año el grupo registró el Panopticane en la categoría de inventos intermedios y sus más fuertes competidores fueron los de Village Tech, una escuela charter de Cedar Hill que fue representada por dos equipos en el regional.\r\n\r\n“Cuando anunciaron que el segundo lugar era para Village Tech, creimos que el otro equipo de ellos se quedaría con el primer lugar”, dijo Carah.\r\n\r\nPero Brandon se apresuró a echar abajo ese mal presentimiento.\r\n\r\n“Cuando oimos el nombre de Village Tech, Brandon dijo: ‘Dejen de pensar negativo; piensen positivo’”, relató Kevin.\r\n\r\nBrandon le resta importancia a ese detalle.\r\n\r\n“Simplemente sentía que íbamos a ganar”, dice.\r\n\r\nUn portal a STEAM\r\n\r\nLie y el director de Bessie Coleman, Jason Miller, quieren que el club de robótica sirva como puerta de entrada a la Academia de Ingeniería y Ciencias Ambientales de la escuela, que empezará a operar en el ciclo escolar 2017-2018 con 50 alumnos en sexto y otros tantos en séptimo.\r\n\r\nLa otra secundaria de Cedar Hill, Permenter, abrirá su Academia de Emprendimiento y Diseño con el mismo número de estudiantes y requisitos de admisión, e implica reuniones y entrevistas obligatorias con los padres.\r\n\r\n“Los niños como estos piensan diferente”, dijo Miller, quien como Lie lleva tres años en la escuela.\r\n\r\n“A veces se exasperan, pero porque cuestionan las cosas, y nosotros tenemos que amoldarnos a ellos. Tenemos que dejarlos asumir riesgos”.\r\n\r\nEstos proyectos de secundaria son parte de lo que el superintendente de Cedar Hill, Orlando Riddick, ve como un plan STEAM incipiente a lo largo de su distrito, un régimen de ciencias, tecnología, ingeniería, matemáticas y artes que, reconoció, ya se había tardado.\r\n\r\n“Al principios solo nos enfocamos a las matemáticas y ciencias duras sin considerarlo dentro de un plan de estudios total y abarcador”, dijo Riddick.\r\n\r\n“Tuvimos una junta con los padres donde les dijimos a qué queríamos darle prioridad, y uno de ellos se levantó y dijo que no habíamos entregado lo que dijimos que entregaríamos”.\r\n\r\n“Bueno, eso me corresponde. Soy el que está aquí, así que es mi problema. Todavía no acabamos de hacer la transformación, pero ese es el objetivo”.\r\n\r\nEl equipo Gotta Blast tardó dos meses en armar el Panopticane; Carah y Brandon se hicieron cargo de la programación y Kevin y Ayzlin del montaje.\r\n\r\nNinguno del equipo conoce a nadie que tenga problemas de la vista.\r\n\r\n“Bueno, yo uso lentes”, dijo Carah.', 'LLOYD BRUMFIELD', '2017-05-11 22:55:54', '2017-05-11 22:55:54', 7, '', 1, 0),
(7, 'La robótica quiere acabar con las sillas de ruedas', 'La tecnología hace posible que las personas con discapacidades motoras puedan empezar a soñar. Existen prototipos de exoesqueletos capaces de levantar de la silla de ruedas al paciente e incluso hacer que puedan andar. Estos sistemas tienen limitaciones (necesitan bastones y avanzan de forma lenta), pero, como todas las tecnologías, mejorarán.', 'La feria Global Robot Expo 2017 reunió este mes en Madrid algunos de los proyectos más relevantes del mundo en la materia. Destaca entre ellos el modelo desarrollado por la compañía japonesa Cyberdryne, una referencia mundial en robótica. El sistema ideado por el equipo del doctor Yoshiyuki Sankai no solo cuenta con mecanismos notablemente más ligeros y pequeños que otros, sino que sus movimientos son guiados por la mente. El software de su modelo HAL es capaz de leer a través de sensores los estímulos mandados por el cerebro a las piernas y traducirlos en movimientos mecánicos. Las aplicaciones de este revolucionario ingenio no solo son médicas: existe una versión pensada para ayudar a las personas que lo usen a cargar peso y realizar tareas peligrosas.\r\n\r\nEn España también hay proyectos que tratan de sacar modelos de exoesqueletos biónicos. Marsi Bionics, por ejemplo, una spin-off del CSIC, mostró en la feria una versión para niños. “Hemos hecho pruebas clínicas en el Hospital San Juan de Dios con siete niños diagnosticados de atrofia muscular espinal (AME)”, explica uno de los miembros del equipo. Pensados para rehabilitar las funciones musculares, las baterías del prototipo, por el que “ya han mostrado interés algunos hospitales”, duran unas cinco horas.\r\n\r\nEl Grupo de Ingeniería Neuronal y Cognitiva (GNEC), creado también en el CSIC, y el Instituto de Biomecánica de Valencia cuentan con su propio prototipo, CPWalker, una plataforma diseñada para dar soporte a técnicas de rehabilitación para personas que sufran parálisis cerebral. Su diseño es más aparatoso que los anteriores, en tanto que se trata de un proyecto todavía experimental.\r\n\r\nGogoa Mobility Robots, por su parte, una empresa europea nacida como spin-off del Instituto Cajal (también del CSIC) y del Hospital Nacional de Parapléjicos de Toledo, presentó tres modelos de exoesqueletos, cada uno de ellos diseñado para contribuir en la rehabilitación de una parte distinta del cuerpo, siempre para quienes hayan sufrido parálisis. Así, cuentan con un modelo con forma de guante para trabajar los músculos de la mano y dos versiones de exoesqueletos completos capaces de levantar a una persona de 100 kilos de hasta 1,95 metros de altura.', 'Manuel González Pascual', '2017-01-03 04:39:07', '2017-01-03 04:39:07', 13, '', 1, 0),
(8, 'La robótica en automóviles y salud genera nuevas oportunidades de negocio en ciberseguridad', 'El Instituto Nacional de Ciberseguridad (INCIBE) destaca que la robótica aplicada a automóviles y la salud serán unas de las grandes oportunidades de negocio en ciberseguridad para este año 2017.', 'El mapa de tendencias en ciberseguridad, elaborado y publicado por INCIBE, contempla como oportunidades de negocio empresarial la ciberseguridad en sistemas de control industrial, la protección de redes industriales inteligentes, así como la seguridad en las redes de distribución eléctrica inteligente (Smart Grids).\r\n\r\nAsí se desprende del mapa de tendencias de mercado en ciberseguridad, publicado por el propio Instituto, y adaptado a oportunidades concretas de negocio empresarial. En consonancia con el Programa Europeo Horizonte 2020, las nuevas tendencias TIC estarían vinculadas a actividades como la robótica y sistemas autónomos aplicados a la industria avanzada de los automóviles, la salud y la logística; computación avanzada y cloud computing entre otras.\r\n\r\nEntre las previsiones de ciberamenazas para este año 2017, destaca la continuidad de los ataques basados en malware, destinado a la filtración de información y datos, principalmente de empresas, instituciones o gobiernos; las denegaciones de servicio por motivos políticos, geográficos o empresariales; el hacktivismo social y nuevos ciberataques a infraestructuras y operadores críticos. En el ámbito de la sanidad y farmacia, las oportunidades estarán vinculadas a la protección de dispositivos médicos conectados, el cifrado para la investigación médica y farmacéutica o el almacenamiento seguro y ubicuo de datos médicos. Esto va a provocar que las organizaciones tengan que incrementar la inversión que llevan a cabo en sus proyectos de ciberseguridad.\r\n\r\nPara hacernos una idea de las cifras que mueve el ciberterrorismo, a lo largo del pasado año, el CERTSI, operado por INCIBE, llegó a atender a más de 115.000 incidentes de ciberseguridad, de los cuales, 110.544 tenían como objetivo las empresas y los ciudadanos.', 'Pepe Sanchez Sanchez', '2016-09-08 04:36:57', '2016-09-08 04:36:57', 16, '', 1, 0),
(9, 'Darwin, el robot que mejora las sesiones de fisioterapia de los niños con parálisis', 'La robótica da para todo y para todos. Los autómatas están ganando terreno y en el área de la salud los resultados son sorprendentes.', 'La robótica da para todo y para todos. Los autómatas están ganando terreno y en el área de la salud los resultados son sorprendentes. En esta oportunidad te presentamos a Darwin, el robot fisioterapeuta para niños con parálisis cerebral.\r\n\r\nEl robot Darwin fue programado por un grupo de investigadores del Instituto de Tecnología de Georgia en EE.UU. como parte de lo que será un programa piloto para ayudar a niños y adultos a satisfacer sus necesidades terapéuticas.\r\n\r\nLa función de Darwin es motivar dar consejos a los niños con parálisis cerebral, autismo o con otra lesión cerebral a practicar los ejercicios fisioterapéuticos. La idea es que su apoyo sea en casa para reforzar el tratamiento.\r\n\r\nPara verificar si el niño está haciendo correctamente los ejercicios, Darwin cuenta con unos sensores para monitorizarlos en 3D.\r\n\r\nNo cabe duda que de resultar exitoso el robot Darwin en el tratamiento de los niños con parálisis, sería un gran avance médico.', 'Claudia de la Torre', '2016-08-11 07:17:21', '2016-08-11 07:17:21', 21, '', 1, 0),
(10, 'Los robots vienen a ayudarnos y a aumentar la eficiencia del sistema', 'El doctor en Robótica e ingeniero informático Ramón González, ha asegurado que los robots “vienen a ayudarnos y sobre todo a aumentar la eficiencia de nuestro sistema productivo”, por lo que niega que “vayan a quitarnos el trabajo”c', '“Nada más lejos de la realidad, los robots nos ayudan en los trabajos que no podemos realizar bien porque son peligrosos, arriesgados, o porque son muy monótonos y tediosos“, ha dicho en una entrevista a Efe González, distinguido con una de las Medallas de Andalucía 2017.\r\n\r\nEl investigador, de 34 años y natural de Viator (Almería), ha asegurado que “la sociedad del futuro no va a ir contra los robots, sino junto a éstos” y señala que en la actualidad ya hay trabajos que serían “inviables” sin la ayuda de estas máquinas como, por ejemplo, fabricar un vehículo.\r\n\r\nEs por esto que lamenta la “falta de información” en esta materia y contrapone la imagen que la industria audiovisual ha trasladado de los robots como “máquinas mortíferas”, frente a una realidad en la que “el trabajo evoluciona” y los robots “son nuestros compañeros”, por lo que no hay que verlos como rivales”.\r\n\r\nGonzález reitera que la “robótica es el futuro”, y considera que será “muy importante en la medicina, sobre todo en la cirugía”, ya que, por ejemplo, permitirá operar de forma remota a especialistas que estén en un continente diferente al del paciente, o incluso intervenir quirúrgicamente a heridos en “zonas de conflicto”.\r\n\r\nEl ingeniero mantiene que también será fundamental a corto plazo para el transporte y asegura que cada vez habrá más automatismos en los vehículos destinados a reducir el riesgo de accidentes de tráfico, “una de las mayores causas de mortalidad en el mundo”.', 'Juan Carlos Hidalgo', '2017-04-26 07:25:19', '2017-04-26 07:25:19', 18, '', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sec-subsec`
--

CREATE TABLE `sec-subsec` (
  `seccion` varchar(20) CHARACTER SET utf16 NOT NULL,
  `subseccion` varchar(20) CHARACTER SET utf16 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sec-subsec`
--

INSERT INTO `sec-subsec` (`seccion`, `subseccion`) VALUES
('Entrevista', 'Ciencia'),
('Entrevista', 'Futuro'),
('Robótica', 'Concurso'),
('Robótica', 'Congreso'),
('Robótica', 'Universidad'),
('Salud ', 'Discapacitados'),
('Salud ', 'Niños'),
('Salud ', 'Universidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sección`
--

CREATE TABLE `sección` (
  `seccion` varchar(20) CHARACTER SET utf16 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sección`
--

INSERT INTO `sección` (`seccion`) VALUES
('Entrevista'),
('Robótica'),
('Salud ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subseccion`
--

CREATE TABLE `subseccion` (
  `subseccion` varchar(20) CHARACTER SET utf16 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subseccion`
--

INSERT INTO `subseccion` (`subseccion`) VALUES
('Ciencia'),
('Concurso'),
('Congreso'),
('Discapacitados'),
('Futuro'),
('Niños'),
('Seguridad'),
('Universidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subseccion-noticia`
--

CREATE TABLE `subseccion-noticia` (
  `id-noticia` int(11) NOT NULL,
  `subseccion` varchar(20) CHARACTER SET utf16 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subseccion-noticia`
--

INSERT INTO `subseccion-noticia` (`id-noticia`, `subseccion`) VALUES
(1, 'Universidad'),
(2, 'Congreso'),
(3, 'Ciencia'),
(4, 'Futuro'),
(5, 'Futuro'),
(6, 'Concurso'),
(7, 'Discapacitados'),
(8, 'Futuro'),
(9, 'Ciencia'),
(10, 'Futuro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tag-noticia`
--

CREATE TABLE `tag-noticia` (
  `tag` varchar(20) CHARACTER SET utf16 NOT NULL,
  `id-noticia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tag-noticia`
--

INSERT INTO `tag-noticia` (`tag`, `id-noticia`) VALUES
('Automoción', 8),
('Boston', 3),
('Concurso', 6),
('Congreso', 2),
('Entrevista', 4),
('Entrevista', 5),
('Entrevista', 10),
('Futuro', 5),
('Futuro', 10),
('Niños', 6),
('Robot', 1),
('Robot', 2),
('Robot', 3),
('Robot', 4),
('Robot', 7),
('Robot', 9),
('Salud', 7),
('Salud', 8),
('Salud', 9),
('Universidad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `tag` varchar(20) CHARACTER SET utf16 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`tag`) VALUES
('Automoción'),
('Boston'),
('Ciencia'),
('Concurso'),
('Congreso'),
('Entrevista'),
('Futuro'),
('Niños'),
('Robot'),
('Salud'),
('Universidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(15) NOT NULL,
  `email` text NOT NULL,
  `contraseña` varchar(20) NOT NULL,
  `nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `email`, `contraseña`, `nombre`) VALUES
('carlos2', 'carlos@carlos.com', 'carloscarlos', 'Carlos de la Torre'),
('pepe1', 'pepe@pepe.com', 'pepepepe', 'Pepe Sanchez');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id-noticia`,`correo`) USING BTREE,
  ADD KEY `usuario_2` (`usuario`);

--
-- Indices de la tabla `editor`
--
ALTER TABLE `editor`
  ADD PRIMARY KEY (`editor`);

--
-- Indices de la tabla `editor-noticia`
--
ALTER TABLE `editor-noticia`
  ADD PRIMARY KEY (`id-noticia`),
  ADD KEY `editor` (`editor`);

--
-- Indices de la tabla `filtro`
--
ALTER TABLE `filtro`
  ADD PRIMARY KEY (`palabra`(100));

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id-imagen`,`id-noticia`),
  ADD KEY `id-noticia` (`id-noticia`),
  ADD KEY `id-noticia_2` (`id-noticia`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id-noticia`);

--
-- Indices de la tabla `sec-subsec`
--
ALTER TABLE `sec-subsec`
  ADD PRIMARY KEY (`seccion`,`subseccion`),
  ADD KEY `subseccion` (`subseccion`);

--
-- Indices de la tabla `sección`
--
ALTER TABLE `sección`
  ADD PRIMARY KEY (`seccion`);

--
-- Indices de la tabla `subseccion`
--
ALTER TABLE `subseccion`
  ADD PRIMARY KEY (`subseccion`);

--
-- Indices de la tabla `subseccion-noticia`
--
ALTER TABLE `subseccion-noticia`
  ADD PRIMARY KEY (`id-noticia`,`subseccion`),
  ADD KEY `subseccion` (`subseccion`);

--
-- Indices de la tabla `tag-noticia`
--
ALTER TABLE `tag-noticia`
  ADD PRIMARY KEY (`tag`,`id-noticia`),
  ADD KEY `id-noticia` (`id-noticia`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id-noticia`) REFERENCES `noticia` (`id-noticia`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`usuario`);

--
-- Filtros para la tabla `editor-noticia`
--
ALTER TABLE `editor-noticia`
  ADD CONSTRAINT `editor-noticia_ibfk_1` FOREIGN KEY (`id-noticia`) REFERENCES `noticia` (`id-noticia`),
  ADD CONSTRAINT `editor-noticia_ibfk_2` FOREIGN KEY (`editor`) REFERENCES `editor` (`editor`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`id-noticia`) REFERENCES `noticia` (`id-noticia`);

--
-- Filtros para la tabla `sec-subsec`
--
ALTER TABLE `sec-subsec`
  ADD CONSTRAINT `sec-subsec_ibfk_1` FOREIGN KEY (`seccion`) REFERENCES `sección` (`seccion`),
  ADD CONSTRAINT `sec-subsec_ibfk_2` FOREIGN KEY (`subseccion`) REFERENCES `subseccion` (`subseccion`);

--
-- Filtros para la tabla `subseccion-noticia`
--
ALTER TABLE `subseccion-noticia`
  ADD CONSTRAINT `subseccion-noticia_ibfk_1` FOREIGN KEY (`subseccion`) REFERENCES `subseccion` (`subseccion`),
  ADD CONSTRAINT `subseccion-noticia_ibfk_2` FOREIGN KEY (`id-noticia`) REFERENCES `noticia` (`id-noticia`);

--
-- Filtros para la tabla `tag-noticia`
--
ALTER TABLE `tag-noticia`
  ADD CONSTRAINT `tag-noticia_ibfk_1` FOREIGN KEY (`tag`) REFERENCES `tags` (`tag`),
  ADD CONSTRAINT `tag-noticia_ibfk_2` FOREIGN KEY (`id-noticia`) REFERENCES `noticia` (`id-noticia`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
