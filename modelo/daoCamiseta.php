<?php
require_once "modelo/dataBase.php";
class daoCamiseta
{
    function mostrarEquiposEste(){ 
        $db = new dataBase();
        $este  = "SELECT NOMBRE FROM EQUIPOS WHERE CONFERENCIA = 'ESTE'"; 
        return $db->ejecutarSqlArray($este);
    }
        
    function mostrarEquiposOeste(){ 
        $db = new dataBase();
        $oeste  = "SELECT NOMBRE FROM EQUIPOS WHERE CONFERENCIA = 'OESTE'"; 
        return $db->ejecutarSqlArray($oeste);
    }
    function leerFormulario($valor, $precioMin, $precioMax, $dorsal){
        $db = new dataBase();
        $resultado = "";
        if(empty($dorsal)){
            $consulta = "SELECT ID FROM JUGADORES WHERE EQUIPO = '$valor' AND PRECIO BETWEEN '$precioMin' AND '$precioMax'"; // En un futuro mostraR mas datos(no solo nombre), habrá que recorrer de otra forma
            $resultado = $db->ejecutarSql($consulta);
        }else{
            $consulta = "SELECT ID FROM JUGADORES WHERE EQUIPO = '$valor' AND DORSAL = '$dorsal' AND PRECIO BETWEEN '$precioMin' AND '$precioMax'"; 
            $resultado = $db->ejecutarSql($consulta);
        }
        return $resultado;
    }
}
?>