<?php
require_once "idataBase.php";
class DataBase extends IDataBase
{
    private $conexion;
    /**
     * conectaDb.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, February 17th, 2020.
     * @return	void
     */
    function conectaDb()
    {
        $usuario = "root";
        $contraseña = "";
        $server = "localhost";
        $name = "nba";
        try {
            $this->conexion = new PDO("mysql:host=" . $server . "; dbname=" . $name, $usuario, $contraseña);         // Se puede configurar el objeto         
            $this->conexion->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->conexion->exec("set names utf8mb4");
            return ($this->conexion);
        } catch (PDOException $e) {
            echo "  <p>Error: " . $e->getMessage() . "</p>\n";
            exit();
            //OTRA Opción podría ser enviar a otra página          
            header('Location: vistas/error.php?error=ERROR');
            exit();
        }
    }
    /**
     * desconectar.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, February 17th, 2020.
     * @return	mixed
     */
    function desconectar()
    {
        return $this->conexion = null;
    }
    /**
     * ejecutarSql.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, February 17th, 2020.
     * @param	mixed	$sql	
     * @return	mixed
     */
    function ejecutarSql($sql)
    {
        $db = new DataBase;
        $conect = $db->conectaDb();
        $result = $conect->query($sql);
        if (!$result) { // o con try-catch     
            echo "<p>Error en la consulta.</p>\n";
        }
        $conect = $db->desconectar();
        return $result;
    }

    /**
     * ejecutarSqlActualizacion.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, February 17th, 2020.
     * @param	mixed	$sql 	
     * @param	mixed	$args	
     * @return	void
     */
    function ejecutarSqlActualizacion($sql, $args)
    {
        $db = DataBase::conectaDb();
        $result = $db->prepare($sql);
        $result->execute($args);
        if (!$result) { // o con try-catch     
            echo "  <p>Error en la consulta.</p>\n";
        }
    }
    /**
     * ejecutarSqlArray.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, February 17th, 2020.
     * @param	mixed	$sql	
     * @return	mixed
     */
    function ejecutarSqlArray($sql)
    {
        $db = new DataBase;
        $conect = $db->conectaDb();
        $equipos = [];
        if ($conect->query($sql)) {
            $conferencia = $conect->query($sql);
            foreach ($conferencia as $valor) {
                array_push($equipos, $valor["NOMBRE"]);
            }
        } else {
            echo "  <p>Error al crear el registro.<p>\n";
        }
        $conect = $db->desconectar();
        return $equipos;
    }
}
