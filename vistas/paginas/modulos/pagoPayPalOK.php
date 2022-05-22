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

                        <h5 class="text-center">Transacción realizada mediante la  <b>API PayPal</b>.</h5>

                        <img src="../../img/payment-method/paypal.jpg" class="img-fluid" width="300">

                        <h5 class="h5DivPagadoMP">Apreciado(a) cliente, el pago mediante la pasarela de pago PAYPAL fue registrada en nuestro sistema, lo invitamos a visitar nuevamente nuestra página Web, en la opción de Perfil, para ver la información sobre la reserva que recien usted a efectuado. Por favor no olvide imprimir el comprobante de pago generado por la pasarela digital y por la API así como generar el comprobante de nuestro sistema, para que lo tenga a la mano el día de redimir su reserva en nuestras instalaciones.</h5>

                        <?php

                            /**http://localhost/reservas-alphus/vistas/paginas/modulos/pagoPayPalOK.php?id=4TH39621V8555921M&order=COMPLETED&medTransaction=API%20PayPal&pasarelaPago=PayPal&newStatus=1&codRes=RES-AM8XHW700T4 */
                            /**Recibo las variables GET */
                            
                            if(isset($_GET["codRes"])){
                                $idPaypal = $_GET["id"];
                                $orderPaypal = $_GET["order"];
                                $medPagoPaypal = $_GET["medTransaction"];
                                $pasarelaPaypal = $_GET["pasarelaPago"];
                                $estadoResPaypal = $_GET["newStatus"];
                                $reservaPayPal = $_GET["codRes"];
                            }
                            
                            $cliente = "<b>Señor(a)</b>: Juan Sebastian Medina Toro.";

                            echo "<h3><b>¡ EL PAGO FUE EXITOSO ! </b></h3>";
                            echo '
                                <div class="grid-item">
                                    <img src="../../img/Ok-PNG-Background.png" class="img-fluid" width="150">
                                </div>
                                <hr>
                            ';

                            /**VAMOS A REALIZAR LA ACTUALIZACIÓN DE CAMPOS DE LA BD gracias al Código Reserva */
                            $ajustarReserva = ControladorReservas::ctrAjustarReserva($reservaPayPal, $idPaypal, $orderPaypal, $medPagoPaypal, $pasarelaPaypal, $estadoResPaypal);

                            echo "<b>Id de Transacción:</b> ".$idPaypal."<br>";
                            echo "<b>Estado Final:</b> ".$estadoResPaypal."<br>";
                            echo "<b>Medio Pago:</b> ".$medPagoPaypal."<br>";
                            echo "<b>Status PayPal:</b> ".$orderPaypal."<br>";
                            echo "<b>Código Reserva:</b> ".$reservaPayPal."<br>";
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