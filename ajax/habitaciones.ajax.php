<?php 

/**HABITACIONES - DENTRO CATEGORÍAS */
require_once "../controladores/habitaciones.controlador.php";
require_once "../modelos/habitaciones.modelo.php";

Class AjaxHabitaciones{

    public $ruta;

    /**No puede ser estático, pues lo ejecutamos inmediatamente */
    public function ajaxTraerHabitacion(){

        $valor = $this->ruta;
        $respuesta = ControladorHabitaciones::ctrMostrarHabitaciones($valor);
        /**Devolvemos en datos JSON */
        echo json_encode($respuesta);       

    }

}

/**Nos esta llegando desde donde solicitamos la variable POST ruta? */
if(isset($_POST["ruta"])){

    $ruta = new AjaxHabitaciones();
    $ruta -> ruta = $_POST["ruta"];
    $ruta -> ajaxTraerHabitacion();

}


?>