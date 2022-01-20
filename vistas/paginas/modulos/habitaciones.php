<?php 

$categorias = ControladorCategorias::ctrMostrarCategoriasActivos();

?>

<!--=====================================
HABITACIONES
======================================-->

<div class="habitaciones container-fluid bg-light" id="habitaciones">
	
	<div class="container">

		<h1 class="pt-4 text-center">HABITACIONES</h1>

		<div class="row p-4 text-center">

			<?php foreach ($categorias as $key => $value) : ?>
			
				<div class="col-12 col-lg-4 pb-3 px-0 px-lg-3">

					<a href="<?php echo $ruta.$value["ruta"]; ?>">
						
						<figure class="text-center">
							
							<img src="<?php echo $servidor.$value["img"]; ?>" class="img-fluid" width="100%">

							<p class="small py-2 mb-0"><?php echo $value["descripcion"]; ?></p>

							<h3 class="py-2 text-gray-dark mb-0">DESDE $<?php echo number_format($value["continental_baja"] , 2, ',', '.'); ?></h3>

							<h5 class="py-1 text-gray-dark border"> <i class="fas fa-eye"></i> Ver detalles <i class="fas fa-eye"></i> </h5>

							<h1 class="text-white p-3 mx-auto w-50 lead" style="background:<?php echo $value["color"]; ?>"><?php echo $value["tipo"]; ?></h1>

						</figure>

					</a>

				</div>

			<?php endforeach ?>

		</div>

	</div>

</div>