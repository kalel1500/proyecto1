/*AVISO----*/
/*Para entrar en la base de datos la contraseña es 1234 (PARA TODOS LOS USUARIOS)*/


/*----------CREAR BASE DE DATOS------------------------------------------------------------------------------------------------------------*/
/*----------CREAR BASE DE DATOS------------------------------------------------------------------------------------------------------------*/
/*----------CREAR BASE DE DATOS------------------------------------------------------------------------------------------------------------*/
/*----------CREAR BASE DE DATOS------------------------------------------------------------------------------------------------------------*/
/*----------CREAR BASE DE DATOS------------------------------------------------------------------------------------------------------------*/
DROP DATABASE IF EXISTS bd_proyecto1_sinerrores;
CREATE DATABASE IF NOT EXISTS bd_proyecto1_sinerrores;



/*-----------CREAR TABLAS-----------------------------------------------------------------------------------------------------------------*/
/*-----------CREAR TABLAS-----------------------------------------------------------------------------------------------------------------*/
/*-----------CREAR TABLAS-----------------------------------------------------------------------------------------------------------------*/
/*-----------CREAR TABLAS-----------------------------------------------------------------------------------------------------------------*/
/*-----------CREAR TABLAS-----------------------------------------------------------------------------------------------------------------*/
USE `bd_proyecto1_sinerrores`;

CREATE TABLE IF NOT EXISTS `tbl_usuario` (
`id_usuario` int(11) COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT,
`email_usuario` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
`usuario_usuario` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
`password_usuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
`nombre_usuario` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
`apellido_usuario` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
`habilitado_usuario` ENUM('si', 'no') COLLATE utf8_unicode_ci DEFAULT 'si',
`ultimaConexion_usuario` DATETIME COLLATE utf8_unicode_ci DEFAULT CURRENT_TIMESTAMP,
`id_grupoUsuario` int(11) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY (`id_usuario`),
UNIQUE KEY `email_usuario` (`email_usuario`),
UNIQUE KEY `usuario_usuario` (`usuario_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `tbl_grupoUsuario` (
`id_grupoUsuario` int(11) COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT,
`nombre_grupoUsuario` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY (`id_grupoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `tbl_recurso` (
`id_recurso` int(11) COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT,
`rutaArchivos_recurso` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'assets/images/recursos/',
`nombreArchivos_recurso` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
`extensionArchivos_recurso` varchar(10) COLLATE utf8_unicode_ci DEFAULT '.jpg',
`nombre_recurso` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
`descripcion_recurso` text COLLATE utf8_unicode_ci DEFAULT NULL,
`disp_recurso` ENUM('si', 'no') COLLATE utf8_unicode_ci DEFAULT 'si',
`id_tipoRecurso` int(11) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY (`id_recurso`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `tbl_tipoRecurso` (
`id_tipoRecurso` int(11) COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT,
`nombre_tipoRecurso` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY (`id_tipoRecurso`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `tbl_reserva` (
`id_reserva` int(11) COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT,
`descripcion_reserva` text COLLATE utf8_unicode_ci DEFAULT NULL,
`fechaInicio_reserva` DATETIME COLLATE utf8_unicode_ci DEFAULT CURRENT_TIMESTAMP,
`fechaFinal_reserva` DATETIME COLLATE utf8_unicode_ci DEFAULT NULL,
`modoFinalizacion_reserva` ENUM('bien', 'incidencia', 'cancelada') COLLATE utf8_unicode_ci DEFAULT NULL,
`id_usuario` int(11) COLLATE utf8_unicode_ci DEFAULT NULL,
`id_recurso` int(11) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY (`id_reserva`),
UNIQUE KEY `fechaInicio_idRecurso` (`fechaInicio_reserva`, `id_recurso`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `tbl_incidencia` (
`id_incidencia` int(11) COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT,
`titulo_incidencia` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
`descripcion_incidencia` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
`tiempoEstimado_incidencia` TIME COLLATE utf8_unicode_ci DEFAULT NULL,
`fechaInicio_incidencia` DATETIME COLLATE utf8_unicode_ci DEFAULT CURRENT_TIMESTAMP,
`fechaFinal_incidencia` DATETIME COLLATE utf8_unicode_ci DEFAULT NULL,
`id_reserva` int(11) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY (`id_incidencia`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



/*-----------ESTABLECER FK---------------------------------------------------------------------------------------------------------------------------*/
/*-----------ESTABLECER FK---------------------------------------------------------------------------------------------------------------------------*/
/*-----------ESTABLECER FK---------------------------------------------------------------------------------------------------------------------------*/
/*-----------ESTABLECER FK---------------------------------------------------------------------------------------------------------------------------*/
/*-----------ESTABLECER FK---------------------------------------------------------------------------------------------------------------------------*/
ALTER TABLE `tbl_usuario` ADD CONSTRAINT `FK_usuario_grupoUsuario` FOREIGN KEY (`id_grupoUsuario`)
REFERENCES `tbl_grupoUsuario` (`id_grupoUsuario`);

ALTER TABLE `tbl_reserva` ADD CONSTRAINT `FK_reserva_usuario` FOREIGN KEY (`id_usuario`)
REFERENCES `tbl_usuario` (`id_usuario`);

ALTER TABLE `tbl_reserva` ADD CONSTRAINT `FK_reserva_recurso` FOREIGN KEY (`id_recurso`)
REFERENCES `tbl_recurso` (`id_recurso`);

ALTER TABLE `tbl_incidencia` ADD CONSTRAINT `FK_incidencia_recurso` FOREIGN KEY (`id_reserva`)
REFERENCES `tbl_reserva` (`id_reserva`);

ALTER TABLE `tbl_recurso` ADD CONSTRAINT `FK_recurso_tipoRecurso` FOREIGN KEY (`id_tipoRecurso`)
REFERENCES `tbl_tipoRecurso` (`id_tipoRecurso`);



/*------------INSERTAR DATOS----------------------------------------------------------------------------------------------------------*/
/*------------INSERTAR DATOS----------------------------------------------------------------------------------------------------------*/
/*------------INSERTAR DATOS----------------------------------------------------------------------------------------------------------*/
/*------------INSERTAR DATOS----------------------------------------------------------------------------------------------------------*/
/*------------INSERTAR DATOS----------------------------------------------------------------------------------------------------------*/

INSERT INTO `tbl_grupoUsuario` (`nombre_grupoUsuario`) VALUES
('usuario'),
('administrador');

INSERT INTO `tbl_usuario` (`email_usuario`, `usuario_usuario`, `password_usuario`, `nombre_usuario`, `apellido_usuario`, `habilitado_usuario`, `id_grupoUsuario`) VALUES
('usuAdmin1@mail.com', 	'usuarioAdmin1', 	NULL, 'Javier', 'Idalgo', 	'si', (SELECT `id_grupoUsuario` FROM `tbl_grupoUsuario` WHERE `nombre_grupoUsuario` = 'administrador')),
('usuAdmin2@mail.com', 	'usuarioAdmin2', 	NULL, 'Carlos', 'Diaz', 	'si', (SELECT `id_grupoUsuario` FROM `tbl_grupoUsuario` WHERE `nombre_grupoUsuario` = 'administrador')),
('usu01@mail.com', 		'usuario01', 		NULL, 'Juan', 	'Gonzalez', 'si', (SELECT `id_grupoUsuario` FROM `tbl_grupoUsuario` WHERE `nombre_grupoUsuario` = 'usuario')),
('usu02@mail.com', 		'usuario02', 		NULL, 'Pepe', 	'Gomez', 	'si', (SELECT `id_grupoUsuario` FROM `tbl_grupoUsuario` WHERE `nombre_grupoUsuario` = 'usuario')),
('usu03@mail.com', 		'usuario03', 		NULL, 'Lola', 	'Garcia', 	'no', (SELECT `id_grupoUsuario` FROM `tbl_grupoUsuario` WHERE `nombre_grupoUsuario` = 'usuario'));
UPDATE `tbl_usuario` SET `password_usuario` = '$2y$10$mH6cW.UpaVVk4YUGWI.NNeOhsorQr.WjGZlXi5DhJXz9uY9sUh5gC';

INSERT INTO `tbl_tipoRecurso` (`nombre_tipoRecurso`) VALUES
('sala multidisciplinar'),
('sala informatica'),
('taller cocina'),
('despacho entrevistas'),
('salon actos'),
('sala reuniones'),
('proyector portatil'),
('ordenador portatil'),
('movil');

INSERT INTO `tbl_recurso` (`rutaArchivos_recurso`, `nombreArchivos_recurso`, `extensionArchivos_recurso`, `nombre_recurso`, `descripcion_recurso`, `disp_recurso`, `id_tipoRecurso`) VALUES
('assets/images/recursos/', 'salamultidisciplinar1', 	'.jpg', 'sala multidisciplinar 1', 		'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'sala multidisciplinar')),
('assets/images/recursos/', 'salamultidisciplinar2', 	'.jpg', 'sala multidisciplinar 2', 		'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'sala multidisciplinar')),
('assets/images/recursos/', 'salamultidisciplinar3', 	'.jpg', 'sala multidisciplinar 3', 		'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'sala multidisciplinar')),
('assets/images/recursos/', 'salamultidisciplinar4', 	'.jpg', 'sala multidisciplinar 4', 		'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'sala multidisciplinar')),
('assets/images/recursos/', 'salainformatica1', 		'.jpg', 'sala informática 1', 			'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'sala informatica')),
('assets/images/recursos/', 'salainformatica2', 		'.jpg', 'sala informática 2', 			'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'sala informatica')),
('assets/images/recursos/', 'tallerdecocina1', 			'.jpg', 'taller de cocina 1', 			'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'taller cocina')),
('assets/images/recursos/', 'despachoparaentrevistas1', '.jpg', 'despacho para entrevistas 1', 	'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'despacho entrevistas')),
('assets/images/recursos/', 'despachoparaentrevistas2', '.jpg', 'despacho para entrevistas 2', 	'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'despacho entrevistas')),
('assets/images/recursos/', 'salondeactos1', 			'.jpg', 'salón de actos 1', 			'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'salon actos')),
('assets/images/recursos/', 'saladereuniones1', 		'.jpg', 'sala de reuniones 1', 			'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'sala reuniones')),
('assets/images/recursos/', 'proyectorportatil1', 		'.jpg', 'proyector portátil 1', 		'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'proyector portatil')),
('assets/images/recursos/', 'proyectorportatil2', 		'.jpg', 'proyector portátil 2', 		'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'proyector portatil')),
('assets/images/recursos/', 'ordenadorportatil1', 		'.jpg', 'ordenador portátil 1', 		'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'ordenador portatil')),
('assets/images/recursos/', 'ordenadorportatil2', 		'.jpg', 'ordenador portátil 2', 		'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'ordenador portatil')),
('assets/images/recursos/', 'ordenadorportatil3', 		'.jpg', 'ordenador portátil 3', 		'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'ordenador portatil')),
('assets/images/recursos/', 'movil1', 					'.jpg', 'móvil 1', 						'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'movil')),
('assets/images/recursos/', 'movil2', 					'.jpg', 'móvil 2', 						'Caracteristicas', 'si', (SELECT `id_tipoRecurso` FROM `tbl_tipoRecurso` WHERE `nombre_tipoRecurso` = 'movil'));

INSERT INTO `tbl_reserva` (`descripcion_reserva`, `fechaInicio_reserva`, `fechaFinal_reserva`, `modoFinalizacion_reserva`, `id_usuario`, `id_recurso`) VALUES
/*Acabadas---------------*/
('reserva01', '2014-09-20 08:00:00', '2014-09-22 08:00:00', 'bien', 		(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario01'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'ordenador portátil 1')),
('reserva02', '2014-09-21 09:00:00', '2015-09-21 13:00:00', 'bien', 		(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario02'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'sala multidisciplinar 1')),
('reserva03', '2015-09-23 09:00:00', '2016-09-24 10:00:00', 'bien', 		(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario03'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'proyector portátil 2')),
('reserva04', '2015-09-23 10:00:00', '2017-09-26 08:00:00', 'bien', 		(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario01'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'móvil 1')),
('reserva05', '2016-09-24 12:00:00', '2018-09-24 18:00:00', 'bien', 		(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario02'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'sala de reuniones 1')),
('reserva20', '2016-10-20 08:00:00', '2014-10-20 11:00:00', 'bien', 		(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario01'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'ordenador portátil 1')),
('reserva21', '2017-10-21 09:00:00', '2015-10-21 18:00:00', 'bien', 		(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario02'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'sala multidisciplinar 1')),
('reserva22', '2017-10-23 09:00:00', '2016-10-23 10:00:00', 'bien', 		(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario03'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'proyector portátil 2')),
('reserva23', '2018-10-24 10:00:00', '2017-10-24 12:00:00', 'bien', 		(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario01'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'móvil 1')),
('reserva24', '2018-10-24 12:00:00', '2018-10-24 18:00:00', 'bien', 		(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario02'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'sala de reuniones 1')),
/*Pendientes---------------*/
('reserva06', '2018-10-25 08:00:00', NULL, NULL, 							(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario03'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'móvil 2')),
('reserva07', '2018-10-26 08:00:00', NULL, NULL, 							(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario01'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'ordenador portátil 2')),
('reserva08', '2018-10-27 09:00:00', NULL, NULL, 							(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario02'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'taller de cocina 1')),
('reserva09', '2018-10-28 09:00:00', NULL, NULL, 							(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario03'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'despacho para entrevistas 1')),
('reserva10', '2018-10-29 09:00:00', NULL, NULL, 							(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario01'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'despacho para entrevistas 2')),
/*Incidencias---------------*/
('reserva11', '2018-10-30 08:00:00', '2018-10-30 08:05:00', 'incidencia', 	(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario02'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'ordenador portátil 1')),
('reserva12', '2018-10-30 08:00:00', '2018-10-30 08:05:00', 'incidencia', 	(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario03'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'ordenador portátil 3')),
('reserva13', '2018-10-30 09:00:00', '2018-10-30 09:05:00', 'incidencia', 	(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario01'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'sala multidisciplinar 3')),
('reserva14', '2018-10-30 09:00:00', '2018-10-30 09:05:00', 'incidencia', 	(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario02'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'proyector portátil 1')),
('reserva15', '2018-10-30 10:00:00', '2018-10-30 10:05:00', 'incidencia', 	(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario03'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'móvil 1')),
('reserva16', '2018-10-30 12:00:00', '2018-10-30 12:05:00', 'incidencia', 	(SELECT `id_usuario` FROM `tbl_usuario` WHERE `usuario_usuario` = 'usuario01'), (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'salón de actos 1'));
/*Finalizacion por incidencia---------------*/
SET @sub = (SELECT `id_reserva` FROM `tbl_reserva` WHERE `id_recurso` = (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'móvil 2'));
UPDATE `tbl_reserva` SET `fechaFinal_reserva` = '2018-10-25 08:05:00', `modoFinalizacion_reserva` = 'incidencia' WHERE (`tbl_reserva`.`id_reserva` = @sub) AND `fechaFinal_reserva` = NULL;
/*Finalizacion por devolicion---------------*/
SET @sub = (SELECT `id_reserva` FROM `tbl_reserva` WHERE `id_recurso` = (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'ordenador portátil 2'));
UPDATE `tbl_reserva` SET `fechaFinal_reserva` = '2018-10-25 08:05:00', `modoFinalizacion_reserva` = 'bien' WHERE `tbl_reserva`.`id_reserva` = @sub AND `fechaFinal_reserva` = NULL;

INSERT INTO `tbl_incidencia` (`titulo_incidencia`, `descripcion_incidencia`, `tiempoEstimado_incidencia`, `fechaInicio_incidencia`, `fechaFinal_incidencia`, `id_reserva`) VALUES
('Portatil inutilizable', 	'No tiene bateria y el cargador no funciona.', 								'12:00:00', '2018-10-30 08:30:00', '2018-10-30 21:00:00',	(SELECT `id_reserva` FROM `tbl_reserva` WHERE (`modoFinalizacion_reserva` = 'incidencia') AND (`id_recurso` = (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'ordenador portátil 1')))),
('Portatil no arranca', 	'Cuando enciendes el portatil se queda con la pantalla azul y no arranca.', '24:00:00', '2018-10-30 08:30:00', '2018-10-31 09:00:00', 	(SELECT `id_reserva` FROM `tbl_reserva` WHERE (`modoFinalizacion_reserva` = 'incidencia') AND (`id_recurso` = (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'ordenador portátil 3')))),
('Sala en obras', 			'La sala multidisciplinar esta en obras.', 									'24:00:00', '2018-10-30 09:50:00', NULL, 				 	(SELECT `id_reserva` FROM `tbl_reserva` WHERE (`modoFinalizacion_reserva` = 'incidencia') AND (`id_recurso` = (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'sala multidisciplinar 3')))),
('Proyector funciona mal', 	'El proyector parpadea constantemente y no se ve bien.', 					'24:00:00', '2018-10-30 09:05:00', NULL, 				 	(SELECT `id_reserva` FROM `tbl_reserva` WHERE (`modoFinalizacion_reserva` = 'incidencia') AND (`id_recurso` = (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'proyector portátil 1')))),
('Móvil roto', 				'El móvil no se enciende', 													'24:00:00', '2018-10-30 10:35:00', NULL, 				 	(SELECT `id_reserva` FROM `tbl_reserva` WHERE (`modoFinalizacion_reserva` = 'incidencia') AND (`id_recurso` = (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'móvil 1')))),
('Escenario sin cortinas', 	'Al escenario le faltan las cortinas.', 									'24:00:00', '2018-10-30 12:05:00', NULL, 				 	(SELECT `id_reserva` FROM `tbl_reserva` WHERE (`modoFinalizacion_reserva` = 'incidencia') AND (`id_recurso` = (SELECT `id_recurso` FROM `tbl_recurso` WHERE `nombre_recurso` = 'salón de actos 1'))));

/*No disponibles por reservas---------------*/
UPDATE `tbl_recurso` SET `disp_recurso` = 'no' WHERE `tbl_recurso`.`nombre_recurso` = 'móvil 2';
UPDATE `tbl_recurso` SET `disp_recurso` = 'no' WHERE `tbl_recurso`.`nombre_recurso` = 'ordenador portátil 2';
UPDATE `tbl_recurso` SET `disp_recurso` = 'no' WHERE `tbl_recurso`.`nombre_recurso` = 'taller de cocina 1';
UPDATE `tbl_recurso` SET `disp_recurso` = 'no' WHERE `tbl_recurso`.`nombre_recurso` = 'despacho para entrevistas 1';
UPDATE `tbl_recurso` SET `disp_recurso` = 'no' WHERE `tbl_recurso`.`nombre_recurso` = 'despacho para entrevistas 2';
/*No disponibles por incidencias---------------*/
UPDATE `tbl_recurso` SET `disp_recurso` = 'no' WHERE `tbl_recurso`.`nombre_recurso` = 'ordenador portátil 1';
UPDATE `tbl_recurso` SET `disp_recurso` = 'no' WHERE `tbl_recurso`.`nombre_recurso` = 'ordenador portátil 3';
UPDATE `tbl_recurso` SET `disp_recurso` = 'no' WHERE `tbl_recurso`.`nombre_recurso` = 'sala multidisciplinar 3';
UPDATE `tbl_recurso` SET `disp_recurso` = 'no' WHERE `tbl_recurso`.`nombre_recurso` = 'proyector portátil 1';
UPDATE `tbl_recurso` SET `disp_recurso` = 'no' WHERE `tbl_recurso`.`nombre_recurso` = 'móvil 1';
UPDATE `tbl_recurso` SET `disp_recurso` = 'no' WHERE `tbl_recurso`.`nombre_recurso` = 'salón de actos 1';
/*Vuelven a estar disponibles por finalizacion de incidencia----------------*/
UPDATE `tbl_recurso` SET `disp_recurso` = 'si' WHERE `tbl_recurso`.`nombre_recurso` = 'ordenador portátil 1';
UPDATE `tbl_recurso` SET `disp_recurso` = 'si' WHERE `tbl_recurso`.`nombre_recurso` = 'ordenador portátil 3';
/*Vuelven a estar disponibles por finalizacion de reserva----------------*/
UPDATE `tbl_recurso` SET `disp_recurso` = 'si' WHERE `tbl_recurso`.`nombre_recurso` = 'ordenador portátil 2';