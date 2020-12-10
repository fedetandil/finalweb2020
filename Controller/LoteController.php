<?php

require_once "Model/ModelLote.php";
require_once "Model/ModelLaboratorio.php";
require_once "Model/ModelCiudad.php";
require_once "Controller/LoginController.php";
require_once "View/LoteView.php";

class LoteController
{
    private $modelLote;
    private $modelLaboratorio;
    private $modelCiudad;
    private $controllerLogin;
    private $viewLote;

    function __construct(){
        $this->modelLote= new ModelLote();
        $this->modelCiudad= new ModelCiudad();
        $this->modelLaboratorio= new ModelLaboratorio();
        $this->controllerLogin= new LoginController();
        $this->viewLote= new LoteView();
    }
 //EJERCICIO 1 ALTERNATIVA B
    function AddLote(){
        if(isset($_POST['nrolote'])&&(!empty($_POST['nrolote']))&&
            isset($_POST['vencimiento'])&&(!empty($_POST['vencimiento']))&&
            isset($_POST['idciudad'])&&(!empty($_POST['idciudad']))&&
            isset($_POST['idlaboratorio'])&&(!empty($_POST['idlaboratorio']))){
            $nrolote= $_POST['nrolote'];
            $vencimiento= $_POST['vencimiento'];
            $idciudad= $_POST['idciudad'];
            $idlaboratorio= $_POST['idlaboratorio'];
            if($this->controllerLogin->isAdmin()){ //SI ESTA LOGUEADO Y ES ADMIN
                $ciudad= $this->modelCiudad->getCiudad($idciudad);
                if(!empty($ciudad)){
                    $laboratorio= $this->modelLaboratorio->getLaboratorio($idlaboratorio);
                    if(!empty($laboratorio)){
                        if($ciudad->temperatura_conservacion<=$laboratorio->temperatura_requerida){
                            $this->modelLote->addLote($nrolote,$vencimiento,$idciudad,$idlaboratorio);
                        }else{
                            $this->viewLote->ShowError("No cumple con los requisitos de temperatura");
                        }
                    }else{
                        $this->viewLote->ShowError("El laboratorio no existe");
                    }
                }else{
                    $this->viewLote->ShowError("La ciudad no existe");
                }
            }else{
                $this->viewLote->ShowError("No tienes suficientes permisos para realizar la acción");
            }

        }else{
            $this->viewLote->ShowError("Falta Completar Datos");
        }
    }
}
