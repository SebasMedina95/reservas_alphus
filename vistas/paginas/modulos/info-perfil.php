<?php 

/**TODO, si no tengo la Cookie del Código de la Reserva, debo volver a traerla para
 * garantizar tenerla en el navegador para usarla durante los medios de pago cualquiera
 * sea el que se seleccione, si no, el actualizador final luego de la transacción no funcionará
 * de manera adecuada y se hará la transferencia pero no la reserva, ESTO ES GRAVE!
 * 
 * Lo haremos en el sino / else del isset($_COOKIE["idHabitacion"]){}
 * Pero preguntaremos primero por la variable se session.
 */

if(isset($_COOKIE["idHabitacion"]) && isset($_COOKIE["codigoReserva"])){

	$valIdHabitaci = $_COOKIE["idHabitacion"];
	$valValorPagar = $_COOKIE["pagoReserva"];
	$valCodReserva = $_COOKIE["codigoReserva"];
	$valDescriRese = $_COOKIE["infoHabitacion"];
	$valFechaIngre = $_COOKIE["fechaIngreso"];
	$valFechaSalid = $_COOKIE["fechaSalida"];
	$valDiasEstadi = $_COOKIE["dias"]; 
	$valImgHabitac = $_COOKIE["imgHabitacion"];
	$usuario = $_SESSION["id"];
	/**Estados: 1. Pagado, 2. Cancelado, 3.Espera */
	$estado = '3';

	/**Debemos validar si la persona anteriormente no tiene otras reservas en estado 3,
	 * para simular el comportamienot del as cookies completamente, si se encuentra una anterior en esta condicion, 
	 * lo que se hará es que se actualizara la pre reserva con los nuevos datos. */

	/**Pregunto si primero este usuario no tiene una pre reserva registrada de la cual se debe hacer cargo: */
	$mostrarPreReserva = ControladorReservas::ctrMostrarPreReserva($usuario);

	if($mostrarPreReserva){

		echo 'Swal.fire({
			position: "bottom",
			icon: "success",
			title: "HABÍAN PRE RESERVAS - ACTUALIZAMOS.",
			showConfirmButton: false,
			timer: 3000
		  }).then(function(result){

			if(result.value){   
				history.back();
			} 
		});';

		/**Tienes una pre reserva pendiente por procesar, por ende, esta será la que te mostraré
		 * Ahora, solaparé estos valores con la reserva que ya existe en la BD con lo nuevo que haya
		 * realizado el cliente al reservar */

		/**Me traigo la reserva para tener el foco de actualización */
		$pre_id_reserva = $mostrarPreReserva["id_reserva"];

		/**Actualizo con las nuevas cookies: */
		$actualizarPreReserva = ControladorReservas::ctrActualizarPreReserva($pre_id_reserva, $valIdHabitaci, $usuario, $valValorPagar, $valCodReserva, $valDescriRese, $valFechaIngre, $valFechaSalid, $estado, $valDiasEstadi);

		/**Traigo nuevamente la última reserva pero actualizada */
		$traerPreReservaUpdate = ControladorReservas::ctrMostrarPreReserva($usuario);

		/**Defino las variables que me trae la consulta */
		$pre_id_reserva = $traerPreReservaUpdate["id_reserva"];
		$pre_id_habitacion = $traerPreReservaUpdate["id_habitacion"];
		$pre_id_usuario = $traerPreReservaUpdate["id_usuario"];
		$pre_pago_reserva = $traerPreReservaUpdate["pago_reserva"];
		$pre_codigo_reserva = $traerPreReservaUpdate["codigo_reserva"];
		$pre_descripcion_reserva = $traerPreReservaUpdate["descripcion_reserva"];
		$pre_fecha_ingreso = $traerPreReservaUpdate["fecha_ingreso"];
		$pre_fecha_salida = $traerPreReservaUpdate["fecha_salida"];
		$pre_fecha_reserva = $traerPreReservaUpdate["fecha_reserva"];
		$pre_estado_pago = $traerPreReservaUpdate["estado_pago"];
		$pre_dias_reserva = $traerPreReservaUpdate["dias"];

		$galeria = json_decode($traerPreReservaUpdate["galeria"], true);

		$pre_imagen_habitacion = $servidor.$galeria[0];

	}else{

		echo 'Swal.fire({
			position: "bottom",
			icon: "success",
			title: "NO HABÍAN PRE RESERVAS - INSERTAMOS.",
			showConfirmButton: false,
			timer: 3000
		  }).then(function(result){

			if(result.value){   
				history.back();
			} 
		});';

		/**No tienes pre reservas, por tanto colocaremos la nueva que se está realizando */
		/**Vamos a insertar primero la data con un estado de espera. */
		$preReserva = ControladorReservas::ctrInsertarPreReserva($valIdHabitaci, $usuario, $valValorPagar, $valCodReserva, $valDescriRese, $valFechaIngre, $valFechaSalid, $estado, $valDiasEstadi);

		/**Ahora, como se pre inserto, aún si alteran las cookies, por medio de una consulta
		 * SQL que busque por el usuairo activo y la ultima reserva registrada por su fecha podemos obtener la data que necesitamos
		 * para mandar a los parámetros las pasarelas de pago. **/

		$traerPreReservaInsert = ControladorReservas::ctrMostrarPreReserva($usuario);

		/**Defino las variables que me trae la consulta */
		$pre_id_reserva = $traerPreReservaInsert["id_reserva"];
		$pre_id_habitacion = $traerPreReservaInsert["id_habitacion"];
		$pre_id_usuario = $traerPreReservaInsert["id_usuario"];
		$pre_pago_reserva = $traerPreReservaInsert["pago_reserva"];
		$pre_codigo_reserva = $traerPreReservaInsert["codigo_reserva"];
		$pre_descripcion_reserva = $traerPreReservaInsert["descripcion_reserva"];
		$pre_fecha_ingreso = $traerPreReservaInsert["fecha_ingreso"];
		$pre_fecha_salida = $traerPreReservaInsert["fecha_salida"];
		$pre_fecha_reserva = $traerPreReservaInsert["fecha_reserva"];
		$pre_estado_pago = $traerPreReservaInsert["estado_pago"];
		$pre_dias_reserva = $traerPreReservaInsert["dias"];

		$galeria = json_decode($traerPreReservaInsert["galeria"], true);

		$pre_imagen_habitacion = $servidor.$galeria[0];
	}

	/**Mato las Cookies por que ya obtuve la data
	 * Dejo viva la de código reserva para obtenerla luego en el form respuesta y re consultar la reserva para actualizar los campos faltantes.
	 * Una vez actualizados se mata la cookie faltante, si la persona altera la cookie, no supondra un error de seguridad, por el contrario, el usuario
	 * perderá su compra por que no se encontrará la reserva.*/
	echo '<script>
								    	
			document.cookie = "idHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "imgHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "infoHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "pagoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			
			document.cookie = "fechaIngreso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "fechaSalida=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "dias=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";			

		</script>';

}else{

	$usuario = $_SESSION["id"];
	/**La Cookie no existe, entonces generamos la consulta ... */
	$traerPreReserva = ControladorReservas::ctrMostrarPreReserva($usuario);

	
	if($traerPreReserva){
		/**Defino las variables que me trae la consulta */
		$pre_id_reserva = $traerPreReserva["id_reserva"];
		$pre_id_habitacion = $traerPreReserva["id_habitacion"];
		$pre_id_usuario = $traerPreReserva["id_usuario"];
		$pre_pago_reserva = $traerPreReserva["pago_reserva"];
		$pre_codigo_reserva = $traerPreReserva["codigo_reserva"];
		$pre_descripcion_reserva = $traerPreReserva["descripcion_reserva"];
		$pre_fecha_ingreso = $traerPreReserva["fecha_ingreso"];
		$pre_fecha_salida = $traerPreReserva["fecha_salida"];
		$pre_fecha_reserva = $traerPreReserva["fecha_reserva"];
		$pre_estado_pago = $traerPreReserva["estado_pago"];
		$pre_dias_reserva = $traerPreReserva["dias"];
	
		$galeria = json_decode($traerPreReserva["galeria"], true);
	
		$pre_imagen_habitacion = $servidor.$galeria[0];

		/**Entonces, si ya no tenemos la Cookie por que se venció o se elimino ya bajo algún proceso de pago,
		 * y adicional a esto, el usuario tenía la reserva pendiente, lo mas adecuado será borrar esta info de
		 * la base de datos y presentar el perfil con normalidad, para evitar llenar de basura el sistema y que
		 * no se vea imagenes residuales de una reserva que debería haber muerto por el pago/espera de pago.
		 * 
		 * Si el usuario vuelve, tendrá que volver a realizar el proceso de reserva. */
		if(!isset($_COOKIE["codigoReserva"])){

			$eliminarPreReserva = ControladorReservas::ctrEliminarPreReserva($pre_codigo_reserva);

		}

	}

	/**Por prevención, vuelvo y mato lo que haya activo si es el caso pero dejo la de la reserva */
	echo '<script>
								    	
			document.cookie = "idHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "imgHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "infoHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "pagoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			
			document.cookie = "fechaIngreso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "fechaSalida=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "dias=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";			

		</script>';

}

/**VAMOS A MOSTRAR LA INFORMACIÓN DINÁMICA DEL PERFIL */
$itemLogeado = "id_u"; /**Columna Id del usuario en el sistema */
$valorLogeado = $_SESSION["id"]; /**Valor, viene en la variable de sesión */
$usuarioLogeado = ControladorUsuarios::ctrMostrarUsuario($itemLogeado, $valorLogeado);

/**Carguemos el listado de reservas ya realizadas indiferente del caso */
$lasReservas = ControladorReservas::ctrMostrarReservasUsuario($valorLogeado);

/**Capturamos la fecha actual */
$hoy = date("Y-m-d");
$noVencidas = 0;
$vencidas = 0;

foreach ($lasReservas as $key => $value) {
	if($hoy >= $value["fecha_ingreso"]){
		$vencidas++;
	}else{
		$noVencidas++;
	}
}

?>

<!--=====================================
INFO PERFIL
======================================-->

<div class="infoPerfil container-fluid bg-white p-0 pb-5 mb-5">
	
	<div class="container">
		
		<div class="row">

			<!--=====================================
			BLOQUE IZQ
			======================================-->
			
			<div class="col-12 col-lg-4 colIzqPerfil p-0 px-lg-3">
				
				<div class="cabeceraPerfil pt-4">

				<?php if($usuarioLogeado["modo"] == "facebook"): ?>

					<a href="#" class="float-left lead text-white pt-1 px-3 mb-4 salir">
						<button class="btn btn-secondary"><i class="fas fa-sign-out-alt"></i> Salir del Perfil</button>
					</a>

				<?php else: ?>

					<a href="<?php echo $ruta;  ?>salir" class="float-left lead text-white pt-1 px-3 mb-4">
						<button class="btn btn-secondary"><i class="fas fa-sign-out-alt"></i> Salir del Perfil</button>
					</a>

				<?php endif; ?>
					

					<div class="clearfix"></div>

					<h1 class="text-white p-2 pb-lg-5 text-center text-lg-left">MI PERFIL</h1>	
				</div>

				<?php //echo '<pre class"bg-white">'; print_r($mostrarPreReserva); echo '</pre>' ?>

				<!--=====================================
				PERFIL
				======================================-->

				<div class="descripcionPerfil">
					
					<figure class="text-center imgPerfil">
						<!-- Si no tenemos fotos, entonces traemos la por defecto del server -->
						<?php if($usuarioLogeado["foto"] == ""): ?>

							<img src="<?php echo $servidor; ?>vistas/img/usuarios/default/default.png" class="img-fluid">
						
						<?php else: ?>
							<!-- Si es en modo directo -->
							<?php if($usuarioLogeado["modo"] == "directo"): ?>
								<img src="<?php echo $servidor.$usuarioLogeado["foto"]; ?>" class="img-fluid rounded-circle" style="width: 250px;">
							<!-- Si es de alguna red social -->
							<?php else: ?>
								<img src="<?php echo $usuarioLogeado["foto"]; ?>" class="img-fluid rounded-circle" style="width: 250px;">
							<?php endif; ?>

						<?php endif; ?>

					</figure>

					<div id="accordion">

						<div class="card">

							<div class="card-header">
								<a class="card-link" data-toggle="collapse" href="#collapseOne">
									MIS RESERVAS
								</a>
							</div>

							<div id="collapseOne" class="collapse show" data-parent="#accordion">

								<ul class="card-body p-0">

									<li class="px-2 misReservas" style="background:#FFFDF4"> <?php echo $noVencidas ?> Reservas por vencerse</li>
									<li class="px-2 text-white misReservas" style="background:#CEC5B6"> <?php echo $vencidas ?> Reservas vencidas</li>

								</ul>

								<!--=====================================
								TABLA RESERVAS MÓVIL
								======================================-->	

								<!-- <div class="d-lg-none d-flex py-2">
									
									<div class="p-2 flex-grow-1">

										<h5>Suite Contemporánea</h5>
										<h5 class="small text-gray-dark">Del 30.08.2018 al 03.09.2018</h5>

									</div>

									<div class="p-2">

										<button type="button" class="btn btn-dark btn-sm text-white"><i class="fas fa-pencil-alt"></i></button>
										<button type="button" class="btn btn-warning btn-sm text-white"><i class="fas fa-eye"></i></button>

									</div>

								</div>

								<hr class="my-0">

								<div class="d-lg-none d-flex py-2">
									
									<div class="p-2 flex-grow-1">

										<h5>Suite Contemporánea</h5>
										<h5 class="small text-gray-dark">Del 30.08.2018 al 03.09.2018</h5>

									</div>

									<div class="p-2">

										<button type="button" class="btn btn-dark btn-sm text-white"><i class="fas fa-pencil-alt"></i></button>
										<button type="button" class="btn btn-warning btn-sm text-white"><i class="fas fa-eye"></i></button>

									</div>

								</div> -->

							</div>

						</div>

						<div class="card">

							<div class="card-header">
								<a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
									MIS DATOS
								</a>
							</div>

							<div id="collapseTwo" class="collapse" data-parent="#accordion">
								<div class="card-body p-0">

									<ul class="list-group">
										
										<li class="list-group-item small"><?php echo $usuarioLogeado["nombre"] ?></li>
										<li class="list-group-item small"><?php echo $usuarioLogeado["email"] ?></li>
										<?php if($usuarioLogeado["modo"] == "directo"): ?>
											<li class="list-group-item small"><?php echo $usuarioLogeado["numero_documento"] ?></li>
											<li class="list-group-item small"><?php echo $usuarioLogeado["celular"] ?></li>
										<?php endif; ?>
										
										<!-- Por que si entramos por redes sociales, es por que la contraseña viene también de allí -->
										<?php if($usuarioLogeado["modo" == "directo"]): ?>
											<li class="list-group-item small">
												<button class="btn btn-dark btn-sm">Cambiar Contraseña</button>
											</li>
										<?php endif; ?>

										<li class="list-group-item small">
											<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#cambiarFotoPerfil">Cambiar Imagen</button>
										</li>

										<!-- MODAL PARA CAMBIAR LA FOTO PERFIL -->
										<div class="modal fade formulario" tabindex="-1" role="dialog" id="cambiarFotoPerfil">

											<div class="modal-dialog">

												<div class="modal-content">
													<!-- Para poder manejar el tema de las imagenes necesitamos enctype="multipart/form-data" por que
													en últimas enviaremos es archivos -->
													<form method="post" enctype="multipart/form-data">	

														<div class="modal-header bg-dark">

															<h4 class="modal-title text-white">Cambiar foto de perfil</h4>

															<button type="button" class="close" data-dismiss="modal">&times;</button>

														</div>

														<div class="modal-body">
															<!-- Oculto para tener el id del usuario para la actualización -->
															<input type="hidden" name="idUsuarioFoto" value="<?php echo $usuarioLogeado["id_u"]; ?>">

															<div class="form-group">

																<input type="file" class="form-control-file border" name="cambiarImagen" required>

																<!-- Para evitar ataques en el sistema de mandar imagene vacias -->
																<input type="hidden" name="fotoActual" value="<?php echo $usuarioLogeado["foto"]; ?>">

															</div>	

														</div>

														<div class="modal-footer d-flex justify-content-between">  

														<div>

															<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

														</div>

														<div>

															<button type="submit" class="btn btn-primary"><i class="far fa-paper-plane"></i> Enviar Imagen</button>

														</div>

														</div>

														<?php

															$cambiarImagen = new ControladorUsuarios();
															$cambiarImagen -> ctrCambiarFotoPerfil();

														?>

													</form>

												</div>

											</div>

										</div>

									</ul>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

			<!--=====================================
			BLOQUE DER
			======================================-->

			<div class="col-12 col-lg-8 colDerPerfil">

				<div class="row">

					<div class="col-6 d-none d-lg-block">
						
						<h4 class="float-left">¡Hola! <?php echo $usuarioLogeado["nombre"]; ?> </h4>

					</div>
					
					<!-- =============================================================== -->
					<!-- =============================================================== -->
					<!-- Implementación de MercadoPago -->
					<div class="col-12">

						<?php if(isset($pre_codigo_reserva)) : ?>

							<!-- Vamos a validar que no se reserve el mismo día que se va ingresar, debemos tener 1 día al menos de ventaja
							para la realización de la reserva, lo tomamos como requerimiento necesario para evitar errores de cruces de información -->
							<?php 
								/**Capturamos año/mes/día actual */
								$hoy = date("Y-m-d");
								/**Variable bandera de validación */
								$validarPagoReserva = false; 		
								
								if($hoy >= $pre_fecha_ingreso || $hoy >= $pre_fecha_salida){

									echo "<h4 class='text-justify float-left alert alert-warning'><b>Lo sentimos, las fechas de la reserva no pueden ser igual o inferiores as la fecha actual.<hr> <a href='".$ruta."' class='text-center btn btn-danger btn-sm'><i class='fas fa-home'></i> Vuelve a intentarlo ajustando las fechas </b></h4>";
									$validarPagoReserva = false;
									
									/**Para evitar que me quede basura, por prevención, aquí eliminaría la pre reserva y forzaría la nueva realización */
									$eliminarPreReserva_hoy = ControladorReservas::ctrEliminarPreReserva($pre_codigo_reserva);

								}else{

									$validarPagoReserva = true;

								}

								/**VALIDAMOS NUEVAMENTE POR PREVENCIÓN EL CRUCE DE LAS FECHAS */
								$validarReservaPP = ControladorReservas::ctrMostrarReservas($pre_id_habitacion);

								if($validarReservaPP != 0){
									
									$opcion1 = [];
									$opcion2 = [];
									$opcion3 = [];

									foreach ($validarReservaPP as $key => $valueReservaPP) {
										
										/**ESCENARIO 1 - Como el que tenemos en el JS.*/
										if($pre_fecha_ingreso == $valueReservaPP["fecha_ingreso"]){
											array_push($opcion1 , false);
										}else{
											array_push($opcion1 , true);
										}

										/**ESCENARIO 2 - Como el que tenemos en el JS.*/
										if($pre_fecha_ingreso > $valueReservaPP["fecha_ingreso"] && $pre_fecha_ingreso < $valueReservaPP["fecha_salida"]){
											array_push($opcion2 , false);
										}else{
											array_push($opcion2 , true);
										}

										/**ESCENARIO 3 - Como el que tenemos en el JS.*/
										if($pre_fecha_ingreso < $valueReservaPP["fecha_ingreso"] && $pre_fecha_salida > $valueReservaPP["fecha_ingreso"]){
											array_push($opcion3 , false);
										}else{
											array_push($opcion3 , true);
										}

										/**Generamos la validación general */
										if($opcion1[$key] == false || $opcion2[$key] == false || $opcion3[$key] == false){
											$validarPagoReserva = false;
											echo "<h4 class='text-justify float-left alert alert-warning'><b>Lo sentimos, las fechas de la reserva que habías seleccionado anteriormente han sido ocupadas hace breve momentos (Alguien ha realizado la reserva primero que usted).<hr> <a href='".$ruta."' class='text-center btn btn-danger btn-sm'><i class='fas fa-home'></i> Vuelve a intentarlo ajustando las fechas</a> </b></h4>";

											/**Para evitar que me quede basura, por prevención, aquí eliminaría la pre reserva y forzaría la nueva realización */
											$eliminarPreReserva_cruces = ControladorReservas::ctrEliminarPreReserva($pre_codigo_reserva);

											/**Rompemos */
											break;
										}else{
											$validarPagoReserva = true;
										}

									}

								}
							
							?>

							<?php if($validarPagoReserva): ?>

								<div class="card">

									<div class="card-header text-white bg-dark mb-3">

										<h5>Tienes una reserva pendiente por pagar: </h5>

									</div>

									<div class="card-body text-center mb-2">

										<input id="preResValue" type="hidden" value="<?php echo $pre_codigo_reserva; ?>">
										<input id="urlDinamica" type="hidden" value="<?php echo $ruta; ?>">

										<h5><?php echo '<b>Identificación de Reserva: </b>'.$pre_codigo_reserva; ?></h5>

										<h5><?php echo $pre_descripcion_reserva; ?></h5>
										
										<input type="hidden" id="infoHabitacion" name="infoHabitacion" class="infoHabitacion" value="<?php echo $pre_descripcion_reserva; ?>">
										
										<figure>

											<img src="<?php echo $pre_imagen_habitacion; ?>" class="img-thumbnail w-60">

										</figure>							

										<h6> Fechas <?php echo $pre_fecha_ingreso; ?> - <?php echo $pre_fecha_salida; ?></h6>

										<h6> Días calculados de reserva: <?php echo $pre_dias_reserva; ?> </h6>

										<h4>$<?php echo number_format($pre_pago_reserva, 0, ',', '.'); ?></h4>

										<hr>

									</div>

									<div class="card-footer d-flex bg-white">

										<div class="row">

											<h5 class="mb-2">A continuación, escoja una forma de pago: </h5>

											<hr>

											<div class="col-md-7 text-center">

												<figure>	

													<img src="img/mercadopago.png" class="img-fluid w-50">

												</figure>

											</div>

											<div class="col-md-5 text-left">

												<?php 

													MercadoPago\SDK::setAccessToken('TEST-3157554975429967-092122-7df1a98d700cad2adff480f74bd23301-527817936');
													$preference = new MercadoPago\Preference();

													$item = new MercadoPago\Item();

													$item->id = $pre_id_habitacion;
													$item->title = "Reserva: " . $pre_codigo_reserva . " - Descripción del pedido: " .$pre_descripcion_reserva;
													$item->quantity = 1;
													$item->unit_price = $pre_pago_reserva;
													$item->currency_id = "COP";
													
													$preference->items = array($item);

													$preference->back_urls = array(
														"success" => $ruta."vistas/paginas/modulos/pagoMercadoPagoOK.php",
														"failure" => $ruta
													);

													//'http://localhost/reservas-alphus/paginas/modulos/pagoMercadoPagoOK.php

													$preference->auto_return = "approved";
													$preference->binary_mode = true;

													$preference->save();
													
												?>

												<div class="checkout-btn mt-1"></div>

												<script>
													const mp = new MercadoPago('TEST-9b199dbd-533a-463d-bd97-35b5deab52b0' , {
														locale : 'es-CO'
													});

													mp.checkout({
														preference : {
															id : '<?php echo $preference->id ?>'
														},
														render : {
															container : '.checkout-btn',
															label : 'Pagar con Mercado Pago'
														},
														theme: {
															elementsColor: '#694C0D'
														}
													})

												</script>

											</div>

											<hr>
											
											<!-- Aqui vamos a trabajar el tema de PayPal -->
											<div class="col-md-7 text-center">

												<figure>	

													<img src="img/paypal.png" class="img-fluid w-50">

												</figure>

											</div>	

											<div class="col-md-5 text-left">

													<!-- <button class="btn btn-info btn-sm-4">Pagar mediante PayPal</button> -->
													<a class="btn btn-info btn-sm-43" href="#modalPagarPaypal" data-toggle="modal">Pagar mediante PayPal</a>

											</div>

											<!-- Aqui vamos a trabajar el tema de Payu -->
											<div class="col-md-7 text-center">

												<figure>	

													<img src="img/payu.png" class="img-fluid w-50">

												</figure>

											</div>	

											<div class="col-md-5 text-left">

													<!-- <button class="btn btn-info btn-sm-4">Pagar mediante Payu</button> -->
													<a class="btn btn-success text-white btn-sm-43" href="#modalPagarPayu" data-toggle="modal">Pagar mediante PayU</a>

											</div>

										</div>

									</div>

								</div>

							<?php endif; /*Este es del validarPagoReserva*/?>

						<?php endif; /*Este si tenemos la variable de la reserva*/?>

					</div>
					<!-- =============================================================== -->
					<!-- =============================================================== -->

					<div class="col-6 d-none d-lg-block"></div>

						<div class="col-12 mt-3">
							
							<table class="table table-responsive table-default table-bordered table-hover dt-responsive tablaListReservas">
								<thead class="thead-dark">
									<tr>
										<th>#</th>
										<th>Comentarios</th>
										<th>Identificación</th>
										<th>Ingreso</th>
										<th>Salida</th>
										<th>Costo</th>
										<th>Descripción</th>
									</tr>
								</thead>
								<tbody>

									<!-- Dinamico gracias a tablaListReservas -->

								</tbody>

							</table>

						</div>

					</div>
			
			</div>

		</div>

	</div>

</div>

<!--=====================================
VENTANA MODAL PAGAR USANDO PAYPAL
======================================-->

<div class="modal fade" tabindex="-1" role="dialog" id="modalPagarPaypal">
	
	 <div class="modal-dialog">
			
		<div class="modal-content">
			
	      	<div class="modal-header bg-info">
	        	<h4 class="modal-title text-white"> Pagar usando PayPal</h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      	</div>
			
	 		<div class="modal-body">
       			
			 	<figure class="text-center">	

					<img src="img/paypal.png" class="img-fluid w-50">

				</figure>
    			
				<p class="py-2 text-center">Relización de pago de reserva mediante la pasarela de pago PayU, para continuar, por favor de click el botón <b>Pagar con PayPal (Pay with PayPal) o también pagar con tarjeta débito o credito (Debit or Credit Card)</b></p>

				<div id="paypal-button-container"></div>
       			
				<script>
					/**Traemos la URL dinámica */
					let urlPrincipalDinamizada = $("#urlDinamica").val();
					/**Usamos el mismo Ajax para comprobar el código de reserva */
					let codigoReserva = $('#preResValue').val();
					// console.log("codigoReserva" , codigoReserva);

					/**Defino las variables */
					var totalReserva;
					var descripReserva; //General
					var descripReservaSplit; //Aplico Split para tomar la primera parte
					var resumeReserva; //Obtengo la pos [0] después del Split (Esto lo uso por que la API de PayPal no admite descripciones muy larga, me da error :( )
					var valorDelDolar;
					var totalReservaDolares;
					var codigoReserAjax; //Capturo el Cod Reserva para actualizar luego la data

					/**Vamos a traernos de manera asincrona el valor pagar con Ajax e info utilidad */
					let datos = new FormData();
  					datos.append("codigoReserva" , codigoReserva);

					$.ajax({
						async: false, /**Aplicamos esta propiedad para que me deje acceder a la colección interna de la respuesta */
						url : urlPrincipalDinamizada+"ajax/reservas.ajax.php",
						method: "POST",
						data: datos,
						cache: false,
						contentType: false,
						processData: false,
						dataType:"json",
						success:function(respuesta){
							//console.log("Mi sesi res => " , respuesta);
							codigoReserAjax = respuesta["codigo_reserva"];
							totalReserva = Number(respuesta["pago_reserva"]);
							descripReserva = respuesta["descripcion_reserva"];
							descripReservaSplit = descripReserva.split('.');
							resumeReserva = descripReservaSplit[0];
							//console.log("totalReserva => " , totalReserva);

						}
					});

					/**Debemos consumir una API https://free.currencyconverterapi.com/, usamos fecth de JS para esto, 
					 * sin embargo, me queda pendiente consultar la manera mas conocida como Async Await para este tema, 
					 * el método actual funciona muy bien y obtenemos la data para la conversión. 
					 * La Key es de nuestras credenciales en la API, es importante no olvidarlo.*/
					
					fetch("https://free.currencyconverterapi.com/api/v6/convert?q=USD_COP&compact=ultra&apiKey=b70256e7598ba6db1481")
						.then(respuesta => respuesta.json())
						.then(resultado => {
							// console.log("Dolares con Fetch JS => " , resultado["USD_COP"]);
							valorDelDolar = Number(resultado["USD_COP"]);
					});

					/**Como la solicitud a la API puede tardar un poco, para evitar el Undefined por ese retardo, colocamos un retardo
					 * de unos 2 segundos para que traiga la data y haga los cálculos para convertir el COP a USD para PayPal. */
					setTimeout(function() {
						// console.log("Imprimiendo valorDelDolar luego de 3 segundos", valorDelDolar);
						totalReservaDolares = Number((parseFloat(totalReserva) / parseFloat(valorDelDolar)).toFixed(2));

						// console.log("(FUERA DE AJAX y del FETCH pero dentro del setTimeOut de 2 Seg ... ) ---> El Dolar hoy es => " , valorDelDolar);
						// console.log("(FUERA DE AJAX y del FETCH pero dentro del setTimeOut de 2 Seg ... ) ---> El Código de la Reserva es => " , codigoReserAjax);
						// console.log("(FUERA DE AJAX y del FETCH pero dentro del setTimeOut de 2 Seg ... ) ---> La Descripción de la Reserva es => " , descripReserva);
						// console.log("(FUERA DE AJAX y del FETCH pero dentro del setTimeOut de 2 Seg ... ) ---> La Descripción Resumen de la Reserva es => " , resumeReserva);
						// console.log("(FUERA DE AJAX y del FETCH pero dentro del setTimeOut de 2 Seg ... ) ---> El Valor de la Reserva en COP es => " , totalReserva);
						// console.log("(FUERA DE AJAX y del FETCH pero dentro del setTimeOut de 2 Seg ... ) ---> El totalReservaDolares => " , totalReservaDolares);
					}, 2000)

					/** Ahora si, continuo con el proceso de la API de PayPal
					 * Notas: Los value deben coincidir en breakdown y items
					 *        Las cadenas de String deben ser mas bien "cortas" por la API
					 *        Debemos usar el toString() para garantizar el String donde es
					 *        Debemos de haber hecho anteriormente Number lo que será numérico
					 *        IMPORTANTE, los totales para la API deberán tratarse como "Strings" (26/03/2022)
					*/

					paypal.Buttons({
						style : {
							color : 'blue',
							shape : 'pill',
							label : 'pay'
						},
						createOrder: function(data , actions){
							return actions.order.create({
								"purchase_units": [{
									"amount": {
									"currency_code": "USD",
									"value": totalReservaDolares.toString(),
									"breakdown": {
										"item_total": {  /* Required when including the `items` array */
										"currency_code": "USD",
										"value": totalReservaDolares.toString()
										}
									}
									},
									"items": [
									{
										"name": "Reserva del Hotel Alphus (Reserva realizada desde el Sitio Web)", /* Shows within upper-right dropdown during payment approval */
										"description": resumeReserva.toString(), /* Item details will also be in the completed paypal.com transaction view */
										"unit_amount": {
										"currency_code": "USD",
										"value": totalReservaDolares.toString()
										},
										"quantity": "1"
									},
									]
								}]
							});
						},
						onApprove: function(data , actions){
							actions.order.capture().then(function(detalles){
								// console.log(detalles);
								/**Vamos a actualizar la data en la BD. 
								 * Primero planteo la información que necesito actualizar en la tupla correspondiente */
								let idTransaccionPaypal = detalles["id"];
								let orderTransaccionPayPal = detalles["status"];
								let medioTransaccionPayPal = "API PayPal";
								let pasarelaPagoPaypal = "PayPal";
								let estadoPagoReservaPaypal = "1";
								let codigoReservaPayPal = codigoReserAjax; //Esto debería venir en la Cookie que no hemos matado.

								// console.log("idTransaccionPaypal => " , idTransaccionPaypal);
								// console.log("orderTransaccionPayPal => " , orderTransaccionPayPal);
								// console.log("medioTransaccionPayPal => " , medioTransaccionPayPal);
								// console.log("pasarelaPagoPaypal => " , pasarelaPagoPaypal);
								// console.log("estadoPagoReservaPaypal => " , estadoPagoReservaPaypal);
								// console.log("codigoReservaPayPal => " , codigoReservaPayPal);

								location.href = urlPrincipalDinamizada+'vistas/paginas/modulos/pagoPayPalOK.php?id='+idTransaccionPaypal+'&order='+orderTransaccionPayPal+'&medTransaction='+medioTransaccionPayPal+'&pasarelaPago='+pasarelaPagoPaypal+'&newStatus='+estadoPagoReservaPaypal+"&codRes="+codigoReservaPayPal;

							});
						},
						onCancel: function(data){
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Pago mediante PayPal cancelado!'
							});
							console.log(data);
						}
					}).render('#paypal-button-container')
				</script>
       			

      		</div>

  		 	<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
      		</div>

		</div> 	

	 </div>

</div>


<!--=====================================
VENTANA MODAL PAGAR USANDO PAYU
======================================-->

<div class="modal fade" tabindex="-1" role="dialog" id="modalPagarPayu">
	
	 <div class="modal-dialog">
			
		<div class="modal-content">
			
	      	<div class="modal-header bg-success">
	        	<h4 class="modal-title text-white"> Pagar usando Payu</h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      	</div>
			
	 		<div class="modal-body">
       			
       			<!-- <img src="" class="img-thumbnail"> -->

				<figure class="text-center">	

					<img src="img/payu.png" class="img-fluid w-50">

				</figure>
    			
    			<p class="py-2 text-center">Relización de pago de reserva mediante la pasarela de pago PayU, para continuar, por favor de click el botón <b>Pagar con PayU</b></p>

				<form class="formPayu" method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
					<input name="merchantId"           type="hidden"  value=""   >
					<input name="accountId"            type="hidden"  value=""   >
					<input name="description"          type="hidden"  value=""   >
					<input name="referenceCode"        type="hidden"  value=""   >
					<input name="amount"               type="hidden"  value=""   >
					<input name="tax"                  type="hidden"  value=""   >
					<input name="taxReturnBase"        type="hidden"  value=""   >
					<input name="currency"             type="hidden"  value=""   >
					<input name="lng"        	       type="hidden"  value="es" >
					<input name="confirmationUrl"      type="hidden"  value=""   >
					<input name="responseUrl"          type="hidden"  value=""   >
					<input name="declinedResponseUrl"  type="hidden"  value=""   > <!-- Ojo, ya no esta como vídeo de JFU-->
					<input name="test"                 type="hidden"  value="1"  >
					<input name="signature"       	   type="hidden"  value=""   >
					
					<input name="Submit"  class="btn btn-block btn-lg btn-success"        type="submit"  value="Pagar con PayU" >
				</form>

				<script>

					let merchantId = "508029"; /**Recordemos que estámos en modo Sandbox ... Para Prod se cambia */
					let accountId  = "512321"; /**Recordemos que estámos en modo Sandbox ... Para Prod se cambia */
					let apiKey     = "4Vj8eK4rloUd272L48hsrarnUA"; /**Recordemos que estámos en modo Sandbox ... Para Prod se cambia */
					let currency   = "COP";
					let responseUrl = urlPrincipalDinamizada+"vistas/paginas/modulos/pagoPayuOK.php"; //Sería la página de respuesta, y le enviaríamos las variables GET.
					let declinedResponseUrl = urlPrincipalDinamizada+"perfil"; //Sería la página de rechazo, redireccionamos al perfil.

					let tax = "19";
					let taxReturnBase = (parseFloat(totalReserva) * parseFloat(tax))/100;

					let aleatorioA = (Number(Math.ceil(Math.random()*1000000)).toFixed());
					let aleatorioB = (Number(Math.ceil(Math.random()*1000000)).toFixed());
					let aleatorioC = (Number(Math.ceil(Math.random()*1000000)).toFixed());
					let referenceCode = aleatorioA + aleatorioB + aleatorioC + Number(totalReserva);
					
					/**Encriptamos usando MD5 - Librería aparte. */
					let signature = hex_md5(apiKey+'~'+merchantId+'~'+referenceCode+'~'+totalReserva+'~'+currency);
					

					/**Llenamos dinámicamente usando JQuery */
					$(".formPayu input[name='merchantId']").attr("value" , merchantId);
					$(".formPayu input[name='accountId']").attr("value" , accountId);
					$(".formPayu input[name='description']").attr("value" , descripReserva);
					$(".formPayu input[name='referenceCode']").attr("value" , referenceCode);
					$(".formPayu input[name='amount']").attr("value" , totalReserva);
					$(".formPayu input[name='tax']").attr("value" , taxReturnBase);
					$(".formPayu input[name='taxReturnBase']").attr("value" , taxReturnBase);
					$(".formPayu input[name='currency']").attr("value" , currency);
					$(".formPayu input[name='responseUrl']").attr("value" , responseUrl);
					$(".formPayu input[name='confirmationUrl']").attr("value" , "");
					$(".formPayu input[name='declinedResponseUrl']").attr("value" , declinedResponseUrl);
					$(".formPayu input[name='signature']").attr("value" , signature);
					

				</script>
       			

      		</div>

  		 	<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
      		</div>

		</div> 	

	 </div>

</div>