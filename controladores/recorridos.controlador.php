<?php 

class ControladorRecorridos{

    /**Mostramos Todos los Recorridoss */
    static public function ctrMostrarRecorridos(){

        $tabla = "recorrido";
        $respuesta = ModeloRecorridos::mdlMostrarRecorridos($tabla);
        return $respuesta;

    }

    static public function ctrMostrarRecorridosActivos(){

        $tabla = "recorrido";
        $valor = "1"; /**Plan Activo = 1 ; Plan Inactivo = 0 */

        $respuesta = ModeloRecorridos::mdlMostrarRecorridosActivos($tabla , $valor);
        return $respuesta;

    }

}

?>