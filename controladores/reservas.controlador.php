<?php 

class ControladorReservas{

    /**Mostramos Todos los Reservas */
    static public function ctrMostrarReservas($valor){

        $tabla1 = "habitaciones";
        $tabla2 = "reservas";
        $tabla3 = "categorias";

        $respuesta = ModeloReservas::mdlMostrarReservas($tabla1, $tabla2, $tabla3, $valor);
        return $respuesta;

    }

    /**Mostramos todas las reservas por código */
    static public function ctrMostrarCodigoReserva($valor){

        $tabla1 = "reservas";

        $respuesta = ModeloReservas::mdlMostrarCodigoReservas($tabla1, $valor);
        return $respuesta;

    }

}

?>