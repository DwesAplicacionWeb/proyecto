<?php
// Proyecto Grupal DWES
// @author Isa Kapov, Jonathan López, Álvaro Colás
// Titulo: Tienda camisetas NBA
// Fecha de inicio de proyecto: 5/12/2019
include "cabecera.php";
include "helper/Input.php";
include "includes/funciones.php";
?>
<body>
    <link rel="stylesheet" href="css/form_bienvenida_CSS.css">
    <main>
        <!-- En nuestro formulario daremos las opciones de buscar por conferencia(este/oeste), equipo(checkbox)
    ,talla(select desplegable con seleccion unica), precio minimo y maximo (textbox) y por dorsal(textbox de tipo 'number') -->
        <form class="formulario1" id="form" action="index.php" method="POST">
        <?php 
            $equiposEste = array('DALLAS MAVERICKS','LOS ANGELES LAKERS','LOS ANGELES CLIPPERS','HOUSTON ROCKETS', 'GOLDEN STATE WARRIORS');
            $equiposOeste = array('MILWAUKEE BUCKS','BOSTON CELTICS','PHILADELPHIA 76ERS','TORONTO RAPTORS', 'NEW YORK KNICKS');
            ?>
            <div class="este">
            <label>CONFERENCIA ESTE</label>
            <br><br>
            <?php
            mostrarEquipos($equiposEste,"confEste[]");
            ?>
            <br>
            <hr>
            </div>
            <div class="oeste">
            <label>CONFERENCIA OESTE</label>
            <br><br>
            <?php
            mostrarEquipos($equiposOeste,"confOeste[]");
            ?>
            <br>
            <hr>
            </div>
            <br>
            <label>Tallas</label>
            <select name="talla">
            <?php 
            $tallas=array('S','M','L','XL');
            foreach ($tallas as $t) 
            {
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
            <input type="number" min="1.00" max="500.00" name="precioMin" step="1" <?php  echo Input::get('precioMin') ?>/>
            <br>
            <label for="max">Precio máximo:</label>
            <input type="number" min="1.00" max="500.00" name="precioMax" step="1" <?php  echo Input::get('precioMax') ?>/>
            <hr />
            <br>
            <label for="dorsal">Dorsal:</label>
            <input type="number" name="dorsal" min="0" max="99" step="1"  <?php  echo Input::get('dorsal') ?>/>
            <br><br>
            <div class="centrar">
            <input type="submit" name="enviar" value="Enviar">
            <input type="reset" value="Limpiar">
            </div>
        </form>
    </main>
    <?php
        if (isset($resultado)) { //En caso de existir $resultado se mostrará el resultado
            echo "<div class='resultado'>";
            echo $resultado;
            echo "</div>";
        }

    include "pie.php";

    ?>