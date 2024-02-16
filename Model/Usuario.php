<?php

include_once '../BBDD.php';

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

    static function obtenerUsuarios() : array{
        $bd = new BBDD();
        $conexion=$bd->getConexion();
        $pr=$conexion->prepare("SELECT * FROM usuarios");
        $pr->execute();

        return $pr->fetchAll(PDO::FETCH_ASSOC);

    }
    static function obtenerUsuariosMenosAdmin() : array{
        $bd = new BBDD();
        $conexion=$bd->getConexion();
        $pr=$conexion->prepare("SELECT * FROM usuarios WHERE id_usuario != 'admin';");
        $pr->execute();

        return $pr->fetchAll(PDO::FETCH_ASSOC);

    }

    static function borrarUsuario($idUsuarioBorrar){
        $bd = new BBDD();
        $conexion=$bd->getConexion();
        $pr=$conexion->prepare("DELETE FROM usuarios WHERE id_usuario = :idUsuario;");
        $pr->bindParam(':idUsuario',$idUsuarioBorrar);
        return $pr->execute();
    }
    static function obtenerUsuario(string $idUsuario) :Usuario|bool {
        $bd = new BBDD();
        $conexion=$bd->getConexion();
        $pr=$conexion->prepare("SELECT * FROM usuarios WHERE id_usuario = :idUsuario;");
        $pr->bindParam(':idUsuario',$idUsuario);

        $pr->execute();
        $usuario=$pr->fetch(PDO::FETCH_ASSOC);

        if($usuario){
            return new Usuario($usuario['id_usuario'],$usuario['password']);

        }else{
            return false;
        }
    }
    public function guardarUsuario(): bool{
        try {
        $passwordHash=$this->getPassword();
        $idUsuario=$this->getIdUsuario();

        $bd = new BBDD();
        $conexion=$bd->getConexion();
        $pr=$conexion->prepare("INSERT INTO usuarios VALUES (:idUsuario,:password)");
        $pr->bindParam(':idUsuario',$idUsuario);
        $pr->bindParam(':password',$passwordHash);

        return $pr->execute();
        }catch (Exception $error){
            return false;
        }


    }
    function modificarUsuario(string $id){

    }
}