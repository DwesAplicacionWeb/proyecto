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
                        $this -> addError($nombreCampo, "Se requiere valor en " . $nombreCampo);
                    }
                    if ($value["min"] > $valor){
                        $this -> addError($nombreCampo, "El valor de " . $nombreCampo . "debe ser mayor que " . $value["min"]);
                    } 
                    if ($value["max"] < $valor){
                        $this -> addError($nombreCampo, "El valor de " . $nombreCampo . "debe ser menor que " . $value["min"]);
                    }

                    if ($clave["precioMax"] > $clave["precioMin"]) {
                        $this -> addError($nombreCampo, "El precio minimo no puede ser mayor que el precio maximo");
                    }
                }

            }
        }
        
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
