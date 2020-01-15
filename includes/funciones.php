<?php
// fichero con funciones de ayuda (helpers)
function verArray($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function mostrarEquipos($array, $conferencia)
{
    $cont = 1;
    foreach ($array as $valor) {
?>
        <input type="checkbox" name="<?php echo $conferencia ?>" value="<?php echo Input::verificarCheckBox(Input::get($conferencia), $valor)?>" id="<?php echo $cont ?>"> <label for="<?php echo $cont ?>"><?php echo $valor ?></label><br>
<?php
        $cont++;
    }
}
?>