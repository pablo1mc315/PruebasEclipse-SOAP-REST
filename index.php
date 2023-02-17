<?php

class Equipo
{

    // Atributos
    private $idEquipo;

    private $nombreEquipo;

    private $liga;

    private $ciudad;

    // Constructor
    function __construct ($idEquipo, $nombreEquipo, $liga, $ciudad)
    {
        $this->idEquipo = $idEquipo;
        $this->nombreEquipo = $nombreEquipo;
        $this->liga = $liga;
        $this->ciudad = $ciudad;
    }

    // Getters
    function getIdEquipo ()
    {
        return $this->idEquipo;
    }

    function getNombreEquipo ()
    {
        return $this->nombreEquipo;
    }

    function getLiga ()
    {
        return $this->liga;
    }

    function getCiudad ()
    {
        return $this->ciudad;
    }

}

class Jugador
{

    // Atributos
    private $idJugador;

    private $nombreJugador;

    private $nacionalidad;

    private $dorsal;

    private $equipo;

    // Constructor
    function __construct ($idJugador, $nombreJugador, $nacionalidad, $dorsal, $equipo)
    {
        $this->idJugador = $idJugador;
        $this->nombreJugador = $nombreJugador;
        $this->nacionalidad = $nacionalidad;
        $this->dorsal = $dorsal;
        $this->equipo = $equipo;
    }

    // Funcion que devuelve la respuesta en formato JSON
    public function response ()
    {
        $json = array(
                "ID" => $this->idJugador,
                "Nombre" => $this->nombreJugador,
                "Nacionalidad" => $this->nacionalidad,
                "Dorsal" => $this->dorsal,
                "Equipo" => array(
                        "ID" => $this->equipo->getIdEquipo(),
                        "Nombre" => $this->equipo->getNombreEquipo(),
                        "Liga" => $this->equipo->getLiga(),
                        "Ciudad" => $this->equipo->getCiudad()
                )
        );

        return json_encode($json);
    }

}

// Recogemos las variables de la petición GET de Postman
$idJugador = $_GET['idJugador'];
$nombreJugador = $_GET['nombreJugador'];
$nacionalidad = $_GET['nacionalidad'];
$dorsal = $_GET['dorsal'];
$idEquipo = $_GET['idEquipo'];
$nombreEquipo = $_GET['nombreEquipo'];
$liga = $_GET['liga'];
$ciudad = $_GET['ciudad'];

// Si todas las variables han sido inicializadas, enviamos llamamos a la función response() para que nos las muestre
if (isset($idJugador) && isset($nombreJugador) && isset($nacionalidad) && isset($dorsal) && isset($idEquipo) && isset($nombreEquipo) && isset($liga) && isset($ciudad))
{
    $equipo = new Equipo($idEquipo, $nombreEquipo, $liga, $ciudad);
    $jugador = new Jugador($idJugador, $nombreJugador, $nacionalidad, $dorsal, $equipo);
    http_response_code(200);
    echo $jugador->response();
}

else
{
    http_response_code(500);
    echo "ERROR: No se han enviado todas las variables necesarias.";
}

?>