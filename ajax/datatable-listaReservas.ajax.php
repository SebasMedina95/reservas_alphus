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
        $ruta = ControladorRuta::ctrRuta();

        if($reservas){

            $datosJSON = '{
                "data": [';
    
                for($i = 0; $i < count($reservas); $i ++){

                    /**Voy a tomar la primera imágen de la galería */
                    /**Convertimos el String de galería en una Array. Esto lo hacemos por que no necesitamos traer de todas las habitaciones
					   si no solamente de la que estémos parados en ese momento. **/
                    $galeria = json_decode($reservas[$i]["galeria"], true);
                    $imagenGaleria = $galeria[0]; /**Cojamos la primera... */
                    
                    /**Consultamos testimoniales ... */
                    $testimonio = ControladorReservas::ctrMostrarTestimonios("id_reserva_t" , $reservas[$i]["id_reserva"]);
                    
                    $botones = "<button title='Actualizar Testimonial de la Reserva' type='button' class='editarTestimonio ml-1 btn btn-sm btn-warning text-white' data-toggle='modal' data-target='#actualizarTestimonio' idTestimonioEdit='".$testimonio[0]["id_testimonio"]."' editarTestimonio='".$testimonio[0]["testimonio"]."'><i class='fas fa-edit'></i></button><button title='Ver Testimonial de la Reserva' type='button' class='visualizarTestimonio ml-1 btn btn-sm btn-primary text-white' data-toggle='modal' data-target='#verTestimonio' valTestimonio='".$testimonio[0]["testimonio"]."'><i class='fas fa-eye'></i></button>";

                    $otheBotones = "<a href='#' target='_blanck'><button title='Imprimir Comprobante de la Reserva' idReservaGenerarTicket='".$reservas[$i]["id_reserva"]."' class='generarTicket ml-1 btn btn-sm btn-success text-white'><i class='far fa-file-alt'></i></button></a>";
    
                    $valorReserva = "$ ".number_format($reservas[$i]["pago_reserva"], 0, ',', '.');

                    $imagen = "<img src='". $servidor.$imagenGaleria ."' class='img-fluid' width='100%' title='".$reservas[$i]["descripcion_reserva"]."'>";

                    $fechaInicioFormateada = date_create_from_format("Y-m-d", $reservas[$i]["fecha_ingreso"])->format("d-M-Y");
                    $fechaFinFormateada = date_create_from_format("Y-m-d", $reservas[$i]["fecha_salida"])->format("d-M-Y");
    
                    $datosJSON .= '[
                            "'.$imagen.'",
                            "'.$reservas[$i]["codigo_reserva"].'",
                            "'.$fechaInicioFormateada.'",
                            "'.$fechaFinFormateada.'",
                            "'.$valorReserva.'",
                            "'.$botones.'",
                            "'.$reservas[$i]["descripcion_reserva"].'",
                            "'.$otheBotones.'",
                            "'.$testimonio[0]["testimonio"].'"
                            
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
                            "'.$botones.'",
                            "'.$botones.'",
                            "'.$botones.'",
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