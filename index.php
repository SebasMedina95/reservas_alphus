<?php

/**VAMOS A REQUERIR EL AUTOLOAD PARA LAS API */
require_once "extensiones/vendor/autoload.php";

/**PLANTILLA Y RUTA */
require_once "controladores/plantilla.controlador.php";
require_once "controladores/ruta.controlador.php";

/**BANNER */
require_once "controladores/banner.controlador.php";
require_once "modelos/banner.modelo.php";

/**PLANES */
require_once "controladores/planes.controlador.php";
require_once "modelos/planes.modelo.php";

/**CATEGORIAS */
require_once "controladores/categorias.controlador.php";
require_once "modelos/categorias.modelo.php";

/**RECORRIDOS */
require_once "controladores/recorridos.controlador.php";
require_once "modelos/recorridos.modelo.php";

/**PLATILLOS */
require_once "controladores/platillos.controlador.php";
require_once "modelos/platillos.modelo.php";

/**HABITACIONES - DENTRO CATEGORÍAS */
require_once "controladores/habitaciones.controlador.php";
require_once "modelos/habitaciones.modelo.php";

/**CARTA DEL RESTAURANTE */
require_once "controladores/carta.controlador.php";
require_once "modelos/carta.modelo.php";

/**RESERVAS DE HABITACIÓN */
require_once "controladores/reservas.controlador.php";
require_once "modelos/reservas.modelo.php";

/**USUARIOS DEL SISTEMA */
require_once "controladores/usuarios.controlador.php";
require_once "modelos/usuarios.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
