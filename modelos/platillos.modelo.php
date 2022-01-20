<?php 

require_once "conexion.php";

class ModeloPlatillos{

    /**MOSTRAMOS TODOS LOS PLATILLOS */
    static public function mdlMostrarPlatillos($tabla){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt->fetchAll();

        /**Cerramos sentencia y conexión */
        $stmt = null;
    
    }

    /**MOSTRAMOS PLATILLOS ACTIVOS */
    static public function mdlMostrarPlatillosActivos($tabla , $valor){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado = :valor");
        /**Enlazamos parámetros */
        $stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
        
        $stmt -> execute();
        return $stmt->fetchAll();

        /**Cerramos sentencia y conexión */
        $stmt = null;
    
    }

}

?>