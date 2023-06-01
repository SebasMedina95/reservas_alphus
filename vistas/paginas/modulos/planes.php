<?php 

$planes = ControladorPlanes::ctrMostrarPlanesActivos();

?>

<!--=====================================
PLANES
======================================-->

<div class="planes container-fluid bg-white p-0" id="planes">
	
	<div class="container p-0">
		
		<div class="grid-container">
			
			<div class="grid-item">
				
				<h1 class="text-center py-3 py-lg-5 tituloPlan" tituloPlan="BIENVENIDO">BIENVENIDO</h1>

				<p class="text-center text-muted text-left px-4 descripcionPlan" descripcionPlan="En nuestro Hotel Alphus podemos ofrecerte diferentes planes de reserva, para hacer de tu estadía una experiencia maravillosa así como temática para la ocasión. Puede ver mas detalles sobre nuestros planes a continuación, ¡ Bienvenido !">En nuestro Hotel Alphus podemos ofrecerte diferentes planes de reserva, para hacer de tu estadía una experiencia maravillosa así como temática para la ocasión. Puede ver mas detalles sobre nuestros planes a continuación, ¡ Bienvenido !</p>

			</div>

			<?php foreach ($planes as $key => $value) : ?>

				<div class="grid-item d-none d-lg-block" data-toggle="modal" data-target="#modalPlanes">
					
					<figure class="text-center">
						
						<h1 descripcion="<?php echo $value["min_descripcion"] ?>"><?php echo $value["tipo"] ?></h1>

					</figure>

					<img src="<?php echo $servidor.$value["img"] ?>" class="img-fluid" width="100%">


				</div>

			<?php endforeach ?>
			
		</div>

	</div>

</div>
