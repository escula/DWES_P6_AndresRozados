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
     * @param $extras
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
    static public function numeroDeViviendas() : int {
        $bd = new BBDD();

        $conexion = $bd->getConexion();
        $pr=$conexion->prepare("SELECT count(id) as 'numero_viviendas' FROM `viviendas`");
        $pr->execute();
        
        $resultado=$pr->fetch(PDO::FETCH_ASSOC);

        return $resultado['numero_viviendas'];
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

    public function guardarVivienda(Vivienda $viviendaInsertar, $imagenes){
        $tipo = $viviendaInsertar->tipo;
        $zona = $viviendaInsertar->zona;
        $direccion = $viviendaInsertar->direccion;
        $ndormitorios = $viviendaInsertar->ndormitorios;
        $precio = $viviendaInsertar->precio;
        $tamano = $viviendaInsertar->tamano;
        $extras = $viviendaInsertar->extras;
        $observaciones = $viviendaInsertar->observaciones;
        $fecha_anuncio = $viviendaInsertar->fecha_anuncio;
        $precio = $viviendaInsertar->precio;

        $bd = new BBDD();

        $conexion = $bd->getConexion();

        $pr=$conexion->prepare("INSERT INTO `viviendas`(`tipo`, `zona`, `direccion`, `ndormitorios`, `precio`, `tamano`, `extras`, `observaciones`, `fecha_anuncio`) VALUES (':tipo',':zona',':direccion',':ndormitorios',':precio',':tamano',':extras','observaciones',':fecha_anuncio')");

        $pr->bindParam(':id', $username, PDO::PARAM_STR);
        $pr->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $pr->bindParam(':zona', $zona, PDO::PARAM_STR);
        $pr->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $pr->bindParam(':ndormitorios', $ndormitorios, PDO::PARAM_STR);
        $pr->bindParam(':precio', $precio, PDO::PARAM_STR);
        $pr->bindParam(':tamano', $tamano, PDO::PARAM_STR);
        $pr->bindParam(':observaciones', $observaciones, PDO::PARAM_STR);
        $pr->bindParam(':fecha_anuncio', $fecha_anuncio);

        return $pr->execute();


    }

}
echo Vivienda::numeroDeViviendas();