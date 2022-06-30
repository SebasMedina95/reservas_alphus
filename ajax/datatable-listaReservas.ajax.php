<?php 

require_once "../controladores/ruta.controlador.php";
/**RESERVAS DEL HOTEL */
require_once "../controladores/reservas.controlador.php";
require_once "../modelos/reservas.modelo.php";

/**Activamos las variables de sesión */
session_start(); /**Para manejar variables de sesión ... */

Class TablaReservas{

    /**MOSTRAR LAS RESERVAS REALIZADAS */
    public function mostrarTablaReservas(){

        $usuario = $_SESSION["id"];
        $reservas = ControladorReservas::ctrMostrarReservasUsuario($usuario);
        $servidor = ControladorRuta::ctrServidor();

        if($reservas){

            $datosJSON = '{
                "data": [';
    
                for($i = 0; $i < count($reservas); $i ++){
    
                    $botones = "<button title='Actualizar Testimonial de la Reserva' type='button' class='ml-1 btn btn-sm btn-warning text-white'><i class='fas fa-edit'></i></button><button title='Ver Testimonial de la Reserva' type='button' class='ml-1 btn btn-sm btn-primary text-white'><i class='fas fa-eye'></i></button><button title='Imprimir Comprobante de la Reserva' type='button' class='ml-1 btn btn-sm btn-success text-white'><i class='far fa-file-alt'></i></button>";
    
                    $valorReserva = "$ ".number_format($reservas[$i]["pago_reserva"], 0, ',', '.');
    
                    $datosJSON .= '[
                            "'.($i+1).'",
                            "'.$botones.'",
                            "'.$reservas[$i]["codigo_reserva"].'",
                            "'.$reservas[$i]["fecha_ingreso"].'",
                            "'.$reservas[$i]["fecha_salida"].'",
                            "'.$valorReserva.'",
                            "'.$reservas[$i]["descripcion_reserva"].'"
                    ],';
    
                }
    
                /**Al principio no nos toque nada pero el último caracter quítelo
                * Esto para quitar la , que queda al final y que daña la estructura del JSON.*/
                $datosJSON = substr($datosJSON , 0 , -1);
    
                $datosJSON .= ']
            }';

        }else{

            $datosJSON = '{
                "data": [';
    
                    $botones = "<span class='badge badge-info'>Sin Reservas aún</span>";
    
                    $valorReserva = "$ -";
    
                    $datosJSON .= '[
                            "'.(1).'",
                            "'.$botones.'",
                            "'.$botones.'",
                            "'.$botones.'",
                            "'.$botones.'",
                            "'.$botones.'",
                            "'.$botones.'"
                    ],';
    
                /**Al principio no nos toque nada pero el último caracter quítelo
                * Esto para quitar la , que queda al final y que daña la estructura del JSON.*/
                $datosJSON = substr($datosJSON , 0 , -1);
    
                $datosJSON .= ']
            }';

        }

        echo $datosJSON;
        

    }

}

/**ACTIVAMOS LA TABLA DE CARTA DEL HOTEL */
$activarListaReservas = new TablaReservas();
$activarListaReservas -> mostrarTablaReservas();

?>