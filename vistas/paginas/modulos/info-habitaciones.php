<?php 

/**Capturamos el valor de la variable GET Ruta para enviarlo como parámetro y obtener
 * el código de la categoría para mostrar las habitaciones respectivas. */

$valor = $_GET["pagina"];

$habitaciones = ControladorHabitaciones::ctrMostrarHabitaciones($valor);

// echo "<pre class='bg-white'>" ; print_r($habitaciones) ; echo "</pre>";

?>

<!--=====================================
INFO HABITACIÓN
======================================-->

<div class="infoHabitacion container-fluid bg-white p-0 pb-5">
	
	<div class="container">
		
		<div class="row">

			<!--=====================================
			BLOQUE IZQ
			======================================-->
			
			<div class="col-12 col-lg-8 colIzqHabitaciones p-0">
				
				<!--=====================================
				CABECERA HABITACIONES
				======================================-->
				
				<div class="pt-2 cabeceraHabitacion">

					<a href="<?php echo $ruta;  ?>" class="float-left lead text-white pt-1 px-3">
						<h5><i class="fas fa-chevron-left"></i> Regresar</h5>
					</a>

					<h2 class="float-right text-white px-3 categoria text-uppercase"><?php echo $habitaciones[0]["tipo"] ?></h2>

					<div class="clearfix"></div>

					<div class="dropdown">
						<h3 class="text-white">Seleccione una habitación: </h3>
						<button class="btn btn-primary dropdown-toggle" type="button" id="dropdown1" data-toggle="dropdown"><?php echo $habitaciones[0]["tipo"] ?> - Temática <?php echo $habitaciones[0]["estilo"] ?></button>		
						<div class="dropdown-menu">
							<?php foreach ($habitaciones as $key => $value) : ?>
								<!-- Para poder cambiar y navegar entre las diferentes habitaciones, por tanto, necesito obtener indices, el $key del foreach 
								nos va a servir para eso por tiene los indicadores y también capturamos en una propiedad la ruta -->
								<a class="dropdown-item" orden="<?php echo $key ?>" ruta="<?php echo $_GET["pagina"] ?>" href="#"> <?php echo $habitaciones[0]["tipo"] ?> - Temática <?php echo $value["estilo"] ?> </a>
							<?php endforeach ?>
						</div>
					</div>

				</div>

				<!--=====================================
				MULTIMEDIA HABITACIONES
				======================================-->

				<!-- SLIDE  -->

				<section class="jd-slider mb-3 my-lg-3 slideHabitaciones">
		      	       
			        <div class="slide-inner">
			            
			            <ul class="slide-area">

							<?php 

								/**Convertimos el String de galería en una Array. Esto lo hacemos por que no necesitamos traer de todas las habitaciones
								 * si no solamente de la que estémos parados en ese momento. */
								$galeria = json_decode($habitaciones[0]["galeria"] , true);

							?>

							<?php foreach ($galeria as $key => $value) : ?>

								<li>	

									<img src="<?php echo $servidor.$value ?>" class="img-fluid">

								</li>

							
							<?php endforeach ?>

						</ul>

					</div>

				  	  	<a class="prev d-none d-lg-block" href="#">
				            <i class="fas fa-angle-left fa-2x"></i>
				        </a>

				        <a class="next d-none d-lg-block" href="#">
				            <i class="fas fa-angle-right fa-2x"></i>
				        </a>

				         <div class="controller d-block ">

					        <div class="indicate-area"></div>

					    </div>
									   
				</section>

				<!-- VIDEO  -->

				<section class="mb-3 my-lg-3 videoHabitaciones d-none">
					
					<iframe width="100%" height="380" src="https://www.youtube.com/embed/<?php echo $habitaciones[0]["video"] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				
				</section>

				<!-- 360 GRADOS -->

				<section class="mb-3 my-lg-3 360Habitaciones d-none">

					<div id="myPano" class="pano" back="<?php echo $servidor.$habitaciones[0]["recorrido_virtual"] ?>">

						<div class="controls">
							<a href="#" class="left">&laquo;</a>
							<a href="#" class="right">&raquo;</a>
						</div>

					</div>
									
				</section>

				<!--=====================================
				DESCRIPCIÓN HABITACIONES
				======================================-->	

				<div class="descripcionHabitacion px-3">
					
					<h1 class="colorTitulos float-left"><?php echo $habitaciones[0]["estilo"]." ".$habitaciones[0]["tipo"] ?></h1>

					<div class="float-right pt-2">
						
						<button type="button" class="btn btn-default" vista="fotos"><i class="fas fa-camera"></i> Fotos</button>

						<button type="button" class="btn btn-default" vista="video"><i class="fab fa-youtube"></i> Video</button>
			
						<button type="button" class="btn btn-default" vista="360"><i class="fas fa-video"></i> 360°</button>
							
					</div>

					<div class="clearfix mb-4"></div>
					
					<div class="d-habitacion">

						<?php echo $habitaciones[0]["descripcion_h"] ?>

					</div>

					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>

					<div class="container">

						<div class="row py-2" style="background:#509CC3">

							 <div class="col-6 col-md-3 input-group pr-1">
							
								<input type="text" class="form-control datepicker entrada" placeholder="Entrada">

								<div class="input-group-append">
									
									<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
								
								</div>

							</div>

						 	<div class="col-6 col-md-3 input-group pl-1">
							
								<input type="text" class="form-control datepicker salida" placeholder="Salida">

								<div class="input-group-append">
									
									<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
								
								</div>

							</div>

							<div class="col-12 col-md-6 mt-2 mt-lg-0 input-group">
								
								<a href="<?php echo $ruta;  ?>reservas" class="w-100">
									<input type="button" class="btn btn-block btn-md text-white" value="Ver disponibilidad" style="background:black">	
								</a>

							</div>

						</div>

					</div>

				</div>

			</div>
			
			<!--=====================================
			BLOQUE DER
			======================================-->

			<div class="col-12 col-lg-4 colDerHabitaciones">

				<h2 class="colorTitulos text-uppercase text-center"><?php echo $habitaciones[0]["tipo"] ?> INCLUYE:</h2>
				
				<ul>

					<?php 
					
						/**Recordemos que los íconos vienen en formato JSON desde la BD, entonces debemos convertirlo
						 * para manipularlo como si fuera un array: */
						$incluye = json_decode($habitaciones[0]["incluye"] , true);
					
					?>

					<?php foreach ($incluye as $key => $value) : ?>

						<li>
							<h5>
								<i class="<?php echo $value["icono"] ?> w-25 colorTitulos"></i> 
								<span class="text-dark small"><?php echo $value["item"] ?></span>
							</h5>
						</li>

					<?php endforeach ?>
					
				</ul>

				<hr>

				<!-- HABITACIONES -->

				<div class="habitaciones text-center">

					<div class="container text-center">

						<div class="row text-center">

							<?php

								$categorias = ControladorCategorias::ctrMostrarCategoriasActivos();

							?>

							<h2 class="colorTitulos text-uppercase text-center">Otras Categorías: </h2>

							<?php foreach ($categorias as $key => $value) : ?>

								<?php if ($_GET["pagina"] != $value["ruta"]) : ?>

									<div class="col-lg-6 col-12 pb-3 px-0 px-lg-3">

										<a href="<?php echo $ruta.$value["ruta"]; ?>">
								
											<figure class="text-center">
												
												<img src="<?php echo $servidor.$value["img"]; ?>" class="img-fluid" width="100%">

												<p class="large py-2 mb-0"><?php echo $value["tipo"]; ?></p>

												<h3 style="font-size: 15px;" class="py-2 text-gray-dark mb-0">DESDE $<?php echo number_format($value["continental_baja"] , 0, ',', '.'); ?></h3>

												<h5 style="font-size: 15px;" class="py-1 text-gray-dark border"> <i class="fas fa-eye"></i> Ver Detalles <i class="fas fa-eye"></i> </h5>

												<!-- <h1 class="text-white p-2 mx-auto w-50 lead" style="background:<?php echo $value["color"]; ?>"><?php echo $value["tipo"]; ?></h1> -->

											</figure>

										</a>

									</div>

								<?php endif ?>

							<?php endforeach ?>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>