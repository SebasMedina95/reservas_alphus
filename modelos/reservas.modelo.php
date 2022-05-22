<?php 

require_once "conexion.php";

class ModeloReservas{

    /**MOSTRAMOS TODAS LAS HABITACIONES(Tabla1) - RESERVAS(Tabla2) - CATEGORIAS(Tabla3) */
    static public function mdlMostrarReservas($tabla1, $tabla2, $tabla3, $valor){

        /**Traigo la información común entre habitaciones y categorías con base al id y lo uno con un tercer que sería la reserva. */
        $stmt = Conexion::conectar()->prepare("SELECT $tabla1.* , $tabla2.* , $tabla3.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_h = $tabla2.id_habitacion INNER JOIN $tabla3 ON $tabla1.tipo_h = $tabla3.id WHERE id_h = :id_h AND $tabla2.estado_pago = '1'");
        /**Enlazamos el parámetro */
        $stmt -> bindParam(":id_h", $valor, PDO::PARAM_STR);

        $stmt -> execute();
        return $stmt->fetchAll();

        /**Cerramos sentencia y conexión */
        $stmt = null;

    }

    /**MOSTRAMOS TODAS LAS HABITACIONES(Tabla1) - RESERVAS(Tabla2) - CATEGORIAS(Tabla3) 
     * ESTA ES IDENTICA A LA ANTERIOR, PERO LUEGO LA DINAMIZAMOS, EL CAMBIO ES EL ESTADO DE PAGO.
    */
    static public function mdlMostrarPreReservas($tabla1, $tabla2, $tabla3, $valor){

        /**Traigo la información común entre habitaciones y categorías con base al id y lo uno con un tercer que sería la reserva. */
        $stmt = Conexion::conectar()->prepare("SELECT $tabla1.* , $tabla2.* , $tabla3.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_h = $tabla2.id_habitacion INNER JOIN $tabla3 ON $tabla1.tipo_h = $tabla3.id WHERE id_h = :id_h AND $tabla2.estado_pago = '3'");
        /**Enlazamos el parámetro */
        $stmt -> bindParam(":id_h", $valor, PDO::PARAM_STR);

        $stmt -> execute();
        return $stmt->fetchAll();

        /**Cerramos sentencia y conexión */
        $stmt = null;

    }

    /**MOSTRAMOS LAS RESERVAS PERO POR CÓDIGO */
    static public function mdlMostrarCodigoReservas($tabla , $valor){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE codigo_reserva = :codigo_reserva");
        /**Enlazamos parámetros */
        $stmt -> bindParam(":codigo_reserva", $valor, PDO::PARAM_STR);
        
        $stmt -> execute();
        return $stmt->fetch();

        /**Cerramos sentencia y conexión */
        $stmt = null;
    
    }

    /**PRE INSERTAMOS LA RESERVA, POSTERIORMENTE PARA NO DEJAR BASURA EN EL SISTEMA
     * SE DA LA POTESTAD A LOS ADMINISTRADORES DE IR ELIMINANDO LAS RESERVAS QUE NO SE
     * CONSOLIDAN DE MANERA CORRECTA, ESTO CON EL FIN DE EVITAR ALTERACIONES EN LOS COOKIES
     * DE MANERA INVOLUNTARIA. **/
    static public function mdlInsertarPreReserva($tabla1, $valIdHabitaci, $usuario, $valValorPagar, $valCodReserva, $valDescriRese, $valFechaIngre, $valFechaSalid, $estado, $valDiasEstadi){
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla1(id_habitacion, id_usuario, pago_reserva, codigo_reserva, descripcion_reserva, fecha_ingreso, fecha_salida, estado_pago, dias) VALUES (:id_habitacion, :id_usuario, :pago_reserva, :codigo_reserva, :descripcion_reserva, :fecha_ingreso, :fecha_salida, :estado_pago, :dias)");

		$stmt->bindParam(":id_habitacion", $valIdHabitaci, PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $usuario, PDO::PARAM_STR);
		$stmt->bindParam(":pago_reserva", $valValorPagar, PDO::PARAM_STR);
		$stmt->bindParam(":codigo_reserva", $valCodReserva, PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_reserva", $valDescriRese, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ingreso", $valFechaIngre, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_salida", $valFechaSalid, PDO::PARAM_STR);
		$stmt->bindParam(":estado_pago", $estado, PDO::PARAM_STR);
		$stmt->bindParam(":dias", $valDiasEstadi, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt = null;
    
    }

    /**MOSTRAMOS LAS RESERVAS ASOCIADA A LA ÚLTIMA INTERACCIÓN CON EL USUARIO EN UNA RESERVA */
    /**Traemos la última reserva en orden de creación del usuario específico que se encuentre en el proceso de pago, es decir, cuyo estado de pago sea 3, esto con la finalidad de eliminar las cookies una vez adquirida la información y traemos la última data de la base de datos, luego de aplicar el checkout y redireccionar, se hace la actualización de los campos necesarios. 
     * Reservas - Tabla1
     * Habitaciones - Tabla2 */
    static public function mdlMostrarPreReserva($tabla1, $tabla2 , $usuario){
        
        $stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.galeria FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_habitacion = $tabla2.id_h WHERE $tabla1.id_usuario = :id_usuario AND $tabla1.estado_pago = '3' ORDER BY $tabla1.fecha_reserva DESC LIMIT 1");
        /**Enlazamos parámetros */
        $stmt -> bindParam(":id_usuario", $usuario, PDO::PARAM_STR);
        
        $stmt -> execute();
        return $stmt->fetch();

        /**Cerramos sentencia y conexión */
        $stmt = null;
    
    }

    /**ACTUALIZAMOS LA PRE RESERVA SI, DADO EL CASO, LA COOKIE TIENE UN COMPORTAMIENTO DE SOLAPAMIENTO */
    static public function mdlActualizarPreReserva($tabla1, $pre_id_reserva, $valIdHabitaci, $usuario, $valValorPagar, $valCodReserva, $valDescriRese, $valFechaIngre, $valFechaSalid, $estado, $valDiasEstadi){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla1 SET $tabla1.id_habitacion=:valIdHabitaci,$tabla1.id_usuario=:usuario,$tabla1.pago_reserva=:valValorPagar,$tabla1.codigo_reserva=:valCodReserva,$tabla1.descripcion_reserva=:valDescriRese,$tabla1.fecha_ingreso=:valFechaIngre,$tabla1.fecha_salida=:valFechaSalid,$tabla1.estado_pago=:estado,$tabla1.dias=:valDiasEstadi WHERE $tabla1.id_reserva = :pre_id_reserva");

        $stmt->bindParam(":pre_id_reserva", $pre_id_reserva, PDO::PARAM_STR);
        $stmt->bindParam(":valIdHabitaci", $valIdHabitaci, PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
		$stmt->bindParam(":valValorPagar", $valValorPagar, PDO::PARAM_STR);
		$stmt->bindParam(":valCodReserva", $valCodReserva, PDO::PARAM_STR);
		$stmt->bindParam(":valDescriRese", $valDescriRese, PDO::PARAM_STR);
		$stmt->bindParam(":valFechaIngre", $valFechaIngre, PDO::PARAM_STR);
		$stmt->bindParam(":valFechaSalid", $valFechaSalid, PDO::PARAM_STR);
		$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
		$stmt->bindParam(":valDiasEstadi", $valDiasEstadi, PDO::PARAM_STR);

        if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt = null;

    }

    static public function mdlAjustarReserva($tabla1, $reserva, $payment, $order_id, $type_trans, $pasarela, $estado){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla1 SET $tabla1.numero_transaccion=:payment,$tabla1.orden_transaccion=:order_id,$tabla1.medio_transaccion=:type_trans,$tabla1.pasarela_pago=:pasarela,$tabla1.estado_pago=:estado WHERE $tabla1.codigo_reserva = :reserva");

        $stmt->bindParam(":reserva", $reserva, PDO::PARAM_STR);
        $stmt->bindParam(":payment", $payment, PDO::PARAM_STR);
		$stmt->bindParam(":order_id", $order_id, PDO::PARAM_STR);
		$stmt->bindParam(":type_trans", $type_trans, PDO::PARAM_STR);
		$stmt->bindParam(":pasarela", $pasarela, PDO::PARAM_STR);
		$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);

        if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt = null;

    }

    /**Eliminamos la pre reserva si dado el caso ya se venció la Cookie que rige el proceso de la reserva en el perfil */
    static public function mdlEliminarPreReserva($tabla1, $reserva){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla1 WHERE $tabla1.codigo_reserva = :reserva");

        $stmt->bindParam(":reserva", $reserva, PDO::PARAM_STR);

        if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt = null;

    }

    /**Mostrar reserva respecto al usuario logeado */
    /**MOSTRAMOS TODAS LAS HABITACIONES(Tabla1) - RESERVAS(Tabla2) - CATEGORIAS(Tabla3) */
    static public function mdlMostrarReservasUsuario($tabla1, $tabla2, $tabla3, $usuario){

        /**Traigo la información común entre habitaciones y categorías con base al id y lo uno con un tercer que sería la reserva. */
        $stmt = Conexion::conectar()->prepare("SELECT $tabla1.* , $tabla2.* , $tabla3.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_h = $tabla2.id_habitacion INNER JOIN $tabla3 ON $tabla1.tipo_h = $tabla3.id WHERE $tabla2.estado_pago = '1' AND $tabla2.id_usuario = :usuario ");
        /**Enlazamos el parámetro */
        $stmt -> bindParam(":usuario", $usuario, PDO::PARAM_INT);

        $stmt -> execute();
        return $stmt->fetchAll();

        /**Cerramos sentencia y conexión */
        $stmt = null;

    }



}

?>