<?php 

require_once "conexion.php";

Class ModeloHabitaciones{

    /**MOSTRAMOS LAS CATEGORIAS-HABITACIONES CON INNER JOIN */
    static public function mdlMostrarHabitaciones($tabla1 , $tabla2 , $valor){

        /**Traigo la información común entre habitaciones y categorías con base al id y lo filtro respecto a la coincidencia de ruta, es decir
         * lo que me traiga la variable GET de página. */
        $stmt = Conexion::conectar()->prepare("SELECT $tabla1.* , $tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id = $tabla2.tipo_h WHERE ruta = :ruta");
        /**Enlazamos el parámetro */
        $stmt -> bindParam(":ruta", $valor, PDO::PARAM_STR);

        $stmt -> execute();
        return $stmt->fetchAll();

        /**Cerramos sentencia y conexión */
        $stmt = null;

    }

}

?>