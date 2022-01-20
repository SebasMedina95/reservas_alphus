<?php 

require_once "conexion.php";

class ModeloCategorias{

    /**MOSTRAMOS TODOS LOS CATEGORIAS */
    static public function mdlMostrarCategorias($tabla){
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt->fetchAll();

        /**Cerramos sentencia y conexión */
        $stmt = null;
    
    }

    /**MOSTRAMOS CATEGORIAS ACTIVOS */
    static public function mdlMostrarCategoriasActivos($tabla , $valor){
        
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