<?php

/*=============================================
CREAR EL OBJETO DE LA API GOOGLE
=============================================*/

$cliente = new Google_Client();
$cliente->setAuthConfig('modelos/client_secret_google.json');
$cliente->setAccessType("offline");
$cliente->setScopes(['profile','email']);

/*=============================================
RUTA PARA EL LOGIN DE GOOGLE
=============================================*/

$rutaGoogle = $cliente->createAuthUrl();

/*=============================================
RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE
=============================================*/
if(isset($_GET["code"])){

	$token = $cliente->authenticate($_GET["code"]);
	$_SESSION['id_token_google'] = $token;
	$cliente->setAccessToken($token);
	// $item = $cliente->verifyIdToken();
	// echo '<pre class="bg-white">'; print_r($item); echo '</pre>';

}

/*=============================================
RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY
=============================================*/
/**Si es verdadero, es decir, traemos la info de acceso ... */
if($cliente->getAccessToken()){

	$item = $cliente->verifyIdToken();

	$datos = array("numero_documento"=>"null",
				   "nombre"=>$item["name"],
				   "email"=>$item["email"],
				   "celular"=>"null",
				   "password"=>"null",
				   "foto"=>$item["picture"],
				   "modo"=>"google",
				   "verificacion"=>1,
				   "email_encriptado"=>"null");

	$respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);

	if($respuesta == "ok"){

		echo '<script>

			setTimeout(function(){
				
				window.location = "'.$ruta.'perfil";

			},1000);

		</script>';

	}

}

/**VAMOS A MOSTRAR LA INFORMACIÓN DINÁMICA DEL PERFIL */
$itemLogeado = "id_u"; /**Columna Id del usuario en el sistema */
if(isset($_SESSION["id"])){
	$valorLogeado = $_SESSION["id"]; /**Valor, viene en la variable de sesión */
	$usuarioLogeado = ControladorUsuarios::ctrMostrarUsuario($itemLogeado, $valorLogeado);
}


?>

<!--=====================================
VENTANA MODAL PLANES
======================================-->

<div class="modal fade" tabindex="-1" role="dialog" id="modalPlanes">
	
	 <div class="modal-dialog">
			
		<div class="modal-content">
			
	      	<div class="modal-header bg-dark">
	        	<h4 class="modal-title text-white"></h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      	</div>
			
	 		<div class="modal-body">
       			
       			<img src="" class="img-thumbnail">
    			
    			<p class="py-2"></p>
       			
       			<div class="text-center">
				   <a href="#habitaciones" class="btn btn-primary text-center btnModalPlan" data-dismiss="modal"><i class="fas fa-suitcase"></i> Separa tu habitación </a>
        		</div>

      		</div>

  		 	<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
      		</div>

		</div> 	

	 </div>

</div>

<!--=====================================
VENTANA MODAL CARTA
======================================-->

<div class="modal fade" tabindex="-1" role="dialog" id="modalCarta">
	
	 <div class="modal-dialog">
			
		<div class="modal-content">
			
	      	<div class="modal-header bg-dark">
	        	<h4 class="modal-title text-white"></h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      	</div>
			
	 		<div class="modal-body">
       			
       			<img src="" class="img-thumbnail">
    			
    			<p class="py-2"></p>
       			
       			<div class="text-center">
				   <a href="#habitaciones" class="btn btn-primary text-center btnModalPlan" data-dismiss="modal"><i class="fas fa-suitcase"></i> Separa tu habitación </a>
        		</div>

      		</div>

  		 	<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
      		</div>

		</div> 	

	 </div>

</div>

<!--=====================================
VENTANA MODAL INGRESO
======================================-->

<div class="modal fade formulario" tabindex="-1" role="dialog" id="modalIngreso">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-dark text-white">
        <h4 class="modal-title">Ingresar</h4>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

      	<!--=====================================
		INGRESO CON REDES SOCIALES
		======================================-->

		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<!-- https://console.developers.google.com
						 https://github.com/google/google-api-php-client -->
					<!-- <a href="<?php echo $rutaGoogle; ?>">
						<figure class="google" style="cursor: pointer;">
							<img src="img/ingresaConGoogleV3.jpg" class="img-fluid w-75">
						</figure>
					</a> -->
				</div>
				<!-- <div class="col-6">
					<button class="p-2 btn btn-primary text-center text-white">
						<i class="fab fa-facebook"></i>
						Ingreso con Facebook
					</button>
				</div> -->
			</div>
		</div>

      	<!-- <div class="d-flex">
      		
			<div class="px-2 flex-fill">

				<p class="p-2 bg-primary text-center text-white facebook" style="cursor: pointer;">
					<i class="fab fa-facebook"></i>
					Ingreso con Facebook
				</p>

			</div>

			<div class="px-2 flex-fill">

				<button class="p-2 btn btn-danger text-center text-white">
					<i class="fab fa-google"></i>
					Ingreso con Google
				</button>

			</div>

      	</div> -->

      	<!--=====================================
		INGRESO DIRECTO
		======================================-->

		<hr class="mt-0">

		<!-- <span class="badge"> O si prefieres, ingresa directamente al sistema: </span> -->

		<form method="POST">

			<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
			      	<i class="far fa-envelope"></i>

			      </span>

			    </div>

			    <input type="email" class="form-control" placeholder="Email" name="ingresoEmail" required>

		  	</div>

		  	<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
					<i class="fas fa-unlock-alt"></i>

			      </span>

			    </div>

			    <input type="password" class="form-control" placeholder="Contraseña" name="ingresoPassword" required>

		  	</div>

			  <div class="text-center pb-3">
		
				<a href="#modalRecuperarPassword" data-toggle="modal" data-dismiss="modal">
					<i class="far fa-frown-open"></i> ¿Olvidó su contraseña? <i class="far fa-frown-open"></i>
				</a>

			</div>
					
			<input type="submit" class="btn btn-dark btn-block" value="Ingresar">

			<?php

				$ingresoUsuario = new ControladorUsuarios();
				$ingresoUsuario -> ctrIngresoUsuario();

			?>

		</form>

      </div>


      <div class="modal-footer">

		<div>

			¿No tiene una cuenta registrada? . . .

			<a class="btn btn-success btn-sm" href="#modalRegistro" data-toggle="modal" data-dismiss="modal">
				<i class="fas fa-plus"></i> Registrarse
			</a>

		</div>

      </div>

    </div>

  </div>

</div>

<!--=====================================
VENTANA MODAL REGISTRO
======================================-->

<div class="modal fade formulario" tabindex="-1" role="dialog" id="modalRegistro">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-dark text-white">
        <h4 class="modal-title">Registarse</h4>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

      	<!--=====================================
		INGRESO CON REDES SOCIALES
		======================================-->
       
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<!-- https://console.developers.google.com
						 https://github.com/google/google-api-php-client -->
					<!-- <a href="<?php echo $rutaGoogle; ?>">
						<figure class="google" style="cursor: pointer;">
							<img src="img/ingresaConGoogleV3.jpg" class="img-fluid w-75">
						</figure>
					</a> -->
				</div>
				<!-- <div class="col-6">
					<button class="p-2 btn btn-primary text-center text-white">
						<i class="fab fa-facebook"></i>
						Ingreso con Facebook
					</button>
				</div> -->
			</div>
		</div>

      	<!-- <div class="d-flex">
      		
			<div class="px-2 flex-fill">

				<p class="p-2 bg-primary text-center text-white facebook" style="cursor: pointer;">
					<i class="fab fa-facebook"></i>
					Ingreso con Facebook
				</p>

			</div>

			<div class="px-2 flex-fill">

				<p class="p-2 bg-danger text-center text-white" style="cursor: pointer;">
					<i class="fab fa-google"></i>
					Ingreso con Google
				</p>

			</div>

      	</div> -->

      	<!--=====================================
		REGISTRO DIRECTO
		======================================-->

		<hr class="mt-0">

		<form method="post">

			<div class="input-group mb-3">

				<div class="input-group-prepend">

					<span class="input-group-text">
						
						<i class="far fa-id-card"></i>

					</span>

				</div>

				<input type="text" class="form-control" placeholder="Número de Documento ..." name="registroDocumento" required>

			</div>


			<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
			      	<i class="far fa-user"></i>

			      </span>

			    </div>

			    <input type="text" class="form-control" placeholder="Nombre Completo ..." name="registroNombre" required>

		  	</div>


			<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
			      	<i class="far fa-envelope"></i>

			      </span>

			    </div>

			    <input type="email" class="form-control" placeholder="Correo Electrónico ..." name="registroEmail" required>

		  	</div>

			<div class="input-group mb-3">

				<div class="input-group-prepend">

					<span class="input-group-text">
					
						<i class="fas fa-mobile-alt"></i>

					</span>

				</div>

				<input type="text" class="form-control" placeholder="Número Celular ..." name="registroCelular" required>

		  	</div>

		  	<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
					<i class="fas fa-unlock-alt"></i>

			      </span>

			    </div>

			    <input type="password" class="form-control" placeholder="Contraseña ..." name="registroPassword" required>

		  	</div>

			<input type="submit" class="btn btn-dark btn-block" value="Registrarse">

			<?php 
			
				$registroUsuario = new ControladorUsuarios();
				$registroUsuario -> ctrRegistroUsuario(); /**Ejecutamos de forma inmediata */
			
			?>

		</form>

      </div>


      <div class="modal-footer">

	  	¿Ya tienes una cuenta registrada? . . . 

		<strong>

			<a class="btn btn-warning btn-sm" href="#modalIngreso" data-toggle="modal" data-dismiss="modal">
				<i class="fas fa-sign-in-alt"></i> Ingresar
			</a>

		</strong>

      </div>

    </div>

  </div>

</div>

<!-- ********************************* -->
<!-- MODAL PARA CAMBIAR LA FOTO PERFIL -->
<!-- ********************************* -->
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

<!-- ******************************************************* -->
<!-- MODAL PARA CAMBIAR LA CONTRASEÑA CON EL INGRESO DIRECTO -->
<!-- ******************************************************* -->

<div class="modal fade formulario" tabindex="-1" role="dialog" id="cambiarPassword">
	
	<div class="modal-dialog">

		<div class="modal-content">

			<form method="post">

				<div class="modal-header bg-dark">

					<h4 class="modal-title text-white">Cambiar Contraseña</h4>

					<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div class="modal-body">
					
					<input type="hidden" name="idUsuarioPassword" value="<?php echo $usuarioLogeado["id_u"]; ?>">

					<div class="input-group mb-3">

						<div class="input-group-prepend">

							<span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>

						</div>

						<input type="password" class="form-control" placeholder="Ingrese la contraseña actual ..." name="actualPassword" autocomplete="off" required>
					
					</div>

					<div class="input-group mb-3">

						<div class="input-group-prepend">

							<span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock"></i></span>
						
						</div>
						
						<input type="password" class="form-control" placeholder="Ingrese nueva contraseña ..." name="nuevoPassword" autocomplete="off" required>
					
					</div>

					<div class="input-group mb-3">

						<div class="input-group-prepend">

							<span class="input-group-text" id="basic-addon1"><i class="fas fa-check"></i></span>

						</div>

						<input type="password" class="form-control" placeholder="Confirmar nueva contraseña ..." name="confirmarPassword" autocomplete="off" required>
					
					</div>

				</div>

				<div class="modal-footer d-flex justify-content-between"> 

					<div>

						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

					</div>

					<div>

						<button type="submit" class="btn btn-primary"><i class="far fa-paper-plane"></i> Enviar Contraseña</button>

					</div>

				</div>

				<?php

					$cambiarPassword = new ControladorUsuarios();
					$cambiarPassword -> ctrCambiarPassword();

				?>

			</form>

		</div>

	</div>

</div>

<!--=====================================
VENTANA MODAL RECUPERAR CONTRASEÑA
======================================-->

<div class="modal fade formulario" tabindex="-1" role="dialog" id="modalRecuperarPassword">
	
	<div class="modal-dialog">

	    <div class="modal-content">

	    	<div class="modal-header bg-dark">

		        <h4 class="modal-title text-white">Recuperar contraseña</h4>

		        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>

		    </div>

			 <div class="modal-body">
			 	
				<form method="post">

					<p class="text-muted">Escriba su correo electrónico con el que estás registrado y allí le enviaremos una nueva contraseña:</p>

					<div class="input-group mb-3">
						
						<div class="input-group-prepend">

					      <span class="input-group-text">
					      	
					      	<i class="far fa-envelope"></i>

					      </span>

					    </div>

					    <input type="email" class="form-control" placeholder="Email" name="emailRecuperarPassword" required>

					</div>

					<input type="submit" class="btn btn-dark btn-block" value="Enviar">

					<?php

						$recuperarPassword = new ControladorUsuarios();
						$recuperarPassword -> ctrRecuperarPassword();

					?>

				</form>

			 </div>

	    </div>

    </div>

</div>


<!--=====================================
VENTANA MODAL VER TESTIMONIALES
======================================-->
<div class="modal fade formulario" tabindex="-1" role="dialog" id="verTestimonio">
	
	<div class="modal-dialog">

	    <div class="modal-content">

	    	<div class="modal-header bg-dark">

		        <h4 class="modal-title text-white">Testimonial de la Reserva</h4>

		        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>

		    </div>

			<div class="modal-body visorTestimonios">

				<!-- Esto lo llenamos dinámicamente desde listaReservas.js consumiendo el archivo de AJAX datatablelistaReservas.ajax.php -->
				<textarea class="form-control" rows="3" id="soloVerTestimonio" name="soloVerTestimonio" readonly></textarea>

			 </div>

			 <div class="modal-footer d-flex justify-content-right"> 

				<div>

					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar Testimonial</button>

				</div>

			</div>

		</div>

	</div>

</div>

<!--=====================================
VENTANA MODAL ACTUALIZAR TESTIMONIALES
======================================-->
<div class="modal fade formulario" tabindex="-1" role="dialog" id="actualizarTestimonio">
	
	<div class="modal-dialog">

	    <div class="modal-content">

	    	<div class="modal-header bg-dark">

		        <h4 class="modal-title text-white">Actualizar Testimonial de la Reserva</h4>

		        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>

		    </div>

			<div class="modal-body">

				<!-- Esto lo llenamos dinámicamente desde listaReservas.js consumiendo el archivo de AJAX datatablelistaReservas.ajax.php -->
				

				<form method="post">

					<input type="hidden" class="form-control" id="editarIdTestimonio" name="editarIdTestimonio">

					<textarea class="form-control" rows="3" id="editarTestimonio" name="editarTestimonio"></textarea>

					<div class="modal-footer d-flex justify-content-right"> 

						<div>

							<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Cambios</button>

							<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar Edición Testimonial</button>

						</div>

					</div>

					<?php

						$actualizarTestimonio = new ControladorReservas();
						$actualizarTestimonio -> ctrActualizarTestimonio();

					?>

				</form>

			 </div>

		</div>

	</div>

</div>


