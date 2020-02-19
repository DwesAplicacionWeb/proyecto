<?php
class ValidadorForm
{

    private $errores;
    private $reglasValidacion;
    private $valido;

    /**
     * constructor.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, January 27th, 2020.
     * @access	public
     * @return	void
     */
    public function constructor()
    {
        $errores = array();
        $reglasValidacion = null;
        $valido = false;
    }

    /**
     * validar.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, January 27th, 2020.
     * @access	public
     * @param	mixed	$fuent           	
     * @param	mixed	$reglasValidacion	
     * @return	void
     */
    public function validar($fuente, $reglasValidacion)
    {  //Valida todos los campos 
        $aux = 0;
        foreach ($reglasValidacion as $nombreCampo => $value) {
            foreach ($fuente as $clave => $valor) {
                if ($nombreCampo == $clave) {
                    if ($value["required"] == true && $valor == null) {   // Si el elemento es requerido y no hay ningun valor añade un error
                        $this->addError($nombreCampo, "Se requiere valor en " . $nombreCampo);
                    } else {
                        if ($nombreCampo == "precioMin") {  // Comprobamos restricciones de valores máximos y mínimos
                            if ($value["min"] > $valor) {
                                $this->addError($nombreCampo, "El precio mínimo debe ser mayor que " . $value["min"]);
                            } else {
                                $aux = $valor;
                            }
                        }
                        if ($nombreCampo == "precioMax") {
                            if ($value["max"] < $valor) {
                                $this->addError($nombreCampo, "El precio máximo debe ser menor que " . $value["max"]);
                            }
                            if ($valor < $aux) {
                                $this->addError($nombreCampo, "El precio minimo no puede ser mayor que el precio maximo");
                            }
                        }

                        if ($nombreCampo == "dorsal") {
                            if ($value["max"] < $valor) {
                                $this->addError($nombreCampo, "El dorsal debe ser menor que " . $value["max"]);
                            }
                            if ($value["min"] > $valor) {
                                $this->addError($nombreCampo, "El dorsal debe ser mayor que " . $value["min"]);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * addError.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, January 27th, 2020.
     * @access	public
     * @param	mixed	$nombreCamp	
     * @param	mixed	$error     	
     * @return	void
     */
    public function addError($nombreCampo, $error)
    {  // Añade un error al array de errores
        $this->errores[$nombreCampo] = $error;
    }

    /**
     * esValido.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, January 27th, 2020.
     * @access	public
     * @return	mixed
     */
    public function esValido()
    {  // Devuelve true si es válido
        if (empty($this->errores)) {
            $this->valido = true;
        }
        return $this->valido;
    }

    /**
     * getErrores.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, January 27th, 2020.
     * @access	public
     * @return	mixed
     */
    public function getErrores()
    {  // Devuelve el array de errores
        return $this->errores;
    }

    /**
     * getMensajeError.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, January 27th, 2020.
     * @access	public
     * @param	mixed	$campo	
     * @return	void
     */
    public function getMensajeError($campo)
    {  // Devuelve un error
        if (isset($this->errores[$campo])) {
            return $this->errores[$campo];
        } else {
            return "";
        }
    }
}
