<?php 

require_once "conexion.php";

class ModeloRecorridos{

    /**MOSTRAMOS TODOS LOS RECORRIDOS */
    static public function mdlMostrarRecorridos($tabla){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt->fetchAll();

        /**Cerramos sentencia y conexión */
        $stmt = null;
    
    }

    /**MOSTRAMOS RECORRIDOS ACTIVOS */
    static public function mdlMostrarRecorridosActivos($tabla , $valor){
        
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