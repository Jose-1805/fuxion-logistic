
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

INSERT INTO `usuarios_exigo` (`id`, `nombre_exigo`, `nombre_impreso`, `codigo_almacen`, `almacen`, `serie`, `resolucion`, `fecha_resolucion`, `direccion_factura`, `rango_desde`, `rango_hasta`, `created_at`, `updated_at`) VALUES
(1, 'co_porozco', 'admin', 1058, 'S0058 - PASTO NARIÑO', 746, '18762003657544', '14/06/2017', 'CARRERA 19 No. 123-86 - BOGOTÁ', '1', '50000', '2017-11-02 14:31:34', NULL),
(2, 'co_porozco', 'admin', 1021, 'S0021 - BOGOTA', 723, '18762001629294', '21/12/2016', 'CARRERA 19 No. 123-86 - BOGOTÁ', '8493', '50000', NULL, NULL);

CREATE TABLE `v_estados_pedidos` (
`pedido_id` int(10) unsigned
,`fecha_orden` timestamp
,`fecha_impresion` timestamp
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

CREATE TABLE `v_guias_pedidos_corte` (
`pedido_id` int(10) unsigned
,`fecha_orden` timestamp
,`fecha_impresion` timestamp
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
,`estado_corte` enum('transmitido','enviado')
,`guias_asignadas` enum('si','no')
,`user_id` int(10) unsigned
,`guia_id` int(10) unsigned
,`numero_guia` text
,`estado_guia` enum('registrada','enviada','entregada')
,`foto_1` int(10) unsigned
,`foto_2` int(10) unsigned
,`malla_cobertura_id` int(10) unsigned
,`operador_logistico_id` int(10) unsigned
);

CREATE TABLE `v_historial_estados_pedido` (
`fecha_orden` timestamp
,`fecha_impresion` timestamp
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
,`razon_estado` enum('Pendiente por productos','Pendiente por devolucion','Pendiente por kit','Pendiente por flete')
,`fecha_creacion_historial` timestamp
,`numero` int(10) unsigned
,`estado` enum('transmitido','enviado')
,`guias_asignadas` enum('si','no')
,`user_id` int(10) unsigned
,`fecha_creacion_corte` timestamp
);

CREATE TABLE `v_pedidos_productos` (
`pedido_id` int(10) unsigned
,`fecha_orden` timestamp
,`fecha_impresion` timestamp
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

CREATE TABLE `v_productos_enviados` (
`pedido_id` int(10) unsigned
,`fecha_orden` timestamp
,`fecha_impresion` timestamp
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

DROP TABLE IF EXISTS `v_estados_pedidos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_estados_pedidos`  AS  select `p`.`id` AS `pedido_id`,`p`.`fecha_orden` AS `fecha_orden`,`p`.`fecha_impresion` AS `fecha_impresion`,`p`.`serie` AS `serie`,`p`.`correlativo` AS `correlativo`,`p`.`orden_id` AS `orden_id`,`p`.`impreso_por` AS `impreso_por`,`p`.`subtotal` AS `subtotal`,`p`.`total_tax` AS `total_tax`,`p`.`costo_envio` AS `costo_envio`,`p`.`total` AS `total`,`p`.`descuento` AS `descuento`,`p`.`tipo_pago` AS `tipo_pago`,`p`.`volumen_comisionable` AS `volumen_comisionable`,`p`.`empresario_id` AS `empresario_id`,`p`.`corte_id` AS `corte_id`,`p`.`bodega_id` AS `bodega_id`,`ep`.`id` AS `estado_pedido_id`,`ep`.`nombre` AS `nombre`,`ep`.`descripcion` AS `descripcion`,`ep`.`notificacion_push` AS `notificacion_push`,`ep`.`notificacion_correo` AS `notificacion_correo`,`ep`.`no_asignacion_corte` AS `no_asignacion_corte`,`ep`.`asignacion_corte` AS `asignacion_corte`,`ep`.`plantilla_correo_id` AS `plantilla_correo_id` from ((`pedidos` `p` join `historial_estados_pedidos` `he` on((`he`.`pedido_id` = `p`.`id`))) join `estados_pedidos` `ep` on((`he`.`estado_pedido_id` = `ep`.`id`))) ;

DROP TABLE IF EXISTS `v_guias_pedidos_corte`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_guias_pedidos_corte`  AS  select `p`.`id` AS `pedido_id`,`p`.`fecha_orden` AS `fecha_orden`,`p`.`fecha_impresion` AS `fecha_impresion`,`p`.`serie` AS `serie`,`p`.`correlativo` AS `correlativo`,`p`.`orden_id` AS `orden_id`,`p`.`impreso_por` AS `impreso_por`,`p`.`subtotal` AS `subtotal`,`p`.`total_tax` AS `total_tax`,`p`.`costo_envio` AS `costo_envio`,`p`.`total` AS `total`,`p`.`descuento` AS `descuento`,`p`.`tipo_pago` AS `tipo_pago`,`p`.`volumen_comisionable` AS `volumen_comisionable`,`p`.`empresario_id` AS `empresario_id`,`p`.`corte_id` AS `corte_id`,`p`.`bodega_id` AS `bodega_id`,`c`.`numero` AS `numero_corte`,`c`.`estado` AS `estado_corte`,`c`.`guias_asignadas` AS `guias_asignadas`,`c`.`user_id` AS `user_id`,`g`.`id` AS `guia_id`,`g`.`numero` AS `numero_guia`,`g`.`estado` AS `estado_guia`,`g`.`foto_1` AS `foto_1`,`g`.`foto_2` AS `foto_2`,`g`.`malla_cobertura_id` AS `malla_cobertura_id`,`g`.`operador_logistico_id` AS `operador_logistico_id` from (((`pedidos` `p` join `guias_pedidos` `gp` on((`p`.`id` = `gp`.`pedido_id`))) join `guias` `g` on((`gp`.`guia_id` = `g`.`id`))) left join `cortes` `c` on((`p`.`corte_id` = `c`.`id`))) ;


DROP TABLE IF EXISTS `v_historial_estados_pedido`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_historial_estados_pedido`  AS  select `p`.`fecha_orden` AS `fecha_orden`,`p`.`fecha_impresion` AS `fecha_impresion`,`p`.`serie` AS `serie`,`p`.`correlativo` AS `correlativo`,`p`.`orden_id` AS `orden_id`,`p`.`impreso_por` AS `impreso_por`,`p`.`subtotal` AS `subtotal`,`p`.`total_tax` AS `total_tax`,`p`.`costo_envio` AS `costo_envio`,`p`.`total` AS `total`,`p`.`descuento` AS `descuento`,`p`.`tipo_pago` AS `tipo_pago`,`p`.`volumen_comisionable` AS `volumen_comisionable`,`p`.`empresario_id` AS `empresario_id`,`p`.`corte_id` AS `corte_id`,`p`.`bodega_id` AS `bodega_id`,`p`.`created_at` AS `fecha_creacion_pedido`,`ep`.`id` AS `estado_pedido_id`,`ep`.`nombre` AS `nombre`,`ep`.`descripcion` AS `descripcion`,`ep`.`notificacion_push` AS `notificacion_push`,`ep`.`notificacion_correo` AS `notificacion_correo`,`ep`.`no_asignacion_corte` AS `no_asignacion_corte`,`ep`.`asignacion_corte` AS `asignacion_corte`,`ep`.`plantilla_correo_id` AS `plantilla_correo_id`,`hep`.`id` AS `historial_estado_pedido_id`,`hep`.`pedido_id` AS `pedido_id`,`hep`.`razon_estado` AS `razon_estado`,`hep`.`created_at` AS `fecha_creacion_historial`,`c`.`numero` AS `numero`,`c`.`estado` AS `estado`,`c`.`guias_asignadas` AS `guias_asignadas`,`c`.`user_id` AS `user_id`,`c`.`created_at` AS `fecha_creacion_corte` from (((`historial_estados_pedidos` `hep` join `estados_pedidos` `ep` on((`hep`.`estado_pedido_id` = `ep`.`id`))) join `pedidos` `p` on((`hep`.`pedido_id` = `p`.`id`))) left join `cortes` `c` on((`p`.`corte_id` = `c`.`id`))) ;


DROP TABLE IF EXISTS `v_pedidos_productos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pedidos_productos`  AS  select `p`.`id` AS `pedido_id`,`p`.`fecha_orden` AS `fecha_orden`,`p`.`fecha_impresion` AS `fecha_impresion`,`p`.`serie` AS `serie`,`p`.`correlativo` AS `correlativo`,`p`.`orden_id` AS `orden_id`,`p`.`impreso_por` AS `impreso_por`,`p`.`subtotal` AS `subtotal`,`p`.`total_tax` AS `total_tax`,`p`.`costo_envio` AS `costo_envio`,`p`.`total` AS `total_pedidos`,`p`.`descuento` AS `descuento`,`p`.`tipo_pago` AS `tipo_pago`,`p`.`volumen_comisionable` AS `volumen_comisionable`,`p`.`empresario_id` AS `empresario_id`,`p`.`corte_id` AS `corte_id`,`p`.`bodega_id` AS `bodega_id`,`pd`.`id` AS `producto_id`,`pd`.`codigo` AS `codigo`,`pd`.`descripcion` AS `descripcion`,`pp`.`cantidad` AS `cantidad`,`pp`.`precio_unitario` AS `precio_unitario`,`pp`.`total` AS `total_pedido_productos` from ((`pedidos` `p` join `pedidos_productos` `pp` on((`p`.`id` = `pp`.`pedido_id`))) join `productos` `pd` on((`pp`.`producto_id` = `pd`.`id`))) ;


DROP TABLE IF EXISTS `v_productos_enviados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_productos_enviados`  AS  select `p`.`id` AS `pedido_id`,`p`.`fecha_orden` AS `fecha_orden`,`p`.`fecha_impresion` AS `fecha_impresion`,`p`.`serie` AS `serie`,`p`.`correlativo` AS `correlativo`,`p`.`orden_id` AS `orden_id`,`p`.`impreso_por` AS `impreso_por`,`p`.`subtotal` AS `subtotal`,`p`.`total_tax` AS `total_tax`,`p`.`costo_envio` AS `costo_envio`,`p`.`total` AS `total`,`p`.`descuento` AS `descuento`,`p`.`tipo_pago` AS `tipo_pago`,`p`.`volumen_comisionable` AS `volumen_comisionable`,`p`.`empresario_id` AS `empresario_id`,`p`.`corte_id` AS `corte_id`,`p`.`bodega_id` AS `bodega_id`,`g`.`numero` AS `numero_guia`,`g`.`estado` AS `estado_guia`,`g`.`foto_1` AS `foto_1`,`g`.`foto_2` AS `foto_2`,`g`.`malla_cobertura_id` AS `malla_cobertura_id`,`g`.`operador_logistico_id` AS `operador_logistico_id`,`pe`.`cantidad` AS `cantidad`,`pe`.`producto_id` AS `producto_id`,`pd`.`codigo` AS `codigo`,`pd`.`descripcion` AS `descripcion` from ((((`pedidos` `p` join `guias_pedidos` `gp` on((`p`.`id` = `gp`.`pedido_id`))) join `guias` `g` on((`gp`.`guia_id` = `g`.`id`))) join `productos_enviados` `pe` on((`gp`.`id` = `pe`.`guia_pedido_id`))) join `productos` `pd` on((`pe`.`producto_id` = `pd`.`id`))) ;

--