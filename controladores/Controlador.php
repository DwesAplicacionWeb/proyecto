<?php
require_once "helper/ValidadorForm.php";
require_once "modelo/daoCamiseta.php";
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
        $dao = new daoCamiseta();
        $equiposEste = $dao->mostrarEquiposEste();
        $equiposOeste = $dao->mostrarEquiposOeste();
        if (!isset($_POST['enviar'])) { //no se ha enviado el formulario // primera petición
            //se llama al método para mostrar el formulario inicial
            $this->mostrarFormulario("Validar", null, null,$equiposEste, $equiposOeste);
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
            $this->mostrarFormulario("Validar", null, null,$equiposEste, $equiposOeste);
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
    private function mostrarFormulario($fase, $validador, $resultado,$equiposEste, $equiposOeste)
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
    private function crearReglasDevalidacion(){ // Se crean las reglas de validación que se comprobarán posteriormente en validar()
        $reglasValidacion = array(
            "conferencia" => array("required" => false),
            "talla" => array("required" => true),
            "precioMin" => array("min"=>1 , "required" => true),
            "precioMax" => array("min"=>"precioMin" , "max"=>500 , "required" => true),
            "dorsal" => array("min"=>0 , "max"=> 99 , "required" => false)
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
    private function validar(){ // Validamos los datos
        $dao = new daoCamiseta();
        $equiposEste = $dao->mostrarEquiposEste();
        $equiposOeste = $dao->mostrarEquiposOeste();
        $validador = new ValidadorForm();
        $resultado = "";
        $reglasValidacion = $this->crearReglasDevalidacion();
        $validador ->validar($_POST, $reglasValidacion);
        if($validador -> esValido()){
            $talla = $_POST['talla'];
            $precioMin = $_POST['precioMin'];
            $precioMax = $_POST['precioMax'];
            $dorsal = $_POST['dorsal'];
            $resultado .= "<br><br>Talla: " . $talla; // Completamos el resultado que se mostrará por pantalla, hay que añadir las camisetas dentro del rango de precio y el dorsal si lo hay
            if (empty($_POST['confEste'])){
                $conferenciaEste = ""; 
            }else{
                $conferenciaEste = $_POST['confEste']; 
            }
            if (empty($_POST['confOeste'])){
                $conferenciaOeste = ""; 
            }else{
                $conferenciaOeste = $_POST['confOeste']; 
            }
            if(empty($conferenciaEste) && empty($conferenciaOeste)){
                $resultado = "No se ha elegido ningun equipo";
            }
            if (!empty($conferenciaEste)) {  // Recoge el valor de los equipos seleccionados(si hay alguno)
                foreach ($conferenciaEste as $clave => $valor) {
                    $resultado .= $dao->leerFormulario($valor, $precioMin, $precioMax, $dorsal);
                }
            }
            if (!empty($conferenciaOeste)) {  // Recoge el valor de los equipos seleccionados(si hay alguno)
                foreach ($conferenciaOeste as $clave => $valor) {
                    $resultado .= $dao->leerFormulario($valor, $precioMin, $precioMax, $dorsal);
                }
            }
            $this->mostrarFormulario("Continuar", $validador, $resultado,$equiposEste, $equiposOeste); /// completar
            exit();
        }
        
        $this->mostrarFormulario("Validar", $validador, null,$equiposEste, $equiposOeste);
        exit();
    }
    
}
