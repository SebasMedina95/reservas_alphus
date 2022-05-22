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

      <div class="modal-header bg-info text-white">
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

      <div class="modal-header bg-info text-white">
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