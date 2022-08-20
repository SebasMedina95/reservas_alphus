<div class="clearfix"></div>
<!--=====================================
CONTÁCTENOS
======================================-->

<div class="contactenos container-fluid bg-white py-4" id="contactenos">
	
	<div class="container text-center">
		
		<h1 class="py-sm-4">CONTÁCTENOS</h1>

		<form method="POST">

			<div class="input-group input-group-lg">
				
				<input type="text" class="form-control mb-3 mr-2 form-control-lg" placeholder="Nombre" name="nombreContactenos">

				<input type="text" class="form-control mb-3 ml-2 form-control-lg" placeholder="Apellido" name="apellidoContactenos">

			</div>

			<div class="input-group input-group-lg">
				
				<input type="text" class="form-control mb-3 mr-2 form-control-lg" placeholder="Móvil" name="movilContactenos">

				<input type="text" class="form-control mb-3 ml-2 form-control-lg" placeholder="Correo Electrónico" name="correoContactenos">

			</div>

			<textarea class="form-control" rows="6" placeholder="Escribe aquí tu mensaje" name="mensajeContactenos"></textarea>

			<input  type="submit" class="btn btn-dark my-4 btn-lg py-3 text-uppercase w-100" value="Enviar Inquietud">

			<?php

				$contactenos = new ControladorUsuarios();
				$contactenos -> ctrFormularioContactenos();

			?>

		</form>

	</div>

</div>

<!--=====================================
MAPA
======================================-->
<div class="mapa container-fluid bg-white p-0">
	
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2787.6281871520746!2d-76.4325534554915!3d8.851488549699365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e5a00caccbf58cb%3A0xf63a9172ab2d07f1!2sHotel%20Riviera%20Del%20Sol!5e0!3m2!1ses!2sco!4v1661018536017!5m2!1ses!2sco" width="1900" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

	<div class=" p-4 info"> 

		<h3 class="mt-2"><strong>Visítanos</strong></h3>
		<p>En el hotel Alphus estaremos encatados de atenderte.</p>

		<p>
		Cl. 30 #3584 #35- a, Arboletes, Antioquia.<br>
		Hotel Alphus. Zona de Puerto Rey<br>
		<hr>
		<i class="fas fa-phone"></i> 6042569874 - 6042569811 <br>
		<i class="fab fa-whatsapp"></i> 3124652201 - 3145632214
		</p>

		<p class="pb-4">Email: info@hotelalphus.com<br>
		<i class="fas fa-hotel"></i> En convenio con el <a href="#">Hotel Gardenia</a> y <a href="#">Hotel ValParamoe</a></p>

	</div>	

</div>

<!--=====================================
FOOTER
======================================-->

<footer class="container-fluid p-0">

	<div class="grid-container">
			
		<div class="grid-item d-none d-lg-block pt-2"></div>

		<div class="grid-item d-none d-lg-block pt-2">
			
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat.</p>

		</div>

		<div class="grid-item pt-2">
			
			<ul class="py-1">

				<li>
					<a href="#" target="_blank"><i class="fab fa-facebook-f lead text-white float-left mx-3"></i></a>
				</li>

				<li>
					<a href="#" target="_blank"><i class="fab fa-twitter lead text-white float-left mx-3"></i></a>
				</li>

				<li>
					<a href="#" target="_blank"><i class="fab fa-youtube lead text-white float-left mx-3"></i></a>
				</li>


				<li>
					<a href="#" target="_blank"><i class="fab fa-instagram lead text-white float-left mx-3"></i></a>
				</li>	
			
			</ul>	

		</div>

	</div>

</footer>

<!--=====================================
REDES SOCIALES MÓVIL
======================================-->

<ul class="redesMovil p-2 nav nav-justified">

	<li class="nav-item">
		<a href="#" target="_blank"><i class="fab fa-facebook-f lead text-white"></i></a>
	</li>

	<li class="nav-item">
		<a href="#" target="_blank"><i class="fab fa-twitter lead text-white"></i></a>
	</li>

	<li class="nav-item">
		<a href="#" target="_blank"><i class="fab fa-youtube lead text-white"></i></a>
	</li>

	<li class="nav-item">
		<a href="#" target="_blank"><i class="fab fa-instagram lead text-white"></i></a>
	</li>	

</ul>	
