<?php

include_once '../BBDD.php';

class Foto
{
    private $id;
    private $idVivienda;
    private $nombreFoto;

    /**
     * @param $idVivienda
     * @param $fotos
     */
    public function __construct($idVivienda, $nombreFoto)
    {
        $this->idVivienda = $idVivienda;
        $this->nombreFoto = $nombreFoto;
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
        $bd = new BBDD();
        $conexion=$bd->getConexion();
        $pr=$conexion->prepare("INSERT INTO `fotos` (`id_vivienda`, `foto`) VALUES (:idVivienda,:urlFoto)");
        $pr->bindParam(':idVivienda',$this->idVivienda);
        $pr->bindParam(':urlFoto',$this->nombreFoto);

        $pr->execute();
    }
    static public function borrarFotosDeVivienda($idVIvienda){
        $bd = new BBDD();
        $conexion=$bd->getConexion();
        $pr=$conexion->prepare("DELETE FROM fotos WHERE id_vivienda = :idVivienda;");
        $pr->bindParam(':idVivienda',$idVivienda);

        $pr->execute();
    }
    static function obtenerFotoDeVivienda($idVivienda){
        $bd = new BBDD();
        $conexion=$bd->getConexion();
        $pr=$conexion->prepare("SELECT * FROM fotos WHERE id_vivienda = :idVivienda;");
        $pr->bindParam(':idVivienda',$idVivienda);

        $pr->execute();
        return $pr->fetchAll(PDO::FETCH_ASSOC);
    }

}
