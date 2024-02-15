<?php

namespace Model;

class Fotos
{
    private $id;
    private $idVivienda;
    private $fotos;

    /**
     * @param $idVivienda
     * @param $fotos
     */
    public function __construct($idVivienda, $fotos)
    {
        $this->idVivienda = $idVivienda;
        $this->fotos = $fotos;
    }

    public function __get($name)
    {
        if(property_exists($this, $name)){
            return $this->$name;
        }
    }

    public function __set($name, $value)
    {
        if(property_exists($this, $name)){
            $this->$name = $value;
        }
    }
    public function guardarFoto(){
        $this->fotos


    }

}