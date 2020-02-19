<?php
require_once "modelo/dataBase.php";
require_once "modelo/camiseta.php";
require_once "helper/ValidadorForm.php";

class daoCamiseta
{
    /**
     * mostrarEquiposEste.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, February 17th, 2020.
     * @return	mixed
     */
    function mostrarEquiposEste()
    {
        $db = new dataBase();
        $este  = "SELECT NOMBRE FROM EQUIPOS WHERE CONFERENCIA = 'ESTE'";
        return $db->ejecutarSqlArray($este);
    }

    /**
     * mostrarEquiposOeste.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, February 17th, 2020.
     * @return	mixed
     */
    function mostrarEquiposOeste()
    {
        $db = new dataBase();
        $oeste  = "SELECT NOMBRE FROM EQUIPOS WHERE CONFERENCIA = 'OESTE'";
        return $db->ejecutarSqlArray($oeste);
    }
    /**
     * leerFormulario.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, February 17th, 2020.
     * @param	mixed	$valor    	
     * @param	mixed	$precioMin	
     * @param	mixed	$precioMax	
     * @param	mixed	$dorsal   	
     * @return	mixed
     */
    function leerFormulario($valor, $precioMin, $precioMax, $dorsal)
    {
        $db = new dataBase();
        $resultado = "";
        $result = "";
        if (empty($dorsal)) {
            $consulta = "SELECT ID FROM JUGADORES WHERE EQUIPO = '$valor' AND PRECIO BETWEEN '$precioMin' AND '$precioMax'"; // En un futuro mostraR mas datos(no solo nombre), habrá que recorrer de otra forma
            $resultado = $db->ejecutarSql($consulta);
        } else {
            $consulta = "SELECT ID FROM JUGADORES WHERE EQUIPO = '$valor' AND DORSAL = '$dorsal' AND PRECIO BETWEEN '$precioMin' AND '$precioMax'";
            $resultado = $db->ejecutarSql($consulta);
        }
        foreach ($resultado as $valor) {
            $result .= "<br>- " . $valor["ID"];
        }
        return $result;
    }

    function existeCamiseta($camiseta)
    {
        $db = new dataBase();
        $existe = false;
        $consultaTalla = "SELECT TALLA, DORSAL FROM INSERTS";
        $resultado = $db->ejecutarSql($consultaTalla);
        foreach ($resultado as $valor) {
            if ($camiseta->getTalla() == $valor["TALLA"]) {
                if ($camiseta->getDorsal() == $valor["DORSAL"]) {
                    $existe =  true;
                }
            }
        }
        return $existe;
    }

    function insertarCamiseta($camiseta)
    {
        $db = new dataBase();
        $talla = $camiseta->getTalla();
        $dorsal = $camiseta->getDorsal();
        $insercion = "INSERT INTO INSERTS (TALLA, DORSAL) VALUES ('$talla', '$dorsal')";
        $db->ejecutarSql($insercion);
    }
}
