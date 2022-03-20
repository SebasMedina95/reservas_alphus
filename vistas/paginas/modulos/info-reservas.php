<?php  

/**Preguntamos si viene en camino las variables POST de reserva */
if(isset($_POST["id-habitacion"]) &&
   isset($_POST["fecha-ingreso"]) &&
   isset($_POST["fecha-salida"])){
	
	if($_POST["id-habitacion"] == 'Temática de Habitación'){
		/**Bloqueamos por que de igual modo este tipo de habitación no encaja */
		/**Si no viene con las variable POST, entonces lo retornamos a la página de inicio */
		echo '<script> window.location="'.$ruta.'" </script>';
	}
	
	// echo '<pre class="bg-white">' ; print_r($_POST["id-habitacion"]) ; echo '</pre>';
	// echo '<pre class="bg-white">' ; print_r($_POST["fecha-ingreso"]) ; echo '</pre>';
	// echo '<pre class="bg-white">' ; print_r($_POST["fecha-salida"]) ; echo '</pre>';
	
	$valor = $_POST["id-habitacion"];
	
	$reservas = ControladorReservas::ctrMostrarReservas($valor);

	/*El indice de lo que voy a mostrar. Para controlar la habitación exacta que estemos trayendo,
	si dejamos por defecto la posición 0, indicaríamos que solo sería la primera habitación que traiga y esa no es la idea*/
	$indice = 0;

	/**Si reservas viene vacío, es decir, no tengo la habitación reservada en ningún momento, entonces vamos a pedir la información al controlador de las habitaciones. 
	 * Cual es el proposito de esto: Ubicar la habitación que estamos trayendo y, usar el controlador de habitaciones, pero
	 * el controlador lo tenemos buscando por la ruta de habitación, entonces, para no crear otro método, usemos el mismo pero
	 * ubiquemos, a partir del id de habitación, la ruta para consultar y ubicar el indice para mostrar exactamente la info de 
	 * habitación que necesitamos. */
	if(!$reservas){
		/**Capturo un nuevo valor para la variable que es la ruta que viene desde el header en el input oculto 
		 * Este input oculto viene desde el header.php cuando es la reserva rápida y lo manejamos en los select anidados de reservas.js o
		 * también viene desde infor-habitaciones.php cuando consultamos una reserva desde las mismas habitaciones.
		*/
		$valor = $_POST["ruta"];
		/**Llamo la opción de mostrar habitaciones solamente */
		$reservas = ControladorHabitaciones::ctrMostrarHabitaciones($valor);
		/**Por medio de un ciclo vuelvo y listo todos los elementos */
		foreach ($reservas as $key => $value) {
			/*Cuando el id de la habitación sea igual a lo que venga en la variable post id-habitacion*/
			if($value["id_h"] == $_POST["id-habitacion"]){
				/*Asigno al indice el key*/
				$indice = $key;
			}
		}

	}

	/*Debo traer los planes para poder operarlos entre las opciones de temporada alta y temporada baja.*/
	$planes = ControladorPlanes::ctrMostrarPlanesActivos();

	/* **************************************** */
	/*   DEFINICIÓN DE PRECIOS DE TEMPORADAS.   */
	/* **************************************** */
	
	/*Defino mi zona horaria, para este caso la de Colombia*/
	date_default_timezone_set("America/Bogota");
	/*Capturo la fecha de hoy*/
	$hoy = getdate();

	/* Consideremos: 
	Para el hotel, la temporada alta es del 15 de Noviembre hasta 15 Enero && 15 de Junio hasta 15 de Julio. 
	La temporada baja son todo el resto de días que no es alta. */

	/*Validamos primero las TEMPORADAS ALTAS que se encuentran estipuladas en la consideración anteriormente descrita. Este aspecto será semi estático, pero por las condiciones que nos han propuestos en el negocio, no presentaría por ahora problemas*/
	if($hoy["mon"] == 11 && $hoy["mday"] >= 15 && $hoy["mday"] <= 31 ||
	   $hoy["mon"] == 12 && $hoy["mday"] >= 1 && $hoy["mday"] <= 31 ||
	   $hoy["mon"] == 1 && $hoy["mday"] >= 1 && $hoy["mday"] <= 15 ||
	   $hoy["mon"] == 6 && $hoy["mday"] >= 15 && $hoy["mday"] <= 31 ||
	   $hoy["mon"] == 7 && $hoy["mday"] >= 1 && $hoy["mday"] <= 15){

		/**Defino el plan base continental y americano
		 * Consulto en reservas por que allí estoy trayendo los precios de las categorías.
		 */
		$precioContinental = $reservas[$indice]["continental_alta"];
		$precioAmericano = $reservas[$indice]["americano_alta"];

		/**Guardo la info dinámica en arrays para ponerla en el select */
		$nombresDePlan = [];
		$preciosDePlan = [];
		$listadoPanead = [];

		/**Recorro los planes y voy conmutando y guardando la información */
		foreach ($planes as $key => $value) {
			
			$nombresDePlan[$key] = $value["tipo"];
			$preciosDePlan[$key] = $value["precio_alta"];
			$listadoPanead[$key] = $precioAmericano + $preciosDePlan[$key];

		}

	/**En el else trabajamos las demás fechas, todas serían TEMPORADAS BAJAS */
	}else{

		$precioContinental = $reservas[$indice]["continental_baja"];
		$precioAmericano = $reservas[$indice]["americano_baja"];

		$nombresDePlan = [];
		$preciosDePlan = [];
		$listadoPanead = [];

		foreach ($planes as $key => $value) {
			
			$nombresDePlan[$key] = $value["tipo"];
			$preciosDePlan[$key] = $value["precio_baja"];
			$listadoPanead[$key] = $precioAmericano + $preciosDePlan[$key];

		}

	}

	/* **************************************** */
	/*  DEFINIR CANTIDAD DE DÍAS DE LA RESERVA. */
	/* **************************************** */
	$fechaIngreso = new DateTime($_POST["fecha-ingreso"]);
	$fechaSalida = new DateTime($_POST["fecha-salida"]);
	
	/**Vamos a sacar la diferencia de días entre las fechas */
	$diff = $fechaIngreso->diff($fechaSalida);
	$dias = $diff->days; /*Saco el parámetro de días que me trae. */
	
	/**Si hay una anomalía en las diferencias entonces, colocamos 1. */
	if($dias <= 0){
		$dias = 1;
	}

}else{
	/**Si no viene con las variable POST, entonces lo retornamos a la página de inicio */
	echo '<script> window.location="'.$ruta.'" </script>';
}

?>

<!--=====================================
INFO RESERVAS
======================================-->
<!-- Capturamos el id de la habitación, fecha ingreso y fecha salida en un id para usarlo en JS reservas.js más fácil -->
<div class="infoReservas container-fluid bg-white p-0 pb-5" idHabitacion="<?php echo $_POST["id-habitacion"] ?>" fechaIngreso="<?php echo $_POST["fecha-ingreso"] ?>" fechaSalida="<?php echo $_POST["fecha-salida"] ?>" dias="<?php echo $dias ?>">
	
	<div class="container">
		
		<div class="row">

			<!--=====================================
			BLOQUE IZQ
			======================================-->
			
			<div class="col-12 col-lg-8 colIzqReservas p-0">
				
				<!--=====================================
				CABECERA RESERVAS
				======================================-->
				
				<div class="pt-4 cabeceraReservas">
					
					<a href="<?php echo $ruta;  ?>habitaciones" class="float-left lead text-white pt-1 px-3">
						<h5><i class="fas fa-chevron-left"></i> Regresar</h5>
					</a>

					<div class="clearfix"></div>

					<h1 class="float-left text-white p-2 pb-lg-5">RESERVAS</h1>	

					<h6 class="float-right px-3">

						<br>
						<a href="<?php echo $ruta;  ?>perfil" style="color:#FFCC29">Ver tus reservas</a>

					</h6>

					<div class="clearfix"></div>

				</div>

				<!--=====================================
				CALENDARIO RESERVAS
				======================================	-->

				<div class="bg-white p-4 calendarioReservas">
					<!-- Si usamos la otra manera de llamar las reservas con el caso de que no este habitación registrada
					al menos una vez en la base de datos, entonces: -->
					<?php if ($valor == $_POST["ruta"]): ?>

						<h4 class="pb-5 float-left alert alert-success"><b>¡El Rango de fechas está Disponible!</b></h4>

					<?php else : ?>

						<div class="infoDisponibilidad"></div>

					<?php endif ?>

					<div class="float-right pb-4">
							
						<ul>
							<li>
								<i class="fas fa-square-full" style="color:#847059"></i> No disponible.
							</li>

							<li>
								<i class="fas fa-square-full" style="color:#eee"></i> Disponible.
							</li>

							<li>
								<i class="fas fa-square-full" style="color:#FFCC29"></i> Tu reserva.
							</li>

							<li>
								<i class="fas fa-square-full" style="color:#E27A7A"></i> Solapado.
							</li>
						</ul>

					</div>

					<div class="clearfix"></div>
			
					<div id="calendar"></div>

					<!--=====================================
					MODIFICAR FECHAS
					======================================	-->

					<h6 class="lead pt-4 pb-2">Puede modificar la fecha de acuerdo a los días disponibles:</h6>

					<form action="<?php echo $ruta; ?>reservas" method="POST">

						<!-- Capturamos el id de la habitación y lo dejarémos oculto para usarlo -->
						<input type="hidden" name="id-habitacion" value="<?php echo $_POST["id-habitacion"]; ?>">

						<!-- Vamos a capturar la ruta de la categoría para poder tenerla oculta y usarla si dado el caso, las reservas no me traen información 
						de la habitación, este apartado es tremendamente importante, o si no no podremos habilitar nuevas reservas. Realizamos la captura y
						mantenemos la información en el archivo de reservas.js - En el value asignamos de una vez la variable POST de ruta que me esta llegando
						sea del micro formulario de reserva rápida o de info-habitación-->
						<input type="hidden" id="ruta" name="ruta" value="<?php echo $_POST["ruta"]; ?>">

						<div class="container mb-3">

							<div class="row py-2" style="background:#509CC3">

								<div class="col-6 col-md-3 input-group pr-1">
								
									<input type="text" class="form-control datepicker entrada" placeholder="Entrada" autocomplete="off" value="<?php echo $_POST["fecha-ingreso"]; ?>" name="fecha-ingreso" required>

									<div class="input-group-append">
										
										<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
									
									</div>

								</div>

								<div class="col-6 col-md-3 input-group pl-1">
								
									<input type="text" class="form-control datepicker salida" placeholder="Salida" autocomplete="off" value="<?php echo $_POST["fecha-salida"]; ?>" name="fecha-salida" readonly required>

									<div class="input-group-append">
										
										<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
									
									</div>

								</div>

								<div class="col-12 col-md-6 mt-2 mt-lg-0 input-group">
									
									<a href="<?php echo $ruta;  ?>reservas" class="w-100">
										<input type="submit" class="btn btn-block btn-md text-white" value="Ver disponibilidad" style="background:black">	
									</a>

								</div>

							</div>

						</div>

					</form>

				</div>

			</div>

			<!--=====================================
			BLOQUE DER
			======================================-->

			<div class="col-12 col-lg-4 colDerReservas" style="display: none;">

				<hr>

				<h4 class="mt-lg-5 text-center"><b>Código de la Reserva:</b></h4>

				<h2 class="colorTitulos text-center"><strong class="codigoReserva"></strong></h2>
				
				<hr>

				<div class="form-group">
					<label><b>Fecha de Ingreso (Hora 3:00pm):</b></label>
					<input type="date" class="form-control" value="<?php echo $_POST["fecha-ingreso"]; ?>" readonly>
				</div>

				<div class="form-group">
					<label><b>Fecha de Salida (Hora 5:00pm):</b></label>
					<input type="date" class="form-control" value="<?php echo $_POST["fecha-salida"]; ?>"  readonly>
				</div>

				<div class="form-group">
					<label><b>Diferencia de Días:</b></label>
					<input type="text" class="form-control difDias" value="" readonly>
				</div>

				<div class="form-group">
				  <label><b>Habitación:</b></label>
				  <!-- Recordemos que el indice 0 me lo indica cuando imprimo $reservas -->
				  <input type="text" class="form-control" value="Habitación <?php echo $reservas[$indice]["tipo"] . " - " . $reservas[$indice]["estilo"]; ?>" readonly>

				  <?php
					/*Traemos la galería recordando que esta en un array, esto será usando para el modal de mas adelante para poder
					  traer el juego de imagenes representativas.*/
				  	$galeria = json_decode($reservas[$indice]["galeria"], true);
				  
				  ?>

				  <!-- Ahora, con el json anterior, puedo mostrar específicamente cual es la habitación que estoy reservando
					   vamos a mostrar la primera habitación - Para este caso, vamos a mostrar la primera imagen que tengamos
					   de la galería-->
				  <img src="<?php echo $servidor.$galeria[0]; ?>" class="img-fluid">

				</div>

				<div class="form-group">
				  <label><b>Plan de Reserva</b>  (1 día x 1 noche sugerido para 1 persona):- <a href="#infoPlanes" data-toggle="modal"> <i class="fas fa-eye"></i> Ver los planes disponibles.</a> </label>
				  <select class="form-control elegirPlan">
					<!-- Colocaremos un separador @ por si mas adelante para conmutar debemos usar un Split -->
				  	<option value="<?php echo 'Continental'.'@'.$precioContinental ?>"><?php echo 'PLAN: Continental'.' - COSTO: $'.number_format($precioContinental , 0, ',', '.') ?></option>
				  	<option value="<?php echo 'Americano'.'@'.$precioAmericano ?>"><?php echo 'PLAN: Americano'.' - COSTO: $'.number_format($precioAmericano , 0, ',', '.') ?></option>
				  	
					<?php  

						for ($x=0; $x < count($nombresDePlan); $x++) {

							echo '<option value="'.$nombresDePlan[$x].'@'.$listadoPanead[$x].'">'.'PLAN: '.$nombresDePlan[$x].' - COSTO: $'.number_format($listadoPanead[$x] , 0, ',', '.').'</option>';

						}

					?>

				  </select>
				</div>
				
				<div class="form-group">
				  <label><b>Cantidad de Personas:</b></label>
				  <select class="form-control cantidadPersonas">
				  	
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>

				  </select>
				</div>

				<h1 class="precioReserva stprecios"><?php echo '$'.number_format($precioContinental*$dias, 0, ',', '.'); ?></h1>

				<hr>
				
				<a href="<?php echo $ruta;  ?>perfil"
					class="pagarReserva" 
					idHabitacion="<?php echo $reservas[$indice]["id_h"]; ?>"
					imgHabitacion="<?php echo $servidor.$galeria[0]; ?>"
					infoHabitacion="Habitación <?php echo $reservas[$indice]["tipo"]." ".$reservas[$indice]["estilo"]; ?>"
					pagoReserva="<?php echo ($precioContinental*$dias);?>"
					codigoReserva=""
					fechaIngreso="<?php echo $_POST["fecha-ingreso"];?>"
					fechaSalida="<?php echo $_POST["fecha-salida"];?>"
					plan="Plan Continental" 
					personas="1"
					dias="<?php echo $dias;?>">
					<button class="btn btn-dark btn-lg w-100">REALIZAR RESERVA</button>
				</a>

			</div>

		</div>

	</div>

</div>

<!--=====================================
VENTANA MODAL PLANES
======================================-->

<div class="modal fade" id="infoPlanes" style="color: gray;">
	
	 <div class="modal-dialog modal-lg">
			
		<div class="modal-content">
			<!-- Muestro primero la habitación y tipo de habitación en la que me encuentro en la cabecera del modal-->
			<div class="modal-header">
	        	<h4 class="modal-title text-uppercase"><b>Habitación que esta reservando:</b>  <?php echo $reservas[$indice]["tipo"].' '.$reservas[$indice]["estilo"]; ?></h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      	</div>

	      	<div class="modal-body">
				<!-- Colocamos la imagen de la habiación-->
				<figure class="text-center">
					<!-- Muestro las imagenes, si las muestro mas grande evidentemente no cabran en el modal
					se tuvo que colocar el número exacto del indice, ya que si utilizo la variable indice
					esta se esta actualizando y no esta tomando la habitación primera que debería. -->
       				<img src="<?php echo $servidor.$galeria[0]; ?>" class="img-fluid" width="380" height="320">
					<img src="<?php echo $servidor.$galeria[1]; ?>" class="img-fluid" width="380" height="320">
					<img src="<?php echo $servidor.$galeria[2]; ?>" class="img-fluid" width="380" height="320">
					<img src="<?php echo $servidor.$galeria[3]; ?>" class="img-fluid" width="380" height="320">

       			</figure>
				<!-- Traeos la descripción del plan al modal -->
				<p class="px-2"><?php echo $reservas[$indice]["descripcion_h"]; ?></p>

				<hr>

       			<div class="row">
				<!-- Implementamos un foreach para listar los planes registrados en la base de datos-->
       			<?php foreach ($planes as $key => $value): ?>

					<div class="col-12 col-md-6">
						
						<h2 class="text-uppercase p-2"><b>Plan:</b> <?php echo $value["tipo"]; ?></h2>

						<figure class="center">
	       					<img src="<?php echo $servidor.$value["img"]; ?>" class="img-fluid">
	       				</figure>

	       				<p class="p-2"><?php echo $value["descripcion"]; ?></p>

	       				<h4 class="px-2"><b><font color="red">Precio por persona: </b></font></h4>

       					<p class="px-2">

	       				<b>Temporada Baja: Plan Americano</b> + $ <?php echo number_format($value["precio_baja"], 0, ',', '.'); ?><br>

	       				<b>Temporada Alta: Plan Americano</b> + $ <?php echo number_format($value["precio_alta"], 0, ',', '.'); ?>

	       				</p>


					</div>
       				
       			<?php endforeach ?>
       			
       			</div>

	      	</div>

	      	<div class="modal-footer">
        		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i>  Cerrar ventana informativa.</button>
      		</div>

		</div>

	</div>

</div>
