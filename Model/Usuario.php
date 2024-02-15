<?php

namespace Model;
include_once ('use ../');

class Usuario
{
    private $id_usuario;
    private $password;

    /**
     * @param $id_usuario
     * @param $password
     */
    public function __construct($id_usuario, $password)
    {
        $this->id_usuario = $id_usuario;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param mixed $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    function obtenerUsuarios(){

    }
    static function obtenerUsuario(string $id){
    }
    function guardarUsuario(string $id){

    }
    function modificarUsuario(string $id){

    }
}