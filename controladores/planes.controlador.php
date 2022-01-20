<?php 

class ControladorPlanes{

    /**Mostramos Planes Activos */
    static public function ctrMostrarPlanesActivos(){

        $tabla = "planes";
        $valor = "1"; /**Plan Activo = 1 ; Plan Inactivo = 0 */

        $respuesta = ModeloPlanes::mdlMostrarPlanesActivos($tabla , $valor);
        return $respuesta;

    }

    /**Mostramos Todos los Planes */
    static public function ctrMostrarPlanes(){

        $tabla = "planes";
        $respuesta = ModeloPlanes::mdlMostrarPlanes($tabla);
        return $respuesta;

    }

}

?>