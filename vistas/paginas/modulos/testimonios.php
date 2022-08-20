<?php  

/**Capturamos la variable pagina para validar por la habitación en la que exactamente estamos */
$valor = $_GET["pagina"];
$servidor = ControladorRuta::ctrServidor();
$habitaciones = ControladorHabitaciones::ctrMostrarHabitaciones($valor);
/**Obtengo el id_h para poder consultar los testimonios */
$testimonios = ControladorReservas::ctrMostrarTestimonios('id_habitacion_t' , $habitaciones[0]['id_h']);
// echo '<pre class="bg-white">'; print_r($testimonios); echo '</pre>';


?>

<!--=====================================
TESTIMONIOS
======================================-->
<div class="testimonios container-fluid py-5 text-white">
	
	<div class="container mb-3">
			
		<h1 class="text-center py-5">TESTIMONIOS</h1>

		<div class="row">

			<?php 

				$cantidadTestimoniosAprobados = 0;
				$idTestimonios = array(); /**Almacenar los testimonios que tenemos, sus id */

				foreach ($testimonios as $key => $value) {
					/**Contamos solo los que tenemos aprobados */
					if($value["aprobado"] != 0){

						$cantidadTestimoniosAprobados ++;
						array_push($idTestimonios , $value["id_testimonio"]);

					}

				}
				/**Solo si tenemos al menos 4 testimonos mostramos*/
				if($cantidadTestimoniosAprobados >= 4){
					/**Ciclo a raíz del array que creamos con los id */
					for ($i=0; $i < count($idTestimonios); $i++) { 
						echo '<div class="col-12 col-lg-3 text-center p-4">';

							if($testimonios[$i]["foto"] == ""){
								echo '<img src="'.$servidor.'vistas/img/usuarios/default/default.png'.'" class="img-fluid rounded-circle" w-50>';
							}else{
								/**Validamos si se trata de ingreso directo o por Facebook y/o Google */
								if($testimonios[$i]["modo"] == "directo"){

									echo '<img src="'.$servidor.$testimonios[$i]["foto"].'" class="img-fluid rounded-circle" w-50>';

								}else{

									echo '<img src="'.$testimonios[$i]["foto"].'" class="img-fluid rounded-circle" w-50>';

								}

							}

							echo '

							<h4 class="py-4">'.$testimonios[$i]["nombre"].'</h4>
			
							<p>'.$testimonios[$i]["testimonio"].'</p>
					
						</div>';

					}
							

				}else{

					echo '<div class="col-12 text-white text-center">¡Esta habitación aún no tiene testimonios!</div>';

				}
				
				echo '</div>';
				/**Si tenemos mas testimonios entonces ahí si mostramos el botón */
				if($cantidadTestimoniosAprobados > 4){

					echo '<button class="btn btn-default float-right px-4 verMasTestimonios">VER MÁS</button>';

				}
		

			?>


	</div>

</div>