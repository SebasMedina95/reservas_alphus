<?php 

class ControladorReservas{

    /**Mostramos Todos los Reservas YA PAGAS Y LISTAS */
    static public function ctrMostrarReservas($valor){

        $tabla1 = "habitaciones";
        $tabla2 = "reservas";
        $tabla3 = "categorias";

        $respuesta = ModeloReservas::mdlMostrarReservas($tabla1, $tabla2, $tabla3, $valor);
        return $respuesta;

    }

    /**Mostramos una reserva por su ID */
    static public function ctrMostrarReservasId($valor){

        $tabla1 = "habitaciones";
        $tabla2 = "reservas";
        $tabla3 = "categorias";

        $respuesta = ModeloReservas::mdlMostrarReservasId($tabla1, $tabla2, $tabla3, $valor);
        return $respuesta;

    }

    /**Mostramos Todos los Reservas PENDIENTES Y A PRE DE PAGARSEN */
    static public function ctrMostrarPreReservas($valor){

        $tabla1 = "habitaciones";
        $tabla2 = "reservas";
        $tabla3 = "categorias";

        $respuesta = ModeloReservas::mdlMostrarPreReservas($tabla1, $tabla2, $tabla3, $valor);
        return $respuesta;

    }

    /**Mostramos todas las reservas por código */
    static public function ctrMostrarCodigoReserva($valor){

        $tabla1 = "reservas";

        $respuesta = ModeloReservas::mdlMostrarCodigoReservas($tabla1, $valor);
        return $respuesta;

    }

    /**Insertar la Pre Reserva */
    static public function ctrInsertarPreReserva($valIdHabitaci, $usuario, $valValorPagar, $valCodReserva, $valDescriRese, $valFechaIngre, $valFechaSalid, $estado, $valDiasEstadi){
        
        $tabla1 = "reservas";

        $respuesta = ModeloReservas::mdlInsertarPreReserva($tabla1,  $valIdHabitaci, $usuario,  $valValorPagar, $valCodReserva, $valDescriRese,  $valFechaIngre, $valFechaSalid, $estado, $valDiasEstadi);

        // return $respuesta;
        /**Si nos retorna información, agregaremos la testimonial para la reserva */
        if($respuesta != ""){

            $tablaTestimonios = "testimonios";
            $datos = array("id_reserva_t" => $respuesta,
                           "id_usuario_t" => $usuario,
                           "id_habitacion_t" => $valIdHabitaci,
                           "testimonio" => "",
                           "aprobado" => 0 );

            $crearTestimonio = ModeloReservas::mdlCrearTestimonio($tablaTestimonios , $datos);

            return $crearTestimonio;

        }

    }

    /**Mostramos última reserva de un usuario (Esto para el tema de la pre reserva) */
    static public function ctrMostrarPreReserva($usuario){

        $tabla1 = "reservas";
        $tabla2 = "habitaciones";

        $respuesta = ModeloReservas::mdlMostrarPreReserva($tabla1, $tabla2, $usuario);
        return $respuesta;

    }

    /**Actualizamos la pre reserva si la cookie tiene comportamiento de solapamiento */
    static public function ctrActualizarPreReserva($pre_id_reserva, $valIdHabitaci, $usuario, $valValorPagar, $valCodReserva, $valDescriRese, $valFechaIngre, $valFechaSalid, $estado, $valDiasEstadi){

        $tabla1 = "reservas";
        $respuesta = ModeloReservas::mdlActualizarPreReserva($tabla1, $pre_id_reserva, $valIdHabitaci, $usuario, $valValorPagar, $valCodReserva, $valDescriRese, $valFechaIngre, $valFechaSalid, $estado, $valDiasEstadi);
        return $respuesta;

    }

    /**Actualizamos la reserva que ya esta todo OK y paso por la pasarela respectiva de PAGO (Este apartado es pensando primero en Mercado Pago) */
    static public function ctrAjustarReserva($reserva, $payment, $order_id, $type_trans, $pasarela, $estado){
        $tabla1 = "reservas";
        $respuesta = ModeloReservas::mdlAjustarReserva($tabla1, $reserva, $payment, $order_id, $type_trans, $pasarela, $estado);
        return $respuesta;

    }

    /**Eliminamos la pre reserva si dado el caso ya se venció la Cookie que rige el proceso de la reserva en el perfil */
    static public function ctrEliminarPreReserva($reserva){
        $tabla1 = "reservas";
        $tabla2 = "testimonios";
        $respuesta = ModeloReservas::mdlEliminarPreReserva($tabla1, $tabla2, $reserva);
        return $respuesta;
    }

    /**Mostrar reserva respecto al usuario logeado */
    static public function ctrMostrarReservasUsuario($usuario){

        $tabla1 = "habitaciones";
        $tabla2 = "reservas";
        $tabla3 = "categorias";
        $respuesta = ModeloReservas::mdlMostrarReservasUsuario($tabla1, $tabla2, $tabla3, $usuario);
        return $respuesta;


    }

    /**Mostrar Testimoniales */
    static public function ctrMostrarTestimonios($item , $valor){

        $tabla1 = "testimonios";
		$tabla2 = "habitaciones";
		$tabla3 = "reservas";
		$tabla4 = "usuarios";

		$respuesta = ModeloReservas::mdlMostrarTestimonios($tabla1, $tabla2, $tabla3, $tabla4, $item, $valor);

		return $respuesta;

    }

    /**Actualizar Testimonial */
    public function ctrActualizarTestimonio(){

		if(isset($_POST["editarIdTestimonio"])){

			if(preg_match('/^[?\\¿\\!\\¡\\:\\,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTestimonio"])){

				$tabla = "testimonios";

				$datos = array("id_testimonio"=>$_POST["editarIdTestimonio"],
							   "testimonio"=>$_POST["editarTestimonio"]);

				$respuesta = ModeloReservas::mdlActualizarTestimonio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

                            swal.fire({
                                position: "top-center",
                                icon: "success",
                                title: "¡Twestimonial Actualizada con Éxito!",
                                showConfirmButton: false
                            
                            });

                            window.location.replace("http://localhost/reservas-alphus/perfil");

						</script>';

				}

			}else{

				echo'<script>

                    swal.fire({
                        icon: "error",
                        title: "Oops... ERROR!",
                        text: "¡No se permiten caracteres especiales!",
                        
                    }).then(function(result){

                        if(result.value){   
                            history.back();
                        } 

                    });

				</script>';	

			}
		
		}

	}

}

?>