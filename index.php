<?php

class EquipoType
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

}

class JugadorResponse
{

    // Atributos
    private $idJugador;

    private $nombreJugador;

    private $nacionalidad;

    private $dorsal;

    // private $equipo;

    // Constructor
    function __construct ($idJugador, $nombreJugador, $nacionalidad, $dorsal, $equipo)
    {
        $this->idJugador = $idJugador;
        $this->nombreJugador = $nombreJugador;
        $this->nacionalidad = $nacionalidad;
        $this->dorsal = $dorsal;
        $this->equipo = new EquipoType($equipo->idEquipo, $equipo->nombreEquipo, $equipo->liga, $equipo->ciudad);
    }

}

class Jugador
{

    public function GetJugador ($GetJugador)
    {
        return new JugadorResponse($GetJugador->idJugador, $GetJugador->nombreJugador, $GetJugador->nacionalidad, $GetJugador->dorsal, $GetJugador->equipo);
    }

}

// Conexion
try
{
    $options = [
            'uri' => 'http://localhost/EclipsePrueba/index.php'
    ];
    $server = new SoapServer("http://localhost/EclipsePrueba/WSDLFile.wsdl", $options);
    $server->setClass('Jugador');
    $data = file_get_contents("php://input");
    $server->handle($data);
}

catch (SOAPFault $f)
{
    print("ERROR");
}

?>