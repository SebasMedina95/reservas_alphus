<?php 

require_once "conexion.php";

class ModeloCarta{

    /**MOSTRAMOS TODOS LOS ÍTEMS DE LA CARTA */
    static public function mdlMostrarCarta($tabla){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt->fetchAll();

        /**Cerramos sentencia y conexión */
        $stmt = null;
    
    }

    /**MOSTRAMOS CARTA CON LOS ÍTEMS ACTIVOS GENERALES */
    static public function mdlMostrarCartaCount($tabla , $valor){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado = :valor ORDER BY tipo , id ASC");
        /**Enlazamos parámetros */
        $stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
        
        $stmt -> execute();
        return $stmt->fetchAll();

        /**Cerramos sentencia y conexión */
        $stmt = null;
    
    }

    /**MOSTRAMOS CARTA CON LOS ÍTEMS ACTIVOS Y PARA EL PAGINADOR */
    static public function mdlMostrarCartaActivos($tabla , $valor , $base, $tope){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado = :valor LIMIT $base, $tope");
        /**Enlazamos parámetros */
        $stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
        
        $stmt -> execute();
        return $stmt->fetchAll();

        /**Cerramos sentencia y conexión */
        $stmt = null;
    
    }

}

?>