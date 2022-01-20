<?php 

$platillos = ControladorPlatillos::ctrMostrarPlatillosActivos();

?>

<!--=====================================
RESTAURANTE
======================================-->

<div class="fondoRestaurante container-fluid">


</div>

<div class="restaurante container-fluid pt-5" id="restaurante">
	
	<div class="container">

		<div class="grid-container">
		
			<div class="grid-item carta">
				
				<div class="row p-1 p-lg-5">

					<?php foreach ($platillos as $key => $value) : ?>
					
						<div class="col-6 col-md-4 text-center p-1">
							
							<img src="<?php echo $servidor.$value["img"] ?>" class="img-fluid w-50 rounded-circle">

							<p class="py-2"><?php echo $value["descripcion"] ?></p>

						</div>

					<?php endforeach ?>

					
				</div>

			</div>

			<div class="grid-item bloqueRestaurante">
				
				<h1 class="mt-4 my-lg-5">ALGUNOS PLATILLOS</h1>

				<p class="p-4 my-lg-5">En el Hotel Alphus nos encanta consentir tu paladar, tenemos una amplia cantidad de platillos, los cuales sin duda, harán que quieras repetir sin duda alguna, a continuación les presentamos algunos de nuestros platillos, pero sin duda, la carta es aún mas amplia; nuestros cocineros y camareros están ansiosos por brindarte una experiencia gastronómica y de atención inolvidables.</p>

				<button class="btn btn-warning text-uppercase mb-5 verCarta"><i class="fas fa-menorah"></i> <b>Ver Platillos</b> </button>

			</div>
			
		</div>		

	</div>

</div>