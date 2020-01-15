<?php
Class ValidadorForm{

    private $errores;
    private $reglasValidacion;
    private $valido;

    public function constructor(){
        $errores = array();
        $reglasValidacion = null;
        $valido = false;
    }

    public function validar($fuente , $reglasValidacion){
        foreach ($reglasValidacion as $nombreCampo => $value) {
            foreach ($fuente as $clave => $valor) {
                if ($nombreCampo == $clave) {
                    if ($value["required"] == true && $valor == null) {
                        $validar[$clave] = "Error " . $nombreCampo . "required";
                    else if () {

                    }else{
                        $validar[$clave] = $valor;
                    }
                }
            }
        }
        return $validar;
    }

    public function addError($nombreCampo , $error){
        $this -> errores[$nombreCampo] = $error;
    }
    
    public function esValido(){
        return $this -> valido;
    }

    public function getErrores(){
        return $this -> errores;
    }

    public function getMensajeError($campo){
        if (isset($this -> errores[$campo])){
           return $this -> errores[$campo];
        }else{
            return "";
        }
        
    }
    
    
}
