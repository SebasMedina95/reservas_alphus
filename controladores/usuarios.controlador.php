<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

Class ControladorUsuarios{

    /**REGISTRO DE USUARIOS DE FORMA DIRECTA 
     * Como ejecutamos inmediatamente, entonces no colocamos static */
    public function ctrRegistroUsuario(){
        /**Si viene una variable POST, por ejemplo el registroDocumento ... */
        if(isset($_POST["registroDocumento"])){

            /**Validamios la información */
            /**Validación del documento */
            if(!preg_match('/^[0-9]+$/' , $_POST["registroDocumento"])){

                echo "<script>

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El documento debe ser numérico ...'
                  }).then(function(result){

                    if(result.value){   
                        history.back();
                    } 
                });

                </script>";

            }

            /**Validación del nombre */
            if(!preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/' , $_POST["registroNombre"])){

                echo "<script>

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El nombre registrado no es válido ...'
                  }).then(function(result){

                    if(result.value){   
                        history.back();
                    } 
                });

                </script>";

            }

            /**Validación del email */
            if(!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/' , $_POST["registroEmail"])){

                echo "<script>

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El email registrado no es válido ...'
                  }).then(function(result){

                    if(result.value){   
                        history.back();
                    } 
                });

                </script>";

            }

            /**Validación del celular */
            if(!preg_match('/^[0-9]+$/' , $_POST["registroCelular"])){

                echo "<script>

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El número de celular debe ser numérico ...'
                  }).then(function(result){

                    if(result.value){   
                        history.back();
                    } 
                });

                </script>";

            }

            /**Validación de la contraseña */
            if(!preg_match('/^[a-zA-Z0-9]+$/' , $_POST["registroPassword"])){

                echo "<script>

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El password es solo létras y números ...'
                  }).then(function(result){

                    if(result.value){   
                        history.back();
                    } 
                });

                </script>";

            }

            //$encriptarPassword = crypt($_POST["registroPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$encriptarEmail = md5($_POST["registroEmail"]);
            $encriptarPassword = crypt($_POST["registroPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            /**Si pasamos los anteriores filtros */
            $datos = array( "numero_documento" => $_POST["registroDocumento"],
                            "nombre" => $_POST["registroNombre"],
                            "email" => $_POST["registroEmail"],
                            "celular" => $_POST["registroCelular"],
                            "password" => $encriptarPassword,
                            "foto" => "",
                            "modo" => "directo",
                            "verificacion" => 0,
                            "email_encriptado" => $encriptarEmail);

            $tabla = "usuarios";
            $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);
            
            if($respuesta == "ok"){
                
                /** ----- VERIFICACIÓN DEL CORREO ELECTRÓNICO ----- */
                /**Defino la zona horaria */
                date_default_timezone_set("America/Bogota");
                /**Defino la ruta principal del proyecto */
				$ruta = ControladorRuta::ctrRuta();
                /**Instancio la clase PHPMailet y codifico los caracteres en latino */
                $mail = new PHPMailer;
				$mail->CharSet = 'UTF-8';
                $mail->isMail();
                /**De donde viene el correo */
                $mail->setFrom('servicioreservas@hotelalphus.com', 'Hotel Alphus');
                /**Si tiene que responder a este correo o tiene la posibilidad */
                $mail->addReplyTo('servicioreservas@hotelalphus.com', 'Hotel Alphus');
                /**Asunto del correo */
                $mail->Subject = "Por favor, verifique su dirección de correo electrónico";
                /**A que dirección enviaremos el correo */
                $mail->addAddress($_POST["registroEmail"]);
                /**Contenido del correo electrónico */
                $mail->msgHTML(
                    '<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px; padding:20px">

                        <div style=" margin:auto; width:600px; background:white; padding:20px">
                
                            <center>
                            
                                <img style="padding:20px; width:100%" src="https://scontent.feoh1-1.fna.fbcdn.net/v/t39.30808-6/278097240_4487553271345710_8428121617014453228_n.jpg?_nc_cat=106&ccb=1-5&_nc_sid=0debeb&_nc_eui2=AeGRJKxtey_5eUC3-P-ogLJ2ScHC1dzezpxJwcLV3N7OnIY_NUYikGJjen08-Hek1OBZGVZEzfPk9juvA-bkwozS&_nc_ohc=27upOpKagmYAX-LQZ0y&_nc_oc=AQk-utLmni1XMVDHbU-sP_2aO5JCGYkxP42pb_J9wTPydPxud9N_7A1HPCcSNWXM5QI&_nc_ht=scontent.feoh1-1.fna&oh=00_AT-7z7gy725Fl62X4TNroBwX19_kuDoIP7gPmBto2Yis1w&oe=6254DC9D">
                    
                            </center>
                            
                            <hr style="border:1px solid #ccc; width:80%">
                
                            <center>
                
                                <img style="padding:20px; width:30%" src="https://espaimaternalactiu.com/wp-content/uploads/2017/04/icono-mail.png">
                
                                <h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>
                
                                <hr style="border:1px solid #ccc; width:80%">
                
                                <h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta, debe confirmar su dirección de correo electrónico</h4>
                
                                <a href="'.$ruta.$encriptarEmail.'" target="_blank" style="text-decoration:none">
                                    
                                    <div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>
                
                                </a>
                
                                <br>
                
                                <hr style="border:1px solid #ccc; width:80%">
                
                                <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
                
                            </center>
                
                        </div>
            
                    </div>'

                );

                $envio = $mail->Send();

                if(!$envio){

                    echo'<script>

                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["registroEmail"].$mail->ErrorInfo.', por favor inténtelo nuevamente"
                        }).then(function(result){
        
                            if(result.value){   
                                history.back();
                            } 
                        });

                    </script>';

                }else{

                    /** ----- Redireccionamos y ajustamos con ello los elementos POST ----- */
                    echo "<script>

                        window.location.replace('http://localhost/reservas-alphus/perfil-pre');

                    </script>";

                } /**Condicional de envío */

            } /**COndicional de OK desde el modelo */

        } /**Condicional de si llegan variables POST */

    } /**Registrar correo */

    /**MOSTRAR USUARIO */
    static public function ctrMostrarUsuario($item, $valor){

        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);
        return $respuesta;

    }

    /**ACTUALIZAR USUARIO */
    static public function ctrActualizarUsuario($id, $item, $valor){

        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);
        return $respuesta;

    }

    /**INGRESO DE USUARIO  AL SISTEMA - FORMA DIRECTA*/
    public function ctrIngresoUsuario(){

        /**Primero debo preguntar si me llegan variables POST asociadas */
        if(isset($_POST["ingresoEmail"])){

            /**Validamos por el Pregmach */
            if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/' , $_POST["ingresoEmail"]) && preg_match('/^[a-zA-Z0-9]+$/' , $_POST["ingresoPassword"])){

                /**No podemos desencriptar la Pass de la base de datos, PERO, podríamos encriptar la que nos llega y comparar */
                $encriptarPassword = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";
                $item  = "email";
                $valor = $_POST["ingresoEmail"];
                $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

                /**Si existen coindicencias */
                if($respuesta["email"] == $_POST["ingresoEmail"] && $respuesta["password"] == $encriptarPassword){

                    /**Existe! pero debemos mirar si está verificado */
                    if($respuesta["verificacion"] == 0){

                        echo "<script>

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Señor usuario, aún no ha verificado su cuenta, por favor dirijase a su bandeja de entrada o spam y verifique su cuenta ...'
                            }).then(function(result){

                                if(result.value){   
                                    history.back();
                                } 
                            });

                        </script>";

                        return;

                    }else{

                        /**VARIABLES DE SESIÓN */
                        $_SESSION["validarSesion"] = "ok";
    					$_SESSION["id"] = $respuesta["id_u"];
    					$_SESSION["nombre"] = $respuesta["nombre"];
    					$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["email"] = $respuesta["email"];
						$_SESSION["modo"] = $respuesta["modo"];
						$_SESSION["celular"] = $respuesta["celular"];
						$_SESSION["numero_documento"] = $respuesta["numero_documento"];

                        /** NOS VAMOS PARA LA PÁGINA DE PERFIL */
                        $ruta = ControladorRuta::ctrRuta();
                        echo '<script>
					
							window.location = "'.$ruta.'perfil";				

						</script>';

                    }

                }else{

                    echo "<script>

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Señor usuario, el email o contraseña no coinciden ...'
                        }).then(function(result){

                            if(result.value){   
                                history.back();
                            } 
                        });

                    </script>";

                }


            }else{

                echo "<script>

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Señor usuario, no se permite el uso de caracteres especiales ...'
                  }).then(function(result){

                    if(result.value){   
                        history.back();
                    } 
                });

                </script>";

            }

        }

    }

    /*=============================================
	REGISTRO CON REDES SOCIALES
	=============================================*/

	static public function ctrRegistroRedesSociales($datos){

		$tabla = "usuarios";
		$item = "email";
		$valor = $datos["email"];
		$emailRepetido = false;

		$verificarExistenciaUsuario = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

		if($verificarExistenciaUsuario){

			$emailRepetido = true;

		}else{

			$registrarUsuario = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

		}

		if($emailRepetido || $registrarUsuario == "ok"){

			$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

			if($traerUsuario["modo"] == "facebook"){

				session_start();

				// $_SESSION["validarSesion"] = "ok";
				// $_SESSION["id"] = $traerUsuario["id_u"];
				// $_SESSION["nombre"] = $traerUsuario["nombre"];
				// $_SESSION["foto"] = $traerUsuario["foto"];
				// $_SESSION["email"] = $traerUsuario["email"];
				// $_SESSION["modo"] = $traerUsuario["modo"];	

				echo "ok";

			}else if($traerUsuario["modo"] == "google"){

				$_SESSION["validarSesion"] = "ok";
				$_SESSION["id"] = $traerUsuario["id_u"];
				$_SESSION["nombre"] = $traerUsuario["nombre"];
				$_SESSION["foto"] = $traerUsuario["foto"];
				$_SESSION["email"] = $traerUsuario["email"];
				$_SESSION["modo"] = $traerUsuario["modo"];	

				return "ok";

			}else{

				echo "";
			}

		}else{

            echo "<script>

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Señor usuario, esta cuenta de Gmail ya fue registrado en el sistema ...'
                  }).then(function(result){

                    if(result.value){   
                        history.back();
                    } 
                });

                </script>";

        }
	}


} /**Clase general */