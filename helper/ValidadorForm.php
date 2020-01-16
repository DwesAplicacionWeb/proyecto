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

    }
    
    public function esValido(){

    }

    public function getErrores(){

    }

    public function getMensajeError($campo){

    }
    
    
}
