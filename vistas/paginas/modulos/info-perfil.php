<?php 

if(isset($_COOKIE["idHabitacion"])){

	/**TODO: Debemos validar si la persona anteriormente no tiene otras reservas en estado 3,
	 * para simular el comportamienot del as cookies completamente, si se encuentra una anterior en esta condicion, 
	 * lo que se hará es que se actualizara la pre reserva con los nuevos datos.
	 */

	$valIdHabitaci = $_COOKIE["idHabitacion"];
	$valValorPagar = $_COOKIE["pagoReserva"];
	$valCodReserva = $_COOKIE["codigoReserva"];
	$valDescriRese = $_COOKIE["infoHabitacion"];
	$valFechaIngre = $_COOKIE["fechaIngreso"];
	$valFechaSalid = $_COOKIE["fechaSalida"];
	$valDiasEstadi = $_COOKIE["dias"]; 
	$valImgHabitac = $_COOKIE["imgHabitacion"];
	$usuario = '1'; /**Esto debemos ponerlo dinámico ... */
	/**Estados: 1. Pagado, 2. Cancelado, 3.Espera */
	$estado = '3';

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

	/**Mato las Cookies por que ya obtuve la data */
	echo '<script>
								    	
			document.cookie = "idHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "imgHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "infoHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "pagoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "codigoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "fechaIngreso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "fechaSalida=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			document.cookie = "dias=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
			

		</script>';

}else{

	$usuario = '1'; /**Esto debemos ponerlo dinámico ... */
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
					
					<a href="<?php echo $ruta;  ?>reservas" class="float-left lead text-white pt-1 px-3 mb-4">
						<h5><i class="fas fa-chevron-left"></i> Salir</h5>
					</a>

					<div class="clearfix"></div>

					<h1 class="text-white p-2 pb-lg-5 text-center text-lg-left">MI PERFIL</h1>	
				</div>

				<?php //echo '<pre class"bg-white">'; print_r($mostrarPreReserva); echo '</pre>' ?>

				<!--=====================================
				PERFIL
				======================================-->

				<div class="descripcionPerfil">
					
					<figure class="text-center imgPerfil">
							
						<img src="img/testimonio01.png" class="img-fluid">

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

									<li class="px-2" style="background:#FFFDF4"> 1 Por vencerse</li>
									<li class="px-2 text-white" style="background:#CEC5B6"> 5 vencidas</li>

								</ul>

								<!--=====================================
								TABLA RESERVAS MÓVIL
								======================================-->	

								<div class="d-lg-none d-flex py-2">
									
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

								</div>

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
										
										<li class="list-group-item small">Juan Guillermo Osorio</li>
										<li class="list-group-item small">juangui@correo.com</li>
										<li class="list-group-item small">
											<button class="btn btn-dark btn-sm">Cambiar Contraseña</button>
										</li>
										<li class="list-group-item small">
											<button class="btn btn-primary btn-lg">Cambiar Imagen</button>
										</li>

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
						
						<h4 class="float-left">Hola Juan Sebastian Medina</h4>

					</div>
					
					<!-- =============================================================== -->
					<!-- =============================================================== -->
					<!-- Implementación de MercadoPago -->
					<div class="col-12">

						<?php if(isset($pre_codigo_reserva)) : ?>

							<div class="card">

								<div class="card-header text-white bg-dark mb-3">

									<h5>Tienes una reserva pendiente por pagar: </h5>

								</div>

								<div class="card-body text-center mb-2">

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

									</div>

									<hr>

								</div>

							</div>

							<?php


		

							?>

						<?php endif; ?>

					</div>
					<!-- =============================================================== -->
					<!-- =============================================================== -->

					<div class="col-6 d-none d-lg-block"></div>

					<div class="col-12 mt-3">
						
						<table class="table table-striped">
					    <thead>
					      <tr>
					      	<th>#</th>
					        <th>Habitación</th>
					        <th>Fecha de Ingreso</th>
					        <th>Fecha de Salida</th>
					        <th>Comentarios</th>
					      </tr>
					    </thead>
					    <tbody>
					      <tr>
					        <td>1</td>
					        <td>Suite Contemporánea</td>
					        <td>30.08.2018</td>
					        <td>03.09.2018</td>
					        <td>
					        
								  <button type="button" class="btn btn-dark text-white"><i class="fas fa-pencil-alt"></i></button>
								  <button type="button" class="btn btn-warning text-white"><i class="fas fa-eye"></i></button>
								
					        </td>
					      </tr>
					       <tr>
					        <td>2</td>
					        <td>Especial Caribeña</td>
					        <td>30.08.2018</td>
					        <td>03.09.2018</td>
					        <td>
					        	
								  <button type="button" class="btn btn-dark text-white"><i class="fas fa-pencil-alt"></i></button>
								  <button type="button" class="btn btn-warning text-white"><i class="fas fa-eye"></i></button>
								
					        </td>
					      </tr>

					       <tr>
					        <td>3</td>
					        <td>Suite Clásica</td>
					        <td>30.08.2018</td>
					        <td>03.09.2018</td>
					        <td>
					        	
								  <button type="button" class="btn btn-dark text-white"><i class="fas fa-pencil-alt"></i></button>
								  <button type="button" class="btn btn-warning text-white"><i class="fas fa-eye"></i></button>
								
					        </td>
					      </tr>
					    </tbody>
					  </table>


					</div>

				</div>
			
			</div>

		</div>

	</div>

</div>
