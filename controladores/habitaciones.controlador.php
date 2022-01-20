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

}

?>