<?php

session_start(); /**Para manejar variables de sesión ... */
$ruta = ControladorRuta::ctrRuta();
$servidor = ControladorRuta::ctrServidor();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

	<title>Hotel Alphus</title>

	<base href="vistas/">

	<link rel="icon" href="img/iconoAlphus.png">

	<!--=====================================
	VÍNCULOS CSS
	======================================-->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- Fuente Open Sans y Ubuntu -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300|Ubuntu" rel="stylesheet">

	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="css/plugins/bootstrap-datepicker.standalone.min.css">

	<!-- jdSlider -->
	<link rel="stylesheet" href="css/plugins/jquery.jdSlider.css">

	<!-- Pano -->
	<link rel="stylesheet" href="css/plugins/jquery.pano.css">

	 <!-- fullCalendar -->
	<link rel="stylesheet" href="css/plugins/fullcalendar.min.css">

	<!-- Hoja de estilo personalizada -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/habitaciones.css">
	<link rel="stylesheet" href="css/reservas.css">
	<link rel="stylesheet" href="css/perfil.css">
	<link rel="stylesheet" href="css/carta.css">

	<!--=====================================
	VÍNCULOS JAVASCRIPT
	======================================-->

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

	<!-- bootstrap datepicker -->
	<!-- https://bootstrap-datepicker.readthedocs.io/en/latest/ -->
	<script src="js/plugins/bootstrap-datepicker.min.js"></script>

	<!-- https://easings.net/es# -->
	<script src="js/plugins/jquery.easing.js"></script>

	<!-- https://markgoodyear.com/labs/scrollup/ -->
	<script src="js/plugins/scrollUP.js"></script>

	<!-- jdSlider -->
	<!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
	<script src="js/plugins/jquery.jdSlider-latest.js"></script>

	<!-- Pano -->
	<!-- https://www.jqueryscript.net/other/360-Degree-Panoramic-Image-Viewer-with-jQuery-Pano.html -->
	<script src="js/plugins/jquery.pano.js"></script>

	<!-- fullCalendar -->
	<!-- https://momentjs.com/ -->
	<script src="js/plugins/moment.js"></script>
	<!-- https://fullcalendar.io/docs/background-events-demo -->	
	<script src="js/plugins/fullcalendar.min.js"></script>

	<!-- MD5 Encrypt -->
	<!-- Encriptar en modo MD5 -->
	<script src="js/plugins/md5-min.js"></script>

	<!--=====================================
	VÍNCULOS PARA TODO EL TEMA DE DATATABLES
	======================================-->
	<!-- V1 -->
	<!-- <link rel="stylesheet" href="plugins/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  	<link rel="stylesheet" href="plugins/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

	<script src="plugins/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="plugins/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="plugins/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
	<script src="plugins/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script> -->

	<!-- V2 -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

	<script src="plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

	<script src="plugins/pdfmake/pdfmake.min.js"></script>
	<script src="plugins/pdfmake/vfs_fonts.js"></script>

	<!-- PARA EL TEMA DE MERCADO PAGO 2022 - CHECKOUT PRO -->
	<script src="https://sdk.mercadopago.com/js/v2"></script>

	<!-- PARA EL TEMA DE LA API DE PAYPAL 2022 -->
	<script src="https://www.paypal.com/sdk/js?client-id=AfPw6xeLUyRpTG05i7pw6vlLzvRsNadhRusNgvr-HNqqBf24jIRmpfBVEqiDaDXtk7PXjWaUW4wY77PT&currency=USD"></script>

	<!-- Sweet Alert -->
    <!-- https://sweetalert2.github.io/ -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

	<!-- Encriptar con CryptJS -->
	<script src="js/plugins/crypto-js.min.js"></script>



</head>
<body onload="deshabilitaRetroceso()">

<?php

include "paginas/modulos/header.php";



/**Por la naturaleza del Front así como encotrarsen en posición Fixed y que no se cruce con las demás páginas, ubicamos estos modales
 * por encima de las demás páginas para evitar errores */
include "paginas/modulos/modal.php";

/*=============================================
PÁGINAS
=============================================*/

$rutas = array();

if(isset($_GET["pagina"])){

	/**Ajustamos el tema por si nos viene otro parámetro además de ruta
	 * Entonces, en $rutas[0] tengo la ruta o URL amigable y en [1] tengo temas de paginación.
	 * Podría agregar mas elemenos si llega a ser el caso.*/
	$rutas = explode("/" , $_GET["pagina"]);

	/**Generaremos la lista blanca para el tema de las habitaciones*/
	$rutasCategorias = ControladorCategorias::ctrMostrarCategoriasActivos();

	foreach ($rutasCategorias as $key => $value) {

		if($rutas[0] == $value["ruta"]){
	
			include "paginas/habitaciones.php";
	
		}

	}

	/**Validamos el correo electrónico */
	$item = "email_encriptado";
	$valor = $_GET["pagina"]; /**Lo que sigue luego del dominio, es el email encriptado */
	$validarCorreo = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

	if($validarCorreo){
		
		if($validarCorreo["email_encriptado"] == $_GET["pagina"]){
			/**Actualizamos en la base de datos */
			$id = $validarCorreo["id_u"];
			$item = "verificacion";
			$valor = 1;
			$verificarUsuario = ControladorUsuarios::ctrActualizarUsuario($id, $item, $valor);
			
			if($verificarUsuario == "ok"){
				/**Correo validado */
	
				echo "<script>
	
						window.location.replace('http://localhost/reservas-alphus/cuenta-verificada');
	
					</script>";
	
				return;
	
			}

		}

	}


	/**Generaremos la lista blanca para el tema de la carta*/
	$rutasCarta = ControladorCarta::ctrMostrarCartaCount();

	foreach ($rutasCarta as $key2 => $value2) {
		
		if($rutas[0] == $value2["ruta"]){
	
			include "paginas/carta.php";
	
		}

	}

	/**Lista blanca de páginas internas */
	if($rutas[0] == "reservas" || $rutas[0] == "perfil" || $rutas[0] == "carta" || $rutas[0] == "perfil-pre" || $rutas[0] == "cuenta-verificada" || $rutas[0] == "salir"){

		include "paginas/".$rutas[0].".php"; //Lo que nos traiga la URL .php

	}

}else{

	include "paginas/inicio.php";

}


/*=============================================
PÁGINAS
=============================================*/


include "paginas/modulos/footer.php";

?>

<input type="hidden" value="<?php echo $ruta ?>" id="urlPrincipal">
<input type="hidden" value="<?php echo $servidor ?>" id="urlServidor">

<script src="js/plantilla.js"></script>
<script src="js/carta.js"></script>
<script src="js/listaReservas.js"></script>
<script src="js/menu.js"></script>
<script src="js/idiomas.js"></script>
<script src="js/habitaciones.js"></script>
<script src="js/reservas.js"></script>
<script src="js/usuarios.js"></script>

<!-- VAMOS A INCORPORAR EL SCRIPT NECESARIO PARA FACEBOOK -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '359932816188630',
      xfbml      : true,
      version    : 'v13.0'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
	
</body>
</html>