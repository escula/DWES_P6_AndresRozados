<?php
include_once '../BBDD.php';
include_once 'Usuario.php';
class Cliente
{
    private $dni;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $email;

    /**
     * @param $dni
     * @param $nombre
     * @param $apellidos
     * @param $telefono
     * @param $email
     */
    public function __construct($dni, $nombre, $apellidos, $telefono, $email)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     */
    public function setDni($dni): void
    {
        $this->dni = $dni;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }
//    public obtenerClientes(){
//
//    }
//    static public obtenerCLiente(){
//
//    }
    public function insertarCliente(): bool{
        $dni=$this->getDni();
        $nombre= $this->getNombre();
        $apellidos=$this->getApellidos();
        $telefono=$this->getTelefono();
        $email=$this->getEmail();

        $contrasenaHash = password_hash('1234',PASSWORD_ARGON2ID);


        $usuarioIntroducir=new Usuario($dni,$contrasenaHash);

        $introducidoUsuario=$usuarioIntroducir->guardarUsuario();

        $bd =new BBDD();
        $conexion =$bd->getConexion();

        $pr=$conexion->prepare("INSERT INTO clientes VALUES (:dni,:nombre,:apellidos,:telefono,:email)");
        $pr->bindParam(':dni',$dni, PDO::PARAM_STR);
        $pr->bindParam(':nombre',$nombre,PDO::PARAM_STR);
        $pr->bindParam(':apellidos',$apellidos,PDO::PARAM_STR);
        $pr->bindParam(':telefono',$telefono,PDO::PARAM_STR);
        $pr->bindParam(':email',$email,PDO::PARAM_STR);
        $introducidoCliente =$pr->execute();

        if( $introducidoUsuario && $introducidoCliente){
            return true;
        }else{
            return false;
        }



    }
}