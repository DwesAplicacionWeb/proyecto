<?php
Class Input {
    /**
     * get.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, January 27th, 2020.
     * @access	public static
     * @param	mixed	$campo	
     * @return	mixed
     */
    public static function get($campo) //Coge el valor y lo pasa a filtrar evitando errores por valor null
    {
        if (isset($_POST[$campo])){      
            $campo = $_POST[$campo];
        }else{      
            $campo = "";
        }
        return Input::filtrar($campo); 
    }

    /**
     * filtrar.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, January 27th, 2020.	
     * @version	v1.0.1	Monday, January 27th, 2020.
     * @access	public static
     * @param	mixed	$campo	
     * @return	void
     */
    public static function filtrar($campo){ // Filtra el valor campo y lo devuelve distinguiendo si es un array o un valor
        if(is_array($campo)){
            for ($i=0; $i < count($campo); $i++) { 
                $campo[$i] = trim($campo[$i]);
                $campo[$i] = strip_tags($campo[$i]);
                $campo[$i] = htmlspecialchars($campo[$i]);
            }
            return $campo;
        }else{
            $campo = trim($campo);
            $campo = strip_tags($campo);
            $campo = htmlspecialchars($campo);
            return $campo;
        }
    }

    /**
     * verificarSelect.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, January 27th, 2020.
     * @access	public static
     * @param	mixed	$camp     	
     * @param	mixed	$valormenu	
     * @return	void
     */
    public static function verificarSelect($campo , $valormenu){//Mantiene seleccionada la opcion escogida de la lista
        if ($campo == $valormenu) {
            echo 'selected = "selected"';
        }
    }

    /**
     * verificarCheckBox.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, January 27th, 2020.
     * @access	public static
     * @param	mixed	$array	
     * @param	mixed	$valor	
     * @return	void
     */
    public static function verificarCheckBox($array, $valor) //Mantiene seleccionado los checkbox marcados
    {
        if (!empty($array)) {
            if (in_array($valor, $array)) {
                return 'checked = "checked"';
            }
        }
    }
    /**
     * siEnviado.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, January 27th, 2020.
     * @access	public static
     * @param	string	$tipo	Default: "post"
     * @return	void
     */
    public static function siEnviado($tipo = "post"){ // Comprueba si a habido envio
        switch ($tipo){
            case 'post':
                return !empty($_POST);
                break;
            default:
                return false;
            break;
        }
    }
}   
    
?>