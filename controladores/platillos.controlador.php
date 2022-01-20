<?php 

class ControladorPlatillos{

    /**Mostramos Todos los Platilloss */
    static public function ctrMostrarPlatillos(){

        $tabla = "Platillos";
        $respuesta = ModeloPlatillos::mdlMostrarPlatillos($tabla);
        return $respuesta;

    }

    static public function ctrMostrarPlatillosActivos(){

        $tabla = "Platillos";
        $valor = "1"; /**Plan Activo = 1 ; Plan Inactivo = 0 */

        $respuesta = ModeloPlatillos::mdlMostrarPlatillosActivos($tabla , $valor);
        return $respuesta;

    }

}

?>