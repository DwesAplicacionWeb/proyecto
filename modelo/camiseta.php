<?php
class Camiseta
{
    private $dorsal;
    private $talla;

    public function __construct($dorsal, $talla)
    {
        $this->dorsal = $dorsal;
        $this->talla = $talla;
    }
    public function getTalla()
    {
        return  $this->talla;
    }
    public function getDorsal()
    {
        return  $this->dorsal;
    }
    public function setTalla($talla)
    {
        $this->talla = $talla;
    }
    public function setDorsal($dorsal)
    {
        $this->dorsal = $dorsal;
    }
}
