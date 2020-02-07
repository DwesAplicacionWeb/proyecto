<?php
class dataBase implements idataBase
{
    private $conexion;
    function conectaDb()
    {
        $usuario = "root";
        $contraseña = "";
        $server = "localhost";
        $name = "nba";
        try {
            $this->conexion = new PDO("mysql:host=". $server ."; dbname=". $name, $usuario, $contraseña);         // Se puede configurar el objeto         
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
    function desconectar()
    {
        return $this->conexion = null;
    }
    function ejecutarSql($sql)
    {
        $db = new dataBase;
        $conect = $db->conectaDb();
        $result = $conect->query($sql); 
        $resultado = "";
         if (!$result) { // o con try-catch     
            $resultado = "<p>Error en la consulta.</p>\n";
        } else {     
            foreach ($result as $valor) {         
                $resultado .= "<br>- " . $valor["ID"];     
            }
        }
        $conect = $db->desconectar();
        return $resultado;
    }

    function ejecutarSqlActualizacion($sql, $args)
    {
        $db = dataBase::conectaDb();
        $result = $db->prepare($sql); 
        $result->execute($args);       
        if (!$result) { // o con try-catch     
            echo "  <p>Error en la consulta.</p>\n";
        }
    }
    function ejecutarSqlArray($sql){
        $db = new dataBase;
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