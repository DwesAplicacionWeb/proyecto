<?php
Class Input {
    public static function get($campo)
    {
        if (isset($_POST[$campo])){      
            $campo = $_POST[$campo];
        }else{      
            $campo = "";
        }
        return Input::filtrar($campo);
    }

    public static function filtrar($campo){
        $campo = trim($campo);
        $campo = strip_tags($campo);
        $campo = htmlspecialchars($campo);
        return $campo;
    }

    public static function verificarSelect($campo , $valormenu){
        if ($campo == $valormenu) {
            echo 'selected = "selected"';
        }
    }
    public static function verificarCheckBox($campo, $equipo){
        if ($campo == $equipo) {
            echo 'checked = "checked"';
        }else{
            return $equipo;
        }
    }
    
}   
    
?>