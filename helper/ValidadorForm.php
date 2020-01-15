<?php
Class ValidadorForm{

    private $errores = array();
    private $reglasValidacion;
    private $valido;

    public function constructor(){
        $reglasValidacion = null;
        $valido = false;
    }

    public function validar($fuente , $reglasValidacion){
        
    }

    public function addError($nombreCampo , $error){



        array_push($errores, $error);
    }
    
    public function esValido(){

    }

    public function getErrores(){
        foreach ($errores as $error){
            echo $error;
        }
    }

    public function getMensajeError($campo){

    }
    
    
}
