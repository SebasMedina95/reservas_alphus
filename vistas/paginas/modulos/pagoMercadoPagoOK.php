<?php 

/**PLANTILLA Y RUTA */
require_once "../../../controladores/plantilla.controlador.php";
require_once "../../../controladores/ruta.controlador.php";

/**RESERVAS DE HABITACIÓN */
require_once "../../../controladores/reservas.controlador.php";
require_once "../../../modelos/reservas.modelo.php";

$ruta = ControladorRuta::ctrRuta();
$servidor = ControladorRuta::ctrServidor();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Alphus - Pago Realizado.</title>

	<link rel="icon" href="../../img/iconoAlphus.png">

    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Fuente Open Sans y Ubuntu -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300|Ubuntu" rel="stylesheet">

    <!-- Hoja de estilo personalizada -->
	<link rel="stylesheet" href="../../css/style.css">

</head>

<body>

    <div class="col-12 col-lg-12 divPagadoMP">

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header bg-white mb-3">

                        <img src="../../img/alphus_complete_banner.png" class="img-fluid" width="500">

                    </div>

                    <div class="card-body bg-white text-center mb-2">

                        <h5 class="text-center">Transacción realizada mediante la  <b>API Mercado Pago</b>.</h5>

                        <img src="../../img/payment-method/mercado_pago.jpg" class="img-fluid" width="300">

                        <h5 class="h5DivPagadoMP">Apreciado(a) cliente, el pago mediante la pasarela de pago MERCADO PAGO fue registrada en nuestro sistema, lo invitamos a visitar nuevamente nuestra página Web, en la opción de Perfil, para ver la información sobre la reserva que recien usted a efectuado. Por favor no olvide imprimir el comprobante de pago generado por la pasarela digital y por la API así como generar el comprobante de nuestro sistema, para que lo tenga a la mano el día de redimir su reserva en nuestras instalaciones.</h5>

                        <?php

                        $payment = '';
                        $status = '';
                        $type_trans = '';
                        $order_id = '';
                        $cliente = '';

                        if(isset($_GET['payment_id'])){
                            $payment = $_GET['payment_id'];
                            $status = $_GET['status'];
                            $type_trans = $_GET['payment_type'];
                            $order_id = $_GET['merchant_order_id'];
                        }

                        $reserva = $_COOKIE["codigoReserva"];
                        $cliente = "<b>Señor(a)</b>: Juan Sebastian Medina Toro.";
                        $pasarela = 'Mercado Pago';
                        $estado = '1';

                        /**VAMOS A REALIZAR LA ACTUALIZACIÓN DE CAMPOS DE LA BD gracias al Código Reserva */
                        $ajustarReserva = ControladorReservas::ctrAjustarReserva($reserva, $payment, $order_id, $type_trans, $pasarela, $estado);

                        echo "<h3><b>¡ EL PAGO FUE EXITOSO ! </b></h3>";
                        echo '
                            <div class="grid-item">
                                <img src="../../img/Ok-PNG-Background.png" class="img-fluid" width="150">
                            </div>
                            <hr>
                        ';

                        echo "<b>Id de Transacción:</b> ".$payment."<br>";
                        echo "<b>Estado Final:</b> ".$status."<br>";
                        echo "<b>Medio Pago:</b> ".$type_trans."<br>";
                        echo "<b>Númerio Orden:</b> ".$order_id."<br>";
                        echo "<b>Código Reserva:</b> ".$reserva."<br>";
                        echo "".$cliente."<br>";

                        /******* --- MATO LA COOKIE FALTANTE --- *******/
                        echo '<script>
                                                                
                                document.cookie = "codigoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";			

                            </script>';

                        ?>
                    
                    </div>

                    <div class="card-footer d-flex bg-white">

                        <div class="container">

                            <div class="row align-items-end">

                                <hr>

                                <div class="col-md-12">

                                    <a class="btn btn-success" href="<?php echo $ruta."perfil" ?>">

                                        <i class="fas fa-undo"></i> Volver al Hotel

                                    </a>

                                </div>

                            </div>
                            
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>