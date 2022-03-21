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

    /**Insertar la Pre Reserva */
    static public function ctrInsertarPreReserva($valIdHabitaci, $usuario, $valValorPagar, $valCodReserva, $valDescriRese, $valFechaIngre, $valFechaSalid, $estado, $valDiasEstadi){
        
        $tabla1 = "reservas";

        $respuesta = ModeloReservas::mdlInsertarPreReserva($tabla1,  $valIdHabitaci, $usuario,  $valValorPagar, $valCodReserva, $valDescriRese,  $valFechaIngre, $valFechaSalid, $estado, $valDiasEstadi);

        return $respuesta;

    }

    /**Mostramos última reserva de un usuario (Esto para el tema de la pre reserva) */
    static public function ctrMostrarPreReserva($usuario){

        $tabla1 = "reservas";
        $tabla2 = "habitaciones";

        $respuesta = ModeloReservas::mdlMostrarPreReserva($tabla1, $tabla2, $usuario);
        return $respuesta;

    }

    /**Actualizamos la pre reserva si la cookie tiene comportamiento de solapamiento */
    static public function ctrActualizarPreReserva($pre_id_reserva, $valIdHabitaci, $usuario, $valValorPagar, $valCodReserva, $valDescriRese, $valFechaIngre, $valFechaSalid, $estado, $valDiasEstadi){

        $tabla1 = "reservas";
        $respuesta = ModeloReservas::mdlActualizarPreReserva($tabla1, $pre_id_reserva, $valIdHabitaci, $usuario, $valValorPagar, $valCodReserva, $valDescriRese, $valFechaIngre, $valFechaSalid, $estado, $valDiasEstadi);
        return $respuesta;

    }

}

?>