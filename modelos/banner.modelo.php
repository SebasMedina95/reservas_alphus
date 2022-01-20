<?php 

require_once "conexion.php";

class ModeloBanner{

    /**MOSTRAMOS TODOS LOS BANNER */
    static public function mdlMostrarBanner($tabla){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt->fetchAll();

        /**Cerramos sentencia y conexión */
        $stmt = null;
    
    }

    /**MOSTRAMOS BANNER ACTIVOS */
    static public function mdlMostrarBannerActivos($tabla , $valor){
        
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