<?php 

require_once "conexion.php";

class ModeloReservas{

    /**MOSTRAMOS TODAS LAS HABITACIONES(Tabla1) - RESERVAS(Tabla2) - CATEGORIAS(Tabla3) */
    static public function mdlMostrarReservas($tabla1, $tabla2, $tabla3, $valor){

        /**Traigo la información común entre habitaciones y categorías con base al id y lo uno con un tercer que sería la reserva. */
        $stmt = Conexion::conectar()->prepare("SELECT $tabla1.* , $tabla2.* , $tabla3.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_h = $tabla2.id_habitacion INNER JOIN $tabla3 ON $tabla1.tipo_h = $tabla3.id WHERE id_h = :id_h");
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

}

?>