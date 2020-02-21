<?php
// Proyecto Grupal DWES
// @author Isa Kapov, Jonathan López, Álvaro Colás
// Titulo: Tienda camisetas NBA
// Fecha de inicio de proyecto: 5/12/2019
include "cabecera.php";
require_once "helper/Input.php";
require_once "helper/Utilidades.php";
include "includes/funciones.php";

?>

<body>
    <link rel="stylesheet" href="css/form_bienvenida_CSS.css">
    <div class="contenido">
        <main>
            <?php
            if (isset($validador)) { // En caso de haber validado todo y existir errores los muestra encima del formulario
                $errores = $validador->getErrores();
                if (!empty($errores)) {
                    echo "<div class='errores'>";
                    foreach ($errores as $campo => $mensajeError) {
                        echo "<p>$mensajeError</p>\n";
                    }
                    echo "</div>";
                }
            }
            ?>
            <!-- En nuestro formulario daremos las opciones de buscar por conferencia(este/oeste), equipo(checkbox)
    ,talla(select desplegable con seleccion unica), precio minimo y maximo (textbox) y por dorsal(textbox de tipo 'number') -->
            <form class="formulario1" id="form" action="index.php" method="POST">
                <div class="este">
                    <label class="confEste">CONFERENCIA ESTE</label>
                    <br><br>
                    <?php
                    mostrarEquipos($equiposEste, "confEste[]");
                    ?>


                </div>
                <div class="oeste">
                    <label class="confOeste">CONFERENCIA OESTE</label>
                    <br><br>
                    <?php
                    mostrarEquipos($equiposOeste, "confOeste[]");
                    ?>

                </div>
                <br>
                <label>Tallas</label>
                <select name="talla">
                    <?php
                    $tallas = array('S', 'M', 'L', 'XL');
                    foreach ($tallas as $t) {
                        echo "<option value='" . $t . "'";
                        echo Input::verificarSelect(Input::get('talla'), $t);
                        echo ">$t</option>\n";
                    }
                    ?>
                </select>
                <br><br>
                <hr />
                <br>
                <label for="min">Precio mínimo:</label>
                <input type="number" class="number-wrapper" min="1.00" max="500.00" name="precioMin" step="1" value="<?php echo Input::get('precioMin') ?>" />
                <br>
                <label for="max">Precio máximo:</label>
                <input type="number" class="number-wrapper" min="1.00" max="500.00" name="precioMax" step="1" value="<?php echo Input::get('precioMax') ?>" />
                <hr />
                <br>
                <label for="dorsal">Dorsal:</label>
                <input type="number" class="number-wrapper" name="dorsal" min="0" max="99" step="1" value="<?php echo Input::get('dorsal') ?>" />
                <br><br>
                <div class="centrar">
                    <input type="submit" name="enviar" value="<?php echo $fase ?>">
                    <input id="reset" type="reset" value="Limpiar" <?php echo Utilidades::desactivar($fase) ?> />
                </div>
            </form>

            <?php
            if (isset($resultado)) { //En caso de existir $resultado se mostrará el resultado
                echo "<div class='resultado'>";
                echo $resultado;
                echo "</div>";
            }
            ?>
        </main>

    </div>
    <?php
    include "pie.php";

    ?>