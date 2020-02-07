<?php
Class Utilidades{
    /**
     * desactivar.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, January 27th, 2020.
     * @access	public static
     * @param	mixed	$fase	
     * @return	void
     */
    public static function desactivar($fase){
        if ($fase === "Continuar"){
            echo "disabled=disabled";
        }
    }
}

?>