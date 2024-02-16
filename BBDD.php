<?php

class BBDD{
    private $conexion;
    public function  __construct($nombreServ="localhost:3307",$nombreBD="inmobiliaria",$usuario="root",$password=""){

        $this->conexion=new PDO("mysql:host=$nombreServ;dbname=$nombreBD;charset=utf8", $usuario, $password);
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }


    public function getConexion(){
        return $this->conexion;
    }
}