<?php

include_once '../BBDD.php';

class Vivienda
{
    private $id;
    private $tipo;
    private $zona;
    private $direccion;
    private $ndormitorios;
    private $precio;
    private $tamano;
    private $extras;
    private $observaciones;
    private $fecha_anuncio;

    /**
     * @param $tipo
     * @param $zona
     * @param $direccion
     * @param $ndormitorios
     * @param $precio
     * @param $tamano
     * @param $extras string con comas
     * @param $observaciones
     */
    public function __construct($tipo, $zona, $direccion, $ndormitorios, $precio, $tamano, $extras, $observaciones)
    {
        $this->tipo = $tipo;
        $this->zona = $zona;
        $this->direccion = $direccion;
        $this->ndormitorios = $ndormitorios;
        $this->precio = $precio;
        $this->tamano = $tamano;
        $this->extras = $extras;
        $this->observaciones = $observaciones;
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

    static public function obtenerTodasViviendas(){
        $bd = new BBDD();

        $conexion = $bd->getConexion();
        $pr=$conexion->prepare('SELECT * FROM viviendas');
        $pr->execute();

        return $pr->fetchAll(PDO::FETCH_ASSOC);


    }
    function ActualizarVivienda($idVivienda){
        $tipo = $this->tipo;
        $zona = $this->zona;
        $direccion = $this->direccion;
        $ndormitorios = $this->ndormitorios;
        $precio = $this->precio;
        $tamano = $this->tamano;
        $extras = $this->extras;
        $observaciones = $this->observaciones;

        $bd = new BBDD();

        $conexion = $bd->getConexion();

        $pr=$conexion->prepare("UPDATE `viviendas` SET
                       `tipo`= :tipo,`zona`= :zona,`direccion`= :direccion,
                       `ndormitorios`= :ndormitorios,`precio`= :precio,`tamano`= :tamano,
                       `extras`= :extras,`observaciones`= :observaciones WHERE id= :id");

        $pr->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $pr->bindParam(':zona', $zona, PDO::PARAM_STR);
        $pr->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $pr->bindParam(':ndormitorios', $ndormitorios, PDO::PARAM_STR);
        $pr->bindParam(':precio', $precio, PDO::PARAM_INT);
        $pr->bindParam(':tamano', $tamano, PDO::PARAM_INT);
        $pr->bindParam(':extras', $extras, PDO::PARAM_STR);
        $pr->bindParam(':observaciones', $observaciones, PDO::PARAM_STR);
        $pr->bindParam(':id', $idVivienda, PDO::PARAM_INT);

        return $pr->execute();
    }
    static function obtenerVivienda($idVivienda){
        $bd = new BBDD();

        $conexion = $bd->getConexion();
        $pr=$conexion->prepare('SELECT * FROM viviendas WHERE id= :idVivienda ');
        $pr->bindParam(':idVivienda', $idVivienda, PDO::PARAM_INT);
        $pr->execute();

        return $pr->fetch(PDO::FETCH_ASSOC);


    }
    static function borrarVivienda($idVivienda){
        $bd = new BBDD();

        $conexion = $bd->getConexion();
        $pr=$conexion->prepare('DELETE FROM viviendas WHERE id= :idVivienda');
        $pr->bindParam(':idVivienda', $idVivienda, PDO::PARAM_INT);
        $pr->execute();

        return $pr->fetchAll(PDO::FETCH_ASSOC);


    }
    static public function numeroDeViviendas() {
        $bd = new BBDD();

        $conexion = $bd->getConexion();
        $pr=$conexion->prepare("SELECT count(id) as 'numero_viviendas' FROM `viviendas`");
        $pr->execute();
        
        return $pr->fetch(PDO::FETCH_ASSOC);


    }

    public function __toString()
    {
        return "Vivienda { id: $this->id, tipo: $this->tipo, zona: $this->zona, direccion: $this->direccion, ndormitorios: $this->ndormitorios, precio: $this->precio, tamano: $this->tamano, extras: $this->extras, observaciones: $this->observaciones, fecha_anuncio: $this->fecha_anuncio }";
    }
    static public function obtenerIdMasAlto(){
        $bd = new BBDD();

        $conexion = $bd->getConexion();
        $pr=$conexion->prepare(" SELECT MAX(id) as 'id_mas_alto' FROM `viviendas` ");

        $pr->execute();

        return $pr->fetch(PDO::FETCH_ASSOC);
    }
    static public function obtenerViviendaPagina($paginaBuscada){
        $bd = new BBDD();

        $minimo=$paginaBuscada*4;
        $conexion = $bd->getConexion();
        $pr=$conexion->prepare('SELECT * FROM viviendas ORDER BY fecha_anuncio DESC LIMIT :minimo, 4;');
        $pr->bindParam(':minimo', $minimo, PDO::PARAM_INT);

        $pr->execute();

        return $pr->fetchAll(PDO::FETCH_ASSOC);


    }

    public function guardarVivienda(): bool
    {
        $tipo = $this->tipo;
        $zona = $this->zona;
        $direccion = $this->direccion;
        $ndormitorios = $this->ndormitorios;
        $precio = $this->precio;
        $tamano = $this->tamano;
        $extras = $this->extras;
        $observaciones = $this->observaciones;

        $bd = new BBDD();

        $conexion = $bd->getConexion();

        $pr=$conexion->prepare("INSERT INTO `viviendas`(`tipo`, `zona`, `direccion`, `ndormitorios`, `precio`, `tamano`, `extras`, `observaciones`) VALUES (:tipo,:zona,:direccion,:ndormitorios,:precio,:tamano,:extras,:observaciones)");

        $pr->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $pr->bindParam(':zona', $zona, PDO::PARAM_STR);
        $pr->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $pr->bindParam(':ndormitorios', $ndormitorios, PDO::PARAM_STR);
        $pr->bindParam(':precio', $precio, PDO::PARAM_INT);
        $pr->bindParam(':tamano', $tamano, PDO::PARAM_INT);
        $pr->bindParam(':extras', $extras, PDO::PARAM_STR);
        $pr->bindParam(':observaciones', $observaciones, PDO::PARAM_STR);

        return $pr->execute();


    }

}

