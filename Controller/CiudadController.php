<?php
require_once "Model/ModelLote.php";
require_once "Model/ModelCiudad.php";
require_once "View/CiudadView.php";

class CiudadController
{
    private $modelCiudad;
    private $modelLote;
    private $ciudadView;

    function __construct()
    {
        $this->modelLote = new ModelLote();
        $this->modelCiudad = new ModelCiudad();
        $this->ciudadView = new CiudadView();
    }
    //EJERCICIO 2 ALTERNATIVA A
    function generateTable()
    {
        //OBTENGO TODAS LAS CIUDADES
        $ciudades = $this->modelCiudad->getCiudades();

        $list = []; //ESTA VA A SER LA LISTA QUE CONTENGA TODAS LAS CIUDADES CON SUS LOTES.

        //POR CADA CIUDAD OBTENGO SUS LOTES
        if (!empty($ciudades)) {
            foreach ($ciudades as $ciudad) {
                $lotelist = [];
                $lotes = $this->modelLote->getLotesById($ciudad->id); //Obtengo todos los lotes

                foreach ($lotes as $lote) {
                    $data = new stdClass();
                    $data->nrolote = $lote->nro_lote;
                    $data->ciudad = $lote->nombre_ciudad;
                    $data->pp = $lote->año_vencimiento;

                    $json = json_encode($data); //Guardo el lote en formato JSON
                    array_push($lotelist, $json); //PUSHEO EL JSON A LA LISTA DE LOTES
                }
                if (!empty($lotes)) {
                    $cantidad = count($lotes);
                    $nombreciudad = $ciudad->nombre;
                    array_push($list, $nombreciudad); //nombre de la ciudad
                    array_push($list, $cantidad); //cantidad de lotes de la ciudad
                    array_push($list, $lotelist); // lista de lotes con sus detalles
                }
            }
        }else{
            $this->ciudadView->ShowMessage("No Hay ciudades");
        }

        $this->ciudadView->ShowTable($list); //ENVIO LA LISTA A LA VISTA PARA GENERARLA CON SMARTY
    }
}
