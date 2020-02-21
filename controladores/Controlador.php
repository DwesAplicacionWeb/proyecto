<?php
require_once "helper/ValidadorForm.php";
require_once "modelo/DaoCamiseta.php";
require_once "modelo/camiseta.php";
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
        $dao = new DaoCamiseta();
        $equiposEste = $dao->mostrarEquiposEste();
        $equiposOeste = $dao->mostrarEquiposOeste();
        if (!isset($_POST['enviar'])) { //no se ha enviado el formulario // primera petición
            //se llama al método para mostrar el formulario inicial
            $this->mostrarFormulario("Validar", null, null, $equiposEste, $equiposOeste);
            exit();
        }
        if (isset($_POST['enviar']) && ($_POST['enviar']) === 'Validar') { //se ha enviado el formulario //se valida el formulario
            $this->validar();
            exit();
        }
        if (isset($_POST['enviar']) && ($_POST['enviar']) === 'Continuar') { //se ha enviado el formulario
            //Terminar
            unset($_POST); //Se deja limpio $_POST como la primera vez
            //echo 'Programa Finalizado';
            $this->mostrarFormulario("Validar", null, null, $equiposEste, $equiposOeste);
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
    public function mostrarFormulario($fase, $validador, $resultado, $equiposEste, $equiposOeste)
    {
        include 'vistas/form_bienvenida.php';
    }

    /**
     * crearReglasDevalidacion.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, January 27th, 2020.
     * @access	private
     * @param	mixed	{ // Se crean las reglas de validación que se comprobarán posteriormente en validar(	
     * @return	mixed
     */
    public function crearReglasDeValidacion()
    { // Se crean las reglas de validación que se comprobarán posteriormente en validar()
        $reglasValidacion = array(
            "conferencia" => array("required" => false),
            "talla" => array("required" => true),
            "precioMin" => array("min" => 1, "required" => true),
            "precioMax" => array("min" => "precioMin", "max" => 500, "required" => true),
            "dorsal" => array("min" => 0, "max" => 99, "required" => true)
        );

        return $reglasValidacion;
    }

    /**
     * validar.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Monday, January 27th, 2020.
     * @access	private
     * @return	void
     */
    public function validar()
    { // Validamos los datos
        $dao = new DaoCamiseta();
        $equiposEste = $dao->mostrarEquiposEste();
        $equiposOeste = $dao->mostrarEquiposOeste();
        $validador = new ValidadorForm();
        $resultado = "";
        $reglasValidacion = $this->crearReglasDeValidacion();
        $validador->validar($_POST, $reglasValidacion);
        if ($validador->esValido()) {
            $this->registrar();
            $talla = $_POST['talla'];
            $precioMin = $_POST['precioMin'];
            $precioMax = $_POST['precioMax'];
            $dorsal = $_POST['dorsal'];
            $resultado .= "<br><br>Talla: " . $talla; // Completamos el resultado que se mostrará por pantalla, hay que añadir las camisetas dentro del rango de precio y el dorsal si lo hay
            if (empty($_POST['confEste'])) {
                $conferenciaEste = "";
            } else {
                $conferenciaEste = $_POST['confEste'];
            }
            if (empty($_POST['confOeste'])) {
                $conferenciaOeste = "";
            } else {
                $conferenciaOeste = $_POST['confOeste'];
            }
            if (empty($conferenciaEste) && empty($conferenciaOeste)) {
                $resultado = "No se ha elegido ningun equipo";
            }
            if (!empty($conferenciaEste)) {  // Recoge el valor de los equipos seleccionados(si hay alguno)
                foreach ($conferenciaEste as $clave => $valor) {
                    $resultado .= $dao->resultadoJugadores($valor, $precioMin, $precioMax, $dorsal);
                }
            }
            if (!empty($conferenciaOeste)) {  // Recoge el valor de los equipos seleccionados(si hay alguno)
                foreach ($conferenciaOeste as $clave => $valor) {
                    $resultado .= $dao->resultadoJugadores($valor, $precioMin, $precioMax, $dorsal);
                }
            }
            $this->mostrarFormulario("Continuar", $validador, $resultado, $equiposEste, $equiposOeste); /// completar
            exit();
        }
        $this->mostrarFormulario("Validar", $validador, null, $equiposEste, $equiposOeste);
        exit();
    }

    /**
     * crearCamiseta.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Thursday, February 20th, 2020.
     * @return	mixed
     */
    function crearCamiseta()
    {
        $camiseta = new Camiseta($_POST['dorsal'], $_POST['talla']);
        return $camiseta;
    }

    /**
     * registrar.
     *
     * @author	Isa Kapov, Jonathan López, Álvaro Colás
     * @since	v0.0.1
     * @version	v1.0.0	Thursday, February 20th, 2020.
     * @return	void
     */
    function registrar()
    {
        $camiseta = $this->crearCamiseta();
        $dao = new DaoCamiseta();
        $db = new DataBase();
        $existe = $dao->existeCamiseta($camiseta);
        if ($existe) {
            $talla = $camiseta->getTalla();
            $dorsal = $camiseta->getDorsal();
            $contSentencia = "SELECT CONT FROM INSERTS WHERE TALLA = '$talla' AND DORSAL = '$dorsal'";
            $contPdo = $db->ejecutarSql($contSentencia);
            $cont = 0;
            foreach ($contPdo as $valor) {
                $cont = $valor['CONT'];
            }
            $actualizar = "UPDATE INSERTS SET CONT = $cont + 1 WHERE TALLA = '$talla' AND DORSAL = '$dorsal'";
            $db->ejecutarSql($actualizar);
        } else {
            $dao->insertarCamiseta($camiseta);
        }
    }
}
