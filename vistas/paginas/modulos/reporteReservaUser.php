<?php

// require_once "../controladores/ruta.controlador.php";
// /**RESERVAS DEL HOTEL */
// require_once "../controladores/reservas.controlador.php";
// require_once "../modelos/reservas.modelo.php";

/**PLANTILLA Y RUTA */
require_once "../../../controladores/plantilla.controlador.php";
require_once "../../../controladores/ruta.controlador.php";

/**RESERVAS DE HABITACIÓN */
require_once "../../../controladores/reservas.controlador.php";
require_once "../../../modelos/reservas.modelo.php";

$ruta = ControladorRuta::ctrRuta();
$servidor = ControladorRuta::ctrServidor();
session_start(); /**Para manejar variables de sesión ... */

ob_start(); /**Preparamos el buffer para llenarlo con la información, de aquí en adelante se guarda todo el HTML */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Reservas Usuario</title>

    <base href="vistas/">

	<link rel="icon" href="../../img/iconoAlphus.png">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>

<div class="container-fluid bg-white p-0 pb-5 mb-5">
	
	<!-- <div class="container"> -->

        <div class="row">

            <div class="col-12 d-none d-lg-block"></div>

                <div class="col-12" style="margin-left: -12px; margin-top: 25px;">

                    <table class="table table-default table-bordered table-hover">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th width="20%">Visualización</th>
                                <th width="40%">Descripción </th>
                                <th width="25%">Testimonial </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                            
                                $usuarioListReservas  = $_SESSION["id"];
                                $reservasListReservas = ControladorReservas::ctrMostrarReservasUsuario($usuarioListReservas);
                                $servidorListReservas = ControladorRuta::ctrServidor();			


                                foreach ($reservasListReservas as $key => $value) {

                                        $valorReserva = "$ ".number_format($value["pago_reserva"], 0, ',', '.');
                                        $fechaInicioFormateada = date_create_from_format("Y-m-d", $value["fecha_ingreso"])->format("d-M-Y");
                                        $fechaFinFormateada = date_create_from_format("Y-m-d", $value["fecha_salida"])->format("d-M-Y");

                                        $testimonio = ControladorReservas::ctrMostrarTestimonios("id_reserva_t" , $value["id_reserva"]);

                                    echo '
                                    <tr>
                                        
                                        <td><img src="'. $servidorListReservas.$value["img"] .'" class="img-fluid" width="100%" title="'.$value["descripcion_reserva"].'"></td>
                                        <td>'."<b>Cod. Reserva:</b> ".$value["codigo_reserva"]." - <br><b>Descripción General:</b> ".$value["descripcion_reserva"]."<br><hr>"."<b>Fecha Ingreso: </b>".$fechaInicioFormateada."<br>"."<b>Fecha Salida: </b>".$fechaFinFormateada."<br>"."<b>Valor Reserva: </b>".$valorReserva.'</td>
                                        <td>Testimonial: '.$testimonio[0]["testimonio"].'</td>

                                    </tr>';

                                }

                            ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    <!-- </div> -->

</div>

</body>
</html>

<?php
    $html = ob_get_clean(); /**Capturamos el archivo HTML */
    //echo $html;

    /**Incluimos DOMPDF */
    /**https://github.com/dompdf/dompdf/releases */
    require_once '../../librerias/dompdf/autoload.inc.php';    
    /**Creo el objeto para trabajar con las funcionalidades */
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();

    /**Activamos la opción que me permite mostrar imágenes */
    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);
    
    /**Cargamos el HTML */
    $dompdf->loadHtml($html);

    /**Creamos el documento en formato de carta*/
    $dompdf->setPaper('letter'); 
    //$dompdf->setPaper('A4', 'landscape'); //Otra opción
    
    $dompdf->render();
    $dompdf->stream("ReporteReservasUsuario_.pdf", array("Attachment" => false)); //False no se descarga directamente, se visualiza primero, true se descarca inmediatamente

?>