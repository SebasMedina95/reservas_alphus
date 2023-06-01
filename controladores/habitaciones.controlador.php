<?php 

Class ControladorHabitaciones{

    /**MOSTRAMOS LAS CATEGORIAS-HABITACIONES CON INNER JOIN */
    static public function ctrMostrarHabitaciones($valor){
        
        $tabla1 = "categorias";
        $tabla2 = "habitaciones";

        $respuesta = ModeloHabitaciones::mdlMostrarHabitaciones($tabla1 , $tabla2 , $valor);

        return $respuesta;

    }

    /**MOSTRAMOS LAS CATEGORIAS-HABITACIONES HABILITADAS CON INNER JOIN */

    /**MOSTRAMOS LAS COMODIDADES DADA LA CATEGORÍA DE HABITACIÓN */
    static public function ctrMostrarComodidades($valor){
        
        $tabla1 = "categorias";
        $tabla2 = "comodidades";
        $tabla3 = "detalle_comodidades";

        $respuesta = ModeloHabitaciones::mdlMostrarComodidadesHabitaciones($tabla1 , $tabla2 , $tabla3, $valor);

        return $respuesta;

    }

}

?>