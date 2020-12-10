<?php
require_once 'RouterClass.php';


// instacio el router
$router = new Router();



 //run
 $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']); 
