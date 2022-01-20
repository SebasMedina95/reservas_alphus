<?php 

require_once "conexion.php";

class ModeloPlanes{

    /**MOSTRAMOS TODOS LOS PLANES */
    static public function mdlMostrarPlanes($tabla){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt->fetchAll();

        /**Cerramos sentencia y conexión */
        $stmt = null;
    
    }
    
    /**MOSTRAMOS ACTIVOS PLANES */
    static public function mdlMostrarPlanesActivos($tabla , $valor){
        
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