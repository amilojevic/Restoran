<?php

function zaglavlje(){
	header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
}

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
        
    case 'GET':
        zaglavlje();
        if($_GET['username'])
        {
        	getByUserName();
        }
        else if($_GET['idRezervacije'])
        {
        	getByReservationId();
        }
        else
        {
        	getAll();
        }
    break;
       
    default: header("{$_SERVER['SERVER_PROTOCOL']} 404 not found");
	break;
}
function getAll()
{
	$veza = new PDO("mysql:dbname=restoran;host=localhost;charset=utf8", "andrej", "admin");
    $veza->exec("set names utf8");
    $rezultat = $veza->query("select * from rezervacija");

    if (!$rezultat) {
        $greska = $veza->errorInfo();
        print "SQL greška: " . $greska[2];
        exit();
    } 
    $forEncodeJson = $rezultat->fetchAll(PDO::FETCH_OBJ);
    echo '{"Reservations":' . json_encode($forEncodeJson) . '}';
}

function getByReservationId()
{
	$idRezervacije = $_GET['idRezervacije'];
	$veza = new PDO("mysql:dbname=restoran;host=localhost;charset=utf8", "andrej", "admin");
    $veza->exec("set names utf8");
    $rezultat = $veza->query("select * from rezervacija where idRezervacije=$idRezervacije");

    if (!$rezultat) {
        $greska = $veza->errorInfo();
        print "SQL greška: " . $greska[2];
        exit();
    } 
    $forEncodeJson = $rezultat->fetchAll(PDO::FETCH_OBJ);
    echo '{"Reservations":' . json_encode($forEncodeJson) . '}';
}

function getByUserName()
{
	$ime = $_GET['username'];
	$veza = new PDO("mysql:dbname=restoran;host=localhost;charset=utf8", "andrej", "admin");
    $veza->exec("set names utf8");
    $rezultat = $veza->query("select * from rezervacija where ime='$ime'");

    if (!$rezultat) {
        $greska = $veza->errorInfo();
        print "SQL greška: " . $greska[2];
        exit();
    } 
    $forEncodeJson = $rezultat->fetchAll(PDO::FETCH_OBJ);
    echo '{"Reservations":' . json_encode($forEncodeJson) . '}';
}

?>