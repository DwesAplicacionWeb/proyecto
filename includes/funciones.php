<?php
/**
 * fichero con funciones de ayuda (helpers)
 *
 * @author	Isa Kapov, Jonathan López, Álvaro Colás
 * @since	v0.0.1
 * @version	v1.0.0	Monday, January 27th, 2020.
 * @global
 * @param	mixed	$array	
 * @return	void
 */
function verArray($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
/**
 * mostrarEquipos.
 *
 * @author	Isa Kapov, Jonathan López, Álvaro Colás
 * @since	v0.0.1
 * @version	v1.0.0	Monday, January 27th, 2020.
 * @global
 * @param	mixed	$array      	
 * @param	mixed	$conferencia	
 * @return	void
 */
function mostrarEquipos($array, $conferencia) //Muestra todos los equipos disponibles de una conferencia en forma de checkbox
{
    $cont = 1;
    foreach ($array as $valor) {
        $nombre = substr($conferencia, 0, strlen($conferencia) - 2);
        $n = Input::get($nombre);
        $v = Input::verificarCheckBox($n, $valor);
?>
        <input type="checkbox" name="<?php echo $conferencia ?>" value="<?php echo $valor ?>" <?php echo $v ?> id="<?php echo $valor ?>"> <label for="<?php echo $valor ?>"><?php echo $valor ?></label><br>
<?php
        $cont++;
    }
}
?>