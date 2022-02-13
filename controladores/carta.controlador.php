<?php 

class ControladorCarta{

    /**Mostramos Todos los Cartas */
    static public function ctrMostrarCarta(){

        $tabla = "carta";
        $respuesta = ModeloCarta::mdlMostrarCarta($tabla);
        return $respuesta;

    }

    /**Mostramos los activos y aplicamos la base y el tope para la paginación */
    static public function ctrMostrarCartaActivos($base, $tope){

        $tabla = "carta";
        $valor = "1"; /**ítem de Carta Activo = 1 ; ítem de Carta Inactivo = 0 */

        $respuesta = ModeloCarta::mdlMostrarCartaActivos($tabla , $valor , $base, $tope);
        return $respuesta;

    }

    /**Es básicamente el mismo que activos pero, este tendrá el uso de conteo y muestreo
     * general de los platillos activos de la carta */
    static public function ctrMostrarCartaCount(){

        $tabla = "carta";
        $valor = "1"; /**ítem de Carta Activo = 1 ; ítem de Carta Inactivo = 0 */

        $respuesta = ModeloCarta::mdlMostrarCartaCount($tabla , $valor);
        return $respuesta;

    }

}

?>