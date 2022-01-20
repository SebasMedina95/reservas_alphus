<?php 

class ControladorCategorias{

    /**Mostramos Todos los Categoriass */
    static public function ctrMostrarCategorias(){

        $tabla = "categorias";
        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla);
        return $respuesta;

    }

    static public function ctrMostrarCategoriasActivos(){

        $tabla = "categorias";
        $valor = "1"; /**Plan Activo = 1 ; Plan Inactivo = 0 */

        $respuesta = ModeloCategorias::mdlMostrarCategoriasActivos($tabla , $valor);
        return $respuesta;

    }

}

?>