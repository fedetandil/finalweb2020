<?php

require_once "Model/ModelCentroSalud.php";
require_once "Model/ModelLote.php";
require_once "api/ApiView.php";

class ApiController
{
    private $view;
    private $modelCentroSalud;
    private $modelLote;

    function __construct(){
        $this->modelCentroSalud= new ModelCentroSalud();
        $this->modelLote=new ModelLote();
        $this->view= new APIView();
        $this->data= file_get_contents('php://input');
    }

    function getData(){
        return json_decode($this->data);
    }

    function getCentrosSalud(){
        $centros=$this->modelCentroSalud->getCentros();
        if(!empty($centros)){
            $this->view->response($centros,200);
        }else{
            $this->view->response("No hay centros de salud registrados",200);
        }
    }

    function getLotesByCentro($params=null){
        if(isset($params[':ID'])){
            $idcentro=$params[':ID'];
            $centro= $this->modelCentroSalud->getCentro($idcentro);
            if(!empty($centro)){
                $lotes= $this->modelLote->getLotesDisponibles($idcentro);
                if(!empty($lotes)){
                    $this->view->response($lotes,200);
                }else{
                    $this->view->response("No hay lotes asignados al centro buscado",200);
                }
            }else{
                $this->view->response("No existe el centro con el id: $idcentro",404);
            }
        }
    }


}
