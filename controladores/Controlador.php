<?php
// Proyecto Grupal DWES
// * @author Isa Kapov, Jonathan López, Álvaro Colás
// Titulo: Tienda camisetas NBA
// Fecha de inicio de proyecto: 5/12/2019
class Controlador
{
    /**
     * run.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, December 16th, 2019.
     * @access	public
     * @return	void
     */
    public function run()
    {

        if (!isset($_POST['enviar'])) { //Comprueba si enviar ha sido pulsado y muestra el formulario si no lo esta.
            $this->mostrarFormulario();
            exit();
        } else {                        //Si ya ha sido pulsado, recogemos todos los valores del formulario y los introducimos en $resultado.
            $this -> validar();
            $conferencia = $_POST['confEste'];
            $resultado = "Equipo/s:";
            foreach ($conferencia as $clave => $valor) { //Comprobamos los checkbox para ver que equipos están marcados
                $resultado .= "<br>- " .$valor ;
            }

            $conferencia = $_POST['confOeste'];
            foreach ($conferencia as $clave => $valor) {
                $resultado .= "<br>- " .$valor;
            }

            $talla = $_POST['talla'];
            $precioMin = $_POST['precioMin'];
            $precioMax = $_POST['precioMax'];
            $dorsal = $_POST['dorsal'];
            $resultado .= "<br><br>Talla: " . $talla . " <br><br>Precio minimo: " . $precioMin . "<br>Precio máximo: " . $precioMax
            . "<br><br>Dorsal: " . $dorsal;
            $this->mostrarResultado($resultado);
            exit();
        }
    }
    /**
     * mostrarFormulario.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, December 16th, 2019.
     * @access	private
     * @return	void
     */
    private function mostrarFormulario()
    {
        include 'vistas/form_bienvenida.php';   
    }
    /**
     * mostrarResultado.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, December 16th, 2019.
     * @access	private
     * @param	mixed	$resultado	
     * @return	void
     */
    private function mostrarResultado($resultado) //Si ya se ha mostrado el fomulario anteriormente, muestra a su vez formulario y resultado en la misma pagina.
    {
        include 'vistas/form_bienvenida.php';
    }

    private function crearReglasDevalidacion(){
        $reglasValidacion = array(
            "dorsal" => array("required" => false)
            
        );

        return $reglasValidacion;
    }

    private function validar(){
        $validador = new ValidadorForm();
        $reglasValidacion = $this->crearReglasDevalidacion();
        $validador ->validar($_POST, $reglasValidacion);
        if($validador -> esValido()){
            $this->mostrarFormulario();
            exit();
        }

        $this->mostrarFormulario("validar", $validador, null);
        exit();
    }
    
}
