<?php 

class ControladorBanner{

    /**Mostramos Todos los Banners */
    static public function ctrMostrarBanner(){

        $tabla = "banner";
        $respuesta = ModeloBanner::mdlMostrarBanner($tabla);
        return $respuesta;

    }

    static public function ctrMostrarBannerActivos(){

        $tabla = "banner";
        $valor = "1"; /**Plan Activo = 1 ; Plan Inactivo = 0 */

        $respuesta = ModeloBanner::mdlMostrarBannerActivos($tabla , $valor);
        return $respuesta;

    }

}

?>