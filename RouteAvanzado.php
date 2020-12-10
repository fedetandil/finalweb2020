<?php

//require_once "Api/ApiController.php";

require_once 'RouterClass.php';




define("BASE_URL", 'http://' . $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]) . '/');

$r = new Router();


//Ruta por defecto.
$r->setDefaultRoute("TurnoController", "getTurnos");

//run
$r->route($_GET['action'], $_SERVER['REQUEST_METHOD']);
?>
