<?php 

require_once "../controladores/ruta.controlador.php";
/**CARTA DEL RESTAURANTE */
require_once "../controladores/carta.controlador.php";
require_once "../modelos/carta.modelo.php";

Class TablaCarta{

    /**MOSTRAR LA CARTA DE PRODUCTOS */
    public function mostrarTablaCarta(){

        $carta = ControladorCarta::ctrMostrarCartaCount();
        $servidor = ControladorRuta::ctrServidor();

        //number_format($value["continental_baja"] , 0, ',', '.');

        $datosJSON = '{
            "data": [';

            for($i = 0; $i < count($carta); $i ++){

                $tipoBD = $carta[$i]["tipo"];
                $tipoComidaCarta = $tipoBD == "A" ? "<h4><span class='badge badge-pill badge-primary'>Almuerzo</span></h4>" : ($tipoBD == 
                                              "D" ? "<h4><span class='badge badge-pill badge-success'>Desayuno</span></h4>" : ($tipoBD == 
                                              "M" ? "<h4><span class='badge badge-pill badge-warning'>Para Cualquier Momento</span></h4>" : ($tipoBD == 
                                              "H" ? "<h4><span class='badge badge-pill badge-info'>Helado</span></h4>" : ($tipoBD == 
                                              "C" ? "<h4><span class='badge badge-pill badge-secondary'>Cena</span></h4>" : "<span class='badge badge-pill badge-warning'>Para Cualquier Momento</span>"))));

                $imagen = "<img src='".$servidor."".$carta[$i]["img"]."' width='315px'>";

                $datosJSON .= '[
                        "'.$imagen.'",
                        "'.$carta[$i]["nombre"].'",
                        "'.$carta[$i]["descripcion"].'",
                        "'.$tipoComidaCarta.'",
                        "'.'$ '.number_format($carta[$i]["precio"], 0, ',', '.').'"
                ],';

            }

            /**Al principio no nos toque nada pero el último caracter quítelo
            * Esto para quitar la , que queda al final y que daña la estructura del JSON.*/
            $datosJSON = substr($datosJSON , 0 , -1);

            $datosJSON .= ']
        }';

        
        echo $datosJSON;

    }

}

/**ACTIVAMOS LA TABLA DE CARTA DEL HOTEL */
$activarCarta = new TablaCarta();
$activarCarta -> mostrarTablaCarta();

?>