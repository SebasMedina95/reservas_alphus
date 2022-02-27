<?php 

/**HABITACIONES - DENTRO CATEGORÍAS */
require_once "../controladores/reservas.controlador.php";
require_once "../modelos/reservas.modelo.php";

Class AjaxReservas{

    /********************** */
    /**TRAEMOS LAS RESERVAS */
    /********************** */

    public $idHabitacion;

    /**No puede ser estático, pues lo ejecutamos inmediatamente */
    public function ajaxTraerReserva(){

        $valor = $this->idHabitacion;
        $respuesta = ControladorReservas::ctrMostrarReservas($valor);
        /**Devolvemos en datos JSON */
        echo json_encode($respuesta);       

    }

    /***************************************** */
    /**TRAEMOS LAS RESERVAS A PARTIR DEL CÓDIGO*/
    /***************************************** */

    public $codigoReserva;

    /**No puede ser estático, pues lo ejecutamos inmediatamente */
    public function ajaxTraerCodigoReserva(){

        $valor = $this->codigoReserva;
        $respuesta = ControladorReservas::ctrMostrarCodigoReserva($valor);
        /**Devolvemos en datos JSON */
        echo json_encode($respuesta);       

    }

}

/********************** */
/**TRAEMOS LAS RESERVAS */
/********************** */
/**Nos esta llegando desde donde solicitamos la variable POST idHabitacion? */
if(isset($_POST["idHabitacion"])){

    $idHabitacion = new AjaxReservas();
    $idHabitacion -> idHabitacion = $_POST["idHabitacion"];
    $idHabitacion -> ajaxTraerReserva();

}

/***************************************** */
/**TRAEMOS LAS RESERVAS A PARTIR DEL CÓDIGO*/
/***************************************** */
if(isset($_POST["codigoReserva"])){

    $codigoReserva = new AjaxReservas();
    $codigoReserva -> codigoReserva = $_POST["codigoReserva"];
    $codigoReserva -> ajaxTraerCodigoReserva();

}


?>