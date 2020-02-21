<?php
require_once "modelo/DataBase.php";
require_once "modelo/camiseta.php";
require_once "helper/ValidadorForm.php";

class DaoCamiseta
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
        $db = new DataBase();
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
        $db = new DataBase();
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
    function resultadoJugadores($valor, $precioMin, $precioMax, $dorsal)
    {
        $db = new DataBase();
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

    /**
     * existeCamiseta.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Thursday, February 20th, 2020.
     * @param	mixed	$camiseta	
     * @return	mixed
     */
    function existeCamiseta($camiseta)
    {
        $db = new DataBase();
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

    /**
     * insertarCamiseta.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Thursday, February 20th, 2020.
     * @param	mixed	$camiseta	
     * @return	void
     */
    function insertarCamiseta($camiseta)
    {
        $db = new DataBase();
        $talla = $camiseta->getTalla();
        $dorsal = $camiseta->getDorsal();
        $insercion = "INSERT INTO INSERTS (TALLA, DORSAL, CONT) VALUES ('$talla', '$dorsal', 1)";
        $db->ejecutarSql($insercion);
    }
}
